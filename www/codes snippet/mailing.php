<?php

  /**
  * Améliorations à apporter :
  * La fonction statusToCode est innutile il y a un moyen plus simple de retrouver le status grace au wp_current_user
  * Il suffit de faire :
          *$current_user = wp_get_current_user();
          *$nom_uti= $current_user->display_name;
          *$status= $current_user->status;
  * Enlever les echo innutiles en fermant les balises php
  * Supprimer les élements innutiles ( fonction status)
  */

function statusToCode($status) {
        
        switch ($status) {
          case "Administratif" :
            return "ita";
            break;
          case "Assistant ingénieur" :
            return "ita";
            break;
          case "Attaché temporaire d'enseignement et de recherche" :
            return "dap";
            break;
          case "Chargé de recherche" :
            return "mc";
            break;
          case "Doctorant" :
            return "dap";
            break;
          case "Enseignant-chercheur associé" :
            return "ma";
            break;
          case "Professeur" :
            return "pr";
            break;
          case "Ingénieur" :
            return "ita";
            break;
          case "Ingénieur de recherche" :
            return "ita";
            break;
          case "Ingénieur - Chercheur" :
            return "mc";
            break;
          case "Maître de conférences" :
            return "mc";
            break;
          case "Maître de conférence" :
            return "mc";
            break;
          case "Maître de conférence associé" :
            return "ma";
            break;
          case "Maître de conférences associé" :
            return "ma";
            break;
          case "Professeur associé" :
            return "ma";
            break;
          case "Post-doctorant" :
            return "dap";
            break;
          case "Professeur agrégé associé" :
            return "ma";
            break;
          case "Professeur invité" :
            return "pr";
            break;
          case "Technicien" :
            return "ita";
            break;
          case "Maître de conférences" :
            return "mc";
            break;
          case "Professeur associé" :
            return "ma";
            break;
          case "Maître assistant" :
            return "mc";
            break;
          case "Enseignant-chercheur" :
            return "mc";
            break;
          default :
            return '';
            break;
        }
      }
      
      echo " 
<div class=\"publi\"> Ce petit utilitaire vous permet de récupérer la liste des e-mails des membres de L'ICA en fonction de plusieurs critères :</div><br />";
echo "<FORM METHOD=\"POST\" ACTION=\"\" class=\"form-publi\">";

 //////////////////////////////////////////////////// -->
echo "<fieldset class='doc-search'>";
echo "<legend>Critères de recherche</legend>";
echo "<div>";
echo '<div class="type" id="grpAxe">';
echo " En fonction du groupe / de l' Axe :<br>      	<SELECT name=\"equipe\">";
echo "<option value=\"tous\"> Tout le laboratoire </option>\n";
      
echo "<optgroup label=\"SUMO\">";
  echo "<option value=\"SUMO\"> Tout le groupe SUMO </option>";
  echo "<option value=\"Fatigue Modélisation Endommagement et Usure (SUMO)\"> Axe FAMEU (Fatigue, Modélisation, Endommagement et Usure) </option>";
echo "<option value=\"Propriétés d usage et microstructures des matériaux avancés (SUMO)\"> Axe PUMMA (Propriétés d&#39;usage et microstructures des matériaux avancés) </option>";
  echo "<option value=\"Usinage et mise en forme (SUMO)\"> Axe USIMEF (Usinage et mise en forme) </option>";

echo "<optgroup label=\"MSC\">";
  echo "<option value=\"MSC\"> Tout le groupe MSC </option>";
  echo "<option value=\"Structures Impact Modélisation Usinage (MSC)\"> Axe SIMU (Structures Impact Modélisation Usinage) </option>";
  echo "<option value=\"Matériaux Propriétés et Procédés (MSC)\"> Axe MAPP (Matériaux, Propriétés et Procédés) </option>";

echo "<optgroup label=\"MS2M\">";
  echo "<option value=\"MS2M\"> Tout le groupe MS2M </option>";
  echo "<option value=\"Ingénierie des systèmes et des microsystèmes (MS2M)\"> Axe ISM (Ingénierie des systèmes et des microsystèmes) </option>";
  echo "<option value=\"Intégrité des structures et des systèmes (MS2M)\"> Axe ISS (Intégrité des structures et des systèmes) </option>";

echo "<optgroup label=\"MICS\">";
  echo "<option value=\"MICS\"> Tout le groupe MICS </option>";
  echo "<option value=\"Méthodes optiques innovantes pour la métrologie dimensionnelle et thermique (MICS)\"> Axe MOIMDT (Méthodes optiques innovantes pour la métrologie dimensionnelle et thermique) </option>";
  echo "<option value=\"Identification et contrôle de propriétés thermiques et mécaniques (MICS)\"> Axe ICPTM (Identification et contrôle de propriétés thermiques et mécaniques) </option>";

echo "<optgroup label=\"Axes transverses\">";
  echo "<option value=\"Assemblages (AXTR)\"> Axe ASM (Assemblages) </option>";
  echo "<option value=\"Usinage multi-matériaux (AXTR)\"> Axe UMM (Usinage multi-matériaux) </option>";
      
echo "</SELECT><br><br>";
echo '</div>';

////////////////////////////////////////////////////

echo "
<div class=\"type\" id=\"statut\">
En fonction du statut :<br> <SELECT name=\"statut\">
<option value=\"tous\"> Tous les statuts </option>
<option value=\"pr\" > Professeurs et équiv.</option>
<option value=\"mc\" > Maîtres de Conférences et équiv.</option>
<option value=\"ita\" > Ingénieurs, techniciens, administratifs </option>
<option value=\"dap\" > Doctorants, ATER, Post-doctorants </option>
<option value=\"ma\" > Membres associés </option>
</SELECT><br><br>
</div>";


////////////////////////////////////////////////////
echo '<div class="type" id="etab">';
echo "
En fonction de l'établissement : <br> <SELECT name=\"tutelle\">";
echo "<option value=\"tous\"> Tous les établissements </option> \n";
echo "<option value=\"CNRS\"> CNRS </option> \n";
echo "<option value=\"CUFR J.F. Champollion\"> CUFR J.F. Champollion </option> \n";
echo "<option value=\"IMT MINES ALBI\"> IMT MINES ALBI</option> \n";
echo "<option value=\"ICAM\"> ICAM </option> \n";
echo "<option value=\"INSA\"> INSA de Toulouse </option> \n";
echo "<option value=\"ISAE-SUPAERO\"> ISAE-Supaero </option> \n";
echo "<option value=\"IUT de Figeac\"> IUT de Figeac </option> \n";
echo "<option value=\"IUT GMP\"> IUT GMP </option> \n";
echo "<option value=\"IUT de Tarbes\"> IUT de Tarbes </option> \n";
echo "<option value=\"UPS\"> UPS </option> \n";
echo "<option value=\"UT-2 Jean-Jaurès\"> UT-2 Jean-Jaurès </option> \n";
echo "</SELECT><br>";
echo '</div>';
echo "</div>";
echo "</fieldset>";

echo "<label for='debut'>Limiter à </label>";
echo "<input id='decoup' type='number' min='5' step='5' name='nb'/>";
echo " &nbsp&nbsp addresses mail par envoi (laisser vide pour ignorer)";
echo '<br />';
//////////////////////////////////////////////////// -->

echo "<br><INPUT TYPE=SUBMIT value=\"Rechercher\" name=\"submit\"> </FORM><br></p>";
$nb = 0; 
$cmp = 0;
      if (isset($_POST['nb'])) {
         $nb = $_POST['nb'];
      }
      
      if (isset($_POST['submit'])) {
       
        $equipe = stripcslashes($_POST['equipe']);
        $statut = $_POST['statut'];
        $tutelle = $_POST['tutelle'];
        echo "Équipe : <b>".ucfirst($equipe).'</b> ; Statut : <b>'.ucfirst($statut).'</b> ; Établissement : <b>'.ucfirst($tutelle).'</b><br><br>';
        
        $all_users = get_users();
        foreach ($all_users as $user) {
          
          if ($user->display_user == 1) {
            // tout le personnel
            if ($equipe == 'tous' && $statut == 'tous' && $tutelle == 'tous') {
              if (strpos(esc_html($user->status), 'invité') !== false) {
                echo '<i>'.esc_html($user->display_name)
                ?>
                <?php
function statusToCode($status) {
        
        switch ($status) {
          case "Administratif" :
            return "ita";
            break;
          case "Assistant ingénieur" :
            return "ita";
            break;
          case "Attaché temporaire d'enseignement et de recherche" :
            return "dap";
            break;
          case "Chargé de recherche" :
            return "mc";
            break;
          case "Doctorant" :
            return "dap";
            break;
          case "Enseignant-chercheur associé" :
            return "ma";
            break;
          case "Professeur" :
            return "pr";
            break;
          case "Ingénieur" :
            return "ita";
            break;
          case "Ingénieur de recherche" :
            return "ita";
            break;
          case "Ingénieur - Chercheur" :
            return "mc";
            break;
          case "Maître de conférences" :
            return "mc";
            break;
          case "Maître de conférence" :
            return "mc";
            break;
          case "Maître de conférence associé" :
            return "ma";
            break;
          case "Maître de conférences associé" :
            return "ma";
            break;
          case "Professeur associé" :
            return "ma";
            break;
          case "Post-doctorant" :
            return "dap";
            break;
          case "Professeur agrégé associé" :
            return "ma";
            break;
          case "Professeur invité" :
            return "pr";
            break;
          case "Technicien" :
            return "ita";
            break;
          case "Maître de conférences" :
            return "mc";
            break;
          case "Professeur associé" :
            return "ma";
            break;
          case "Maître assistant" :
            return "mc";
            break;
          case "Enseignant-chercheur" :
            return "mc";
            break;
          default :
            return '';
            break;
        }
      }
      
      echo " 
<div class=\"publi\"> Ce petit utilitaire vous permet de récupérer la liste des e-mails des membres de L'ICA en fonction de plusieurs critères :</div><br />";
echo "<FORM METHOD=\"POST\" ACTION=\"\" class=\"form-publi\">";

 //////////////////////////////////////////////////// -->
echo "<fieldset class='doc-search'>";
echo "<legend>Critères de recherche</legend>";
echo "<div>";
echo '<div class="type" id="grpAxe">';
echo " En fonction du groupe / de l' Axe :<br>      	<SELECT name=\"equipe\">";
echo "<option value=\"tous\"> Tout le laboratoire </option>\n";
      
echo "<optgroup label=\"SUMO\">";
  echo "<option value=\"SUMO\"> Tout le groupe SUMO </option>";
  echo "<option value=\"Fatigue Modélisation Endommagement et Usure (SUMO)\"> Axe FAMEU (Fatigue, Modélisation, Endommagement et Usure) </option>";
echo "<option value=\"Propriétés d usage et microstructures des matériaux avancés (SUMO)\"> Axe PUMMA (Propriétés d&#39;usage et microstructures des matériaux avancés) </option>";
  echo "<option value=\"Usinage et mise en forme (SUMO)\"> Axe USIMEF (Usinage et mise en forme) </option>";

echo "<optgroup label=\"MSC\">";
  echo "<option value=\"MSC\"> Tout le groupe MSC </option>";
  echo "<option value=\"Structures Impact Modélisation Usinage (MSC)\"> Axe SIMU (Structures Impact Modélisation Usinage) </option>";
  echo "<option value=\"Matériaux Propriétés et Procédés (MSC)\"> Axe MAPP (Matériaux, Propriétés et Procédés) </option>";

echo "<optgroup label=\"MS2M\">";
  echo "<option value=\"MS2M\"> Tout le groupe MS2M </option>";
  echo "<option value=\"Ingénierie des systèmes et des microsystèmes (MS2M)\"> Axe ISM (Ingénierie des systèmes et des microsystèmes) </option>";
  echo "<option value=\"Intégrité des structures et des systèmes (MS2M)\"> Axe ISS (Intégrité des structures et des systèmes) </option>";

echo "<optgroup label=\"MICS\">";
  echo "<option value=\"MICS\"> Tout le groupe MICS </option>";
  echo "<option value=\"Méthodes optiques innovantes pour la métrologie dimensionnelle et thermique (MICS)\"> Axe MOIMDT (Méthodes optiques innovantes pour la métrologie dimensionnelle et thermique) </option>";
  echo "<option value=\"Identification et contrôle de propriétés thermiques et mécaniques (MICS)\"> Axe ICPTM (Identification et contrôle de propriétés thermiques et mécaniques) </option>";

echo "<optgroup label=\"Axes transverses\">";
  echo "<option value=\"Assemblages (AXTR)\"> Axe ASM (Assemblages) </option>";
  echo "<option value=\"Usinage multi-matériaux (AXTR)\"> Axe UMM (Usinage multi-matériaux) </option>";
      
echo "</SELECT><br><br>";
echo '</div>';

////////////////////////////////////////////////////

echo "
<div class=\"type\" id=\"statut\">
En fonction du statut :<br> <SELECT name=\"statut\">
<option value=\"tous\"> Tous les statuts </option>
<option value=\"pr\" > Professeurs et équiv.</option>
<option value=\"mc\" > Maîtres de Conférences et équiv.</option>
<option value=\"ita\" > Ingénieurs, techniciens, administratifs </option>
<option value=\"dap\" > Doctorants, ATER, Post-doctorants </option>
<option value=\"ma\" > Membres associés </option>
</SELECT><br><br>
</div>";


////////////////////////////////////////////////////
echo '<div class="type" id="etab">';
echo "
En fonction de l'établissement : <br> <SELECT name=\"tutelle\">";
echo "<option value=\"tous\"> Tous les établissements </option> \n";
echo "<option value=\"CNRS\"> CNRS </option> \n";
echo "<option value=\"CUFR J.F. Champollion\"> CUFR J.F. Champollion </option> \n";
echo "<option value=\"IMT MINES ALBI\"> IMT MINES ALBI</option> \n";
echo "<option value=\"ICAM\"> ICAM </option> \n";
echo "<option value=\"INSA\"> INSA de Toulouse </option> \n";
echo "<option value=\"ISAE-SUPAERO\"> ISAE-Supaero </option> \n";
echo "<option value=\"IUT de Figeac\"> IUT de Figeac </option> \n";
echo "<option value=\"IUT GMP\"> IUT GMP </option> \n";
echo "<option value=\"IUT de Tarbes\"> IUT de Tarbes </option> \n";
echo "<option value=\"UPS\"> UPS </option> \n";
echo "<option value=\"UT-2 Jean-Jaurès\"> UT-2 Jean-Jaurès </option> \n";
echo "</SELECT><br>";
echo '</div>';
echo "</div>";
echo "</fieldset>";

echo "<label for='debut'>Limiter à </label>";
echo "<input id='decoup' type='number' min='5' step='5' name='nb'/>";
echo " &nbsp&nbsp addresses mail par envoi (laisser vide pour ignorer)";
echo '<br />';
//////////////////////////////////////////////////// -->

echo "<br><INPUT TYPE=SUBMIT value=\"Rechercher\" name=\"submit\"> </FORM><br></p>";
$nb = 0; 
$cmp = 0;
      if (isset($_POST['nb'])) {
         $nb = $_POST['nb'];
      }
      
      if (isset($_POST['submit'])) {
       
        $equipe = stripcslashes($_POST['equipe']);
        $statut = $_POST['statut'];
        $tutelle = $_POST['tutelle'];
        echo "Équipe : <b>".ucfirst($equipe).'</b> ; Statut : <b>'.ucfirst($statut).'</b> ; Établissement : <b>'.ucfirst($tutelle).'</b><br><br>';
        
        $all_users = get_users();
        foreach ($all_users as $user) {
          
          if ($user->display_user == 1) {
            // tout le personnel
            if ($equipe == 'tous' && $statut == 'tous' && $tutelle == 'tous') {
              if (strpos(esc_html($user->status), 'invité') !== false) {
                echo '<i>'.esc_html($user->display_name).'</i>' . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                $cmp++;
              } else {
                echo esc_html($user->display_name) . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                $cmp++;
              }

            //un groupe / axe précis
            } else if ($equipe != 'tous' && $statut == 'tous' && $tutelle == 'tous') {
               if ($equipe != 'SUMO' && $equipe != 'MSC' && $equipe != 'MS2M' && $equipe != 'MICS') {
                  if ($user->axe_primaire == $equipe || $user->axe_secondaire == $equipe || $user->axe_tertiaire == $equipe) {
                     if (strpos(esc_html($user->status), 'invité') !== false) {
                       echo '<i>'.esc_html($user->display_name).'</i>' . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                       $cmp++;
                     } else {
                       echo esc_html($user->display_name) . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                       $cmp++;
                     }
                  }
               } else {
                  if ($user->groupe_primaire == $equipe || $user->groupe_secondaire == $equipe || $user->groupe_tertiaire == $equipe) {
                     if (strpos(esc_html($user->status), 'invité') !== false) {
                       echo '<i>'.esc_html($user->display_name).'</i>' . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                       $cmp++;
                     } else {
                       echo esc_html($user->display_name) . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                       $cmp++;
                     }
                  }
               }

            //un statut précis
            } else if ($equipe == 'tous' && $statut != 'tous' && $tutelle == 'tous') {
              $code = statusToCode(esc_attr($user->status));
              if ($code == $statut) {
                if (strpos(esc_html($user->status), 'invité') !== false) {
                  echo '<i>'.esc_html($user->display_name).'</i>' . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                  $cmp++;
                } else {
                  echo esc_html($user->display_name) . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                  $cmp++;
                }
              }

            //un établissement de rattachement précis
            } else if ($equipe == 'tous' && $statut == 'tous' && $tutelle != 'tous') {
              if ($user->tablissement_de_rattachement == $tutelle) {
                if (strpos(esc_html($user->status), 'invité') !== false) {
                  echo '<i>'.esc_html($user->display_name).'</i>' . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                  $cmp++;
                } else {
                  echo esc_html($user->display_name) . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                  $cmp++;
                }
              }

            //un statut et un groupe/axe précis
            } else if ($equipe != 'tous' && $statut != 'tous' && $tutelle == 'tous') {
               $code = statusToCode(esc_attr($user->status));
               if ($equipe != 'SUMO' && $equipe != 'MSC' && $equipe != 'MS2M' && $equipe != 'MICS') {
                  if (($user->axe_primaire == $equipe || $user->axe_secondaire == $equipe || $user->axe_tertiaire == $equipe) && $code == $statut) {
                     if (strpos(esc_html($user->status), 'invité') !== false) {
                      echo '<i>'.esc_html($user->display_name).'</i>' . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                      $cmp++;
                    } else {
                      echo esc_html($user->display_name) . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                      $cmp++;
                    }
                  }
               } else {
                  if (($user->groupe_primaire == $equipe || $user->groupe_secondaire == $equipe || $user->groupe_tertiaire == $equipe) && $code == $statut) {
                     if (strpos(esc_html($user->status), 'invité') !== false) {
                      echo '<i>'.esc_html($user->display_name).'</i>' . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                      $cmp++;
                     } else {
                      echo esc_html($user->display_name) . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                      $cmp++;
                     }
                  }
               }


            //un établissement de rattachement et un groupe/axe précis
            } else if ($equipe != 'tous' && $statut == 'tous' && $tutelle != 'tous') {
               if ($equipe != 'SUMO' && $equipe != 'MSC' && $equipe != 'MS2M' && $equipe != 'MICS') {
                  if (($user->axe_primaire == $equipe || $user->axe_secondaire == $equipe || $user->axe_tertiaire == $equipe) && $user->tablissement_de_rattachement == $tutelle) {
                     if (strpos(esc_html($user->status), 'invité') !== false) {
                      echo '<i>'.esc_html($user->display_name).'</i>' . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                      $cmp++;
                     } else {
                      echo esc_html($user->display_name) . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                      $cmp++;
                     }
                  }
               } else {
                  if (($user->groupe_primaire == $equipe || $user->groupe_secondaire == $equipe || $user->groupe_tertiaire == $equipe) && $user->tablissement_de_rattachement == $tutelle) {
                     if (strpos(esc_html($user->status), 'invité') !== false) {
                      echo '<i>'.esc_html($user->display_name).'</i>' . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                      $cmp++;
                     } else {
                      echo esc_html($user->display_name) . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                      $cmp++;
                     }
                  }
               }


            //un statut et un établissement de rattachement précis 
            } else if ($equipe == 'tous' && $statut != 'tous' && $tutelle != 'tous') {
               $code = statusToCode(esc_attr($user->status));
               if ($user->tablissement_de_rattachement == $tutelle && $code == $statut) {
                 if (strpos(esc_html($user->status), 'invité') !== false) {
                   echo '<i>'.esc_html($user->display_name).'</i>' . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                   $cmp++;
                 } else {
                   echo esc_html($user->display_name) . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                   $cmp++;
                 }
               } 


            //un statut, un groupe/axe et un établissement de rattachement précis  
            } else {
               $code = statusToCode(esc_attr($user->status));
               if ($equipe != 'SUMO' && $equipe != 'MSC' && $equipe != 'MS2M' && $equipe != 'MICS') {
                  if (($user->axe_primaire == $equipe || $user->axe_secondaire == $equipe || $user->axe_tertiaire == $equipe) && ($code == $statut) && ($user->tablissement_de_rattachement == $tutelle)) {
                     if (strpos(esc_html($user->status), 'invité') !== false) {
                        echo '<i>'.esc_html($user->display_name).'</i>' . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                        $cmp++;
                     } else {
                        echo esc_html($user->display_name) . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                        $cmp++;
                     }
                  }
               } else {
                  if (($user->groupe_primaire == $equipe || $user->groupe_secondaire == $equipe || $user->groupe_tertiaire == $equipe) && ($code == $statut) && ($user->tablissement_de_rattachement == $tutelle)) {
                     if (strpos(esc_html($user->status), 'invité') !== false) {
                        echo '<i>'.esc_html($user->display_name).'</i>' . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                        $cmp++;
                     } else {
                        echo esc_html($user->display_name) . ' &lt;' . esc_html($user->user_email) . '&gt;'.',<br>';
                        $cmp++;
                     }
                  }
               }

            }


        }
          if ($nb != 0) {
            if ($cmp == $nb) {
              echo '<br />';
              $cmp = 0;
            }
          }
        }
        echo '<br><br>';
        
      }
?>