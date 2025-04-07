<?php ob_start(); 

$acteurs=$requete1->fetchAll();
$roles=$requete2->fetchAll();
$films=$requete3->fetchAll();
?>
<!-- Ajout d'un acteur  -->
<div class="container-main">
    <div class="container-form">
        <form action="index.php?action=ajoutActeur" method="post">
            <div class="input-group mb-3">
                <label>Ajouter un acteur</label>
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
                <input class="btn btn-primary" type="submit" name="submit">
            </div>
        </form>
        <div>
            <form action="index.php?action=supprimeActeur" method="post">
                <div class="input-group mb-3">
                    <label>Supprimer un acteur</label>
                </div>
                <div>
                    <label for="select-acteur"></label>
                    <select id="select-acteur" name="idActeur">
                        <?php 
                        foreach($acteurs as $acteur){
                            echo "<option value='".$acteur['id_personne']."'>
                                    ".$acteur['acteurs']."</option>";
                        }
                        ?>
                    </select>
                    <input class="btn btn-primary" type="submit" name="submit"></input>
                </div>
            </form>
            <form action="index.php?action=ajoutRole" method="post">
                <div class="input-group mb-3">
                    <label>Ajouter un role</label>
                </div>
                <div>
                    <input type="text" id="input-role" name="role">
                
                    <input class="btn btn-primary" type="submit" name="submit">
                </div>
            </form>
            
            <form action="index.php?action=attribuerRole" method="post">
                <div class="input-group mb-3">
                    <label>Attribuer un role</label>
                </div>
                <div>
                    <label for="role">Role</label>
                    <select name="role" id="role">
                        <?php 
                        foreach($roles as $role){
                            ?>
                            <option value="<?=$role['id_role']?>"><?=$role['nom_role']?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <label for="acteur">Acteur</label>
                    <select name="acteur" id="acteur">
                        <?php 
                        foreach($acteurs as $acteur){
                            ?>
                            <option value="<?=$acteur['id_acteur']?>"><?=$acteur['acteurs']?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <label for="film">Film</label>
                    <select name="film" id="film">
                        <?php 
                        foreach($films as $film){
                            ?>
                            <option value="<?=$film['id_film']?>"><?=$film['titre']?></option>
                            <?php
                        }
                        ?>
                    </select>
                    
                    <input class="btn btn-primary" type="submit" name="submit">
                </div>
            </form>

            <form action="index.php?action=supprimerRole" method="post">
                <div class="input-group mb-3">
                    <label>Supprimer un role</label>
                </div>
                <div>
                    <select name="supprimerRole" id="supprimerRole">
                        <?php
                        foreach($roles as $role){
                            ?>
                            <option value="<?=$role['id_role'] ?>"><?=$role['nom_role'] ?></option>
                            <?php
                        };
                        ?>
                    </select>
                    <input class="btn btn-primary" type="submit" name="submit">
                </div>
                
            </form>
        </div>

    </div>

    <div class="container-films">
        <h3>Liste des acteurs</h3>
        <div>
        <?php
        foreach($acteurs as $acteur){
            ?>
            <div class="card border-primary mb-3">
                <a href="index.php?action=detailActeur&id=<?=$acteur['id_acteur']?>">
                    <?= $acteur['acteurs']?>
                </a>
            </div>
            
        <?php
            
        }
        ?>
        </div>
    </div>
</div>
<?php

$titre = "Liste des acteurs";
$titre_secondaire = "";
$contenu = ob_get_clean();
require "view/template.php";
?>