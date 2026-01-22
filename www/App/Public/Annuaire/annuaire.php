<?php

  /**
   * Améliorations à apporter :

   */

 
  include ('App/Public/Annuaire/annuaire_fonctions.php');
//détection de langue courante de la page
$currentlang = get_bloginfo('language');

if(strpos($currentlang,'fr')!==false){
  include('App/lang-fr.php');
}elseif(strpos($currentlang,'en')!==false){
  include('App/lang-en.php');
}else{
  echo("échec de reconnaissance de la langue");
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
      $users = get_users("orderby=user_lastname");
      foreach ($users as $user) {
        if ($user->display_user == 1) {
            if (strlen($user->display_name) > 0) {
              ?>
              <tr><td><a href="<?=esc_url( get_author_posts_url($user->ID) )?>"><?=esc_attr($user->last_name) . ' ' . esc_attr($user->first_name)?></a></td><td>
              <?php echo statusToString(strtolower(esc_attr($user->status)));
              if ((esc_attr($user->hdr) == 1) && (esc_attr($user->status) != 'pr' && esc_attr($user->status) != 'pri' && esc_attr($user->status) != 'pra' && esc_attr($user->status) != 'Professeur associé' && esc_attr($user->status) != 'Professeur invité' && statusToString(strtolower(esc_attr($user->status))) != 'Professeur (ou équivalent)' && esc_attr($user->status) != 'Professeur')) {
                echo ' (HDR)';
              }
              ?>
              </td><td>
              <?php
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
