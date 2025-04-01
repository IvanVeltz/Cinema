<?php ob_start(); ?>

<p>Il y a <?= $requete1->rowCount() ?> acteurs</p>

<div class="container-acteurs">
<?php
foreach($requete1->fetchAll() as $acteur){
    ?>
    <div class="card border-primary mb-3">
        <a href="index.php?action=detailActeur&id=<?=$acteur['id_acteur']?>">
            <div class="card-header"><?= $acteur['acteurs']?></div>
        </a>
    </div>
    
<?php
    
}
?>
</div>
<?php

$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();
require "view/template.php";
?>