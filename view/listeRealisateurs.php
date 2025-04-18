<?php ob_start(); ?>
<div class="container-main">
<!-- Ajout d'un realisateur  -->
    <div class="container-films">
        <h3>Liste des réalisateurs</h3>
        <div>
        <?php
        foreach($requete1->fetchAll() as $realisateur){
            ?>
            <a href="index.php?action=detailRealisateur&id=<?=$realisateur['id_realisateur']?>">
                <div class="card card-acteur border-primary mb-3">
                    <p><?= $realisateur['realisateurs']?></p>
                </div>
            </a>
            
        <?php
            
        }
        ?>
        </div>
    </div>
    <button id="gestion" class="btn btn-outline-primary">Gestion Réalisateur</button>
    
    <div class="container-form" id="container-form" style="display : none;">
        <form action="index.php?action=ajoutRealisateur" method="post">
            <div class="input-group mb-3">
                <label>Ajouter un réalisateur</label>
            </div>    
            <div>
                <label for="input-nom">Nom :</label>
                <input type="text" id="input-nom" name="nom">
                <label for="input-prenom">Prenom :</label>
                <input type="text" id="input-prenom" name="prenom">
                <label for="select-sexe">Sexe :</label>
                <select id="select-sexe" name="sexe">
                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                </select>
                <label for="input-ddn">Date de naissance :</label>
                <input type="date" id="input-ddn" name="ddn">
                <input class="btn btn-primary" type="submit" name="submit"></input>
            </div>
        </form>
        <form action="index.php?action=supprimeRealisateur" method="post">
            <div class="input-group mb-3">
                <label>Supprimer un réalisateur</label>
            </div>    
            <div>
                <label for="select-realisateur"></label>
                <select id="select-realisateur" name="idRealisateur">
                    <?php 
                    foreach($requete2->fetchAll() as $realisateur){
                        echo "<option value='".$realisateur['id_personne']."'>
                                ".$realisateur['id_realisateur']." - ".$realisateur['realisateurs']."</option>";
                    }
                    ?>
                </select>
                <input class="btn btn-primary" type="submit" name="submit"></input>
            </div>
        </form>
        <button class="btn btn-primary" type="button" id="btnAnnuler">Annuler</button>
    
    </div>


   
</div>

<script src="public/js/scriptActeur.js"></script>
<?php

$titre = "Liste des realisateurs";
$titre_secondaire = "";
$contenu = ob_get_clean();
require "view/template.php";
?>