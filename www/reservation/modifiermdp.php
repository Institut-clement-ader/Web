<?php
if($HTTP_GET_VARS['lg']==='en') $english=1;
if(!isset($_POST['mdp1'],$_POST['mdp2'])){
	if(isset($_GET['token'])){

 $serveur="mysql2.lamp.ods";
$utilisateur="lab0612sql0";
$password="n4ZPxo6aFQ74";
$db="lab0612sql0db";
$dns="https://ica.cnrs.fr/reservation";
    
		try{
			$bdd = new PDO('mysql:host='.$serveur.';dbname='.$db, $utilisateur, $password);
		}catch(PDOException $e){
			print "Erreur : ".$e->getMessage();
			die();
		}
		$req = $bdd->prepare('SELECT COUNT(*) FROM token WHERE valeur = :token');
		$req->execute(array("token"=>$_GET['token']));
		$res = $req->fetch(PDO::FETCH_NUM);
		if($res[0] == 0){
			header('Location:index.php');	
		}
		$req = $bdd->prepare('SELECT datetoken, id FROM token WHERE valeur = :token');
		$req->execute(array("token"=>$_GET['token']));
		$res = $req->fetch(PDO::FETCH_NAMED);
		$id = $res['id'];
    if(GetDateDiffFromNow($res['datetoken'])>2){
			include 'top.inc';
?>
			<p>La demande de changement de mot de passe est expirée. Veuillez réiterer votre demande <a href="<?=$dns?>/mdpoublie.php">ici</a>.</p>
<?php		
			include 'bottom.inc';
		}else{
			include 'top.inc';
?>
			<form action="" method="POST">
				<label>Nouveau mot de passe :</label><br/>
				<input type="password" name="mdp1" required><br/>
				<label>Répéter le mot de passe :</label><br/>
				<input type="password" name="mdp2" required><br/>
				<input type="submit" value="Envoyer"><br/>
				<label>Pour information, votre login est : <?= $id ?></label>
			</form>
<?php		
			include 'bottom.inc';
		}
	}else{
		header('Location: index.php');
	}
}else{
	if(isset($_GET['token'])){
$serveur="mysql2.lamp.ods";
$utilisateur="lab0612sql0";
$password="n4ZPxo6aFQ74";
$db="lab0612sql0db";
$dns="https://ica.cnrs.fr/reservation";
		try{
			$bdd = new PDO('mysql:host='.$serveur.';dbname='.$db, $utilisateur, $password);
                }catch(PDOException $e){
			print "Erreur : ".$e->getMessage();
			die();
		}
		$req = $bdd->prepare('SELECT COUNT(*) FROM token WHERE valeur = :token');
		$req->execute(array("token"=>$_GET['token']));
		$res = $req->fetch(PDO::FETCH_NUM);
		if($res[0] != 1	){
			header('Location:index.php');	
		}
		$req = $bdd->prepare('SELECT datetoken FROM token WHERE valeur = :token');
		$req->execute(array("token"=>$_GET['token']));
		$res = $req->fetch(PDO::FETCH_NAMED);
		if(GetDateDiffFromNow($res['datetoken'])>2){
			include 'top.inc';
?>
			<p>La demande de changement de mot de passe est expirée. Veuillez réiterer votre demande <a href="<?=$dns?>/mdpoublie.php">ici</a>.</p>
<?php		
			include 'bottom.inc';
		}else{
			if($_POST['mdp1'] == $_POST['mdp2']){
                                $req = $bdd->prepare('SELECT id from token WHERE valeur = :token');
                                $req->execute(array("token"=>$_GET['token']));
                                $res = $req->fetch(PDO::FETCH_NAMED);
                                $id = $res['id'];
				$req = $bdd->prepare('UPDATE personnel SET password = :password WHERE id = :id');
				$req->execute(array("password"=>hash('sha256', $_POST['mdp1']), "id"=>$id));
				$req = $bdd->prepare('DELETE FROM token WHERE id = :id');
				$req->execute(array("id"=>$id));
				include 'top.inc';
?>
				<p>Le mot de passe à bien été modifié. Vous pouvez maintenant vous <a href="<?=$dns?>/index.php">connecter</a></p>
<?php		
				include 'bottom.inc';
			}else{
				include 'top.inc';
?>
				<form action="" method="POST">
					<label>Nouveau mot de passe :</label><br/>
					<input type="password" name="mdp1" required><br/>
					<label>Répéter le mot de passe :</label><br/>
					<input type="password" name="mdp2" required><br/>
					<input type="submit" value="Envoyer"><br/>
					<label> les mots de passe ne correspondent pas</label><br/>
					<label>Pour information, votre login est : <?= $id ?></label>
				</form>
<?php		
					include 'bottom.inc';
			}	
		}
	}else{
		header('Location: index.php');
	}	
}	


function GetDateDiffFromNow($originalDate) 
{
    $date1=new DateTime($originalDate);
    $date2=new DateTime();
    $daysDifference = round(abs($date2->format('U') - $date1->format('U')) / (60*60*24));
    return $daysDifference;
}
?>
