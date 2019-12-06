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
    case "aides":
        include("./includes/pages/financals_aids.php");
        break;
    case "medecine":
        include("./includes/pages/medecine.php");
        break;
    case "jobs":
        include("./includes/pages/jobs.php");
        break;
    case "connexion":
        include("./includes/pages/connexion.php");
        break;
    case "inscription":
        include("./includes/pages/inscription.php");
        break;

    case "404":
    default:
        include("./includes/pages/404.php");
        break;
}

?>
