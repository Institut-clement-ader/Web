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


function statusToString($stat) {
        
        switch ($stat) {
            
          case "adm" :
            return "Administratif";
            break;
          case "air" :
            return "Assistant ingénieur";
            break;
          case "ater" :
            return "Attaché temporaire d'enseignement et de recherche";
            break;
          case "cr" :
            return "Maître de conférence (ou équivalent)";
            break;
          case "doc" :
            return "Doctorant";
            break;
          case "eca" :
            return "Enseignant-chercheur associé";
            break;
          case "icere" :
            return "Professeur (ou équivalent)";
            break;
          case "igt" :
            return "Ingénieur";
            break;
          case "ir" :
            return "Ingénieur de recherche";
            break;
          case "ingénieur - chercheur":
            return "Maître de conférence (ou équivalent)";
            break;
          case "ma" :
            return "Maître de conférence (ou équivalent)";
            break;
          case "maa" :
            return "Maître de conférence (ou équivalent)";
            break;
          case "mcf" :
            return "Maître de conférence (ou équivalent)";
            break;
          case "mcfa" :
            return "Maître de conférence associé";
            break;
          case "pa" :
            return "Maître de conférence (ou équivalent)";
            break;
          case "postdoc" :
            return "Post-doctorant";
            break;
          case "pr" :
            return "Professeur (ou équivalent)";
            break;
          case "professeur émérite" :
            return "Professeur (ou équivalent)";
            break;
          case "prag" :
            return "Professeur agrégé associé";
            break;
          case "pri" :
            return "Professeur invité";
            break;
          case "tech" :
            return "Technicien";
            break;
          case "maître de conférences" :
            return "Maître de conférence (ou équivalent)";
            break;
          case "maître assistant" :
            return "Maître de conférence (ou équivalent)";
            break;
          case "enseignant-chercheur" :
            return "Maître de conférence (ou équivalent)";
            break;
          case "pra" :
            return "Professeur associé";
            break;
          default :
            return ucfirst($stat);
            break;
        }
      }
      


      //////// POUR L'AFFICHAGE DU TITRE
      ?>
	    <input type="text" id="searchAnnu" class="search_tab" placeholder="<?=TXT_CHERCHER_ANNUAIRE?>" title="Rentrer un nom">
      <table class="tablesorter {sortlist: [[0,0]]} tab_annuaire" border="0"  cellpadding="1" width="100%" id="table"><thead>
      <tr><th><b><?=TXT_NOM_ANNUAIRE?></b></th>
        <th><b><?=TXT_STATUT_ANNUAIRE?></b></th>
        <th><b><?=TXT_GROUPE_ANNUAIRE?></b></th>
        <th><b><?=TXT_ETABLISSEMENT_ANNUAIRE?></b></th>
      </tr></thead><tbody>

      <?php
      $users = get_users('orderby=user_lastname');
      foreach ($users as $user) {
        if ($user->display_user == 1) {
            if (strlen($user->display_name) > 0) {
              ?>
              <tr><td><a href="<?=esc_url( get_author_posts_url($user->ID) )?>"><?=esc_attr($user->last_name) . ' ' . esc_attr($user->first_name)?></a></td><td>
              <?php echo statusToString(strtolower(esc_attr($user->status)));
              if ((esc_attr($user->hdr) == 1) && (esc_attr($user->status) != 'pr' && esc_attr($user->status) != 'pri' && esc_attr($user->status) != 'pra' && esc_attr($user->status) != 'Professeur associé' && esc_attr($user->status) != 'Professeur invité' && statusToString(strtolower(esc_attr($user->status))) != 'Professeur (ou équivalent)' && esc_attr($user->status) != 'Professeur')) {
                echo ' (HDR)';
              }
              echo'</td><td>';
              echo strtoupper(esc_attr($user->groupe_primaire));
              if (strlen(esc_attr($user->groupe_secondaire)) > 0 && (esc_attr($user->groupe_secondaire) != esc_attr($user->groupe_primaire) && esc_attr($user->groupe_secondaire) != 'AXTR')) {
                echo '/'.strtoupper(esc_attr($user->groupe_secondaire));
              }
              if (strlen(esc_attr($user->groupe_tertiaire)) > 0  && (esc_attr($user->groupe_secondaire) != esc_attr($user->groupe_tertiaire) && esc_attr($user->groupe_tertiaire) != 'AXTR') &&  (esc_attr($user->groupe_primaire) != esc_attr($user->groupe_tertiaire))) {
                echo '/'.strtoupper(esc_attr($user->groupe_tertiaire));
              }
              ?>
              </td><td>
              <?php
              echo esc_attr($user->tablissement_de_rattachement)?> </td></tr>
              <?php
            }
        }
      }
      ?>
      </tbody></table>
