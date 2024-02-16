<?php

/** Todo
 * Enelver les mails statiques
 */
// Restreint l'accès aux administrateurs
if (!is_user_logged_in()) {
  echo ("loggin to access this page");
  exit();
}
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//   echo 'ok';
// } else {
//   echo 'non';
// }
$user = wp_get_current_user();
$email = $user->user_email;
// Si Nicolas ou Admin
if (strcmp($email, 'nicolas.laurien@insa-toulouse.fr') != 0 and !current_user_can('administrator')) {
  echo ("you are not allowed to be here!");
  exit();
}

require("App/GestionBdd.php");
$bdd = new GestionBdd();
$req = $bdd->getDemandesZrr();

?>

<table>
  <thead>
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Demandeur</th>
      <th>Accepter</th>
      <th>Refuser</th>
      <th>Numéro de dossier</th>
    </tr>
  </thead>


  <?php

  if (isset($req)) {
    while ($row = $req->fetch()) {

      $user = get_user_by('email', $row['mail']);
      $user_id = $user->ID;
      $username = $user->first_name . " " . $user->last_name;
  ?>
      <tbody>
        <tr>
          <?php if ($row['necessite_zrr'] == 1) { ?> <td><?php echo strtoupper($row['nom']); ?></td>
            <td><?php echo ucfirst($row['prenom']); ?></td>
            <td><?php echo $username; ?></td>
            <td>acceptée</td>
            <td> </td>
            <td>Demande déjà acceptée </td><?php } ?>
          <?php if ($row['necessite_zrr'] == 0 && $row['num_dossier'] == 0) { ?><td><?php echo strtoupper($row['nom']); ?></td>
            <td><?php echo ucfirst($row['prenom']); ?></td>
            <td><?php echo $username; ?></td>
            <td id="accepterDemande">
              <form action="<?= site_url(); ?>/demandes-zrr/" method="POST"><button style="background-color:green" type="hidden" name="accepter" value="<?php echo $row['id']; ?>">accepter</button></form>
            </td>
            <td id="refuserDemande">
              <form action="<?= site_url(); ?>/demandes-zrr/" method="POST"><button style="background-color:red" type="hidden" name="refuser" value="<?php echo $row['id']; ?>">refuser</button></form>
            </td>
            <td>
              <form id="updateNumDossier" method="POST" action="">
                <input type="hidden" name="id_zrr" value=" <?= $row['id'] ?>">
                <input type="hidden" name="last_name" value="<?= $row['prenom'] ?>">
                <input type="hidden" name="first_name" value="<?= $row['nom'] ?>">
                <input type="text" width="3px" name="num_dossier" id="num_dossier" value="<?= isset($_POST['num_dossier']) ? $_POST['num_dossier'] : 'non'; ?>">
                <button type="submit" name="submit" value="Mettre à jour">Mettre à jour </button>
              </form>
            </td>
          <?php } else if ($row['necessite_zrr'] == 0 && $row['num_dossier'] != 0) { ?><td><?php echo strtoupper($row['nom']); ?></td>
            <td><?php echo ucfirst($row['prenom']); ?></td>
            <td><?php echo $username; ?></td>
            <td id="accepterDemande">
              <form action="<?= site_url(); ?>/demandes-zrr/" method="POST"><button style="background-color:green" type="hidden" name="accepter" value="<?php echo $row['id']; ?>">accepter</button></form>
            </td>
            <td id="refuserDemande">
              <form action="<?= site_url(); ?>/demandes-zrr/" method="POST"><button style="background-color:red" type="hidden" name="refuser" value="<?php echo $row['id']; ?>">refuser</button></form>
            </td>
            <td><?php echo 'Dossier n° ' . $row['num_dossier'] . '.'; ?></td><?php } ?>
        </tr>
      </tbody>
  <?php
    }
  }

  //METTRE A JOUR LE NUMERO DE DOSSIER
  if (isset($_POST['id_zrr'])) {
    $idZrr = $_POST['id_zrr'];
    $numDossier = $_POST['num_dossier'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];

    // s'il y a un id, on mets à jour le numero de dossier
    $req = $bdd->updateIdZRR($numDossier, $idZrr);
    $requete = $bdd->getDemandesByid($idZrr);
    $zrr = $requete->fetch();
    wp_mail($zrr['mail'], 'ZRR : Numéro de dossier', 'Bonjour,
        
        Votre demande d\'accès ZRR pour ' . ucfirst($last_name) . ' ' . ucfirst($first_name) . ' porte le numéro ' . $numDossier . ' . La réponse arrivera dans un délais de deux mois.
        
        Cordialement.', 'Bonjour,');

    header('Location: ' . site_url() . '/demandes-zrr/');
  }


  if (isset($_POST['accepter'])) {
    $bdd->accepterDemande($_POST['accepter']);
    $req = $bdd->getDemandesByid($_POST['accepter']);
    $row = $req->fetch();
    $user = get_user_by('email', $row['mail']);
    $username = $user->first_name . " " . $user->last_name;
    echo $row['mail'] . $username;
    $multiple_recipients = array(
      'Marie-Odile.Monsu@isae-supaero.fr',
      'monnerie@insa-toulouse.fr',
      'myriam.boyer@univ-tlse3.fr',
      'jean-francois.ferrero@univ-tlse3.fr',
      'tmangear@insa-toulouse.fr'

    );
    wp_mail($row['mail'], 'Demande ZRR acceptée', 'Votre demande ZRR pour ' . $row['prenom'] . ' ' . $row['nom'] . ' a été acceptée', 'Bonjour,');
    wp_mail($multiple_recipients, 'Demande ZRR acceptée', 'Bonjour,
        
        La demande ZRR faite par ' . $username . ' pour ' . $row['prenom'] . ' ' . $row['nom'] . ' (' . $row['statut_arrivant'] . ') a été acceptée.
        Le début de mission est prévu pour le ' . $row['date_arrivee'] . ' et la fin est estimée au ' . $row['date_fin'] . '.
        Son tuteur est ' . $row['nom_prenom_tuteur'] . '.', 'Bonjour,');

    header('Location: ' . site_url() . '/demandes-zrr/');
  }
  if (isset($_POST['refuser'])) {
    $url = $bdd->getUrl($_POST['refuser']);
    $req = $bdd->getDemandesByid($_POST['refuser']);
    $row = $req->fetch();
    $user = get_user_by('email', $row['mail']);
    $username = $user->first_name . " " . $user->last_name;
    echo $row['mail'] . $username;
    wp_mail($row['mail'], 'Demande ZRR refusée', 'Votre demande ZRR pour ' . $row['prenom'] . ' ' . $row['nom'] . ' a été refusée', 'Bonjour,');
    $bdd->refuserDemande($_POST['refuser']);
    unlink($url);
    header('Location: ' . site_url() . '/demandes-zrr/');
  }



  ?>
</table>