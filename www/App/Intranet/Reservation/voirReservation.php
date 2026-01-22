<!-- Ce fichier permet d'afficher une réservation 
Ce fichier est utilisé dans la page Réservations 
Ce fichier utilise Events.php -->
<?php
require 'App/Intranet/Reservation/src/Events.php';
//détection de langue courante de la page
$currentlang = get_bloginfo('language');
if (strpos($currentlang, 'fr') !== false) {
    include('App/lang-fr.php');
} elseif (strpos($currentlang, 'en') !== false) {
    include('App/lang-en.php');
} else {
    echo ("échec de reconnaissance de la langue");
}
$events = new Events();
$site = site_url();
// Envoie un message d'erreur si $_GET['id'] est vide
if (!isset($_GET['id'])) {
    header('Location: ' . $site . '' . LIEN_CALENDRIER . '');
}
$event = $events->GetEventById($_GET['id']);
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
<?php
$representant = $events->getResponsables($event['nom_moyen']);
$current_user = wp_get_current_user();
$id = get_current_user_id();
$user_info = get_userdata($id);
$user_roles = $user_info->roles;
$uti = $current_user->display_name;
$nom_uti_courant = $events->afficherNom($uti);
// Si l'utilisateur courant est celui qui à réservé ou le responsable du moyen alors on affiche les 2 boutons
if ($nom_uti_courant == $event['nom_utilisateur'] || $nom_uti_courant == $representant[0] || $nom_uti_courant == $representant[1] || $nom_uti_courant == $representant[3] || $user_roles[0] == 'administrator') : ?>
    <div class="container-bouton">
        <div class="bouton">
            <!-- Bouton Modifier permet de modifier la réservation, ramène à la page Modifier une réservation -->
            <a href="<?= $site ?><?= LIEN_MODIFIER ?>/?id=<?= $_GET['id'] ?>" class="btn-primaryModif"><?= TXT_MODIFIER ?></a>
            <!-- Bouton supprimer permet de supprimer la réservation, ramène à la page Supprimer une réservation -->
            <a href="<?= $site ?><?= LIEN_SUPPRIMER ?>/?id=<?= $_GET['id'] ?> " class="btn-primaryModif"><?= TXT_SUPPRIMER ?></a>
        </div>
    </div>
<?php endif;
?>