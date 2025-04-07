<?php

ob_start();

$acteur = $requete1->fetch();
$date = date("d/m/Y", strtotime($acteur['date_naissance_personne']));

?>
<section class="container-acteur">
    <div class="card card-acteur border-primary mb-3" style="max-width: 20rem;">
    <div class="card-header"><?=$acteur['acteur']?></div>
    <div class="card-body acteur">
        <p>Date de naissance : <?=$date?></p>
        <p>Sexe : <?=$acteur['sexe']?></p>
        <p>Films :</p>
        <ul>
            <?php foreach($requete2->fetchAll() as $film){
                ?>
                    <li>
                        <a href="index.php?action=detailFilm&id=<?=$film['id_film']?>">
                            <?=$film['titre']." : ".$film['nom_role'] ?>
                        </a>
                    </li>
                <?php
            }
            ?>
        </ul>
    </div>
    </div>
</section>

<button id="gestion">Modifier</button>

<form action="index.php?action=modifActeur&id=<?=$acteur['id_personne']?>" method="post" id="container-form" style="display : none;">
            
            <div>
                <label for="input-titre">Nom</label>
                <input type="text" id="input-nom" name="nom" value="<?=$acteur['nom']?>">
                <label for="input-prenom">Prénom</label>
                <input type="text" id="input-prenom" name="prenom" value="<?=$acteur['prenom']?>">
                <label for="input-sexe">Sexe</label>
                <select id="select-sexe" name="sexe">
                    <?php 
                    if($acteur['sexe'] == 'Homme'){?>
                        <option value="Homme" selected>Homme</option>
                        <option value="Femme">Femme</option>
                    <?php
                    } else {
                        ?>
                        <option value="Homme">Homme</option>
                        <option value="Femme" selected>Femme</option>
                    <?php
                    }
                    ?>
                </select>
                <label for="input-ddn">Date de naissance :</label>
                <input type="date" id="input-ddn" name="ddn" value="<?=$acteur['date_naissance_personne']?>">
                <input class="btn btn-primary" type="submit" name="submit"></input>
                <button class="btn btn-primary" type="button" id="btnAnnuler">Annuler</button>

            </div>
</form>

<?php

$titre = $acteur['acteur'];
$titre_secondaire = "";
$contenu = ob_get_clean();
require "view/template.php";