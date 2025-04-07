<?php ob_start(); ?>

<div class="container-main">
    <div class="container-films">
        <h3>Liste des catégories</h3>
        <div>
        <?php
        foreach($requete->fetchAll() as $categorie){
        ?>
            <div class="card card-acteur border-primary mb-3">
                <a href="index.php?action=listeFilms&id=<?=$categorie['id_genre']?>">
                    <?= $categorie['type']?>
                </a>
            </div>
            
        <?php 
        }
        ?>
        </div>
    </div>
    <button id="gestion" class="btn btn-outline-primary">Gestion Catégorie</button>
    <div class="container-form" id="container-form" style="display: none;">
        <!-- Ajout d'une catégorie  -->
        <form action="index.php?action=ajoutCategorie" method="post">
            <div class="input-group mb-3">
                <label for="input-genre">Ajouter une catégorie</label>
            </div>
            <div>
                <input type="text" id="input-genre" name="nom_categorie">
                <input class="btn btn-primary" type="submit" name="submit"></input>
            </div>
            
        </form>
        <!-- Suppresion catégorie -->
        <form action="index.php?action=supprimeCategorie" method="post">
            <div class="input-group mb-3">
                <label>Supprimer une catégorie</label>
            </div>
            <div>
                <label for="select-categorie"></label>
                <select id="select-categorie" name="idCategorie">
                    <?php 
                    foreach($requete2->fetchAll() as $categorie){
                        echo "<option value='".$categorie['id_genre']."'>
                                ".$categorie['id_genre']." - ".$categorie['type']."</option>";
                    }
                    ?>
                </select>
                <input class="btn btn-primary" type="submit" name="submit"></input>
            </div>
        </form>
        <button class="btn btn-primary" type="button" id="btnAnnuler">Annuler</button>
    </div>
</div>
<script src="public/js/scriptActeur.js"></script>
<?php

$titre = "Liste des catégorie";
$titre_secondaire = "";
$contenu = ob_get_clean();
require "view/template.php";
?>