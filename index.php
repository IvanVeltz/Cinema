<?php

use Controller\CategorieController;
use Controller\ActeurController;
use Controller\FilmController;
use Controller\RealisateurController;

spl_autoload_register(function ($class_name) {
    include $class_name.'.php';
});


$ctrlActeur = new ActeurController();
$ctrlFilm = new FilmController();
$ctrlRealisateur = new RealisateurController();
$ctrlCategorie = new CategorieController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET['action'])){
    switch ($_GET['action']) {
        
        case "listeFilms" : $ctrlFilm->listeFilms($id); break;
        case "detailFilm" : $ctrlFilm->detailFilm($id); break;
        case "ajoutFilm" : $ctrlFilm->ajoutFilm(); break;
        case "listeActeurs" : $ctrlActeur->listeActeurs(); break;
        case "detailActeur" : $ctrlActeur->detailActeur($id); break;
        case "ajoutActeur" : $ctrlActeur->ajoutActeur(); break;
        case "listeRealisateurs" : $ctrlRealisateur->listeRealisateurs(); break;
        case "detailRealisateur" : $ctrlRealisateur->detailRealisateur($id); break;
        case "ajoutRealisateur" : $ctrlRealisateur->ajoutRealisateur(); break;
        case "supprimeRealisateur" : $ctrlRealisateur->supprimeRealisateur(); break;
        case "categorie" : $ctrlCategorie->categorie(); break;
        case "ajoutCategorie" : $ctrlCategorie->ajoutCategorie(); break;

        default: $ctrlFilm->accueil();
    }
} else {
    $ctrlFilm->accueil();
}




// temporisation de sortie : Une mise en mémoire de la sortie, tant que la temporisation est active (ob_start), aucune sortie n'est envoyé par le script
// au navigateur, pour envoyer la sortie il faut juste la recupérer (ob_get), il est courant de la nettoyer tout de suite, dans ce cas 
// on utilise (ob_get_clean)

// Design pattern MVC dans mon appli
// L'index intercepte la requete http, et verifier si une route correspond à cette demande. 
// Si c'est le cas on l'envoi vers la methode de controlleur corrsepondante
// Le controlleur va traiter la demande http, et fait le lien entre la couche modele et la couche vue, 
// si besoin il fait une demande a la couche model, la couche
// modele lui renverra les données, et le controlleur renverra sous forme de variables ces données à la vue
// La couche model s'ccoupe de la logique metier, tout ce qui a un rapport avec le données.
// La couche vue, gère l'affichage du site