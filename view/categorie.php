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
</div>
<form action=""></form>
<?php

$titre = "Liste des catégorie";
$titre_secondaire = "Liste des catégories";
$contenu = ob_get_clean();
require "view/template.php";
?>