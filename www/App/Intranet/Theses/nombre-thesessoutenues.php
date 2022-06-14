<?php

	/**
    * Améliorations à apporter :
    */

	require("App/GestionBdd.php");
	$bdd = new GestionBdd();

	//On selectionne le nombre de theses dont la soutenance est definie et inferieure a la date courante
	$nb_theses = $bdd-> nbThesesSoutenues();

	//Affichage selon le nombre de resultats
	if ($nb_theses == 0)
		$nb_theses = "Aucune";
	if ($nb_theses > 1)
		echo $nb_theses." thèses soutenues.";
	else
		echo $nb_theses." thèse soutenue.";
?>