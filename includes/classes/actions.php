<?php
session_start();

include_once(getcwd() . "/utils.php");
include_once(getcwd() . "/obj/database.php");
include_once(getcwd() . "/obj/user.php");

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
    default:
        throw new Exception("ERROR_MISSING_ACTION");
        break;
}

?>
