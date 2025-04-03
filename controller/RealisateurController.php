<?php

namespace Controller;
use Model\Connect;

class RealisateurController{
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

        $requete2 = $pdo->query("
        SELECT 
            r.id_realisateur, CONCAT(p.nom, ' ', p.prenom) AS realisateurs, p.id_personne
        FROM 
            personne p 
        INNER JOIN
            realisateur r ON r.id_personne = p.id_personne
        
        ");
           

        require "view/listeRealisateurs.php";
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
                f.id_film,
                f.annee_sortie
            FROM
                film f
            INNER JOIN
                realisateur r ON r.id_realisateur = f.id_realisateur
            WHERE
                f.id_realisateur = :id
            ORDER BY
                f.annee_sortie DESC
        ");
        $requete2->execute([
            "id"=>$id
        ]);

        require "view/detailRealisateur.php";
    }

    // Ajout realisateur
    public function ajoutRealisateur(){
        if (isset($_POST['submit'])){
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $ddn = filter_input(INPUT_POST, "ddn", FILTER_SANITIZE_STRING);
            if($nom&&$prenom&&$sexe&&$ddn){

                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare('
                INSERT INTO personne (nom, prenom, sexe, date_naissance_personne)
                VALUES (:nom, :prenom, :sexe, :ddn)
                ');
                $requete->execute([
                    'nom'=>$nom,
                    'prenom'=>$prenom,
                    'sexe'=>$sexe,
                    'ddn'=>$ddn
                ]);
                $idPersonne = $pdo->lastInsertId();
                $requete2 = $pdo->prepare('
                INSERT INTO realisateur (id_personne)
                VALUES (:id_personne)
                ');
                $requete2->execute([
                    'id_personne'=>$idPersonne
                ]);
            }
        }

        header("Location:index.php?action=listeRealisateurs");
    }

    // Suppression d'un realisateur
    public function supprimeRealisateur(){

        if (isset($_POST['submit'])){
            $id =  filter_input(INPUT_POST, "idRealisateur", FILTER_SANITIZE_NUMBER_INT);
            if($id){
                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare('
                DELETE FROM personne
                WHERE id_personne = :id
                ');
                $requete->execute([
                    'id'=>$id
                ]);
            }
        }

        header("Location:index.php?action=listeRealisateurs");
    }
    
    
}