<?php
session_start();

include_once(getcwd() . "/utils.php");
include_once(getcwd() . "/config-db.php");

$action = (isset($_POST['action'])) ? $_POST['action'] : "";
$action = ($action == "" && isset($_GET['action']) && $_GET['action'] != "") ? $_GET['action'] : $action;

switch ($action) {
    case "logout":
        session_destroy();
        header("Location: /");
        break;
    case "login":
        die(login($_POST['login-email'], $_POST['login-password'], $connection));
        break;
    case "register":
        die(register($_POST['register-username'], $_POST['register-email'], $_POST['register-password'], $connection));
        break;
    case "blind-mode":
        $_SESSION["blindMode"] = !$_SESSION["blindMode"];
        header("Location: /");
        break;
    case "ajout-service":
        die(ajoutService($_POST['title'], $_POST['description'], $_POST['categorie'], $_POST['location'], $connection));
        break;
    case "ajout-job":
        die(ajoutJob($_POST['title'], $_POST['description'], $_POST['categorie'], $_POST['location'], $connection));
        break;
    default:
        throw new Exception("ERROR_MISSING_ACTION");
        break;
}





/**
 * Connexion de l'utilisateur : Methode e-mail + mot de passe
 * (Formulaire AJAX)
 *
 * @param string            $email              -   Adresse e-mail de l'utilisateur
 * @param string            $passwd             -   Mot de passe de l'utilisateur
 * @param mysqlconnection   $connection         -   Connexion BDD effectuée dans le fichier config-db.php
 *
 * @return string
 */
function login($email, $passwd, $connection) {
    $result = "ERROR_UNKNOWN#Une erreur est survenue.";

    //Verification des champs
    if (isset($email, $passwd, $connection) && $email != "" && $passwd != "") {

        //Recuperation des données
        $query = $connection->prepare("SELECT * FROM nuitinfo_users WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();
        $query->close();
        $userData = $result->fetch_assoc();

        //Identifiants correct ?
        if (isset($userData['id']) && $userData['id'] != null && password_verify(hash('sha512', $passwd . $userData['salt']), $userData['password'])) {

            //Verification du compte
            if ($userData['status'] == "ALIVE") {

                #Attribution des données de session
                $_SESSION['Data'] = $userData;
                $_SESSION['LoggedIn'] = true;

                $result = "SUCCESS#Bienvenue " . $_SESSION['Data']['username'] . "#/espace-utilisateur/accueil";

            } else {

                switch ($userData['status']) {
                    case "SUSPENDED":
                        $result = "ERROR_ACCOUNT_SUSPENDED#Connexion impossible : Ce compte est suspendu.";
                        break;
                    default:
                        $result = "ERROR_INVALID_ACCESSLEVEL#Connexion impossible : Niveau d'accès insuffisant.";
                        break;
                }

            }

        } else {
            $result = "ERROR_INVALID_CREDENTIALS#Identifiants de connexion invalides.";
        }

    } else {
        $result = "ERROR_MISSING_FIELDS#Veuillez remplir tous les champs.";
    }

    return $result . "#<script>window.href.location = '/';</script>";
}



/**
 * Enregistrement d'un nouvel utilisateur
 * (Formulaire AJAX)
 *
 * @param string            $username           -   Nom d'utilisateur
 * @param string            $email              -   Adresse e-mail de l'utilisateur
 * @param string            $passwd             -   Mot de passe de l'utilisateur
 * @param string            $passwd2            -   Mot de passe de l'utilisateur (confirmation)
 * @param mysqlconnection   $connection         -   Connexion BDD effectuée dans le fichier config-db.php
 *
 * @return string
 */
function register($username, $email, $passwd, $connection) {
    $result = "ERROR_UNKNOWN#Une erreur est survenue.";

    //Verification des champs
    if (isset($username, $email, $passwd, $connection) && $email != "" && $passwd != "" && $username != "") {

        if (strlen($username) <= 16 && strlen($username) >= 3) {

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                if (strlen($passwd) >= 8 && preg_match("#[0-9]+#", $passwd) && preg_match("#[a-zA-Z]+#", $passwd)) {

                    //Verification données e-mail
                    $query = $connection->prepare("SELECT * FROM nuitinfo_users WHERE email = ?");
                    $query->bind_param("s", $email);
                    $query->execute();
                    $result = $query->get_result();
                    $query->close();
                    $userData = $result->fetch_assoc();

                    if ($userData['id'] == "") {

                        //Verification données nom d'utilisateur
                        $query = $connection->prepare("SELECT * FROM nuitinfo_users WHERE username = ?");
                        $query->bind_param("s", $username);
                        $query->execute();
                        $result = $query->get_result();
                        $query->close();
                        $userData = $result->fetch_assoc();

                        if ($userData['id'] == "") {

                            $salt = randomString(16);
                            $password_salted_hashed = password_hash(hash('sha512', $passwd . $salt), PASSWORD_DEFAULT, ['cost' => 12]);
                            $status = "ALIVE";

                            $query = $connection->prepare("INSERT INTO nuitinfo_users (email, username, password, salt, status) VALUES (?,?,?,?,?)");
                            $query->bind_param("sssss", $email, $username, $password_salted_hashed, $salt, $status);
                            $query->execute();
                            $query->close();

                            $result = "SUCCESS#Compte créé avec succès.#/";

                        } else {
                            $result = "ERROR_USED_USERNAME#Ce nom d'utilisateur est déjà utilisé.";
                        }

                    } else {
                        $result = "ERROR_USED_EMAIL#Cette adresse e-mail est déjà utilisée.";
                    }

                } else {
                    $result = "ERROR_INVALID_PASSWD#Votre mot de passe doit faire au moins 8 caractères, contenir au moins une lettre et un chiffre.";
                }

            } else {
                $result = "ERROR_INVALID_EMAIL#Veuillez saisir une adresse e-mail valide.";
            }

        } else {
            $result = "ERROR_INVALID_USERNAME#Votre nom d'utilisateur doit faire entre 3 et 16 caractères.";
        }

    } else {
        $result = "ERROR_MISSING_FIELDS#Veuillez remplir tous les champs.";
    }

    return $result . "#<script>window.href.location = '/';</script>";
}







/**
 * Foncton qui ajoute un service dans la bdd
 * @param string            $title          - Le titre du service
 * @param string            $description    - La description du service
 * @param string            $categorie      - La catégorie du service
 * @param array             $location       - La localisation du service
 * @param mysqlconnection   $connection     -   Connexion BDD effectuée dans le fichier config-db.php
 * 
 * @return void
 */
function ajoutService($title, $description, $categorie, $location, $connection) {

    $result = "ERROR_UNKNOWN#Une erreur est survenue.";

    if (isValidSession($connection)) {

        if (isset($title, $description, $categorie, $location, $ownerId) && $location != "" && $title != "" && $description != "" && $categorie != "") {
    
            if (categorieServiceExist($categorie)) {

                $query = $connection->prepare("INSERT INTO nuitinfo_services (title, description, categorie, location, date, owner) VALUES (?, ?, ?, ?, ?, ?) ");
                $query->bind_param("ssssii", $title, $description, $categorie, $location, time(), $_SESSION['Data']['id']);
                $query->execute();
                $query->close();

                $result = "SUCCESS#Votre job a été ajouté avec succès.#null";
            
            } else {
                $result = "ERROR_UNKNOWN_CATEGORY#Cette catégorie n'éxiste pas.";
            }
    
        } else {
            $result = "ERROR_MISSING_FIELDS#Veuillez remplir tous les champs.";
        }

    } else {
        $result = "ERROR_INVALID_SESSION#Votre session est invalide. Déconnectez vous puis reconnectez vous. Si le problème persiste contactez le support.";
    }


}


/**
 * Foncton qui ajoute un Job dans la bdd
 * @param string            $title          - Le titre du job
 * @param string            $description    - La description du job
 * @param string            $categorie      - La catégorie du job
 * @param array             $location       - La localisation du job
 * @param mysqlconnection   $connection     -   Connexion BDD effectuée dans le fichier config-db.php
 * 
 * @return void
 */
function ajoutJob($title, $description, $categorie, $location, $connection) {

    $result = "ERROR_UNKNOWN#Une erreur est survenue.";

    if (isValidSession($connection)) {

        if (isset($title, $description, $categorie, $location, $ownerId) && $location != "" && $title != "" && $description != "" && $categorie != "") {
    
            if (categorieJobExist($categorie)) {

                $query = $connection->prepare("INSERT INTO nuitinfo_jobs (title, description, categorie, location, date, owner) VALUES (?, ?, ?, ?, ?, ?) ");
                $query->bind_param("ssssii", $title, $description, $categorie, $location, time(), $_SESSION['Data']['id']);
                $query->execute();
                $query->close();

                $result = "SUCCESS#Votre service a été ajouté avec succès.#null";
            
            } else {
                $result = "ERROR_UNKNOWN_CATEGORY#Cette catégorie n'éxiste pas.";
            }
    
        } else {
            $result = "ERROR_MISSING_FIELDS#Veuillez remplir tous les champs.";
        }

    } else {
        $result = "ERROR_INVALID_SESSION#Votre session est invalide. Déconnectez vous puis reconnectez vous. Si le problème persiste contactez le support.";
    }


}

?>
