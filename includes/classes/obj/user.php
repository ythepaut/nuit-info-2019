<?php

include_once("./includes/classes/obj/database.php");



class User {
    private $id;
    private $username;
    private $email;
    private $password;

    public function __construct($id) {
        $this->id = $id;

        $queryRes = DatabaseHandler::executeQuery("SELECT * FROM nuitinfo_users WHERE id = ?", array($id));

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
