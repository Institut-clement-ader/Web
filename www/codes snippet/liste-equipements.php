<?php

	/**
    * Améliorations à apporter :
    * Changer la liaison BDD en utilisant la classe Gestion BDD (prendre exemple sur les autres codes)
    * Enlever les echo en utilisant les balises php.
    */


  //détection de langue courante de la page
  $currentlang = get_bloginfo('language');

  if(strpos($currentlang,'fr')!==false){
    include('codes snippet/lang-fr.php');
  }elseif(strpos($currentlang,'en')!==false){
    include('codes snippet/lang-en.php');
  }else{
    echo("échec de reconnaissance de la langue");
  }


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
		$nb_moyens= TXT_AUCUN_EQUIPEMENT;
	if ($nb_moyens > 1)
		echo $nb_moyens.TXT_EQUIPEMENTS_EQUIPEMENT."<br><br>";
	else
		echo $nb_moyens.TXT_EQUIPEMENT_EQUIPEMENT."<br><br>";

	//ANALYSE PHYSICO-CHIMIQUE
	$requete="SELECT count(*) FROM `wp_pods_moyen` WHERE `categorie` = :type";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Analyse physico-chimique"));
	$res = $req->fetchAll();
	if ($res[0][0] > 0)
		echo "<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>".TXT_PHYSICO_EQUIPEMENT."</strong></p>";
	echo do_shortcode('[pods name="moyen" where="categorie=\'Analyse physico-chimique\'" template="Tableau des moyens" limit="1000"]');


	//CARACTERISATION MECANIQUE
	$requete="SELECT count(*) FROM `wp_pods_moyen` WHERE `categorie` = :type";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Caracterisation mecanique"));
	$res = $req->fetchAll();
	if ($res[0][0] > 0)
		echo "<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>".TXT_CMECANIQUE_EQUIPEMENT."</strong></p>";
	echo do_shortcode('[pods name="moyen" where="categorie=\'Caractérisation mécanique\'" template="Tableau des moyens" limit="1000"]');


	//CONTROLE ET MESURE DES PIECES FABRIQUEES
	$requete="SELECT count(*) FROM `wp_pods_moyen` WHERE `categorie` = :type";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Controle et mesure des pieces fabriquees"));
	$res = $req->fetchAll();
	if ($res[0][0] > 0)
		echo "<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>".TXT_CONTROLE_EQUIPEMENT."</strong></p>";
	echo do_shortcode('[pods name="moyen" where="categorie=\'Contrôle et mesure des pièces fabriquées\'" template="Tableau des moyens" limit="1000"]');


	//FABRICATION
	$requete="SELECT count(*) FROM `wp_pods_moyen` WHERE `categorie` = :type";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Fabrication"));
	$res = $req->fetchAll();
	if ($res[0][0] > 0)
		echo "<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>".TXT_FABRICATION_EQUIPEMENT."</strong></p>";
	echo do_shortcode('[pods name="moyen" where="categorie=\'Fabrication\'" template="Tableau des moyens" limit="1000"]');


	//SIMULATION NUMERIQUE
	$requete="SELECT count(*) FROM `wp_pods_moyen` WHERE `categorie` = :type";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Simulation numerique"));
	$res = $req->fetchAll();
	if ($res[0][0] > 0)
		echo "<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>".TXT_SIMUNUMERIQUE_EQUIPEMENT."</strong></p>";
	echo do_shortcode('[pods name="moyen" where="categorie=\'Simulation numérique\'" template="Tableau des moyens" limit="1000"]');


	//TRAITEMENTS THERMIQUES
	$requete="SELECT count(*) FROM `wp_pods_moyen` WHERE `categorie` = :type";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Traitements thermiques"));
	$res = $req->fetchAll();
	if ($res[0][0] > 0)
		echo "<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>".TXT_THERMIQUES_EQUIPEMENT."</strong></p>";
	echo do_shortcode('[pods name="moyen" where="categorie=\'Traitements thermiques\'" template="Tableau des moyens" limit="1000"]');
?>