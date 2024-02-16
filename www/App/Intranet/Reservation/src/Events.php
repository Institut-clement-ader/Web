<!-- Ce fichier permet de récupérer les événements (réservations) en fonction de différentes options
Ce fichier est utilisé dans afficherjournee.php, calendrier.php, getCalendrier.php, getTableau.php, getMoyen.php, mesReservation.php, supprimerReservation.php, tableauReservation.php et voirReservation.php -->

<?php
//Importe GestionBdd
require("App/GestionBdd.php");
class Events
{
    private $bdd;
    // Constructeur 
    public function __construct()
    {
        $this->bdd = new GestionBdd();
    }
    // Récupère les évènements qui sont entre 2 dates
    public function getEventsBetween(DateTime $start, DateTime $end, $categorie)
    {
        $results = $this->bdd->dateDansUnMois($start, $end, $categorie);
        return $results;
    }
    // Récupère les évènements qui sont entre 2 dates indexé par jour 
    public function getEventsBetweenByDay(DateTime $start, DateTime $end, $categorie)
    {
        $events = $this->getEventsBetween($start, $end, $categorie);
        $days = [];
        //Pour chaque événement entre les deux dates, on récupère la date de début, de fin et de toutes les dates entre la date de début et de fin 
        foreach ($events as $event) {
            $dated = explode(' ', $event['date_debut'])[0];
            $datef = explode(' ', $event['date_fin'])[0];
            $datedeb = new DateTime($dated);
            $datefin = new DateTime($datef);
            $datefin = $datefin->modify('+1 day');
            $interval = DateInterval::createFromDateString('1 day');
            $daterange = new DatePeriod($datedeb, $interval, $datefin);
            //Pour chaque date dans l'événement on le met dans un tableau 
            foreach ($daterange as $date) {
                //Si le tableau contient déjà la date alors on ajoute l'événement à la date sinon on ajoute la date ainsi que l'événement à la date  
                if (!isset($days[$date->format("Y-m-d")])) {
                    $days[$date->format("Y-m-d")] = [$event];
                } else {
                    $days[$date->format("Y-m-d")][] = $event;
                }
            }
        }
        return $days;
    }
    // Récupère les évènements commençant entre 2 dates indéxées par jour et par moyen
    public function getEventsBetweenByDayByMoyen(DateTime $start, DateTime $end, $moyen)
    {
        $events = $this->bdd->dateDansUnMoisParMoyen($start, $end, $moyen);
        $days = [];
        //Pour chaque événement entre les deux dates, on récupère la date de début, de fin et de tous les dates entre la date de début et de fin 
        foreach ($events as $event) {
            $dated = explode(' ', $event['date_debut'])[0];
            $datef = explode(' ', $event['date_fin'])[0];
            $datedeb = new DateTime($dated);
            $datefin = new DateTime($datef);
            $datefin = $datefin->modify('+1 day');
            $interval = DateInterval::createFromDateString('1 day');
            $daterange = new DatePeriod($datedeb, $interval, $datefin);
            //Pour chaque date dans l'événement on le met dans un tableau 
            foreach ($daterange as $date) {
                //Si le tableau contient déjà la date alors on ajoute l'événement à la date sinon on ajoute la date ainsi que l'événement à la date  
                if (!isset($days[$date->format("Y-m-d")])) {
                    $days[$date->format("Y-m-d")] = [$event];
                } else {
                    $days[$date->format("Y-m-d")][] = $event;
                }
            }
        }
        return $days;
    }
    // Affiche le nom et le prénom de l'utilisateur
    public function afficherNom($nom)
    {
        $req = $this->bdd->getNom($nom);
        $results = $req[0][0] . ' ' . $req[1][0];
        return $results;
    }
    // Affiche tous les groupes de l'utilisateur
    public function afficherLesGroupes()
    {
        $req = $this->bdd->getGroupe();
        return $req;
    }
    // Cherche un événement en fonction du jour et d'une catégorie donnée 
    public function getEventByDayAndCategorie(DATETIME $date_jour, $categorie)
    {
        $results = $this->bdd->getParJourEtCategorie($date_jour, $categorie);
        return $results;
    }
    // Cherche un événement en fonction du jour et d'un moyen donnée 
    public function getEventByDayAndMoyen(DateTime $date_jour, $moyen)
    {
        $results = $this->bdd->getParJourEtMoyen($date_jour, $moyen);
        return $results;
    }
    // Cherche tous les moyens en fonction de la catégorie 
    public function getMoyenParCategorie($categorie)
    {
        $results = $this->bdd->getMoyensCategorie($categorie);
        return $results;
    }
    // Cherche tous les responsables des moyens 
    public function getResponsables($moyen)
    {
        $results = $this->bdd->getResponsablesParMoyen($moyen);
        return $results;
    }
    // Cherche un événement par son id
    public function getEventById(int $id)
    {
        $results = $this->bdd->getReservationByID($id);
        return $results;
    }
    // Supprime un événement en fonction de son ID
    public function deleteEventById(int $id)
    {
        $results = $this->bdd->deleteReservationByID($id);
        return $results;
    }
    // Cherche tous les événements en fonction de son titre 
    public function getEventByName($nom, $deb, $fin)
    {
        $results = $this->bdd->getReservationByNom($nom, $deb, $fin);
        return $results;
    }
    // Cherche tous les événements en fonction de la catégorie du moyen associé 
    public function getEventsByCategorie($categorie, $datedeb, $datefin)
    {
        $results = $this->bdd->getReservationParCatégorie($categorie, $datedeb, $datefin);
        return $results;
    }
    // Cherche tous les événements en fonction de la catégorie du moyen et de l'utilisateur associé 
    public function getEventsByCategorieAndUser($categorie, $uti, $datedeb, $datefin)
    {
        $results = $this->bdd->getReservationParCatégorieEtUtilisateur($categorie, $uti, $datedeb, $datefin);
        return $results;
    }
    // Cherche tous les événements en fonction du moyen associé
    public function getEventsByMoyen($moyen, $datedeb, $datefin)
    {
        $results = $this->bdd->getReservationParMoyen($moyen, $datedeb, $datefin);
        return $results;
    }
    // Cherche tous les événements en fonction du moyen et de l'utilisateur associé
    public function getEventsByMoyenAndUser($moyen, $uti, $datedeb, $datefin)
    {
        $results = $this->bdd->getReservationParMoyenEtUtilisateur($moyen, $uti, $datedeb, $datefin);
        return $results;
    }
    // Cherche toutes les catégories des différents moyens 
    public function afficherLesCategorie()
    {
        $results = $this->bdd->getCategorie();
        return $results;
    }
    // Cherche les utilisateurs qui ont réservé le moyen donné
    public function getUtiEventsByMoyen($moyen, $deb, $fin)
    {
        $results = $this->bdd->getUtiReservationParMoyen($moyen, $deb, $fin);
        return $results;
    }
    //  Cherche les utilisateur qui ont réservé un moyen qui est contenu dans la catégorie donné
    public function getUtiEventsByCategorie($categorie, $deb, $fin)
    {
        $results = $this->bdd->getUtiReservationParCatégorie($categorie, $deb, $fin);
        return $results;
    }
    // Affiche le moyen d'un responsable
    public function afficherMoyenResponsable($nom, $deb, $fin)
    {
        $results = $this->bdd->getMoyenByResponsable($nom, $deb, $fin);
        return $results;
    }
    // Affiche les réservations des groupes
    public function afficherReservationGroupeMoyen($groupe, $deb, $fin, $moyen)
    {
        $results = $this->bdd->getReservationByGroupeAndMoyen($groupe, $deb, $fin, $moyen);
        return $results;
    }
    // Affiche tous les moyens réserver
    public function afficherToutMoyen($deb, $fin)
    {
        $results = $this->bdd->getAllMoyen($deb, $fin);
        return $results;
    }
}
