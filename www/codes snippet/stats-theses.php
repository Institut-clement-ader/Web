<?php

	/**
    * Améliorations à apporter :
    * Changer la liaison BDD en utilisant la classe Gestion BDD (prendre exemple sur les autres codes)
    * Enlever les echo innutiles en fermant les balises php
    */


	//LIAISON A LA BDD
	$serveur="mysql2.lamp.ods";
	$utilisateur="lab0612sql3";
	$password="XY02b21aBLaq";
	$db="lab0612sql3db";
	
	try {
		$bdd = new PDO('mysql:host='.$serveur.';dbname='.$db, $utilisateur, $password);
	} catch(PDOException $e) {
		print "Erreur : ".$e->getMessage();
		die();
	}

	//tableaux de valeurs
	$groupes = array('ICA', 'MSC', 'MICS', 'SUMO', 'MS2M');
	$tabyear = array();
	foreach ($groupes as $groupe)
			$tabGrp[$groupe] = array();

				   
	//pour chaque annee
	for ($year = 2009; $year <= date('Y'); $year++) {
		$tabyear[] = $year;
		//on selectionne les theses et le groupe de chacun de ses encadrants
		$selectThese="SELECT DISTINCT these.id AS these_id, meta.meta_value AS groupe
						FROM wp_pods_these AS these, wp_podsrel AS rel, wp_usermeta AS meta
					   WHERE rel.pod_id = 862
					     AND (rel.field_id = 1240
						   OR rel.field_id = 1241
						   OR rel.field_id = 1242)
						 AND rel.item_id = these.id
						 AND rel.related_item_id = meta.user_id
						 AND (meta.meta_key = 'groupe_primaire'
						   OR meta.meta_key = 'groupe_secondaire'
						   OR meta.meta_key = 'groupe_tertiaire')
						 AND meta_value IN ('MSC', 'MICS', 'SUMO', 'MS2M')
					     AND YEAR(these.date_soutenance) = ".$year."
						 ORDER BY these_id";
		$resultat=$bdd->query($selectThese);
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


	//script Google Chart
	echo "	<div id='linechart_material'></div>
			<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>

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