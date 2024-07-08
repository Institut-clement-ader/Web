<!-- Ce fichier permet de vérifier les différentes exceptions pour la création d'une réservation
Ce fichier est utilisé dans ajouterReservation.php et modifierReservation.php 

TODO
Ajouter mail suppression de reservation
Optimiser l'envoie de mail au(x) responsable(s)

-->

<?php
// Importe GestionBdd
require("App/GestionBdd.php");
class Reservation
{
    private $bdd;
    // Constructeur 
    public function __construct()
    {
        $this->bdd = new GestionBdd();
    }
    // Vérifie si la date de début de la réservation est supérieure à la date de fin 
    public function chevauchement2jours(DATETIME $jourDebut, DATETIME $jourFin)
    {
        if ($jourDebut > $jourFin) {
            return true;
        } else {
            return false;
        }
    }
    // Vérifie si l'heure de début de la réservation est supérieure à l'heure de fin s'ils ont la même date 
    public function chevauchement2heures(DATETIME $heureDebut, DATETIME $heureFin)
    {
        if ($heureDebut >= $heureFin) {
            return true;
        } else {
            return false;
        }
    }
    // Ajoute la réservation dans la bdd
    public function creationReservation(array $data)
    {
        $titre_reservation = $data['titre_reservation'];
        $nom_utilisateur = $data['nom_utilisateur'];
        // Récupère le nom du moyen avec les ' sans \
        $nom_moyen = str_replace("\'", "'", $data['nom_moyen']);
        $axe_recherche = $data['axe_recherche'];
        $encadrant = $data['encadrant'];
        $description = $data['description'];
        $raison = $data['raison'];
        $date_debut = $this->fusionDateEtHeure($data['date_debut'], $data['heure_debut']);
        $date_fin = $this->fusionDateEtHeure($data['date_fin'], $data['heure_fin']);
        $contact_resp = $data['ask_reservation'];
        $req = $this->bdd->creerReservation($titre_reservation, $nom_utilisateur, $nom_moyen, $date_debut, $date_fin, $axe_recherche, $encadrant, $description, $raison, $contact_resp);
        $results = $this->bdd->getId($nom_moyen, $date_debut, $date_fin);
        return $results;
        return $req;
    }
    // Vérifie si le moyen de la réservation n'est pas déjà réservé pendant l'intervalle des dates
    public function chevauchementMemeMoyen(array $data)
    {
        $date_debut = $this->fusionDateEtHeure($data['date_debut'], $data['heure_debut']);
        $date_fin = $this->fusionDateEtHeure($data['date_fin'], $data['heure_fin']);
        // Ajoute une minute à la date de début pour permettre de commencer une réservation à 17h00 même si une réservation se termine à 17h00
        $date_debut = $date_debut->modify('+1 minutes');
        // Enlève une minute à la date de fin pour permettre de terminer une réservation à 17h00 même si une réservation commence à 17h00
        $date_fin = $date_fin->modify('-1 minutes');
        // Récupère le nom du moyen avec les ' sans \
        $moyen = str_replace("\'", "'", $data['nom_moyen']);
        $req = $this->bdd->verificationChevauchementMemeMoyen($moyen, $date_debut, $date_fin);
        return $req;
    }
    // Fusionne la date et l'heure 
    public function fusionDateEtHeure($date, $heure)
    {
        $date_time = new DATETIME($date . ' ' . $heure);
        return $date_time;
    }
    // Sépare la date et l'heure 
    public function separeDateEtHeure($date)
    {
        $resultat_date = explode(' ', $date);
        return $resultat_date;
    }
    // Recherche les moyens en fonction de leur catégorie 
    public function getMoyenParCategorie($categorie)
    {
        $results = $this->bdd->getMoyensCategorie($categorie);
        return $results;
    }
    // Affiche tous les encadrants possibles 
    public function afficherLesEncadrants()
    {
        $req = $this->bdd->getEncadrantPossible();
        return $req;
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
    // Recherche une réservation en fonction de son id
    public function getEventById(int $id)
    {
        $results = $this->bdd->getReservationByID($id);
        return $results;
    }

    public function getList($categorie)
    {
        $results = $this->bdd->getList($categorie);
        return $results;
    }
    // Modife la réservation dans la bdd
    public function modifierReservation($data, $id)
    {
        $titre_reservation = $data['titre_reservation'];
        $nom_utilisateur = $data['nom_utilisateur'];
        // Récupère le nom du moyen avec les ' sans \
        $moyen = str_replace("\'", "'", $data['nom_moyen']);
        $axe_recherche = $data['axe_recherche'];
        $encadrant = $data['encadrant'];
        $description = $data['description'];
        $raison = $data['raison'];
        $date_debut = $this->fusionDateEtHeure($data['date_debut'], $data['heure_debut']);
        $date_fin = $this->fusionDateEtHeure($data['date_fin'], $data['heure_fin']);
        $req = $this->bdd->updateReservationById($id, $titre_reservation, $nom_utilisateur, $moyen, $date_debut, $date_fin, $axe_recherche, $encadrant, $description, $raison);
        return $req;
    }

    // Supprime un événement en fonction de son ID
    public function deleteReservation(int $id)
    {
        $results = $this->bdd->deleteReservationByID($id);
        return $results;
    }

    // Vérifie si le moyen de la réservation n'est pas déjà réservé pendant l'intervalle des dates (mais ne prends pas en compte la réservation qui est modifiée)
    public function chevauchementMemeMoyenIdDifferent(array $data, $id)
    {
        $date_debut = $this->fusionDateEtHeure($data['date_debut'], $data['heure_debut']);
        $date_fin = $this->fusionDateEtHeure($data['date_fin'], $data['heure_fin']);
        // Ajoute une minute à la date de début pour permettre de commencer une réservation à 17h00 même si une réservation se termine à 17h00
        $date_debut_p = $date_debut->modify('+1 minutes');
        // Enlève une minute à la date de fin pour permettre de terminer une réservation à 17h00 même si une réservation commence à 17h00
        $date_fin_p = $date_fin->modify('-1 minutes');
        // Récupère le nom du moyen avec les ' sans \
        $moyen = str_replace("\'", "'", $data['nom_moyen']);
        $req = $this->bdd->verificationChevauchementMemeMoyenIdDifferent($id, $moyen, $date_debut, $date_fin);
        return $req;
    }
    // Vérifie si l'utilisateur de la réservation n'est pas déjà dans une autre réservation pendant l'intervalle des dates (mais ne prends pas en compte la réservation qui est modifiée)
    public function chevauchementMemeUtilisateurIdDifferent(array $data, $id)
    {
        $date_debut = $this->fusionDateEtHeure($data['date_debut'], $data['heure_debut']);
        $date_fin = $this->fusionDateEtHeure($data['date_fin'], $data['heure_fin']);
        // Ajoute une minute à la date de début pour permettre de commencer une réservation à 17h00 même si une réservation se termine à 17h00
        $date_debut_p = $date_debut->modify('+1 minutes');
        // Enlève une minute à la date de fin pour permettre de terminer une réservation à 17h00 même si une réservation commence à 17h00
        $date_fin_p = $date_fin->modify('-1 minutes');
        $req = $this->bdd->verificationChevauchementMemeUtilisateurIdDifferent($id, $data['nom_utilisateur'], $date_debut, $date_fin);
        return $req;
    }

    function mailBody(array $data, $id, $mail, $current_user)
    {
        $headers = array('Content-Type: text/html; charset=UTF-8');
        $site = site_url();
        $titre = $data['titre_reservation'];
        $user = $data['nom_utilisateur'];
        $user_email = $current_user->user_email;
        $user_login = $current_user->user_login;
        // Récupère le nom du moyen avec les ' sans \
        $moyen =  $moyen = str_replace("\'", "'", $data['nom_moyen']);
        $contact = $data['ask_reservation'];
        $date_debut = (new DATETIME($data['date_debut']))->format('d/m/Y');
        $date_fin = (new DATETIME($data['date_fin']))->format('d/m/Y');
        $heure_debut = $data['heure_debut'];
        $heure_fin = $data['heure_fin'];
        $groupe = $data['axe_recherche'];
        $description = $data['description'];

        if ($contact == 1) {
            $contact = "Le responsable a été contacté.";
        } else {
            $contact = "Le responsable n'a pas été contacté.";
        }

        wp_mail(
            $mail,
            'Nouvelle réservation : ' . $moyen,
            'Bonjour,
    
    Une nouvelle réservation vient d\'être déposée :

    Nom : ' . $user . ' ' . $user_email . '
    Profil :  ' . $site . '/author/' . $user_login . '
    Groupe : ' . $groupe . '
    Moyen : ' . $moyen . ' 
        du ' . $date_debut . ' à ' . $heure_debut . ' 
        au ' . $date_fin . ' à ' . $heure_fin . '

    Titre : ' . $titre . '
    Description : ' . $description . '

    ' . $contact . ' 

    Vous pouvez accéder à ce lien pour avoir plus de détails : ' . $site . '/voir-une-reservation/?id=' . $id . '',
            'Bonjour,',
            $headers
        );
    }
    // Envoie un mail au responsable pour chaque ajout
    public function envoieMailAjout(array $data, $id, $current_user)
    {
        $moyen =  $moyen = str_replace("\'", "'", $data['nom_moyen']);
        $mails = $this->bdd->rechercheMailRespsonsablesMoyens($moyen);
        foreach ($mails as  $mail) {
            // Vérifie s'il existe au moins un responsable alors on lui envoie un mail
            if (isset($mail)) {
                $this->mailBody($data, $id, $mail, $current_user);
            }
        }
        return true;
    }
    //Recherche les différentes catégories
    public function afficherLesCategorie()
    {
        $results = $this->bdd->getCategorie();
        return $results;
    }


    // affiche l'id de la réservation
    public function afficherIdReservation($data)
    {
    }
    // Envoie un mail au responsable pour chaque modification
    public function  envoieMailModif(array $data, $id)
    {
        $user = $data['nom_utilisateur'];
        // Récupère le nom du moyen avec les ' sans \
        $site = site_url();
        $moyen =  $moyen = str_replace("\'", "'", $data['nom_moyen']);
        $date_debut = (new DATETIME($data['date_debut']))->format('d/m/Y');
        $date_fin = (new DATETIME($data['date_fin']))->format('d/m/Y');
        $heure_debut = $data['heure_debut'];
        $heure_fin = $data['heure_fin'];
        $groupe = $data['axe_recherche'];
        $mails = $this->bdd->rechercheMailRespsonsablesMoyens($moyen);
        foreach ($mails as  $mail) {
            // Vérifie s'il existe au moins un responsable alors on lui envoie un mail
            if (isset($mail)) {
                wp_mail($mail, 'Modification d\'une réservation : ' . $moyen, 'Bonjour,
        
            Une réservation vient d\'être modifié:
            nom: ' . $user . '
            groupe: ' . $groupe . '
            moyen: ' . $moyen . ' 
            du ' . $date_debut . ' à ' . $heure_debut . ' 
            au ' . $date_fin . ' à ' . $heure_fin . '
            vous pouvez accéder a ce lien pour avoir plus de détails: ' . $site . '/voir-une-reservation/?id=' . $id . '', 'Bonjour,');
            }
        }

        return true;
    }
    // Envoie un mail au responsable pour chaque modification
    public function  envoieMailSup(array $data, $reservation)
    {
        $user = $reservation['nom_utilisateur'];
        // Récupère le nom du moyen avec les ' sans \
        $moyen =  $moyen = str_replace("\'", "'", $reservation['nom_moyen']);
        $date_debut = (new DATETIME($reservation['date_debut']))->format('d/m/Y');
        $date_fin = (new DATETIME($reservation['date_fin']))->format('d/m/Y');
        $heure_debut = $reservation['heure_debut'];
        $heure_fin = $reservation['heure_fin'];
        $groupe = $reservation['axe_recherche'];
        $raison_sup = $data['raison_sup'];
        $description_sup = $data['description_sup'];
        $mails = $this->bdd->rechercheMailRespsonsablesMoyens($moyen);
        foreach ($mails as  $mail) {
            // Vérifie s'il existe au moins un responsable alors on lui envoie un mail
            if (isset($mail)) {
                wp_mail($mail, 'Suppression d\'une réservation : ' . $moyen, 'Bonjour,
        
            Une réservation vient d\'être supprimée:
            nom: ' . $user . '
            groupe: ' . $groupe . '
            moyen: ' . $moyen . ' 
            du ' . $date_debut . ' à ' . $heure_debut . ' 
            au ' . $date_fin . ' à ' . $heure_fin . '
            
            Pour le motif  : ' . $raison_sup . '
            description : ' . $description_sup);
            }
        }
        return true;
    }
}

?>