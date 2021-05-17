<?php
if($_GET['lg']==='en') {$english=1;}else{$english=0;}
if(isset($_POST['mail'])){
	if(!preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9._-]+\.[a-z]+$/", $_POST['mail'])){
		header('Location:mdpoublie.php');
		exit;
	}

$serveur="mysql2.lamp.ods";
$utilisateur="lab0612sql0";
$password="n4ZPxo6aFQ74";
$db="lab0612sql0db";
$dns="http://institut-clement-ader.org/reservation";
  
  
	try{
		$bdd = new PDO('mysql:host='.$serveur.';dbname='.$db, $utilisateur, $password);
	}catch(PDOException $e){
		print "Erreur : ".$e->getMessage();
		die();
	}
	//on verifie si l'adresse saisie existe
	$req = $bdd->prepare('SELECT  count(*) FROM personnel where email = :email');
	$req->execute(array('email'=>$_POST['mail']));
	$res = $req->fetch(PDO::FETCH_NUM);
	if($res[0]==1){
		
		//on récupère l'id associé à l'adresse
		$req = $bdd->prepare('SELECT id FROM personnel WHERE email=:email');
		$req->execute(array("email"=>$_POST['mail']));
		$res = $req->fetch(PDO::FETCH_NAMED);
		$id = $res['id'];

		//on genère le token
		$token= random_str(16);
		$date = new DateTime();
		$date->modify('2 days');

		//on vérifie si la personne n'a pas déjà  fait une demande de mot de passe
		$req = $bdd->prepare('SELECT count(*) FROM token WHERE id = :id');
		$req->execute(array("id"=>$id));
		$res = $req->fetch(PDO::FETCH_NUM);
		//si elle n'a pas de demande en cours, on ajoute la ligne dans la table token
		if($res[0] == 0){
			$req = $bdd->prepare('INSERT INTO token (id, valeur, datetoken) VALUES (:id , :token, :datetoken)');
			$req->execute(array("id"=>$id, 'token'=>$token, "datetoken"=>$date->format('Y-m-d')));
		//sinon on met à jour la table token pour que le token soit associé à une personne.
		//cela évite aussid'avoir plusieurs liens permettant de changer son mot de passe	
		}else{
			$req = $bdd->prepare('UPDATE token SET valeur = :token, datetoken = :datetoken WHERE id = :id');
			$req->execute(array("id"=>$id, 'token'=>$token, "datetoken"=>$date->format('Y-m-d')));
		}

		//envoi du mail
		$to = $_POST['mail'];
		$tosecure = str_replace(array("\n","\r",PHP_EOL),'',$to);

		if(filter_var($tosecure, FILTER_VALIDATE_EMAIL)){

			$subject = "Réinitialisation mot de passe ICA";

			$message="Vous avez fait une demande de modification de votre mot de passe.<br/>Veuillez cliquer sur le lien suivant afin de finaliser le changement de mot de passe :<br/><a href=\"$dns/modifiermdp.php?token=$token\">changer mon mot de passe</a><br/>Pour rappel, le login pour vous connecter sur le site est : $id<br/><br/>Si vous n'êtes pas à l'origine de cette demande, ne prenez pas en compte ce mail.<br/><br/><br/>L'institut Clement Ader";
                        $headers="Content-type: text/html; charset= utf8\n";
                        $headers.= 'From: INSTITUT CLEMENT ADER <noreply@institut-clement-ader.fr>';

			mail($tosecure, $subject, $message, $headers);
		}
		include 'top.inc';
		?>
		<p>Le mail de modification de votre mot de passe à bien été envoyé. <br/>
			Veuillez cliquer sur le lien envoyé par mail. Vous avez 2 jours pour cliquer sur le lien et modifier votre mot de passe. Passé ce délais, il vous faudra refaire une demande de modification de mot de passe.<br/> Pensez à vérifier dans vos spams.<br/><a href="<?=$dns?>">Retour au site de réservation</a>
		</p>
		<?php
		include 'bottom.inc';		
	}else{

		include 'top.inc';
		?>
		<form action="" method="POST">
			<label>Adresse email du compte :</label><br/>
			<input type="text" name="mail"><br/>
			<input type="submit" value="Envoyer"><br/>
			<label style="color: red;">Aucun compte ne correspond à cette adresse</label>
               &nbsp;</form>
		<?php
		include 'bottom.inc';
	}

}else{
	?>


	<?php
	include 'top.inc';
	?>
	<form action="" method="POST">
		<label>Adresse email du compte :</label><br/>
		<input type="text" name="mail"><br/>
		<input type="submit" value="Envoyer">
	</form>
	<?php
	include 'bottom.inc';
}


//genère une chaine aléatoire, le deuxième argument est facultatif
//le deuxième argument permet de definir les caractères qui rentreront en compte dans la création du token
function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
	$str = '';
	$max = mb_strlen($keyspace, '8bit') - 1;
	for ($i = 0; $i < $length; ++$i) {
		$str .= $keyspace[mt_rand(0, $max)];
	}
	return $str;
}
?>
	