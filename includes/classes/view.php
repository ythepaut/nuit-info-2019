<?php

#Header
include("./includes/pages/header.php");

$page = (isset($_GET['page'])) ? $_GET['page'] : "";

switch ($page) {
    #Pages "vitrine"
    case "":
    case "index":
    case "accueil":
        include("./includes/pages/accueil.php");
        break;

    case "404":
    default:
        include("./includes/pages/404.php");
        break;
}

?>
