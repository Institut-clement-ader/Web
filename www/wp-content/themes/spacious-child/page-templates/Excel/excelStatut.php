<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

//statut line
if(isset($_POST['debut'], $_POST['fin'], $_POST['statut'])){

	if (!preg_match('#[0-9]{4}#', $_POST['debut'])) {
		header('Location:../statistiques.php');
	}

	if (!preg_match('#[0-9]{4}#', $_POST['fin'])) {
		header('Location:../statistiques.php');
	}

        if(intval($_POST['debut'])-intval($_POST['fin'])>0 || intval($_POST['debut'])-intval($_POST['fin'])<= -19){
		header('Location:../statistiques.php');
	}

	include '../sql.inc';
	include 'fonctionsExcel.php';	

	require_once (dirname(__FILE__).'/../Excel/Classes/PHPExcel.php');

	try{
		$db = new PDO('mysql:host='.$serveur.';dbname='.$db, $utilisateur, $password);
	}catch(PDOException $e){
		print "Erreur : ".$e->getMessage();
		die();
	}
	
	$nomLignes = $_POST['statut'];
	$debut = $_POST['debut'];
	$fin = $_POST['fin'];
	
	$nomColonnes=array();
	for ($i=$debut; $i < ($fin+1); $i++) { 
		array_push($nomColonnes, strval($i));
	}
	
	$valeurs=array();
	foreach ($nomLignes as $nom) {
		$valeursLigne = array();
		for ($i=$debut; $i < ($fin+1); $i++) {
			$req = $db->prepare('SELECT COUNT(*) FROM personnel WHERE YEAR(arrivee) <= ? AND statut = ? AND (YEAR(depart) > ? Or YEAR(depart) = 0 OR depart IS NULL)');
			$req->execute(array($i, $nom, $i));
			$res = $req->fetch(PDO::FETCH_NUM);
			array_push($valeursLigne, $res[0]);
		}
		array_push($valeurs, $valeursLigne);
	}
	createLineChart($nomLignes,$nomColonnes,$valeurs);
}else{
	header('Location:../statistiques.php');
}
?>
