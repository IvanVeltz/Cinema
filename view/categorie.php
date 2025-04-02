<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> catégorie</p>

<div class="container-acteurs">
<?php
foreach($requete->fetchAll() as $categorie){
    ?>
    <div class="card border-primary mb-3">
        <a href="index.php?action=detailFilms&id=<?=$categorie['id_genre']?>">
            <div class="card-header"><?= $categorie['type']?></div>
        </a>
    </div>
    
<?php
    
}
?>
<form action="index.php?action=ajoutCategorie" method="post">
    <div class="input-group mb-3">
        <label for="input-genre">Ajouter un genre</label>
        <input type="text" id="input-genre">
        <button class="btn btn-primary" type="submit" name="submit">Ajouter</button>
    </div>
</form>
<?php

$titre = "Liste des catégorie";
$titre_secondaire = "Liste des catégories";
$contenu = ob_get_clean();
require "view/template.php";
?>