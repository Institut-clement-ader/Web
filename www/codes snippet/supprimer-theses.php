<?php

	/**
    * Améliorations à apporter :
    * Changer la liaison BDD en utilisant la classe Gestion BDD (prendre exemple sur les autres codes)
    */

	//LIAISON A LA BDD
	require("codes snippet/GestionBdd.php");
	$bdd = new GestionBdd();


	//SUPPRESSION D'UNE THESE
	//s'il y a un id de transmis
	if (isset($_POST["id_these"])) {
        echo "BONSOIR";
		$id = $_POST["id_these"];
		
		//si l'id est defini
		if (!empty($id)) {
			//on supprime la these dont l'id a ete transmis
			$req= $bdd->supprimerThese($id);
					
			//on supprime aussi ses potentielles lignes dans la table des relations
			$req= $bdd->supprimerTheseRelations($id);
		}
	}
?>