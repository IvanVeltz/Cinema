<?php

ob_start();

$genre = [];

?>

<!-- Ajout d'un film  -->
<form action="index.php?action=ajoutFilm" method="post">
    <div class="input-group mb-3">
        <label>Ajouter un film</label>
    </div>
    <div>
        <label for="input-titre">Titre du Film</label>
        <input type="text" id="input-titre" name="titre">
        <label for="input-annee">Année de sortie</label>
        <input type="text" id="input-annee" name="annee">
        <label for="input-duree">Durée (en min)</label>
        <input type="text" id="input-duree" name="duree">
        <label for="input-synopsis">Synopsis</label>
        <input type="text" id="input-synopsis" name="synopsis">
        <label for="input-note">Note /5</label>
        <select name="note" id="input-note">
            <?php for($i=0;$i<=5; $i++){
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>
        <fieldset>
            <label>Quel(s) categorie(s) :</label>
            <div class="grid-genre">
            <?php
                foreach($requete2->fetchAll() as $genre){
                    echo "<label><input type='checkbox' name='categorie[]' value='" . $genre['id_genre'] . "'>"
                        . $genre['type'] . "</label>";
                }
            ?>
            </div>
        </fieldset>
        <label for="input-realisateur">Réalisateur : </label>
        <select name="realisateur" id="input-realisateur">
            <?php foreach($requete3->fetchAll() as $realisteur){
                echo "<option value='".$realisteur['id_realisateur'].
                "'>".$realisteur['realisateur']."</option>";
            }
            ?>
        </select>

        <input class="btn btn-primary" type="submit" name="submit"></input>
    </div>
</form>

<div class="container-films">
<?php
foreach($requete->fetchAll() as $film){
    ?>
    <div class="card border-primary mb-3">
        <a href="index.php?action=detailFilm&id=<?=$film['id_film'] ?>">
            <div class="card-header"><?= $film['titre']?></div>
        </a>
    </div>
    
<?php
    
}
?>
</div>


<?php
$titre = "Accueil";
$titre_secondaire = "Film du moment";
$contenu = ob_get_clean();
require "view/template.php";