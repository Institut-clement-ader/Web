<?php

  /**
  * Améliorations à apporter :
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
  $req = $bdd->getDemandesProjetsByEmail($email);
  
  
    
  ?> 
  <table>
    <thead>
				<tr>
					<th>Nom du projet</th>
					<th>Thématique</th>
					<th>Date de dépot</th>
          <th>Projet accepté</th>
          <th>Supprimer</th>
				</tr>
    </thead>
				<?php
          
					if(isset($req)){
						while($row = $req->fetch()){
              
             
							?>
              <tbody>
							<tr>
								<?php if($row['projet_accepte']==1){ ?> <td> <?php echo ($row['nom']); ?> </td>
								<td> <?php echo ucfirst($row['thematique']); ?> </td>
                <td> <?php echo ($row['date_depot']);?> </td>
								<td id="confirmerProjet"><form action="http://institut-clement-ader.org/mes-projets/" method="POST"><button disabled style="background-color:grey" type="hidden" name="confirmer" value="';?><?php echo $row['id']; ?>">confirmer </button></form></td>
                <td id="supprimerProjet"><form action="http://institut-clement-ader.org/mes-projets/" method="POST"><button style="background-color:red" type="hidden" name="supprimer" value="';?><?php echo $row['id']; ?>">supprimer </button></form></td> <?php } ?>
							  <?php if($row['projet_accepte']==0){ ?> <td> <?php echo ($row['nom']); ?> </td>
                <td><?php echo ucfirst($row['thematique']); ?> </td>
                <td><?php echo ($row['date_depot']);?> </td>
								<td id="confirmerProjet"><form action="http://institut-clement-ader.org/mes-projets/" method="POST"><button style="background-color:green" type="hidden" name="confirmer" value="';?><?php echo $row['id']; ?>">confirmer </button></form></td>            
                <td id="supprimerProjet"><form action="http://institut-clement-ader.org/mes-projets/" method="POST"><button style="background-color:red" type="hidden" name="supprimer" value="';?><?php echo $row['id']; ?>">supprimer </button></form></td> <?php } ?>
							  </tr>
              </tbody>
					<?php
				}
			}
    
    if(isset($_POST['confirmer'])){
        $url = $bdd->getUrl($_POST['confirmer']);
        $bdd->confirmerProjet($_POST['confirmer']); 
        unlink($url);
        header('Location: http://institut-clement-ader.org/mes-projets/');
      }
    
      if(isset($_POST['supprimer'])){
        $url = $bdd->getUrl($_POST['supprimer']);
        $bdd->supprimerProjet($_POST['supprimer']); 
        unlink($url);
        header('Location: http://institut-clement-ader.org/mes-projets/');
        
      }
    
			?>
		</table>