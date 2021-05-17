<?php

include ('codes snippet/fonctions_snippet.php');

//détection de langue courante de la page
$currentlang = get_bloginfo('language');

if(strpos($currentlang,'fr')!==false){
  include('codes snippet/lang-fr.php');
}elseif(strpos($currentlang,'en')!==false){
  include('codes snippet/lang-en.php');
}else{
  echo("échec de reconnaissance de la langue");
}

function docTypeConvert ($doctype,$invited,$peerReview,$vulgarisation) {
        
        switch ($doctype) {
            
          case 'ART' :
            if($peerReview !=1 || $vulgarisation !=0){
              return 'ASCL';
            }else{
              return 'ACL';
            }            
            break;
          case 'COMM' :
            if($invited !=0){
               return 'INV';
            }else{
               return 'COM';
            }
            break;
          case 'COUV' :
            return 'CO';
            break;
          case 'OUV' :
            return 'O';
            break;
          case 'DOUV' :
            return 'DO';
            break;
          case 'POSTER' :
            return 'P';
            break;
          case 'PATENT' :
            return 'B';
            break;
          case 'THESE' :
            return 'PhD';
            break;
          case 'HDR' :
            return 'HDR';
            break;
          default : 
            return 'AP';
            break;
        }
      }
	//verification qu'une des cases a été cochée
	$cheked = false;
	$checkedT = false;

  $groupe= "";
	//recuperer le groupe et le référencement choisis
  if (isset($_POST['groupe'])) {
    if ($_POST['groupe'] != 'labo') {
	    $groupe = $_POST['groupe'];
    }
  }
  if (isset($_POST['ISI'])) {
	$ref = 'WOS';
  }

  if (isset($_POST['NR'])) {
	$ref = 'NR';
  }


  $isINV="non";
  $isCOM="non";
	//formation de l'url en fonction des cases (docType) cochées
	$doctype = "&fq=docType_s:(";
	$corpsdoctype = "";
	
  $arrayKeys = array("ART", "COMM", "INV","COUV", "OTHER","OUV","DOUV","POSTER","PATENT","UNDEFINED","REPORT","THESE","HDR","LECTURE","IMG","VIDEO","MAP","SON");
	foreach ($arrayKeys as $name) {
		//on ajoute la référence du doctype à l'url
		if (isset($_POST[$name])) {
			$checked = true;
      
     if(strpos($name,"INV") !== false){
      
        $isINV="oui";
       
        if(strpos($corpsdoctype,"COMM")!== true){
          
          $corpsdoctype.= "COMM OR ";
        }
      }else{
       
			  $corpsdoctype.= $name." OR ";
      }
      if(strpos($name,"COMM")!==false){
       
        $isCOM="oui";
      }
		}
	}
	$doctype .= urlencode($corpsdoctype);
	//on enlève le dernier "OR"
	$doctype = substr($doctype, 0, -4).")";

	//formation de l'url en fonction des cases (submitType) cochées 
	$submittype = "&fq=submitType_s:(";
	$corpssubmittype = "";
	$arrayKeysS = array("file", "notice", "annex");
	foreach ($arrayKeysS as $type) {
		//on ajoute la référence du doctype à l'url
		if (isset($_POST[$type])) {
			$checkedT = true;
			$corpssubmittype.= $type." OR ";
		}
	}
	$submittype .= urlencode($corpssubmittype);
	//on enlève le dernier "OR"
	$submittype = substr($submittype, 0, -4).")";

	//construction finale de l'url. A noter que les recherches s'effectuent à l'ICA seulement dans ce cas-là, et le format de retour est json
	//$mot correspond au mot recherché, $doctype aux cases cochées pour le type de document, $submittype aux cases cochées pour le type de dépôt, $start pour commencer à partir d'un certain résultat si on est sur une page autre que la 1
	if (isset($_POST['annee1']) && isset($_POST['annee2']) && $checked && $checkedT) {
      $url = 'https://api.archives-ouvertes.fr/search/ICA/?q='.$doctype.$submittype.'&wt=json&fq=producedDateY_i:['.$_POST['annee1'].'%20TO%20'.$_POST['annee2'].']&rows=10000&fl=docid,uri_s,localReference_s,docType_s,producedDateY_i,authFullName_s,title_s,doiId_s,subTitle_s,journalTitle_s,volume_s,page_s,journalPublisher_s,conferenceTitle_s,classification_s,city_s,country_s,invitedCommunication_s,peerReviewing_s,popularLevel_s,issue_s';
  } else {
		 $url = 'https://api.archives-ouvertes.fr/search/ICA/?q=&wt=json&rows=10000&fl=docid,uri_s,localReference_s,docType_s,producedDateY_i,authFullName_s,title_s,doiId_s,subTitle_s,journalTitle_s,volume_s,page_s,journalPublisher_s,conferenceTitle_s,classification_s,city_s,country_s,invitedCommunication_s,peerReviewing_s,popularLevel_s,issue_s';
	}

	//utilisation de curl pour récupérer le json
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);
	//on transforme le json en array php
	$json = json_decode($data, true);

	//Affichage du nombre de résultats
	$nbResultats = $json['response']['numFound'];
	$strNbResultats = $nbResultats;

	echo '<b>'.TXT_PRODUCTIONS_PUBLICATIONS.'</b><br />';		

	//si l'utilisateur est après la dernière page -> message d'erreur
	if ($nbResultats > 0) {
		/*	echo "<br />";
		//s'il y a plus d'1 résultat
		if ($nbResultats > 1) {
		  $strNbResultats.=" r&eacute;sultats correspondant &agrave; la recherche :"; //pluriel
		} else {
		  $strNbResultats.=" r&eacute;sultat correspondant &agrave; la recherche";
		}
		echo $strNbResultats;*/
		 
		//ce compteur n'est pas le même que nbResultats, car un tri est effectué sur le résultat renvoyé en json, il faut donc un deuxième compteur
		$nbRes = 0;
		echo "<table width=\"100%\" class=\" tab_publications tablesorter {sortlist: [[1,2],[0,1]]}\"><col width ='6%'><col width ='5%'><col width ='80%'><col width ='9%'>"."<THEAD>"."<tr>"."<th>".TXT_ANNEE_PUBLICATIONS."</th><th>".TXT_TYPE_PUBLICATIONS."</th><th>".TXT_AUTEURDOC_PUBLICATIONS."</th><th>".TXT_LIENS_PUBLICATIONS."</th></tr></THEAD><TBODY>";
      
    if (!empty($groupe)) {
        
        	foreach ($json['response']['docs'] as $docs) {
              //on initialisie à faux la variable du groupe correspondant, et du référencement
              $groupeFound = false;
              $refFound = false;
              //on compte le nombre de lignes dans localReference_s
              $nbRef = count($docs['localReference_s']);
              for ($v = 0; $v < $nbRef; $v++) {
                //Si une ligne correspond au groupe recherché, on passe et reste à true et le résultat sera affiché
                if ($docs['localReference_s'][$v] == $groupe) {
                  $groupeFound = true;
                }
			        }                               
		          // Si il y a une référence
              if (isset($ref)) {
				        //Si on veut les publis WOS ou SCOPUS
                if ($ref == 'WOS') {
					        $refFound = true;
                  if (!empty($docs['classification_s'])) {
                    foreach ($docs['classification_s'] as $class) {
                      if ($class == "NR") {
                        $refFound = false;
                      }
                    }
                  }
			          //Si on veut les ACLN
                } else {
                  if (!empty($docs['classification_s'])) {
                    foreach ($docs['classification_s'] as $class) {
                      if ($class == "NR") {
                        $refFound = true;
                      }
                    }
                  }
				        }
				      } else {
					      $refFound = true;
				      }
              
              if ($groupeFound && $refFound) {
                if($docs['docType_s']=="COMM"){
                  
                   if($isCOM =="non" && $isINV=="oui"){
                     if($docs['invitedCommunication_s']!=0){
                        
                        $nbRes++;
                       //affichage de toutes les données relatives à une publication
                      affichagePublicationAvancee($docs);
                       
                     }//FIN DU TRI DES INV
                   }elseif($isCOM =="oui" && $isINV=="non"){
                     if($docs['invitedCommunication_s']==0){
                       $nbRes++;
                       //affichage de toutes les données relatives à une publication
                      affichagePublicationAvancee($docs);
                     }//FIN TRI DES COMM
                   }else{
                      
                     $nbRes++;
                    //affichage de toutes les données relatives à une publication
                      affichagePublicationAvancee($docs);
                   }//FIN DU SI INV ET COMM OU AUCUN DES DEUX 
                }else{
                  $nbRes++;
                   //affichage de toutes les données relatives à une publication
                      affichagePublicationAvancee($docs);
                }//FIN DU SI DOCTYPE PAS COMM
              }
         }
       } else {
            
            foreach ($json['response']['docs'] as $docs) {
              
              //on initialisie à faux la variable du groupe correspondant, et du référencement
              $refFound = false;
              // Si il y a une référence
              if (isset($ref)) {
                //Si on veut les publis WOS ou SCOPUS
                if ($ref == 'WOS') {
                  $refFound = true;
                  if (!empty($docs['classification_s'])) {
                    foreach ($docs['classification_s'] as $class) {
                      if ($class == "NR") {
                        $refFound = false;
                      }
                    }
                  }
                  //Si on veut les ACLN
                } else {
                  if (!empty($docs['classification_s'])) {
                    foreach ($docs['classification_s'] as $class) {
                      if ($class == "NR") {
                        $refFound = true;<?php

include ('codes snippet/fonctions_snippet.php');

//détection de langue courante de la page
$currentlang = get_bloginfo('language');

if(strpos($currentlang,'fr')!==false){
  include('codes snippet/lang-fr.php');
}elseif(strpos($currentlang,'en')!==false){
  include('codes snippet/lang-en.php');
}else{
  echo("échec de reconnaissance de la langue");
}

function docTypeConvert ($doctype,$invited,$peerReview,$vulgarisation) {
        
        switch ($doctype) {
            
          case 'ART' :
            if($peerReview !=1 || $vulgarisation !=0){
              return 'ASCL';
            }else{
              return 'ACL';
            }            
            break;
          case 'COMM' :
            if($invited !=0){
               return 'INV';
            }else{
               return 'COM';
            }
            break;
          case 'COUV' :
            return 'CO';
            break;
          case 'OUV' :
            return 'O';
            break;
          case 'DOUV' :
            return 'DO';
            break;
          case 'POSTER' :
            return 'P';
            break;
          case 'PATENT' :
            return 'B';
            break;
          case 'THESE' :
            return 'PhD';
            break;
          case 'HDR' :
            return 'HDR';
            break;
          default : 
            return 'AP';
            break;
        }
      }
	//verification qu'une des cases a été cochée
	$cheked = false;
	$checkedT = false;

  $groupe= "";
	//recuperer le groupe et le référencement choisis
  if (isset($_POST['groupe'])) {
    if ($_POST['groupe'] != 'labo') {
	    $groupe = $_POST['groupe'];
    }
  }
  if (isset($_POST['ISI'])) {
	$ref = 'WOS';
  }

  if (isset($_POST['NR'])) {
	$ref = 'NR';
  }


  $isINV="non";
  $isCOM="non";
	//formation de l'url en fonction des cases (docType) cochées
	$doctype = "&fq=docType_s:(";
	$corpsdoctype = "";
	
  $arrayKeys = array("ART", "COMM", "INV","COUV", "OTHER","OUV","DOUV","POSTER","PATENT","UNDEFINED","REPORT","THESE","HDR","LECTURE","IMG","VIDEO","MAP","SON");
	foreach ($arrayKeys as $name) {
		//on ajoute la référence du doctype à l'url
		if (isset($_POST[$name])) {
			$checked = true;
      
     if(strpos($name,"INV") !== false){
      
        $isINV="oui";
       
        if(strpos($corpsdoctype,"COMM")!== true){
          
          $corpsdoctype.= "COMM OR ";
        }
      }else{
       
			  $corpsdoctype.= $name." OR ";
      }
      if(strpos($name,"COMM")!==false){
       
        $isCOM="oui";
      }
		}
	}
	$doctype .= urlencode($corpsdoctype);
	//on enlève le dernier "OR"
	$doctype = substr($doctype, 0, -4).")";

	//formation de l'url en fonction des cases (submitType) cochées 
	$submittype = "&fq=submitType_s:(";
	$corpssubmittype = "";
	$arrayKeysS = array("file", "notice", "annex");
	foreach ($arrayKeysS as $type) {
		//on ajoute la référence du doctype à l'url
		if (isset($_POST[$type])) {
			$checkedT = true;
			$corpssubmittype.= $type." OR ";
		}
	}
	$submittype .= urlencode($corpssubmittype);
	//on enlève le dernier "OR"
	$submittype = substr($submittype, 0, -4).")";

	//construction finale de l'url. A noter que les recherches s'effectuent à l'ICA seulement dans ce cas-là, et le format de retour est json
	//$mot correspond au mot recherché, $doctype aux cases cochées pour le type de document, $submittype aux cases cochées pour le type de dépôt, $start pour commencer à partir d'un certain résultat si on est sur une page autre que la 1
	if (isset($_POST['annee1']) && isset($_POST['annee2']) && $checked && $checkedT) {
      $url = 'https://api.archives-ouvertes.fr/search/ICA/?q='.$doctype.$submittype.'&wt=json&fq=producedDateY_i:['.$_POST['annee1'].'%20TO%20'.$_POST['annee2'].']&rows=10000&fl=docid,uri_s,localReference_s,docType_s,producedDateY_i,authFullName_s,title_s,doiId_s,subTitle_s,journalTitle_s,volume_s,page_s,journalPublisher_s,conferenceTitle_s,classification_s,city_s,country_s,invitedCommunication_s,peerReviewing_s,popularLevel_s,issue_s';
  } else {
		 $url = 'https://api.archives-ouvertes.fr/search/ICA/?q=&wt=json&rows=10000&fl=docid,uri_s,localReference_s,docType_s,producedDateY_i,authFullName_s,title_s,doiId_s,subTitle_s,journalTitle_s,volume_s,page_s,journalPublisher_s,conferenceTitle_s,classification_s,city_s,country_s,invitedCommunication_s,peerReviewing_s,popularLevel_s,issue_s';
	}

	//utilisation de curl pour récupérer le json
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);
	//on transforme le json en array php
	$json = json_decode($data, true);

	//Affichage du nombre de résultats
	$nbResultats = $json['response']['numFound'];
	$strNbResultats = $nbResultats;

	echo '<b>'.TXT_PRODUCTIONS_PUBLICATIONS.'</b><br />';		

	//si l'utilisateur est après la dernière page -> message d'erreur
	if ($nbResultats > 0) {
		/*	echo "<br />";
		//s'il y a plus d'1 résultat
		if ($nbResultats > 1) {
		  $strNbResultats.=" r&eacute;sultats correspondant &agrave; la recherche :"; //pluriel
		} else {
		  $strNbResultats.=" r&eacute;sultat correspondant &agrave; la recherche";
		}
		echo $strNbResultats;*/
		 
		//ce compteur n'est pas le même que nbResultats, car un tri est effectué sur le résultat renvoyé en json, il faut donc un deuxième compteur
		$nbRes = 0;
		echo "<table width=\"100%\" class=\" tab_publications tablesorter {sortlist: [[1,2],[0,1]]}\"><col width ='6%'><col width ='5%'><col width ='80%'><col width ='9%'>"."<THEAD>"."<tr>"."<th>".TXT_ANNEE_PUBLICATIONS."</th><th>".TXT_TYPE_PUBLICATIONS."</th><th>".TXT_AUTEURDOC_PUBLICATIONS."</th><th>".TXT_LIENS_PUBLICATIONS."</th></tr></THEAD><TBODY>";
      
    if (!empty($groupe)) {
        
        	foreach ($json['response']['docs'] as $docs) {
              //on initialisie à faux la variable du groupe correspondant, et du référencement
              $groupeFound = false;
              $refFound = false;
              //on compte le nombre de lignes dans localReference_s
              $nbRef = count($docs['localReference_s']);
              for ($v = 0; $v < $nbRef; $v++) {
                //Si une ligne correspond au groupe recherché, on passe et reste à true et le résultat sera affiché
                if ($docs['localReference_s'][$v] == $groupe) {
                  $groupeFound = true;
                }
			        }                               
		          // Si il y a une référence
              if (isset($ref)) {
				        //Si on veut les publis WOS ou SCOPUS
                if ($ref == 'WOS') {
					        $refFound = true;
                  if (!empty($docs['classification_s'])) {
                    foreach ($docs['classification_s'] as $class) {
                      if ($class == "NR") {
                        $refFound = false;
                      }
                    }
                  }
			          //Si on veut les ACLN
                } else {
                  if (!empty($docs['classification_s'])) {
                    foreach ($docs['classification_s'] as $class) {
                      if ($class == "NR") {
                        $refFound = true;
                      }
                    }
                  }
				        }
				      } else {
					      $refFound = true;
				      }
              
              if ($groupeFound && $refFound) {
                if($docs['docType_s']=="COMM"){
                  
                   if($isCOM =="non" && $isINV=="oui"){
                     if($docs['invitedCommunication_s']!=0){
                        
                        $nbRes++;
                       //affichage de toutes les données relatives à une publication
                      affichagePublicationAvancee($docs);
                       
                     }//FIN DU TRI DES INV
                   }elseif($isCOM =="oui" && $isINV=="non"){
                     if($docs['invitedCommunication_s']==0){
                       $nbRes++;
                       //affichage de toutes les données relatives à une publication
                      affichagePublicationAvancee($docs);
                     }//FIN TRI DES COMM
                   }else{
                      
                     $nbRes++;
                    //affichage de toutes les données relatives à une publication
                      affichagePublicationAvancee($docs);
                   }//FIN DU SI INV ET COMM OU AUCUN DES DEUX 
                }else{
                  $nbRes++;
                   //affichage de toutes les données relatives à une publication
                      affichagePublicationAvancee($docs);
                }//FIN DU SI DOCTYPE PAS COMM
              }
         }
       } else {
            
            foreach ($json['response']['docs'] as $docs) {
              
              //on initialisie à faux la variable du groupe correspondant, et du référencement
              $refFound = false;
              // Si il y a une référence
              if (isset($ref)) {
                //Si on veut les publis WOS ou SCOPUS
                if ($ref == 'WOS') {
                  $refFound = true;
                  if (!empty($docs['classification_s'])) {
                    foreach ($docs['classification_s'] as $class) {
                      if ($class == "NR") {
                        $refFound = false;
                      }
                    }
                  }
                  //Si on veut les ACLN
                } else {
                  if (!empty($docs['classification_s'])) {
                    foreach ($docs['classification_s'] as $class) {
                      if ($class == "NR") {
                        $refFound = true;
                      }
                    }
                  }
                }
              } else {
                 $refFound = true;
              }

               if ($refFound) {
                 if($docs['docType_s']=="COMM"){
                  
                   if($isCOM =="non" && $isINV=="oui"){
                     if($docs['invitedCommunication_s']!=0){
                        $nbRes++;
                      //affichage de toutes les données relatives à une publication
                      affichagePublicationAvancee($docs);
                     }//FIN TRI INV
                   }elseif($isCOM =="oui" && $isINV=="non"){
                     if($docs['invitedCommunication_s']==0){
                       $nbRes++;
                       //affichage de toutes les données relatives à une publication
                      affichagePublicationAvancee($docs);
                     }//FIN TRI DES COMM
                   }else{
                     $nbRes++;
                       //affichage de toutes les données relatives à une publication
                      affichagePublicationAvancee($docs);
                   }//FIN SI COMM ET INV OU AUCUN
                 }else{
                    $nbRes++;
                    //affichage de toutes les données relatives à une publication
                      affichagePublicationAvancee($docs);
                }//FIN SI DOCTYPE PAS COMM
               }
            }
       }
       echo "</TBODY></table><br>";
    
    //différents affichages en fonction du nombre de résultat 
		if ($nbRes == 0) {
			  echo TXT_AUCUNEPROD_PUBLICATIONS; 
			  echo "<br><br>";
		} else if ($nbRes == 1) {
			  echo $nbRes.TXT_CONTRIBUTION_PUBLICATIONS; 
          if ( is_user_logged_in() ) {
            echo "<br /><br /><FORM METHOD='POST' ACTION='../../../excelPublications.php' CLASS='form-publi'>";
            echo '<input type="hidden" name="url" value='.$url.'>';
            if (!empty($groupe)) {
              echo '<input type="hidden" name="grp" value='.$groupe.'>';
            }
            if (!empty($ref)) {
              echo '<input type="hidden" name="ref" value='.$ref.'>';
            }


            
            echo "<br /><button type=submit class='spanExcel'><i class='fa fa-table'></i>&nbsp &nbsp &nbsp".TXT_TELECHARGER_PUBLICATIONS."</button><br /></FORM>";
           }
	      echo "<br><br>";

		} else {
			  echo $nbRes.TXT_CONTRIBUTIONS_PUBLICATIONS;   
          if ( is_user_logged_in() ) {
            echo "<br /><br /><FORM METHOD='POST' ACTION='http://institut-clement-ader.org/excel-des-publications/' CLASS='form-publi'>";
            echo '<input type="hidden" name="url" value='.$url.'>';
            if (!empty($groupe)) {
              echo '<input type="hidden" name="grp" value='.$groupe.'>';
            }

            if (!empty($ref)) {
              echo '<input type="hidden" name="ref" value='.$ref.'>';
            }

            echo "<br /><button type=submit class='spanExcel'><i class='fa fa-table'></i>&nbsp &nbsp &nbsp".TXT_TELECHARGER_PUBLICATIONS."</button><br /></FORM>";
          }
			  echo "<br><br>";

		}
		
  } else {
		echo '<b>'.TXT_PRODUCTIONS_PUBLICATIONS.'</b><br />';
		echo TXT_AUCUNEPROD_PUBLICATIONS; 
		echo "<br><br>";
    
  }
?>