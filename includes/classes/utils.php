<?php


/**
 * Fonction qui retourne une chaîne de caractères aléatoire de longueur n.
 *
 * @param int           $n                  -   Longueur de la chaîne a generer
 *
 * @return string
 */
function randomString($n) {
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charactersLength = strlen($characters);
    $randomString = "";
    for ($i = 0; $i < $n; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}


/**
 * Fonction qui retourne la source relative d'un fichier en fonction de l'emplacement actuel.
 *
 * @param string        $relative_src       -       Chemin d'accès relatif par défaut
 *
 * @return string
 */
function getSrc($relative_src) {
    $result_src = $relative_src;
    $nb = substr_count($_SERVER['REQUEST_URI'], "/", 0, strlen($_SERVER['REQUEST_URI']));
    return str_repeat("../", $nb - 1) . "." . $relative_src;
}


/**
 * Fonction qui rafraichit la variable de session.
 *
 * @param mysqlconnection   $connection         -   Connexion BDD effectuée dans le fichier config-db.php
 *
 * @return void
 */
function refreshSession($connection) {
    $query = $connection->prepare("SELECT * FROM kioui_accounts WHERE id = ?");
    $query->bind_param("s", $_SESSION['Data']['id']);
    $query->execute();
    $result = $query->get_result();
    $query->close();
    $userData = $result->fetch_assoc();
    $_SESSION['Data'] = $userData;
}


/**
 * Fonction retourne si la session est valide ou non
 *
 * @param mysqlconnection   $connection         -   Connexion BDD effectuée dans le fichier config-db.php
 *
 * @return boolean
 */
function isValidSession($connection) {
    refreshSession($connection);
    return $_SESSION['Data']['status'] == "ALIVE" && $_SESSION['LoggedIn'];
}


/**
 * Fonction qui indique si la catégorie du service sélectionnée est valide
 *
 * @param string        $categorie              -   Categorie a verifier
 *
 * @return boolean
 */
function categorieServiceExist($categorie) {
    return ($categorie == "DON" || $categorie == "TRANSPORT" || $categorie == "GARDIENNAGE" || $categorie == "TROC" || $categorie == "VENTE");
}


/**
 * Fonction qui indique si la catégorie du job sélectionnée est valide
 *
 * @param string        $categorie              -   Categorie a verifier
 *
 * @return boolean
 */
function categorieJobExist($categorie) {
    return ($categorie == "CDI" || $categorie == "CDD" || $categorie == "STAGE");
}


/**
 * Télécharge un fichier
 * Cette fonction peut télécharger depuis fichier (laissant $name et $from_string par défaut),
 * ou peut télécharger depuis une chaine de caractères, il faudra alors préciser le nom du fichier
 * pour l'utilisateur et mettre $from_string à true.
 *
 * @param   string      $content        - Contenu du fichier, ou son nom
 * @param   string      $name           - Nom du ficihier lors du téléchargement
 * @param   boolean     $from_string    - Si true, $content est le contenu à télécharger,
 *                                        sinon $content est le nom du fichier à télécharger
 */
function downloadFile($content, $name = null, $from_string = false) {
    if ($from_string) {
        $file = TEMP_DIR . randomString(16);
        file_put_contents($file, $content);
    } else {
        $file = $content;
    }

    if ($name === null) {
        $name = basename($file);
    }

    $knownMimeTypes = array(
        "htm"  => "text/html",
        "exe"  => "application/octet-stream",
        "zip"  => "application/zip",
        "doc"  => "application/msword",
        "jpg"  => "image/jpg",
        "php"  => "text/plain",
        "xls"  => "application/vnd.ms-excel",
        "ppt"  => "application/vnd.ms-powerpoint",
        "gif"  => "image/gif",
        "pdf"  => "application/pdf",
        "txt"  => "text/plain",
        "html" => "text/html",
        "png"  => "image/png",
        "jpeg" => "image/jpg",
    );

    $fileExtension = pathinfo($file, PAxTHINFO_EXTENSION);

    if (array_key_exists($fileExtension, $knownMimeTypes)) {
        $mimeType = $knownMimeTypes[$fileExtension];
    } else {
        $mimeType = "application/octet-stream";
    }

    if (file_exists($file)) {
        @ob_end_clean();
        header('Content-Description: File Transfer');
        header('Content-Type: ' . $mimeType);
        header('Content-Disposition: attachment; filename="' . $name . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));

        readfile($file);

        if ($from_string) {
            unlink($file);
        }
    } else {
        header("Location : /404");
    }
}
?>
