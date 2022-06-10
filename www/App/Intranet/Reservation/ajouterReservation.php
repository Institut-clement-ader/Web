<!-- Ce fichier est le formulaire de la création d'une réservation ainsi que son ajoute dans la bdd et la vérification des exceptions
Ce fichier est utilisé dans la page Ajouter une réservation 
Ce fichier utilise NouvelleReservation.php -->
<?php
    require 'App/Intranet/Reservation/src/NouvelleReservation.php';
    //détection de langue courante de la page
    $currentlang = get_bloginfo('language');
    if(strpos($currentlang,'fr')!==false){
        include('App/lang-fr.php');
    }elseif(strpos($currentlang,'en')!==false){
        include('App/lang-en.php');
    }else{
        echo("échec de reconnaissance de la langue");
    }
    // Récupère les informations de l'utilisateur courant (son nom et status)
    $current_user = wp_get_current_user();
    $nom_uti= $current_user->display_name;
    $status= $current_user->status;
    $valider= new NouvelleReservation();
    //$error va permettre de voir s'il y a une exception s'il est vrai alors on n'ajoute pas la réservation dans la bdd 
    $error=false;
?>
<div class="container">
    <?php 
        // Si POST n'est pas vide alors on récupère les informations dedans et on vérifie le chevauchement
        if($_SERVER['REQUEST_METHOD']== 'POST'):
            // Récupère le nom du moyen avec les ' sans \
            $moyen= str_replace("\'", "'", $_POST['nom_moyen']); 
            // Si il y a un chevauchement alors on envoye une excpetion
            if($valider->chevauchementMemeMoyen($_POST)[0]>='1'):
                $error=true;?>
                <div class="alert">
                    <?=TXT_ERREUR_MOYEN?>
                </div>
            <?php endif; 
             // Si il y a un chevauchement alors on envoye une excpetion
            if($valider->chevauchementMemeUtilisateur($_POST)[0]>='1'):
                $error=true;?>
                <div class="alert">
                    <?=TXT_ERREUR_UTI?>
                </div>
            <?php endif; 
        endif;
    ?>
    <!-- Début du formulaire -->
    <form action="" method="post" class="form">
        <div class="row">
            <div class="form-simple">
                <!-- Titre de la réservation -->
                <label for="titre_reservation"><?=TXT_TITRE?></label>
                <!-- Si le titre est contenu dans $POST alors on l'affiche -->
                <input id="titre_reservation" required type="text" class="form-control" name="titre_reservation" value= "<?= isset($_POST['titre_reservation']) ? $_POST['titre_reservation'] : ''; ?>">
            </div>
            <div class="ligne1">
                <div class="form-group">
                    <!-- Nom de l'utilisateur qui réserve -->
                    <label for="nom_utilisateur"><?=TXT_NOM_UTI_ADD?></label>
                    <!-- On bloque input du nom d'utilisateur car on fait la réservation en fonction du nom de l'utilisateur courant  -->
                    <input id="nom_utilisateur" required type="text" class="form-control" name="nom_utilisateur" DISABLED value= '<?= $nom_uti  ?>'  >
                    <input type='hidden' name='nom_utilisateur' value='<?= $nom_uti  ?>'>
                </div>
                <div class="form-group">
                    <!-- Nom du moyen réservé -->
                    <label for="nom_moyen"><?=TXT_NOM_MOYEN_ADD?></label>
                    <!-- Les moyens sont regroupés en catégorie (optgroup) et sont sous forme de liste -->
                    <select id="nom_moyen" required type="text" class="selectionForm" name="nom_moyen"  > 
                        <option value='' selected='selected'> ----- </option>
                        <?php 
                            $res=$valider->afficherLesCategorie();
                            // Parcourt toutes les catégories de la requête
                            foreach($res as $req): ?> 
                                <!-- On ajoute les catégories dans le menu déroulant sous forme de optgroup -->
                                <optgroup label="<?=$req[0]?>">
                                    <?php $resu=$valider->getMoyenParCategorie($req[0]); 
                                    // Parcourt tous les moyens de la requête 
                                    foreach($resu as $requ):?> 
                                        <!-- On ajoute les moyens dans le menu déroulant et on sélectionne celui dans $moyen --> 
                                        <option value="<?= $requ[0]?>" <?= ($moyen== $requ[0]) ? selected : ''; ?> > <?= $requ[0] ?> </option>
                                    <?php endforeach; ?>    
                                </optgroup>
                           <?php endforeach; 
                        ?>
                    </select>
                </div> 
            </div>
            <div class="ligne2">
                <div class="form-group">
                     <!-- Date de début de la réservation-->
                    <label for="date_debut"><?=TXT_DATE_DEB_ADD?></label>
                    <!-- Si la date de début est contenue dans $POST alors on l'affiche -->
                    <input id="date_debut" required type="date" class="form-time" name="date_debut" value= "<?= isset($_POST['date_debut']) ? $_POST['date_debut'] : ''; ?>" >
                </div>
                <div class="form-group">
                    <!-- Heure de début de la réservation-->
                    <label for="heure_debut"><?=TXT_HEURE_DEB_ADD?></label>
                    <!-- Si l'heure de début est contenue dans $POST alors on l'affiche -->
                    <input id="heure_debut" required type="time" class="form-time" name="heure_debut"value= "<?= isset($_POST['heure_debut']) ? $_POST['heure_debut'] : ''; ?>" >
                </div>
            </div>
            <div class="ligne3">
                <div class="form-group">
                    <!-- Date de fin de la réservation-->
                    <label for="date_fin"><?=TXT_DATE_FIN_ADD?></label>
                    <!-- Si la date de fin est contenue dans $POST alors on l'affiche -->
                    <input id="date_fin" required type="date" class="form-time" name="date_fin" value= "<?= isset($_POST['date_fin']) ? $_POST['date_fin'] : ''; ?>">
                    <?php 
                        // Si le POST n'est pas vide alors on vérifie les exceptions
                        if($_SERVER['REQUEST_METHOD']== 'POST'):
                            // S'il y a un chevauchement entre les deux dates alors on envoie l'exception
                            if($valider->chevauchement2jours(new DATETIME($_POST['date_debut']),new DATETIME($_POST['date_fin']))==true): 
                                $error=true; ?>
                                <div class="alert">
                                    <?=TXT_ERREUR_DATE?>
                                </div>
                            <?php endif; 
                        endif;
                    ?>
                </div>
                <div class="form-group">
                    <!-- Heure de fin de la réservation-->
                    <label for="heure_fin"><?=TXT_HEURE_FIN_ADD?></label>
                    <!-- Si l'heure de fin est contenue dans $POST alors on l'affiche -->
                    <input id="heure_fin" required type="time" class="form-time" name="heure_fin"value= "<?= isset($_POST['heure_fin']) ? $_POST['heure_fin'] : ''; ?>" >
                    <?php 
                        // Si le POST n'est pas vide alors on vérifie les exceptions
                        if($_SERVER['REQUEST_METHOD']== 'POST' ):
                            // S'il y a un chevauchement entre les deux heures et que la date de début et de fin sont les mêmes alors on envoie l'exception
                            if($_POST['date_debut'] == $_POST['date_fin'] && $valider->chevauchement2heures(new DATETIME($_POST['heure_debut']),new DATETIME($_POST['heure_fin']))==true): 
                                $error=true;?>
                                <div class="alert">
                                <?=TXT_ERREUR_HEURE?>
                                </div>
                            <?php endif; 
                        endif;
                    ?>
                </div>
            </div>
            <div class="ligne4">
                <div class="form-group"> 
                    <!-- Raison de la réservation-->
                    <label for="raison"><?=TXT_RAISON?></label>
                    <select id="raison" required type="text" class= "selectionForm" name="raison" >
                        <!-- Affiche les différentes raisons de la réservation, possible d'en ajouter d'autre si nécessaire, et on sélectionne celui dans $raison-->
                        <option value='' selected='selected'> ----- </option>
                        <option value='maintenance' <?= ($_POST['raison']== 'maintenance') ? selected : ''; ?> > <?=TXT_MAINTENANCE?>  </option>
                        <option value='test'<?= ($_POST['raison']== 'test') ? selected : ''; ?> > <?=TXT_ESSAI?> </option>
                        <option value='formation' <?= ($_POST['raison']== 'formation') ? selected : ''; ?>> <?=TXT_FORMATION?> </option>
                    </select>
                </div> 
                <div class="form-group">
                    <!-- Encadrant de l'utilisateur -->
                    <label for="encadrant"><?=TXT_ENCADRANT?></label>
                    <!-- Si l'utilisateur courant est un doctorant alors il pourra choisir l'encadrant sinon la case est bloqué et vide-->
                    <select id="encadrant" required type="text" class="selectionForm" name="encadrant" <?= ($status=="Doctorant") ? '' : disabled; ?> > 
                        <option value='' selected='selected'> ----- </option>
                        <?php 
                            $res=$valider->afficherLesEncadrants();
                            //Parcourt tous les utilisateurs 
                            foreach($res as $requ):   ?>
                                <!-- On ajoute les moyens dans le menu déroulant et on sélectionne celui dans $encadrant --> 
                                <option value="<?= $requ[0]?>" <?= ($_POST['encadrant']== $requ[0]) ? selected : ''; ?> > <?= $requ[0] ?> </option>
                            <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-simple">
                <!-- Axe de recherche de la réservation -->
                <label for="axe_recherche"><?=TXT_AXE?></label>
                <!-- Si l'axe de recherche est contenue dans $POST alors on l'affiche -->
                <input id="axe_recherche" required type="text" class="form-control" name="axe_recherche"value= "<?= isset($_POST['axe_recherche']) ? $_POST['axe_recherche'] : ''; ?>" >
            </div>
            <div class="desc">
                <div class="form-simple">
                    <!-- Description de la réservation (pas obligatoire) -->
                    <label for="description"><?=TXT_DESC?></label>
                    <!-- Si la description est contenue dans $POST alors on l'affiche -->
                    <input id="description" type="text" name="description" class="form-control" value= "<?= isset($_POST['description']) ? $_POST['description'] :''; ?>" > </input>
                </div>
            </div>
        </div>
        <div class="bouton">
            <!-- Bouton ajouter qui permet de mettre les données du formulaire dans le POST -->
            <button class="btn btn-primaryModif" type="submit" name="submit" value="Ajouter"><?=TXT_AJOUTER?></button>
             <!-- Bouton annuler qui supprime les données du formulaire -->
            <button class="btn btn-primaryModif" type="reset" name="reset" value="Annuler"><?=TXT_ANNULER?></button>
        </div>
    </form>
</div>
<?php 
    // Si le POST n'est pas vide et qu'il n'y a pas eu d'exceptions alors on envoie les mails et on ajoute la réservation dans la bdd
    if($_SERVER['REQUEST_METHOD']== 'POST' && $error==false):
        $mail=$valider->envoieMailAjout($_POST);
        if ($mail==true){
            $req= $valider->creationReservation($_POST);
        }
        // Si l'ajout a bien était fait alors on envoie le message de succès
        if($req==true): ?>
            <div class="container">
                <div class="success">
                    <?=TXT_REUSSI?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; 
?> 

