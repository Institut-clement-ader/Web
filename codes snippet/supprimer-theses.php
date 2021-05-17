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


	//SUPPRESSION D'UNE THESE
	//s'il y a un id de transmis
	if (isset($_POST["id_these"])) {
        echo "BONSOIR";
		$id = $_POST["id_these"];
		
		//si l'id est defini
		if (!empty($id)) {
			//on supprime la these dont l'id a ete transmis
			$requeteT="DELETE FROM `wp_pods_these` WHERE `id` = :id LIMIT 1";
			$reqT = $bdd->prepare($requeteT);
			$reqT->execute(array('id'=>$id));
					
			//on supprime aussi ses potentielles lignes dans la table des relations
			$requeteR="DELETE FROM `wp_podsrel` WHERE `pod_id` = 862 AND `item_id` = :id";
			$reqR = $bdd->prepare($requeteR);
			$reqR->execute(array('id'=>$id));
		}
	}
?>