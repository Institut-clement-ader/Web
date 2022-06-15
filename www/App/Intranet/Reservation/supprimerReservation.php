<!-- Ce fichier permet de supprimer une réservation
Ce fichier est utilisé dans la page Supprimer une réservation
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
// Envoie un message d'erreur si $_GET['id'] est vide
if(!isset($_GET['id'])){
    header('Location: '.$site.''.LIEN_CALENDRIER.'');
}
$event = $events->deleteEventById($_GET['id']);
header('Location: '.$site.''.LIEN_CALENDRIER.'');
?>