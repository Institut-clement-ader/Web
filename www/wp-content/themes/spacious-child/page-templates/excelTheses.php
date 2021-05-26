<?php
/**
 * Template Name: excelTheses
 *
 * Displays the Page Builder Template via the theme.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.4.9
 */

  // -----------------
  // --- FONCTIONS ---
  // -----------------

  //Obtenir l'acronyme correspondant a un axe
  function getAxe($intitule) {
    $intitule = html_entity_decode($intitule);
    switch ($intitule) {
      case "Intégrité des structures et des systèmes (MS2M)":
        $axe = "ISS";
        break;
      case "Ingénierie des systèmes et des microsystèmes (MS2M)":
        $axe = "ISM";
        break;
      case "Méthodes optiques innovantes pour la métrologie dimensionnelle et thermique (MICS)":
        $axe = "MOIMDT";
        break;
      case "Identification et contrôle de propriétés thermiques et mécaniques (MICS)":
        $axe = "ICPTM";
        break;
      case "Structures Impact Modélisation Usinage (MSC)":
        $axe = "SIMU";
        break;
      case "Usinage et mise en forme (SUMO)":
        $axe = "USIMEF";
        break;
      case "Propriétés d usage et microstructures des matériaux avancés (SUMO)":
        $axe = "PUMMA";
        break;
      case "Matériaux Propriétés et Procédés (MSC)":
        $axe = "MAPP";
        break;
      case "Fatigue Modélisation Endommagement et Usure (SUMO)":
        $axe = "FAMEU";
        break;
      case "Assemblages (AXTR)":
        $axe = "ASM";
        break;
      default:
        $axe = $intitule;
    }
    return $axe;
  }



  // ------------------------------------
  // --- CRÉATION DE LA FEUILLE EXCEL ---
  // ------------------------------------

  //Import de la librairie PHPExcel
  require_once(dirname(__FILE__).'/Excel/Classes/PHPExcel.php');

  //Création d'un document
  $objPHPExcel = new PHPExcel();

  //Sélectionne la feuille de calcul courante
  $objWorksheet = $objPHPExcel->getActiveSheet();
  $objWorksheet->setTitle('Doctorants'); //Titre

  //Largeur des colonnes
  $objWorksheet->getColumnDimension('A')->setWidth(15);
  $objWorksheet->getColumnDimension('B')->setWidth(16);
  $objWorksheet->getColumnDimension('C')->setWidth(14);
  $objWorksheet->getColumnDimension('F')->setWidth(10);
  $objWorksheet->getColumnDimension('G')->setWidth(10);
  $objWorksheet->getColumnDimension('H')->setWidth(10);
  $objWorksheet->getColumnDimension('I')->setWidth(10);
  $objWorksheet->getColumnDimension('J')->setWidth(38);
  $objWorksheet->getColumnDimension('K')->setWidth(30);
  $objWorksheet->getColumnDimension('L')->setWidth(11);
  $objWorksheet->getColumnDimension('M')->setWidth(20);
  $objWorksheet->getColumnDimension('N')->setWidth(20);
  $objWorksheet->getColumnDimension('O')->setWidth(20);
  $objWorksheet->getColumnDimension('P')->setWidth(62);



  // ----------------------------------------
  // --- DONNÉES DES DOCTORANTS ET THÈSES ---
  // ----------------------------------------

  //Intitulés des colonnes
  $doctorants[] = array("LOGIN", "NOM", "PRENOM", "GROUPE", "AXE", "GROUPE 2", "AXE 2", "GROUPE 3", "AXE 3 ", "EMAIL", "TITRE DE LA THESE", "DEBUT", "ENCADRANT INT 1", "ENCADRANT INT 2", "ENCADRANT INT 3", "ENCADRANT(S) EXTERNE(S)");

  //Récupère les utilsiateurs WordPress
  $users = get_users('meta_key=status&meta_value=Doctorant');

  //Pour chaque utilisateur
  foreach($user as $users) {
    //Paramètres de recherche de la these
    $params = array( 
      'orderby' => 'doctorant.user_login DESC',
      'where' => 'doctorant.user_login = "'.$users->user_login.'"'
    );
    
    //on récupère le Pod Thèses (1) et ses données (2)
    $theses = pods('these', $params);
    $champs = $theses->export();
    
    //si les donnees existent ET si la these est en cours
    if (!empty($champs) && ($champs['date_soutenance'] === '0000-00-00' || strtotime($champs['date_soutenance']) > strtotime("now"))) {
      //Tableau contenant toutes les données
      $doc = array($user->user_login, html_entity_decode($user->user_lastname), html_entity_decode($user->user_firstname), html_entity_decode($user->groupe_primaire), getAxe($user->axe_primaire), html_entity_decode($user->groupe_secondaire), getAxe($user->axe_secondaire), html_entity_decode($user->groupe_tertiaire), getAxe($user->axe_tertiaire), strtolower($user->user_email), $champs['titre_these'], date('d/m/Y', strtotime($champs['date_debut'])), html_entity_decode($champs['directeur_int']['display_name']), html_entity_decode($champs['encadrant_int1']['display_name']), html_entity_decode($champs['encadrant_int2']['display_name']), html_entity_decode($champs['encadrants_ext']));
      $doctorants[] = $doc;
    }
    
    
  }



  // --------------------------------------------------------
  // --- REMPLISSAGE DE LA FEUILLE EXCEL AVEC LES DONNÉES ---
  // --------------------------------------------------------

  //On met les données sur Excel
  $objWorksheet->fromArray($doctorants, NULL, 'A1', true);

  //Création de l'emplacement de stockage du fichier
  $url = str_replace(basename(__FILE__), 'Doctorants', __FILE__).'.xlsx';

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