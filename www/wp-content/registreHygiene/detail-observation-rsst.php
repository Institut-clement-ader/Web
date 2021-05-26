<?php
  // Restreint l'accès aux utilisateurs connectés
  if (!is_user_logged_in()) {
    echo("loggin to access this page");
	  exit();
  }

  if(isset($_GET['id'])){
    
  

    //CONNEXION A LA BDD
//     $serveur="localhost";
//     $utilisateur="lab0611sql3";
//     $password="1pm6STt9TE0n";
//     $db="lab0611sql3db";


    $current_user = wp_get_current_user();
    $email = $current_user->user_email;

    require("codes snippet/GestionBdd.php");
    $bdd = new GestionBdd();
    $id = $_GET['id'];
    $req = $bdd->getObservationById($id); 

    if(isset($req)){
      while($row = $req->fetch()){
         $username = ($row['nom'])." ".($row['prenom']);
         $dateSaisie = ($row['date_saisie']);
         $dateConsultationChefStructure = ($row['date_consultation_chef_structure']);
?>
          <?php echo '<h6>';?><?php echo 'Observation saisie le '.date('d/m/y', strtotime($dateSaisie)).' par '.$username.' : ';?><?php echo '</h6>';?>

          <table>
              <col width="30%">
              <col width="70%">
              
          <tbody>
              <tr>
                <th>Statut au sein de l'entreprise</th>
                  <?php echo '<td>';?><?php echo ($row['position']); ?><?php echo '</td>';?>
              </tr>
              <tr>
                  <th>Heure de saisie</th>
                  <?php echo '<td>';?><?php echo ($row['heure_saisie']); ?><?php echo '</td>';?>
              </tr>
           </table>

           <table>
              <col width="30%">
              <col width="70%">
              <tr>
                  <th>Type d'observation</th>
                  <?php echo '<td>';?><?php echo ($row['sujet']); ?><?php echo '</td>';?>
              </tr>
              <tr>
                  <th>Observations relatives à la prévention des risques professionels et à l'amélioration des conditions de travail</th>
                  <?php echo '<td>';?><?php echo ($row['observations']); ?><?php echo '</td>';?>
              </tr>
              <tr>
                  <th>Propositions pour améliorer la situation</th>
                  <?php echo '<td>';?><?php echo ($row['propositions']); ?><?php echo '</td>';?>
              </tr>
           </table>
              
<h6>Examen du responsable de la structure :</h6>
            <table>
              <col width="30%">
              <col width="70%">
              <tr>
                  <th>Date de validation</th>
                  <?php if($row['visa']==1){echo '<td>';?><?php echo date('d/m/y', strtotime($dateConsultationChefStructure)); ?><?php echo '</td>';}?>
                  <?php if($row['visa']==0){echo '<td>';?><?php echo "Le responsable de la structure n'a pas encore consulté cette observation"; ?><?php echo '</td>';}?>            
              </tr>
              <tr>
                  <th>Nom et prénom</th>
                  <?php echo '<td>';?><?php echo ($row['nom_chef_structure']); ?><?php echo '</td>';?>
              </tr>
              <tr>
                  <th>Observation</th>
                  <?php echo '<td>';?><?php echo ($row['observations_du_responsable']); ?><?php echo '</td>';?>
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