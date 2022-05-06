<?php

  /**
  * Améliorations à apporter :
  * Commenter toutes les function pour comprendre leur utilité très facilement
  */


// On cherche le fichier avec les identifiants de la BD
require_once("codes snippet/database.php");

	class GestionBdd{
		private $bdd;

		public function __construct(){
			try{
				$this->bdd = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME.';charset=utf8', DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			}
			catch(Exception $e){
				die('Erreur : '.$e->getMessage());
			}
		}
    
    public function ajouterDemande($nom,$prenom,$mailArrivant,$mail,$path,$date_fin,$tuteur,$date_arrivee,$statut_arrivant,$etablissement_accueil){
      $req = $this->bdd->prepare('INSERT INTO wp_temp_zrr(nom,prenom,mail_arrivant,mail,path,date_fin,nom_prenom_tuteur,date_arrivee,statut_arrivant,etablissement_accueil,necessite_zrr) VALUES(?,?,?,?,?,?,?,?,?,?,?)');
			$req->execute(array($nom,$prenom,$mailArrivant,$mail,$path,$date_fin,$tuteur,$date_arrivee,$statut_arrivant,$etablissement_accueil,0));
			return true;
    }

    // s'il y a un id, on supprime le doctorant dans la tables wp_users
    public function supprimerDoctorantTableUser($id){
      $req=$this->bdd->prepare('DELETE FROM wp_users WHERE ID = ?');
      $req->execute(array($id));
      return $req;
    }

    // s'il y a un id, on supprime le doctorant dans la   tables wp_usermeta
    public function supprimerDoctorantTableUserMeta($id){
      $req=$this->bdd->prepare('DELETE FROM wp_usermeta WHERE user_id = ?');
      $req->execute(array($id));
      return $req;
    }

    // s'il y a un id, on supprime le doctorant dans la wp_podsrel
    public function supprimerDoctorantTablePodsrel($id){
      $req=$this->bdd->prepare('DELETE FROM wp_podsrel WHERE (pod_id = 862 AND (field_id = 1240 OR field_id = 1241 OR field_id = 1242 OR field_id = 1380) AND related_item_id = ?) OR (pod_id = 274 AND (field_id = 280 OR field_id = 282) AND related_item_id = ?)');
      $req->execute(array($id,$id));
      return $req;
    }

    public function getDemandesZrr(){
      $req = $this->bdd->prepare('SELECT * FROM wp_temp_zrr');
      $req->execute();
      return $req;
    }
    
    //on mets à jour la date de soutenance
    public function updateDateSoutenance($dateSoutenance,$idThese){
      $req = $this->bdd->prepare('UPDATE wp_pods_these SET date_soutenance = ? WHERE ID = ?');
      $req->execute(array($dateSoutenance,$idThese));
      return $req;
    }

    public function getTheses($id){
      $req = $this->bdd->prepare('SELECT th.id, th.date_debut, th.date_soutenance FROM wp_pods_these th, wp_podsrel rel WHERE rel.pod_id = 862 AND rel.field_id = 1380 AND rel.item_id = th.id AND rel.related_item_id = ?');
      $req->execute(array($id));
      return $req;
    }

    //remet le display à 1 dans la base wp_usermeta
    public function retablirMembre1($id){
      $req = $this->bdd->prepare('UPDATE wp_usermeta SET meta_value = 1 WHERE user_id = ? AND meta_key = display_user ');
      $req->execute(array($id));
      return $req;
    }
//remet le display à 1 dans la base wp_usermeta
    public function retablirMembre2($id){
      $req = $this->bdd->prepare('INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES (?, display_user , 1)');
      $req->execute(array($id));
      return $req;
    }

    //on remet le display à 0 dans la base wp_usermeta
    public function cacherMembre($id){
      $req = $this->bdd->prepare('UPDATE wp_usermeta SET meta_value = 0 WHERE user_id = ? AND meta_key = display_user');
      $req->execute(array($id));
      return $req;
    }
    
    public function getObservations(){
      $req = $this->bdd->prepare('SELECT * FROM wp_pods_observation_rsst ORDER BY date_saisie');
      $req->execute();
      return $req;
    }
    
    //ANALYSE DES EQUIPEMENTS
    public function analyseListeEquipement($categorie){
      $req = $this-> bdd->prepare('SELECT count(*) FROM wp_pods_moyen WHERE categorie = ?');
      $req->execute(array($catégorie));
      $req = $req->fetchAll();
      return $req;
    }

    //CALCULE LE NOMBRE D'EQUIPEMENTS
    public function nombreEquipement(){
    $req = $this-> bdd->prepare('SELECT COUNT(*) FROM wp_pods_moyen');
    $req->execute();
    $req = $req->fetchColumn();
    }


    //ANALYSE DES OFFRES
    public function analyseListeOffres($type_offre){
      $req = $this-> bdd->prepare('SELECT count(*) FROM wp_pods_offre_emploi WHERE type_offre = ?');
      $req->execute(array($type_offre));
      $req = $req->fetchAll();
      return $req;
    }

    //CALCULE LE NOMBRE D'OFFRES
    public function nombreOffres(){
    $req = $this-> bdd->prepare('SELECT COUNT(*) FROM wp_pods_offre_emploi');
    $req->execute();
    $req = $req->fetchColumn();
    }    

    //ANALYSE DES OFFRES DISPONIBLES
    public function analyseListeOffresDispo($type_offre){
      $req = $this-> bdd->prepare('SELECT count(*) FROM wp_pods_offre_emploi WHERE type_offre = ? AND date_fin >= CURDATE()');
      $req->execute(array($type_offre));
      $req = $req->fetchAll();
      return $req;
    }

    //CALCULE LE NOMBRE D'OFFRES DISPONIBLES
    public function nombreOffresDispo(){
      $req = $this-> bdd->prepare('SELECT COUNT(*) FROM `wp_pods_offre_emploi` WHERE `date_fin` >= CURDATE()');
      $req->execute();
      $req = $req->fetchColumn();
      }    


    //On selectionne le nombre de theses dont le doctorant est toujours present, dont la date de soutenance est non definie ou superieure a la date courante et dont la date de debut est inferieure a la date courante
    public function nbTheses(){
      $req = $this->bdd->prepare('SELECT COUNT(*) FROM wp_pods_these WHERE (id IN (SELECT item_id FROM wp_podsrel WHERE pod_id = 862 AND field_id=1380)) AND (date_soutenance IS NULL OR date_soutenance >= CURDATE()) AND (date_debut <= CURDATE())');
      $req->execute();
      $req = $req->fetchColumn();
      return $req;
    }

    //On selectionne le nombre de theses dont la soutenance est definie et inferieure a la date courante
    public function nbThesesSoutenues(){
      $req = $this->bdd->prepare('SELECT COUNT(*) FROM wp_pods_these WHERE NOT(date_soutenance <=> NULL) AND date_soutenance <= CURDATE()');
      $req->execute();
      $req = $req->fetchColumn();
      return $req;
    }

    //on selectionne les theses et le groupe de chacun de ses encadrants
    public function selectTheses($year){
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
    public function supprimerMoyen($id){
			$req = $this->bdd->prepare('DELETE FROM wp_pods_moyen WHERE id = ? LIMIT 1');
			$req->execute(array($id));
    }

     // si l'id d'une offre est defini, on la supprime
     public function supprimerOffre($id){
			$req = $this->bdd->prepare('DELETE FROM wp_pods_offre_emploi WHERE id = ? LIMIT 1');
			$req->execute(array($id));
    }

    
    // si l'id d'un projet est defini, on le supprime
    public function supprimerProjet1($id){
      $req = $this->bdd->prepare('DELETE FROM wp_pods_projet WHERE id = ? LIMIT 1');
      $req->execute(array($id));
    }

    // si l'id d'une these est defini, on la supprime
    public function supprimerThese($id){
      $req = $this->bdd->prepare('DELETE FROM wp_pods_these WHERE id = ? LIMIT 1');
      $req->execute(array($id));
    }

    // si l'id d'une these est defini, on la supprime
    public function supprimerTheseRelations($id){
      $req = $this->bdd->prepare('DELETE FROM `wp_podsrel` WHERE pod_id = 862 AND item_id = :?');
      $req->execute(array($id));
    }


    public function getObservationsNonValide(){
      $req = $this->bdd->prepare('SELECT * FROM wp_pods_observation_rsst WHERE visa = 0');
      $req->execute();
      return $req;
    }
    
     public function getDemandesProjets(){
      $req = $this->bdd->prepare('SELECT * FROM wp_pods_projet');
      $req->execute();
      return $req;
    }
    
    public function getDemandesByEmail($mail){
      $req = $this->bdd->prepare('SELECT * FROM wp_temp_zrr WHERE mail = ? ORDER BY date_arrivee DESC ');
      $req->execute(array($mail));
      return $req;
    }
    
     public function getDemandesProjetsByEmail($mail){
      $req = $this->bdd->prepare("SELECT * FROM wp_pods_projet WHERE mail = ? OR mail_2 = ?" );
      $req->execute(array($mail, $mail));
      return $req;
    }
    
    public function getDemandesById($id){
      $req = $this->bdd->prepare('SELECT * FROM wp_temp_zrr WHERE id = ?' );
      $req->execute(array($id));
      return $req;
    }
    
    public function getDemandesProjetById($id){
      $req = $this->bdd->prepare('SELECT * FROM wp_pods_projet WHERE id = ?' );
      $req->execute(array($id));
      return $req;
    }
    
    public function getObservationById($id){
      $req = $this->bdd->prepare('SELECT * FROM wp_pods_observation_rsst WHERE id = ?' );
      $req->execute(array($id));
      return $req;
    }
    
    public function accepterDemande($id){
      $req = $this->bdd->prepare('UPDATE wp_temp_zrr SET necessite_zrr = 1 WHERE id = ? ');
      $req->execute(array($id));
      return true;
    }

    //REQUETE DEPOT ZRR
    public function resetDossier($url){
      $req=$this->bdd->prepare('UPDATE wp_temp_zrr SET necessite_zrr = 0, num_dossier = 0 WHERE path = ?');
      $req->execute(array($url));
      return true;
    }
    

    //REQUETE Consulter demande mettre à jour id
    public function updateIdZRR($numDossier, $idZrr){
      $req = $this->bdd->prepare('UPDATE wp_temp_zrr SET num_dossier = ? WHERE id = ?');
      $req->execute(array($numDossier,$idZrr));
    }
    
     public function accepterDemandeProjet($id){
      $req = $this->bdd->prepare('UPDATE wp_pods_projet SET necessite_projet = 1 WHERE id = ? ');
      $req->execute(array($id));
      return true;
    }
    
    public function completerObservation($date_consultation_chef_structure, $nom_chef_structure, $observations_du_responsable, $visa, $id){
      $req = $this->bdd->prepare('UPDATE wp_pods_observation_rsst SET date_consultation_chef_structure = ?, nom_chef_structure = ?, observations_du_responsable = ?, visa = ? WHERE id = ? ');
      $req->execute(array($date_consultation_chef_structure, $nom_chef_structure, $observations_du_responsable, $visa, $id));
      return true;
    }
    
    public function refuserDemande($id){
      $req = $this->bdd->prepare('DELETE FROM wp_temp_zrr WHERE id = ? ');
      $req->execute(array($id));
      return true;
      
    }
    
    public function supprimerProjet($id){
      $req = $this->bdd->prepare('DELETE FROM wp_pods_projet WHERE id = ? ');
      $req->execute(array($id));
      return true;
      
    }
    
     public function confirmerProjet($id){
      $req = $this->bdd->prepare('UPDATE wp_pods_projet SET projet_accepte = 1 WHERE id = ? ');
      $req->execute(array($id));
      return true;
    }
    
    public function getUrl($id){
      $req = $this->bdd->prepare('SELECT path FROM wp_temp_zrr WHERE id = ?');
      $req->execute(array($id));
      $donnees = $req->fetch();
      
      return $donnees['path'];
      
    }
    
    public function getUrlProjet($id){
      $req = $this->bdd->prepare('SELECT path FROM wp_pods_projet WHERE id = ?');
      $req->execute(array($id));
      $donnees = $req->fetch();
      
      return $donnees['path'];
      
    }
    
    public function getNecessiteZrrByEmail($mail){
      $req = $this->bdd->prepare('SELECT necessite_zrr FROM wp_temp_zrr WHERE mail_arrivant = ?');
      $req->execute(array($mail));
      $donnees = $req->fetch();
      return $donnees['necessite_zrr'];
      
    }
    
    public function getIdByEmailArrivant($mail){
      $req = $this->bdd->prepare('SELECT id FROM wp_temp_zrr WHERE mail_arrivant = ?');
      $req->execute(array($mail));
      $donnees = $req->fetch();
      return $donnees['id'];
      
    }
    
    public function getPartenaireByEmail($mail){
      $req = $this->bdd->prepare('SELECT display_name FROM wp_users WHERE user_email = ?' );
      $req->execute(array($mail));
      $donnees = $req->fetch();
      return $donnees['display_name'];
    }
    
  }
?>

    