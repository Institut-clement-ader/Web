<?php
/**
 * Template Name: excelRegistre
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

  // ----------------------------------------
  // --- CRÉATION DE LA FEUILLE DE CALCUL ---
  // ----------------------------------------

  //Import de la librairie PHPExcel
  require_once(dirname(__FILE__).'/Excel/Classes/PHPExcel.php');

  //Création d'un document
  $objPHPExcel = new PHPExcel();

  //Sélectionne la feuille de calcul courante (1ere feuille)
  $objWorksheet = $objPHPExcel->getActiveSheet();
  $objWorksheet->setTitle('Registre Hygiene');

  // ---------------------------------
  // --- FEUILLE DE REGISTRE : REGISTRE---
  // --------------------------------- 
  

  //création du tableau
  $objWorksheet->setTitle('Registre');
  $objWorksheet->getColumnDimension('A')->setWidth(20);
  $objWorksheet->getColumnDimension('B')->setWidth(20);
  $objWorksheet->getColumnDimension('C')->setWidth(30);
  $objWorksheet->getColumnDimension('D')->setWidth(20);
  $objWorksheet->getColumnDimension('E')->setWidth(40);
  $objWorksheet->getColumnDimension('F')->setWidth(120);
  $objWorksheet->getColumnDimension('G')->setWidth(70);
  $objWorksheet->getColumnDimension('H')->setWidth(40);
  $objWorksheet->getColumnDimension('I')->setWidth(40);
  $objWorksheet->getColumnDimension('J')->setWidth(100);
 

 
  $intitule = array(
                    array('DATE SAISIE', 'HEURE SAISIE', 'AGENT OU USAGER', 'STATUT', 'TYPE OBSERVATION', 'OBSERVATIONS', 'PROPOSITIONS', 'DATE VALIDATION (CHEF STRUCTURE)', 'NOM ET PRENOM (CHEF STRUCTURE)', 'OBSERVATION (CHEF STRUCTURE)'));
  //on ajoute les intitules
  $objWorksheet->fromArray($intitule, NULL, 'A1');

  //Requete SQL
  $req = $bdd->prepare('SELECT * 
                        FROM wp_pods_observation_rsst
                        ORDER BY date_saisie');
  $req->execute();
  if(isset($req)){
          while($row = $req->fetch()){
            $username = $row['nom']." ".$row['prenom'];
            $dateSaisie = ($row['date_saisie']);
            if($row['visa'] == 0){
              $dateConsultationChefStructure = 'Non Lu';
            } else {
              $dateConsultationChefStructure = (date('d/m/y', strtotime(($row['date_consultation_chef_structure']))));
            }
            
            $liste[] = array(esc_attr(date('d/m/y', strtotime($dateSaisie))), esc_attr($row['heure_saisie']), utf8_encode($username), utf8_encode(ucfirst($row['position'])), utf8_encode(ucfirst($row['sujet'])), utf8_encode(ucfirst($row['observations'])), utf8_encode(ucfirst($row['propositions'])), $dateConsultationChefStructure, utf8_encode(ucfirst($row['nom_chef_structure'])), utf8_encode(ucfirst($row['observations_du_responsable'])));
  }
  $objWorksheet->fromArray($liste, NULL, 'A2'); //insérer dans la feuille Excel
  }


  //Création de l'emplacement de stockage
  $url = str_replace(basename(__FILE__), 'Registre_Hygiene', __FILE__).'.xlsx';

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