<?php

ob_start();

$genre = [];

$film = $requete->fetch() ;


?>

<section class="container-film">
        
                <a href="index.php?action=detailFilm&id=<?=$film['id_film']?>">
                    <div class="card border-primary mb-3">
                        <div class="card-header"><?= $film["titre"]?></div>
                        <div class="card-body container-film-moment">
                            <aside>
                                <p> Realisateur : <?= $film['realisateur'] ?></p>
                                <p>Sortie en <?= $film["annee_sortie"] ?></p>
                                <p>Genre : <?= $film["genres"]?></p>
                                <p>Durée : <?= $film["temps"] ?></p>
                                <p>Note : <?= $film["note"]?>/5</p>
                            </aside>
                            <article>
                                <p class="synopsis">Synopsis : <?= $film['synopsis']?></p>
                            </article>
                            <figure>
                                <img src="<?= $film['affiche'] ?>" alt="affiche du film">
                            </figure>
                        </div>
                    </div>
                </a>
</section>


<?php
$titre = "Accueil";
$titre_secondaire = "Film du moment";
$contenu = ob_get_clean();
require "view/template.php";