<!-- Ce fichier permet d'afficher les réservations sous forme de tableau, il permet aussi de filtrer les réservations avec les catégories ou directement le moyen 
Ce fichier est utilisé dans la page Tableau des réservations 
Ce fichier utilise Events.php-->
<?php 
    require 'App/Intranet/Reservation/src/Events.php';
    //détection de langue courante de la page
    $currentlang = get_bloginfo('language');
    if(strpos($currentlang,'fr')!==false){
        include('App/lang-fr.php');
    }elseif(strpos($currentlang,'en')!==false){
        include('App/lang-en.php');
    }else{
        echo("échec de reconnaissance de la langue");
    }
    session_start();
    // Récupération du nom de domaine du site 
    $site=site_url();
    $evenement = new Events();
    $deb= date("Y-m-d H:i:s");
    $fin= (new DateTime('3000-01-01'))->format('Y-m-d H:i');
    // Si la SESSION contient une catégorie alors on la récupère sinon on met la catégorie qui est la premier sur la liste (Simulateur numérique)
    if (isset($_SESSION['categorie_moyen_recherche'])){
        $categorie=$_SESSION['categorie_moyen_recherche'];
    }else{
        $cat=$evenement->afficherLesCategorie();
        $categorie=$cat[0]['categorie'];
    }
    $events= $evenement->getEventsByCategorie($categorie,$deb,$fin);
    $uti= $evenement->getUtiEventsByCategorie($categorie,$deb,$fin);
    // Parcourt tout les utilisateur qui ont une resérvation
    foreach($uti as $row){
        // Si l'utilisateur est le même que dans la SESSION alors on exécute la requête avec l'utilisateur de la session
        if($_SESSION['nom_utilisateur']== $row['nom_utilisateur']){
            $events= $evenement->getEventsByCategorieAndUser($_SESSION['categorie_moyen_recherche'],$row['nom_utilisateur'],$deb,$fin);
        }
    }
    $moy= $evenement->getMoyenParCategorie($categorie);
    // Parcourt tous les moyens de la catégorie
    foreach($moy as $row){
       // Si le moyen est le même que la SESSION alors on exécute la requête avec ce moyen
        if($_SESSION['moyen_recherche']==$row['nom_moyen'] ){   
            $events= $evenement->getEventsByMoyen($_SESSION['moyen_recherche'],$deb,$fin);
            $uti= $evenement->getUtiEventsByMoyen($_SESSION['moyen_recherche'],$deb,$fin);
            foreach($uti as $row){
                // Si la requête est la même que dans la SESSION alors on exécute la requête avec l'utilisateur de la session
                if($_SESSION['nom_utilisateur']== $row['nom_utilisateur']){
                    $events= $evenement->getEventsByMoyenAndUser($_SESSION['moyen_recherche'],$row['nom_utilisateur'],$deb,$fin);
                }
            }
        }
    }
?>
<!-- Début du choix de la catégorie et du moyen (pour filtrer) -->
<form  action="" method="post" class='formulaire' >
    <!-- menu déroulant des différentes catégories -->
    <div class="categorie"><?=TXT_CAT_MOYEN?></div>
    <select class="selection" name="categorie_moyen_recherche"id='show' >
        <?php  
            $res=$evenement->afficherLesCategorie();?>
            <!-- Parcourt toutes les catégories de la requête   -->
            <?php foreach($res as $requ):  
                $resu=$evenement->getMoyenParCategorie($requ[0]); 
                if (count($resu)!=0):?>
                    <!-- On ajoute les catégorie dans le menu déroulant et on sélectionne la catégorie de la SESSION --> 
                    <option value="<?= $requ[0]?>" <?= ($_SESSION['categorie_moyen_recherche']== $requ[0]) ? selected : ''; ?>> <?= $requ[0] ?> </option>
                <?php endif;
            endforeach; 
        ?>
    </select>
    <!-- Menu déroulant des différents moyens -->
    <div class="moyen"><?=TXT_MOYEN?></div>
    <!-- L'id moyen est utilisé dans le JavaScript pour faire appel à getMoyen.php  -->
    <select class="selection" name="moyen_recherche"  id='moyen' ?>
        <option value='' selected='selected'> ----- </option>
        <?php 
            $requ=$evenement->getMoyenParCategorie($categorie);
            // Parcourt tous les moyens de la requête
            foreach($requ as $row){   ?>
                    <!-- On ajoute les moyens dans le menu déroulant et on sélectionne le moyen de la SESSION- -->   
                    <option class="option"value='<?= $row[0]?>'<?= ($_SESSION['moyen_recherche']== $row[0]) ? selected : ''; ?>> <?= $row[0] ?> </option>
            <?php } ?>
    </select>
</form>
<!-- Début du choix de la date (pour filtrer) -->
<form  action="" method="post" class='formulaire_date' >
    <div class="date_container1">
        <div class="f_date_debut"><?=TXT_DATE_DEB_ADD?></div>
        <!-- Si la date de fin est contenue dans $SESSION alors on l'affiche -->
        <input  type="date" class="nom_date_debut" name="date_debut" id=date_d value= "<?= isset($_SESSION['date_debut']) ? $_SESSION['date_debut'] : ''; ?>" >
    </div>
    <div class="date_container2">
        <div class="f_date_fin"><?=TXT_DATE_FIN_ADD?></div>
        <!-- Si la date de fin est contenue dans $SESSION alors on l'affiche -->
        <input  type="date" class="nom_date_debut" name="date_fin" id=date_f value= "<?= isset($_SESSION['date_fin']) ? $_SESSION['date_fin'] : ''; ?>" >            
    </div>
</form>
<!-- Début du choix de l'utilisateur (pour filtrer) -->
<form  action="" method="post" class='formulaire_uti' >
    <div class="container_uti">
            <div class="f_utilisateur"><?=TXT_NOM_UTI_ADD?></div>
            <!-- Si la date de fin est contenue dans $SESSION alors on l'affiche -->
            <select class="selection_uti" name="nom_utilisateur"  id='utilisateur'  ?>
                <option value='' selected='selected'> ----- </option>
                <!-- Parcourt toutes les réservations dans la requète -->
                <?php foreach($uti as $row){ ?>
                    <!-- On ajoute les utilisateurs qui ont réservés dans le menu déroulant et on sélectionne l'utilisateur de la SESSION- --> 
                    <option class="option" value='<?= $row['nom_utilisateur']?>'<?= ($_SESSION['nom_utilisateur']== $row['nom_utilisateur']) ? selected : ''; ?>> <?= $row['nom_utilisateur'] ?> </option>
                <?php } ?>
            </select>
    </div>
</form>
<!-- L'id tableau est utilisé dans le JavaScript pour faire appel à getTableau.php  -->
<div id="tableau" >
    <?php
        // Envoie un message d'erreur si il n'y a pas de réservations de l'utilisateur
        if(count($events)==0){ ?>
            <div class='message_null'>
                <h1> <?=TXT_PAS_RESER?></h1> 
            </div>     
        <!-- Sinon affiche le tableau -->  
        <?php }else{ ?>
            <!-- Début du tableau des réservation -->
            <table class="table">
                <!-- Header de la table  -->
                <tr class="table-header">
                    <th><?=TXT_TITRE_RESER?></th>
                    <th><?=TXT_NOM_UTI?></th>
                    <th><?=TXT_NOM_MOYEN?></th>
                    <th><?=TXT_DATE_DEB?></th>
                    <th><?=TXT_HEURE_DEB?></th>
                    <th><?=TXT_DATE_FIN?></th>
                    <th><?=TXT_HEURE_FIN?></th>
                    <th></th>
                </tr>
                <?php
                    // Parcourt chaque moyen de la requête
                    foreach($events as $row){
                        // Sépare la date (J-M-A) de l'heure (H:M:S)
                        $dateheure_deb = explode(' ', $row['date_debut']);
                        $heure_deb = explode(':', $dateheure_deb[1]);
                        $dateheure_fin = explode(' ', $row['date_fin']);
                        $heure_fin = explode(':', $dateheure_fin[1]);
                ?>
                <!-- Cellule du tableau  -->
                <tr>
                    <td><?= $row['titre_reservation'] ?></td>
                    <td><?= $row['nom_utilisateur'] ?></td>
                    <td><?= $row['nom_moyen'] ?></td>
                    <td><?= (new DATETIME($dateheure_deb[0]))->format('d/m/Y') ?></td>
                    <td><?= $heure_deb[0] . ':'. $heure_deb[1] ?></td>
                    <td><?= (new DATETIME($dateheure_fin[0]))->format('d/m/Y') ?></td>
                    <td><?=  $heure_fin[0] . ':'. $heure_fin[1] ?></td>
                    <td> <a href="<?=$site?><?=LIEN_RESERVATION?>?id=<?= $row[0] ?>"><?=TXT_CONSULTER?></a>
                </tr>
                <?php } ?>
            </table>
        <?php } 
    ?>
</div>

