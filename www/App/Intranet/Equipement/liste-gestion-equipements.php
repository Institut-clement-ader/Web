<?php

/**
 * Améliorations à apporter :
 */
?>
<?php
require("App/GestionBdd.php");
$bdd = new GestionBdd();

//NOMBRE D'EQUIPEMENTS
$nb_moyens = $bdd->nombreEquipement();
//Affichage selon le nombre de resultats
if ($nb_moyens == 0)
	$nb_moyens = "Aucun";
if ($nb_moyens > 1)
	echo $nb_moyens . " équipements disponibles sur Toulouse et Albi.<br><br>";
else
	echo $nb_moyens . " équipement disponible sur Toulouse et Albi.<br><br>";

//CARACTERISATION MATERIAUX
$categorie = "Caractérisation matériaux";
$res = $bdd->analyseListeEquipement($categorie);
//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
if ($res[0][0] > 0)
?>
<br>
<p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Caractérisation matériaux</strong></p>
<?php
echo do_shortcode('[pods name="moyen" where="categorie=\'Caractérisation matériaux\'" template="Tableau des moyens (gestion)" limit="1000"]');

//ESSAIS
$categorie = "Essais";
$res = $bdd->analyseListeEquipement($categorie);
//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
if ($res[0][0] > 0)
?>
<br>
<p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Essais</strong></p>
<?php
echo do_shortcode('[pods name="moyen" where="categorie=\'Essais\'" template="Tableau des moyens (gestion)" limit="1000"]');


//FABRICATION
$categorie = "Fabrication";
$res = $bdd->analyseListeEquipement($categorie);
//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
if ($res[0][0] > 0)
?>
<br>
<p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Fabrication</strong></p>
<?php
echo do_shortcode('[pods name="moyen" where="categorie=\'Fabrication\'" template="Tableau des moyens (gestion)" limit="1000"]');

//INSTRUMENTATION
$categorie = "Instrumentation";
$res = $bdd->analyseListeEquipement($categorie);
//Affichage du titre puis de la liste des équipiments (en utilisant un template Pods)
if ($res[0][0] > 0)
?>
<br>
<p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Instrumentation</strong></p>
<?php
echo do_shortcode('[pods name="moyen" where="categorie=\'Instrumentation\'" template="Tableau des moyens (gestion)" limit="1000"]');
