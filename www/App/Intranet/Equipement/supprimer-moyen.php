<?php

	/**
    * Améliorations à apporter :
    */

	// PAGE NON UTILISEE SUR LE SITE

	//LIAISON A LA BDD
	require("App/GestionBdd.php");
	$bdd = new GestionBdd();
	//SUPPRESSION D'UN MOYEN
	//si un id a bien ete transmis
	if (isset($_GET["id"])) {
		$id = $_GET["id"];
		if (!empty($id)) {
			// si l'id d'un moyen est defini, on le supprime
			$req= $bdd->supprimerMoyen($id);

			//si un fichier est defini
			if (isset($_GET["url"])) {
				$fichier = $_GET["url"];
				if (!empty($fichier)) {
						//SUPPRESSION DU FICHIER ASSOCIE
						$fichier = explode('/wp-content', $fichier);
						$fichier = str_replace('/', DIRECTORY_SEPARATOR, "/wp-content".$fichier[1]);
						if (file_exists(getcwd().$fichier))
							unlink(getcwd().$fichier);
				}
			}
		}
        header('Location: http://ica.cnrs.fr/gestion-equipements/');
	}
?>