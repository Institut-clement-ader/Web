<?php
      include ('App/Public/Publications/fonctions_snippet.php');

      //détection de langue courante de la page
      $currentlang = get_bloginfo('language');

      if(strpos($currentlang,'fr')!==false){
        include('App/lang-fr.php');
      }elseif(strpos($currentlang,'en')!==false){
        include('App/lang-en.php');
      }else{
        echo("échec de reconnaissance de la langue");
      }

      $url = 'https://api.archives-ouvertes.fr/search/ICA/?%20q=&fq=docType_s:ART&fq=peerReviewing_t:oui&fq=popularLevel_t:non&wt=json&rows=10&sort=producedDate_tdate%20desc&fl=producedDateY_i,docType_s,authFullName_s,title_s,journalTitle_s,page_s,volume_s,uri_s,doiId_s,issue_s,localReference_s,journalPublisher_s,subTitle_s,conferenceTitle_s,city_s,country_s,invitedCommunication_s,peerReviewing_s,popularLevel_s,number_s';

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
      //$strNbResultats = $nbResultats;

       if ($nbResultats > 0) {
        ?><table width=\"100%\" class=\" tab_publications tablesorter {sortlist:[[0,1]]}\"><col width ='6%'><col width ='80%'><col width ='9%'><thead><tr><th><?=TXT_ANNEE_PUBLIACL?></th><th><?=TXT_AUTEURDOC_PUBLIACL?></th><th><?=TXT_LIENS_PUBLIACL?></th></tr></THEAD><TBODY><?php        
         foreach ($json['response']['docs'] as $docs) {
           
          ?><tr><?php
          
          //affichage de toutes les données relatives à une publication 
          affichagePublication($docs);          

        }
        ?></td></tr>
        </tbody></table><br><?php
      }
        
		//différents affichages en fonction du nombre de résultat 
    $urlACL = esc_url(get_permalink(2356)); 
    ?><i><a href =<?=$urlACL?>><?=TXT_VOIRTOUT_PUBLIACL?></a></i><br /><br /><br /><?php
    $urlRecherche = esc_url(get_permalink(1720)); 
    ?><form action="<?=$urlRecherche?>" method="POST">
        <input type="submit" value="<?=TXT_RAVANCEE_PUBLIACL?>" />
      </form><br />
