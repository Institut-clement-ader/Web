<?php

	/**
    * Améliorations à apporter :
    */

	//LIAISON A LA BDD
	require("codes snippet/GestionBdd.php");
	$bdd = new GestionBdd();

	//tableaux de valeurs
	$groupes = array('ICA', 'MSC', 'MICS', 'SUMO', 'MS2M');
	$tabyear = array();
	foreach ($groupes as $groupe)
			$tabGrp[$groupe] = array();

	
	//pour chaque annee
	for ($year = 2009; $year <= date('Y'); $year++) {
		$tabyear[] = $year;
		//on selectionne les theses et le groupe de chacun de ses encadrants
		$resultat= $bdd->selectTheses($year);

		foreach ($groupes as $groupe)
			$count[$groupe] = 0;
			
		$valId = 0;
		while ($these = $resultat->fetch()) {
			//verifie que la these n'est pas la meme que la precedente (avec seulement un groupe different)
			if ($these['these_id'] != $valId)
				$count['ICA']++;
			$valId = $these['these_id'];
			$count[$these['groupe']]++;
		}
		
		//On met dans le tableau le nombre de theses de chaque groupe, correspondant a une annee
		foreach ($groupes as $groupe) {
			$tabGrp[$groupe][] = $count[$groupe];
		}
	}
	$rows = "";

	//pour chaque année
	for ($i = 0; $i < count($tabyear); $i++) {
	  $rows .= '['.$tabyear[$i];
	  //pour chaque groupe -> on ajoute le nombre de theses
	  foreach ($groupes as $groupe)
		  $rows .= ', '.$tabGrp[$groupe][$i];
	  $rows .= '],';
	}
	//on enleve la derniere virgule
	$rows = substr($rows, 0, -1);

?>
	<!-- script Google Chart -->
		<div id='linechart_material'></div>
<?php
echo "<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>

			<script type='text/javascript'>
				// Load google charts
				google.charts.load('current', {'packages':['line']});
				google.charts.setOnLoadCallback(drawChart);

				function drawChart() {

					var data = new google.visualization.DataTable();
					data.addColumn('number', 'Année');
					data.addColumn('number', 'Institut Clément Ader');
					data.addColumn('number', 'MSC');
					data.addColumn('number', 'MICS');
					data.addColumn('number', 'SUMO');
					data.addColumn('number', 'MS2M');

					data.addRows([";
	echo $rows;
	echo "
					]);

					var options = {
						chart: {
						  title: 'Soutenances de thèses :',
						  subtitle: 'Nombre de soutenances par groupe et par an'
						},
						selectionMode : 'multiple',
						width: 1200,
						height: 600,
						hAxis: {
						  format: ''
						}
					};
				  

					var chart = new google.charts.Line(document.getElementById('linechart_material'));
					chart.draw(data, google.charts.Line.convertOptions(options));
				}
			</script>";
?>