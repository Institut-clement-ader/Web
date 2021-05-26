<?php
/**
 * Template Name: excelDonnees
 *
 * Displays the Page Builder Template via the theme.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.4.9
 */

  // --------------------------
  // --- CONNEXION A LA BDD ---
  // --------------------------
	$serveur="mysql2.lamp.ods";
	$utilisateur="lab0612sql3";
	$password="XY02b21aBLaq";
	$db="lab0612sql3db";

  try{
    $bdd = new PDO('mysql:host='.$serveur.';dbname='.$db, $utilisateur, $password);
  } catch(PDOException $e){
    print "Erreur : ".$e->getMessage();
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


  // ----------------------------------------
  // --- CRÉATION DE LA FEUILLE DE CALCUL ---
  // ----------------------------------------

  //Import de la librairie PHPExcel
  require_once(dirname(__FILE__).'/Excel/Classes/PHPExcel.php');

  //Création d'un document
  $objPHPExcel = new PHPExcel();

  //Sélectionne la feuille de calcul courante (1ere feuille)
  $objWorksheet = $objPHPExcel->getActiveSheet();
  $objWorksheet->setTitle('Répartition');

  //On récupère les utilisateurs WordPress
  $users = get_users();



  // ---------------------------------
  // --- FEUILLE DE CALCUL : BUDGET---
  // --------------------------------- 
  // Regroupe les tableaux permettant de faire la répartition du budget

  //création d'une nouvelle feuille de calcul
  $objWorksheet->setTitle('Budget');
  $objWorksheet->getColumnDimension('A')->setWidth(16);
  $objWorksheet->getColumnDimension('B')->setWidth(20);
  $objWorksheet->getColumnDimension('C')->setWidth(20);
  $objWorksheet->getColumnDimension('D')->setWidth(20);
  $objWorksheet->getColumnDimension('E')->setWidth(20);

  //le premier tableau est vide (les valeurs sont saisies par l'utilisateur)
  $tabbudget = array(
                    array('Etablissement', 'Dotation', 'Fonctionnement du Site', 'Partie commune ICA', 'Affectation des groupes'),
                    array('IMT Mines Albi'),
                    array('ISAE-SUPAERO'),
                    array('UPS'),
                    array('INSA de Toulouse'),
                    array('Total')
                   );
  //on ajoute les formules afin de faire le total
  $objWorksheet->fromArray($tabbudget, NULL, 'A1');
  $objWorksheet->setCellValue ("B6",'=SUM(B2:B5)',PHPExcel_Cell_DataType::TYPE_FORMULA);
  $objWorksheet->setCellValue ("C6",'=SUM(C2:C5)',PHPExcel_Cell_DataType::TYPE_FORMULA);
  $objWorksheet->setCellValue ("D6",'=SUM(D2:D5)',PHPExcel_Cell_DataType::TYPE_FORMULA);
  $objWorksheet->setCellValue ("E6",'=SUM(E2:E5)',PHPExcel_Cell_DataType::TYPE_FORMULA);



  // ----------------------------------
  // --- TABLEAU CLE DE REPARTITION ---
  // ----------------------------------
  // Contient le poids de chaque groupe au sein de l'institut

  // --- GROUPES ---
  $groupes = array('MS2M', 'MSC', 'SUMO', 'MICS');

  // --- ÉTABLISSEMENTS ---
  $emac = array('IMT Mines Albi');
  $isae = array('ISAE-SUPAERO');
  $ups = array('UPS', 'IUT GMP', 'IUT de Tarbes');
  $insa = array('INSA');
  $ecoles = array($emac, $isae, $ups, $insa);
  $nomecoles = array('IMT Mines Albi', 'ISAE-SUPAERO', 'UPS', 'INSA');

  // --- COEFFICIENTS ---
  $docstd = 0.5;
  $docinter = 0.25;
  $perm = 1;
  $autre = 0;

  $groupestab = array('', 'MS2M', 'MSC', 'SUMO', 'MICS');
  $tabcle = array($groupestab);

  //pour chaque ecole
  for ($i = 0; $i<4; $i++) {
    $lignecle = array($nomecoles[$i]);
    $val = array();

    //pour chaque groupe
    for ($j=0; $j<4; $j++) {
      $nbdocstd = 0;
      $nbdocinter = 0;
      $nbperm = 0;
      $nbautre = 0;

      //Pour chaque utilisateur
      foreach ($users as $user) {

        //Doctorant standard
        if (($user->display_user == 1) && (($user->groupe_primaire === $groupes[$j]) && (($user->groupe_secondaire === $groupes[$j]) || ($user->groupe_secondaire === '') || ($user->groupe_secondaire === 'NULL'))) && (in_array($user->tablissement_de_rattachement, $ecoles[$i])) && ($user->status === 'Doctorant'))
          $nbdocstd++;

        //Doctorant intergroupe
        if (($user->display_user == 1) && ((($user->groupe_primaire === $groupes[$j]) xor ($user->groupe_secondaire === $groupes[$j])) && (($user->groupe_secondaire != '') && $user->groupe_secondaire != 'NULL')) && (in_array($user->tablissement_de_rattachement, $ecoles[$i])) && ($user->status === 'Doctorant'))
          $nbdocinter++;

        //Permanent
        if (($user->display_user == 1) && (in_array($user->tablissement_de_rattachement, $ecoles[$i])) && !(in_array($user->status, $grpStatut['C']) || ($user->status === 'Doctorant')) && ($user->groupe_primaire === $groupes[$j]))
          $nbperm++;

        //Membre Associé
        if (($user->display_user == 1) && (in_array($user->tablissement_de_rattachement, $ecoles[$i])) && (in_array($user->status, $grpStatut['C'])) && $user->groupe_primaire === $groupes[$j])
          $nbautre++;
      }
      //on calcule la valeur totale a partir du nombre de membres et du coefficiant correspondant
      $val[] = (intval($nbdocstd)*$docstd + intval($nbdocinter)*$docinter + intval($nbperm)*$perm + intval($nbautre)*$autre);
    }
    //on fait la somme des valeurs
    $total = array_sum($val);

    //Calcul des poids en fonctions du poids total
    for ($k = 0; $k<4; $k++) {
      array_push($lignecle, round(floatval($val[$k]/$total)*100,2));
    }
    //on ajoute la valeur "lignecle" a la fin du tableau "tabcle"
    array_push($tabcle, $lignecle);
  }
  //ajout du tableau des poids sur la feuille Excel
  $objWorksheet->fromArray($tabcle, '0', 'A9', true);



  // ---------------------------
  // --- RÉPARTITION BUDGETS ---
  // ---------------------------
  // Utilise les valueurs des deux autres tableaux pour définir le budget d'un groupe par rapport à son établissement

  $tabbudget = array(array('Etablissement', 'MS2M', 'MSC', 'SUMO', 'MICS'),
                    array('IMT Mines Albi'),
                    array('ISAE-SUPAERO'),
                    array('UPS'),
                    array('INSA de Toulouse'),
                    array('Total'));

  //ajout de toutes les formules permettant de calculer automatiquement le budget de chaque groupe
  $objWorksheet->fromArray($tabbudget, NULL, 'A16');
  $objWorksheet->setCellValue ("B21" ,'=SUM(B17:B20)',PHPExcel_Cell_DataType::TYPE_FORMULA);
  $objWorksheet->setCellValue ("C21" ,'=SUM(C17:C20)',PHPExcel_Cell_DataType::TYPE_FORMULA);
  $objWorksheet->setCellValue ("D21" ,'=SUM(D17:D20)',PHPExcel_Cell_DataType::TYPE_FORMULA);
  $objWorksheet->setCellValue ("E21" ,'=SUM(E17:E20)',PHPExcel_Cell_DataType::TYPE_FORMULA);

  $lettres = array('B','C','D','E');
  foreach($lettres as $lettre) {
    $objWorksheet->setCellValue ($lettre.'17' ,'=E2*'.$lettre.'10/100',PHPExcel_Cell_DataType::TYPE_FORMULA);
    $objWorksheet->setCellValue ($lettre.'18' ,'=E3*'.$lettre.'11/100',PHPExcel_Cell_DataType::TYPE_FORMULA);
    $objWorksheet->setCellValue ($lettre.'19' ,'=E4*'.$lettre.'12/100',PHPExcel_Cell_DataType::TYPE_FORMULA);
    $objWorksheet->setCellValue ($lettre.'20' ,'=E5*'.$lettre.'13/100',PHPExcel_Cell_DataType::TYPE_FORMULA);
  }

  //Création de l'emplacement de stockage
  $url = str_replace(basename(__FILE__), 'Budgets_Coefficients', __FILE__).'.xlsx';

  //Sauvegarde du document
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save($url);

  //Modification de l'entête HTTP afin de pouvoir télécharger le document
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-disposition: attachment; filename="'.basename($url).'"');
  header("Content-Length: ".filesize($url));
  header("Pragma: no-cache");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
  header("Expires: 0");
  readfile($url);
  unlink($url);
?>