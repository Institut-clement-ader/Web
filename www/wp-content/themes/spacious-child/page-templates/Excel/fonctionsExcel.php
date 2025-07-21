<?php
function createLineChart(array $nomLignes, array $nomColonnes, array $resultatRequete){

	//A changer en fonction du placement de lalibrairie 
	require_once (dirname(__FILE__).'/../Excel/Classes/PHPExcel.php');

	$objPHPExcel = new PHPExcel();
	$objWorksheet = $objPHPExcel->getActiveSheet();

	$tableauExcel = array();
	array_unshift($nomColonnes, '');
	array_push($tableauExcel, $nomColonnes);


	foreach ($resultatRequete as $numeroLigne => $ligneRequete) {
		$ligneExcel = $ligneRequete;
		array_unshift($ligneExcel, $nomLignes[$numeroLigne]);
		array_push($tableauExcel, $ligneExcel);
	}

	$objWorksheet->fromArray($tableauExcel);

	$i=0;

	$dataSeriesLabels = array();
	for ($i=0; $i < sizeof($nomLignes); $i++) { 
		array_push($dataSeriesLabels, 
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$'.strval($i+2), NULL, 1));

	}

	$xAxisTickValues = array();
	$lettre=ChiffreLettreAlphabet(sizeof($nomColonnes)-1);
	array_push($xAxisTickValues, 
		new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1:$'.$lettre.'$1', NULL, sizeof($nomColonnes)-1));

	$dataSeriesValues = array();
	for ($i=0; $i < sizeof($nomLignes); $i++) { 
		$lettre=ChiffreLettreAlphabet(sizeof($nomColonnes)-1);
		array_push($dataSeriesValues, 
			new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$B$'.strval($i+2).':$'.$lettre.'$'.strval($i+2), NULL, sizeof($nomColonnes)-1));

	}

	$series = new PHPExcel_Chart_DataSeries(
		PHPExcel_Chart_DataSeries::TYPE_LINECHART,		// plotType
		PHPExcel_Chart_DataSeries::GROUPING_STANDARD,	// plotGrouping
		range(0, count($dataSeriesValues)-1),			// plotOrder
		$dataSeriesLabels,								// plotLabel
		$xAxisTickValues,								// plotCategory
		$dataSeriesValues);								// plotValues

	$plotArea = new PHPExcel_Chart_PlotArea(NULL, array($series));

	$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

	$title = new PHPExcel_Chart_Title('Evolution du personnel de '.$nomColonnes[1].' à '.$nomColonnes[sizeof($nomColonnes)-1]);

	$chart = new PHPExcel_Chart(
		'LineChart',		// name
		$title,			// title
		$legend,		// legend
		$plotArea,		// plotArea
		true,			// plotVisibleOnly
		0,				// displayBlanksAs
		NULL,			// xAxisLabel
		NULL		// yAxisLabel
		);

	$chart->setTopLeftPosition('A'.(sizeof($nomLignes)+6));
	$debut=ChiffreLettreAlphabet(sizeof($nomColonnes)+5);
	$fin = sizeof($nomLignes)+30;
	$chart->setBottomRightPosition($debut.$fin);


	$objWorksheet->addChart($chart);

	$url = str_replace(basename(__FILE__), 'evolution_effectifs_permanents_ICA.xlsx', __FILE__);

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->setIncludeCharts(TRUE);
	$objWriter->save($url);

	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-disposition: attachment; filename="'.basename($url).'"');
	header("Content-Length: ".filesize($url));
	header("Pragma: no-cache");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
	header("Expires: 0");
	readfile($url);
	unlink($url);
}

function ChiffreLettreAlphabet($chiffre){
	$alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','U','R','S','T','U','V','W','X','Y','Z');
	return $alphabet[$chiffre];
}



function createDonutChart(array $nomLignes, array $nomColonnes, array $resultatRequete) {
	//A changer en fonction du placement de la librairie 
	require_once (dirname(__FILE__).'/../Excel/Classes/PHPExcel.php');

	$objPHPExcel = new PHPExcel();
	$objWorksheet = $objPHPExcel->getActiveSheet();
  $objWorksheet->getColumnDimension('A')->setWidth(19);

	$tableauExcel = array();
	array_unshift($nomColonnes, '');
	array_push($tableauExcel, $nomColonnes);


	foreach ($resultatRequete as $numeroLigne => $ligneRequete) {
		$ligneExcel = $ligneRequete;
		array_unshift($ligneExcel, $nomLignes[$numeroLigne]);
		array_push($tableauExcel, $ligneExcel);
	}

	$objWorksheet->fromArray($tableauExcel, NULL, 'A1', true);

	$i=0;

	$dataSeriesLabels = array();
	array_push($dataSeriesLabels, 
		new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', NULL, 1));


	$xAxisTickValues = array();
	$lettre=ChiffreLettreAlphabet(sizeof($nomColonnes)-1);
	array_push($xAxisTickValues, 
		new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A'.strval(sizeof($nomLignes)+1), NULL, sizeof($nomLignes)));

	$dataSeriesValues = array();
	
	$lettre=ChiffreLettreAlphabet(sizeof($nomColonnes)-1);
	array_push($dataSeriesValues, 
		new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$B$2:$B'.strval(sizeof($nomLignes)+1), NULL, sizeof($nomLignes)));


	$series = new PHPExcel_Chart_DataSeries(
		PHPExcel_Chart_DataSeries::TYPE_DONUTCHART,		// plotType
		NULL,	// plotGrouping
		range(0, count($dataSeriesValues)-1),			// plotOrder
		$dataSeriesLabels,								// plotLabel
		$xAxisTickValues,								// plotCategory
		$dataSeriesValues);								// plotValues

	$layout = new PHPExcel_Chart_Layout();
	$layout->setShowVal(TRUE);
	$layout->setShowCatName(FALSE);

	$plotArea = new PHPExcel_Chart_PlotArea($layout, array($series));

	$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

	$title = new PHPExcel_Chart_Title('Répartition du personnel en '.$nomColonnes[1]);

	$chart = new PHPExcel_Chart(
		'DonutChart',		// name
		$title,			// title
		$legend,		// legend
		$plotArea,		// plotArea
		true,			// plotVisibleOnly
		0,				// displayBlanksAs
		NULL,			// xAxisLabel
		NULL		// yAxisLabel
		);

	$chart->setTopLeftPosition('A'.(sizeof($nomLignes)+6));
	$debut=ChiffreLettreAlphabet(sizeof($nomColonnes)+5);
	$fin = sizeof($nomLignes)+30;
	$chart->setBottomRightPosition($debut.$fin);


	$objWorksheet->addChart($chart);

	$url = str_replace(basename(__FILE__), 'Repartition_Membres_'.$nomColonnes[1].'.xlsx', __FILE__);

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->setIncludeCharts(TRUE);
	$objWriter->save($url);

	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-disposition: attachment; filename="'.basename($url).'"');
	header("Content-Length: ".filesize($url));
	header("Pragma: no-cache");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
	header("Expires: 0");
	readfile($url);
	unlink($url);
}

function createTable(array $nomColonnes, array $resultatRequete, $nom, array $nomLignes = array()){

	require_once (dirname(__FILE__).'/../Excel/Classes/PHPExcel.php');

	$objPHPExcel = new PHPExcel();
	$objWorksheet = $objPHPExcel->getActiveSheet();

	$tableauExcel = array();
	array_unshift($nomColonnes, '');
	array_push($tableauExcel, $nomColonnes);


	foreach ($resultatRequete as $numeroLigne => $ligneRequete) {
		$ligneExcel = $ligneRequete;
                if($nomLignes != 0){
	                array_unshift($ligneExcel, $nomLignes[$numeroLigne]);
                }
		
		array_push($tableauExcel, $ligneExcel);
	}

	$objWorksheet->fromArray($tableauExcel);

        
        $url = str_replace(basename(__FILE__), $nom, __FILE__);

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save($url);

	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-disposition: attachment; filename="'.basename($url).'"');
	header("Content-Length: ".filesize($url));
	header("Pragma: no-cache");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
	header("Expires: 0");
	readfile($url);
	unlink($url);
}
?>
