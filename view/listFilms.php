<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> films</p>

<table>
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
                    <td><?= $film["annee_sortie"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
    
</table>

<?php 

$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "view/template.php";
