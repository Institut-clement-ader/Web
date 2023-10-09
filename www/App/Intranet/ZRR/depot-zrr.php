<?php

/**
 * Améliorations à apporter :
 * Supprimer le code en commentaire
 * Ajouter des commentaires sur tout le code
 * 
 * optimiser les listes et utilisedr la bases de données
 */

require("App/GestionBdd.php");
$bdd = new GestionBdd();
// Restreint l'accès aux utilisateurs connectés
if (!is_user_logged_in()) {
  echo ("loggin to access this page");
  exit();
}

function debug_to_console($data)
{
  $output = $data;
  if (is_array($output))
    $output = implode(',', $output);

  echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

$id_ask = $_GET["id"];

$valider = false;
if (isset($_POST['valider'])) {
  //on importe GestionBdd.php


  $current_user = wp_get_current_user();
  $mailArrivant = $_POST['mail'];
  $tuteur = $_POST['nom_prenom_tuteur'];
  $date_arrivee = $_POST['date_arrivee'];
  $statut_arrivant = $_POST['statut_arrivant'];
  $etablissement_accueil = $_POST['etablissement_accueil'];
  $id_ask = $_POST['id_ask'];
  $name = $current_user->first_name . " " . $current_user->last_name;
  $mail = $current_user->user_email;
  $user_id = get_current_user_id();
  $date_fin = $_POST['date_fin'];
  $url = WP_CONTENT_DIR . "/uploads/zrr/" . strtolower($_POST['nom']) . strtolower($_POST['prenom']) . $user_id . ".zip";
  $new_ask = false;
  $echec_file = false;
  $valider = true;
  $result_move_file = false;


  if (filesize($_FILES['fichier']['tmp_name']) < 2097152) {
    if (!file_exists($url)) {
      $new_ask = true;
    }
    $result_move_file = move_uploaded_file($_FILES['fichier']['tmp_name'], $url);

    if ($result_move_file == true) {
      if ($new_ask == false) {
        $req = $bdd->resetDossier($id_ask);
        wp_mail('acces_zrr_ica@insa-toulouse.fr', 'Mise à jour de fichier ZRR', $name . ' a mis le fichier ZRR de ' . $_POST['prenom'] . ' ' . $_POST['nom'] . ' à jour', 'Bonjour,', array($url));
      } else {
        $req = $bdd->ajouterDemande(strtolower($_POST['nom']), strtolower($_POST['prenom']), $mailArrivant, $mail, $url, $date_fin, $tuteur, $date_arrivee, $statut_arrivant, $etablissement_accueil);
        wp_mail('acces_zrr_ica@insa-toulouse.fr', 'Nouvelle demande ZRR', $name . ' a fait une demande ZRR pour ' . $_POST['prenom'] . ' ' . $_POST['nom'] . ' : ' . site_url() . '/demandes-zrr/. La fin de mission est estimée à ' . $_POST['date_fin'], 'Bonjour,', array($url));
      }
    } else {
      $echec_file = true;
    }
  } else {
    $echec_file = true;
  }
}
?>

<?php

$lastNameAsk = "";
$firstNameAsk = "";
$mailAsk = "";

$Dossier = $bdd->DossierZrr($id_ask);
// if (isset($Dossier)) {
$lastNameAsk = $Dossier['nom'];
$firstNameAsk = $Dossier['prenom'];
$mailAsk = $Dossier['mail_arrivant'];
$nametuteur = $Dossier['nom_prenom_tuteur'];
// }
?>

<h2>Site de Toulouse - Dépôt du dossier ZRR :</h2>
<p>Pour plus de détails sur les documents nécessaires pour la demande ZRR, reportez vous à la page <a href='<?= site_url(); ?>/documents/zrr-site-de-toulouse/'><?= site_url(); ?>/documents/zrr-site-de-toulouse/</a></p>

<?php
if ($valider == true) {
  if ($echec_file == true) {
    if ($result_move_file == false) {
?>
      <div id="echec">
        <p style="color:white"> &nbsp; Échec de la soumission de votre dossier ou le document déposé dépasse les 2 Mo</p><br>
      </div>
    <?php
    } else {
    ?>
      <div id="echec">
        <p style="color:white"> &nbsp; Échec de la soumission de votre dossier. le document déposé dépasse les 2 Mo</p><br>
      </div>
    <?php
    }
  } else {
    ?>
    <div id="confirmation">
      <p style="color:white"> &nbsp; Dossier <? $id_ask; ?> soummis avec succès!</p><br>
    </div>
<?php
  }
}
?>

<form id="inscription4" name="zrr" method="post" action="<?= site_url(); ?>/documents/zrr-site-de-toulouse/depot-dossier-zrr/" enctype="multipart/form-data">
  <input type="hidden" name="id_ask" value=<?= $id_ask ?> />
  Prénom de l'arrivant<abbr class="required" title="required">*</abbr> : <input type="text" name="prenom" value="<?= $firstNameAsk ?>" required />
  Nom de l'arrivant<abbr class=" required" title="required">*</abbr> : <input type="text" name="nom" value="<?= $lastNameAsk ?>" required /><br /><br />
  <label for=" statut">Statut de l'arrivant : </label><select id="statut" name="statut_arrivant" required />
  <option value="Administratif"> Administratif</option>
  <option value="Assistant ingénieur"> Assistant ingénieur</option>
  <option value="Attaché temporaire d\'enseignement et de recherche"> Attaché temporaire d'enseignement et de recherche</option>
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
  <label for="etablissement">Etablissement d'accueil : </label><select id="statut" name="etablissement_accueil" required />
  <option value="INSA Toulouse"> INSA Toulouse</option>
  <option value="ISAE Supaero"> ISAE Supaero</option>
  <option value="Université Toulouse Paul Sabatier"> Université Toulouse Paul Sabatier</option>
  <option value="IMT Mines Albi"> IMT Mines ALbi</option>
  <option value="CNRS"> CNRS</option>
  </select><br /><br />
  Nom et prénom du tuteur<abbr class="required" title="required">*</abbr> : <input type="text" name="nom_prenom_tuteur" value="<?= $nametuteur ?>" required /><br />
  Adresse E-mail de l'arrivant<abbr class="required" title="required">*</abbr> : <input type="email" name="mail" value="<?= $mailAsk ?>" required /><br /><br />
  Date d'arrivée<abbr class="required" title="required">*</abbr> :<input type="date" name="date_arrivee" required /><br /><br />
  Date estimée de fin de mission<abbr class="required" title="required">*</abbr> :<input type="date" name="date_fin" required /><br />
  <br />
  Dépôt fichier de l'archive zip (moins de <em>2Mo</em>! ) contenant:<br><br>
  -Fichier excel<br>
  -CV<br>
  -Carte d'identité<br>
  -Sujet<br><br>
  <input type="file" name="fichier" accept=".zip" required /><br /><br />
  <input type="submit" name="valider" value="Valider" />
</form>