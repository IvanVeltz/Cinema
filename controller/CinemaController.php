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

    public function accueil(){
        require "view/accueil.php";
    }

}