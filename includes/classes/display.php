<?php

function servicesList($connection) {

    $query = $connection->prepare("SELECT * FROM nuitinfo_services");
    $query->execute();
    $result = $query->get_result();

    $res = '';

    while ($service = mysqli_fetch_assoc($result)) {

        // conversion de la location
        $location = json_decode($service["location"], true);

        // récupération du nom du proprio
        $query2 = $connection->prepare("SELECT username FROM nuitinfo_users WHERE id = ?");
        $query2->bind_param("i", $service["owner"]);
        $query2->execute();
        $result2 = $query2->get_result();
        $query2->close();
        $owner = $result2->fetch_assoc();

        // affichage
        $res .= '<div class="list-element">';
        $res .= '<div>';
        $res .= '<h2>'.$service["title"].'</h2>';
        $res .= '<p>'.$service["categorie"].'</p>';
        $res .= '<br/>';
        $res .= '<p>'.$service["description"].'</p>';
        $res .= '<p> de '.$owner["username"].'</p>';
        $res .= '<br/>'
        $res .= '<p>'.$location["street"].', '.$location["city"].'</p>';
        $res .= '<p>'.date("d/m/Y H:i", $service["date"]).'</p>';
        $res .= '</div>';
        $res .= '<div>';
        $res .= '<img src="'.getSrc("./resources/img/plus.svg").'" alt="">';
        $res .= '</div>';
        $res .= '</div>';
    }
    echo($res);
}


function jobsList($connection) {

    $query = $connection->prepare("SELECT * FROM nuitinfo_jobs");
    $query->execute();
    $result = $query->get_result();

    $res = '';

    while ($job = mysqli_fetch_assoc($result)) {

        // conversion de la location
        $location = json_decode($job["location"], true);

        // récupération du nom du proprio
        $query2 = $connection->prepare("SELECT username FROM nuitinfo_users WHERE id = ?");
        $query2->bind_param("i", $job["owner"]);
        $query2->execute();
        $result2 = $query2->get_result();
        $query2->close();
        $owner = $result2->fetch_assoc();

        // affichage
        $res .= '<div class="list-element">';
        $res .= '<div>';
        $res .= '<h2>'.$job["title"].'</h2>';
        $res .= '<p>'.$job["categorie"].'</p>';
        $res .= '<br/>';
        $res .= '<p>'.$job["description"].'</p>';
        $res .= '<p> de '.$owner["username"].'</p>';
        $res .= '<br/>'
        $res .= '<p>'.$location["street"].', '.$location["city"].'</p>';
        $res .= '<p>'.date("d/m/Y H:i", $job["date"]).'</p>';
        $res .= '</div>';
        $res .= '<div>';
        $res .= '<img src="'.getSrc("./resources/img/plus.svg").'" alt="">';
        $res .= '</div>';
        $res .= '</div>';
    }
    echo($res);
}


?>