<?php

ob_start();

$genre = [];

?>

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