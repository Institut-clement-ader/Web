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

	//SUPPRIMER UN MEMBRE
	if(isset($_POST['id_doc'])){
		$id = $_POST['id_doc'];
		// s'il y a un id, on supprime le doctorant dans les tables wp_users, wp_usermeta et wp_podsrel
		$requeteUsers="DELETE FROM wp_users WHERE ID = :id;";
		$reqU = $bdd->prepare($requeteUsers);
		$reqU->execute(array('id'=>$id));
		
		$requeteMeta="DELETE FROM wp_usermeta WHERE user_id = :id;";
		$reqM = $bdd->prepare($requeteMeta);
		$reqM->execute(array('id'=>$id));
		
		$requeteRel="DELETE FROM wp_podsrel WHERE (pod_id = 862 AND (field_id = 1240 OR field_id = 1241 OR field_id = 1242 OR field_id = 1380) AND related_item_id = :id) OR (pod_id = 274 AND (field_id = 280 OR field_id = 282) AND related_item_id = :id)";
		$reqR = $bdd->prepare($requeteRel);
		$reqR->execute(array('id'=>$id));
	}

  //METTRE A JOUR LA DATE DE SOUTENANCE
	if(isset($_POST['id_these'])){
		$idThese = $_POST['id_these'];
    $dateSoutenance = $_POST['date_soutenance'];
		// s'il y a un id, on mets à jour la date de soutenance
		$requeteDateSoutenance="UPDATE wp_pods_these SET date_soutenance = :dateSoutenance WHERE ID = :idThese;";
		$reqU = $bdd->prepare($requeteDateSoutenance);
		$reqU->execute(array('dateSoutenance'=>$dateSoutenance,'idThese'=>$idThese));
	}

	//AFFICHAGE DES DOCTORANTS
	echo "<table class='tablesorter {sortlist: [[3,1], [0,0]]} tab_annuaire' border='0' width='100%'>
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
			<tbody>";

	$users = get_users('meta_key=arrivee&orderby=meta_value&order=DESC');
	$nbDoctorants = 0;
	foreach ($users as $user) {
		if ($nbDoctorants == 10)
			break;
		if ($user->status === 'Doctorant' && strlen($user->first_name) > 0) {
			echo '<tr>
					<td><a href="'.esc_url(get_author_posts_url($user->ID)).'">'.esc_attr($user->first_name).' '.esc_attr($user->last_name).'</a></td>';
            echo '	<td>'.esc_attr($user->groupe_primaire);
            if (strlen(esc_attr($user->groupe_secondaire)) > 0 && (esc_attr($user->groupe_secondaire) != esc_attr($user->groupe_primaire) && esc_attr($user->groupe_secondaire) != 'AXtr')) {
              echo '/'.esc_attr($user->groupe_secondaire);
            }
            if (strlen(esc_attr($user->groupe_tertiaire)) > 0 && (esc_attr($user->groupe_secondaire) != esc_attr($user->groupe_tertiaire) && esc_attr($user->groupe_tertiaire) != 'AXtr') && esc_attr($user->groupe_tertiaire) != esc_attr($user->groupe_primaire)) {
              echo '/'.esc_attr($user->groupe_tertiaire);
            }
            echo '	</td>';
            echo '	<td>'.esc_attr($user->tablissement_de_rattachement).'</td>';
			
			$select="SELECT th.id, th.date_debut, th.date_soutenance FROM wp_pods_these th, wp_podsrel rel WHERE rel.pod_id = 862 AND rel.field_id = 1380 AND rel.item_id = th.id AND rel.related_item_id = :id";
			$requeteThese = $bdd->prepare($select);
			$requeteThese->execute(array('id'=>$user->id));
			$these = $requeteThese->fetch();
			
			echo '<td>';
			if (isset($these['date_debut'])) {
				if (isset($these['date_soutenance']) && $these['date_soutenance'] != '0000-00-00' && $these['date_soutenance'] <= date('Y-m-d')) {
					echo "<b>Soutenue le ".date_format(date_create($these['date_soutenance']),'d/m/Y')." </b>";
				} elseif ($these['date_debut'] <= date('Y-m-d')) {
					echo "En cours depuis ".date_format(date_create($these['date_debut']),'Y');
				}
			} else {
				echo "<a target='_blank' href='#form'>Nouvelle thèse</a>";
			}
			echo '</td>';
			//Afficher un input si la date de soutenance n'a pas été renseignée
			if (isset($these['date_soutenance']) && $these['date_soutenance'] != '0000-00-00' && $these['date_soutenance'] <= date('Y-m-d')) {
			    echo "<td>Date déjà renseignée</td>";
      } else {
        echo '<td>
              <form id="updateDateSoutenance" method="POST">
                <input type="hidden" name="id_these" value="'.$these['id'].'">
                <input type="date" width="5px" name="date_soutenance">
                <input type="submit" value="Mettre à jour">
              </form>
              </td>';	
			}
			echo '<td>
					<form id="submitdeldoctorant" method="POST">
						<input type="hidden" name="id_doc" value="'.$user->id.'">
						<input type="submit" value="Supprimer le doctorant" class="del_button">
					</form>
				  </td>
				</tr>';
			$nbDoctorants++;
		}
	}
  echo "	</tbody>
		</table>
	<strong><a href='http://institut-clement-ader.org/gestion-theses/doctorants/' target='_blank'><em>(Voir plus)</em></a></strong>";
?>