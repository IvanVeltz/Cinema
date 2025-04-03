<?php ob_start(); ?>




<p>Il y a <?= $requete->rowCount() ?> films</p>

<div class="container-films">
<?php
foreach($requete->fetchAll() as $film){
    ?>
    <div class="card border-primary mb-3">
        <a href="index.php?action=detailFilm&id=<?=$film['id_film'] ?>">
            <?= $film['titre']?>
        </a>
    </div>
    
<?php
    
}
?>
</div>
        
    

<?php 

$titre = "Liste des films";
$titre_secondaire = $requete2->fetch()['type'];
$contenu = ob_get_clean();
require "view/template.php";
