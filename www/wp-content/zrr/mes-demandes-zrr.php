<?php
  // Restreint l'accès aux utilisateurs connectés
  if (!is_user_logged_in()) {
    echo("loggin to access this page");
	  exit();
  }

  //CONNEXION A LA BDD
//   $serveur="mysql2.lamp.ods";
// 	$utilisateur="lab0612sql3";
// 	$password="XY02b21aBLaq";
// 	$db="lab0612sql3db";


  
  $current_user = wp_get_current_user();
  $email = $current_user->user_email;

  require("codes snippet/GestionBdd.php");
  $bdd = new GestionBdd();
  $req = $bdd->getDemandesByEmail($email);
  
    
  ?> 
  <table>
    <thead>
				<tr>
					<th>Nom</th>
					<th>Prénom</th>
					<th>status</th>
					<th>Accepter</th>
          <th>Refuser</th>
				</tr>
    </thead>
				<?php
          
					if(isset($req)){
						while($row = $req->fetch()){
              $user = get_user_by( 'email', $row['mail'] );
              $user_id = $user->ID;
              $username = $user->first_name." ".$user->last_name;
							?>
              <tbody>
							<tr>
								<?php if($row['necessite_zrr']==1){echo '<td>';?><?php echo strtoupper($row['nom']); ?><?php echo '</td>';?>
								<?php echo '<td>';?><?php echo ucfirst($row['prenom']); ?><?php echo '</td>';?>
                <?php echo '<td>';?>acceptée<?php echo '</td>';?>
								<?php echo '<td id="accepterDemande"><form action="http://institut-clement-ader.org/mes-demandes-zrr/" method="POST"><button style="background-color:green" type="hidden" name="accepter" value="';?><?php echo $row['id']; ?>">inscrire<?php echo '</button></form></td>';?>
                <?php echo '<td id="refuserDemande"><form action="http://institut-clement-ader.org/mes-demandes-zrr/" method="POST"><button style="background-color:red" type="hidden" name="refuser" value="';?><?php echo $row['id']; ?>">refuser<?php echo '</button></form></td>';}?>
                <?php if($row['necessite_zrr']==0){echo '<td>';?><?php echo strtoupper($row['nom']); ?><?php echo '</td>';?>
								<?php echo '<td>';?><?php echo ucfirst($row['prenom']); ?><?php echo '</td>';?>
                <?php echo '<td>';?>en attente<?php echo '</td>';?>
								<?php echo '<td id="accepterDemande"><form action="http://institut-clement-ader.org/mes-demandes-zrr/" method="POST"><button disabled style="background-color:grey" type="hidden" name="accepter" value="';?><?php echo $row['id']; ?>">inscrire<?php echo '</button></form></td>';?>'
                <?php echo '<td id="refuserDemande"><form action="http://institut-clement-ader.org/mes-demandes-zrr/" method="POST"><button disabled style="background-color:grey" type="hidden" name="refuser" value="';?><?php echo $row['id']; ?>">refuser<?php echo '</button></form></td>';}?>
							</tr>
              </tbody>
					<?php
				}
			}
    
      if(isset($_POST['accepter'])){
        $bdd->accepterDemande($_POST['accepter']); 
        $url = $bdd->getUrl($_POST['accepter']);
        unlink($url);
        header('Location: http://institut-clement-ader.org/formulaire-Inscription/');
        
      }
      if(isset($_POST['refuser'])){
        $url = $bdd->getUrl($_POST['refuser']);
        $bdd->refuserDemande($_POST['refuser']); 
        unlink($url);
        header('Location: http://institut-clement-ader.org/mes-demandes-zrr/');
        
      }
    
    
    
			?>
		</table>