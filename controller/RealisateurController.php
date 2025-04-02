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
    
}