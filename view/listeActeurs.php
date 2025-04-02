<?php ob_start(); ?>
<!-- Ajout d'un acteur  -->
<form action="index.php?action=ajoutActeur" method="post">
    <div class="input-group mb-3">
        <label for="input-genre">Ajouter un acteur</label>
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