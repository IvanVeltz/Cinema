<?php

namespace Controller;
use Model\Connect;

class CinemaController {


    // Lister les films 
    public function listeFilms() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT titre, annee_sortie
            FROM film
        ");

        require "view/listeFilms.php";
    }

    public function accueil(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT f.id_film, f.titre, f.duree, f.synopsis, f.annee_sortie, f.affiche, g.type, CONCAT(p.nom, ' ', p.prenom) AS realisateur
            FROM film f
            INNER JOIN realisateur r ON r.id_realisateur = f.id_realisateur
            INNER JOIN personne p ON p.id_personne = r.id_personne
            INNER JOIN film_genre fg ON fg.id_film = f.id_film
            INNER JOIN genre g ON g.id_genre = fg.id_genre
            WHERE f.id_film = (SELECT id_film FROM film WHERE annee_sortie = (SELECT MAX(annee_sortie) FROM film) LIMIT 1)
            ORDER BY f.annee_sortie DESC;
        ");
        require "view/accueil.php";
    }

}