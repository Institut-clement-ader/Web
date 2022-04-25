<?php

  /**
  * Améliorations à apporter :
  * Enlever les echo innutiles qui apportent surement des erreurs dans le code
  */ 


//création des tableaux pour garder les valeurs des abscisses de chaque année
$tabyear = array();
$tabval = array();
$tabMSC = array();
$tabMICS = array();
$tabSUMO = array();
$tabMS2M = array();

//récupérer tous les ACL (publis rang A) de l'ICA, de 2009 jusqu'à l'année courante
for ($year = 2009; $year <= date('Y'); $year++) {
  //on réinitialise les valeurs des abscisses
  $absMSC = 0;
  $absMICS = 0;
  $absSUMO = 0;
  $absMS2M = 0; 
  //on met la date dans le tableau de dates
  array_push($tabyear,$year);

  //requête qui renvoie les ACL de l'ICA
	$url = 'https://api.archives-ouvertes.fr/search/ICA/?q=&fq=docType_s:ART&fq=producedDateY_i:'.$year.'&fq=peerReviewing_t:oui&fq=popularLevel_t:non&wt=json&rows=10000&fl=docid,uri_s,label_s,localReference_s';

//utilisation de curl pour récupérer le json
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);
	//on transforme le json en array php
	$json = json_decode($data, true);

	//on met le nombre de résultats (donc le nombre de publis ACL de l'ICA) dans le tableau
	array_push($tabval,$json['response']['numFound']);
  foreach ($json['response']['docs'] as $docs) {
    //on compte le nombre de lignes dans localReference_s
    $nbRef = count($docs['localReference_s']);
    for ($v = 0; $v < $nbRef; $v++) {
      //Si une ligne correspond au groupe recherché, on incrémente de 1 le nombre de publi ACL de ce groupe
      if ($docs['localReference_s'][$v] == 'MICS') {
        
        $absMICS++;

      } else if ($docs['localReference_s'][$v] == 'MSC') {
        
        $absMSC++;

      } else if ($docs['localReference_s'][$v] == 'SUMO') {
        
        $absSUMO++;

      } else if ($docs['localReference_s'][$v] == 'MS2M') {
        
        $absMS2M++;

      }
    }
  }
  //On met dans le tableau le nombre de publi de chaque groupe, correspondant à une année
  array_push($tabMICS,$absMICS);
  array_push($tabMSC,$absMSC);
  array_push($tabSUMO,$absSUMO);
  array_push($tabMS2M,$absMS2M);
}
//variable utilisée pour afficher les lignes du graphe
$rows = "";

//pour chaque année
for ($i = 0; $i < count($tabyear); $i++) {
  //on définit, dans l'ordre : l'année / le nombre de publis ICA / le nombre de publis MSC / le nombre de publis SUMO / le nombre de publis MS2M
  $rows .= '['.$tabyear[$i].', '.$tabval[$i].', '. $tabMSC[$i].', '. $tabMICS[$i].', '. $tabSUMO[$i].', '. $tabMS2M[$i].'],';
}
//on enlève la dernière virgule
$rows = substr($rows, 0, -1);

//on récupère la valeur maximale du nombre de publis et on lui ajoute 10 (pour mieux afficher le graphe)
$maxValue = max($tabval) + 10;

echo '<div id="linechart_material"></div>';

echo '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
      google.charts.load(\'current\', {\'packages\':[\'line\']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn(\'number\', \'Année\');
      data.addColumn(\'number\', \'Institut Clément Ader\');
      data.addColumn(\'number\', \'MSC\');
      data.addColumn(\'number\', \'MICS\');
      data.addColumn(\'number\', \'SUMO\');
      data.addColumn(\'number\', \'MS2M\');

      data.addRows([';
echo $rows;
echo '
      ]);
      
     

      var options = {
        chart: {
          title: \'Publications de Rang A :\',
          subtitle: \'ACL par groupe et par an\'
        },
        selectionMode : \'multiple\',
        width: 1200,
        height: 450,
        hAxis: {
          format: \'\'
        },
        vAxis: {
          viewWindowMode:\'explicit\',
          viewWindow: {
            max:'.$maxValue.',
            min:0
          }
        }
      };
      

      var chart = new google.charts.Line(document.getElementById(\'linechart_material\'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
</script>';
?>