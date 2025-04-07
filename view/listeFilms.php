<?php ob_start(); ?>


<div class="container-main">
    <div class="container-films">
        <div>
        <?php
        foreach($requete->fetchAll() as $film){
            ?>
            <div class="card card-film border-primary mb-3">
                <a href="index.php?action=detailFilm&id=<?=$film['id_film'] ?>">
                    <?= $film['titre']?>
                    <div class="card-body card-affiche">
                        <figure>
                            <img src="<?=$film['affiche']?>" alt="Affiche du film">
                        </figure>
                    </div>
                </a>
            </div>
            
        <?php
        }
        ?>
        </div>
    </div>
</div>
        
    

<?php 

$titre = "Liste des films";
$titre_secondaire = $requete2->fetch()['type'];
$contenu = ob_get_clean();
require "view/template.php";
