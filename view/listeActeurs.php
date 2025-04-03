<?php ob_start(); ?>
<!-- Ajout d'un acteur  -->
<div class="container-main">
    <div class="container-form">
        <form action="index.php?action=ajoutActeur" method="post">
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
                <input class="btn btn-primary" type="submit" name="submit">
            </div>
        </form>
        <form action="index.php?action=supprimeActeur" method="post">
            <div class="input-group mb-3">
                <label>Supprimer un acteur</label>
            </div>
            <div>
                <label for="select-acteur"></label>
                <select id="select-acteur" name="idActeur">
                    <?php 
                    foreach($requete2->fetchAll() as $realisateur){
                        echo "<option value='".$realisateur['id_personne']."'>
                                ".$realisateur['id_acteur']." - ".$realisateur['acteurs']."</option>";
                    }
                    ?>
                </select>
                <input class="btn btn-primary" type="submit" name="submit"></input>
            </div>
        </form>
    </div>

<div class="container-acteurs">
<?php
foreach($requete1->fetchAll() as $acteur){
    ?>
    <div class="card border-primary mb-3">
        <a href="index.php?action=detailActeur&id=<?=$acteur['id_acteur']?>">
            <?= $acteur['acteurs']?>
        </a>
    </div>
    
<?php
    
}
?>
</div>
</div>
<?php

$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();
require "view/template.php";
?>