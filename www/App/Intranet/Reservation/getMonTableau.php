<!-- Ce fichier permet d'actualiser le tableau de la page MesReservation en fonction du filtre des menus déroulants
Ce fichier est utilisé dans la page Mes réservations grâce au javaScript
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
    $events = new Events();
    $current_user = wp_get_current_user();
    $nom_uti= $current_user->display_name;
    // Récupère la date du GET pour et on met l'heure et les minute en 00:00 si $GET est null alors récupère la date du jour 
    $deb= (new DATETIME($_GET['deb']))->format("Y-m-d H:i");
    // Récupère la date du GET pour et on met l'heure et les minute en 00:00 si $GET est null alors récupère la date du jour 
    $fin= (new DATETIME($_GET['fin']))->format("Y-m-d H:i");
    // Si fin est la date du jour avec les mêmes heures (cela ça signifie que l'utilisatuer n'a pas mis d'heure) alors on met une grand date de fin pour toutes avoir 
    if ($fin==date("Y-m-d H:i")){
        $fin= (new DATETIME('3000-01-01'))->format('Y-m-d H:i');
    }
    $event = $events->getEventByName($nom_uti,$deb,$fin);
    // S'il n'y a pas de réservation de la catégorie choisie ou du moyen choisi alors affiche un message
    if(count($event)==0){ ?>
        <div class="aucun">
            <h1> <?=TXT_PAS_RESER?></h1>  
        </div>    
    <!-- Sinon affiche le tableau -->
    <?php }else{ ?>
        <div class="tabRes">
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
                            <td><?= $row['titre_reservation'] ?></td>
                            <td><?= $row['nom_utilisateur'] ?></td>
                            <td><?= $row['nom_moyen'] ?></td>
                            <td><?= (new DATETIME($dateheure_deb[0]))->format('d/m/Y') ?></td>
                            <td><?= $heure_deb[0] . ':'. $heure_deb[1] ?></td>
                            <td><?= (new DATETIME($dateheure_fin[0]))->format('d/m/Y') ?>
                            <td><?=  $heure_fin[0] . ':'. $heure_fin[1] ?></td>
                            <td> <a href="<?=$site?><?=LIEN_RESERVATION?>?id=<?= $row[0] ?>"><?=TXT_CONSULTER?></a>
                        </tr>
                    <?php } 
                ?>
            </table>
        </div>
    <?php } 
?>
     
