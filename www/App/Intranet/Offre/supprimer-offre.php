<?php

	/**
    * Améliorations à apporter :
    */

//LIAISON A LA BDD
require("App/GestionBdd.php");
$bdd = new GestionBdd();

//SUPPRESSION D'UNE OFFRE
if (isset($_GET["id"])) {
	$id = $_GET["id"];
	if (!empty($id)) {
		// si l'id d'une offre est defini, on la supprime
		$req= $bdd->supprimerOffre($id);

<<<<<<< Updated upstream
		//si un fichier existe, on le supprime
		if (isset($_GET["url"])) {
			$fichier = $_GET["url"];
			if  (!empty($fichier)) {
					//SUPPRESSION DU FICHIER ASSOCIE
					$fichier = explode('/wp-content', $fichier);
					$fichier = str_replace('/', DIRECTORY_SEPARATOR, "/wp-content".$fichier[1]);
					if (file_exists(getcwd().$fichier))
						unlink(getcwd().$fichier);
=======
	//SUPPRESSION D'UNE OFFRE
	if (isset($_POST["id_offre"])) {
		$id = $_POST["id_offre"];
		if (!empty($id)) {
			// si l'id d'une offre est defini, on la supprime
			$req= $bdd->supprimerOffre($id);
			//si un fichier existe, on le supprime
			if (isset($_POST["urlfic"])) {
				$fichier = $_POST["urlfic"];
				if  (!empty($fichier)) {
						//SUPPRESSION DU FICHIER ASSOCIE
						$fichier = explode('/wp-content', $fichier);
						$fichier = str_replace('/', DIRECTORY_SEPARATOR, "/wp-content".$fichier[1]);
						if (file_exists(getcwd().$fichier))
							unlink(getcwd().$fichier);
				}
>>>>>>> Stashed changes
			}
		}
	}
	header('Location: http://ica.cnrs.fr/gestion-offres/');
}
?>