<?php
session_start();

#Affichage des message de debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


#Configurations
include_once("./includes/classes/obj/database.php");
include_once("./includes/classes/obj/user.php");

$u = new User(10);
var_dump($u);

#Fonctions utiles
include_once("./includes/classes/utils.php");

#Affichage de la page web
include("./includes/classes/view.php");

?>
