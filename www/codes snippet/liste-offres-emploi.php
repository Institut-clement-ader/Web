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

// CONNEXION A LA BDD
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

	//NOMBRE D'OFFRES
	$requete="SELECT COUNT(*) FROM `wp_pods_offre_emploi` WHERE `date_fin` >= CURDATE()";
	$nb_offres = $bdd->query($requete)->fetchColumn();
	//Affichage selon le nombre de resultats
	if ($nb_offres == 0)
		$nb_offres = TXT_AUCUNE_EMPLOI;
	if ($nb_offres > 1)
		echo $nb_offres.TXT_OFFRES_EMPLOI."<br><br>";
	else
		echo $nb_offres.TXT_OFFRE_EMPLOI."<br><br>";
	
	//CONTRATS A DUREE DETERMINEE
	$requete="SELECT count(*) FROM `wp_pods_offre_emploi` WHERE `type_offre` = :type AND `date_fin` >= CURDATE()";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Contrat CDD"));
	$res = $req->fetchAll();
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		echo "<p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>".TXT_CDD_EMPLOI."</strong></p>";
	echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Contrat CDD\' AND date_fin >= \''.date('Y-m-d').'\'" template="Liste des offres" limit="1000"]');


	//DOCTORATS
	$requete="SELECT count(*) FROM `wp_pods_offre_emploi` WHERE `type_offre` = :type AND `date_fin` >= CURDATE()";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Doctorat"));
	$res = $req->fetchAll();
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		echo "<p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>".TXT_DOCTORAT_EMPLOI."</strong></p>";
	echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Doctorat\' AND date_fin >= \''.date('Y-m-d').'\'" template="Liste des offres" limit="1000"]');


	//POST-DOCTORAT
	$requete="SELECT count(*) FROM `wp_pods_offre_emploi` WHERE `type_offre` = :type AND `date_fin` >= CURDATE()";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Post-doctorat"));
	$res = $req->fetchAll();
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		echo "<p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>".TXT_PDOCTORAT_EMPLOI."</strong></p>";
	echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Post-doctorat\' AND date_fin >= \''.date('Y-m-d').'\'" template="Liste des offres" limit="1000"]');


	//POSTES PERMANENTS
	$requete="SELECT count(*) FROM `wp_pods_offre_emploi` WHERE `type_offre` = :type AND `date_fin` >= CURDATE()";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Poste permanent"));

	//STAGES
	$requete="SELECT count(*) FROM `wp_pods_offre_emploi` WHERE `type_offre` = :type AND `date_fin` >= CURDATE()";
	$req=$bdd->prepare($requete);
	$req->execute(array('type'=>"Stage"));
	$res = $req->fetchAll();
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		echo "<p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>".TXT_STAGES_EMPLOI."</strong></p>";
	echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Stage\' AND date_fin >= \''.date('Y-m-d').'\'" template="Liste des offres" limit="1000"]');

?>