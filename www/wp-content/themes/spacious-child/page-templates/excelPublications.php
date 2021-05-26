<?php	

/**
 * Template Name: excelPublications
 *
 * Displays the Page Builder Template via the theme.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.4.9
 */

  //Import de la librairie PHPExcel
  require_once(dirname(__FILE__).'/Excel/Classes/PHPExcel.php');

//Fonctions PHP 
      function docTypeConvert ($doctype) {
        
        switch ($doctype) {
            
          case 'ART' :
            return 'ACL';
            break;
          case 'COMM' :
            return 'COM';
            break;
          case 'COUV' :
            return 'CO';
            break;
          case 'OUV' :
            return 'O';
            break;
          case 'DOUV' :
            return 'DO';
            break;
          case 'POSTER' :
            return 'P';
            break;
          case 'PATENT' :
            return 'B';
            break;
          case 'THESE' :
            return 'PhD';
            break;
          case 'HDR' :
            return 'HDR';
            break;
          default : 
            return 'AP';
            break;
        }
      }
//$sheet  -> feuille sur laquelle on écrit, $lig -> la ligne sur laquelle on écrit, $docs -> le tableau qui contient les infos de la publication
function writeCells ($sheet, $lig, $docs) {
  
                $col = 0;

                //affichage de l'année
                $sheet->setCellValueByColumnAndRow($col,$lig,$docs['producedDateY_i']);
                $col++;
              
                //affichage du type
                $sheet->setCellValueByColumnAndRow($col,$lig,docTypeConvert($docs['docType_s']));
                $col++;

                //récupération des auteurs
                $auteurs = '';
                foreach ($docs['authFullName_s'] as $auth) {
                  $auteurs .= $auth.', ';
                }
                //on enlève la dernière virgule et l'espace
                $auteurs = substr($auteurs,0,-2);
                //affichage des auteurs
                $sheet->setCellValueByColumnAndRow($col,$lig,$auteurs);
                $col++;           

                //récupération des titres
                $titres = '';
                foreach ($docs['title_s'] as $tit) {
                  $titres .= $tit.'. ';
                }
                //on enlève le dernier point et l'espace
                $titres = substr($titres,0,-2);
                //affichage du titre
                $sheet->setCellValueByColumnAndRow($col,$lig,$titres);
                $col++;
                
                //affichage du journal / conférence
                if (!empty($docs['journalTitle_s'])) {
                $sheet->setCellValueByColumnAndRow($col,$lig,$docs['journalTitle_s']);
                $col++;
                } 
                if (!empty($docs['conferenceTitle_s'])) {
                $sheet->setCellValueByColumnAndRow($col,$lig,$docs['conferenceTitle_s']);
                $col++;            
                }

                //affichage des pages
                $sheet->setCellValueByColumnAndRow($col,$lig,$docs['page_s']);
                $col++;

                //affichage du volume
                $sheet->setCellValueByColumnAndRow($col,$lig,$docs['volume_s']);
                $col++;

                //récupération des numéros
                $numeros = '';
                if (!empty($docs['issue_s'])) {
                  foreach ($docs['issue_s'] as $num) {
                    $numeros .= $num.' / ';
                  }
                  //on enlève le dernier slash et l'espace
                  $numeros = substr($numeros,0,-2);
                }

                //affichage du numéro
                $sheet->setCellValueByColumnAndRow($col,$lig,$numeros);
                $col++;

                //affichage lien HAL
                $sheet->setCellValueByColumnAndRow($col,$lig,$docs['uri_s']);
                $col++;

                //affichage lien DOI
                $sheet->setCellValueByColumnAndRow($col,$lig,$docs['doiId_s']);
                $col++;

                //récupération des références internes
                $references = '';
                if (!empty($docs['localReference_s'])) {
                  foreach ($docs['localReference_s'] as $ref) {
                    $references .= $ref.' / ';
                  }
                  //on enlève le dernier slash et l'espace
                  $references = substr($references,0,-2);
                }
            
                //affichage des références internes
                $sheet->setCellValueByColumnAndRow($col,$lig,$references);
                $col++;
  
}

//Feuille Excel
$workbook = new PHPExcel;

$sheet = $workbook->getActiveSheet();

//Nom des colonnes 
$sheet->setCellValue('A1','Année');
$sheet->setCellValue('B1','Type');
$sheet->setCellValue('C1','Auteurs');
$sheet->setCellValue('D1','Titre');
$sheet->setCellValue('E1','Journal / Conférence');
$sheet->setCellValue('F1','Pages');
$sheet->setCellValue('G1','Volume');
$sheet->setCellValue('H1','Numéro');
$sheet->setCellValue('I1','HAL');
$sheet->setCellValue('J1','DOI');
$sheet->setCellValue('K1','Références internes');

//Récupération de l'url utilisée pour la recherche
$url = $_POST['url'];
//On enlève les anciens champs de recherche
$url = substr($url, 0, strpos($url, "&fl="));
//On rajoute ceux utilisés pour l'Excel
$url.= '&fl=producedDateY_i,docType_s,authFullName_s,title_s,journalTitle_s,page_s,volume_s,uri_s,doiId_s,issue_s,localReference_s,conferenceTitle_s&sort=producedDate_tdate%20desc';

//Taille des colonnes automatique
$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);
$sheet->getColumnDimension('G')->setAutoSize(true);
$sheet->getColumnDimension('H')->setAutoSize(true);
$sheet->getColumnDimension('I')->setAutoSize(true);
$sheet->getColumnDimension('J')->setAutoSize(true);
$sheet->getColumnDimension('K')->setAutoSize(true);

//Alignement des cellules Année, Pages, Volume et Numéro (A, F, G et H)
$sheet->getStyle("A")
      ->getAlignment()
      ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$sheet->getStyle("F")
      ->getAlignment()
      ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$sheet->getStyle("G")
      ->getAlignment()
      ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$sheet->getStyle("H")
      ->getAlignment()
      ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


//Utilisation de curl pour récupérer le json
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);
	//On transforme le json en array php
	$json = json_decode($data, true);
  //On place les curseurs sur 'A2'
  $lig = 2;
  $nbRes = 0;
            
           foreach ($json['response']['docs'] as $docs) {
             
                $nbRef = count($docs['localReference_s']); 
                $groupeFound = false;
                $refFound = false;
                $onlyWOS = true;
             
                //Pas de groupe / pas de référence 
                if (!isset($_POST['grp']) && !isset($_POST['ref'])) {
                  
                  writeCells($sheet, $lig, $docs);
                  //Ligne suivante
                  $lig++;
                 
                //Pas de groupe / référence   
                } else if (!isset($_POST['grp']) && isset($_POST['ref'])) {
                  
                   for ($v = 0; $v < $nbRef; $v++) {
                   //Si une ligne correspond à la ref recherchée, on passe et reste à true et le résultat sera affiché
                    if ($_POST['ref'] == 'WOS') {
                      if ($docs['localReference_s'][$v] == $_POST['ref']) {
                        $refFound = true;
                      }
                    } else { 
                       if ($docs['localReference_s'][$v] == 'SCOPUS') {
                        $refFound = true;
                       }
                       //On est ici dans le cas où l'on veut seulement des publis WOS, donc si on trouve qu'elle est aussi SCOPUS, on passe le booléen à false pour ne pas récupérer la publi
                       if ($docs['localReference_s'][$v] == 'WOS') {
                        $onlyWOS = false;
                      } 
                    }
                  }
                  if ($refFound && $onlyWOS) {
                    writeCells($sheet, $lig, $docs);
                    //Ligne suivante
                    $lig++;
                  }
                  
                //Groupe // pas de référence   
                } else if (isset($_POST['grp']) && !isset($_POST['ref'])) {
                  
                  for ($v = 0; $v < $nbRef; $v++) {
                   //Si une ligne correspond au groupe recherché, on passe et reste à true et le résultat sera affiché
                    if ($docs['localReference_s'][$v] == $_POST['grp']) {
                      $groupeFound = true;
                    }
                  }
                  
                  if ($groupeFound) {
                    writeCells($sheet, $lig, $docs);
                    //Ligne suivante
                    $lig++;
                  }
                  
                //Groupe / référence   
                } else {
                  
                   for ($v = 0; $v < $nbRef; $v++) {
                   //Si une ligne correspond à la ref recherchée, on passe et reste à true et le résultat sera affiché
                    if ($_POST['ref'] == 'WOS') {
                      if ($docs['localReference_s'][$v] == $_POST['ref']) {
                        $refFound = true;
                      }
                    } else { 
                       if ($docs['localReference_s'][$v] == 'SCOPUS') {
                        $refFound = true;
                       }
                       //On est ici dans le cas où l'on veut seulement des publis WOS, donc si on trouve qu'elle est aussi SCOPUS, on passe le booléen à false pour ne pas récupérer la publi
                       if ($docs['localReference_s'][$v] == 'WOS') {
                        $onlyWOS = false;
                      } 
                    }
                     if ($docs['localReference_s'][$v] == $_POST['grp']) {
                      $groupeFound = true;
                    }
                  }
                  
                  if ($refFound && $groupeFound && $onlyWOS) {
                    writeCells($sheet, $lig, $docs);
                    //Ligne suivante
                    $lig++;
                  }
                }
             }
            


$writer = new PHPExcel_Writer_Excel2007($workbook);



    //Création de l'emplacement de stockage
    $url = str_replace(basename(__FILE__), 'Publications', __FILE__).'.xlsx';

    //Sauvegarde du document
    $objWriter = PHPExcel_IOFactory::createWriter($workbook, 'Excel2007');
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