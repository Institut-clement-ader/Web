<?php

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
    
//     public function __construct($host, $dbname, $login, $passwd){
// 			try{
// 				$this->bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $login, $passwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
// 			}
// 			catch(Exception $e){
// 				die('Erreur : '.$e->getMessage());
// 			}
// 		}
		}
    
    public function ajouterDemande($nom,$prenom,$mailArrivant,$mail,$path,$date_fin,$tuteur,$date_arrivee,$statut_arrivant){
      $req = $this->bdd->prepare('INSERT INTO wp_temp_zrr(nom,prenom,mail_arrivant,mail,path,date_fin,nom_prenom_tuteur,date_arrivee,statut_arrivant,necessite_zrr) VALUES(?,?,?,?,?,?,?,?,?,?)');
			$req->execute(array($nom,$prenom,$mailArrivant,$mail,$path,$date_fin,$tuteur,$date_arrivee,$statut_arrivant,0));
			return true;
    }
    
    public function getDemandes(){
      $req = $this->bdd->prepare('SELECT * FROM wp_temp_zrr');
      $req->execute();
      return $req;
    }
    
    public function getObservations(){
      $req = $this->bdd->prepare('SELECT * FROM wp_pods_observation_rsst ORDER BY date_saisie');
      $req->execute();
      return $req;
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
      $req = $this->bdd->prepare('SELECT * FROM wp_temp_zrr WHERE mail = ?' );
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

    