<?php
	//CONNEXION A LA BDD
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

// require("codes snippet/GestionBdd.php");
// $bdd = new GestionBdd();

	//NOMBRE D'OFFRES
	$requete="SELECT COUNT(*) FROM `wp_pods_offre_emploi`";
	$nb_offres = $bdd->query($requete)->fetchColumn();
	//Affichage selon le nombre de resultats
	if ($nb_offres == 0)
		$nb_offres = "Aucune";
	if ($nb_offres > 1)
		echo $nb_offres." offres d'emploi trouvées.<br><br>";
	else
		echo $nb_offres." offre d'emploi trouvée.<br><br>";
	

	//CONTRATS A DUREE DETERMINEE
	$requete="SELECT count(*) FROM `wp_pods_offre_emploi` WHERE `type_offre` = :type";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Contrat CDD"));
	$res = $req->fetchAll();
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		echo "<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Contrats à Durée Déterminée</strong></p>";
	echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Contrat CDD\'" template="Tableau des offres (Gestion)" limit="1000"]');


	//DOCTORATS
	$requete="SELECT count(*) FROM `wp_pods_offre_emploi` WHERE `type_offre` = :type";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Doctorat"));
	$res = $req->fetchAll();
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		echo "<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Doctorat</strong></p>";
	echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Doctorat\'" template="Tableau des offres (Gestion)" limit="1000"]
');


	//POST-DOCTORAT
	$requete="SELECT count(*) FROM `wp_pods_offre_emploi` WHERE `type_offre` = :type";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Post-doctorat"));
	$res = $req->fetchAll();
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		echo "<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Post-doctorat</strong></p>";
	echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Post-doctorat\'" template="Tableau des offres (Gestion)" limit="1000"]');


	//POSTES PERMANENTS
	$requete="SELECT count(*) FROM `wp_pods_offre_emploi` WHERE `type_offre` = :type";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Poste permanent"));
	$res = $req->fetchAll();
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		echo "<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Postes permanents</strong></p>";
	echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Poste permanent\'" template="Tableau des offres (Gestion)" limit="1000"]');


	//STAGES
	$requete="SELECT count(*) FROM `wp_pods_offre_emploi` WHERE `type_offre` = :type";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Stage"));
	$res = $req->fetchAll();
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		echo "<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Stages</strong></p>";
	echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Stage\'" template="Tableau des offres (Gestion)" limit="1000"]');
?>