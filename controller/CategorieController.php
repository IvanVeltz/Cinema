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

        require "view/categorie.php";
    }

    // Ajouter une catégorie
    public function ajoutCategorie(){
        if (isset($_POST['submit'])){
            $categorie = htmlspecialchars($_POST['submit']); 
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare('
                INSERT INTO genre (type)
                VALUES (:type)
            ');
            $requete->execute([
                'type'=>$categorie
            ]);
        }

        header("Location:index.php?action=categorie");
    }
}