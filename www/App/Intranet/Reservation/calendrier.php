<?php
// --- SESSION ---
if (!session_id()) {
    session_start();
}

// --- INCLUSIONS CLASSES ---
require 'App/Intranet/Reservation/src/Month.php';
require 'App/Intranet/Reservation/src/Events.php';

// --- DÉTECTION DE LA LANGUE ---
$currentlang = get_bloginfo('language');
if (strpos($currentlang, 'fr') !== false) {
    include('App/lang-fr.php');
} elseif (strpos($currentlang, 'en') !== false) {
    include('App/lang-en.php');
} else {
    echo "Échec de reconnaissance de la langue";
}

// --- OBJETS ---
$evenement = new Events();

// --- MOIS ET ANNEE ---
$month = new Month($_GET['Month'] ?? -8, $_GET['Year'] ?? -8);
$_SESSION['month'] = $month;
$start = $month->getStartDay();
$start = $start->format('N') === '1' ? $start : $month->getStartDay()->modify("last monday");
$weeks = $month->getWeeks();
$end = (clone $start)->modify('+' . (6 + 7 * ($weeks - 1)) . ' days');

// --- GESTION FORMULAIRE / SESSION ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // catégorie
    $_SESSION['categorie_moyen_recherche'] = $_POST['categorie_moyen_recherche'] ?? null;

    // moyen
    if (isset($_POST['moyen_recherche'])) {
        $_SESSION['moyen_recherche'] = str_replace("\'", "'", $_POST['moyen_recherche']);
    }
} else {
    // initialisation si pas de POST
    if (!isset($_SESSION['categorie_moyen_recherche'])) {
        $cat = $evenement->afficherLesCategorie();
        $_SESSION['categorie_moyen_recherche'] = $cat[0][0];
    }
}

// --- VARIABLES UTILISÉES ---
$categorie = $_SESSION['categorie_moyen_recherche'];
$moy_selected = $_SESSION['moyen_recherche'] ?? null;

// --- RÉCUPÉRATION DES ÉVÉNEMENTS ---
$events = $evenement->getEventsBetweenByDay($start, $end, $categorie);

// Vérifie si le moyen sélectionné est valide pour cette catégorie
$moy_par_categorie = $evenement->getMoyenParCategorie($categorie);
foreach ($moy_par_categorie as $row) {
    if ($moy_selected === $row[0]) {
        $events = $evenement->getEventsBetweenByDayByMoyen($start, $end, $moy_selected);
        break;
    }
}

// URL du site
$site = site_url();
?>

<!-- ===== FORMULAIRE DE FILTRAGE ===== -->
<div class="contain_btn">
    <h1><?= $month->toString(); ?></h1>

    <form action="" method="POST" class="formulaire">
        <!-- Catégories -->
        <div class="categorie"><?= TXT_CAT_MOYEN ?></div>
        <select class="selection" name="categorie_moyen_recherche" onchange="this.form.submit()">
            <?php
            $categories = $evenement->afficherLesCategorie();
            foreach ($categories as $cat) :
                $selected = ($cat[0] === $categorie) ? 'selected' : ''; ?>
                <option value="<?= esc_attr($cat[0]) ?>" <?= $selected ?>><?= esc_html($cat[0]) ?></option>
            <?php endforeach; ?>
        </select>

        <!-- Moyens -->
        <div class="moyen"><?= TXT_MOYEN ?></div>
        <select name="moyen_recherche" class="selection" onchange="this.form.submit()">
            <option value="">-----</option>
            <?php
            foreach ($moy_par_categorie as $moy) :
                $selected = ($moy[0] === $moy_selected) ? 'selected' : ''; ?>
                <option value="<?= esc_attr($moy[0]) ?>" <?= $selected ?>><?= esc_html($moy[0]) ?></option>
            <?php endforeach; ?>
        </select>
    </form>

    <!-- Boutons mois précédent / suivant -->
    <div class="bouton">
        <a href="<?= $site ?><?= LIEN_CALENDRIER ?>/?Month=<?= $month->previousMonth()->getMonth(); ?>&Year=<?= $month->previousMonth()->getYear(); ?>" class="btn-primary"> &lt;</a>
        <a href="<?= $site ?><?= LIEN_CALENDRIER ?>/?Month=<?= $month->nextMonth()->getMonth(); ?>&Year=<?= $month->nextMonth()->getYear(); ?>" class="btn-primary"> &gt;</a>
    </div>
</div>

<!-- ===== CALENDRIER ===== -->
<div id="tableau">
    <table class="calendar__table calendar__table--<?= $weeks; ?>weeks">
        <tbody>
            <?php for ($i = 0; $i < $weeks; $i++) : ?>
                <tr>
                    <?php foreach ($month->getDays() as $k => $day) :
                        $date = (clone $start)->modify("+" . ($k + $i * 7) . " days");
                        $eventsForDay = $events[$date->format('Y-m-d')] ?? []; ?>
                        <td class="<?= $month->withinMonth($date) ? '' : 'calendar__othermonth'; ?>">
                            <?php if ($i === 0) : ?>
                                <div class="calendar__weekday"><?= $day ?></div>
                            <?php endif; ?>

                            <div class="calendar__day"><?= $date->format('d'); ?></div>

                            <?php $e = 0;
                            foreach ($eventsForDay as $event) : $e++; ?>
                                <div class="<?= $month->withinMonth($date) ? 'calendar__event' : 'calendar__event__othermonth'; ?>">
                                    <a href="<?= $site ?><?= LIEN_JOURNEE ?>?date_jour=<?= $date->format('Y-m-d'); ?>">
                                        <?php if ($e == 4) : ?>
                                            ...
                                        <?php elseif ($e > 4) : ?>
                                            <!-- rien -->
                                        <?php else : ?>
                                            - <strong><?= esc_html($event['titre_reservation']); ?></strong> | <?= esc_html($event['nom_moyen']); ?>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>