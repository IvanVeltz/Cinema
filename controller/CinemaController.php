<?php

namespace Controller;
use Model\Connect;

class CinemaController {

    // Lister les films 
    public function listeFilms() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT 
                f.id_film, f.titre, TIME_FORMAT(SEC_TO_TIME(f.duree * 60), '%Hh%i') AS temps, g.type, 
                CONCAT(SUBSTRING(f.synopsis, 1 , 600),'...') AS synopsis, f.annee_sortie, f.affiche, CONCAT(p.nom, ' ', p.prenom) AS realisateur
            FROM
                film f
            INNER JOIN 
                film_genre fg ON fg.id_film = f.id_film
            INNER JOIN 
                genre g ON g.id_genre = fg.id_genre
            INNER JOIN 
                realisateur r ON r.id_realisateur = f.id_realisateur
            INNER JOIN 
                personne p ON p.id_personne = r.id_personne
            WHERE g.id_genre = :id
            GROUP BY f.id_film  
        ");
        $requete->execute([
            "id"=>$_GET['id_genre']
        ]);

        require "view/listeFilms.php";
    }

    // Liste des acteurs
    public function listeActeurs(){
        $pdo = Connect::seConnecter();
        $requete1 = $pdo->query("
        SELECT 
            a.id_acteur, CONCAT(p.nom, ' ', p.prenom) AS acteurs
        FROM 
            personne p 
        INNER JOIN
            acteur a ON a.id_personne = p.id_personne
        ORDER BY
            acteurs
        ");

           

        require "view/listeActeurs.php";
    }

    // Liste des réalisateurs
    public function listeRealisateurs(){
        $pdo = Connect::seConnecter();
        $requete1 = $pdo->query("
        SELECT 
            r.id_realisateur, CONCAT(p.nom, ' ', p.prenom) AS realisateurs
        FROM 
            personne p 
        INNER JOIN
            realisateur r ON r.id_personne = p.id_personne
        ORDER BY
            realisateurs
        ");
           

        require "view/listeRealisateurs.php";
    }

    // Détail Film
    public function detailFilm($id){

        $pdo = Connect::seConnecter();
        $requete1 = $pdo->prepare("
            SELECT 
                f.id_film, f.titre, TIME_FORMAT(SEC_TO_TIME(f.duree * 60), '%Hh%i') AS temps, 
                CONCAT(SUBSTRING(f.synopsis, 1 , 600),'...') AS synopsis, f.annee_sortie, f.affiche, 
                GROUP_CONCAT(g.type SEPARATOR ', ') AS genres, CONCAT(p.nom, ' ', p.prenom) AS realisateur,
                f.id_realisateur, f.note
            FROM 
                film f
            INNER JOIN 
                realisateur r ON r.id_realisateur = f.id_realisateur
            INNER JOIN 
                personne p ON p.id_personne = r.id_personne
            INNER JOIN 
                film_genre fg ON fg.id_film = f.id_film
            INNER JOIN 
                genre g ON g.id_genre = fg.id_genre
            WHERE
                f.id_film = :id
            GROUP BY 
                f.id_film  
        ");
        $requete1->execute([
            "id"=>$id
        ]);

        $requete2 = $pdo->prepare("
            SELECT
                CONCAT(p.nom, ' ', p.prenom) AS acteurs,
                a.id_acteur
            FROM
                acteur a
            INNER JOIN 
                personne p ON p.id_personne = a.id_personne 
            INNER JOIN
                casting c ON c.id_acteur = a.id_acteur 
            WHERE
                c.id_film = :id
        ");
        $requete2->execute([
            "id"=>$id
        ]);

        require "view/detailFilm.php";
    }

    // Detail acteur
    public function detailActeur($id){

        $pdo = Connect::seConnecter();
        $requete1 = $pdo->prepare("
            SELECT
                CONCAT(p.nom, ' ', p.prenom) AS acteur,
                p.date_naissance_personne,
                p.sexe
            FROM personne p
            INNER JOIN
                acteur a ON a.id_personne = p.id_personne
            WHERE
                a.id_acteur = :id
        ");
        $requete1->execute([
            "id"=>$id
        ]);

        $requete2 = $pdo->prepare("
            SELECT
                f.titre,
                f.id_film
            FROM
                film f
            INNER JOIN
                casting c ON c.id_film = f.id_film
            INNER JOIN
                acteur a ON a.id_acteur = c.id_acteur
            WHERE
                a.id_acteur = :id
        ");
        $requete2->execute([
            "id"=>$id
        ]);


        require "view/detailActeur.php";

    }

    // Detail d'un réalisateur
    public function detailRealisateur($id){

        $pdo = Connect::seConnecter();
        $requete1 = $pdo->prepare("
            SELECT
                CONCAT(p.nom, ' ', p.prenom) AS realisateur,
                p.date_naissance_personne,
                p.sexe
            FROM personne p
            INNER JOIN
                realisateur r ON r.id_personne = p.id_personne
            WHERE
                r.id_realisateur = :id
        ");
        $requete1->execute([
            "id"=>$id
        ]);

        $requete2 = $pdo->prepare("
            SELECT
                f.titre,
                f.id_film
            FROM
                film f
            INNER JOIN
                realisateur r ON r.id_realisateur = f.id_realisateur
            WHERE
                f.id_realisateur = :id
        ");
        $requete2->execute([
            "id"=>$id
        ]);

        require "view/detailRealisateur.php";
    }

    // Page d'accueil
    public function accueil(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
        SELECT  
            f.id_film, f.titre, TIME_FORMAT(SEC_TO_TIME(f.duree * 60), '%Hh%i') AS temps, 
            CONCAT(SUBSTRING(f.synopsis, 1 , 600),'...') AS synopsis, f.annee_sortie, f.affiche, 
		    GROUP_CONCAT(g.type SEPARATOR ', ') AS genres, CONCAT(p.nom, ' ', p.prenom) AS realisateur,
            f.note
        FROM 
            film f
        INNER JOIN 
            realisateur r ON r.id_realisateur = f.id_realisateur
        INNER JOIN 
            personne p ON p.id_personne = r.id_personne
        INNER JOIN 
            film_genre fg ON fg.id_film = f.id_film
        INNER JOIN 
            genre g ON g.id_genre = fg.id_genre
        GROUP BY 
            f.id_film
        ORDER BY 
            f.annee_sortie DESC
        LIMIT 1

        ");
        require "view/accueil.php";
    }

}