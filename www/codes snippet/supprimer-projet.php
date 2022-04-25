<?php

	/**
    * Améliorations à apporter :
    * Changer la liaison BDD en utilisant la classe Gestion BDD (prendre exemple sur les autres codes)
    */


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

	//SUPPRESSION D'UN PROJET
	//si un id a ete transmis
	if (isset($_POST["id_projet"])) {
		$id = $_POST["id_projet"];
		if (!empty($id)) {
			//on supprime le projet dont l'id a ete transmis
			$requete="DELETE FROM `wp_pods_projet` WHERE `id` = :id LIMIT 1";
			$req = $bdd->prepare($requete);
			$req->execute(array('id'=>$id));
		}
	}
?>