<?php
	//LIAISON A LA BDD
	$serveur="mysql2.lamp.ods";
	$utilisateur="lab0612sql3";
	$password="XY02b21aBLaq";
	$db="lab0612sql3db";
	
	try{
		$bdd = new PDO('mysql:host='.$serveur.';dbname='.$db, $utilisateur, $password);
	} catch(PDOException $e) {
		print "Erreur : ".$e->getMessage();
		die();
	}

// require("codes snippet/GestionBdd.php");
// $bdd = new GestionBdd();

	//NOMBRE D'EQUIPEMENTS
	$requete="SELECT COUNT(*) FROM `wp_pods_moyen`";
        $nb_moyens = $bdd->query($requete)->fetchColumn();
	//Affichage selon le nombre de resultats
	if ($nb_moyens == 0)
		$nb_moyens= "Aucun";
	if ($nb_moyens > 1)
		echo $nb_moyens." équipements disponibles sur Toulouse et Albi.<br><br>";
	else
		echo $nb_moyens." équipement disponible sur Toulouse et Albi.<br><br>";

	//ANALYSE PHYSICO-CHIMIQUE
	$requete="SELECT count(*) FROM `wp_pods_moyen` WHERE `categorie` = :type";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Analyse physico-chimique"));
	$res = $req->fetchAll();
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		echo "<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Analyse physico-chimique</strong></p>";
	echo do_shortcode('[pods name="moyen" where="categorie=\'Analyse physico-chimique\'" template="Tableau des moyens (Gestion)" limit="1000"]');


	//CARACTERISATION MECANIQUE
	$requete="SELECT count(*) FROM `wp_pods_moyen` WHERE `categorie` = :type";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Caracterisation mecanique"));
	$res = $req->fetchAll();
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		echo "<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Caractérisation mécanique</strong></p>";
	echo do_shortcode('[pods name="moyen" where="categorie=\'Caractérisation mécanique\'" template="Tableau des moyens (Gestion)" limit="1000"]');


	//CONTROLE ET MESURE DES PIECES FABRIQUEES
	$requete="SELECT count(*) FROM `wp_pods_moyen` WHERE `categorie` = :type";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Controle et mesure des pieces fabriquees"));
	$res = $req->fetchAll();
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		echo "<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Contrôle et mesure des pièces fabriquées</strong></p>";
	echo do_shortcode('[pods name="moyen" where="categorie=\'Contrôle et mesure des pièces fabriquées\'" template="Tableau des moyens (Gestion)" limit="1000"]');


	//FABRICATION
	$requete="SELECT count(*) FROM `wp_pods_moyen` WHERE `categorie` = :type";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Fabrication"));
	$res = $req->fetchAll();
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		echo "<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Fabrication</strong></p>";
	echo do_shortcode('[pods name="moyen" where="categorie=\'Fabrication\'" template="Tableau des moyens (Gestion)" limit="1000"]');


	//SIMULATION NUMERIQUE
	$requete="SELECT count(*) FROM `wp_pods_moyen` WHERE `categorie` = :type";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Simulation numerique"));
	$res = $req->fetchAll();
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		echo "<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Simulation numérique</strong></p>";
	echo do_shortcode('[pods name="moyen" where="categorie=\'Simulation numérique\'" template="Tableau des moyens (Gestion)" limit="1000"]');


	//TRAITEMENTS THERMIQUES
	$requete="SELECT count(*) FROM `wp_pods_moyen` WHERE `categorie` = :type";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Traitements thermiques"));
	$res = $req->fetchAll();
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		echo "<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Traitements thermiques</strong></p>";
	echo do_shortcode('[pods name="moyen" where="categorie=\'Traitements thermiques\'" template="Tableau des moyens (Gestion)" limit="1000"]');
?>