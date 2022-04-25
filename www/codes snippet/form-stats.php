<?php

	/**
   * Améliorations à apporter :
   * Enlever les echo en utilisant les balises php.
   */

echo "
	<h6>Calcul des clés de répartition de chaque groupe selon les établissements :</h6>
	<form class='form-stats' action='http://institut-clement-ader.org/stats-membres/budgets/' method='POST'>
		<button type='submit' class='spanExcel'><i class='fa fa-table'></i>&nbsp;&nbsp;&nbsp;Télécharger au format Excel</button>
	</form>&nbsp;

	<h6>Évolution du nombre de membres permanents de l'ICA, en fonction de leur statut et de leur établissement d'origine, avec la liste des membres :</h6>
	<form class='form-stats' action='http://institut-clement-ader.org/stats-membres/evolution/' method='POST'>
		<label for='groupe'>Groupe : </label>
		<select id='groupe' name='groupe'>
		  <option value='0'>Professeurs et équivalent</option>
		  <option value='1'>Maîtres de conférence et équivalents</option>
		  <option value='2'>Ingénieurs, techniciens, administratif</option>
		  <option value='3'>Doctorants, ATER, Post-Doctorants</option>
		  <option value='4'>Membres associés</option>
		</select><br/><br/>
		<label for='debut1'>De </label><input id='debut1' min='1980' max='".date('Y')."' value='".(idate('Y')-4)."' name='debut1' required='' type='number'/>
		<label for='fin1'> à </label><input id='fin1' min='1980' max='".date('Y')."' value='".date('Y')."' name='fin1' required='' type='number'/><br/><br/>
		<button type='submit' class='spanExcel'><i class='fa fa-table'></i>&nbsp;&nbsp;&nbsp;Télécharger au format Excel</button>
	</form>&nbsp;
		
	<h6>Répartition des membres permanents de l'Institut Clément Ader :</h6>
	<form class='form-stats' action='http://institut-clement-ader.org/stats-membres/repartition/' method='POST'>
		<label for='debut3'>En </label><input id='debut3' min='1980' max='".date('Y')."' value='".date('Y')."' name='debut3' required='' type='number'/><br/><br/>
		<button type='submit' class='spanExcel'><i class='fa fa-table'></i>&nbsp;&nbsp;&nbsp;Télécharger au format Excel</button>
	</form>";
?>

<!-- Les scripts d'export dans le fichier excel se trouvent dans les modèles d'attribut des pages vers
lesquelles sont liés les formulaires. Ils se trouvent dans wp-content/themes/spacious-child/page-templates/Excel
-->