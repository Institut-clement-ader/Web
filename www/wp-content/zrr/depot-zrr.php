<?php
// Restreint l'accès aux utilisateurs connectés
  if (!is_user_logged_in()) {
    echo("loggin to access this page");
	  exit();
  }
    //CONNEXION A LA BDD
// 	$serveur="mysql2.lamp.ods";
// 	$utilisateur="lab0612sql3";
// 	$password="XY02b21aBLaq";
// 	$db="lab0612sql3db";
  
?>

<?php
  $saveok=0;
  if(isset($_POST['valider'])){
    //on importe GestionBdd.php
    require("codes snippet/GestionBdd.php");
    $bdd = new GestionBdd();
    
    $current_user = wp_get_current_user();
    $mailArrivant = $_POST['mail'];
    $tuteur = $_POST['nom_prenom_tuteur'];
    $date_arrivee = $_POST['date_arrivee'];
    $statut_arrivant = $_POST['statut_arrivant'];
    $name = $current_user->first_name." ".$current_user->last_name;
    $mail = $current_user->user_email;
    $user_id = get_current_user_id();
    $date_fin = $_POST['date_fin'];
    $url = dirname(__DIR__)."/zrr/uploads/".strtolower ( $_POST['nom']).strtolower ($_POST['prenom']).$user_id.".zip";
    $file = 0;
    if(filesize($_FILES['fichier']['tmp_name']) < 10000000){
      if(!file_exists($url)){
        $req = $bdd->ajouterDemande(strtolower ($_POST['nom']),strtolower ($_POST['prenom']),$mailArrivant,$mail,$url,$date_fin, $tuteur, $date_arrivee, $statut_arrivant);
        $file = 1;

      } 
      move_uploaded_file ( $_FILES['fichier']['tmp_name'] , $url);
      if($file == 0){
        wp_mail('acces_zrr_ica@insa-toulouse.fr', 'Mise à jour de fichier ZRR', $name. ' a mis le fichier ZRR de '.$_POST['prenom'].' '.$_POST['nom'].' à jour','Bonjour,', array($url));
      }if($file == 1){
        wp_mail('acces_zrr_ica@insa-toulouse.fr', 'Nouvelle demande ZRR', $name. ' a fait une demande ZRR pour '.$_POST['prenom'].' '.$_POST['nom'].' : http://institut-clement-ader.org/demandes-zrr/. La fin de mission est estimée à '.$_POST['date_fin'],'Bonjour,', array($url));
      }
      $saveok = 2;
    }
    else{
      $saveok = 1;
      echo'<div id="echec">';
      echo '<p style="color:white"> &nbsp; Échec de la soumission de votre dossier. Le document déposé dépasse les 7 Mo.</p><br>';
      echo'</div>';
    }
  }
?>
<?php
  echo '<h2>Site de Toulouse - Dépôt du dossier ZRR  :</h2>';
  echo "<p>Pour plus de détails sur les documents nécessaires pour la demande ZRR, reportez vous à la page <a href='http://institut-clement-ader.org/documents/zrr-site-de-toulouse/'>http://institut-clement-ader.org/documents/zrr-site-de-toulouse/</a></p>";
?>
<?php 
  if($saveok==1){

    echo'<div id="echec">';
    echo '<p style="color:white"> &nbsp; Échec de la soumission de votre dossier</p><br>';
    echo'</div>';
  }
  elseif($saveok==2){
    echo'<div id="confirmation">';
    echo '<p style="color:white"> &nbsp; Dossier soummis avec succès!</p><br>';
    echo'</div>';
  }
?>

<?php
  echo'
  <form id="inscription4" name="zrr" method="post" action="https://ica.preprod.lamp.cnrs.fr/documents/zrr-site-de-toulouse/depot-dossier-zrr/" enctype="multipart/form-data">
    Prénom de l\'arrivant (nécéssaire) : <input type="text" name="prenom" required/>
    Nom de l\'arrivant (nécéssaire) : <input type="text" name="nom" required/><br/><br/>
    <label for="statut">Statut de l\'arrivant : </label><select id="statut" name="statut_arrivant" required/> 
          <option  value="Administratif"> Administratif</option>
          <option  value="Assistant ingénieur"> Assistant ingénieur</option>
          <option  value="Attaché temporaire d\'enseignement et de recherche"> Attaché temporaire d\'enseignement et de recherche</option>
          <option  value="Chargé de recherche"> Chargé de recherche</option>
          <option  value="Chercheur invité"> Chercheur invité</option>
          <option  value="Directeur de recherche"> Directeur de recherche</option>
          <option selected="selected" value="Doctorant"> Doctorant</option>
          <option  value="Enseignant-chercheur"> Enseignant-chercheur</option>
          <option  value="Enseignant-chercheur associé"> Enseignant-chercheur associé</option>
          <option  value="Ingénieur"> Ingénieur</option>
          <option  value="Ingénieur - Chercheur"> Ingénieur - Chercheur</option>
          <option  value="Ingénieur de recherche"> Ingénieur de recherche</option>
          <option  value="Maître assistant"> Maître assistant</option>
          <option  value="Maître assistant associé"> Maître assistant associé</option>
          <option  value="Maître de conférences"> Maître de conférences</option>
          <option  value="Maître de conférences associé"> Maître de conférences associé</option>
          <option  value="Post-doctorant"> Post-doctorant</option>
          <option  value="Professeur"> Professeur</option>
          <option  value="Professeur agrégé"> Professeur agrégé</option>
          <option  value="Professeur associé"> Professeur associé</option>
          <option  value="Professeur émérite"> Professeur émérite</option>
          <option  value="Professeur invité"> Professeur invité</option>
          <option  value="Stagiaire"> Stagiaire</option>
          <option  value="Technicien"> Technicien</option>
         </select><br/><br/>
    Nom et prénom du tuteur (nécéssaire) : <input type="text" name="nom_prenom_tuteur" required/><br/>
    Adresse E-mail de l\'arrivant (nécéssaire) : <input type="email" name="mail" required/><br/><br/>
    Date d\'arrivée (nécessaire) :<input type="date" name="date_arrivee" required/><br/><br/>
    Date estimée de fin de mission (nécessaire) :<input type="date" name="date_fin" required/><br/>
    <br/>
    Dépôt fichier de  l\'archive zip (moins de <em>7Mo</em>! ) contenant:<br><br>
    -Fichier excel<br> 
    -CV<br>
    -Carte d\'identité<br>
    -Sujet<br><br>
    <input type="file" name="fichier" accept=".zip" required/><br/><br/>
    <input type="submit" name="valider" value="Valider"/>
  </form>';
?>
