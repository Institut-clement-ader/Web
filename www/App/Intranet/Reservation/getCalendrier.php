<!-- Ce fichier permet d'actualiser le calendrier en fonction du filtre des menus déroulants
Ce fichier est utilisé dans la page Calendrier des réservations grâce au javaScript
Ce fichier utilise Events.php et Month.php -->
<?php
    require 'App/Intranet/Reservation/src/Events.php';
    require 'App/Intranet/Reservation/src/Month.php';
    session_start();
    $evenement = new Events();
    $month=$_SESSION['month'];
    $start= $month->getStartDay();
    $start = $start->format('N') === '1' ? $start: $month->getStartDay()->modify("last monday");
    $weeks= $month->getWeeks();
    $end = (clone $start)->modify('+'.(6+7*($weeks-1)).' days');
    // Récupère le nom du moyen avec les ' sans \
    $m= str_replace("\'", "'", $_GET['moy']); 
    // S'il y a une catégorie dans le GET alors on exécute la requête avec le GET
    if(isset($_GET['cat'])){
        $q =$_GET['cat'];
        $_SESSION['categorie_moyen_recherche']=$q;
        $events= $evenement->getEventsBetweenByDay($start,$end,$q);
        $moyen= $evenement->getMoyenParCategorie($q);
        // Parcourt tout les moyens de la requête
        foreach($moyen as $row){
            // Si la requête est la même que dans la SESSION alors on exécute la requête avec le moyen de la session
            if($_SESSION['moyen_recherche']== $row['nom_moyen']){
                $events= $evenement->getEventsBetweenByDayByMoyen($start,$end, $_SESSION['moyen_recherche']);
            }
        }
    // Sinon si $_GET du moyen n'est pas null alors exécute la requête avec le GET du moyen est on l'a met dans la SESSION
    }elseif($m!=''){
        $_SESSION['moyen_recherche']=$m;
        $events= $evenement->getEventsBetweenByDayByMoyen($start,$end,$m);
    // Sinon on  exécute la requête avec la SESSION du moyen est on l'a met dans la SESSION de la catégorie
    }else{
        $_SESSION['moyen_recherche']=$m;
        $events= $evenement->getEventsBetweenByDay($start,$end,$_SESSION['categorie_moyen_recherche']);
    }
?> 
<div id='tab'>
    <!-- Début du calendrier -->
    <table  class="calendar__table_a calendar__table_a--<?= $weeks; ?>weeks">
        <tbody>
          <?php
                // Parcourt toutes les semaines du mois
                for ($i =0; $i < $weeks; $i++): ?>
                    <tr>
                        <?php 
                             // Parcourt les différents jours du mois
                            foreach($month->getDays() as $k => $day):
                                $date= (clone $start)->modify ("+".($k+$i*7)." days");
                                $within=$date;
                                $eventsForDay = $events[$date->format('Y-m-d')] ?? [];?>
                                <!-- Si le jour n'est pas dans le mois (semaine qui chevauche deux mois) alors on rend le numéro du jour gris -->
                                <td class="<?= $month->withinMonth($date) ? '' :  'calendar__othermonth'; ?>" >
                                     <!-- Si c'est la première semaine alors on affiche le jour  -->
                                    <?php if ($i == 0): ?>
                                        <div class="calendar__weekday"><?= $day;?>  </div>
                                    <?php endif;
                                     // $e permet d'éviter qu'il y a trop de réservations afficher le même jour
                                    $e=0;?>
                                    <div class="calendar__day"><?= $date->format('d');?> </div>
                                     <!-- Parcourt tous les événements de la journée -->
                                    <?php foreach($eventsForDay as $event): ?>
                                         <!-- Si le jour n'est pas dans le mois (semaine qui chevauche deux mois) alors on rend la réservation du jour gris -->
                                         <div class=<?= $month->withinMonth($within) ? 'calendar__event' :  'calendar__event__othermonth'; ?>>
                                            <a href= "<?=$site?>/reservation-de-la-journee?date_jour=<?=$date->format('Y-m-d');?>" >
                                                <?php 
                                                    $e += 1 ;
                                                    // Si $e est égal à 4 on rien ... (pour éviter le surcharge d'information)
                                                    if ($e==4) : ?>
                                                        ...
                                                    <!-- Si $e est supérieur à 4 alors on affiche rien-->
                                                    <?php elseif ($e>3): ?>

                                                    <!-- Sinon on affiche la réservartion -->
                                                    <?php else: ?>  
                                                        - <strong> <?= $event['titre_reservation']; ?> </strong> | <?= $event['nom_moyen']; ?> 
                                                    <?php endif; 
                                                ?>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </td>
                            <?php endforeach; 
                        ?>
                    </tr>
                <?php endfor; 
            ?>
        </tbody>
     </table> 
</div>



                                              


