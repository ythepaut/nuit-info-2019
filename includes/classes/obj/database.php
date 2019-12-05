<?php

class DatabaseHandler {

    private $credentials = array(
        "ip" => "ythepautfcninfo.mysql.db",
        "login" => "ythepautfcninfo",
        "passwd" => "ANtaFIesRG5h0w2I",
        "base" => "ythepautfcninfo"
    );

    private $connection;

    private static $instance;

    public function __construc() {
        $this->connection = mysqli_connect($credentials['ip'], $credentials['login'], $credentials['password'], $credentials['login']);
        mysqli_set_charset($this->connection, "utf8");

        $instance = $this;

        //TODO Tester la connexion
    }

    public static function getInstance() {
        return DatabaseHandler::$instance;
    }


    /**
     * Fonction qui execute une requete MySQL dans la base de données
     *
     * @param string        $query      -       Requete SQL
     * @param array         $args       -       Arguements de la requete
     *
     * @return array
     *
     */
    public function executeQuery($query, $args) {

        $paramTypes = "";
        foreach ($args as $arg) {
            if ($arg instanceof string) {
                $paramTypes .= "s";
            } elseif ($arg instanceof integer) {
                $paramTypes .= "i";
            } elseif ($arg instanceof boolean) {
                $paramTypes .= "b";
            } elseif ($arg instanceof float) {
                $paramTypes .= "d";
            }
        }

        $statement = $this->$connection->prepare($query);
        $statement->bind_param($paramTypes, $args);
        $statement->execute();
        $result = $statement->get_result();
        $statement->close();
        $data = $result->fetch_assoc();

        return $data;

    }



}

?>
