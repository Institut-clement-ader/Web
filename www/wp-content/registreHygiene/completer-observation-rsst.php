<?php
  // Restreint l'accès aux utilisateurs connectés
  if (!is_user_logged_in()) {
    echo("loggin to access this page");
	  exit();
  }
    //CONNEXION A LA BDD
// 	$serveur="localhost";
// 	$utilisateur="lab0611sql3";
// 	$password="1pm6STt9TE0n";
// 	$db="lab0611sql3db";

  require("codes snippet/GestionBdd.php");
  $bdd = new GestionBdd();
// ON RECUPERE L ID DE L OBSERVATION A AFFICHER
  $id = $_GET['id'];
  $req = $bdd->getObservationById($id);
    // AFFICHAGE DE L OBSERVATION
  if(isset($req)){
    while($row = $req->fetch()){
      $username = ($row['nom'])." ".($row['prenom']);
      $dateSaisie = ($row['date_saisie']);
        
?>
        
<?php echo '<h6>';?><?php echo 'Observation saisie le '.date('d/m/y', strtotime($dateSaisie)).' par '.$username.' : ';?><?php echo '</h6>';?>
         <tbody>
          <table>
              <col width="30%">
              <col width="70%">
              
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
          </tbody> 

<?php echo '<hr><br/><br/><br/><h6>';?><?php echo 'Compléter et valider :';?><?php echo '</h6>';?>

<?php echo'<form id="observation_du_ap" name="observation_du_ap" method="post" action="http://institut-clement-ader.org/traitement-de-lobservation-du-responsable-de-la-structure/">
    <label for="date_consultation_chef_structure">Date de consultation : </label><input type="date" value="';?><?php echo date('Y-m-d'); ?><?php echo '" name="date_consultation_chef_structure"/> <br/><br/>
    
    <b>Nom et prénom (responsable de la structure)</b> : <input type="text" name="nom_prenom" required/><br/><br/>
    
    <label for="observations_du_responsable">Observations (facultatif) : </label><textarea id=observation name="observation" rows="5"></textarea>
    
    <b>Vous certifiez avoir pris connaissance de cette observation (obligatoire)</b> : <input type="checkbox" name="visa" value="1" required/><br/><br/>
        
        <input type="hidden" name="id" id="id" value="';?><?php echo $id; ?><?php echo '" />
        <input class="button" type="submit" name="valider" value="valider"/>
   </form>'; 
?>


<?php


    }
  }
        


?>
