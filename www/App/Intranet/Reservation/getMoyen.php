<!-- Ce fichier permet de changer la liste déroulant en fonction de la catégorie choisi 
Ce fichier est utilisé dans du JavaScript dans la page Calendrier des réservations ainsi que le Tableau des réservations 
Ce fichier utilise Events.php-->
<?php 
    require 'App/Intranet/Reservation/src/Events.php';
    session_start();
    $evenement = new Events();
    $q =$_GET['cat'];
    $_SESSION['categorie_moyen_recherche']=$q;
?>
 <!-- Menu déroulant des différents moyens -->
<select class="selection" name="moyen_recherche"  >
    <option value='' selected='selected'> ----- </option>
    <?php 
        $requ=$evenement->getMoyenParCategorie($q);
        // Parcourt tous les moyens de la requête 
        for ($i =0; $i < count($requ); $i++):   ?>  
            <!-- On ajoute les moyens dans le menu déroulant --> 
            <option value="<?= $requ[$i][0]?>"<?= ($_SESSION['moyen_recherche']== $requ[$i][0]) ? selected : ''; ?>> <?= $requ[$i][0] ?> </option>
        <?php endfor; 
    ?>
</select>
