<?php

namespace Controller;
use Model\Connect;

class ActeurController{
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
                f.id_film,
                r.nom_role
            FROM
                film f
            INNER JOIN
                casting c ON c.id_film = f.id_film
            INNER JOIN
                acteur a ON a.id_acteur = c.id_acteur
            INNER JOIN 
                role r ON r.id_role = c.id_role
            WHERE
                a.id_acteur = :id
        ");
        $requete2->execute([
            "id"=>$id
        ]);


        require "view/detailActeur.php";

    }

    // Ajout acteur
    public function ajoutActeur(){
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
                INSERT INTO acteur (id_personne)
                VALUES (:id_personne)
                ');
                $requete2->execute([
                    'id_personne'=>$idPersonne
                ]);
            }
        }

        header("Location:index.php?action=listeActeurs");
    }
    
}