<!-- Ce fichier permet d'afficher les réservations sous forme de calendrier, il permet aussi de filtrer les réservations avec les catégories ou directement le moyen 
Ce fichier est utilisé dans la page Calendrier 
Ce fichier utilise Month.php et Events.php-->
<?php
require 'App/Intranet/Reservation/src/Month.php';
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
session_start();
// Récupération du nom du nom du domaine du site
$site = site_url();
$evenement = new Events();
// Création de la variable month issue de la classe Month (s'il n'y a rien dans les get alors on affiche le mois et l'année actuelle)
$month = new Month($_GET['Month'] ?? -8, $_GET['Year'] ?? -8);
$_SESSION['month'] = $month;
$start = $month->getStartDay();
$start = $start->format('N') === '1' ? $start : $month->getStartDay()->modify("last monday");
$weeks = $month->getWeeks();
$end = (clone $start)->modify('+' . (6 + 7 * ($weeks - 1)) . ' days');
// S'il y a du contenu dans le POST alors on met le POST de la catégorie dans la session 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categorie = $_POST['categorie_moyen_recherche'];
    $_SESSION['categorie_moyen_recherche'] = $categorie;
    // Si dans le POST on a un moyen alors on le récupére et on le met dans la session
    if (isset($_POST['moyen_recherche'])) {
        // Récupère le nom du moyen avec les ' sans \
        $moyen = str_replace("\'", "'", $_POST['moyen_recherche']);
        $_SESSION['moyen_recherche'] = $moyen;
    }
} else {
    // Si la SESSION contient une catégorie alors on la récupère sinon on met la catégorie qui est la premier sur la liste (Simulateur numérique)
    if (isset($_SESSION['categorie_moyen_recherche'])) {
        $categorie = $_SESSION['categorie_moyen_recherche'];
    } else {
        $cat = $evenement->afficherLesCategorie();
        $categorie = $cat[0]['categorie'];
        $_SESSION['categorie_moyen_recherche'] = $categorie;
    }
}
$events = $evenement->getEventsBetweenByDay($start, $end, $categorie);
$moy = $evenement->getMoyenParCategorie($categorie);
// Parcourt tous les moyens contenus dans la requête
foreach ($moy as $row) {
    // Si le moyen est le même que la session alors on exécute la requête avec ce moyen
    if ($_SESSION['moyen_recherche'] == $row['nom_moyen']) {
        $events = $evenement->getEventsBetweenByDayByMoyen($start, $end, $_SESSION['moyen_recherche']);
    }
}
?>
<div class="contain_btn">
    <!-- Affiche le mois et l'année -->
    <h1><?= $month->toString(); ?></h1>
    <!-- Début du choix de la catégorie et du moyen (pour filtrer) -->
    <form action='' method='POST' class='formulaire'>
        <!-- menu déroulant des différentes catégories -->
        <div class="categorie"><?= TXT_CAT_MOYEN ?></div>
        <select class="selection" name='categorie_moyen_recherche' id="show">
            <?php
            $res = $evenement->afficherLesCategorie(); ?>
            <!-- Parcourt toutes les catégories de la requête   -->
            <?php foreach ($res as $requ) :
                $resu = $evenement->getMoyenParCategorie($requ[0]);
                if (count($resu) != 0) : ?>
                    <!-- On ajoute les catégorie dans le menu déroulant et on sélectionne la catégorie de la SESSION -->
                    <option value="<?= $requ[0] ?>" <?= ($_SESSION['categorie_moyen_recherche'] == $requ[0]) ? selected : ''; ?>> <?= $requ[0] ?> </option>
            <?php endif;
            endforeach;
            ?>
        </select>
        <!-- Menu déroulant des différents moyens -->
        <div class="moyen"><?= TXT_MOYEN ?> </div>
        <!-- L'id moyen est utilisé dans le JavaScript pour faire appel à getMoyen.php  -->
        <select id='moyen' name='moyen_recherche' class="selection">
            <option value='' selected='selected'> ----- </option>
            <?php
            $resu = $evenement->getMoyenParCategorie($categorie);
            // Parcourt tous les moyens de la requête 
            foreach ($resu as $requ) :  ?>
                <!-- On ajoute les moyens dans le menu déroulant et on sélectionne le moyen de la SESSION- -->
                <option value="<?= strval($requ[0]) ?>" <?= ($_SESSION['moyen_recherche'] == $requ[0]) ? selected : ''; ?>> <?= strval($requ[0]) ?> </option>
            <?php endforeach;
            ?>
        </select>
    </form>
    <!-- Les boutons pour passer au moins suivant ou précédent -->
    <div class="bouton">
        <a href="<?= $site ?><?= LIEN_CALENDRIER ?>/?Month=<?= $month->previousMonth()->getMonth(); ?>&Year=<?= $month->previousMonth()->getYear(); ?>" class="btn-primary"> &lt;</a>
        <a href="<?= $site ?><?= LIEN_CALENDRIER ?>/?Month=<?= $month->nextMonth()->getMonth(); ?>&Year=<?= $month->nextMonth()->getYear(); ?>" class="btn-primary"> &gt;</a>
    </div>
</div>
<!-- L'id tableau est utilisé dans le JavaScript pour faire appel à getCalendrier.php  -->
<div id='tableau'>
    <!-- Début du calendrier -->
    <table class="calendar__table calendar__table--<?= $weeks; ?>weeks">
        <tbody>
            <?php
            // Parcourt toutes les semaines du mois
            for ($i = 0; $i < $weeks; $i++) : ?>
                <tr>
                    <?php
                    // Parcourt les différents jours du mois
                    foreach ($month->getDays() as $k => $day) :
                        $date = (clone $start)->modify("+" . ($k + $i * 7) . " days");
                        $within = $date;
                        $eventsForDay = $events[$date->format('Y-m-d')] ?? []; ?>
                        <!-- Si le jour n'est pas dans le mois (semaine qui chevauche deux mois) alors on rend le numéro du jour gris -->
                        <td class="<?= $month->withinMonth($date) ? '' :  'calendar__othermonth'; ?>">
                            <!-- Si c'est la première semaine alors on affiche le jour  -->
                            <?php if ($i == 0) : ?>
                                <div class="calendar__weekday"><?= $day; ?> </div>
                            <?php endif;
                            // $e permet d'éviter qu'il y a trop de réservations afficher le même jour
                            $e = 0; ?>
                            <div class="calendar__day"><?= $date->format('d'); ?> </div>
                            <!-- Parcourt tous les événements de la journée -->
                            <?php foreach ($eventsForDay as $event) : ?>
                                <!-- Si le jour n'est pas dans le mois (semaine qui chevauche deux mois) alors on rend la réservation du jour gris -->
                                <div class=<?= $month->withinMonth($within) ? 'calendar__event' :  'calendar__event__othermonth'; ?>>
                                    <a href="<?= $site ?><?= LIEN_JOURNEE ?>?date_jour=<?= $date->format('Y-m-d'); ?>">
                                        <?php
                                        $e += 1;
                                        // Si $e est égal à 4 on rien ... (pour éviter le surcharge d'information) 
                                        if ($e == 4) : ?>
                                            ...
                                            <!-- Si $e est supérieur à 4 alors on affiche rien-->
                                        <?php elseif ($e > 4) : ?>

                                            <!-- Sinon on affiche la réservartion -->
                                        <?php else : ?>
                                            - <strong> <?= $event['titre_reservation']; ?> </strong> | <?= $event['nom_moyen']; ?>
                                        <?php endif;
                                        ?>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </td>
                    <?php endforeach;
                    ?>
                </tr>
            <?php endfor;
            ?>
        </tbody>
    </table>
</div>