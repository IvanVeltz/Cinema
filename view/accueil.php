<?php 

$titre = "Accueil";
$titre_secondaire = "Page d'accueil";

$contenu = ob_get_clean();
require "view/template.php";