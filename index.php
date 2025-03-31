<?php

use Controller\CinemaController;

spl_autoload_register(function ($class_name) {
    include $class_name.'.php';
});

$ctrlCinema = new CinemaController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET['action'])){
    switch ($_GET['action']) {
        
        case "listFilms" : $ctrlCinema->listFilms(); break;

        default: $ctrlCinema->accueil();
    }
} else {
    $ctrlCinema->accueil();
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