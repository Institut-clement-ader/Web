<!-- Ce fichier permet d'actualiser le tableau de la page 'Mes reservation' en fonction du filtre des menus déroulants
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
    $evenement = new Events();
    $current_user = wp_get_current_user();
    $uti=$current_user->display_name;
    $nom_uti= $evenement->afficherNom($uti);
    $req=$evenement->afficherLesGroupes(); 
    $id = get_current_user_id();
    $user_info = get_userdata($id);
    $user_roles = $user_info->roles;
    // Récupère la date du GET pour et on met l'heure et les minute en 00:00 si $GET est null alors récupère la date du jour 
    $deb= (new DATETIME($_GET['deb']))->format("Y-m-d H:i");
    // Récupère la date du GET pour et on met l'heure et les minute en 00:00 si $GET est null alors récupère la date du jour 
    $fin= (new DATETIME($_GET['fin']))->format("Y-m-d H:i");
    // Si fin est la date du jour avec les mêmes heures (cela ça signifie que l'utilisatuer n'a pas mis d'heure) alors on met une grand date de fin pour toutes avoir 
    if ($fin==date("Y-m-d H:i")){
        $fin= (new DATETIME('3000-01-01'))->format('Y-m-d H:i');
    }
    if ($user_roles[0]=='administrator'){
        $moy=$evenement->afficherToutMoyen($deb,$fin);
    }else{
        $moy=$evenement->afficherMoyenResponsable($nom_uti,$deb,$fin);
    }
    if (count($moy)==0):?>
        <div class='message_null'>
            <h1> <?=TXT_PAS_RESER?></h1>  
        </div>
    <?php else:?> 
        <div class="tabResu">
        <!-- Début du tableau des réservation -->
        <table class="table-res">
            <!-- Header de la table  -->
            <tr class="table-header">
                <th><?=TXT_NOM_MOYEN?></th>
                <?php foreach($req as $groupe): ?>
                    <th><?=$groupe[0]?></th>
                <?php endforeach; ?>
            </tr>
            <!-- Cellule du tableau  -->
            <?php foreach($moy as $moyen): ?>
                <tr>
                    <td><?=$moyen[0]?></td>
                    <?php foreach($req as $groupe): 
                        $rese=$evenement->afficherReservationGroupeMoyen($groupe[0],$deb,$fin,$moyen[0]); 
                        if(count($rese)!=0):
                            $heure+=0;
                            foreach($rese as $reservation): 
                                $origin = new DateTime($reservation['date_debut']);
                                $target = new DateTime($reservation['date_fin']);
                                $interval= $origin->diff($target);
                                $jour+=$interval->format('%a');
                                $heure+=$interval->format('%h');
                                $heure+=$jour*24;
                            endforeach;?>
                            <td><?=$heure.' heures'?></td>
                        <?php else: ?>
                            <td><?=TXT_NON_RESA_GROUPE?></td> 
                        <?php endif;
                     endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
                    </div>
    <?php endif;?>
