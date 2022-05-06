<?php

require("codes snippet/GestionBdd.php");
$bdd = new GestionBdd();

	//RETABLIR UN MEMBRE CACHÉ
	if (isset($_POST['idRet'])) {
		$id = $_POST['idRet'];
		// s'il y a un id, on remet le display à 1 dans la base wp_usermeta
		$req= $bdd->retablirMembre1($id);

		if ($req->rowCount() == 0) {
			$req= $bdd->retablirMembre2($id);
		}
	}

	//CACHER UN MEMBRE
	if(isset($_POST['idCach'])){
		$id = $_POST['idCach'];
		// s'il y a un id, on remet le display à 0 dans la base wp_usermeta
		$req= $bdd->cacherMembre($id);
	}

	//SUPPRIMER UN MEMBRE
	if(isset($_POST['idSuppr'])){
		$id = $_POST['idSuppr'];
		// s'il y a un id, on supprime l'utilisateur dans les tables wp_users, wp_usermeta et wp_podsrel
		$reqU = $bdd->supprimerDoctorantTableUser($id);

		$reqM= $bdd->supprimerDoctorantTableUserMeta($id);
		
		$reqR= $bdd->supprimerDoctorantTablePodsrel($id);
	}
	?>
	  <input type="text" id="searchAnnu" class="search_tab" placeholder="Chercher un membre..." title="Rentrer un nom">
	  <div id='line0'>&nbsp;</div>
			<table class=\"tablesorter {sortlist: [[1,0]]} tab_annuaire tab_annuaire_gestion\" border=\"0\"  cellpadding=\"1\" width=\"100%\" id=\"table\">
				<col width='10%'>
				<col width='28%'>
				<col width='36%'>
				<col width='16%'>
				<col width='4%'>
				<col width='4%'>
				<thead>
					<tr>
						<th>Identifiant</th>
						<th>Nom</th>
						<th>Statut</th>
						<th>Établissement</th>
						<th class='sortless'></th>
						<th class='sortless'></th>
					</tr>
				</thead>
				<tbody>
	<?php
	  $users = get_users();
	  $line = 1;
		  foreach ($users as $user) {
			if ($user->display_user == 1) {
				if (strlen($user->display_name) > 0 && ($user->display_name) != "Administrateur") {
				?>
					<tr>
						<td><a href="<?= esc_url( get_author_posts_url($user->ID) ) ?>"> <?= esc_attr($user->nickname)?></a></td>
						<td><?= esc_attr($user->last_name) . ' ' . esc_attr($user->first_name) ?></td>
						<td><?=esc_attr($user->status)?></td>
						<td><?=esc_attr($user->tablissement_de_rattachement)?></td>
						<td><a target="_blank" href="../wp-admin/user-edit.php?user_id=<?=($user->ID)?>">Éditer</a></td>
						<td><?php
				  		if (esc_attr($user->status) == 'Post-doctorant' || esc_attr($user->status) == 'Doctorant' || esc_attr($user->status) == 'Attaché temporaire d\'enseignement et de recherche') {
							?>
							<form id="submitdelmembre" method="POST">
								<input type="hidden" name="idSuppr" value="<?=($user->ID)?>">
								<input type="submit" value="Supprimer" class="del_button">
							</form>
							<?php
				  		} else {
							?>
							<form method="POST">
								<input type="hidden" name="idCach" value="<?=($user->ID)?>">
								<input type="submit" value="Cacher">
							</form>
							<?php
				  }
				  			?>
				  			</td>
							<?php
				  
				}
			} else {
				if (strlen($user->display_name) > 0 && ($user->display_name) != "Administrateur") {
					?>
					<tr class="cache">
							<td><a href="<?=esc_url( get_author_posts_url($user->ID) )?>"><?=esc_attr($user->nickname)?></a></td>
							<td><?=esc_attr($user->last_name) . ' ' . esc_attr($user->first_name)?></td>
							<td><?=esc_attr($user->status)?></td>
							<td><?=esc_attr($user->tablissement_de_rattachement)?></td>
							<td></td>
							<td>
								<form method="POST">
									<input type="hidden" name="idRet" value="<?=($user->ID)?>">
									<input type="submit" value="Rétablir">
								</form>
							</td>
							<?php
				}
			  
			  
			}
			?>
			</tr>
			<?php
			$line += 1;
		  }
		  		?>
	  			</tbody>
			</table>
