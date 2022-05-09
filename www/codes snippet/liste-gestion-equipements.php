<?php

	/**
    * Améliorations à apporter :
    */
	require("codes snippet/GestionBdd.php");
	$bdd = new GestionBdd();

	//NOMBRE D'EQUIPEMENTS
	$nb_moyens = $bdd->nombreEquipement();
	//Affichage selon le nombre de resultats
	if ($nb_moyens == 0)
		$nb_moyens= "Aucun";
	if ($nb_moyens > 1)
		echo $nb_moyens." équipements disponibles sur Toulouse et Albi.<br><br>";
	else
		echo $nb_moyens." équipement disponible sur Toulouse et Albi.<br><br>";

	//ANALYSE PHYSICO-CHIMIQUE
	$categorie ="Analyse physico-chimique";
	$res = $bdd->analyseListeEquipement($categorie);
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
  		?>
		<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Equipement Analyse physico-chimique</strong></p>
		<?php
		echo do_shortcode('[pods name="moyen" where="categorie=\'Analyse physico-chimique\'" template="Tableau des moyens" limit="1000"]');


	//CARACTERISATION MECANIQUE
	$categorie ="Caractérisation mécanique";
	$res = $bdd->analyseListeEquipement($categorie);
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		?>
		<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Equipement Caractérisation mécanique</strong></p>
		<?php
		echo do_shortcode('[pods name="moyen" where="categorie=\'Caractérisation mécanique\'" template="Tableau des moyens" limit="1000"]');


	//CONTROLE ET MESURE DES PIECES FABRIQUEES
	$categorie ="Contrôle et mesure des pièces fabriquées";
	$res = $bdd->analyseListeEquipement($categorie);
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		?>
		<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Equipement Contrôle et mesure des pièces fabriquées</strong></p>
		<?php
		echo do_shortcode('[pods name="moyen" where="categorie=\'Contrôle et mesure des pièces fabriquées\'" template="Tableau des moyens" limit="1000"]');


	//FABRICATION
	$categorie ="Fabrication";
	$res = $bdd->analyseListeEquipement($categorie);
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		?>
		<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Equipement Fabrication</strong></p>
		<?php
		echo do_shortcode('[pods name="moyen" where="categorie=\'Fabrication\'" template="Tableau des moyens" limit="1000"]');


	//SIMULATION NUMERIQUE
	$categorie ="Simulation numérique";
	$res = $bdd->analyseListeEquipement($categorie);
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		?>
		<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Equipement Simulation numérique</strong></p>
		<?php
		echo do_shortcode('[pods name="moyen" where="categorie=\'Simulation numérique\'" template="Tableau des moyens" limit="1000"]');


	//TRAITEMENTS THERMIQUES
	$categorie ="Traitements thermiques";
	$res = $bdd->analyseListeEquipement($categorie);
	//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
	if ($res[0][0] > 0)
		?>
		<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Equipement Traitements thermiques</strong></p>
		<?php
		echo do_shortcode('[pods name="moyen" where="categorie=\'Traitements thermiques\'" template="Tableau des moyens" limit="1000"]');
?>