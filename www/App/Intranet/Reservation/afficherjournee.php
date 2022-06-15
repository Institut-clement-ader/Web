<!-- Ce fichier permet d'afficher les réservations de la journée en fonction de la catégorie ou du moyen mis dans la session
Ce fichier est utilisé dans la page Réservation d'une journée en snippet
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
    session_start();
    // Récupération du nom de domaine du site 
    $site=site_url();
    $events = new Events();
    // Envoie un message d'erreur si $_GET['date_jour'] est vide
    if(!isset($_GET['date_jour'])){
       header('Location: '.$site.''.LIEN_CALENDRIER.'');
    }
    $date_jour = new DATETIME($_GET['date_jour']);
    $categorie=$_SESSION['categorie_moyen_recherche'];
    $event = $events->getEventByDayAndCategorie($date_jour,$categorie);
    $moy= $events->getMoyenParCategorie($categorie);
    // Parcourt chaque moyen de la requête
    foreach($moy as $row){
        // S'il y a un moyen dans la session, que ce moyen n'est pas vide et que le moyen et contenu dans la requête alors on recherche par rapport au moyen sinon par rapport à la catégorie 
        if($_SESSION['moyen_recherche']==$row['nom_moyen'] ){ 
            $moyen=$_SESSION['moyen_recherche'];
            $event = $events->getEventByDayAndMoyen($date_jour,$moyen);
        }
    }
?>
<!-- Création de la table  -->
<table class="table">
    <!-- Header de la table  -->
    <tr class="table-header">
        <th><?=TXT_TITRE_RESER?> </th>
        <th><?=TXT_NOM_UTI?></th>
        <th><?=TXT_NOM_MOYEN?></th>
        <th><?=TXT_DATE_DEB?></th>
        <th><?=TXT_HEURE_DEB?></th>
        <th><?=TXT_DATE_FIN?></th>
        <th><?=TXT_HEURE_FIN?></th>
        <th></th>
    </tr>
    <?php
        //Parcourt chaque réservation de la requête
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
            <td><?= $row['nom_utilisateur'] ?> </td>
            <td><?= $row['nom_moyen'] ?></td>
            <td><?= (new DATETIME($dateheure_deb[0]))->format('d/m/Y') ?></td>
            <td><?= $heure_deb[0] . ':'. $heure_deb[1] ?></td>
            <td><?= (new DATETIME($dateheure_fin[0]))->format('d/m/Y') ?>
            <td><?= $heure_fin[0] . ':'. $heure_fin[1] ?> </td>
            <!-- Bouton consulter qui mène à la page Réservation -->
            <td> <a href="<?=$site?><?=LIEN_RESERVATION?>?id=<?= $row[0] ?>">  <?=TXT_CONSULTER?> </a>
        </tr>
        <?php    
        }
     ?>
</table>

