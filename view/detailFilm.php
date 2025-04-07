<?php

ob_start();

$film = $requete1->fetch();
$acteurs = $requete2->fetchAll();
$genresFilm = $requete3->fetchAll();
$tousGenres = $requete4->fetchAll();
$realisateurs = $requete5->fetchAll();

?>

<section class="container-film">
    <div class="card border-primary mb-3">
        <div class="card-header"><?= $film["titre"]?></div>
        <div class="card-body container-film-moment">
            <aside>
                <p> Realisateur :<br> <a href="index.php?action=detailRealisateur&id=<?=$film['id_realisateur']?>"><?= $film['realisateur'] ?></a></p>
                <p>Sortie en <?= $film["annee_sortie"] ?></p>
                <p>Genre :<br>
                    <?php foreach($genresFilm as $genre){
                    ?>
                    <a href="index.php?action=listeFilms&id=<?=$genre['id_genre']?>"><?=$genre['type']?></a>
                    <?php
                };
                ?>
                </p>
                <p>Durée : <?= $film["temps"] ?></p>
                <p>Note : <?= $film["note"]?>/5</p>
                <p>Acteur :<br>
                <?php foreach($acteurs as $acteur){
                    ?>
                    <a href="index.php?action=detailActeur&id=<?=$acteur['id_acteur']?>">
                    <?= $acteur['acteurs']." (".$acteur['nom_role'].")<br>"?>
                <?php
                };
                ?>
                    </a>
                </p>
            </aside>
            <article>
                <p class="synopsis">Synopsis : <?= $film['synopsis']?></p>
            </article>
            <figure>
                <img src="<?= $film['affiche'] ?>" alt="affiche du film">
            </figure>
        </div>
    </div>
</section>
<!-- Bouton pour afficher le formulaire -->
<button id="gestion">Modifier</button>

<form action="index.php?action=modifFilm&id=<?=$film['id_film']?>" method="post" id="container-form" style="display : none;">
            
            <div>
                <label for="input-titre">Titre du Film</label>
                <input type="text" id="input-titre" name="titre" value="<?=$film['titre']?>">
                <label for="input-annee">Année de sortie</label>
                <input type="text" id="input-annee" name="annee" value="<?=$film['annee_sortie']?>">
                <label for="input-duree">Durée (en min)</label>
                <input type="text" id="input-duree" name="duree"value="<?=$film['duree']?>">
                <label for="input-synopsis">Synopsis</label>
                <textarea name="synopsis" id="synopsis" cols="50" rows="4"><?=$film['synopsis']?></textarea>
                <label for="input-note">Note /5</label>
                <select name="note" id="input-note">">
                    <?php for($i=1;$i<=5; $i++){
                        if($film['note'] == $i){
                            echo "<option value='$i' selected>$i</option>";
                        } else {
                            echo "<option value='$i'>$i</option>";
                        }
                    }
                    ?>
                </select>
                <fieldset>
                    <label>Quel(s) categorie(s) :</label>
                    <div class="grid-genre">
                    <?php
                        foreach ($tousGenres as $genre) {
                            if (in_array($genre['id_genre'], array_column($genresFilm, 'id_genre'))) {
                                echo "<label><input type='checkbox' name='categories[]' value='" . $genre['id_genre'] . "' checked>" . $genre['type'] . "</label>";
                            } else {
                                echo "<label><input type='checkbox' name='categories[]' value='" . $genre['id_genre'] . "'>" . $genre['type'] . "</label>";
                            }
                        }
                    ?>
                    </div>
                </fieldset>
                <label for="input-realisateur">Réalisateur : </label>
                <select name="realisateur" id="input-realisateur">
                    <?php foreach($realisateurs as $realisateur){
                        if($realisateur['id_realisateur'] == $film['id_realisateur']){
                            echo "<option value='".$realisateur['id_realisateur'].
                            "' selected>".$realisateur['id_realisateur']. " - ".$realisateur['realisateurs']."</option>";
                        } else {
                            echo "<option value='".$realisateur['id_realisateur'].
                            "'>".$realisateur['id_realisateur']. " - ".$realisateur['realisateurs']."</option>";
                        }
                    }
                    ?>
                </select>

                <input class="btn btn-primary" type="submit" name="submit"></input>
                <button class="btn btn-primary" type="button" id="btnAnnuler">Annuler</button>

            </div>
        </form>

<?php

$titre = $film['titre'];
$titre_secondaire = "";
$contenu = ob_get_clean();
require "view/template.php";