<?php
session_start();

#Affichage des message de debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

#Configurations
require_once("./includes/classes/config-db.php");

#Fonctions utiles
include_once("./includes/classes/utils.php");

#Fonctions d'affichage
include_once("./includes/classes/display.php");

#Affichage de la page web
include("./includes/classes/view.php");

?>
