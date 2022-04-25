<?php

  /**
  * Améliorations à apporter :
  * Enlever les echo innutiles
  * Supprimer la partie de code en commentaire ( ancienne connexion BDD)
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
  $req = $bdd->getObservations();
  
  
    
  ?> 

    <form class='form-stats' action='https://ica.cnrs.fr/consulter-le-registre/registre/' method='POST'>
		  <button type='submit' class='spanExcel'><i class='fa fa-table'></i>&nbsp;&nbsp;&nbsp;Télécharger le registre au format Excel</button>
	  </form>&nbsp;

  <table>
    <!-- largeur des colonnes -->
		<col width="9%">
		<col width="50%">
		<col width="13%">
		<col width="18%">
    <col width="10%">
    <thead>
				<tr>
					<th>Agent ou usager</th>
					<th>Observations relatives à la prévention des risques professionels et à l'amélioration des conditions de travail </th>
					<th class="dateFormat-ddmmyyyy">Date de saisie</th>
          <th class="data-date-format=DD MMMM YYYY">Date de consultation (responsable de la structure)</th>
          <th class="sortless"></th>
				</tr>
    </thead>
				<?php
          
					if(isset($req)){
						while($row = $req->fetch()){
              $username = ($row['nom'])." ".($row['prenom']);
              $dateSaisie = ($row['date_saisie']);
              $dateConsultationChefStructure = ($row['date_consultation_chef_structure']);
                
              
              
             
				?>
              <tbody>
							<tr>
								<?php echo '<td>';?><?php echo ($username); ?><?php echo '</td>';?>
								<?php echo '<td>';?><?php echo ucfirst($row['observations']); ?><?php echo '</td>';?>
                <?php echo '<td>';?><?php echo date('d/m/y', strtotime($dateSaisie));?><?php echo '</td>';?>
                <?php if($row['visa']==1){echo '<td>';?><?php echo date('d/m/y', strtotime($dateConsultationChefStructure)); ?><?php echo '</td>';}?>
                <?php if($row['visa']==0){echo '<td>';?><?php echo "Pas encore consulté"; ?><?php echo '</td>';}?> 
                <?php echo '<td>';?><a href="http://ica.cnrs.fr/affichage-de-lobservation/?id=<?php echo ($row['id']);?>">consulter</a><?php echo '</td>';?>
               
							 </tr>
              </tbody>
    <?php
					
				    }
			     }
    ?>
	</table>