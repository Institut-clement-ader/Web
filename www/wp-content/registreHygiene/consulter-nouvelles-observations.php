<?php
  // Restreint l'accès aux utilisateurs connectés
  if (!is_user_logged_in()) {
    echo("loggin to access this page");
	  exit();
  }

  $current_user = wp_get_current_user();
  $email = $current_user->user_email;
  // Si Jean-françois ou Admin
  if(strcmp($email, 'jean-francois.ferrero@univ-tlse3.fr') !=0 and !current_user_can('administrator')){
    echo("you are not allowed to be here!");
	  exit();
  }

  require("codes snippet/GestionBdd.php");
  $bdd = new GestionBdd();
  $req = $bdd->getObservationsNonValide();
  
  
    
  ?> 
  <table>
    <!-- largeur des colonnes -->
		<col width="9%">
		<col width="18%">
		<col width="13%">
		<col width="50%">
    <col width="10%">
    <thead>
				<tr>
					
					
					<th class="dateFormat-ddmmyyyy">Date de saisie</th>
          <th>Agent ou usager</th>
          <th>Type d'observation</th>
          <th>Observation</th>
          <th class="sortless"></th>
				</tr>
    </thead>
				<?php
          
					if(isset($req)){
						while($row = $req->fetch()){
              $username = ($row['nom'])." ".($row['prenom']);
              $dateSaisie = ($row['date_saisie']);
                
              
              
             
				?>
              <tbody>
							<tr>
                <?php echo '<td>';?><?php echo date('d/m/y', strtotime($dateSaisie));?><?php echo '</td>';?>
								<?php echo '<td>';?><?php echo ($username); ?><?php echo '</td>';?>
								<?php echo '<td>';?><?php echo ucfirst($row['sujet']); ?><?php echo '</td>';?>
                <?php echo '<td>';?><?php echo ucfirst($row['observations']); ?><?php echo '</td>';?>
                <?php echo '<td>';?><a href="http://institut-clement-ader.org/completer-lobservation/?id=<?php echo ($row['id']);?>">Ajouter une observation</a><?php echo '</td>';?>
               
							 </tr>
              </tbody>
    <?php
					
				    }
			     }
    ?>
	</table>