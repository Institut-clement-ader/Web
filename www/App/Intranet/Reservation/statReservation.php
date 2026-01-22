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
    $evenement = new Events();
    $current_user = wp_get_current_user();
    $uti=$current_user->display_name;
    $nom_uti= $evenement->afficherNom($uti);
    $id = get_current_user_id();
    $user_info = get_userdata($id);
    $user_roles = $user_info->roles;
    $req=$evenement->afficherLesGroupes(); 
    $deb= date("Y-m-d H:i:s");
    $fin= (new DateTime('3000-01-01'))->format('Y-m-d H:i');
    if ($user_roles[0]=='administrator'){
        $moy=$evenement->afficherToutMoyen($deb,$fin);
    }else{
        $moy=$evenement->afficherMoyenResponsable($nom_uti,$deb,$fin);
    }
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
        <?php if (count($moy)==0):?>
            <div class='message_null'>
                <h1> <?=TXT_PAS_RESER?></h1>  
            </div>
        <?php else:?> 
            <!-- Début du tableau des réservation -->
            <table class="table">
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
        <?php endif;?>
    </div>


    
  
   