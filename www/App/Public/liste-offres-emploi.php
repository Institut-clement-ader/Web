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

//NOMBRE D'OFFRES
$nb_offres = $bdd->nombreOffresDispo();
//Affichage selon le nombre de resultats
if ($nb_offres == 0)
	$nb_offres = TXT_AUCUNE_EMPLOI;
if ($nb_offres > 1)
	echo $nb_offres . TXT_OFFRES_EMPLOI . "<br><br>";
else
	echo $nb_offres . TXT_OFFRE_EMPLOI . "<br><br>";

//CONTRATS A DUREE DETERMINEE
$type_offre = "Contrat CDD";
$res = $bdd->analyseListeOffresDispo($type_offre);
//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
if ($res[0][0] > 0)
?>
<p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong><?= TXT_CDD_EMPLOI ?></strong></p>
<?php
echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Contrat CDD\' AND date_fin >= \'' . date('Y-m-d') . '\'" template="Liste des offres" limit="1000"]');


//DOCTORATS
$type_offre = "Doctorat";
$res = $bdd->analyseListeOffresDispo($type_offre);
//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
if ($res[0][0] > 0)
?>
<p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong><?= TXT_DOCTORAT_EMPLOI ?></strong></p>
<?php
echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Doctorat\' AND date_fin >= \'' . date('Y-m-d') . '\'" template="Liste des offres" limit="1000"]');


//POST-DOCTORAT
$type_offre = "Post-doctorat";
$res = $bdd->analyseListeOffresDispo($type_offre);
//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
if ($res[0][0] > 0)
?>
<p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong><? TXT_PDOCTORAT_EMPLOI ?></strong></p>
<?php
echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Post-doctorat\' AND date_fin >= \'' . date('Y-m-d') . '\'" template="Liste des offres" limit="1000"]');


//POSTES PERMANENTS
$type_offre = "Poste permanent";
$res = $bdd->analyseListeOffresDispo($type_offre);
if ($res[0][0] > 0)
?>
<br>
<p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong><?= TXT_PERMANENTS_EMPLOI ?></strong></p>
<?php
echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Poste permanent\' AND date_fin >= \'' . date('Y-m-d') . '\'" template="Tableau des offres (Gestion)" limit="1000"]');

//STAGES
$type_offre = "Stage";
$res = $bdd->analyseListeOffresDispo($type_offre);
//Affichage du titre puis de la liste d'offres (en utilisant un template Pods)
if ($res[0][0] > 0)
?>
<p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong><?= TXT_STAGES_EMPLOI ?></strong></p>
<?php
echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Stage\' AND date_fin >= \'' . date('Y-m-d') . '\'" template="Liste des offres" limit="1000"]');

?>