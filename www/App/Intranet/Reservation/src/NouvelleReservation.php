<!-- Ce fichier permet de vérifier les différentes exceptions pour la création d'une réservation
Ce fichier est utilisé dans ajouterReservation.php et modifierReservation.php -->

<?php
// Importe GestionBdd
require("App/GestionBdd.php");
class NouvelleReservation{
    private $bdd;
    // Constructeur 
    public function __construct(){
        $this->bdd= new GestionBdd();
    }
    // Vérifie si la date de début de la réservation est supérieure à la date de fin 
    public function chevauchement2jours(DATETIME $jourDebut, DATETIME $jourFin){
        if($jourDebut > $jourFin){
            return true;
        }else {
            return false;
        }
    }
    // Vérifie si l'heure de début de la réservation est supérieure à l'heure de fin s'ils ont la même date 
    public function chevauchement2heures(DATETIME $heureDebut, DATETIME $heureFin){
        if($heureDebut >= $heureFin){
            return true;
        }else {
            return false;
        }
    }
    // Ajoute la réservation dans la bdd
    public function creationReservation(array $data){
        $titre_reservation= $data['titre_reservation'];
        $nom_utilisateur=$data['nom_utilisateur'];
        // Récupère le nom du moyen avec les ' sans \
        $nom_moyen= str_replace("\'", "'", $data['nom_moyen']); 
        $axe_recherche=$data['axe_recherche'];
        $encadrant=$data['encadrant'];
        $description=$data['description'];
        $raison=$data['raison'];
        $date_debut= $this->fusionDateEtHeure($data['date_debut'],$data['heure_debut']);
        $date_fin= $this->fusionDateEtHeure($data['date_fin'],$data['heure_fin']);
        $req= $this->bdd->creerReservation($titre_reservation,$nom_utilisateur,$nom_moyen,$date_debut,$date_fin,$axe_recherche,$encadrant,$description,$raison);
        $results=$this->bdd->getId($nom_moyen,$date_debut,$date_fin);
        return $results;
        return $req;
    }
    // Vérifie si le moyen de la réservation n'est pas déjà réservé pendant l'intervalle des dates
    public function chevauchementMemeMoyen(array $data){   
        $date_debut= $this->fusionDateEtHeure($data['date_debut'],$data['heure_debut']);
        $date_fin= $this->fusionDateEtHeure($data['date_fin'],$data['heure_fin']);
        // Ajoute une minute à la date de début pour permettre de commencer une réservation à 17h00 même si une réservation se termine à 17h00
        $date_debut= $date_debut->modify('+1 minutes');
        // Enlève une minute à la date de fin pour permettre de terminer une réservation à 17h00 même si une réservation commence à 17h00
        $date_fin= $date_fin->modify('-1 minutes');
        // Récupère le nom du moyen avec les ' sans \
        $moyen= str_replace("\'", "'", $data['nom_moyen']); 
        $req= $this->bdd->verificationChevauchementMemeMoyen($moyen,$date_debut,$date_fin);
        return $req;
    }
    // Fusionne la date et l'heure 
    public function fusionDateEtHeure($date,$heure){
        $date_time = new DATETIME($date.' '.$heure);
        return $date_time;  
    }
    // Sépare la date et l'heure 
    public function separeDateEtHeure($date){
        $resultat_date = explode(' ', $date);
        return $resultat_date;  
    }
    // Recherche les moyens en fonction de leur catégorie 
    public function getMoyenParCategorie($categorie){
        $results = $this->bdd->getMoyensCategorie($categorie);
        return $results;
    }
    // Affiche tous les encadrants possibles 
    public function afficherLesEncadrants(){
        $req=$this->bdd->getEncadrantPossible();
        return $req;
    }
    // Affiche le nom et le prénom de l'utilisateur
    public function afficherNom($nom){
        $req=$this->bdd->getNom($nom);
        $results=$req[0][0].' '.$req[1][0];
        return $results;
    }
    // Affiche tous les groupes de l'utilisateur
    public function afficherLesGroupes(){
        $req=$this->bdd->getGroupe();
        return $req;
    }
    // Recherche une réservation en fonction de son id
    public function getEventById(int $id){
        $results = $this->bdd->getReservationByID($id);
        return $results;
    }
    // Modife la réservation dans la bdd
    public function modifierReservation($data,$id){
        $titre_reservation= $data['titre_reservation'];
        $nom_utilisateur=$data['nom_utilisateur'];
        // Récupère le nom du moyen avec les ' sans \
        $moyen= str_replace("\'", "'", $data['nom_moyen']); 
        $axe_recherche=$data['axe_recherche'];
        $encadrant=$data['encadrant'];
        $description=$data['description'];
        $raison=$data['raison'];
        $date_debut= $this->fusionDateEtHeure($data['date_debut'],$data['heure_debut']);
        $date_fin= $this->fusionDateEtHeure($data['date_fin'],$data['heure_fin']);
        $req= $this->bdd->updateReservationById($id,$titre_reservation,$nom_utilisateur,$moyen,$date_debut,$date_fin,$axe_recherche,$encadrant,$description,$raison);
        return $req;
    }

    // Vérifie si le moyen de la réservation n'est pas déjà réservé pendant l'intervalle des dates (mais ne prends pas en compte la réservation qui est modifiée)
    public function chevauchementMemeMoyenIdDifferent(array $data,$id){
        $date_debut= $this->fusionDateEtHeure($data['date_debut'],$data['heure_debut']);
        $date_fin= $this->fusionDateEtHeure($data['date_fin'],$data['heure_fin']);
        // Ajoute une minute à la date de début pour permettre de commencer une réservation à 17h00 même si une réservation se termine à 17h00
        $date_debut_p= $date_debut->modify('+1 minutes');
        // Enlève une minute à la date de fin pour permettre de terminer une réservation à 17h00 même si une réservation commence à 17h00
        $date_fin_p= $date_fin->modify('-1 minutes');
        // Récupère le nom du moyen avec les ' sans \
        $moyen= str_replace("\'", "'", $data['nom_moyen']); 
        $req= $this->bdd->verificationChevauchementMemeMoyenIdDifferent($id,$moyen,$date_debut,$date_fin);
        return $req;
    }
     // Vérifie si l'utilisateur de la réservation n'est pas déjà dans une autre réservation pendant l'intervalle des dates (mais ne prends pas en compte la réservation qui est modifiée)
    public function chevauchementMemeUtilisateurIdDifferent(array $data,$id){   
        $date_debut= $this->fusionDateEtHeure($data['date_debut'],$data['heure_debut']);
        $date_fin= $this->fusionDateEtHeure($data['date_fin'],$data['heure_fin']);
        // Ajoute une minute à la date de début pour permettre de commencer une réservation à 17h00 même si une réservation se termine à 17h00
        $date_debut_p= $date_debut->modify('+1 minutes');
        // Enlève une minute à la date de fin pour permettre de terminer une réservation à 17h00 même si une réservation commence à 17h00
        $date_fin_p= $date_fin->modify('-1 minutes');
        $req= $this->bdd->verificationChevauchementMemeUtilisateurIdDifferent($id,$data['nom_utilisateur'],$date_debut,$date_fin);
        return $req;
    }

    function 
    // Envoie un mail au responsable pour chaque ajout
    public function envoieMailAjout(array $data,$id){
        $site=site_url();
        $user = $data['nom_utilisateur'];
        // Récupère le nom du moyen avec les ' sans \
        $moyen=  $moyen= str_replace("\'", "'", $data['nom_moyen']);  
        $date_debut= (new DATETIME ($data['date_debut']))->format('d/m/Y');
        $date_fin=(new DATETIME ($data['date_fin']))->format('d/m/Y');
        $heure_debut=$data['heure_debut'];
        $heure_fin=$data['heure_fin'];
        $groupe=$data['axe_recherche'];
        $responsable= $this->bdd->getResponsableParMoyen($moyen);
        // Vérifie s'il existe un responsable alors on lui envoie un mail
        if (isset($responsable[0]["responsable_1"])){
           $resultat=$this->bdd->rechercheMailRespsonsable($responsable[0]["responsable_1"]);
           wp_mail($resultat["user_email"], 'Nouvelle réservation ', 'Bonjour,
    
          Une nouvelle réservation vient d\'être déposé :
           nom: '.$user.'
           groupe: '.$groupe.'
           moyen: '.$moyen.' 
            du '.$date_debut.' à '.$heure_debut.' 
           au '.$date_fin.' à '.$heure_fin.'
           vous pouvez accéder a ce lien pour avoir plus de détail: '.$site.'/voir-une-reservation/?id='.$id.'','Bonjour,');
        }
        // Vérifie s'il existe un deuxième responsable alors on lui envoie un mail
        if (isset($responsable[0]['responsable_2'])){
            $resultat=$this->bdd->rechercheMailRespsonsable($responsable[0]["responsable_2"]);
            wp_mail($resultat["user_email"], 'Nouvelle réservation ', 'Bonjour,
    
            Une nouvelle réservation vient d\'être déposé :
            nom: '.$user.'
            groupe: '.$groupe.'
            moyen: '.$moyen.' 
            du '.$date_debut.' à '.$heure_debut.' 
            au '.$date_fin.' à '.$heure_fin.'
            vous pouvez accéder a ce lien pour avoir plus de détail: '.$site.'/voir-une-reservation/?id='.$id.'','Bonjour,');
        }
        // Vérifie s'il existe un troisième responsable alors on lui envoie un mail
        if (isset($responsable[0]['responsable_3'])){
            $resultat=$this->bdd->rechercheMailRespsonsable($responsable[0]["responsable_3"]);
            wp_mail($resultat["user_email"], 'Nouvelle réservation ', 'Bonjour,
    
            Une nouvelle réservation vient d\'être déposé :
            nom: '.$user.'
            groupe: '.$groupe.'
            moyen: '.$moyen.' 
            du '.$date_debut.' à '.$heure_debut.' 
            au '.$date_fin.' à '.$heure_fin.'
            vous pouvez accéder a ce lien pour avoir plus de détail: '.$site.'/voir-une-reservation/?id='.$id.'','Bonjour,');
        }
        return true;
    }
    //Recherche les différentes catégories
    public function afficherLesCategorie(){
        $results=$this->bdd->getCategorie();
        return $results;
    }
    // affiche l'id de la réservation
    public function afficherIdReservation($data){

    }
    // Envoie un mail au responsable pour chaque modification
    public function  envoieMailModif(array $data,$id){
        $user = $data['nom_utilisateur'];
        // Récupère le nom du moyen avec les ' sans \
        $moyen=  $moyen= str_replace("\'", "'", $data['nom_moyen']); 
        $date_debut= (new DATETIME ($data['date_debut']))->format('d/m/Y');
        $date_fin=(new DATETIME ($data['date_fin']))->format('d/m/Y');
        $heure_debut=$data['heure_debut'];
        $heure_fin=$data['heure_fin'];
        $groupe=$data['axe_recherche'];
        $responsable= $this->bdd->getResponsableParMoyen($moyen);
        // Vérifie s'il existe un responsable alors on lui envoie un mail
        if (isset($responsable[0]["responsable_1"])){
            $resultat=$this->bdd->rechercheMailRespsonsable($responsable[0]["responsable_1"]);
            wp_mail($resultat["user_email"], 'Modification d\'une réservation ', 'Bonjour,
        
            Une réservation vient d\'être modifié:
            nom: '.$user.'
            groupe: '.$groupe.'
            moyen: '.$moyen.' 
            du '.$date_debut.' à '.$heure_debut.' 
            au '.$date_fin.' à '.$heure_fin.'
            vous pouvez accéder a ce lien pour avoir plus de détail: '.$site.'/voir-une-reservation/?id='.$id.'','Bonjour,');
        }
        // Vérifie s'il existe un deuxième responsable alors on lui envoie un mail
        if (isset($responsable[0]['responsable_2'])){
            $resultat=$this->bdd->rechercheMailRespsonsable($responsable[0]["responsable_2"]);
            wp_mail($resultat["user_email"], 'Modification d\'une réservation ', 'Bonjour,
        
            Une réservation vient d\'être modifié :
            nom: '.$user.'
            groupe: '.$groupe.'
            moyen: '.$moyen.' 
            du '.$date_debut.' à '.$heure_debut.' 
            au '.$date_fin.' à '.$heure_fin.'
            vous pouvez accéder a ce lien pour avoir plus de détail: '.$site.'/voir-une-reservation/?id='.$id.'','Bonjour,');
        }
        // Vérifie s'il existe un troisième responsable alors on lui envoie un mail
        if (isset($responsable[0]['responsable_3'])){
            $resultat=$this->bdd->rechercheMailRespsonsable($responsable[0]["responsable_3"]);
            wp_mail($resultat["user_email"], 'Modification d\'une réservation ', 'Bonjour,
        
            Une réservation vient d\'être modifié :
            nom: '.$user.'
            groupe: '.$groupe.'
            moyen: '.$moyen.' 
            du '.$date_debut.' à '.$heure_debut.' 
            au '.$date_fin.' à '.$heure_fin.'

            vous pouvez accéder a ce lien pour avoir plus de détail: '.$site.'/voir-une-reservation/?id='.$id.'','Bonjour,');
        }
        return true;
    }
    
}

?>