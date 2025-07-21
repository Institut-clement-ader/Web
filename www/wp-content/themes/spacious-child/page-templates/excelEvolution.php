<?php

/**
 * Template Name: excelEvolution
 *
 * Displays the Page Builder Template via the theme.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.4.9
 */

//Fonction permettant de retourner la lettre associé au rang dans l'alphabet donné en paramètre
function ChiffreLettreAlphabet($chiffre)
{
  $alphabet = range('A', 'Z');
  return $alphabet[$chiffre];
}


//si les valeurs transmises sont bien definies
if (isset($_POST['debut1']) && isset($_POST['fin1']) && isset($_POST['groupe'])) {

  //valeurs transmises dans des variables
  $debut = $_POST['debut1'];
  $fin = $_POST['fin1'];
  $groupe = $_POST['groupe'];

  //si la date de fin est AVANT la date de debut => on inverse les variables
  if (intval($debut) - intval($fin) > 0) {
    $date_tmp = $fin;
    $fin = $debut;
    $debut = $date_tmp;
  }

  //s'il y a un ecart trop grand entre la fin et le debut (provoque des erreurs) => on change la date de debut
  if (intval($fin) - intval($debut) >= 19) {
    $debut = $fin - 18;
  }

  //Tableau contenant les années dans l'intervalle choisi
  $annees = array();
  for ($i = $debut; $i < $fin + 1; $i++) {
    $annees[] = $i;
  }

  // --------------------------
  // --- CONNEXION A LA BDD ---
  // --------------------------

  //connexion
  try {
    $bdd =
      new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch (PDOException $e) {
    print "Erreur : " . $e->getMessage();
    die();
  }



  // -----------------------------------------------
  // --- CORRESPONDANCES ENTRE STATUTS ET GROUPE ---
  // -----------------------------------------------

  //Liste des statuts pour chaque groupe
  $grpStatut = array(
    //Professeurs et équiv
    'A' => array('Professeur', 'Directeur de recherche'),
    //Maître de conférences et équiv
    'B' => array('Maître de conférences', 'Maître assistant', 'Chargé de recherche', 'Ingénieur - Chercheur', 'Enseignant-chercheur', 'Professeur agregé', 'Professeur émérite'),
    //Ingénieurs, techniciens, administratif
    'C' => array('Administratif', 'Technicien', 'Ingénieur de recherche', 'Assistant ingénieur'),
    //Doctorants, ATER, Post-doctorants
    'D' => array('Doctorant', 'Ingénieur', 'Attaché temporaire d\'enseignement et de recherche', 'Post-doctorant'),
    //Membres associés
    'E' => array('Maître de conférences associé', 'Enseignant-chercheur associé', 'Maître assistant associé', 'Professeur associé', 'Professeur agrégé associé')
  );

  //Intitulé de chaque groupe
  $grpStatutLibelles = array(
    'A' => 'Profs et équiv',
    'B' => 'MCF et équiv',
    'C' => 'Ingés, Tech, Adm',
    'D' => 'Docs, ATER, Post-doc',
    'E' => 'Membres associés'
  );

  //on garde seulement le groupe selectionne par l'utilisateur (formulaire)
  $grpStatut = array_slice($grpStatut, $groupe, 1);
  $grpStatutLibelles = array_slice($grpStatutLibelles, $groupe, 1);



  // ------------------------------------
  // --- RÉCUPÉRER LES ÉTABLISSEMENTS ---
  // ------------------------------------

  //Requete SQL
  $req = $bdd->prepare('SELECT DISTINCT m.meta_value AS tutelle
                            FROM wp_usermeta m, wp_users u
                           WHERE u.id = m.user_id
                             AND m.meta_key = "tablissement_de_rattachement"
                             AND m.meta_value <> ""
                             AND m.meta_value IS NOT NULL
                           ORDER BY m.meta_value');
  $req->execute();
  $etablissements = $req->fetchAll();



  // -----------------------------------
  // --- CRÉATION DE LA 1ERE FEUILLE ---
  // -----------------------------------

  //Import de la librairie PHPExcel
  require_once(dirname(__FILE__) . '/Excel/Classes/PHPExcel.php');

  //Création d'un document
  $objPHPExcel = new PHPExcel();

  //Sélectionne la feuille de calcul courante (1ere feuille)
  $objWorksheet = $objPHPExcel->getActiveSheet();



  // -----------------------------------------------
  // --- NOMBRE DE MEMBRES DES GROUPES A,B,C,D,E ---
  // -----------------------------------------------
  // On récupère pour chaque établissement et pour chaque année de l'intervalle donné, le nombre de membre appartenant à un groupe donné

  //On récupère les utilisateurs WordPress
  $users = get_users();

  foreach ($grpStatut as $grp => $statuts) {
    //Création d'un tableau clé/valeurs avec le nom des établissements
    foreach ($etablissements as $etablissement) {
      //On regroupe l'UPS, l'IUT GMP et l'IUT de Tarbes sous le même intitulé 'UPS'
      if ($etablissement['tutelle'] === 'UPS' || $etablissement['tutelle'] === 'IUT GMP' || $etablissement['tutelle'] === 'IUT de Tarbes') {
        $tutelle = 'UPS';
      } elseif ($etablissement['tutelle'] === 'IUT de Figeac' || html_entity_decode($etablissement['tutelle']) === 'UT-2 Jean Jaurès') {
        $tutelle = 'UT-2 Jean Jaurès';
      } else {
        $tutelle = html_entity_decode($etablissement['tutelle']);
      }
      //À chaque établissement est associé un tableau avec une valeur pour chaque année
      foreach ($annees as $annee) {
        $tableauGrp[$tutelle][$annee] = 0;
      }
    }
    //Trier le tableau selon les clés (établissements)
    ksort($tableauGrp);

    $totalUsersAnnees = array();
    foreach ($annees as $annee) {
      //pour chaque utilisateur WordPress
      foreach ($users as $user) {
        //On regroupe l'UPS, l'IUT GMP et l'IUT de Tarbes sous le même intitulé 'UPS'
        if ($user->tablissement_de_rattachement === 'UPS' || $user->tablissement_de_rattachement === 'IUT GMP' || $user->tablissement_de_rattachement === 'IUT de Tarbes') {
          $tutelle = 'UPS';
        } elseif ($user->tablissement_de_rattachement === 'IUT de Figeac' || html_entity_decode($user->tablissement_de_rattachement) === 'UT-2 Jean Jaurès') {
          $tutelle = 'UT-2 Jean Jaurès';
        } else {
          $tutelle = html_entity_decode($user->tablissement_de_rattachement);
        }

        //Variables des années d'arrivée et de départ
        $dateArrivee = intval(substr($user->arrivee, -4, 4));
        $dateDepart = intval(substr($user->depart, -4, 4));

        //si l'utilisateur était membre pendant l'année choisie
        if (in_array($user->status, $statuts) && ($dateArrivee <= $annee || $user->arrivee === '') && ($dateDepart >= $annee || $user->depart === '') && $tutelle != '')
          $tableauGrp[$tutelle][$annee]++; //On incrémente le nombre de membres
      }
    }

    //On ajoute les donnees dans un tableau Excel
    $colonne = array();
    $tableauExcel = array();
    $colonne[$grp] = $annees;
    array_unshift($colonne[$grp], $grpStatutLibelles[$grp]);
    $tableauExcel[] = $colonne[$grp];
    foreach ($tableauGrp as $nomTutelle => $totauxParAnnee) {
      array_unshift($totauxParAnnee, $nomTutelle);
      $tableauExcel[] = $totauxParAnnee;
    }
    /*    
      //Situer le tableau au bon endroit //(LORSQUE LES TABLEAUX ETAIENT SUR LA MEME FEUILLE)
      if ($grp === 'A') {
        $cellule = 'A1';
        
      } elseif ($grp === 'B') {
        $cellule = ChiffreLettreAlphabet(sizeof($annees)+2) . '1';
        
      } elseif ($grp === 'C') {
        $cellule = 'A'.(sizeof($tableauGrp)+3);
        
      } elseif ($grp === 'D') {
        $cellule = ChiffreLettreAlphabet(sizeof($annees)+2) . (sizeof($tableauGrp)+3);
        
      } elseif ($grp === 'E') {
        $cellule = 'A'.((sizeof($tableauGrp)+2)*2+1);
      }*/

    //Le tableau obtenu est ajouté au document Excel
    $objWorksheet->fromArray($tableauExcel, NULL, 'A1', true);
    $objWorksheet->setTitle($grpStatutLibelles[$grp]); //Titre
    $objWorksheet->getColumnDimension(substr('A1', 0, 1))->setWidth(20); //Largeur de colonne
  }



  // ---------------------------------------------------------
  // --- FEUILLE SUIVANTE : LISTE DES MEMBRES PAR GROUPE ---
  // ---------------------------------------------------------

  // --- ONGLETS DES GROUPES A, B, C, D ET E ---
  foreach ($grpStatut as $grp => $statuts) {
    $objWorksheet2 = $objPHPExcel->createSheet();
    //Titre de la feuille (-> libellé du groupe)
    $objWorksheet2->setTitle("Liste des membres");
    //Définir la largeur des colonnes
    $objWorksheet2->getColumnDimension('A')->setWidth(16);
    $objWorksheet2->getColumnDimension('B')->setWidth(14);
    $objWorksheet2->getColumnDimension('C')->setWidth(20);
    $objWorksheet2->getColumnDimension('D')->setWidth(12);
    $objWorksheet2->getColumnDimension('E')->setWidth(12);
    //En-têtes des colonnes
    $labels = array(array('NOM', 'PRENOM', 'TUTELLE', 'GROUPE 1', 'GROUPE 2'));
    $objWorksheet2->fromArray($labels, NULL, 'A1');
    //Liste des membres
    $liste = array();
    //pour chaque utilisateur
    foreach ($users as $user) {
      //si son statut est valide et qu'il est toujours affiche dahs l'annuaire -> on ajoute ses donnees
      if ($user->display_user == 1 && in_array($user->status, $statuts))
        $liste[] = array(esc_attr(html_entity_decode($user->last_name)), esc_attr(html_entity_decode($user->first_name)), esc_attr(html_entity_decode($user->tablissement_de_rattachement)), esc_attr(html_entity_decode($user->groupe_primaire)), esc_attr(html_entity_decode($user->groupe_secondaire)));
    }
    sort($liste); //trier la liste
    $objWorksheet2->fromArray($liste, NULL, 'A2'); //insérer dans la feuille Excel
  }




  //Création de l'emplacement de stockage
  $url = str_replace(basename(__FILE__), 'Evolution_Membres_' . ChiffreLettreAlphabet($groupe) . '_' . $debut . '-' . $fin, __FILE__) . '.xlsx';

  //Sauvegarde du document
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save($url);

  //Modification de l'entête HTTP afin de pouvoir télécharger le document
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-disposition: attachment; filename="' . basename($url) . '"');
  header("Content-Length: " . filesize($url));
  header("Pragma: no-cache");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
  header("Expires: 0");
  readfile($url);
  unlink($url);
}
