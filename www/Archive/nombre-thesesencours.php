<?php

	/**
    * Améliorations à apporter :
    */

  //détection de langue courante de la page
  $currentlang = get_bloginfo('language');

  if(strpos($currentlang,'fr')!==false){
    include('codes snippet/lang-fr.php');
  }elseif(strpos($currentlang,'en')!==false){
    include('codes snippet/lang-en.php');
  }else{
    echo("échec de reconnaissance de la langue");
  }

	require("codes snippet/GestionBdd.php");
	$bdd = new GestionBdd();

	//On selectionne le nombre de theses dont le doctorant est toujours present, dont la date de soutenance est non definie ou superieure a la date courante et dont la date de debut est inferieure a la date courante
	$nb_theses = $bdd-> nbTheses();
	//Affichage selon le nombre de resultats
	if ($nb_theses == 0)
		$nb_theses = TXT_AUCUNE_TENCOURS;
	if ($nb_theses > 1)
		echo $nb_theses.TXT_THESES_TENCOURS;
	else
		echo $nb_theses.TXT_THESE_TENCOURS;
?>