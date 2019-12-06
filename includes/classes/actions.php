<?php
session_start();

include_once(getcwd() . "/utils.php");

$action = (isset($_POST['action'])) ? $_POST['action'] : "";
$action = ($action == "" && isset($_GET['action']) && $_GET['action'] != "") ? $_GET['action'] : $action;

switch ($action) {
    case "logout":
        session_destroy();
        header("Location: /");
        break;
    case "blind-mode":
        $_SESSION["blindMode"] = !$_SESSION["blindMode"];
        header("Location: /");
        break;
    case "ajout-service":
        die(ajoutService($_POST['title'], $_POST['description'], $_POST['categorie'], $_POST['location'], $connection));
        break;
    default:
        throw new Exception("ERROR_MISSING_ACTION");
        break;
}
/**
 * Foncton qui ajoute un service dans la bdd
 * @param string            $title          - Le titre du service
 * @param string            $description    - La description du service
 * @param string            $categorie      - La catégorie du service
 * @param array             $location       - La localisation du service
 * @param integer           $ownerId        - L'identifiant du demandeur du service
 *
 * @return void
 */
function ajoutService($title, $description, $categorie, $location, $connection) {
    if (isset($title, $description, $categorie, $location, $ownerId) && $location != "" && $title != "" && $description != "" && $categorie != "") {
        if (categorieExist($categorie)) {
            $query = $connection->prepare("INSERT INTO nuitinfo_services (title, description, categorie, location, date, owner) VALUES (?, ?, ?, ?, ?, ?) ");
            $query->bind_param("ssssii", $title, $description, $categorie, $location, time(), $_SESSION['Data']['id']);
            $query->execute();
            $query->close();
        }
    }
}

?>
