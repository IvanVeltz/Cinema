<?php

namespace Controller;
use Model\Connect;

class CinemaController {


    // Lister les films 
    public function listFilms() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT titre, annee_sortie
            FROM film
        ");

        require "view/listFilms.php";
    }

    public function detaiFilm() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT * 
            FROM film
            WHERE id_film = :id
        ");
        $requete->execute(["id"=> $id]);

        require "view/detailFilm.php";
    }
}