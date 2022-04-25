<?php

	/**
    * Améliorations à apporter :
    * Changer la liaison BDD en utilisant la classe Gestion BDD (prendre exemple sur les autres codes)
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
	
	try {
		$bdd = new PDO('mysql:host='.$serveur.';dbname='.$db, $utilisateur, $password);
	} catch(PDOException $e) {
		print "Erreur : ".$e->getMessage();
		die();
	}


	//On selectionne le nombre de theses dont le doctorant est toujours present, dont la date de soutenance est non definie ou superieure a la date courante et dont la date de debut est inferieure a la date courante
	$requete="SELECT COUNT(*) FROM wp_pods_these WHERE (id IN (SELECT item_id FROM wp_podsrel WHERE pod_id = 862 AND field_id=1380)) AND (date_soutenance IS NULL OR date_soutenance >= CURDATE()) AND (date_debut <= CURDATE())";
	$nb_theses= $bdd->query($requete)->fetchColumn();

	//Affichage selon le nombre de resultats
	if ($nb_theses == 0)
		$nb_theses = TXT_AUCUNE_TENCOURS;
	if ($nb_theses > 1)
		echo $nb_theses.TXT_THESES_TENCOURS;
	else
		echo $nb_theses.TXT_THESE_TENCOURS;
?>