<?php

ob_start();

$film = $requete1->fetch();

?>

<section class="container-film">
    <div class="card border-primary mb-3">
        <div class="card-header"><?= $film["titre"]?></div>
        <div class="card-body container-film-moment">
            <aside>
                <p> Realisateur : <a href="index.php?action=detailRealisateur&id=<?=$film['id_realisateur']?>"><?= $film['realisateur'] ?></a></p>
                <p>Sortie en <?= $film["annee_sortie"] ?></p>
                <p>Genre : <?= $film["genres"]?></p>
                <p>Durée : <?= $film["temps"] ?></p>
                <p>Note : <?= $film["note"]?>/5</p>
                <p>Acteur :
                <?php foreach($requete2->fetchAll() as $acteur){
                    ?>
                    <a href="index.php?action=detailActeur&id=<?=$acteur['id_acteur']?>">
                    <?= $acteur['acteurs']." ";
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

<?php

$titre = $film['titre'];
$titre_secondaire = "";
$contenu = ob_get_clean();
require "view/template.php";