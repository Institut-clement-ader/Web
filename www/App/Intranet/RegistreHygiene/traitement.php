<?php

require("App/GestionBdd.php");

if (isset($_POST['valider'])){
      
    $date_consultation_chef_structure = $_POST['date_consultation_chef_structure'];
    $nom_chef_structure = $_POST['nom_prenom'];
    $observations_du_responsable = $_POST['observation'];
    $visa = $_POST['visa'];
    $id = $_POST['id'];
    $db = new GestionBdd();
    if($db->completerObservation($date_consultation_chef_structure, $nom_chef_structure, $observations_du_responsable, $visa, $id) == true){
      echo 'Enregistrement ok';
      header('Location: '.site_url().'/consulter-les-nouvelles-observations/');
    }

    
}
