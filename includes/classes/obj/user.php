<?php



class User {
    private $id;
    private $username;
    private $email;
    private $password;

    public function __construct($id) {
        $this->id = $id;

        $db = DatabaseHandler::getInstance();
        $queryRes = $db->executeQuery("SELECT * FROM nuitinfo_users WHERE id = ?", $id);

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
