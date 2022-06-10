<?php

    /**
    * Améliorations à apporter :
    * Supprimer le code en commentaire
    * Enlever les echo innutiles
    * Ajouter des commentaires sur tout le code
    */


  // Restreint l'accès aux utilisateurs connectés
  if (!is_user_logged_in()) {
    echo("loggin to access this page");
	  exit();
  }


  
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
          <th>Numéro de dossier</th>
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
								<?php if($row['necessite_zrr']==1){echo '<td>';?><?php echo strtoupper($row['nom']); ?></td>
								<td><?php echo ucfirst($row['prenom']); ?></td>
                <td>acceptée</td>
                <td><?php echo $row['num_dossier']; ?></td>
								<td id="accepterDemande"><form action="http://ica.cnrs.fr/mes-demandes-zrr/" method="POST"><button style="background-color:green" type="hidden" name="accepter" value="';?><?php echo $row['id']; ?>">inscrire</button></form></td>
                <td id="refuserDemande"><form action="http://ica.cnrs.fr/mes-demandes-zrr/" method="POST"><button style="background-color:red" type="hidden" name="refuser" value="';?><?php echo $row['id']; ?>">refuser</button></form></td> <?php } ?>
                <?php if($row['necessite_zrr']==0){?><td><?php echo strtoupper($row['nom']); ?></td>
                <td><?php echo ucfirst($row['prenom']); ?></td>
                <td>en attente</td>
                <td><?php echo $row['num_dossier']; ?></td>
                <td id="accepterDemande"><form action="http://ica.cnrs.fr/mes-demandes-zrr/" method="POST"><button disabled style="background-color:grey" type="hidden" name="accepter" value="';?><?php echo $row['id']; ?>">inscrire</button></form></td>
                <td id="refuserDemande"><form action="http://ica.cnrs.fr/mes-demandes-zrr/" method="POST"><button disabled style="background-color:grey" type="hidden" name="refuser" value="';?><?php echo $row['id']; ?>">refuser</button></form></td> <?php } ?>
							</tr>
              </tbody>
					<?php
				}
			}
    
      if(isset($_POST['accepter'])){
        $bdd->accepterDemande($_POST['accepter']); 
        $url = $bdd->getUrl($_POST['accepter']);
        unlink($url);
        header('Location: http://ica.cnrs.fr/formulaire-inscription/');
        
      }
      if(isset($_POST['refuser'])){
        $url = $bdd->getUrl($_POST['refuser']);
        $bdd->refuserDemande($_POST['refuser']); 
        unlink($url);
        header('Location: http://ica.cnrs.fr/mes-demandes-zrr/');
        
      }
    
    
    
			?>
		</table>