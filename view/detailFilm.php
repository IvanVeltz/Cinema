<?php

ob_start();

$film = $requete1->fetch();

?>

<section class="container-film">
    <div class="card border-primary mb-3">
        <div class="card-header"><?= $film["titre"]?></div>
        <div class="card-body container-film-moment">
            <aside>
                <p> Realisateur :<br> <a href="index.php?action=detailRealisateur&id=<?=$film['id_realisateur']?>"><?= $film['realisateur'] ?></a></p>
                <p>Sortie en <?= $film["annee_sortie"] ?></p>
                <p>Genre :<br>
                    <?php foreach($requete3->fetchAll() as $genre){
                    ?>
                    <a href="index.php?action=listeFilms&id=<?=$genre['id_genre']?>"><?=$genre['type']?></a>
                    <?php
                };
                ?>
                </p>
                <p>Durée : <?= $film["temps"] ?></p>
                <p>Note : <?= $film["note"]?>/5</p>
                <p>Acteur :<br>
                <?php foreach($requete2->fetchAll() as $acteur){
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

<?php

$titre = $film['titre'];
$titre_secondaire = "";
$contenu = ob_get_clean();
require "view/template.php";