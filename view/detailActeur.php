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

<?php

$titre = $acteur['acteur'];
$titre_secondaire = "";
$contenu = ob_get_clean();
require "view/template.php";