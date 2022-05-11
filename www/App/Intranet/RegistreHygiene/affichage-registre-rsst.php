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

  require("App/GestionBdd.php");
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
								<td><?php echo ($username); ?></td>
								<td><?php echo ucfirst($row['observations']); ?></td>
                <td><?php echo date('d/m/y', strtotime($dateSaisie));?></td>
                <?php if($row['visa']==1){ ?><td><?php echo date('d/m/y', strtotime($dateConsultationChefStructure)); ?></td> <?php } ?>
                <?php if($row['visa']==0){ ?><td><?php echo "Pas encore consulté"; ?></td> <?php } ?>
                <td><a href="http://ica.cnrs.fr/affichage-de-lobservation/?id=<?php echo ($row['id']);?>">consulter</a></td>
               
							 </tr>
              </tbody>
    <?php
					
				    }
			     }
    ?>
	</table>