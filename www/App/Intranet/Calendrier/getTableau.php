<!-- Ce fichier permet d'actualiser le tableau de la page Tableau des réservations en fonction du filtre des menus déroulants
Ce fichier est utilisé dans la page Tableau des réservations grâce au javaScript
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
     // Récupère le nom du moyen avec les ' sans \
    $m= str_replace("\'", "'", $_GET['moy']); 
    $uti= $_GET['uti'];
    // Récupère la date du GET pour et on met l'heure et les minute en 00:00 si $GET est null alors récupère la date du jour 
    $deb= (new DATETIME($_GET['deb']))->format("Y-m-d H:i");
    // Récupère la date du GET pour et on met l'heure et les minute en 00:00 si $GET est null alors récupère la date du jour 
    $fin= (new DATETIME($_GET['fin']))->format("Y-m-d H:i");
    // Si fin est la date du jour avec les mêmes heures (cela ça signifie que l'utilisatuer n'a pas mis d'heure) alors on met une grand date de fin pour toutes avoir 
    if ($fin==date("Y-m-d H:i")){
        $fin= (new DATETIME('3000-01-01'))->format('Y-m-d H:i');
    }
    // Quand l'utilisateur a modifié la categorie 
    // S'il y a une catégorie dans le GET alors on exécute la requête avec le GET
    if(isset($_GET['cat'])){
        $q =$_GET['cat'];
        $_SESSION['categorie_moyen_recherche']=$q;
        $events= $evenement->getEventsByCategorie($q,$deb,$fin);
        // S'il il y a un utilisateur dans le GET
        if(isset($_GET['uti'])){
            // Si utilisateur n'est pas null alors on exécute la requête en fonction de l'utilisateur sinon sans l'utilisateur
            if($_GET['uti']!=''){
                $_SESSION['nom_utilisateur']=$uti;
                $events= $evenement->getEventsByCategorieAndUser($q,$uti,$deb,$fin);
            }else{
                $_SESSION['nom_utilisateur']=$uti;
                $events= $evenement->getEventsByCategorie($q,$deb,$fin);
            } 
        }else{
            $uti= $evenement->getUtiEventsByCategorie($q,$deb,$fin);
            // Parcourt tout les utilisateur qui ont réservé de la requête
            foreach($uti as $row){
                // Si la requête est la même que dans la SESSION alors on exécute la requête avec l'utilisateur de la session
                if($_SESSION['nom_utilisateur'] == $row['nom_utilisateur']){
                    $events= $evenement->getEventsByCategorieAndUser($q,$row['nom_utilisateur'],$deb,$fin);
                }
            }
        }
        // Quand l'utilisateur modifie la catégorie mais que le moyen de la session est dans cette catégorie
        $moyen= $evenement->getMoyenParCategorie($q);
        // Parcourt tout les moyens de la requête
        foreach($moyen as $row){
            // Si la requête est la même que dans la SESSION alors on exécute la requête avec le moyen de la session 
            if($_SESSION['moyen_recherche']== $row['nom_moyen']){
                $events= $evenement->getEventsByMoyen($_SESSION['moyen_recherche'],$deb,$fin);
                 // S'il il y a un utilisateur dans le GET
                if(isset($_GET['uti'])){   
                    // Si uti n'est pas null alors on exécute la requête en fonction de l'utilisateur sinon sans l'utilisateur
                    if($_GET['uti']!=''){
                        $_SESSION['nom_utilisateur']=$uti;
                        $events= $evenement->getEventsByMoyenAndUser($_SESSION['moyen_recherche'],$uti,$deb,$fin);
                    }else{
                        $_SESSION['nom_utilisateur']=$uti;
                        $events= $evenement->getEventsByMoyen($_SESSION['moyen_recherche'],$deb,$fin);
                    }
                }else{
                    $uti= $evenement->getUtiEventsByMoyen($_SESSION['moyen_recherche'],$deb,$fin);
                    // Parcourt tout les utilisateur qui ont réservé de la requête
                    foreach($uti as $row){
                        // Si la requête est la même que dans la SESSION alors on exécute la requête avec l'utilisateur de la session
                        if($_SESSION['nom_utilisateur'] == $row['nom_utilisateur']){
                            $events= $evenement->getEventsByMoyenAndUser($_SESSION['moyen_recherche'],$row['nom_utilisateur'],$deb,$fin);
                        }
                    }
                }
            }
        }
    // Quand l'utilisateur modifie le moyen 
    // Sinon si $_GET du moyen n'est pas null alors exécute la requête avec le GET du moyen est on l'a met dans la SESSION
    }elseif($m!=''){
        $_SESSION['moyen_recherche']=$m;
        $events= $evenement->getEventsByMoyen($m,$deb,$fin);
        // S'il il y a un utilisateur dans le GET
        if(isset($_GET['uti'])){
            // Si uti n'est pas null alors on exécute la requête en fonction de l'utilisateur sinon sans l'utilisateur  
            if($_GET['uti']!=''){
                $_SESSION['nom_utilisateur']=$uti;
                $events= $evenement->getEventsByMoyenAndUser($m,$uti,$deb,$fin);
            }else{
                $_SESSION['nom_utilisateur']=$uti;
                $events= $evenement->getEventsByMoyen($m,$deb,$fin);
            }
        }else{
            $uti= $evenement->getUtiEventsByMoyen($m,$deb,$fin);
            // Parcourt tout les utilisateur qui ont réservé de la requête
            foreach($uti as $row){
                // Si la requête est la même que dans la SESSION alors on exécute la requête avec l'utilisateur de la session
                if($_SESSION['nom_utilisateur'] == $row['nom_utilisateur']){
                    $events= $evenement->getEventsByMoyenAndUser($m,$row['nom_utilisateur'],$deb,$fin);
                }
            }
        }
    // Quand l'utilisateur met moyen à nul (----)
    // Sinon on exécute la requête avec la SESSION de la categorie est on met le moyen dans la SESSION du moyen
    }else{
        $_SESSION['moyen_recherche']=$m;
        $events= $evenement->getEventsByCategorie($_SESSION['categorie_moyen_recherche'],$deb,$fin);
        // S'il il y a un utilisateur dans le GET
        if(isset($_GET['uti'])){
            // Si uti n'est pas null alors on exécute la requête en fonction de l'utilisateur sinon sans l'utilisateur  
            if($_GET['uti']!=''){
                $_SESSION['nom_utilisateur']=$uti;
                $events= $evenement->getEventsByCategorieAndUser($_SESSION['categorie_moyen_recherche'],$uti,$deb,$fin);
            }else{
                $_SESSION['nom_utilisateur']=$uti;
                $events= $evenement->getEventsByCategorie($_SESSION['categorie_moyen_recherche'],$deb,$fin);
            }
        }else{
            $uti= $evenement->getUtiEventsByCategorie($_SESSION['categorie_moyen_recherche'],$deb,$fin);
            // Parcourt tout les utilisateur qui ont réservé de la requête
            foreach($uti as $row){
                // Si la requête est la même que dans la SESSION alors on exécute la requête avec l'utilisateur de la session
                if($_SESSION['nom_utilisateur'] == $row['nom_utilisateur']){
                    $events= $evenement->getEventsByCategorieAndUser($_SESSION['categorie_moyen_recherche'],$row['nom_utilisateur'],$deb);
                }
            }
        }
    } 
    // S'il n'y a pas de réservation de la catégorie choisie ou du moyen choisi alors affiche un message
    if(count($events)==0){ ?>
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
     
