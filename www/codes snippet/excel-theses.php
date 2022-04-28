<?php

  /**
   * Améliorations à apporter :
   * Enlever les echo en utilisant les balises php.
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

	//Si l'utilisateur est connecte
	if (is_user_logged_in()) {
		//Affichage d'un bouton "Télécharger au format Excel" pour la liste des thèses/doctorants
    ?>
		  <form action='http://institut-clement-ader.org/gestion-theses/en-cours/excel/' method='POST'>
				<button type='submit' class='spanExcel'><i class='fa fa-table'></i>&nbsp;&nbsp;&nbsp;Télécharger au format Excel</button>
			</form>
    <?php
	}
?>