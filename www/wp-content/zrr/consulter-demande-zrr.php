<?php
  // Restreint l'accès aux administrateurs
  if (!is_user_logged_in()) {
    echo("loggin to access this page");
	  exit();
  }
  $user = wp_get_current_user();
  $email = $user->user_email;
// Si Nicolas ou Admin
  if(strcmp($email, 'nicolas.laurien@insa-toulouse.fr') !=0 and !current_user_can('administrator')){
    echo("you are not allowed to be here!");
	  exit();
  }
  
  //LIAISON A LA BDD
	$serveur="mysql2.lamp.ods";
	$utilisateur="lab0612sql3";
	$password="XY02b21aBLaq";
	$db="lab0612sql3db";
	
	try {
		$db = new PDO('mysql:host='.$serveur.';dbname='.$db, $utilisateur, $password);
	} catch(PDOException $e) {
		print "Erreur : ".$e->getMessage();
		die();
	}

  require("codes snippet/GestionBdd.php");
  $bdd = new GestionBdd();
  $req = $bdd->getDemandes();

  
  
    
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
                <?php echo '<td>';?><?php echo $username;?><?php echo '</td>';?>
								<?php echo '<td>acceptée</td>';?>
                <?php echo '<td> </td>';?>
                <?php echo '<td>Demande déjà acceptée </td>';}?>
                 <?php if($row['necessite_zrr']==0 && $row['num_dossier']==0){echo '<td>';?><?php echo strtoupper($row['nom']); ?><?php echo '</td>';?>
								<?php echo '<td>';?><?php echo ucfirst($row['prenom']); ?><?php echo '</td>';?>
                <?php echo '<td>';?><?php echo $username;?><?php echo '</td>';?>
								<?php echo '<td id="accepterDemande"><form action="http://ica.cnrs.fr/demandes-zrr/" method="POST"><button style="background-color:green" type="hidden" name="accepter" value="';?><?php echo $row['id']; ?>">accepter<?php echo '</button></form></td>';?>'
                <?php echo '<td id="refuserDemande"><form action="http://ica.cnrs.fr/demandes-zrr/" method="POST"><button style="background-color:red" type="hidden" name="refuser" value="';?><?php echo $row['id']; ?>">refuser<?php echo '</button></form></td>';?>
                <?php echo '<td>
              <form id="updateNumDossier" method="POST">
                <input type="hidden" name="id_zrr" value="'.$row['id'].'">
                <input type="text" width="3px" name="num_dossier" id="num_dossier">
                <input type="submit" value="Mettre à jour">
              </form>
              	 </td>';?>
                <?php } else if($row['necessite_zrr']==0 && $row['num_dossier']!=0){echo '<td>';?><?php echo strtoupper($row['nom']); ?><?php echo '</td>';?>
								<?php echo '<td>';?><?php echo ucfirst($row['prenom']); ?><?php echo '</td>';?>
                <?php echo '<td>';?><?php echo $username;?><?php echo '</td>';?>
								<?php echo '<td id="accepterDemande"><form action="http://ica.cnrs.fr/demandes-zrr/" method="POST"><button style="background-color:green" type="hidden" name="accepter" value="';?><?php echo $row['id']; ?>">accepter<?php echo '</button></form></td>';?>'
                <?php echo '<td id="refuserDemande"><form action="http://ica.cnrs.fr/demandes-zrr/" method="POST"><button style="background-color:red" type="hidden" name="refuser" value="';?><?php echo $row['id']; ?>">refuser<?php echo '</button></form></td>';?>
                <?php echo '<td>';?><?php echo 'Dossier n° '.$row['num_dossier'].'.';?><?php echo '</td>';}?>
               </tr>
              </tbody>
					<?php
				}
			}
    
      //METTRE A JOUR LE NUMERO DE DOSSIER
      if(isset($_POST['id_zrr'])){
        $idZrr = $_POST['id_zrr'];
        $numDossier = $_POST['num_dossier'];
        // s'il y a un id, on mets à jour le numero de dossier
        $requeteNumeroDossier="UPDATE wp_temp_zrr SET num_dossier = :numDossier WHERE ID = :idZrr;";
        $reqU = $db->prepare($requeteNumeroDossier);
        $reqU->execute(array('numDossier'=>$numDossier,'idZrr'=>$idZrr));
        $requete = $bdd->getDemandesByid($idZrr);
        $zrr = $requete->fetch();
        wp_mail($zrr['mail'], 'Numéro de dossier', 'Bonjour,
        
        Votre demande d\'accès ZRR porte le numéro '.$numDossier.'. La réponse arrivera dans un délais de deux mois.
        
        Cordialement.','Bonjour,');
        
        header('Location: http://ica.cnrs.fr/demandes-zrr/');
      }
      
    
      if(isset($_POST['accepter'])){
        $bdd->accepterDemande($_POST['accepter']);
        $req = $bdd->getDemandesByid($_POST['accepter']);
        $row = $req->fetch();
        $user = get_user_by( 'email', $row['mail'] );
        $username = $user->first_name." ".$user->last_name;
        echo $row['mail'].$username;
        wp_mail($row['mail'], 'Demande ZRR acceptée', 'Votre demande ZRR pour '.$row['prenom'].' '.$row['nom'].' a été acceptée','Bonjour,');
        wp_mail('Marie-Odile.Monsu@isae-supaero.fr', 'Demande ZRR acceptée','Bonjour,
        
        La demande ZRR faite par '. $username. ' pour '.$row['prenom'].' '.$row['nom'].' ('.$row['statut_arrivant'].') a été acceptée.
        Le début de mission est prévu pour le '.$row['date_arrivee'].' et la fin est estimée au '.$row['date_fin'].'.
        Son tuteur est '.$row['nom_prenom_tuteur'].'.','Bonjour,');
        
        header('Location: http://ica.cnrs.fr/demandes-zrr/');
      }
      if(isset($_POST['refuser'])){
        $url = $bdd->getUrl($_POST['refuser']);
        $req = $bdd->getDemandesByid($_POST['refuser']);
        $row = $req->fetch();
        $user = get_user_by( 'email', $row['mail'] );
        $username = $user->first_name." ".$user->last_name;
        echo $row['mail'].$username;
        wp_mail($row['mail'], 'Demande ZRR refusée', 'Votre demande ZRR pour '.$row['prenom'].' '.$row['nom'].' a été refusée','Bonjour,');
        $bdd->refuserDemande($_POST['refuser']); 
        unlink($url);
        header('Location: http://ica.cnrs.fr/demandes-zrr/');
        
      }
    
    
    
			?>
		</table>