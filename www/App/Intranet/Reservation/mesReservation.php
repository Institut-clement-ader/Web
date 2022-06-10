<!-- Ce fichier permet d'afficher les réservations de l'utilisateur pas encore terminées qu'il soit encadrant, responsable ou l'utilisateur qui réserve
Ce fichier est utilisé dans la page Mes réservations 
Ce fichier utilise Events.php -->
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
    $events = new Events();
    // Récupération du nom de domaine du site 
    $site=site_url();
    $current_user = wp_get_current_user();
    $nom_uti= $current_user->display_name;
    $deb= date("Y-m-d H:i:s");
    $fin= (new DateTime('3000-01-01'))->format('Y-m-d H:i');
    $event = $events->getEventByName($nom_uti,$deb,$fin);
    ?>
    <!-- Début du choix de la date (pour filtrer) -->
    <form  action="" method="post" class='formulaire_date' >
        <div class="date_container1_mes">
            <div class="f_date_debut"><?=TXT_DATE_DEB_ADD?> </div>
            <!-- Si la date de fin est contenue dans $SESSION alors on l'affiche -->
            <input  type="date" class="nom_date_debut" name="date_debut" id=date_d value= "<?= isset($_SESSION['date_debut']) ? $_SESSION['date_debut'] : ''; ?>" >
        </div>
        <div class="date_container2_mes">
            <div class="f_date_fin"><?=TXT_DATE_FIN_ADD?> </div>
            <!-- Si la date de fin est contenue dans $SESSION alors on l'affiche -->
            <input  type="date" class="nom_date_debut" name="date_fin" id=date_f value= "<?= isset($_SESSION['date_fin']) ? $_SESSION['date_fin'] : ''; ?>" >            
        </div>
    </form>
    <!-- L'id tableau est utilisé dans le JavaScript pour faire appel à getTableau.php  -->
    <div id="tableau" >
        <?php
        // Envoie un message d'erreur si il n'y a pas de réservations de l'utilisateur
        if(count($event)==0){ ?>
            <div class='message_null'>
                <h1> <?=TXT_PAS_RESER?></h1>  
            </div>
        <!-- Sinon affiche le tableau -->
        <?php }else{?>
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
                    foreach($event as $row){
                        // Sépare la date (J-M-A) de l'heure (H:M:S)
                        $dateheure_deb = explode(' ', $row['date_debut']);
                        $heure_deb = explode(':', $dateheure_deb[1]);
                        $dateheure_fin = explode(' ', $row['date_fin']);
                        $heure_fin = explode(':', $dateheure_fin[1]);
                ?>
                <!-- Cellule du tableau  -->
                <tr>
                    <td> <?= $row['titre_reservation'] ?></td>
                    <td> <?= $row['nom_utilisateur'] ?></td>
                    <td> <?= $row['nom_moyen'] ?></td>
                    <td> <?= (new DATETIME($dateheure_deb[0]))->format('d/m/Y') ?></td>
                    <td> <?= $heure_deb[0] . ':'. $heure_deb[1] ?></td>
                    <td> <?= (new DATETIME($dateheure_fin[0]))->format('d/m/Y') ?> </td>
                    <td> <?= $heure_fin[0] . ':'. $heure_fin[1] ?></td>
                    <td> <a href="<?=$site?><?=LIEN_RESERVATION?>?id=<?= $row[0] ?>"><?=TXT_CONSULTER?></a>
                </tr>
                <?php } ?>
            </table>
        <?php }
        ?>
    </div>