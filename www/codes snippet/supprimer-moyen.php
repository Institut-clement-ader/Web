<?php
	/**
    * Améliorations à apporter :
    */

	//PAGE NON UTILISEE SUR LE SITE

// 	//LIAISON A LA BDD
// 	require("codes snippet/GestionBdd.php");
// 	$bdd = new GestionBdd();
// 	echo"Coucou";
// 	//SUPPRESSION D'UN MOYEN
// 	//si un id a bien ete transmis
// 	if (isset($_POST["id_moyen"])) {
// 		$id = $_POST["id_moyen"];
// 		if (!empty($id)) {
// 			// si l'id d'un moyen est defini, on le supprime
// 			$req= $bdd->supprimerMoyen($id);

// 			//si un fichier est defini
// 			if (isset($_POST["urlfic"])) {
// 				$fichier = $_POST["urlfic"];
// 				if (!empty($fichier)) {
// 						//SUPPRESSION DU FICHIER ASSOCIE
// 						$fichier = explode('/wp-content', $fichier);
// 						$fichier = str_replace('/', DIRECTORY_SEPARATOR, "/wp-content".$fichier[1]);
// 						if (file_exists(getcwd().$fichier))
// 							unlink(getcwd().$fichier);
// 				}
// 			}
// 		}
// 	}
?>
