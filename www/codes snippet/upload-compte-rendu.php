<?php
// Vérifier si le formulaire a été soumis
if(isset($_POST['groupe_cr'])){
    // Vérifie si le fichier a été uploadé sans erreur.
    if(isset($_FILES["fichier"]) && $_FILES["fichier"]["error"] == 0){
        $filename = $_FILES["fichier"]["name"];
        $filetype = $_FILES["fichier"]["type"];
        $filesize = $_FILES["fichier"]["size"];
        $depotUpload = $_POST['groupe_cr'];
        

        // Vérifie la taille du fichier - 5Mo maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");

            // Vérifie si le fichier existe avant de le télécharger.
            if(file_exists("wp-content/uploads/comptes-rendus/" . $_FILES["fichier"]["name"])){
                echo $_FILES["fichier"]["name"] . " existe déjà.";
            } else {
              // Détermine le repertoire de depôt
              if($depotUpload == 'cs'){
                move_uploaded_file($_FILES["fichier"]["tmp_name"], "wp-content/uploads/comptes-rendus/cs/". $_FILES["fichier"]["name"]);
                echo "Votre fichier a été téléchargé avec succès.";
              }
              if($depotUpload == 'cu'){
                move_uploaded_file($_FILES["fichier"]["tmp_name"], "wp-content/uploads/comptes-rendus/cu/". $_FILES["fichier"]["name"]);
                echo "Votre fichier a été téléchargé avec succès.";
              }
              if($depotUpload == 'codir'){
                move_uploaded_file($_FILES["fichier"]["tmp_name"], "wp-content/uploads/comptes-rendus/codir/". $_FILES["fichier"]["name"]);
                echo "Votre fichier a été téléchargé avec succès.";
              }
            } 
    } else{
        echo "Error: " . $_FILES["fichier"]["error"];
    }
}


?>

<?php
echo'<form action="https://ica.cnrs.fr/comptes-rendus/" method="post" enctype="multipart/form-data">
        <h2>Déposer un document :</h2>
         <label>Déposé par un membre du : </label><select id="groupe_cr" name="groupe_cr" required/> 
          <option  value="cs"> CS</option>
          <option  value="cu"> CU</option>
          <option  value="codir"> Comité de direction</option>
        </select><br/><br/>
        <label for="fileUpload">Fichier:</label>
        <input type="file" name="fichier" id="fileUpload"><br /><br />
        <input type="submit" name="submit" value="Upload">
        <p><strong>Note:</strong> Taille maximale de 5 Mo.</p>
    </form>'
?>



		
