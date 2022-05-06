<?php

	/**
    * Améliorations à apporter :
    * Changer la liaison BDD en utilisant la classe Gestion BDD (prendre exemple sur les autres codes)
    */


	//LIAISON A LA BDD
	require("codes snippet/GestionBdd.php");
	$bdd = new GestionBdd();

	//SUPPRESSION D'UN PROJET
	//si un id a ete transmis
	if (isset($_POST["id_projet"])) {
		$id = $_POST["id_projet"];
		if (!empty($id)) {
			//on supprime le projet dont l'id a ete transmis
			$req= $bdd->supprimerProjet1($id);
		}
	}
?>