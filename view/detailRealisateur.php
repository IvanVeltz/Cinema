<?php

ob_start();

$realisateur = $requete1->fetch();
$date = date("d/m/Y", strtotime($realisateur['date_naissance_personne']));

?>
<section class="container-acteur">
    <div class="card border-primary mb-3" style="max-width: 20rem;">
    <div class="card-header"><?=$realisateur['realisateur'];?></div>
    <div class="card-body acteur">
        <p>Date de naissance : <?=$date?></p>
        <p>Sexe : <?=$realisateur['sexe']?></p>
        <p>Films :</p>
        <ul>
            <?php foreach($requete2->fetchAll() as $film){
                ?>
                    <li>
                        <a href="index.php?action=detailFilm&id=<?=$film['id_film']?>">
                            <?=$film['titre'].' - '.$film['annee_sortie'] ?>
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

$titre = $realisateur['realisateur'];
$titre_secondaire = "";
$contenu = ob_get_clean();
require "view/template.php";