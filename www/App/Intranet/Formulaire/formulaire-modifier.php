<?php

/**
 * Todo :
 * utiliser les pods pour les axes/ status/ etablissements /actv_rech
 * Faire en sorte que lorsque recherche l'utilisateur une fois l'adresse mail saisie
 */

//Pour récupérer le groupe dans le nom de l'axe
function parenthese($str)
{
  return substr($str, ($p = strpos($str, '(') + 1), strrpos($str, ')') - $p);
}

// Restreint l accès aux administrateurs

if (!current_user_can('administrator')) {
  echo ("You are not allowed to be here !");
  exit();
}


$record = false;
$userexist = true; //  à true ne pas afficher le message d'erreur

if (isset($_POST['valider'])) {
  //résupère l'utilisateur a modifier avec son mail
  $user = get_user_by('email', $_POST['mail']);
  //si l'utilisateur existe
  if ($user == true) {
    $userexist = true;
    $record = true;
    $id = $user->ID;
    $cocher = 1;
    update_user_meta($id, 'status', $_POST['statut']);
    update_user_meta($id, 'axe_primaire', $_POST['axe_1']);
    update_user_meta($id, 'groupe_primaire', parenthese($_POST['axe_1']));
    update_user_meta($id, 'axe_secondaire', $_POST['axe_2']);
    update_user_meta($id, 'groupe_secondaire', parenthese($_POST['axe_2']));
    update_user_meta($id, 'axe_tertiaire', $_POST['axe_3']);
    update_user_meta($id, 'groupe_tertiaire', parenthese($_POST['axe_3']));
    update_user_meta($id, 'tablissement_de_rattachement', $_POST['etablissement']);
    update_user_meta($id, 'actv_rech', $_POST['actv_rech']);
    update_user_meta($id, 'arrivee', $_POST['dateA']);
    update_user_meta($id, 'display_user', $cocher);
  }
}
?>

<h2>Entrez l'adresse mail de l'utilisateur à modifier :</h2>

<?php
if ($userexist == false) {
?>
  <div id="echec">
    <p style="color:white"> &nbsp; Email non reconnu ou incorrect</p><br>';
  </div>
<?php
} elseif ($record == true) {
?>
  <div id="confirmation">
    <p style="color:white"> &nbsp; Modification effectuée.</p><br>
  </div>
<?php
}
?>

<form id="inscription4" name="inscription" method="post" action="<?php echo site_url(); ?>/formulaire-modifier-utilisateur/">
  Adresse de messagerie(nécéssaire) : <input type="email" name="mail" /><br /><br />
  <label for="statut">Statut : </label><select id="statut" name="statut" />
  <option value=""> </option>
  <option value="Administratif"> Administratif</option>
  <option value="Assistant ingénieur"> Assistant ingénieur</option>
  <option value="Attaché temporaire d\'enseignement et de recherche"> Attaché temporaire d\'enseignement et de recherche</option>
  <option value="Chargé de recherche"> Chargé de recherche</option>
  <option value="Chercheur invité"> Chercheur invité</option>
  <option value="Directeur de recherche"> Directeur de recherche</option>
  <option selected="selected" value="Doctorant"> Doctorant</option>
  <option value="Enseignant-chercheur"> Enseignant-chercheur</option>
  <option value="Enseignant-chercheur associé"> Enseignant-chercheur associé</option>
  <option value="Ingénieur"> Ingénieur</option>
  <option value="Ingénieur - Chercheur"> Ingénieur - Chercheur</option>
  <option value="Ingénieur de recherche"> Ingénieur de recherche</option>
  <option value="Maître assistant"> Maître assistant</option>
  <option value="Maître assistant associé"> Maître assistant associé</option>
  <option value="Maître de conférences"> Maître de conférences</option>
  <option value="Maître de conférences associé"> Maître de conférences associé</option>
  <option value="Post-doctorant"> Post-doctorant</option>
  <option value="Professeur"> Professeur</option>
  <option value="Professeur agrégé"> Professeur agrégé</option>
  <option value="Professeur associé"> Professeur associé</option>
  <option value="Professeur émérite"> Professeur émérite</option>
  <option value="Professeur invité"> Professeur invité</option>
  <option value="Stagiaire"> Stagiaire</option>
  <option value="Technicien"> Technicien</option>
  </select><br /><br />
  <label for="axe_1">Axe primaire : </label><select id="axe_1" name="axe_1">
    <option selected="selected" value=""> </option>
    <option value="(MSC) Structures Impact Modélisation Usinage">(MSC) Structures Impact Modélisation Usinage</option>
    <option value="(MSC) Matériaux Propriétés et Procédés "> (MSC) Matériaux Propriétés et Procédés </option>
    <option value="(SUMO) Fatigue Modélisation Endommagement et Usure"> (SUMO) Fatigue Modélisation Endommagement et Usure</option>
    <option value="(SUMO) Propriétés d usage et microstructures des matériaux avancés"> (SUMO) Propriétés d usage et microstructures des matériaux avancés</option>
    <option value="(SUMO) Usinage et mise en forme"> (SUMO) Usinage et mise en forme</option>
    <option value="(MS2M) Ingénierie des systèmes et des microsystèmes"> (MS2M) Ingénierie des systèmes et des microsystèmes</option>
    <option value="(MS2M) Intégrité des structures et des systèmes"> (MS2M) Intégrité des structures et des systèmes</option>
    <option value="(MICS) Méthodes optiques innovantes pour la métrologie dimensionnelle et thermique"> (MICS) Méthodes optiques innovantes pour la métrologie dimensionnelle et thermique</option>
    <option value="(MICS) Identification et contrôle de propriétés thermiques et mécaniques"> (MICS) Identification et contrôle de propriétés thermiques et mécaniques</option>
    <option value="(AXTR) Assemblages"> (AXTR) Assemblages</option>
    <option value="(AXTR) Usinage multi-matériaux"> (AXTR) Usinage multi-matériaux</option>
    <option value="(ESTA) ESTA"> (ESTA) ESTA</option>
  </select><br /><br />
  <label for="axe_2"> Axe secondaire : </label><select id="axe_2" name="axe_2">
    <option selected="selected" value=""> </option>
    <option value="(MSC) Structures Impact Modélisation Usinage">(MSC) Structures Impact Modélisation Usinage</option>
    <option value="(MSC) Matériaux Propriétés et Procédés "> (MSC) Matériaux Propriétés et Procédés </option>
    <option value="(SUMO) Fatigue Modélisation Endommagement et Usure"> (SUMO) Fatigue Modélisation Endommagement et Usure</option>
    <option value="(SUMO) Propriétés d usage et microstructures des matériaux avancés"> (SUMO) Propriétés d usage et microstructures des matériaux avancés</option>
    <option value="(SUMO) Usinage et mise en forme"> (SUMO) Usinage et mise en forme</option>
    <option value="(MS2M) Ingénierie des systèmes et des microsystèmes"> (MS2M) Ingénierie des systèmes et des microsystèmes</option>
    <option value="(MS2M) Intégrité des structures et des systèmes"> (MS2M) Intégrité des structures et des systèmes</option>
    <option value="(MICS) Méthodes optiques innovantes pour la métrologie dimensionnelle et thermique"> (MICS) Méthodes optiques innovantes pour la métrologie dimensionnelle et thermique</option>
    <option value="(MICS) Identification et contrôle de propriétés thermiques et mécaniques"> (MICS) Identification et contrôle de propriétés thermiques et mécaniques</option>
    <option value="(AXTR) Assemblages"> (AXTR) Assemblages</option>
    <option value="(AXTR) Usinage multi-matériaux"> (AXTR) Usinage multi-matériaux</option>
    <option value="(ESTA) ESTA"> (ESTA) ESTA</option>
  </select><br /><br />
  <label for="axe_3">Axe terciaire :</label> <select id="axe_3" name="axe_3">
    <option selected="selected" value=""> </option>
    <option value="(MSC) Structures Impact Modélisation Usinage">(MSC) Structures Impact Modélisation Usinage</option>
    <option value="(MSC) Matériaux Propriétés et Procédés "> (MSC) Matériaux Propriétés et Procédés </option>
    <option value="(SUMO) Fatigue Modélisation Endommagement et Usure"> (SUMO) Fatigue Modélisation Endommagement et Usure</option>
    <option value="(SUMO) Propriétés d usage et microstructures des matériaux avancés"> (SUMO) Propriétés d usage et microstructures des matériaux avancés</option>
    <option value="(SUMO) Usinage et mise en forme"> (SUMO) Usinage et mise en forme</option>
    <option value="(MS2M) Ingénierie des systèmes et des microsystèmes"> (MS2M) Ingénierie des systèmes et des microsystèmes</option>
    <option value="(MS2M) Intégrité des structures et des systèmes"> (MS2M) Intégrité des structures et des systèmes</option>
    <option value="(MICS) Méthodes optiques innovantes pour la métrologie dimensionnelle et thermique"> (MICS) Méthodes optiques innovantes pour la métrologie dimensionnelle et thermique</option>
    <option value="(MICS) Identification et contrôle de propriétés thermiques et mécaniques"> (MICS) Identification et contrôle de propriétés thermiques et mécaniques</option>
    <option value="(AXTR) Assemblages"> (AXTR) Assemblages</option>
    <option value="(AXTR) Usinage multi-matériaux"> (AXTR) Usinage multi-matériaux</option>
    <option value="(ESTA) ESTA"> (ESTA) ESTA</option>
  </select><br /><br />
  <label for="etablissement">Etablissement de rattachement : </label><select id="etablissement" name="etablissement">
    <option selected="selected" value=""> </option>
    <option value="CNRS"> CNRS</option>
    <option value="CUFR J.F. Champollion"> CUFR J.F. Champollion</option>
    <option value="IMT Mines Albi"> IMT Mines Albi</option>
    <option value="ICAM">ICAM </option>
    <option value="INSA">INSA </option>
    <option value="ISAE-SUPAERO">ISAE-SUPAERO </option>
    <option value="IUT de Figeac">IUT de Figeac </option>
    <option value="IUT GMP"> IUT GMP</option>
    <option value="IUT de Tarbes"> IUT de Tarbes</option>
    <option value="UPS"> UPS</option>
    <option value="UT-2 Jean Jaurès">UT-2 Jean Jaurès </option>
  </select><br /><br />
  <label for="actv_rech"> Localisation des activités de recherche : </label><select id="actv_rech" name="actv_rech" />
  <option value=""> </option>
  <option selected="selected" value="ECA Montaudran"> ECA Montaudran</option>
  <option value="Mines Albi"> Mines Albi</option>
  <option value="IUT de Tarbes"> IUT de Tarbes</option>
  <option value="Autre">Autre </option>
  </select><br /><br />
  <label for="dateA">Date d'arrivée : </label><input type="date" value="" <?php echo date('Y-m-d'); ?>name=<?= 'dateA' ?> /> <br /><br />
  <input type="submit" name="valider" value="Valider" />
</form>