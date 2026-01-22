<!-- Ce fichier permet de supprimer une réservation
Ce fichier est utilisé dans la page Supprimer une réservation
Ce fichier utilise Events.php 

TODO 
Envoie de mail

-->

<?php
// require 'App/Intranet/Reservation/src/Events.php';
require 'App/Intranet/Reservation/src/Reservation.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

//détection de langue courante de la page
$currentlang = get_bloginfo('language');
if (strpos($currentlang, 'fr') !== false) {
    include('App/lang-fr.php');
} elseif (strpos($currentlang, 'en') !== false) {
    include('App/lang-en.php');
} else {
    echo ("échec de reconnaissance de la langue");
}
$obj_reservation = new Reservation();
// $events = new Events();
// Récupération du nom de domaine du site
$site = site_url();
// Envoie un message d'erreur si $_GET['id'] est vide
if (!isset($_GET['id'])) {
    header('Location: ' . $site . '' . LIEN_CALENDRIER . '');
}
$event = $obj_reservation->GetEventById($_GET['id']);
?>
<!-- Titre de la réservation -->
<h1 class='titre'><?= $event['titre_reservation']; ?> </h1>
<div class="liste">
    <!-- Liste qui contient les différentes informations de la réservation -->
    <ul>
        <li><?= TXT_NOM_UTI_ADD ?> <div class="valeur"> <?= $event['nom_utilisateur'] ?></div>
        </li> </br>
        <li><?= TXT_NOM_MOYEN_ADD ?> <div class="valeur"><?= $event['nom_moyen'] ?></div>
        </li></br>
        <li><?= TXT_DATE_DEB_ADD ?><div class="valeur"><?= (new DateTime($event['date_debut']))->format('d/m/Y'); ?></div>
        </li></br>
        <li><?= TXT_HEURE_DEB_ADD ?><div class="valeur"><?= (new DateTime($event['date_debut']))->format('h:m'); ?></div>
        </li></br>
        <li><?= TXT_DATE_FIN_ADD ?><div class="valeur"><?= (new DateTime($event['date_fin']))->format('d/m/Y'); ?></div>
        </li></br>
        <li><?= TXT_HEURE_FIN_ADD ?><div class="valeur"><?= (new DateTime($event['date_fin']))->format('h:m'); ?></div>
        </li></br>
        <li><?= TXT_AXE ?><div class="valeur"><?= $event['axe_recherche'] ?></div>
        </li></br>
        <li><?= TXT_RAISON ?><div class="valeur"><?= $event['raison'] ?></div>
        </li></br>
        <!-- Si l'encadrant est null (car encadrant n'est pas utilisé pour les non-doctorant) alors enlève cette rubrique de la liste -->
        <?php if ($event['encadrant'] != NULL) :  ?>
            <li><?= TXT_ENCADRANT_SEUL ?></br>
                <div class="valeur"><?= $event['encadrant'] ?> </div>
            </li></br>
        <?php endif; ?>
        <!-- Si la description est null (car pas obligatoire) alors enlève cette rubrique de la liste -->
        <?php if ($event['description'] != NULL) :  ?>
            <li><?= TXT_DESC ?> </br>
                <div class="valeur"><?= $event['description'] ?></div>
            </li></br>
        <?php endif; ?>
    </ul>
</div>
<div class="container">

    <form action="" method="post" class="form">
        <div class="row">
            <div class="ligne1">
                <div class="form-group">
                    <label for="reason"><?= TXT_RAISON_DEL_RESERVATION ?></label>


                    <select id="raison" required type="text" class="selectionForm" name="raison_sup">
                        <option value='' selected='selected'> ----- </option>
                        <?php
                        $res = $obj_reservation->getList('reservation_raison_sup');
                        // Parcourt toutes les catégories de la requête
                        foreach ($res as $req) : ?>
                            <!-- On ajoute les raisons dans le menu déroulant -->
                            <option value="<?php
                                            if (strpos($currentlang, 'fr') !== false) {
                                                echo $req[2];
                                            } else {
                                                echo $req[3];
                                            }
                                            ?>"> <?php
                                                    if (strpos($currentlang, 'fr') !== false) {
                                                        echo $req[2];
                                                    } else {
                                                        echo $req[3];
                                                    }
                                                    ?> </option>
                        <?php endforeach;
                        ?>
                    </select>

                </div>
                <div class="desc">
                    <div class="form-simple">
                        <!-- Description de la réservation (pas obligatoire) -->
                        <label for="description"><?= TXT_DESC ?></label>
                        <!-- Si la description est contenue dans $POST alors on l'affiche -->
                        <input id="description" required type="text" name="description_sup" class="form-control" value="<?= isset($_POST['description']) ? $_POST['description'] : ''; ?>"> </input>
                    </div>
                </div>
            </div>

        </div>

</div>
<div class="container-bouton">
    <div class="bouton">
        <!-- Bouton annuler qui supprime les données du formulaire -->
        <button class="btn btn-primaryModif" type="submit" name="reset" value="Annuler" formaction="<?= $site . '/voir-mes-reservations/'  ?>"><?= TXT_ANNULER ?></button>
        <!-- Bouton ajouter qui permet de mettre les données du formulaire dans le POST -->
        <button class="btn btn-primaryModif" type="submit" name="submit" value="Supprimer"><?= TXT_VALIDER ?></button>

    </div>
</div>
</form>
</div>


<?php
// Si le POST n'est pas vide et qu'il n'y a pas eu d'exceptions alors on envoie les mails et on supprime la réservation dans la bdd
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $error == false) :
    $mail = $obj_reservation->envoieMailSup($_POST, $obj_reservation->GetEventById($_GET['id']));
    if ($mail == true) {
        $req = $obj_reservation->deleteReservation($_GET['id']);
    }
    // Si la suppression a réussie alors on affiche un message de succès
    if ($req == true) : ?>
        <div class="container">
            <div class="success">
                <?= TXT_REUSSI_SUP ?>
            </div>
        </div>
<?php endif;
endif; ?>