<?php

include_once("./includes/classes/obj/database.php");



class Job {
    private $id;
    private $title;
    private $description;
    private $categorie;
    private $location;
    private $date;
    private $owner;

    public function __construct($id) {
        $this->id = $id;

        $queryRes = DatabaseHandler::executeQuery("SELECT * FROM nuitinfo_jobs WHERE id = ?", array($id));

        $this->title = $queryRes["title"];
        $this->description = $queryRes["description"];
        $this->categorie = $queryRes["categorie"];
        $this->location = $queryRes["location"];
        $this->date = $queryRes["date"];
        $this->owner = $queryRes["owner"];
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }
}

?>