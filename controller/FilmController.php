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
        ORDER BY
            f.annee_sortie DESC
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

        $requete4 = $pdo->query("
        SELECT  
            f.id_film, f.titre
        FROM
            film f
        ");
        
        require "view/accueil.php";
    }
    
    
    // Détail Film
    public function detailFilm($id){

        $pdo = Connect::seConnecter();
        $requete1 = $pdo->prepare("
            SELECT 
                f.id_film, f.titre,f.duree, TIME_FORMAT(SEC_TO_TIME(f.duree * 60), '%Hh%i') AS temps, 
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

        $requete4 = $pdo->query('
            SELECT id_genre, type
            FROM genre
        ');

        $requete5 = $pdo->query('
            SELECT 
                r.id_realisateur,
                CONCAT(p.nom, " ", p.prenom) as realisateurs
            FROM
                realisateur r
            INNER JOIN
                personne p ON P.id_personne = r.id_personne
            
        ');


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

    // Supprimer film
    public function supprimeFilm(){

        if (isset($_POST['submit'])){
            $id =  filter_input(INPUT_POST, "idFilm", FILTER_SANITIZE_NUMBER_INT);
            if($id){
                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare('
                DELETE FROM film
                WHERE id_film = :id
                ');
                $requete->execute([
                    'id'=>$id
                ]);
            }
        }
    
        header("Location:index.php?action=accueil");
    }

    // Modifier un film
    public function modifFilm($id){
        if(isset($_POST['submit'])){
            // On récupère les infos du films
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $annee = filter_input(INPUT_POST, "annee", FILTER_SANITIZE_NUMBER_INT);
            $duree = filter_input(INPUT_POST, "duree", FILTER_SANITIZE_NUMBER_INT);
            $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $note = filter_input(INPUT_POST, "note", FILTER_SANITIZE_NUMBER_INT);
            $idRealisateur = filter_input(INPUT_POST, "realisateur", FILTER_SANITIZE_NUMBER_INT);

            // On récupère les genres cochés
            $categories = filter_input(INPUT_POST, 'categories', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                                   

            // On ajoute le film si toutes les données sont correctes
            if($titre && $annee && $duree && $synopsis && $note && $idRealisateur){
                $affiche = "public/img/$titre.png";
                
                $pdo = Connect::seConnecter();
                                
                $requete = $pdo->prepare('
                    UPDATE 
                        film
                    SET 
                        titre = :titre, 
                        annee_sortie = :annee,
                        duree = :duree,
                        synopsis = :synopsis,
                        note = :note,
                        id_realisateur = :id_realisateur
                    WHERE
                        id_film = :id_film
                
                ');
                $requete->execute([
                    'titre'=>$titre,
                    'annee'=>$annee,
                    'duree'=>$duree,
                    'synopsis'=>$synopsis,
                    'note'=> $note,
                    'id_realisateur'=>$idRealisateur,
                    'id_film'=>$id
                ]);
                

                $requete3 = $pdo->prepare('
                    DELETE FROM film_genre WHERE id_film = :id
                ');
                $requete3->execute([
                    'id'=>$id
                ]);
                

                if(!empty($categories) && is_array($categories)){
                    foreach($categories as $categorie){
                         $requete2 = $pdo->prepare('
                         INSERT INTO film_genre (id_film, id_genre)
                         VALUES (:id_film, :id_genre)
                         ');
                         $requete2->execute([
                             'id_film'=>$id,
                             'id_genre'=>$categorie
                         ]);
                     }
                }
            }
        }

        header("Location:index.php?action=detailFilm&id=$id");
    }
        
    
}