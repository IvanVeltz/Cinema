<?php

ob_start();

$genre = [];

$films = $requete->fetchAll() ;
foreach ($films as $film){
    array_push($genre, $film['type']);
};
$film = $films[0]; 

?>

<section class="filmMoment">
        
                <a href="index.php?action=detailFilm&id=<?=$film['id_film']?>">
                <h3><?= $film["titre"]?></h3>
                <div class="container-film-moment">
                    <aside>
                        <p> Realisateur : <?= $film['realisateur'] ?></p>
                        <p>Sortie en <?= $film["annee_sortie"] ?></p>
                        <p>Genre : <?php for ($i=0; $i<count($genre); $i++){
                            echo "$genre[$i] ";
                        } ?></p>
                    </aside>
                    <article>
                        <p class="synopsis">Synopsis : <?= $film['synopsis']?></p>
                    </article>
                    <figure>
                        <img src="<?= $film['affiche'] ?>" alt="affiche du film">
                    </figure>
                </div>
                </a>
</section>


<?php
$titre = "Accueil";
$titre_secondaire = "Film du moment";
$contenu = ob_get_clean();
require "view/template.php";