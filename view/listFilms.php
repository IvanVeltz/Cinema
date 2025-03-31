<?php ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> films</p>

<table class="uk-label uk-table-striped">
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $film) { ?>
                <tr>
                    <td><?= $film["titre"] ?></td>
                    <td><?= $film["anne_sortie"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
    
</table>

<?php 

$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "view/template.php"

// temporisation de sortie
// Design pattern MVC dans mon appli