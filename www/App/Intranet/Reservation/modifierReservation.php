<!-- Ce fichier est le formulaire de modification d'une réservation ainsi que sa modification dans la bdd et la vérification des exceptions
Ce fichier est utilisé dans la page Modifier une réservation 
Ce fichier utilise NouvelleReservation.php -->
<?php
require 'App/Intranet/Reservation/src/NouvelleReservation.php';
//détection de langue courante de la page
$currentlang = get_bloginfo('language');
if (strpos($currentlang, 'fr') !== false) {
    include('App/lang-fr.php');
} elseif (strpos($currentlang, 'en') !== false) {
    include('App/lang-en.php');
} else {
    echo ("échec de reconnaissance de la langue");
}
$valider = new NouvelleReservation();
//$error va permettre de voir s'il y a une exception s'il est vrai alors on n'ajoute pas la réservation dans la bdd 
$error = false;
// Envoie un message d'erreur si $_GET['id'] est vide
if (!isset($_GET['id'])) {
    header('Location: ' . $site . '' . LIEN_CALENDRIER . '');
}
$event = $valider->GetEventById($_GET['id']);
$dateheure_debut = $valider->separeDateEtHeure($event['date_debut']);
$dateheure_fin = $valider->separeDateEtHeure($event['date_fin']);
$current_user = wp_get_current_user();
$uti = $current_user->display_name;

?>
<div class="container">
    <?php
    // Si POST n'est pas vide alors on récupère les informations dedans et on vérifie le chevauchement
    if ($_SERVER['REQUEST_METHOD'] == 'POST') :
        // Si il y a un chevauchement alors on envoye une excpetion
        if ($valider->chevauchementMemeMoyenIdDifferent($_POST, $_GET['id'])[0] >= '1') :
            $error = true; ?>
            <div class="alert">
                <?= TXT_ERREUR_MOYEN ?>
            </div>
    <?php endif;
    endif;
    ?>
    <!-- Début du formulaire -->
    <form action="" method="post" class="form">
        <div class="row">
            <div class="form-simple">
                <!-- Titre de la réservation -->
                <label for="titre_reservation"><?= TXT_TITRE ?></label>
                <input id="titre_reservation" required type="text" class="form-control" name="titre_reservation" value="<?= isset($_POST['titre_reservation']) ? $_POST['titre_reservation'] : $event['titre_reservation'];  ?>">
            </div>
            <div class="ligne1">
                <div class="form-group">
                    <!-- Nom de l'utilisateur qui réserve -->
                    <label for="nom_utilisateur"><?= TXT_NOM_UTI_ADD ?></label>
                    <!-- On bloque input du nom d'utilisateur car on ne modifie pas le nom de l'utilisateur qui à crée la reservations  -->
                    <input id="nom_utilisateur" required type="text" class="form-control" name="nom_utilisateur" DISABLED value='<?= $event['nom_utilisateur']  ?>'>
                    <input type='hidden' name='nom_utilisateur' value='<?= $event['nom_utilisateur'] ?>'>
                </div>
                <div class="form-group">
                    <!-- Nom du moyen réservé -->
                    <label for="nom_moyen"><?= TXT_NOM_MOYEN_ADD ?></label>
                    <!-- Les moyens sont regroupés en catégorie (optgroup) et sont sous forme de liste -->
                    <select id="nom_moyen" required type="text" class="selectionForm" name="nom_moyen">
                        <option value='' selected='selected'> ----- </option>
                        <?php
                        $res = $valider->afficherLesCategorie();
                        // Si $POST contient un nom de moyen alors on le récupère sinon on récupère le nom du moyen de la requête
                        if (isset($_POST['nom_moyen'])) {
                            // Récupère le nom du moyen avec les ' sans \
                            $nom_moyen = str_replace("\'", "'", $_POST['nom_moyen']);;
                        } else {
                            $nom_moyen = $event['nom_moyen'];
                        }
                        // Parcourt toutes les catégories de la requête
                        foreach ($res as $req) : ?>
                            <!-- On ajoute les catégories dans le menu déroulant sous forme de optgroup -->
                            <optgroup label="<?= $req[0] ?>">
                                <?php $resu = $valider->getMoyenParCategorie($req[0]);
                                // Parcourt tous les moyens de la requête 
                                foreach ($resu as $requ) : ?>
                                    <!-- On ajoute les moyens dans le menu déroulant et on sélectionne celui dans $nom_moyen -->
                                    <option value="<?= $requ[0] ?>" <?= ($nom_moyen == $requ[0]) ? selected : ''; ?>> <?= $requ[0] ?> </option>
                                <?php endforeach; ?>
                            </optgroup>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="ligne2">
                <div class="form-group">
                    <!-- Date de début de la réservation-->
                    <label for="date_debut"><?= TXT_DATE_DEB_ADD ?></label>
                    <input id="date_debut" required type="date" class="form-time" name="date_debut" value="<?= isset($_POST['date_debut']) ? $_POST['date_debut'] : $dateheure_debut[0]; ?>">
                </div>
                <div class="form-group">
                    <!-- Heure de début de la réservation-->
                    <label for="heure_debut"><?= TXT_HEURE_DEB_ADD ?></label>
                    <input id="heure_debut" required type="time" class="form-time" name="heure_debut" value="<?= isset($_POST['heure_debut']) ? $_POST['heure_debut'] : $dateheure_debut[1]; ?>">
                </div>
            </div>
            <div class="ligne3">
                <div class="form-group">
                    <!-- Date de fin de la réservation-->
                    <label for="date_fin"><?= TXT_DATE_FIN_ADD ?></label>
                    <input id="date_fin" required type="date" class="form-time" name="date_fin" value="<?= isset($_POST['date_fin']) ? $_POST['date_fin'] : $dateheure_fin[0] ?>">
                    <?php
                    // Si le POST n'est pas vide alors on vérifie les exceptions
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') :
                        // S'il y a un chevauchement entre les deux dates alors on envoie l'exception
                        if ($valider->chevauchement2jours(new DATETIME($_POST['date_debut']), new DATETIME($_POST['date_fin'])) == true) :
                            $error = true; ?>
                            <div class="alert">
                                <?= TXT_ERREUR_DATE ?>
                            </div>
                    <?php endif;
                    endif;
                    ?>
                </div>
                <div class="form-group">
                    <!-- Heure de fin de la réservation-->
                    <label for="heure_fin"><?= TXT_HEURE_FIN_ADD ?></label>
                    <input id="heure_fin" required type="time" class="form-time" name="heure_fin" value="<?= isset($_POST['heure_fin']) ? $_POST['heure_fin'] : $dateheure_fin[1]; ?>">
                    <?php
                    // Si le POST n'est pas vide alors on vérifie les exceptions
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') :
                        // S'il y a un chevauchement entre les deux heures et que la date de début et de fin sont les mêmes alors on envoie l'exception
                        if ($_POST['date_debut'] == $_POST['date_fin'] && $valider->chevauchement2heures(new DATETIME($_POST['heure_debut']), new DATETIME($_POST['heure_fin'])) == true) :
                            $error = true; ?>
                            <div class="alert">
                                <?= TXT_ERREUR_HEURE ?>
                            </div>
                    <?php endif;
                    endif;
                    ?>
                </div>
            </div>
            <div class="ligne4">
                <div class="form-group">
                    <!-- Raison de la réservation-->
                    <label for="raison"><?= TXT_RAISON ?></label>
                    <select id="raison" required type="text" class="selectionForm" name="raison">
                        <option value='' selected='selected'> ----- </option>
                        <!-- Si $POST contient une raison alors on le récupère sinon on récupère le nom du moyen de la requête -->
                        <?php
                        if (isset($_POST['raison'])) {
                            $raison = $_POST['raison'];
                        } else {
                            $raison = $event['raison'];
                        }
                        ?>
                        <!-- Les différentes raisons de la réservation, possible d'en ajouter d'autre si nécessaire, et on sélectionne celui dans $raison-->
                        <option value='maintenance' <?= ($raison == 'maintenance') ? selected : ''; ?>><?= TXT_MAINTENANCE ?></option>
                        <option value='essai' <?= ($raison == 'essai') ? selected : ''; ?>> <?= TXT_ESSAI ?> </option>
                        <option value='formation' <?= ($raison == 'formation') ? selected : ''; ?>> <?= TXT_FORMATION ?> </option>
                    </select>
                </div>
                <div class="form-group">
                    <!-- Encadrant de l'utilisateur -->
                    <label for="encadrant"><?= TXT_ENCADRANT ?></label>
                    <!-- Si l'utilisateur courant est un doctorant alors il pourra choisir l'encadrant sinon la case est bloqué et vide-->
                    <select id="encadrant" required type="text" class="selectionForm" name="encadrant" <?= (isset($event['encadrant'])) ? '' : disabled; ?>>
                        <option value='' selected='selected'> ----- </option>
                        <?php
                        // Si $POST contient un encadrant alors on le récupère sinon on récupère l'encadrant de la requête 
                        if (isset($_POST['encadrant'])) {
                            $encadrant = $_POST['encadrant'];
                        } else {
                            $encadrant = $event['encadrant'];
                        }
                        $resu = $valider->afficherLesEncadrants();
                        //Parcourt tous les utilisateurs
                        foreach ($resu as $requ) : ?>
                            <!-- On ajoute les moyens dans le menu déroulant et on sélectionne celui dans $encadrant  -->
                            <option value='<?= $requ[0] ?>' <?= ($encadrant == $requ[0]) ? selected : ''; ?>> <?= $requ[0] ?> </option>
                        <?php endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-simple">
                <label for="axe_recherche"><?= TXT_AXE ?></label>
                <select id="axe_recherche" required type="text" class="selectionForm" name="axe_recherche">
                    <option value='' selected='selected'> ----- </option>
                    <!-- Si $POST contient un groupe alors on le récupère sinon on récupère le groupe de la requête  -->
                    <?php if (isset($_POST['axe_recherche'])) {
                        $g = $_POST['axe_recherche'];
                    } else {
                        $g = $event['axe_recherche'];
                    }
                    $groupe = $valider->afficherLesGroupes();
                    foreach ($groupe as $resultat) : ?>
                        <option value='<?= $resultat[0] ?>' <?= ($g == $resultat[0]) ? selected : ''; ?>> <?= $resultat[0] ?> </option>
                    <?php endforeach;
                    ?>
                </select>
            </div>
            <div class="desc">
                <div class="form-simple">
                    <!-- Description de la réservation (pas obligatoire) -->
                    <label for="description"><?= TXT_DESC ?></label>
                    <input id="description" name="description" class="form-control" value="<?= isset($event['description']) ? $event['description'] : ''; ?>"> </input>
                </div>
            </div>
        </div>
        <div class="boutonModif">
            <!-- Bouton modifier qui permet de mettre les données du formulaire dans le POST -->
            <button class="btn-primaryModif" type="submit" name="submit" value="Ajouter"><?= TXT_VALIDER ?></button>
            <!-- Bouton annuler qui supprime les données du formulaire -->
            <button class="btn-primaryModif" type="reset" name="reset" value="Annuler"><?= TXT_ANNULER ?></button>
        </div>
</div>
</form>
</div>
<?php
// Si le POST n'est pas vide et qu'il n'y a pas eu d'exceptions alors on envoie les mails et on ajoute la réservation dans la bdd
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $error == false) :
    $mail = $valider->envoieMailModif($_POST, $_GET['id']);
    if ($mail == true) {
        $req = $valider->modifierReservation($_POST, $_GET['id']);
    }
    // Si la modification à réussi alors on affiche un message de succès
    if ($req == true) : ?>
        <div class="container">
            <div class="success">
                <?= TXT_REUSSI_MODIF ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>