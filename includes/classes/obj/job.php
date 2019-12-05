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

    public function __construct($name, $value) {

        $queryRes = DatabaseHandler::executeQuery("SELECT * FROM nuitinfo_jobs WHERE " . $name . " = ?", array($value));

        $this->id = $queryRes["id"];
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

    public function getDescription() {
        return $this->description;
    }

    public function getCategorie() {
        return $this->categorie;
    }

    public function getlocation() {
        return $this->location;
    }

    public function getDate() {
        return $this->date;
    }

    public function getOwner() {
        return $this->owner;
    }
}

?>