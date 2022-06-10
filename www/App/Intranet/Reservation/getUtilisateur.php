<!-- Ce fichier permet de changer la liste déroulant des utilisateurs en fonction des réservations du tableau
Ce fichier est utilisé dans du JavaScript dans la page Tableau des réservations 
Ce fichier utilise Events.php-->
<?php 
    require 'App/Intranet/Reservation/src/Events.php';
    session_start();
    $evenement = new Events();
    // Récupère la date du GET pour et on met l'heure et les minute en 00:00 si $GET est null alors récupère la date du jour 
    $deb= (new DATETIME($_GET['deb']))->format("Y-m-d H:i");
    // Récupère la date du GET pour et on met l'heure et les minute en 00:00 si $GET est null alors récupère la date du jour 
    $fin= (new DATETIME($_GET['fin']))->format("Y-m-d H:i");
    // Si fin est la date du jour avec les mêmes heures (cela ça signifie que l'utilisatuer n'a pas mis d'heure) alors on met une grand date de fin pour toutes avoir 
    if ($fin==date("Y-m-d H:i")){
        $fin= (new DATETIME('3000-01-01'))->format('Y-m-d H:i');
    }
    // S'il y a une catégorie dans le GET alors on exécute la requête avec le GET
    if(isset($_GET['cat'])){
        $q =$_GET['cat'];
        $_SESSION['categorie_moyen_recherche']=$q;
        $uti= $evenement->getUtiEventsByCategorie($q,$deb,$fin);
        $moy= $evenement->getMoyenParCategorie($q);
        // Parcourt tous les moyens de la catégorie
        foreach($moy as $row){
        // Si le moyen est le même que la SESSION alors on exécute la requête avec ce moyen
            if($_SESSION['moyen_recherche']==$row['nom_moyen'] ){   
                $uti= $evenement->getUtiEventsByMoyen($_SESSION['moyen_recherche'],$deb,$fin);
            }
        }
    }else{
        $m =$_GET['moy'];
        $_SESSION['moyen_recherche']=$m;
        // Si $m n'est pas null alors on execute la requète avec le moyen sinon avec la catégorie
        if ($m!=''){
            $uti= $evenement->getUtiEventsByMoyen($m,$deb,$fin);
        }else{
            $uti= $evenement->getUtiEventsByMoyen($_SESSION['categorie_moyen_recherche'],$deb,$fin);
        }

    }
?>
 <!-- Menu déroulant des différents utilisateur -->
    <div class="container_uti">
            <select class="selection_uti" name="nom_utilisateur" >
                <option value='' selected='selected'> ----- </option>
                <!-- Parcourt toutes les réservations dans la requète -->
                <?php foreach($uti as $row){ ?>
                    <!-- On ajoute les utilisateurs qui ont réservés dans le menu déroulant et on sélectionne l'utilisateur de la SESSION- --> 
                    <option class="option" value='<?= $row['nom_utilisateur']?>'<?= ($_SESSION['nom_utilisateur']== $row['nom_utilisateur']) ? selected : ''; ?>> <?= $row['nom_utilisateur'] ?> </option>
                <?php } ?>
            </select>
    </div>
