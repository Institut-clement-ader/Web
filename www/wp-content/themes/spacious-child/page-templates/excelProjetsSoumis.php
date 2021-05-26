<?php
/**
 * Template Name: excelProjetsSoumis
 *
 * Displays the Page Builder Template via the theme.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.4.9
 */


  // ------------------------------------
  // --- CRÉATION DE LA FEUILLE EXCEL ---
  // ------------------------------------

  //Import de la librairie PHPExcel
  require_once(dirname(__FILE__).'/Excel/Classes/PHPExcel.php');

  //Création d'un document
  $objPHPExcel = new PHPExcel();

  //Sélectionne la feuille de calcul courante
  $objWorksheet = $objPHPExcel->getActiveSheet();
  $objWorksheet->setTitle('Projets soumis'); //Titre

  //Largeur des colonnes
  $objWorksheet->getColumnDimension('A')->setWidth(14);
  $objWorksheet->getColumnDimension('B')->setWidth(120);
  $objWorksheet->getColumnDimension('C')->setWidth(30);
  $objWorksheet->getColumnDimension('D')->setWidth(30);
  $objWorksheet->getColumnDimension('E')->setWidth(30);
  $objWorksheet->getColumnDimension('F')->setWidth(30);
  $objWorksheet->getColumnDimension('G')->setWidth(30);

  // ----------------------------------
  // --- DONNÉES DES PROJETS SOUMIS ---
  // ----------------------------------

  //Intitulés des colonnes
  $tableauProjets[] = array("DATE DE DÉPÔT", "NOM", "PORTEUR(S)", "PARTENAIRES", "DÉPOSÉ AUPRÈS DE", "PROJET FINANCE");

  //Paramètres de recherche de projets
  $params = array( 
    'orderby' => 'date_depot',
    //'where' => 'type_projet = 1'
  );

  //on récupère le Pod Projets
  $projets = pods('projet', $params);

  //s'il y a des projets
  if (0 < $projets->total()) {
    //Tant qu'il y a un projet à afficher
    while ($projets->fetch()) {
      //On ajoute les données dans un tableau
      $projet = array($projets->display('date_depot'), html_entity_decode($projets->display('nom')), html_entity_decode($projets->display('porteurs')), html_entity_decode($projets->display('partenaires')));
      if ($projets->display('entite_preciser') === '') {
        $projet[] = html_entity_decode($projets->display('entite'));
      } else {
        $projet[] = html_entity_decode($projets->display('entite_preciser'));
      }
      $projet[] = html_entity_decode($projets->display('type_projet'));
      $tableauProjets[] = $projet;
    }
  }
    


  // --------------------------------------------------------
  // --- REMPLISSAGE DE LA FEUILLE EXCEL AVEC LES DONNÉES ---
  // --------------------------------------------------------

  //On met les données sur Excel
  $objWorksheet->fromArray($tableauProjets, NULL, 'A1', true);

  //Création de l'emplacement de stockage du fichier
  $url = str_replace(basename(__FILE__), 'Projets_soumis', __FILE__).'.xlsx';

  //Sauvegarde du fichier
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save($url);

  //Modification de l'entête HTTP afin de pouvoir télécharger le fichier
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-disposition: attachment; filename="'.basename($url).'"');
  header("Content-Length: ".filesize($url));
  header("Pragma: no-cache");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
  header("Expires: 0");
  readfile($url);
  unlink($url);
?>