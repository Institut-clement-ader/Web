<?php

	/**
     * Améliorations à apporter :
     * Changer la liaison BDD en utilisant la classe Gestion BDD (prendre exemple sur les autres codes)
     * Enlever les echo de la table  en utilisant les balises php.
     * Ajouter quelques commentaires pour mieux comprendre le code
     * Il est possible de retirer la fonction statusToString car elle est inutile 
     * nous avons deja le status grâce à la fonction get_user
     * 
     * Modification minime : retirer les majuscule des balises du tableau html 
     * et les mettre en minuscule pour plus de lisibilité
     */

	//Connexion à la bdd
// 	$serveur="mysql2.lamp.ods";
// 	$utilisateur="lab0612sql3";
// 	$password="XY02b21aBLaq";
// 	$db="lab0612sql3db";
// 	$dns="http://institut-clement-ader.org";

// 	try{
// 		$bdd = new PDO('mysql:host='.$serveur.';dbname='.$db, $utilisateur, $password);
// 	}catch(PDOException $e){
// 		print "Erreur : ".$e->getMessage();
// 		die();
// 	}

require("codes snippet/GestionBdd.php");
$bdd = new GestionBdd();

	//RETABLIR UN MEMBRE CACHÉ
	if (isset($_POST['idRet'])) {
		$id = $_POST['idRet'];
		// s'il y a un id, on remet le display à 1 dans la base wp_usermeta
		$requete="UPDATE wp_usermeta SET meta_value = 1 WHERE user_id = :id AND meta_key = 'display_user'";
		$req = $bdd->prepare($requete);
		$req->execute(array('id'=>$id));
		if ($req->rowCount() == 0) {
			$requete = "INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES (:id, 'display_user', 1)";
			$req = $bdd->prepare($requete);
			$req->execute(array('id'=>$id));
		}
	}

	//CACHER UN MEMBRE
	if(isset($_POST['idCach'])){
		$id = $_POST['idCach'];
		// s'il y a un id, on remet le display à 0 dans la base wp_usermeta
		$requete="UPDATE wp_usermeta SET meta_value = 0 WHERE user_id = :id AND meta_key = 'display_user'";
		$req = $bdd->prepare($requete);
		$req->execute(array('id'=>$id));
	}

	//SUPPRIMER UN MEMBRE
	if(isset($_POST['idSuppr'])){
		$id = $_POST['idSuppr'];
		// s'il y a un id, on supprime l'utilisateur dans les tables wp_users, wp_usermeta et wp_podsrel
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

	function statusToString($stat) {
		switch ($stat) {
		  case "adm" :
			return "Administratif";
			break;
		  case "air" :
			return "Assistant ingénieur";
			break;
		  case "ater" :
			return "Attaché temporaire d'enseignement et de recherche";
			break;
		  case "cr" :
			return "Maître de conférence (ou équivalent)";
			break;
		  case "doc" :
			return "Doctorant";
			break;
		  case "eca" :
			return "Enseignant-chercheur associé";
			break;
		  case "icere" :
			return "Professeur (ou équivalent)";
			break;
		  case "igt" :
			return "Ingénieur";
			break;
		  case "ir" :
			return "Ingénieur de recherche";
			break;
		  case "ma" :
			return "Maître de conférence (ou équivalent)";
			break;
		  case "maa" :
			return "Maître de conférence (ou équivalent)";
			break;
		  case "mcf" :
			return "Maître de conférence (ou équivalent)";
			break;
		  case "mcfa" :
			return "Maître de conférence associé";
			break;
		  case "pa" :
			return "Maître de conférence (ou équivalent)";
			break;
		  case "postdoc" :
			return "Post-doctorant";
			break;
		  case "pr" :
			return "Professeur (ou équivalent)";
			break;
		  case "prag" :
			return "Professeur agrégé associé";
			break;
		  case "pri" :
			return "Professeur invité";
			break;
		  case "tech" :
			return "Technicien";
			break;
		  case "maître de conférences" :
			return "Maître de conférence (ou équivalent)";
			break;
			  case "pra" :
				return "Professeur associé";
				break;
		  default :
			return ucfirst($stat);
			break;
		}
	}
	  echo '<input type="text" id="searchAnnu" class="search_tab" placeholder="Chercher un membre..." title="Rentrer un nom">';
	  echo "<div id='line0'>&nbsp;</div>
			<TABLE class=\"tablesorter {sortlist: [[1,0]]} tab_annuaire tab_annuaire_gestion\" border=\"0\"  cellpadding=\"1\" width=\"100%\" id=\"table\">
				<col width='10%'>
				<col width='28%'>
				<col width='36%'>
				<col width='16%'>
				<col width='4%'>
				<col width='4%'>
				<THEAD>
					<TR>
						<TH>Identifiant</TH>
						<TH>Nom</TH>
						<TH>Statut</TH>
						<TH>Établissement</TH>
						<TH class='sortless'></TH>
						<TH class='sortless'></TH>
					</TR>
				</THEAD>
				<TBODY>";
	  $users = get_users();
	  $line = 1;
		  foreach ($users as $user) {
			if ($user->display_user == 1) {
				if (strlen($user->display_name) > 0 && ($user->display_name) != "Administrateur") {
				  echo '<tr>
							<td><a href="' . esc_url( get_author_posts_url($user->ID) ) . '">' . esc_attr($user->nickname) . '</a></td>
							<td>'. esc_attr($user->last_name) . ' ' . esc_attr($user->first_name) . '</td>
							<td>'. esc_attr($user->status).'</td>
							<td>'. esc_attr($user->tablissement_de_rattachement).'</td>
							<td>';
				  echo '		<a target="_blank" href="../wp-admin/user-edit.php?user_id='. ($user->ID) .'">Éditer</a>
							</td>
							<td>';
				  if (esc_attr($user->status) == 'Post-doctorant' || esc_attr($user->status) == 'Doctorant' || esc_attr($user->status) == 'Attaché temporaire d\'enseignement et de recherche') {
					echo '		<form id="submitdelmembre" method="POST">
									<input type="hidden" name="idSuppr" value="'.($user->ID).'">
									<input type="submit" value="Supprimer" class="del_button">
								</form>';
				  } else {
					echo '		<form method="POST">
									<input type="hidden" name="idCach" value="'.($user->ID).'">
									<input type="submit" value="Cacher">
								</form>';
				  }
				  echo'		</td>';
				  
				}
			} else {
				if (strlen($user->display_name) > 0 && ($user->display_name) != "Administrateur") {
				  echo '<tr class="cache">
							<td><a href="' . esc_url( get_author_posts_url($user->ID) ) . '">' . esc_attr($user->nickname) . '</a></td>
							<td>'. esc_attr($user->last_name) . ' ' . esc_attr($user->first_name) . '</td>
							<td>'. esc_attr($user->status).'</td>
							<td>'. esc_attr($user->tablissement_de_rattachement).'</td>
							<td></td>
							<td>
								<form method="POST">
									<input type="hidden" name="idRet" value="'.($user->ID).'">
									<input type="submit" value="Rétablir">
								</form>
							</td>';
				}
			  
			  
			}
			echo "		</tr>";
			$line += 1;
		  }
	  echo "	</TBODY>
			</TABLE>";
?>