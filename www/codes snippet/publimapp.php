<?php

/**
  * Améliorations à apporter :
  * Enlever les echo innutiles
  */

  
//Fonctions PHP 
      function docTypeConvert ($doctype) {
        
        switch ($doctype) {
            
          case 'ART' :
            return 'ACL';
            break;
          case 'COMM' :
            return 'COM';
            break;
          case 'COUV' :
            return 'CO';
            break;
          case 'OUV' :
            return 'O';
            break;
          case 'DOUV' :
            return 'DO';
            break;
          case 'POSTER' :
            return 'P';
            break;
          case 'PATENT' :
            return 'B';
            break;
          case 'THESE' :
            return 'PhD';
            break;
          case 'HDR' :
            return 'HDR';
            break;
          default : 
            return 'AP';
            break;
        }
      }


//URL de la requête HAL : pour ajouter un ID HAL dans la requête, il faut ajouter "+OR+idhal" entre les parenthèses du champ authIdHal_s
$url = 'https://api.archives-ouvertes.fr/search/?q=&fq=authIdHal_s:(jean-joseorteu+OR+fabrice-schmidt)&wt=json&rows=10000&&fl=producedDateY_i,docType_s,authFullName_s,title_s,journalTitle_s,page_s,volume_s,uri_s,doiId_s,issue_s,localReference_s&sort=producedDate_tdate%20desc';
//utilisation de curl pour récupérer le json
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
curl_close($ch);
//on transforme le json en array php
$json = json_decode($data, true);


 echo "<table width=\"100%\" class=\" tab_publications tablesorter {sortlist: [[0,1]]}\"><col width ='6%'><col width ='5%'><col width ='80%'><col width ='9%'>"."<THEAD>"."<tr>"."<th>Année</th><th>Type</th><th>Auteurs et titre du document</th><th>Liens</th></tr></THEAD><TBODY>";
        foreach ($json['response']['docs'] as $docs) {
          echo "<tr>";

          //affichage de l'annee
          echo '<td>'.$docs['producedDateY_i'].'</td>';
          
          //affichage du type de publi
          echo '<td>'.docTypeConvert($docs['docType_s']).'</td>';
          
          echo "<td>";
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
          echo ' <b>'.$titres.'</b>.';
          
          $misc = " ";
          //affichage du titre de la revue
          if (!empty($docs['journalTitle_s'])) {
            $misc .= $docs['journalTitle_s'].',';
          }
          //affichage des pages
          if (!empty($docs['page_s'])) {
            $misc .= ' '.$docs['page_s'].',';
          }
          //affichage du volume
          if (!empty($docs['volume_s'])) {
            $misc .= ' '.$docs['volume_s'].',';
          }
          $misc = substr($misc, 0, -1);
          echo $misc;

          //affichage de l'ID (HAL) et du DOI s'il existe
          echo '<td><a href ='.$docs['uri_s'].' target="_blank">[HAL]</a>';
          if (!empty($docs['doiId_s']) ) {
            echo ' / <a href=http://dx.doi.org/'.$docs['doiId_s'].' target="_blank"> [DOI] </a>';
          }
        }
          echo '</td></tr>';
        echo "</TBODY></table><br>";
?>