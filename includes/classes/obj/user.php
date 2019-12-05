<?php

include_once("./includes/classes/obj/database.php");



class User {
    private $id;
    private $username;
    private $email;
    private $password;

    public function __construct($name, $value) {
        $queryRes = DatabaseHandler::executeQuery("SELECT * FROM nuitinfo_users WHERE " . $name . " = ?", array($value));

        $this->id = $id = $queryRes["id"];
        $this->username = $queryRes["username"];
        $this->email = $queryRes["email"];
        $this->password = $queryRes["password"];
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }
}

?>
