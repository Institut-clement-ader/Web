<?php

/**
 * Todo :
 * Enlever les adresses mail statiques
 * utiliser les pods pour les axes/ status/ etablissements/ actv_rech
 * 
 */


// Restreint l'accès aux utilisateurs connectés
if (!is_user_logged_in()) {
  echo ("loggin to access this page");
  exit();
}

require("App/GestionBdd.php");
$db =  new GestionBdd();

//Pour récupérer le groupe dans le nom de l'axe
function parenthese($str)
{
  return substr($str, ($p = strpos($str, '(') + 1), strrpos($str, ')') - $p);
}
$current_user = wp_get_current_user();
$record = false;
$userexist = false;
$zrr = false;

if (isset($_POST['valider'])) {
  $userexist = true;
  //résupère l'utilisateur a modifier avec son mail
  $user = get_user_by('email', $_POST['mail']);

  //si l'utilisateur n'existe pas
  if ($user == false) {
    $userexist = false;
    // $zrr = true;
    //vérification de la zone d'activité pour la ZRR
    //if(($db->getNecessiteZrrByEmail($_POST['mail'])==1 and strcmp($_POST['actv_rech'],"ECA Montaudran") == 0) or strcmp($_POST['actv_rech'],"ECA Montaudran") != 0 ){
    $record = true;
    //on envoie un mail de confirmation
    $message = "Bonjour,\n\nNous venons de vous créer un compte sur le site web de l'ICA :" . site_url() . " \nVous avez donc maintenant votre page personnelle que nous vous invitons à vérifier et à compléter.\nVoici vos informations de connection pour éditer votre profil sur le site web de l'ICA.\n\nlogin: " . $_POST['identifiant'] . "\n\nPour initialiser votre mot de passe, veuillez cliquer sur le lien ci-dessous :\n\n" . site_url() . "/lostpassword\n\nN'hésitez pas à nous contacter si vous avez des difficultés.\n\nPaul Oumaziz :  paul.oumaziz@insa-toulouse.fr\nPablo Navarro : pablo.navarro@univ-tlse3.fr.";
    $subject = "ICA - Confirmation de la création de votre compte";
    $paswd = wp_generate_password(12, false);
    $error = wp_create_user($_POST['identifiant'], $paswd, $_POST['mail']);
    wp_mail($_POST['mail'], $subject, $message);
    wp_mail('paul.oumaziz@insa-toulouse.fr', '[Inscription ICA] ' . $_POST['nom'] . ' ' . $_POST['prenom'], 'Inscrit par ' . $current_user->first_name . ' ' . $current_user->last_name);
    $user = get_user_by('email', $_POST['mail']);
    $id = $user->ID;
    $cocher = 1;
    update_user_meta($id, 'first_name', $_POST['prenom']);
    update_user_meta($id, 'last_name', $_POST['nom']);
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
    $id = $db->getIdByEmailArrivant($_POST['mail']);
    $db->refuserDemande($id);
  }
  //} 
}
?>

<h2>Inscription d'un nouvel utilisateur :</h2>
<p>L'inscription d'un ou une membre du laboratoire sur le site de Toulouse doit au préalable passer par la procédure ZRR et ainsi suivre les étapes suivantes:</p>
<ol>
  <li> Faire le dépôt de la demande ZRR : <a href='<?php site_url(); ?>/documents/zrr-site-de-toulouse/depot-dossier-zrr/'><?php echo site_url(); ?>/documents/zrr-site-de-toulouse/depot-dossier-zrr/</a> </li>
  <li> Attendre le retour du responsable ZRR : <a href='<?php site_url(); ?>/mes-demandes-zrr/'><?php echo site_url(); ?>/mes-demandes-zrr/</a></li>
  <li> Valider de votre côté l'arrivée du nouveau ou nouvelle membre <a href='<?php site_url(); ?>/mes-demandes-zrr/'><?php echo site_url(); ?>/mes-demandes-zrr/</a></li>
  <li> Inscrire le nouveau ou la nouvelle membre sur le site de l'ICA <a href='<?php site_url(); ?>/formulaire-inscription/'> <?php echo site_url(); ?>/formulaire-inscription/</a></li>
</ol>
<p>Se référer à la page <a href='<?php site_url(); ?>/demarche-inscription/'> <?php echo site_url(); ?>/demarche-inscription/</a> pour plus de détail.</p>

<p>Dans le cas de l'inscription d'un nouveau doctorant ou doctorante, n'oubliez pas de compléter les informations relatives à la thèse via le second formulaire.</p>
<?php
if ($userexist == true) {
?>
  <div id="echec">
    <p style="color:white"> &nbsp; Email déjà existante</p><br>
  </div>
<?php
} elseif ($record == true) {
?>
  <div id="confirmation">
    <p style="color:white"> &nbsp; Enregistrement effectué.</p><br>';
  </div>
<?php
}
?>

<form id="inscription4" name="inscription" method="post" action="<?php site_url(); ?>/formulaire-inscription/">
  <b>Identifiant(nécéssaire)</b> : première lettre du prénom suivi du nom (ex: mdupond pour Marie Dupond), si vous pensez que le login pourrait déjà être pris, prenez les 2 premières lettres du prénom au lieu de seulement la première : <input type="text" name="identifiant" required />
  <b>Adresse de messagerie(nécéssaire)</b> (doit être la même que celle de la demande ZRR pour le site de Toulouse): <input type="email" name="mail" required />
  <b>Prénom(nécéssaire)</b> : <input type="text" name="prenom" required />
  <b>Nom(nécéssaire)</b> : <input type="text" name="nom" required /><br /><br />
  <label for="actv_rech"> Localisation des activités de recherche : </label><select id="actv_rech" name="actv_rech" />
  <option value=""> </option>
  <option selected="selected" value="ECA Montaudran"> ECA Montaudran</option>
  <option value="Mines Albi"> Mines Albi</option>
  <option value="IUT de Tarbes"> IUT de Tarbes</option>
  <option value="Autre">Autre </option>
  </select><br /><br />
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
  <label for="dateA">Date d'arrivée : </label><input type="date" value="<?= date('Y-m-d'); ?>" name="dateA" /> <br /><br />
  <input type="submit" name="valider" value="Valider" />
</form>
<hr>
<p>Dans le cas d'une inscription d'un nouveau ou nouvelle doctorante, veuillez compléter le formulaire suivant pour détailler la thèse.</p>