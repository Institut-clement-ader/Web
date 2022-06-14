<?php

  /**
  * Améliorations à apporter :
  */

  $current_user = wp_get_current_user();
  $nom_uti= $current_user->display_name;
  $code= $current_user->status;

?>
<div class=\"publi\"> Ce petit utilitaire vous permet de récupérer la liste des e-mails des membres de L'ICA en fonction de plusieurs critères :</div><br />
<FORM METHOD=\"POST\" ACTION=\"\" class=\"form-publi\">




<fieldset class='doc-search'>
<legend>Critères de recherche</legend>
<div>
<div class="type" id="grpAxe">
<?php echo " En fonction du groupe / de l' Axe :";?><br>
<select name="equipe">;
<option value="tous"> Tout le laboratoire </option>\n
      
<!-- Groupe Sumo -->
<optgroup label="SUMO">
<option value="SUMO"> Tout le groupe SUMO </option>
<option value="Fatigue Modélisation Endommagement et Usure (SUMO)"> Axe FAMEU (Fatigue, Modélisation, Endommagement et Usure) </option>
<option value="Propriétés d usage et microstructures des matériaux avancés (SUMO)"> Axe PUMMA (Propriétés d&#39;usage et microstructures des matériaux avancés) </option>
<option value="Usinage et mise en forme (SUMO)"> Axe USIMEF (Usinage et mise en forme) </option>

<!-- Groupe MSC -->
<optgroup label="MSC">
<option value="MSC"> Tout le groupe MSC </option>
<option value="Structures Impact Modélisation Usinage (MSC)"> Axe SIMU (Structures Impact Modélisation Usinage) </option>
<option value="Matériaux Propriétés et Procédés (MSC)"> Axe MAPP (Matériaux, Propriétés et Procédés) </option>

<!-- Groupe MS2M -->
<optgroup label="MS2M">
<option value="MS2M"> Tout le groupe MS2M </option>
<option value="Ingénierie des systèmes et des microsystèmes (MS2M)"> Axe ISM (Ingénierie des systèmes et des microsystèmes) </option>
<option value="Intégrité des structures et des systèmes (MS2M)"> Axe ISS (Intégrité des structures et des systèmes) </option>

  <!-- Groupe MICS -->
<optgroup label="MICS">
<option value="MICS"> Tout le groupe MICS </option>
<option value="Méthodes optiques innovantes pour la métrologie dimensionnelle et thermique (MICS)"> Axe MOIMDT (Méthodes optiques innovantes pour la métrologie dimensionnelle et thermique) </option>
<option value="Identification et contrôle de propriétés thermiques et mécaniques (MICS)"> Axe ICPTM (Identification et contrôle de propriétés thermiques et mécaniques) </option>

  <!-- Groupe Axes transverses -->
<optgroup label="Axes transverses">
<option value="Assemblages (AXTR)"> Axe ASM (Assemblages) </option>
<option value="Usinage multi-matériaux (AXTR)"> Axe UMM (Usinage multi-matériaux) </option>
      
</select><br><br>
</div>




<!-- Statut -->
<div class="type" id="statut">
En fonction du statut :<br> <SELECT name="statut">
<option value="tous"> Tous les statuts </option>
<option value="pr" > Professeurs et équiv.</option>
<option value="mc" > Maîtres de Conférences et équiv.</option>
<option value="ita" > Ingénieurs, techniciens, administratifs </option>
<option value="dap" > Doctorants, ATER, Post-doctorants </option>
<option value="ma" > Membres associés </option>
</SELECT><br><br>
</div>


<div class="type" id="etab">
<?php echo "En fonction de l'établissement : "?><br> <SELECT name="tutelle">
<option value="tous"> Tous les établissements </option> \n
<option value="CNRS"> CNRS </option> \n
<option value="CUFR J.F. Champollion"> CUFR J.F. Champollion </option> \n
<option value="IMT MINES ALBI"> IMT MINES ALBI</option> \n
<option value="ICAM"> ICAM </option> \n
<option value="INSA"> INSA de Toulouse </option> \n
<option value="ISAE-SUPAERO"> ISAE-Supaero </option> \n
<option value="IUT de Figeac"> IUT de Figeac </option> \n
<option value="IUT GMP"> IUT GMP </option> \n
<option value="IUT de Tarbes"> IUT de Tarbes </option> \n
<option value="UPS"> UPS </option> \n";
<option value="UT-2 Jean-Jaurès"> UT-2 Jean-Jaurès </option> \n
</SELECT><br>
</div>
</div>
</fieldset>

<label for='debut'>Limiter à </label>
<input id='decoup' type='number' min='5' step='5' name='nb'/>
<?php echo " &nbsp&nbsp addresses mail par envoi (laisser vide pour ignorer)"; ?>
<br />

<br><input TYPE=SUBMIT value="Rechercher" name="submit"> </form><br></p>
<?php
$nb = 0; 
$cmp = 0;
      if (isset($_POST['nb'])) {
         $nb = $_POST['nb'];
      }
      
      if (isset($_POST['submit'])) {
       
        $equipe = stripcslashes($_POST['equipe']);
        $statut = $_POST['statut'];
        $tutelle = $_POST['tutelle'];
        echo "Équipe : "?><b><?=ucfirst($equipe)?></b>Statut : <b><?=ucfirst($statut)?></b>Établissement : <b><?=ucfirst($tutelle)?></b><br><br>
        <?php
        $all_users = get_users();
        foreach ($all_users as $user) {
          
          if ($user->display_user == 1) {
            // tout le personnel
            if ($equipe == 'tous' && $statut == 'tous' && $tutelle == 'tous') {
              if (strpos(esc_html($user->status), 'invité') !== false) {
                ?><i><?=esc_html($user->display_name)?></i>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                $cmp++;
              } else {
                ?><?=esc_html($user->display_name);?>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                $cmp++;
              }

            //un groupe / axe précis
            } else if ($equipe != 'tous' && $statut == 'tous' && $tutelle == 'tous') {
               if ($equipe != 'SUMO' && $equipe != 'MSC' && $equipe != 'MS2M' && $equipe != 'MICS') {
                  if ($user->axe_primaire == $equipe || $user->axe_secondaire == $equipe || $user->axe_tertiaire == $equipe) {
                     if (strpos(esc_html($user->status), 'invité') !== false) {
                      ?><i><?=esc_html($user->display_name)?></i>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                      $cmp++;
                    } else {
                      ?><?=esc_html($user->display_name);?>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                      $cmp++;
                     }
                  }
               } else {
                  if ($user->groupe_primaire == $equipe || $user->groupe_secondaire == $equipe || $user->groupe_tertiaire == $equipe) {
                     if (strpos(esc_html($user->status), 'invité') !== false) {
                      ?><i><?=esc_html($user->display_name)?></i>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                      $cmp++;
                    } else {
                      ?><?=esc_html($user->display_name);?>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                      $cmp++;
                     }
                  }
               }

            //un statut précis
            } else if ($equipe == 'tous' && $statut != 'tous' && $tutelle == 'tous') {
              if ($code == $statut) {
                if (strpos(esc_html($user->status), 'invité') !== false) {
                  ?><i><?=esc_html($user->display_name)?></i>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                  $cmp++;
                } else {
                  ?><?=esc_html($user->display_name);?>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                  $cmp++;
                }
              }

            //un établissement de rattachement précis
            } else if ($equipe == 'tous' && $statut == 'tous' && $tutelle != 'tous') {
              if ($user->tablissement_de_rattachement == $tutelle) {
                if (strpos(esc_html($user->status), 'invité') !== false) {
                  ?><i><?=esc_html($user->display_name)?></i>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                  $cmp++;
                } else {
                  ?><?=esc_html($user->display_name);?>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                  $cmp++;
                }
              }

            //un statut et un groupe/axe précis
            } else if ($equipe != 'tous' && $statut != 'tous' && $tutelle == 'tous') {
               if ($equipe != 'SUMO' && $equipe != 'MSC' && $equipe != 'MS2M' && $equipe != 'MICS') {
                  if (($user->axe_primaire == $equipe || $user->axe_secondaire == $equipe || $user->axe_tertiaire == $equipe) && $code == $statut) {
                     if (strpos(esc_html($user->status), 'invité') !== false) {
                      ?><i><?=esc_html($user->display_name)?></i>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                      $cmp++;
                    } else {
                      ?><?=esc_html($user->display_name);?>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                      $cmp++;
                    }
                  }
               } else {
                  if (($user->groupe_primaire == $equipe || $user->groupe_secondaire == $equipe || $user->groupe_tertiaire == $equipe) && $code == $statut) {
                     if (strpos(esc_html($user->status), 'invité') !== false) {
                      ?><i><?=esc_html($user->display_name)?></i>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                      $cmp++;
                    } else {
                      ?><?=esc_html($user->display_name);?>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                      $cmp++;
                     }
                  }
               }


            //un établissement de rattachement et un groupe/axe précis
            } else if ($equipe != 'tous' && $statut == 'tous' && $tutelle != 'tous') {
               if ($equipe != 'SUMO' && $equipe != 'MSC' && $equipe != 'MS2M' && $equipe != 'MICS') {
                  if (($user->axe_primaire == $equipe || $user->axe_secondaire == $equipe || $user->axe_tertiaire == $equipe) && $user->tablissement_de_rattachement == $tutelle) {
                     if (strpos(esc_html($user->status), 'invité') !== false) {
                      ?><i><?=esc_html($user->display_name)?></i>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                      $cmp++;
                    } else {
                      ?><?=esc_html($user->display_name);?>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                      $cmp++;
                     }
                  }
               } else {
                  if (($user->groupe_primaire == $equipe || $user->groupe_secondaire == $equipe || $user->groupe_tertiaire == $equipe) && $user->tablissement_de_rattachement == $tutelle) {
                     if (strpos(esc_html($user->status), 'invité') !== false) {
                      ?><i><?=esc_html($user->display_name)?></i>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                      $cmp++;
                    } else {
                      ?><?=esc_html($user->display_name);?>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                      $cmp++;
                  }
               }
              }
            //un statut et un établissement de rattachement précis 
            } else if ($equipe == 'tous' && $statut != 'tous' && $tutelle != 'tous') {
               if ($user->tablissement_de_rattachement == $tutelle && $code == $statut) {
                      ?><i><?=esc_html($user->display_name)?></i>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                      $cmp++;
                    } else {
                      ?><?=esc_html($user->display_name);?>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                      $cmp++;
                 }
               } 


            //un statut, un groupe/axe et un établissement de rattachement précis  
            } else {
               if ($equipe != 'SUMO' && $equipe != 'MSC' && $equipe != 'MS2M' && $equipe != 'MICS') {
                  if (($user->axe_primaire == $equipe || $user->axe_secondaire == $equipe || $user->axe_tertiaire == $equipe) && ($code == $statut) && ($user->tablissement_de_rattachement == $tutelle)) {
                     if (strpos(esc_html($user->status), 'invité') !== false) {
                      ?><i><?=esc_html($user->display_name)?></i>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                      $cmp++;
                    } else {
                      ?><?=esc_html($user->display_name);?>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                      $cmp++;
                     }
                  }
               } else {
                  if (($user->groupe_primaire == $equipe || $user->groupe_secondaire == $equipe || $user->groupe_tertiaire == $equipe) && ($code == $statut) && ($user->tablissement_de_rattachement == $tutelle)) {
                     if (strpos(esc_html($user->status), 'invité') !== false) {
                      ?><i><?=esc_html($user->display_name)?></i>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                      $cmp++;
                    } else {
                      ?><?=esc_html($user->display_name);?>&lt<?=esc_html($user->user_email);?>&gt<br><?php
                      $cmp++;
                     }
                  }
               }

            }


        }
          if ($nb != 0) {
            if ($cmp == $nb) {
              ?><br /><?php
              $cmp = 0;
            }
          }
        }
        ?><br><br><?php
        
?>