<?php

namespace Controller;
use Model\Connect;

class CategorieController{

    // Lister les catégories
    public function categorie(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT id_genre, type
            FROM genre
            ORDER BY type
        ");
        $requete2 = $pdo->query("
            SELECT id_genre, type
            FROM genre
        ");

        require "view/categorie.php";
    }

    public function detailCategorie($id){

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT 
                f.id_film, f.titre
            FROM
                film f
            INNER JOIN
                film_genre fg ON fg.id_film = f.id_film
            WHERE 
                fg.id_genre = :id
        ");
        $requete->execute([
            "id"=>$id
        ]);

        $requete2 = $pdo->prepare("
            SELECT
                g.type
            FROM
                genre g
            WHERE
                g.id_genre = :id
        ");
        $requete2->execute([
            "id"=>$id
        ]);

        require "view/detailCategorie.php";

    }

    // Ajouter une catégorie
    public function ajoutCategorie(){
        if (isset($_POST['submit'])){
            $categorie = filter_input(INPUT_POST, "nom_categorie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if($categorie){
                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare('
                    INSERT INTO genre (type)
                    VALUES (:type)
                ');
                $requete->execute([
                    'type'=>$categorie
                ]);
            }
        }

        header("Location:index.php?action=categorie");
    }

    // Supprimer film
    public function supprimeCategorie(){

        if (isset($_POST['submit'])){
            $id =  filter_input(INPUT_POST, "idCategorie", FILTER_SANITIZE_NUMBER_INT);
            if($id){
                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare('
                DELETE FROM genre
                WHERE id_genre = :id
                ');
                $requete->execute([
                    'id'=>$id
                ]);
            }
        }
    
        header("Location:index.php?action=categorie");
    }
}