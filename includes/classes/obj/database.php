<?php

class DatabaseHandler {
    private static $credentials = array(
        "ip" => "ythepautfcninfo.mysql.db",
        "login" => "ythepautfcninfo",
        "password" => "ANtaFIesRG5h0w2I",
        "base" => "ythepautfcninfo"
    );

    private static $connection;

    public static function init() {
        DatabaseHandler::$connection = mysqli_connect(DatabaseHandler::$credentials['ip'], DatabaseHandler::$credentials['login'], DatabaseHandler::$credentials['password'], DatabaseHandler::$credentials['login']);
        mysqli_set_charset(DatabaseHandler::$connection, "utf8");

        //TODO Tester la connexion
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
    public static function executeQuery($query, $args) {
        $paramTypes = "";
        foreach ($args as $arg) {
            if (is_int($arg)) {
                $paramTypes .= "i";
            }
            elseif (is_string($arg)) {
                $paramTypes .= "s";
            } elseif (is_bool($arg)) {
                $paramTypes .= "b";
            } elseif (is_bool($arg)) {
                $paramTypes .= "d";
            } else {
                throw new Exception("Mauvais type");
            }
        }

        $statement = DatabaseHandler::$connection->prepare($query);
        $statement->bind_param($paramTypes, $args);
        $statement->execute();
        $result = $statement->get_result();
        $statement->close();
        $data = $result->fetch_assoc();

        return $data;

    }
}

DatabaseHandler::init();

?>
