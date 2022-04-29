<?php

/**
    * Améliorations à apporter :
    */ 


      include ('codes snippet/fonctions_snippet.php');

      //détection de langue courante de la page
      $currentlang = get_bloginfo('language');

      if(strpos($currentlang,'fr')!==false){
        include('codes snippet/lang-fr.php');
      }elseif(strpos($currentlang,'en')!==false){
        include('codes snippet/lang-en.php');
      }else{
        echo("échec de reconnaissance de la langue");
      }

      $url = 'https://api.archives-ouvertes.fr/search/ICA/?%20q=&fq=docType_s:ART&fq=peerReviewing_t:oui&fq=popularLevel_t:non&wt=json&rows=10000&sort=producedDate_tdate%20desc&fl=producedDateY_i,docType_s,authFullName_s,title_s,journalTitle_s,page_s,volume_s,uri_s,doiId_s,issue_s,localReference_s,journalPublisher_s,subTitle_s,conferenceTitle_s,city_s,country_s,invitedCommunication_s,peerReviewing_s,popularLevel_s,number_s';

      //utilisation de curl pour récupérer le json
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_TIMEOUT, 5);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $data = curl_exec($ch);
      curl_close($ch);
      //on transforme le json en array php
      $json = json_decode($data, true);

      //Affichage du nombre de résultats
      $nbResultats = $json['response']['numFound'];

          if ( is_user_logged_in() ) {
            ?>
            <form METHOD='POST' ACTION='http://institut-clement-ader.org/excel-des-publications/' CLASS='form-publi'>
            <input type="hidden" name="url" value=<?=$url?>>
            <br /><button type=submit class='spanExcel'><i class='fa fa-table'></i>&nbsp &nbsp &nbsp<?=TXT_TELECHARGER_PUBLITACL?></button><br /></form>
            <?php
          }
          
      //$strNbResultats = $nbResultats;

       if ($nbResultats > 0) {
        ?>
          <table width=\"100%\" class=\" tab_publications tablesorter {sortlist:[[0,1]]}\"><col width ='6%'><col width ='80%'><col width ='9%'><thead><tr><th>Année Publication ACL</th><th>Auteur Document Publication ACL</th><th>Liens publication ACL</th></tr></thead><tbody>        
          <?php
          foreach ($json['response']['docs'] as $docs) {
          ?>
          <tr>
            <?php
           
          //affichage de toutes les données relatives à une publication 
          affichagePublication($docs); 
          
        }
        ?>
        </td></tr>
        </tbody></table><br>
        <?php
      }
        
		//différents affichages en fonction du nombre de résultat 
    $urlRecherche = esc_url(get_permalink(1720)); 
    ?>
    <form action="<?=$urlRecherche?>" method="POST">
      <input type="submit" value="<?=TXT_RAVANCEE_PUBLITACL?>" />
    </form>