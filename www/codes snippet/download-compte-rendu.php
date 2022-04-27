<?php
  /**
   * Page innéxistante sur la Prod
   * Il faut la terminer !
   */


			//Liste les fichiers d'un répertoire
  ?>    
  <form action="https://ica.cnrs.fr/comptes-rendus/" method="post" enctype="multipart/form-data">
    <h2>Télécharger un document :</h2>
    <label>Afficher les comptes-rendus déposé par : </label><select id="cr_groupe" name="cr_groupe" required/> 
      <option  value="cs"> CS</option>
      <option  value="cu"> CU</option>
      <option  value="codir"> Comité de direction</option>
      </select><br/><br/>
      <input type="submit" name="submit" value="Afficher"><br/><br/>
  </form>		


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
      ?>
     <b>Liste des fichiers du répertoire CS :</b><br/><br/>\n
      <?php
      $folderpath = 'wp-content/uploads/comptes-rendus/cs';
    }
    if($depotDownload == 'cu'){
      ?>
      <b>Liste des fichiers du répertoire CU :</b><br/><br/>\n
      <?php
      $folderpath = 'wp-content/uploads/comptes-rendus/cu';
    }
    if($depotDownload == 'codir'){
      ?>
      <b>Liste des fichiers du répertoire CODIR :</b><br />\n
      <?php
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
                <td><?php echo $file;?></td>
                <td><?php echo '<a href="'.$url.'" download="'.$file.'">Télécharger</a>';?></td>
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

