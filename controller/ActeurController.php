<?php

namespace Controller;
use Model\Connect;

class ActeurController{
    // Liste des acteurs
    public function listeActeurs(){
            $pdo = Connect::seConnecter();
            $requete1 = $pdo->query("
            SELECT 
                a.id_acteur, CONCAT(p.nom, ' ', p.prenom) AS acteurs, p.id_personne
            FROM 
                personne p 
            INNER JOIN
                acteur a ON a.id_personne = p.id_personne
            ORDER BY
                acteurs
            ");
            $requete2 = $pdo->query('
            SELECT
                nom_role, id_role
            FROM
                role
            ');
            $requete3 = $pdo->query('
                SELECT
                    id_film, titre
                FROM
                    film
            ');        

            require "view/listeActeurs.php";
    }

    // Detail acteur 
    public function detailActeur($id){

        $pdo = Connect::seConnecter();
        $requete1 = $pdo->prepare("
            SELECT
                CONCAT(p.nom, ' ', p.prenom) AS acteur,
                p.nom,
                p.prenom,
                p.date_naissance_personne,
                p.sexe,
                p.id_personne
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
            $ddn = filter_input(INPUT_POST, "ddn", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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

    // Suppression d'un acteur
    public function supprimeActeur(){
        if (isset($_POST['submit'])){
            $id =  filter_input(INPUT_POST, "idActeur", FILTER_SANITIZE_NUMBER_INT);
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

        header("Location:index.php?action=listeActeurs");
    }

    // Modifier un acteur
    public function modifActeur($id){
        if (isset($_POST['submit'])){
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $ddn = filter_input(INPUT_POST, "ddn", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if($nom&&$prenom&&$sexe&&$ddn){
                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare('
                    UPDATE
                        personne
                    SET
                        nom = :nom,
                        prenom = :prenom,
                        sexe = :sexe,
                        date_naissance_personne = :ddn
                    WHERE
                        id_personne = :id
                ');
                $requete->execute([
                    'nom'=>$nom,
                    'prenom'=>$prenom,
                    'sexe'=>$sexe,
                    'ddn'=>$ddn,
                    'id'=>$id
                ]);
            }
        }

        $requete2 = $pdo->prepare('
            SELECT id_acteur
            FROM acteur
            WHERE id_personne = :id
        ');
        $requete2->execute([
            'id'=>$id
        ]);
        $result = $requete2->fetch();
        $id_acteur = $result['id_acteur'];
        header("Location:index.php?action=detailActeur&id=$id_acteur");
    }
    

    public function ajoutRole(){
        if (isset($_POST['submit'])){
            $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if ($role){
                $pdo = Connect::seConnecter();
                $requete=$pdo->prepare('
                    INSERT INTO role(nom_role)
                    VALUES (:role)
                ');
                $requete->execute([
                    'role'=>$role
                ]);
            }
        }
        header("Location:index.php?action=listeActeurs");
    }

    public function attribuerRole(){
        if (isset($_POST['submit'])){
            $idRole = filter_input(INPUT_POST, "role", FILTER_SANITIZE_NUMBER_INT);
            $idActeur = filter_input(INPUT_POST, "acteur", FILTER_SANITIZE_NUMBER_INT);
            $idFilm = filter_input(INPUT_POST, "film", FILTER_SANITIZE_NUMBER_INT);

            if ($idRole && $idActeur && $idFilm){
                $pdo = Connect::seConnecter();
                $requete=$pdo->prepare('
                    DELETE FROM casting WHERE id_role = :id 
                ');
                $requete->execute([
                    'id'=> $idRole
                ]);

                $requete2=$pdo->prepare('
                    INSERT INTO
                        casting (id_role, id_acteur, id_film)
                    VALUES
                        (:idRole, :idActeur, :idFilm)
                ');
                $requete2->execute([
                    'idRole'=>$idRole,
                    'idActeur'=>$idActeur,
                    'idFilm'=>$idFilm
                ]);
            }
        }
        header("Location:index.php?action=listeActeurs");
    }

    public function supprimerRole(){
        if (isset($_POST['submit'])){
            $idRole = filter_input(INPUT_POST, "supprimerRole", FILTER_SANITIZE_NUMBER_INT);
           if($idRole){
            
            $pdo = Connect::seConnecter();
            $requete=$pdo->prepare('
            DELETE FROM role WHERE id_role = :id 
            ');
            $requete->execute([
                'id'=> $idRole
            ]);
           }
        }
        header("Location:index.php?action=listeActeurs");
    }
}