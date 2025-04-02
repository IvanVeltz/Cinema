<?php 

namespace Controller;
use Model\Connect;

class FilmController{

    // Page d'accueil
    public function accueil(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
        SELECT  
            f.id_film, f.titre
        FROM
            film f
        LIMIT 5
        ");

        
        require "view/accueil.php";
    }
    
    // Lister les films 
    public function listeFilms($id) {

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
            "id"=>$id
        ]);

        $requete2 = $pdo->prepare("
            SELECT
                type
            FROM
                genre
            WHERE id_genre = :id
        ");
        $requete2->execute([
            "id"=>$id
        ]);


        require "view/listeFilms.php";
    }

    // Détail Film
    public function detailFilm($id){

        $pdo = Connect::seConnecter();
        $requete1 = $pdo->prepare("
            SELECT 
                f.id_film, f.titre, TIME_FORMAT(SEC_TO_TIME(f.duree * 60), '%Hh%i') AS temps, 
                CONCAT(SUBSTRING(f.synopsis, 1 , 600),'...') AS synopsis, f.annee_sortie, f.affiche,
                CONCAT(p.nom, ' ', p.prenom) AS realisateur,
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
                a.id_acteur,
                r.nom_role
            FROM
                acteur a
            INNER JOIN 
                personne p ON p.id_personne = a.id_personne 
            INNER JOIN
                casting c ON c.id_acteur = a.id_acteur
            INNER JOIN
                role r ON r.id_role = c.id_role
            WHERE
                c.id_film = :id
            ORDER BY acteurs
        ");
        $requete2->execute([
            "id"=>$id
        ]);

        $requete3 = $pdo->prepare("
            SELECT
                fg.id_film,
                fg.id_genre,
                g.type
            FROM
                film_genre fg
            INNER JOIN
                genre g ON g.id_genre = fg.id_genre
            WHERE
                fg.id_film = :id
        ");
        $requete3->execute([
            "id"=>$id
        ]);

        require "view/detailFilm.php";
    }
}