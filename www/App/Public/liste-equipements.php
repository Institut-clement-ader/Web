<?php

/**
 * Améliorations à apporter :
 */

//détection de langue courante de la page
$currentlang = get_bloginfo('language');

if (strpos($currentlang, 'fr') !== false) {
	include('App/lang-fr.php');
} elseif (strpos($currentlang, 'en') !== false) {
	include('App/lang-en.php');
} else {
	echo ("échec de reconnaissance de la langue");
}


require("App/GestionBdd.php");
$bdd = new GestionBdd();

//NOMBRE D'EQUIPEMENTS
$nb_moyens = $bdd->nombreEquipement();
//Affichage selon le nombre de resultats
if ($nb_moyens == 0)
	$nb_moyens = TXT_AUCUN_EQUIPEMENT;
if ($nb_moyens > 1)
	echo $nb_moyens . TXT_EQUIPEMENTS_EQUIPEMENT . "<br><br>";
else
	echo $nb_moyens . TXT_EQUIPEMENT_EQUIPEMENT . "<br><br>";

//CARACTERISATION Matériaux
$categorie = "Caractérisation matériaux";
$res = $bdd->analyseListeEquipement($categorie);
//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
if ($res[0][0] > 0)
?>
<br>
<p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong><?= TXT_CMECANIQUE_EQUIPEMENT ?></strong></p>
<?php
echo do_shortcode('[pods name="moyen" where="categorie=\'Caractérisation matériaux\'" template="Tableau des moyens" limit="1000"]');

//ESSAIS
$categorie = "Essais";
$res = $bdd->analyseListeEquipement($categorie);
//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
if ($res[0][0] > 0)
?>
<br>
<p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong><?= TXT_ESSAIS ?></strong></p>
<?php
echo do_shortcode('[pods name="moyen" where="categorie=\'Essais\'" template="Tableau des moyens" limit="1000"]');

//FABRICATION
$categorie = "Fabrication";
$res = $bdd->analyseListeEquipement($categorie);
//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
if ($res[0][0] > 0)
?>
<br>
<p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong><?= TXT_FABRICATION_EQUIPEMENT ?></strong></p>
<?php
echo do_shortcode('[pods name="moyen" where="categorie=\'Fabrication\'" template="Tableau des moyens" limit="1000"]');



//INSTRUMENTATION
$categorie = "Instrumentation";
$res = $bdd->analyseListeEquipement($categorie);
//Affichage du titre puis de la liste des équipiments (en utilisant un template Pods)
if ($res[0][0] > 0)
?>
<br>
<p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong><?= TXT_INSTRUMENTATION ?></strong></p>
<?php
echo do_shortcode('[pods name="moyen" where="categorie=\'Instrumentation\'" template="Tableau des moyens" limit="1000"]');

//INSTRUMENTATION
$categorie = "Autres";
$res = $bdd->analyseListeEquipement($categorie);
//Affichage du titre puis de la liste des équipiments (en utilisant un template Pods)
if ($res[0][0] > 0)
?>
<br>
<p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong><?= TXT_AUTRES ?></strong></p>
<?php
echo do_shortcode('[pods name="moyen" where="categorie=\'Autres\'" template="Tableau des moyens" limit="1000"]');
