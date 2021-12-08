<?php
    $user = wp_get_current_user();
    $username = $user->first_name." ".$user->last_name;
    wp_mail('ap-ica@insa-toulouse.fr', 'Nouvelle observation RSST', 'Bonjour,
    
    Une nouvelle observation vient d\'être déposé par '.$username.' dans le registre santée et sécurité du travail.','Bonjour,');
    wp_mail('jean-francois.ferrero@univ-tlse3.fr', 'Nouvelle observation RSST', 'Bonjour,
    
    Une nouvelle observation vient d\'être déposé par '.$username.' dans le registre santée et sécurité du travail.','Bonjour,');
    header('Location: http://ica.cnrs.fr/ajouter-une-nouvelle-observation/');
?>