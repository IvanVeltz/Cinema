<?php ob_start(); ?>

<div class="container-main">
<!-- Ajout d'une catégorie  -->
<form action="index.php?action=ajoutCategorie" method="post">
    <div class="input-group mb-3">
        <label for="input-genre">Ajouter une catégorie</label>
    </div>
    <div>
        <input type="text" id="input-genre" name="nom_categorie">
        <input class="btn btn-primary" type="submit" name="submit">Ajouter</input>
    </div>
    
</form>

<div class="container-acteurs">
<?php
foreach($requete->fetchAll() as $categorie){
    ?>
    <div class="card border-primary mb-3">
        <a href="index.php?action=detailFilms&id=<?=$categorie['id_genre']?>">
            <?= $categorie['type']?>
        </a>
    </div>
    
<?php
    
}
?>
</div>
<?php

$titre = "Liste des catégorie";
$titre_secondaire = "Liste des catégories";
$contenu = ob_get_clean();
require "view/template.php";
?>