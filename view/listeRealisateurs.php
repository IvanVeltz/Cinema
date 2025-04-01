<?php ob_start(); ?>

<p>Il y a <?= $requete1->rowCount() ?> réalisateurs</p>

<div class="container-realisateurs">
<?php
foreach($requete1->fetchAll() as $realisateur){
    ?>
    <div class="card border-primary mb-3">
        <a href="index.php?action=detailRealisateur&id=<?=$realisateur['id_realisateur']?>">
            <div class="card-header"><?= $realisateur['realisateurs']?></div>
        </a>
    </div>
    
<?php
    
}
?>
</div>
<?php

$titre = "Liste des realisateurs";
$titre_secondaire = "Liste des réalisateurs";
$contenu = ob_get_clean();
require "view/template.php";
?>