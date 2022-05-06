<?php

	//LIAISON A LA BDD
	$serveur="mysql2.lamp.ods";
	$utilisateur="lab0612sql3";
	$password="XY02b21aBLaq";
	$db="lab0612sql3db";
	
	try {
		$bdd = new PDO('mysql:host='.$serveur.';dbname='.$db, $utilisateur, $password);
	} catch(PDOException $e) {
		print "Erreur : ".$e->getMessage();
		die();
	}

	require("codes snippet/GestionBdd.php");
$bdd = new GestionBdd();


	//SUPPRIMER UN MEMBRE
	if(isset($_POST['id_doc'])){
		$id = $_POST['id_doc'];
		// s'il y a un id, on supprime le doctorant dans les tables wp_users, wp_usermeta et wp_podsrel
		$reqU = $bdd->supprimerDoctorantTableUser($id);

		$reqM= $bdd->supprimerDoctorantTableUserMeta($id);
		
		$reqR= $bdd->supprimerDoctorantTablePodsrel($id);
	}

  //METTRE A JOUR LA DATE DE SOUTENANCE
	if(isset($_POST['id_these'])){
		$idThese = $_POST['id_these'];
    	$dateSoutenance = $_POST['date_soutenance'];
		// s'il y a un id, on mets à jour la date de soutenance dans la table wp_pods_these
		$reqU= $bdd->updateDateSoutenance($dateSoutenance,$idThese);
	}

	//LISTE DES DOCTORANTS DANS UN TABLEAU
	//En-tête du tableau
	?>
	<table class='tablesorter {sortlist: [[3,1], [0,0]]} tab_annuaire' border='0' width='100%'>
			<col width='17%'>
			<col width='11%'>
			<col width='18%'>
			<col width='18%'>
			<col width='18%'>
			<col width='18%'>
			<thead>
				<tr>
					<th>Nom</th>
					<th>Groupe</th>
					<th>Établissement d'origine</th>
					<th>Statut de la thèse</th>
					<th>Date de soutenance</th>
					<th class='sortless'></th>
				</tr>
			</thead>
			<tbody>
	<?php
	//Corps du tableau (affichage des donnees pour chaque doctorant)
	$users = get_users();
	foreach ($users as $user) {
		if ($user->status == 'Doctorant' && strlen($user->first_name) > 0) {
			?> <tr>
					<td><a href="<?=esc_url(get_author_posts_url($user->ID)) ?> "> <?= esc_attr($user->first_name).' '.esc_attr($user->last_name) ?> </a></td>
            <td><?= esc_attr($user->groupe_primaire) ?><?php
            if (strlen(esc_attr($user->groupe_secondaire)) > 0 && (esc_attr($user->groupe_secondaire) != esc_attr($user->groupe_primaire) && esc_attr($user->groupe_secondaire) != 'AXtr')) {
              echo '/'.esc_attr($user->groupe_secondaire);
            }
            if (strlen(esc_attr($user->groupe_tertiaire)) > 0 && (esc_attr($user->groupe_secondaire) != esc_attr($user->groupe_tertiaire) && esc_attr($user->groupe_tertiaire) != 'AXtr') && esc_attr($user->groupe_tertiaire) != esc_attr($user->groupe_primaire)) {
              echo '/'.esc_attr($user->groupe_tertiaire);
            }
			?>
            </td>
            <td><?=esc_attr($user->tablissement_de_rattachement)?></td>
			<?php
				$id = $user->id;
				$req= $bdd->getTheses($id);
				$these = $req->fetch();
			?>
			//Affichage du statut de la these, en fonction des valeurs des dates de debut et de soutenance
			<td>
			<?php
			if (isset($these['date_debut'])) {
				if (isset($these['date_soutenance']) && $these['date_soutenance'] != '0000-00-00' && $these['date_soutenance'] <= date('Y-m-d')) {
					?> <b>Soutenue le <?=date_format(date_create($these['date_soutenance']),'d/m/Y'); ?></b><?php
				} elseif ($these['date_debut'] <= date('Y-m-d')) {
					?>En cours depuis <?= date_format(date_create($these['date_debut']),'Y');
				}
			} else {
				?><a target='_blank' href='http://institut-clement-ader.org/gestion-theses/#form'>Nouvelle thèse</a><?php
			}
			?>
			</td>
			<?php
			//Afficher un input si la date de soutenance n'a pas été renseignée
			if (isset($these['date_soutenance']) && $these['date_soutenance'] != '0000-00-00' && $these['date_soutenance'] <= date('Y-m-d')) {
			    ?><td>Date déjà renseignée</td>
				<?php
      } else {
		  ?>
        	<td>
              <form id="updateDateSoutenance" method="POST">
                <input type="hidden" name="id_these" value="'.$these['id'].'">
                <input type="date" width="5px" name="date_soutenance">
                <input type="submit" value="Mettre à jour">
              </form>
              </td>	
			<?php
			}
			?>
			<td>
				<form id="submitdeldoctorant" method="POST">
					<input type="hidden" name="id_doc" value="'.$user->id.'">
					<input type="submit" value="Supprimer le doctorant" class="del_button">
				</form>
			</td>
				</tr>
		<?php
		}
	}?>
  			</tbody>
		</table>
