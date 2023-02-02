<?php

/**
 * Améliorations à apporter :
 */


// Restreint l'accès aux utilisateurs connectés
if (!is_user_logged_in()) {
  echo ("loggin to access this page");
  exit();
}

if (isset($_GET['id'])) {

  $current_user = wp_get_current_user();
  $email = $current_user->user_email;
  // CONNEXION A LA BD
  require("App/GestionBdd.php");
  $bdd = new GestionBdd();
  $id = $_GET['id'];
  $req = $bdd->getObservationById($id);

  if (isset($req)) {
    while ($row = $req->fetch()) {
      $username = ($row['rs_nom']) . " " . ($row['rs_prenom']);
      $dateSaisie = ($row['rs_date_saisie']);
      $dateConsultationChefStructure = ($row['rs_date_consultation_chef_structure']);
?>
      <h6><?php echo 'Observation saisie le ' . date('d/m/y', strtotime($dateSaisie)) . ' par ' . $username . ' : '; ?></h6>

      <table>
        <col width="30%">
        <col width="70%">

        <tbody>
          <tr>
            <th>Statut au sein de l'entreprise</th>
            <td><?php echo ($row['rs_position']); ?></td>
          </tr>
          <tr>
            <th>Heure de saisie</th>
            <td><?php echo ($row['rs_heure_saisie']); ?></td>
          </tr>
      </table>

      <table>
        <col width="30%">
        <col width="70%">
        <tr>
          <th>Type d'observation</th>
          <td><?php echo ($row['sujet']); ?></td>
        </tr>
        <tr>
          <th>Observations relatives à la prévention des risques professionels et à l'amélioration des conditions de travail</th>
          <td><?php echo ($row['rs_observations']); ?></td>
        </tr>
        <tr>
          <th>Propositions pour améliorer la situation</th>
          <td><?php echo ($row['rs_propositions']); ?></td>
        </tr>
      </table>

      <h6>Examen du responsable de la structure :</h6>
      <table>
        <col width="30%">
        <col width="70%">
        <tr>
          <th>Date de validation</th>
          <?php if ($row['rs_visa'] == 1) { ?><td><?php echo date('d/m/y', strtotime($dateConsultationChefStructure)); ?> </td> <?php } ?>
          <?php if ($row['rs_visa'] == 0) { ?><td><?php echo "Le responsable de la structure n'a pas encore consulté cette observation"; ?> </td> <?php } ?>
        </tr>
        <tr>
          <th>Nom et prénom</th>
          <td><?php echo ($row['rs_nom_chef_structure']); ?></td>
        </tr>
        <tr>
          <th>Observation</th>
          <td><?php echo ($row['rs_observations_du_responsable']); ?></td>
        </tr>
        </tbody>
  <?php
    }
  }
} else {
  echo 'Erreur, vous devez sélectionner une observation pour accéder à cette page !';
}
  ?>


      </table>