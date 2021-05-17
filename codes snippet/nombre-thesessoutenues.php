<?php
	//LIAISON A LA BDD
	$serveur="mysql2.lamp.ods";
	$utilisateur="lab0612sql3";
	$password="XY02b21aBLaq";
	$db="lab0612sql3db";
	
	try {
		$bdd = new PDO('mysql:host='.$serveur.';dbname='.$db, $utilisateur, $password);
	} catch(PDOException $e) {
		print "Erreur : ".$e->getMessage();
		die();
	}


	//On selectionne le nombre de theses dont la soutenance est definie et inferieure a la date courante
	$requete="SELECT COUNT(*) FROM wp_pods_these WHERE NOT(date_soutenance <=> NULL) AND date_soutenance <= CURDATE()";
	$nb_theses= $bdd->query($requete)->fetchColumn();
	//Affichage selon le nombre de resultats
	if ($nb_theses == 0)
		$nb_theses = "Aucune";
	if ($nb_theses > 1)
		echo $nb_theses." thèses soutenues.";
	else
		echo $nb_theses." thèse soutenue.";
?>