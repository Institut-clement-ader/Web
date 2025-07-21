<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);




//tutelle line
if(isset($_POST['debut2'], $_POST['fin2'], $_POST['tutelle'])){

	if (!preg_match('#[0-9]{4}#', $_POST['debut2'])) {
	header('Location:../statistiques.php');
	}

	if (!preg_match('#[0-9]{4}#', $_POST['fin2'])) {
	header('Location:../statistiques.php');
	}

        if(intval($_POST['debut2'])-intval($_POST['fin2'])>0 || intval($_POST['debut2'])-intval($_POST['fin2'])<= -19){
		header('Location:../statistiques.php');
	}


	include 'fonctionsExcel.php';
	include	'../sql.inc';

	require_once (dirname(__FILE__).'/../Excel/Classes/PHPExcel.php');

	try{
		$db = new PDO('mysql:host='.$serveur.';dbname='.$db, $utilisateur, $password);
	}catch(PDOException $e){
		print "Erreur : ".$e->getMessage();
		die();
	}
	
	$nomLignes = $_POST['tutelle'];
	$debut = $_POST['debut2'];
	$fin = $_POST['fin2'];
	$ups = false;
	if (in_array('ups', $nomLignes)) {
		unset($nomLignes[array_search('ups', $nomLignes)]);
		$nomLignes = array_values($nomLignes);
		$ups = true;
	}
	
	$nomColonnes=array();
	for ($i=$debut; $i < ($fin+1); $i++) { 
		array_push($nomColonnes, strval($i));
	}
	
	$valeurs=array();
	foreach ($nomLignes as $nom) {
		$valeursLigne = array();
		for ($i=$debut; $i < ($fin+1); $i++) {
			$req = $db->prepare('SELECT COUNT(*) FROM personnel WHERE YEAR(arrivee) <= ? AND tutelle = ? AND (YEAR(depart) > ? Or YEAR(depart) = 0 OR depart IS NULL)');
			$req->execute(array($i, $nom, $i));
			$res = $req->fetch(PDO::FETCH_NUM);
			array_push($valeursLigne, $res[0]);
		}
		array_push($valeurs, $valeursLigne);
	}
	if ($ups) {
		$valeursLigne = array();
		$batiments = array('ups', 'iuttarbes', 'iutgmp');
		for ($i=$debut; $i < ($fin+1); $i++){
			$val = 0;
			foreach ($batiments as $nom) {
				$req = $db->prepare('SELECT COUNT(*) FROM personnel WHERE YEAR(arrivee) <= ? AND tutelle = ? AND (YEAR(depart) > ? Or YEAR(depart) = 0 OR depart IS NULL)');
				$req->execute(array($i, $nom, $i));
				$res = $req->fetch(PDO::FETCH_NUM);
				$val += $res[0];
			}
		array_push($valeursLigne, $val);
		}
		array_push($valeurs, $valeursLigne);
		array_push($nomLignes, 'ups');
	}
	createLineChart($nomLignes,$nomColonnes,$valeurs);
}else{
	header('Location:../statistiques.php');
}
?>
