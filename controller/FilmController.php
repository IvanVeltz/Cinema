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

        $requete2 = $pdo->query('
            SELECT id_genre, type
            FROM genre
        ');

        $requete3 = $pdo->query('
            SELECT
                CONCAT(r.id_realisateur," ",p.nom," ",p.prenom) AS realisateur,
                r.id_realisateur
            FROM
                personne p
            INNER JOIN
                realisateur r WHERE r.id_personne = p.id_personne
        ');
        
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

    // AJouter Film
    public function ajoutFilm(){
        if(isset($_POST['submit'])){
            // On récupère les infos du films
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $annee = filter_input(INPUT_POST, "annee", FILTER_SANITIZE_NUMBER_INT);
            $duree = filter_input(INPUT_POST, "duree", FILTER_SANITIZE_NUMBER_INT);
            $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $note = filter_input(INPUT_POST, "note", FILTER_SANITIZE_NUMBER_INT);
            $idRealisateur = filter_input(INPUT_POST, "realisateur", FILTER_SANITIZE_NUMBER_INT);

            // On récupère les genres cochés
            $categories = filter_input(INPUT_POST, 'categorie', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                                   

            // On ajoute le film si toutes les données sont correctes
            if($titre && $annee && $duree && $synopsis && $note && $idRealisateur){
                $affiche = "public/img/$titre.png";
                
                $pdo = Connect::seConnecter();
                                
                $requete = $pdo->prepare('
                    INSERT INTO
                        film (titre, annee_sortie, duree, synopsis, note, affiche, id_realisateur)
                    VALUES (:titre, :annee, :duree, :synopsis, :note, :affiche, :id_realisateur)
                
                ');
                $requete->execute([
                    'titre'=>$titre,
                    'annee'=>$annee,
                    'duree'=>$duree,
                    'synopsis'=>$synopsis,
                    'note'=> $note,
                    'affiche'=> $affiche,
                    'id_realisateur'=>$idRealisateur
                ]);
            

                $idFilm = $pdo->lastInsertId();    

                if(!empty($categories)){
                    foreach($categories as $categorie){
                        $requete2 = $pdo->prepare('
                        INSERT INTO film_genre (id_film, id_genre)
                        VALUES (:id_film, :id_genre)
                        ');
                        $requete2->execute([
                            'id_film'=>$idFilm,
                            'id_genre'=>$categorie
                        ]);
                    }
                }
            }
        }
        header("Location:index.php?action=accueil");

        
    }
}