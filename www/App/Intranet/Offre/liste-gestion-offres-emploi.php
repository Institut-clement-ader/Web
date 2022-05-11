<?php

	/**
    * Améliorations à apporter :
    */

	require("App/GestionBdd.php");
	$bdd = new GestionBdd();


	//NOMBRE D'OFFRES
	$nb_offres = $bdd-> nombreOffres();
	//Affichage selon le nombre de resultats
	if ($nb_offres == 0)
		$nb_offres = "Aucune";
	if ($nb_offres > 1)
		echo $nb_offres." offres d'emploi trouvées.<br><br>";
	else
		echo $nb_offres." offre d'emploi trouvée.<br><br>";


		
//CONTRATS A DUREE DETERMINEE
$type_offre ="Contrat CDD";
$res = $bdd->analyseListeOffres($type_offre);
//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
if ($res[0][0] > 0)
	?>
	<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Contrats à Durée Déterminée</strong></p>
	<?php
	echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Contrat CDD\'" template="Tableau des offres (Gestion)" limit="1000"]');


//DOCTORATS
$type_offre ="Doctorat";
$res = $bdd->analyseListeOffres($type_offre);
//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
if ($res[0][0] > 0)
	?>
	<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Doctorat</strong></p>
	<?php
	echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Doctorat\'" template="Tableau des offres (Gestion)" limit="1000"]');


//POST-DOCTORAT
$type_offre ="Post-doctorat";
$res = $bdd->analyseListeOffres($type_offre);
//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
if ($res[0][0] > 0)
	?>
	<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Post-doctorat</strong></p>
	<?php
	echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Post-doctorat\'" template="Tableau des offres (Gestion)" limit="1000"]');


//POSTES PERMANENTS
$type_offre ="Poste permanent";
$res = $bdd->analyseListeOffres($type_offre);
//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
if ($res[0][0] > 0)
	?>
	<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Postes permanents</strong></p>
	<?php
	echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Poste permanent\'" template="Tableau des offres (Gestion)" limit="1000"]');


//STAGES
$type_offre ="Stage";
$res = $bdd->analyseListeOffres($type_offre);
//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
if ($res[0][0] > 0)
	?>
	<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Stages</strong></p>
	<?php
	echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Stage\'" template="Tableau des offres (Gestion)" limit="1000"]');
?>