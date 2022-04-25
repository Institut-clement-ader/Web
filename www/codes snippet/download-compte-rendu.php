<?php
  /**
   * Améliorations à apporter :
   * Enlever les echo en utilisant les balises php.
   */


			//Liste les fichiers d'un répertoire
  echo'<form action="https://ica.cnrs.fr/comptes-rendus/" method="post" enctype="multipart/form-data">
        <h2>Télécharger un document :</h2>
        <label>Afficher les comptes-rendus déposé par : </label><select id="cr_groupe" name="cr_groupe" required/> 
          <option  value="cs"> CS</option>
          <option  value="cu"> CU</option>
          <option  value="codir"> Comité de direction</option>
        </select><br/><br/>
        <input type="submit" name="submit" value="Afficher"><br/><br/>
    </form>'		
?>

 <table>
   <col width="9O%">
	 <col width="10%">
    <thead>
				<tr>
					<th>Fichiers</th>
					<th class="sortless"></th>
				</tr>
    </thead>


<?php
// Vérifier si le formulaire a été soumis
  if(isset($_POST['cr_groupe'])){
    $depotDownload = $_POST['cr_groupe'];
    if($depotDownload == 'cs'){
      echo "<b>Liste des fichiers du répertoire CS :</b><br /><br />\n";
      $folderpath = 'wp-content/uploads/comptes-rendus/cs';
    }
    if($depotDownload == 'cu'){
      echo "<b>Liste des fichiers du répertoire CU :</b><br /><br />\n";
      $folderpath = 'wp-content/uploads/comptes-rendus/cu';
    }
    if($depotDownload == 'codir'){
      echo "<b>Liste des fichiers du répertoire CODIR :</b><br />\n";
      $folderpath = 'wp-content/uploads/comptes-rendus/codir';
    }

          if (file_exists($folderpath) && is_dir($folderpath)) {
            $PointeurVersRepertoire = opendir($folderpath);
            while (($file = readdir($PointeurVersRepertoire)) !== false ) //Lecture d une entree du repertoire
            {
              // enleve les fichiers . et .. et index.php et .htaccess et les répertoires
					    if ($file != '.' && $file != '..' && $file != 'index.php' && $file != '.htaccess' && !is_dir($file))
					    {
                $url = 'https://ica.cnrs.fr/'.$folderpath.'/'.$file;
                
  ?>
              <tr>
                <?php echo '<td>';?><?php echo $file;?><?php echo '</td>';?>
                <?php echo '<td>';?><?php echo '<a href="'.$url.'" download="'.$file.'">Télécharger</a>';?><?php echo '</td>';?>
              </tr>
  <?php             
              }
            }
            closedir($PointeurVersRepertoire);
            
          }
          else{echo "Le répertoire $folderpath n'existe pas ou ce n'est pas un répertoire.";}
  }
// }
?>
</table>

