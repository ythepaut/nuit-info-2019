<?php

$page = (isset($_GET['page'])) ? $_GET['page'] : "";

switch ($page) {
    #Pages "vitrine"
    case "":
    case "index":
    case "accueil":
        include("./includes/pages/accueil.php");
        break;
    case "ressources":
        include("./includes/pages/ressources.php");
        break;
    case "services":
        include("./includes/pages/services.php");
        break;
    case "jobs":
        include("./includes/pages/jobs.php");
        break;

    case "404":
    default:
        include("./includes/pages/404.php");
        break;
}

?>
