<?php ob_start(); ?>
<!-- Ajout d'un realisateur  -->
<form action="index.php?action=ajoutRealisateur" method="post">
    <div class="input-group mb-3">
        <label>Ajouter un acteur</label>
    </div>    
    <div>
        <label for="input-nom">Nom :</label>
        <input type="text" id="input-nom" name="nom">
        <label for="input-prenom">Prenom :</label>
        <input type="text" id="input-prenom" name="prenom">
        <label for="select-sexe">Sexe :</label>
        <select id="select-sexe" name="sexe">
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
        </select>
        <label for="input-ddn">Date de naissance :</label>
        <input type="date" id="input-ddn" name="ddn">
        <input class="btn btn-primary" type="submit" name="submit">Ajouter</input>
    </div>
    </div>
</form>

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