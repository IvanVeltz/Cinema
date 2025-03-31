<?php 

$titre = "Accueil";
$titre_secondaire = "Page d'accueil";
?>

<a href="index.php?action=listFilms">Voir la liste des films</a>

<?php
$contenu = ob_get_clean();
require "view/template.php";