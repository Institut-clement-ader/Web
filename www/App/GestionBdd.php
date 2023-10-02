<?php

/**
 * Améliorations à apporter :
 * Commenter toutes les function pour comprendre leur utilité très facilement
 */


// On cherche le fichier avec les identifiants de la BD
// require_once("App/database.php");

class GestionBdd
{
  private $bdd;

  public function __construct()
  {
    try {
      $this->bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }
  }

  public function ajouterDemande($nom, $prenom, $mailArrivant, $mail, $path, $date_fin, $tuteur, $date_arrivee, $statut_arrivant, $etablissement_accueil)
  {
    $req = $this->bdd->prepare('INSERT INTO wp_temp_zrr(nom,prenom,mail_arrivant,mail,path,date_fin,nom_prenom_tuteur,date_arrivee,statut_arrivant,etablissement_accueil,necessite_zrr) VALUES(?,?,?,?,?,?,?,?,?,?,?)');
    $req->execute(array($nom, $prenom, $mailArrivant, $mail, $path, $date_fin, $tuteur, $date_arrivee, $statut_arrivant, $etablissement_accueil, 0));
    return true;
  }

  // s'il y a un id, on supprime le doctorant dans la tables wp_users
  public function supprimerDoctorantTableUser($id)
  {
    $req = $this->bdd->prepare('DELETE FROM wp_users WHERE ID = ?');
    $req->execute(array($id));
    return $req;
  }

  // s'il y a un id, on supprime le doctorant dans la   tables wp_usermeta
  public function supprimerDoctorantTableUserMeta($id)
  {
    $req = $this->bdd->prepare('DELETE FROM wp_usermeta WHERE user_id = ?');
    $req->execute(array($id));
    return $req;
  }

  // s'il y a un id, on supprime le doctorant dans la wp_podsrel
  public function supprimerDoctorantTablePodsrel($id)
  {
    $req = $this->bdd->prepare('DELETE FROM wp_podsrel WHERE (pod_id = 862 AND (field_id = 1240 OR field_id = 1241 OR field_id = 1242 OR field_id = 1380) AND related_item_id = ?) OR (pod_id = 274 AND (field_id = 280 OR field_id = 282) AND related_item_id = ?)');
    $req->execute(array($id, $id));
    return $req;
  }

  public function getDemandesZrr()
  {
    $req = $this->bdd->prepare('SELECT * FROM wp_temp_zrr order by necessite_zrr ASC, nom ASC');
    $req->execute();
    return $req;
  }

  //on mets à jour la date de soutenance
  public function updateDateSoutenance($dateSoutenance, $idThese)
  {
    $req = $this->bdd->prepare('UPDATE wp_pods_these SET date_soutenance = ? WHERE ID = ?');
    $req->execute(array($dateSoutenance, $idThese));
    return $req;
  }

  public function getTheses($id)
  {
    $req = $this->bdd->prepare('SELECT th.id, th.date_debut, th.date_soutenance FROM wp_pods_these th, wp_podsrel rel WHERE rel.pod_id = 862 AND rel.field_id = 1380 AND rel.item_id = th.id AND rel.related_item_id = ?');
    $req->execute(array($id));
    return $req;
  }

  //remet le display à 1 dans la base wp_usermeta
  public function retablirMembre1($id)
  {
    $req = $this->bdd->prepare('UPDATE wp_usermeta SET meta_value = 1 WHERE user_id = ? AND meta_key = display_user ');
    $req->execute(array($id));
    return $req;
  }
  //remet le display à 1 dans la base wp_usermeta
  public function retablirMembre2($id)
  {
    $req = $this->bdd->prepare('INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES (?, display_user , 1)');
    $req->execute(array($id));
    return $req;
  }

  //on remet le display à 0 dans la base wp_usermeta
  public function cacherMembre($id)
  {
    $req = $this->bdd->prepare('UPDATE wp_usermeta SET meta_value = 0 WHERE user_id = ? AND meta_key = display_user');
    $req->execute(array($id));
    return $req;
  }

  public function getObservations()
  {
    $req = $this->bdd->prepare('SELECT * FROM wp_pods_observation_rsst ORDER BY rs_date_saisie');
    $req->execute();
    return $req;
  }

  //ANALYSE DES EQUIPEMENTS
  public function analyseListeEquipement($categorie)
  {
    $req = $this->bdd->prepare('SELECT count(*) FROM wp_pods_moyen WHERE categorie = ?');
    $req->execute(array($categorie));
    $req = $req->fetchAll();
    return $req;
  }

  //CALCULE LE NOMBRE D'EQUIPEMENTS
  public function nombreEquipement()
  {
    $req = $this->bdd->prepare('SELECT COUNT(*) FROM wp_pods_moyen');
    $req->execute();
    $req = $req->fetchColumn();
    return $req;
  }


  //ANALYSE DES OFFRES
  public function analyseListeOffres($type_offre)
  {
    $req = $this->bdd->prepare('SELECT count(*) FROM wp_pods_offre_emploi WHERE type_offre = ?');
    $req->execute(array($type_offre));
    $req = $req->fetchAll();
    return $req;
  }

  //CALCULE LE NOMBRE D'OFFRES
  public function nombreOffres()
  {
    $req = $this->bdd->prepare('SELECT COUNT(*) FROM wp_pods_offre_emploi');
    $req->execute();
    $req = $req->fetchColumn();
    return $req;
  }

  //ANALYSE DES OFFRES DISPONIBLES
  public function analyseListeOffresDispo($type_offre)
  {
    $req = $this->bdd->prepare('SELECT count(*) FROM wp_pods_offre_emploi WHERE type_offre = ? AND date_fin >= CURDATE()');
    $req->execute(array($type_offre));
    $req = $req->fetchAll();
    return $req;
  }

  //CALCULE LE NOMBRE D'OFFRES DISPONIBLES
  public function nombreOffresDispo()
  {
    $req = $this->bdd->prepare('SELECT COUNT(*) FROM `wp_pods_offre_emploi` WHERE `date_fin` >= CURDATE()');
    $req->execute();
    $req = $req->fetchColumn();
  }


  //On selectionne le nombre de theses dont le doctorant est toujours present, dont la date de soutenance est non definie ou superieure a la date courante et dont la date de debut est inferieure a la date courante
  public function nbTheses()
  {
    $req = $this->bdd->prepare('SELECT COUNT(*) FROM wp_pods_these WHERE (id IN (SELECT item_id FROM wp_podsrel WHERE pod_id = 862 AND field_id=1380)) AND (date_soutenance IS NULL OR date_soutenance >= CURDATE()) AND (date_debut <= CURDATE())');
    $req->execute();
    $req = $req->fetchColumn();
    return $req;
  }

  //On selectionne le nombre de theses dont la soutenance est definie et inferieure a la date courante
  public function nbThesesSoutenues()
  {
    $req = $this->bdd->prepare('SELECT COUNT(*) FROM wp_pods_these WHERE NOT(date_soutenance <=> NULL) AND date_soutenance <= CURDATE()');
    $req->execute();
    $req = $req->fetchColumn();
    return $req;
  }

  //on selectionne les theses et le groupe de chacun de ses encadrants
  public function selectTheses($year)
  {
    $req = $this->bdd->prepare('SELECT DISTINCT these.id AS these_id, meta.meta_value AS groupe
      FROM wp_pods_these AS these, wp_podsrel AS rel, wp_usermeta AS meta
      WHERE rel.pod_id = 862
        AND (rel.field_id = 1240
        OR rel.field_id = 1241
        OR rel.field_id = 1242)
        AND rel.item_id = these.id
        AND rel.related_item_id = meta.user_id
        AND (meta.meta_key = "groupe_primaire"
        OR meta.meta_key = "groupe_secondaire"
        OR meta.meta_key = "groupe_tertiaire")
        AND meta_value IN ("MSC", "MICS", "SUMO", "MS2M")
        AND YEAR(these.date_soutenance) = ?
      ORDER BY these_id');
    $req->execute(array($year));
    return $req;
  }


  // si l'id d'un moyen est defini, on le supprime
  public function supprimerMoyen($id)
  {
    $req = $this->bdd->prepare('DELETE FROM wp_pods_moyen WHERE id = ? LIMIT 1');
    $req->execute(array($id));
    return true;
  }

  // si l'id d'une offre est defini, on la supprime
  public function supprimerOffre($id)
  {
    $req = $this->bdd->prepare('DELETE FROM wp_pods_offre_emploi WHERE id = ? LIMIT 1');
    $req->execute(array($id));
    return true;
  }


  // si l'id d'un projet est defini, on le supprime
  public function supprimerProjet1($id)
  {
    $req = $this->bdd->prepare('DELETE FROM wp_pods_projet WHERE id = ? LIMIT 1');
    $req->execute(array($id));
    return true;
  }

  // si l'id d'une these est defini, on la supprime
  public function supprimerThese($id)
  {
    $req = $this->bdd->prepare('DELETE FROM wp_pods_these WHERE id = ? LIMIT 1');
    $req->execute(array($id));
    return true;
  }

  // si l'id d'une these est defini, on la supprime
  public function supprimerTheseRelations($id)
  {
    $req = $this->bdd->prepare('DELETE FROM `wp_podsrel` WHERE pod_id = 862 AND item_id = :?');
    $req->execute(array($id));
    return true;
  }


  public function getObservationsNonValide()
  {
    $req = $this->bdd->prepare('SELECT * FROM wp_pods_observation_rsst WHERE rs_visa = 0');
    $req->execute();
    return $req;
  }

  public function getDemandesProjets()
  {
    $req = $this->bdd->prepare('SELECT * FROM wp_pods_projet');
    $req->execute();
    return $req;
  }

  public function getDemandesByEmail($mail)
  {
    $req = $this->bdd->prepare('SELECT * FROM wp_temp_zrr WHERE mail = ? ORDER BY date_arrivee DESC ');
    $req->execute(array($mail));
    return $req;
  }

  public function getDemandesProjetsByEmail($mail)
  {
    $req = $this->bdd->prepare("SELECT * FROM wp_pods_projet WHERE mail = ? OR mail_2 = ?");
    $req->execute(array($mail, $mail));
    return $req;
  }

  public function getDemandesById($id)
  {
    $req = $this->bdd->prepare('SELECT * FROM wp_temp_zrr WHERE id = ?');
    $req->execute(array($id));
    return $req;
  }

  public function getDemandesProjetById($id)
  {
    $req = $this->bdd->prepare('SELECT * FROM wp_pods_projet WHERE id = ?');
    $req->execute(array($id));
    return $req;
  }

  public function getObservationById($id)
  {
    $req = $this->bdd->prepare('SELECT * FROM wp_pods_observation_rsst WHERE id = ?');
    $req->execute(array($id));
    return $req;
  }

  public function accepterDemande($id)
  {
    $req = $this->bdd->prepare('UPDATE wp_temp_zrr SET necessite_zrr = 1 WHERE id = ? ');
    $req->execute(array($id));
    return true;
  }

  //REQUETE DEPOT ZRR
  public function resetDossier($id)
  {
    $req = $this->bdd->prepare('UPDATE wp_temp_zrr SET necessite_zrr = 0, num_dossier = 0 WHERE id = ?');
    $req->execute(array($id));
    return true;
  }
  public function DossierZrr($id)
  {
    $req = $this->bdd->prepare('SELECT * FROM wp_temp_zrr WHERE id = ?');
    $req->execute(array($id));
    $donnees = $req->fetch();
    return $donnees;
  }


  //REQUETE Consulter demande mettre à jour id
  public function updateIdZRR($numDossier, $idZrr)
  {
    $req = $this->bdd->prepare('UPDATE wp_temp_zrr SET num_dossier = ? WHERE id = ?');
    $req->execute(array($numDossier, $idZrr));
    return true;
  }

  public function accepterDemandeProjet($id)
  {
    $req = $this->bdd->prepare('UPDATE wp_pods_projet SET necessite_projet = 1 WHERE id = ? ');
    $req->execute(array($id));
    return true;
  }

  public function completerObservation($date_consultation_chef_structure, $nom_chef_structure, $observations_du_responsable, $visa, $id)
  {
    $req = $this->bdd->prepare('UPDATE wp_pods_observation_rsst SET rs_date_consultation_chef_structure = ?, rs_nom_chef_structure = ?, rs_observations_du_responsable = ?, rs_visa = ? WHERE id = ? ');
    $req->execute(array($date_consultation_chef_structure, $nom_chef_structure, $observations_du_responsable, $visa, $id));
    return true;
  }

  public function refuserDemande($id)
  {
    $req = $this->bdd->prepare('DELETE FROM wp_temp_zrr WHERE id = ? ');
    $req->execute(array($id));
    return true;
  }

  public function supprimerProjet($id)
  {
    $req = $this->bdd->prepare('DELETE FROM wp_pods_projet WHERE id = ? ');
    $req->execute(array($id));
    return true;
  }

  public function confirmerProjet($id)
  {
    $req = $this->bdd->prepare('UPDATE wp_pods_projet SET projet_accepte = 1 WHERE id = ? ');
    $req->execute(array($id));
    return true;
  }

  public function getUrl($id)
  {
    $req = $this->bdd->prepare('SELECT path FROM wp_temp_zrr WHERE id = ?');
    $req->execute(array($id));
    $donnees = $req->fetch();

    return $donnees['path'];
  }

  public function getUrlProjet($id)
  {
    $req = $this->bdd->prepare('SELECT path FROM wp_pods_projet WHERE id = ?');
    $req->execute(array($id));
    $donnees = $req->fetch();

    return $donnees['path'];
  }

  public function getNecessiteZrrByEmail($mail)
  {
    $req = $this->bdd->prepare('SELECT necessite_zrr FROM wp_temp_zrr WHERE mail_arrivant = ?');
    $req->execute(array($mail));
    $donnees = $req->fetch();
    return $donnees['necessite_zrr'];
  }

  public function getIdByEmailArrivant($mail)
  {
    $req = $this->bdd->prepare('SELECT id FROM wp_temp_zrr WHERE mail_arrivant = ?');
    $req->execute(array($mail));
    $donnees = $req->fetch();
    return $donnees['id'];
  }

  public function getPartenaireByEmail($mail)
  {
    $req = $this->bdd->prepare('SELECT display_name FROM wp_users WHERE user_email = ?');
    $req->execute(array($mail));
    $donnees = $req->fetch();
    return $donnees['display_name'];
  }
  // Récupère les différentes réservations en fonction de deux date et de la catégorie des moyens données
  public function dateDansUnMois(DateTime $start, DateTime $end, $categorie)
  {
    $sql = "SELECT * FROM wp_pods_reservation, wp_pods_moyen
         WHERE categorie='$categorie'
         AND wp_pods_moyen.nom_moyen=wp_pods_reservation.nom_moyen
         AND (date_debut BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}'
         OR  date_fin BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}')
         ORDER BY date_debut DESC";
    $req = $this->bdd->prepare($sql);
    $req->execute();
    $donnees = $req->fetchAll();
    return $donnees;
  }
  // Récupère les différentes réservations en fonction de la journée et de la catégorie des moyens données
  public function getParJourEtCategorie(DATETIME $jour, $categorie)
  {
    $sql = "SELECT * FROM wp_pods_reservation,wp_pods_moyen 
        WHERE '{$jour->format('Y-m-d')}' BETWEEN  DATE_FORMAT(`date_debut`,  '%Y-%m-%d') 
        AND  DATE_FORMAT(`date_fin`,  '%Y-%m-%d') 
        AND categorie='$categorie'
        AND wp_pods_moyen.nom_moyen=wp_pods_reservation.nom_moyen order by date_debut";
    $req = $this->bdd->prepare($sql);
    $req->execute();
    $donnees = $req->fetchAll();
    return $donnees;
  }
  // Récupère les différentes réservations de la journée et du moyens données
  public function getParJourEtMoyen(DateTime $jour, $moyen)
  {
    $sql = "SELECT * FROM wp_pods_reservation 
        WHERE '{$jour->format('Y-m-d')}' BETWEEN  DATE_FORMAT(`date_debut`,  '%Y-%m-%d') 
        AND  DATE_FORMAT(`date_fin`,  '%Y-%m-%d') 
        AND nom_moyen=? order by date_debut";
    $req = $this->bdd->prepare($sql);
    $req->execute(array($moyen));
    $donnees = $req->fetchAll();
    return $donnees;
  }
  // Récupère la réservations qui corresponds à l'id donné
  public function getReservationById(int $id)
  {
    $sql = "SELECT * from wp_pods_reservation WHERE id= $id";
    $req = $this->bdd->prepare($sql);
    $req->execute();
    $donnees = $req->fetch();
    return $donnees;
  }
  // Crée la réservations
  public function creerReservation($titre_reservation, $nom_utilisateur, $nom_moyen, DATETIME $date_debut, DATETIME $date_fin, $axe_recherche, $encadrant, $description, $raison)
  {
    $sql = "INSERT INTO wp_pods_reservation (titre_reservation,nom_utilisateur,nom_moyen,date_debut,date_fin,axe_recherche,encadrant,description,raison)
        VALUES (?,?,?,?,?,?,?,?,?)";
    $req = $this->bdd->prepare($sql);
    echo
    $req->execute(array($titre_reservation, $nom_utilisateur, $nom_moyen, $date_debut->format('Y-m-d H:i'), $date_fin->format('Y-m-d H:i'), $axe_recherche, $encadrant, $description, $raison));
    return true;
  }
  // Vérifie si il existe pas une réservation d'un moyen pendant la période donnée
  public function verificationChevauchementMemeMoyen($nom_moyen, DATETIME $date_d, DATETIME $date_f)
  {
    $sql = "SELECT count(*) FROM wp_pods_reservation
        WHERE nom_moyen= ?
        AND (  ? BETWEEN date_debut AND date_fin
          OR ? BETWEEN date_debut AND date_fin 
          OR date_debut BETWEEN ? AND ?
          OR date_fin BETWEEN ? AND ?)";
    $req = $this->bdd->prepare($sql);
    $req->execute(array($nom_moyen, $date_d->format('Y-m-d H:i'), $date_f->format('Y-m-d H:i'), $date_d->format('Y-m-d H:i'), $date_f->format('Y-m-d H:i'), $date_d->format('Y-m-d H:i'), $date_f->format('Y-m-d H:i')));
    $donnees = $req->fetch();
    return $donnees;
  }
  // Récupère tous les encadrants possible (elle récupère tous les noms mais peut être modifié)
  public function getEncadrantPossible()
  {
    $sql = "SELECT DISTINCT user.display_name
        FROM wp_usermeta as meta, wp_users as user
        WHERE meta.user_id=user.ID
        AND meta.meta_key= 'status'
        AND meta.meta_value in ('Chargé de recherche','Directeur de recherche','Enseignant-chercheur','Enseignant-chercheur associé','Ingénieur - Chercheur','Ingénieur de recherche','Maître assistant','Maître assistant associé','Professeur','Professeur associé','Maître de conférences','Maître de conférences associé') 
        ORDER BY user.display_name";
    $req = $this->bdd->prepare($sql);
    $req->execute();
    $donnees = $req->fetchAll();
    return $donnees;
  }
  // Récupère le nom et le prénom des utilisateurs
  public function getNom($nom)
  {
    $sql = "SELECT DISTINCT meta.meta_value
          FROM wp_usermeta as meta, wp_users as user
          WHERE meta.user_id=user.ID
          AND user.display_name= '$nom'
          AND (meta.meta_key= 'first_name'
          OR meta.meta_key= 'last_name')";
    $req = $this->bdd->prepare($sql);
    $req->execute();
    $donnees = $req->fetchAll();
    return $donnees;
  }

  // Récupère tous les groupes de l'utilisateur 
  public function getGroupe()
  {
    $sql = "SELECT DISTINCT meta.meta_value
        FROM wp_usermeta as meta
        WHERE (meta.meta_key = 'groupe_primaire'
        OR meta.meta_key = 'groupe_secondaire'        
        OR meta.meta_key = 'groupe_tertiaire')
        AND meta.meta_value not in ('AXTR') 
        AND meta.meta_value!='' ";
    $req = $this->bdd->prepare($sql);
    $req->execute();
    $donnees = $req->fetchAll();
    return $donnees;
  }


  // Récupère tous les moyens de la catégorie
  public function getMoyensCategorie($categorie)
  {
    $sql = "SELECT nom_moyen from  wp_pods_moyen WHERE categorie='$categorie' AND reservable=1 order by nom_moyen ";
    $req = $this->bdd->prepare($sql);
    $req->execute();
    $donnees = $req->fetchAll();
    return $donnees;
  }
  // Récupère tous les responsables du moyens
  public function getResponsableParMoyen($moyen)
  {
    $sql = "SELECT responsable_1,responsable_2,responsable_3 from  wp_pods_moyen WHERE nom_moyen=? ";
    $req = $this->bdd->prepare($sql);
    $req->execute(array($moyen));
    $donnees = $req->fetchAll();
    return $donnees;
  }
  // Supprime une réservation
  public function deleteReservationById(int $id)
  {
    $req = $this->bdd->prepare('DELETE FROM wp_pods_reservation WHERE id = ? ');
    $req->execute(array($id));
    return true;
  }
  //Modifie une réservation 
  public function updateReservationById($id, $titre_reservation, $nom_utilisateur, $nom_moyen, DATETIME $date_debut, DATETIME $date_fin, $axe_recherche, $encadrant, $description, $raison)
  {
    $sql = " UPDATE wp_pods_reservation SET titre_reservation=?,nom_utilisateur=?,nom_moyen=?,date_debut=?,date_fin=?,axe_recherche=?,encadrant=?,description=?,raison=? WHERE id = ? ";
    $req = $this->bdd->prepare($sql);
    $req->execute(array($titre_reservation, $nom_utilisateur, $nom_moyen, $date_debut->format('Y-m-d H:i'), $date_fin->format('Y-m-d H:i'), $axe_recherche, $encadrant, $description, $raison, $id));
    return true;
  }
  // Vérifie si il existe pas une réservation du moyen pendant la période donnée et qu'il n'a pas le même id 
  public function verificationChevauchementMemeMoyenIdDifferent(int $id, $nom_moyen, DATETIME $date_d, DATETIME $date_f)
  {
    $sql = "SELECT count(*) FROM wp_pods_reservation
        WHERE nom_moyen= ?
        AND id!= ?
        AND (  ? BETWEEN date_debut AND date_fin
           OR ? BETWEEN date_debut AND date_fin 
           OR date_debut BETWEEN ? AND ?
           OR date_fin BETWEEN ? AND ?)";
    $req = $this->bdd->prepare($sql);
    $req->execute(array($nom_moyen, $id, $date_d->format('Y-m-d H:i'), $date_f->format('Y-m-d H:i'), $date_d->format('Y-m-d H:i'), $date_f->format('Y-m-d H:i'), $date_d->format('Y-m-d H:i'), $date_f->format('Y-m-d H:i')));
    $donnees = $req->fetch();
    return $donnees;
  }
  // Vérifie si il existe pas une réservation de l'utilisateur pendant la période donnée et qu'il n'a pas le même id 
  public function verificationChevauchementMemeUtilisateurIdDifferent(int $id, $nom_utilisateur, DATETIME $date_d, DATETIME $date_f)
  {
    $sql = "SELECT count(*) FROM wp_pods_reservation 
          WHERE nom_utilisateur= ?
          AND id!=?
          AND (  ? BETWEEN date_debut AND date_fin
              OR ? BETWEEN date_debut AND date_fin 
              OR date_debut BETWEEN ? AND ?
              OR date_fin BETWEEN ? AND ?)";
    $req = $this->bdd->prepare($sql);
    $req->execute(array($nom_utilisateur, $id, $date_d->format('Y-m-d H:i'), $date_f->format('Y-m-d H:i'), $date_d->format('Y-m-d H:i'), $date_f->format('Y-m-d H:i'), $date_d->format('Y-m-d H:i'), $date_f->format('Y-m-d H:i')));
    $donnees = $req->fetch();
    return $donnees;
  }
  // Récupère les différentes réservations en fonction de deux date et du moyen données
  public function dateDansUnMoisParMoyen(DateTime $start, DateTime $end, $moyen)
  {
    $sql = "SELECT * FROM wp_pods_reservation
         WHERE nom_moyen=?
         AND (date_debut BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}'
         OR  date_fin BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}')
         ORDER BY date_debut DESC";
    $req = $this->bdd->prepare($sql);
    $req->execute(array($moyen));
    $donnees = $req->fetchAll();
    return $donnees;
  }
  // Rècupère toutes les réservations ou le nom donnée est impliqué (responsable, encadrant ou utilisateur qui réserve)
  public function getReservationByNom($nom, $deb, $fin)
  {
    $sql = "SELECT * FROM wp_pods_reservation,wp_pods_moyen
        WHERE wp_pods_reservation.nom_moyen= wp_pods_moyen.nom_moyen
        AND '$deb' <  date_fin
        AND '$fin' >  date_debut
        AND (nom_utilisateur='$nom'  
        OR encadrant='$nom'
        OR responsable_1='$nom'
        OR responsable_2='$nom'
        OR responsable_3='$nom') 
        ORDER BY date_debut";
    $req = $this->bdd->prepare($sql);
    $req->execute();
    $donnees = $req->fetchAll();
    return $donnees;
  }
  // Récupère les réservations qui ont un moyen dans cette catégorie donnée
  public function getReservationParCatégorie($categorie, $date_debut, $date_fin)
  {
    $sql = "SELECT DISTINCT * FROM wp_pods_reservation, wp_pods_moyen
          WHERE categorie=?
          AND wp_pods_moyen.nom_moyen=wp_pods_reservation.nom_moyen
          AND ? <  date_fin
          AND ? > date_debut
          ORDER BY date_debut";
    $req = $this->bdd->prepare($sql);
    $req->execute(array($categorie, $date_debut, $date_fin));
    $donnees = $req->fetchAll();
    return $donnees;
  }
  // Récupère les réservations qui ont un moyen dans cette catégorie donnée et qui est réservé par l'utilisateur donnée
  public function getReservationParCatégorieEtUtilisateur($categorie, $uti, $date_debut, $date_fin)
  {
    $sql = "SELECT DISTINCT * FROM wp_pods_reservation, wp_pods_moyen
          WHERE categorie=?
          AND nom_utilisateur=?
          AND wp_pods_moyen.nom_moyen=wp_pods_reservation.nom_moyen
          AND ? <  date_fin
          AND ? > date_debut
          ORDER BY date_debut";
    $req = $this->bdd->prepare($sql);
    $req->execute(array($categorie, $uti, $date_debut, $date_fin));
    $donnees = $req->fetchAll();
    return $donnees;
  }
  // Récupère les réservations qui ont le moyen donnée
  public function getReservationParMoyen($moyen, $date_debut, $date_fin)
  {
    $sql = "SELECT DISTINCT * FROM wp_pods_reservation
          WHERE nom_moyen=?
          AND ? <  date_fin
          AND ? > date_debut
          ORDER BY date_debut";
    $req = $this->bdd->prepare($sql);
    $req->execute(array($moyen, $date_debut, $date_fin));
    $donnees = $req->fetchAll();
    return $donnees;
  }
  // Récupère les réservations qui ont le moyen donnée et qui est réservé par l'utilisateur donnée
  public function getReservationParMoyenEtUtilisateur($moyen, $uti, $date_debut, $date_fin)
  {
    $sql = "SELECT DISTINCT * FROM wp_pods_reservation
          WHERE nom_moyen=?
          AND nom_utilisateur=?
          AND ? <  date_fin
          AND ? > date_debut
          ORDER BY date_debut";
    $req = $this->bdd->prepare($sql);
    $req->execute(array($moyen, $uti, $date_debut, $date_fin));
    $donnees = $req->fetchAll();
    return $donnees;
  }
  // Récupère le mail de tous les responsable du moyen donnée 
  public function rechercheMailRespsonsable($name)
  {
    $sql = "SELECT user_email FROM wp_users
      WHERE display_name='$name'";
    $req = $this->bdd->prepare($sql);
    $req->execute();
    $donnees = $req->fetch();
    return $donnees;
  }
  // Récupère toutes les catégories des moyens
  public function getCategorie()
  {
    $sql = "SELECT DISTINCT categorie FROM wp_pods_moyen";
    $req = $this->bdd->prepare($sql);
    $req->execute();
    $donnees = $req->fetchAll();
    return $donnees;
  }
  // Récupère les utilisateurs qui ont réserver des moyens de la catégorie donnée
  public function getUtiReservationParCatégorie($categorie, $deb, $fin)
  {
    $sql = "SELECT DISTINCT nom_utilisateur FROM wp_pods_reservation, wp_pods_moyen
        WHERE categorie='$categorie'
        AND wp_pods_moyen.nom_moyen=wp_pods_reservation.nom_moyen
        AND '$deb' <  date_fin
        AND '$fin' >  date_debut";
    $req = $this->bdd->prepare($sql);
    $req->execute();
    $donnees = $req->fetchAll();
    return $donnees;
  }
  // Récupère les utilisateurs qui ont réserver le moyen donnée
  public function getUtiReservationParMoyen($moyen, $deb, $fin)
  {
    $sql = "SELECT DISTINCT nom_utilisateur FROM wp_pods_reservation
        WHERE nom_moyen=?
        AND '$deb' <  date_fin
        AND '$fin' >  date_debut";
    $req = $this->bdd->prepare($sql);
    $req->execute(array($moyen));
    $donnees = $req->fetchAll();
    return $donnees;
  }
  // Récupère les moyen du responsable
  public function getMoyenByResponsable($nom, $deb, $fin)
  {
    $sql = "SELECT  DISTINCT wp_pods_reservation.nom_moyen FROM wp_pods_reservation,wp_pods_moyen
      WHERE wp_pods_reservation.nom_moyen= wp_pods_moyen.nom_moyen
      AND '$deb' <  date_fin
      AND '$fin' >  date_debut
      AND (responsable_1='$nom'
      OR responsable_2='$nom'
      OR responsable_3='$nom') 
      ORDER BY nom_moyen";
    $req = $this->bdd->prepare($sql);
    $req->execute();
    $donnees = $req->fetchAll();
    return $donnees;
  }
  public function getAllMoyen($deb, $fin)
  {
    $sql = "SELECT  DISTINCT wp_pods_reservation.nom_moyen FROM wp_pods_reservation,wp_pods_moyen
      WHERE wp_pods_reservation.nom_moyen= wp_pods_moyen.nom_moyen
      AND '$deb' <  date_fin
      AND '$fin' >  date_debut
      ORDER BY nom_moyen";
    $req = $this->bdd->prepare($sql);
    $req->execute();
    $donnees = $req->fetchAll();
    return $donnees;
  }
  // Récupère les moyen du responsable
  public function getReservationByGroupeAndMoyen($groupe, $deb, $fin, $moyen)
  {
    $sql = "SELECT  * FROM wp_pods_reservation
      WHERE '$deb' <  date_fin
      AND '$fin' >  date_debut
      AND nom_moyen='$moyen'
      AND axe_recherche='$groupe'";
    $req = $this->bdd->prepare($sql);
    $req->execute();
    $donnees = $req->fetchAll();
    return $donnees;
  }
  // afficher l'id de la réservation 
  public function getId($moyen, DATETIME $date_debut, DATETIME $date_fin)
  {
    $sql = "SELECT id FROM wp_pods_reservation
      WHERE nom_moyen= ?
      AND date_debut= ?
      AND date_fin= ? ";
    $req = $this->bdd->prepare($sql);
    $req->execute(array($moyen, $date_debut->format('Y-m-d H:i'), $date_fin->format('Y-m-d H:i')));
    $donnees = $req->fetchAll();
    return $donnees;
  }
}
