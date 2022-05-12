<?php

  /**
   * Améliorations à apporter :
   */

  
  //Pour ce qui ne concerne que l'affichage des ACL
  function affichagePublication($docs){
    
          //affichage de l'annee
          ?>
          <td><?=$docs['producedDateY_i']?></td>
          
          <td>
          <?php    
          //récupération des auteurs
          $auteurs = '';
          foreach ($docs['authFullName_s'] as $auth) {
              $auteurs .= $auth.', ';
          }
          //on enlève la dernière virgule et l'espace
          $auteurs = substr($auteurs,0,-2);
          //affichage des auteurs
          echo $auteurs.'.';
          
          //récupération des titres
          $titres = '';
          foreach ($docs['title_s'] as $tit) {
              $titres .= $tit.'. ';
          }
          //on enlève le dernier point et l'espace
          $titres = substr($titres,0,-2);
          //affichage du titre
          ?>
          <b><?=$titres?></b>
          <?php
          //récupération des sous-titres
          $stitres = '';
          if (!empty($docs['subTitle_s'])) {
            foreach ($docs['subTitle_s'] as $stit) {
              $stitres .= $stit.'. ';
            }
            //on enlève le dernier point et l'espace
            $stitres = substr($stitres,0,-2);
            //affichage du sous-titre
            if (strlen($stitres) > 0) {
              ?>
              <b><?=$stitres?></b>
              <?php
            }
          }
    
          $misc = " ";
          //affichage du titre de la revue
          if (!empty($docs['journalTitle_s'])) {
            $misc .= $docs['journalTitle_s'].',';
          }
          //affichage du titre de la conférence
          if (!empty($docs['conferenceTitle_s'])) {
           $misc .= $docs['conferenceTitle_s'].',';
          }
          //affichage du publisher
          if (!empty($docs['journalPublisher_s'])) {
           $misc .= ' '.$docs['journalPublisher_s'].',';
          }

           //affichage du volume
          if (!empty($docs['volume_s'])) {
            //affichage du numéro de volume
            if(!empty($docs['issue_s'])){
                $misc .= ' '.$docs['volume_s'].'('.$docs['issue_s'][0].'),';
            }else{
                $misc .= ' '.$docs['volume_s'].',';
            }
          }

          //affichage des pages
          if (!empty($docs['page_s'])) {
            //vérifie si le 'p' de pages est déjà indiqué
            if(strpos($docs['page_s'],'p')!==false){
              $misc .= ' '.$docs['page_s'].',';
            }else{
              $misc .= ' p.'.$docs['page_s'].',';
            }
          }

          //affichage de la ville
          if(!empty($docs['city_s'])){
            $misc .= ' '.$docs['city_s'].',';
          }

          //affichage du pays
          if(!empty($docs['country_s'])){
            $misc .= ' '.strtoupper($docs['country_s']).',';
          }

          $misc = substr($misc, 0, -1);
          ?>
          <i><?=$misc?><i>
          <?php
    
            echo '<td><a href ='.$docs['uri_s'].' target="_blank">[HAL]</a>';
            echo ' / <a href ='.$docs['uri_s'].'/bibtex target="_blank">[BIB]</a>';
            if (!empty($docs['doiId_s']) ) {
              echo ' / <a href=http://dx.doi.org/'.$docs['doiId_s'].' target="_blank"> [DOI] </a>';
          }
    
}

//Pour les recherches avancées et les profils d'autheur
function affichagePublicationAvancee($docs){
                      ?>
                      <tr>

                      <!-- affichage de l'annee -->
                      <td><?=($docs['producedDateY_i'])?></td>

                      <!-- affichage du type de publi -->
                      <td><?=docTypeConvert($docs['docType_s'],$docs['invitedCommunication_s'],$docs['peerReviewing_s'],$docs['popularLevel_s'])?></td>

                      <!-- afficahge des auteurs -->
                     <td>

                      <!-- récupération des auteurs -->
                      <?php
                      $auteurs = '';
                      foreach ($docs['authFullName_s'] as $auth) {
                        $auteurs .= $auth.', ';
                      }
                      //on enlève la dernière virgule et l'espace
                      $auteurs = substr($auteurs,0,-2);
                      //affichage des auteurs
                      echo $auteurs.'.';

                      //récupération des titres
                      $titres = '';
                      foreach ($docs['title_s'] as $tit) {
                          $titres .= $tit.'. ';
                      }
                      //on enlève le dernier point et l'espace
                      $titres = substr($titres,0,-2);
                      //affichage du titre
                      ?>
                      <b><?=$titres?></b>

                      <!-- récupération des sous-titres -->
                      <?php
                      $stitres = '';
                      foreach ($docs['subTitle_s'] as $stit) {
                          $stitres .= $stit.'. ';
                      }
                      //on enlève le dernier point et l'espace
                      $stitres = substr($stitres,0,-2);
                      //affichage du sous-titre
                      if (strlen($stitres) > 0) {
                        ?>
                        <b><?=$stitres?></b>
                        <?php
                      }

                      $misc = " ";
                      //affichage du titre de la revue
                      if (!empty($docs['journalTitle_s'])) {
                        $misc .= $docs['journalTitle_s'].',';
                      }
                      //affichage du titre de la conférence
                      if (!empty($docs['conferenceTitle_s'])) {
                       $misc .= $docs['conferenceTitle_s'].',';
                      }
                      //affichage du publisher
                      if (!empty($docs['journalPublisher_s'])) {
                       $misc .= ' '.$docs['journalPublisher_s'].',';
                      }

                       //affichage du volume
                      if (!empty($docs['volume_s'])) {
                        //affichage du numéro de volume
                        if(!empty($docs['issue_s'])){
                            $misc .= ' '.$docs['volume_s'].'('.$docs['issue_s'][0].'),';
                        }else{
                            $misc .= ' '.$docs['volume_s'].',';
                        }
                      }

                      //affichage des pages
                      if (!empty($docs['page_s'])) {
                        //vérifie si le 'p' de pages est déjà indiqué
                        if(strpos($docs['page_s'],'p')!==false){
                          $misc .= ' '.$docs['page_s'].',';
                        }else{
                          $misc .= ' p.'.$docs['page_s'].',';
                        }
                      }

                      //affichage de la ville
                      if(!empty($docs['city_s'])){
                        $misc .= ' '.$docs['city_s'].',';
                      }

                      //affichage du pays
                      if(!empty($docs['country_s'])){
                        $misc .= ' '.strtoupper($docs['country_s']).',';
                      }

                      $misc = substr($misc, 0, -1);
                      ?>
                      <i><?=$misc?></i>

                      <!-- affichage de l'ID (HAL) et du DOI s'il existe -->
                      <td><a href =<?=$docs['uri_s']?> target="_blank" > <?=[HAL]?></a>
                      <?php
                      echo ' / <a href ='.$docs['uri_s'].'/bibtex target="_blank">[BIB]</a>';
                      if (!empty($docs['doiId_s']) ) {
                        ?>
                        / <a href=http://dx.doi.org/<?=$docs['doiId_s']?> target="_blank"> <?=[DOI]?> </a>
                        <?php
                      }
                      ?>
                      </td></tr>
                      <?php
  
}


?>