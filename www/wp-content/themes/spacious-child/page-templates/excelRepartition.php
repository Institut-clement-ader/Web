<?php

/**
 * Template Name: excelRepartition
 *
 * Displays the Page Builder Template via the theme.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.4.9
 */


//Graphique des établissements d'origine
if (isset($_POST['debut3'])) {
  //Valeur transmise par POST
  $annee = intval($_POST['debut3']);
  //nom de la colonne = année choisie
  $nomColonnes = array($annee);

  //Importer les librairies PHPExcel
	include(dirname(__FILE__).'/Excel/fonctionsExcel.php');
	require_once(dirname(__FILE__).'/Excel/Classes/PHPExcel.php');

  
  // --------------------------
  // --- CONNEXION A LA BDD ---
  // --------------------------
  
  //donnees de connexion
	$serveur="mysql2.lamp.ods";
	$utilisateur="lab0612sql3";
	$password="XY02b21aBLaq";
	$db="lab0612sql3db";

  //connexion
  try{
    $bdd = new PDO('mysql:host='.$serveur.';dbname='.$db, $utilisateur, $password);
  } catch(PDOException $e){
    print "Erreur : ".$e->getMessage();
    die();
  }
  
  
  // ------------------------------------
  // --- RÉCUPÉRER LES ÉTABLISSEMENTS ---
  // ------------------------------------

  //Requête SQL pour récupérer les établissements
  $req = $bdd->prepare('SELECT DISTINCT m.meta_value AS tutelle
                          FROM wp_usermeta m, wp_users u
                         WHERE u.id = m.user_id
                           AND m.meta_key = "tablissement_de_rattachement"
                           AND m.meta_value <> ""
                           AND m.meta_value IS NOT NULL
                         ORDER BY m.meta_value;');
  $req->execute();
  $etablissements = $req->fetchAll();
  
  //Création d'un tableau clé/valeurs avec le nom des établissements
  foreach ($etablissements as $etablissement) {
    //On regroupe l'UPS, l'IUT GMP et l'IUT de Tarbes sous le même intitulé 'UPS'
    if ($etablissement['tutelle'] === 'UPS' || $etablissement['tutelle'] === 'IUT GMP' || $etablissement['tutelle'] === 'IUT de Tarbes') {
      $tutelle = 'UPS';
    //On regroupe l'IUT de Figeac et l'UT-2 sous le même intitulé 'UT-2 Jean Jaurès' -- en tenant compte des accents
    } elseif ($etablissement['tutelle'] === 'IUT de Figeac' || html_entity_decode($etablissement['tutelle']) === 'UT-2 Jean Jaurès') {
      $tutelle = 'UT-2 Jean Jaurès';
    } else {
      $tutelle = html_entity_decode($etablissement['tutelle']);
    }
    //À chaque établissement est associé un tableau avec une seule valeur
    $tableau[$tutelle] = array(0);
  }
  ksort($tableau); //Trier le tableau selon les clés (établissements)
  
  // ---------------------------
  // --- COMPTER LES MEMBRES ---
  // ---------------------------
  
  //Récupère les utilisateurs WordPress
  $users = get_users();
  //Pour chaque membre
  foreach($users as $user) {
    //On regroupe l'UPS, l'IUT GMP et l'IUT de Tarbes sous le même intitulé 'UPS'
    if ($user->tablissement_de_rattachement === 'UPS' || $user->tablissement_de_rattachement === 'IUT GMP' || $user->tablissement_de_rattachement === 'IUT de Tarbes') {
      $tutelle = 'UPS';
    //On regroupe l'IUT de Figeac et l'UT-2 sous le même intitulé 'UT-2 Jean Jaurès' -- en tenant compte des accents
    } elseif ($user->tablissement_de_rattachement === 'IUT de Figeac' || html_entity_decode($user->tablissement_de_rattachement) === 'UT-2 Jean Jaurès') {
      $tutelle = 'UT-2 Jean Jaurès';
    } else {
      $tutelle = html_entity_decode($user->tablissement_de_rattachement);
    }
    //Variables des années d'arrivée et de départ
    $dateArrivee = intval(substr($user->arrivee, -4, 4));
    $dateDepart = intval(substr($user->depart, -4, 4));
    //si l'utilisateur était membre pendant l'année choisie
    if (($user->display_user == 1) && ($dateArrivee <= $annee || $user->arrivee === '') && ($dateDepart >= $annee || $user->depart === '')) {
      //On incrémente le nombre de membres pour l'établissement pour l'année choisie
      $tableau[$tutelle][0]++;
    }
  }
  
  // --- CRÉATION DU DIAGRAMME CIRCULAIRE
	createDonutChart(array_keys($tableau), $nomColonnes, array_values($tableau));
}
?>
