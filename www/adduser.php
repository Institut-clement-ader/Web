<meta charset="UTF-8">	
<?php


// CONNEXION A LA BASE
$serveur="mysql2.lamp.ods";
$utilisateur="lab0612sql3";
$password="XY02b21aBLaq";
$db="lab0612sql3db";
$dns="http://institut-clement-ader.org";
$connection=@mysql_connect($serveur,$utilisateur,$password);
if(!$connection){
	echo "<!DOCTYPE html>
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<title>Institut Clément Ader</title>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<link rel=\"icon\" type=\"image/png\" href=\"fichiers/logos/favicon.ico\" />
<link type=\"text/css\" rel=\"stylesheet\" media=\"all\" href=\"menu.css?W\" />
<link type=\"text/css\" rel=\"stylesheet\" media=\"all\" href=\"style.css?W\" />
    <!--[if lt IE 7]>
      <link type=\"text/css\" rel=\"stylesheet\" media=\"all\"  href=\"fix-ie.css\" />    <![endif]-->

  </head>
  <body><h4>This website is temporarily unavailable, please try again later...</h4>
(Unable to connect to SQL server) 
</body>
</html>";
exit();
}
mysql_set_charset('utf8',$connection);
$base=mysql_select_db($db,$connection);


/*	$requete="INSERT IGNORE INTO `wp_users`(`user_login`, `user_nicename`, `user_email`, `display_name`)
SELECT id, id, email, CONCAT(prenom, ' ', nom) FROM personnelWP2;";
	$resultat=mysql_query($requete);
if ($resultat) {
  echo "yes";
} else echo "non";*/

// Ajouter la colonne num à personnelWP qui correspond à l'id dans wp_users
/*$requete2 = "UPDATE personnelWP2 
SET personnelWP2.num = (SELECT wp_users.id FROM wp_users WHERE wp_users.user_login = personnelWP2.id);";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";*/



/*$requete = "SELECT wp_users.ID, wp_users.display_name FROM wp_users, personnelWP WHERE wp_users.user_login = personnelWP.id;";
$resultat = mysql_query($requete);
$userName = "";
 while($ligne=mysql_fetch_row($resultat)){
	$userName.= $ligne[1].", ID : ".$ligne[0]."<br />";
 }
echo $userName;*/



// MISE A JOUR DES UTILISATEURS DANS WP_USERMETA GRACE A LA BDD PERSONNELWP
/*
//  activit_de_recherche
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.textrech FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'activit_de_recherche';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

//enseignement
$requete3 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.textens FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'activit_enseig';";
$res2 = mysql_query($requete3);
if ($res2) {
  echo "yes";
}else echo "non";

//resp collectives
$requete3 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.textcoll FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'resp_coll';";
$res2 = mysql_query($requete3);
if ($res2) {
  echo "yes";
}else echo "non";

//telephone rech
$requete3 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.telephone FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'tlphone_recherche';";
$res2 = mysql_query($requete3);
if ($res2) {
  echo "yes";
}else echo "non";

//etablissement de rattachement
$requete3 = "UPDATE wp_usermeta SET meta_value = 'IMT Mines Albi' WHERE meta_key = 'tablissement_de_rattachement' and meta_value = 'IMT MINES ALBI';";
$res2 = mysql_query($requete3);
if ($res2) {
  echo "yes";
}else echo "non";


$requete3 = "UPDATE wp_users SET user_email = REPLACE(user_email, 'mines-albi.fr', 'imt-mines-albi.fr') WHERE user_email LIKE '%mines-albi.fr';";
$res2 = mysql_query($requete3);
if ($res2) {
  echo "yes";
}else echo "non";


//num bureau
$requete3 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.bureau FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'office_num';";
$res2 = mysql_query($requete3);
if ($res2) {
  echo "yes";
}else echo "non";

//first name
$requete3 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.prenom FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'first_name';";
$res2 = mysql_query($requete3);
if ($res2) {
  echo "yes";
}else echo "non";
*/
//last name
/*$requete3 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.nom FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'last_name';";
$res2 = mysql_query($requete3);
if ($res2) {
  echo "yes";
}else echo "non";
*/
/*
//nickname
$requete3 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.id FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'nickname';";
$res2 = mysql_query($requete3);
if ($res2) {
  echo "yes";
}else echo "non";
*/
/*
//  groupe primaire
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.groupe FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'groupe_primaire';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";




//  statut
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.statut FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'status';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";



//  statut
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.adresse FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'actv_rech';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";


//  statut eca
$requete2 = "UPDATE wp_usermeta SET meta_value = 'ECA Montaudran' WHERE meta_value = 'eca';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";



//  statut mines
$requete2 = "UPDATE wp_usermeta SET meta_value = 'Mines Albi' WHERE meta_value = 'mines';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";



//  statut iut
$requete2 = "UPDATE wp_usermeta SET meta_value = 'IUT de Tarbes' WHERE meta_value = 'iuttarbes';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";
*/

/*
//  axe primaire
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.axe FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'axe_primaire';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";


//  groupe secondaire
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.groupe2 FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'groupe_secondaire';"; 
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

//  axe secondaire
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.axe2 FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'axe_secondaire';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

//  groupe tertiaire
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.groupe3 FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'groupe_tertiaire';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

//  axe tertiaire
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.axe3 FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'axe_tertiaire';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";
*/

/*//  hdr
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.hdr FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'hdr';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";
*/
/*
//  act adm
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.textadm FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'activit_adm';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

//  act tech
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.texttech FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'activit_tech';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";


//  autre
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.textautre FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'misc';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";
*/
/*
//  autre
$requete2 = "UPDATE wp_usermeta SET meta_value = 'Mines Albi' WHERE meta_key = 'tablissement_de_rattachement' AND meta_value = 'emac';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";
*/
/*


echo "<optgroup label=\"MICS\">";
  echo "<option value=\"MICS\"> Tout le groupe MICS </option>";
  echo "<option value=\"moimdt\"> Axe MOIMDT (Méthodes optiques innovantes pour la métrologie dimensionnelle et thermique) </option>";
  echo "<option value=\"icptm\"> Axe ICPTM (Identification et contrôle de propriétés the<meta charset="UTF-8">	
<?php


// CONNEXION A LA BASE
$serveur="mysql2.lamp.ods";
$utilisateur="lab0612sql3";
$password="6kU737oCZcfR";
$db="lab0612sql3db";
$dns="http://institut-clement-ader.org";
$connection=@mysql_connect($serveur,$utilisateur,$password);
if(!$connection){
	echo "<!DOCTYPE html>
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<title>Institut Clément Ader</title>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<link rel=\"icon\" type=\"image/png\" href=\"fichiers/logos/favicon.ico\" />
<link type=\"text/css\" rel=\"stylesheet\" media=\"all\" href=\"menu.css?W\" />
<link type=\"text/css\" rel=\"stylesheet\" media=\"all\" href=\"style.css?W\" />
    <!--[if lt IE 7]>
      <link type=\"text/css\" rel=\"stylesheet\" media=\"all\"  href=\"fix-ie.css\" />    <![endif]-->

  </head>
  <body><h4>This website is temporarily unavailable, please try again later...</h4>
(Unable to connect to SQL server) 
</body>
</html>";
exit();
}
mysql_set_charset('utf8',$connection);
$base=mysql_select_db($db,$connection);


/*	$requete="INSERT IGNORE INTO `wp_users`(`user_login`, `user_nicename`, `user_email`, `display_name`)
SELECT id, id, email, CONCAT(prenom, ' ', nom) FROM personnelWP2;";
	$resultat=mysql_query($requete);
if ($resultat) {
  echo "yes";
} else echo "non";*/

// Ajouter la colonne num à personnelWP qui correspond à l'id dans wp_users
/*$requete2 = "UPDATE personnelWP2 
SET personnelWP2.num = (SELECT wp_users.id FROM wp_users WHERE wp_users.user_login = personnelWP2.id);";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";*/



/*$requete = "SELECT wp_users.ID, wp_users.display_name FROM wp_users, personnelWP WHERE wp_users.user_login = personnelWP.id;";
$resultat = mysql_query($requete);
$userName = "";
 while($ligne=mysql_fetch_row($resultat)){
	$userName.= $ligne[1].", ID : ".$ligne[0]."<br />";
 }
echo $userName;*/



// MISE A JOUR DES UTILISATEURS DANS WP_USERMETA GRACE A LA BDD PERSONNELWP
/*
//  activit_de_recherche
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.textrech FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'activit_de_recherche';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

//enseignement
$requete3 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.textens FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'activit_enseig';";
$res2 = mysql_query($requete3);
if ($res2) {
  echo "yes";
}else echo "non";

//resp collectives
$requete3 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.textcoll FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'resp_coll';";
$res2 = mysql_query($requete3);
if ($res2) {
  echo "yes";
}else echo "non";

//telephone rech
$requete3 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.telephone FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'tlphone_recherche';";
$res2 = mysql_query($requete3);
if ($res2) {
  echo "yes";
}else echo "non";

//etablissement de rattachement
$requete3 = "UPDATE wp_usermeta SET meta_value = 'IMT Mines Albi' WHERE meta_key = 'tablissement_de_rattachement' and meta_value = 'IMT MINES ALBI';";
$res2 = mysql_query($requete3);
if ($res2) {
  echo "yes";
}else echo "non";


$requete3 = "UPDATE wp_users SET user_email = REPLACE(user_email, 'mines-albi.fr', 'imt-mines-albi.fr') WHERE user_email LIKE '%mines-albi.fr';";
$res2 = mysql_query($requete3);
if ($res2) {
  echo "yes";
}else echo "non";


//num bureau
$requete3 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.bureau FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'office_num';";
$res2 = mysql_query($requete3);
if ($res2) {
  echo "yes";
}else echo "non";

//first name
$requete3 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.prenom FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'first_name';";
$res2 = mysql_query($requete3);
if ($res2) {
  echo "yes";
}else echo "non";
*/
//last name
/*$requete3 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.nom FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'last_name';";
$res2 = mysql_query($requete3);
if ($res2) {
  echo "yes";
}else echo "non";
*/
/*
//nickname
$requete3 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.id FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'nickname';";
$res2 = mysql_query($requete3);
if ($res2) {
  echo "yes";
}else echo "non";
*/
/*
//  groupe primaire
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.groupe FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'groupe_primaire';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";




//  statut
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.statut FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'status';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";



//  statut
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.adresse FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'actv_rech';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";


//  statut eca
$requete2 = "UPDATE wp_usermeta SET meta_value = 'ECA Montaudran' WHERE meta_value = 'eca';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";



//  statut mines
$requete2 = "UPDATE wp_usermeta SET meta_value = 'Mines Albi' WHERE meta_value = 'mines';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";



//  statut iut
$requete2 = "UPDATE wp_usermeta SET meta_value = 'IUT de Tarbes' WHERE meta_value = 'iuttarbes';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";
*/

/*
//  axe primaire
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.axe FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'axe_primaire';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";


//  groupe secondaire
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.groupe2 FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'groupe_secondaire';"; 
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

//  axe secondaire
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.axe2 FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'axe_secondaire';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

//  groupe tertiaire
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.groupe3 FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'groupe_tertiaire';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

//  axe tertiaire
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.axe3 FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'axe_tertiaire';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";
*/

/*//  hdr
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.hdr FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'hdr';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";
*/
/*
//  act adm
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.textadm FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'activit_adm';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

//  act tech
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.texttech FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'activit_tech';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";


//  autre
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.textautre FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'misc';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";
*/
/*
//  autre
$requete2 = "UPDATE wp_usermeta SET meta_value = 'Mines Albi' WHERE meta_key = 'tablissement_de_rattachement' AND meta_value = 'emac';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";
*/
/*


echo "<optgroup label=\"MICS\">";
  echo "<option value=\"MICS\"> Tout le groupe MICS </option>";
  echo "<option value=\"moimdt\"> Axe MOIMDT (Méthodes optiques innovantes pour la métrologie dimensionnelle et thermique) </option>";
  echo "<option value=\"icptm\"> Axe ICPTM (Identification et contrôle de propriétés thermiques et mécaniques) </option>";

echo "<optgroup label=\"Axes transverses\">";
  echo "<option value=\"asm\"> Axe ASM (Assemblages) </option>";
  echo "<option value=\"umm\"> Axe UMM (Usinage multi-matériaux) </option>";
  */
/*
$requete2 = "UPDATE wp_usermeta SET meta_value = 'Fatigue, Modélisation, Endommagement et Usure (SUMO)' WHERE meta_key = 'axe_tertiaire' AND meta_value = 'fameu';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

$requete2 = "UPDATE wp_usermeta SET meta_value = 'Propriétés d\'usage et microstructures des matériaux avancés (SUMO)' WHERE meta_key = 'axe_tertiaire' AND meta_value = 'pumma';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

$requete2 = "UPDATE wp_usermeta SET meta_value = 'Usinage et mise en forme (SUMO)' WHERE meta_key = 'axe_tertiaire' AND meta_value = 'usimef';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

$requete2 = "UPDATE wp_usermeta SET meta_value = 'Structures Impact Modélisation Usinage (MSC)' WHERE meta_key = 'axe_tertiaire' AND meta_value = 'simu';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

$requete2 = "UPDATE wp_usermeta SET meta_value = 'Matériaux, Propriétés et Procédés (MSC)' WHERE meta_key = 'axe_tertiaire' AND meta_value = 'mapp';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

$requete2 = "UPDATE wp_usermeta SET meta_value = 'Ingénierie des systèmes et des microsystèmes (MS2M)' WHERE meta_key = 'axe_tertiaire' AND meta_value = 'ism';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

$requete2 = "UPDATE wp_usermeta SET meta_value = 'Intégrité des structures et des systèmes (MS2M)' WHERE meta_key = 'axe_tertiaire' AND meta_value = 'iss';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

$requete2 = "UPDATE wp_usermeta SET meta_value = 'Méthodes optiques innovantes pour la métrologie dimensionnelle et thermique (MICS)' WHERE meta_key = 'axe_tertiaire' AND meta_value = 'moimdt';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

$requete2 = "UPDATE wp_usermeta SET meta_value = 'Identification et contrôle de propriétés thermiques et mécaniques (MICS)' WHERE meta_key = 'axe_tertiaire' AND meta_value = 'icptm';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

$requete2 = "UPDATE wp_usermeta SET meta_value = 'Assemblages (AXTR)' WHERE meta_key = 'axe_tertiaire' AND meta_value = 'asm';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

$requete2 = "UPDATE wp_usermeta SET meta_value = 'Usinage multi-matériaux (AXTR)' WHERE meta_key = 'axe_tertiaire' AND meta_value = 'umm';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";
*/
/*
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT tmp_personnel.display FROM tmp_personnel, personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id AND personnelWP2.id = tmp_personnel.id) WHERE meta_key = 'display_user';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";
*/
/*
try{
	$bdd = new PDO('mysql:host='.$serveur.';dbname='.$db, $utilisateur, $password);
}catch(PDOException $e){
	print "Erreur : ".$e->getMessage();
	die();
}

  $id = 85;
	// si il y a un id, on remet le display à 1 dans la base wp_usermeta
	$requete="UPDATE wp_usermeta SET meta_value = 1 WHERE user_id = :id AND meta_key = 'display_user';";
  $req = $bdd->prepare($requete);
  $req->execute(array('id'=>$id));
if ($req) {
  echo "yes";
}else echo "non";
*/
/*
$requete2 = "UPDATE wp_usermeta SET meta_value = 'Propriétés d usage et microstructures des matériaux avancés (SUMO)' WHERE meta_key = 'axe_tertiaire' AND meta_value = 'Propriétés d''usage et microstructures des matériaux avancés (SUMO)';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";
*/


/*
$requete2 = "UPDATE wp_usermeta SET meta_value = 'a:1:{s:6:\"member\";b:1;}' WHERE meta_key = 'wp_capabilities' AND meta_value = 'a:0:{}';";
echo $requete2;

$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";
*/
/*
//arrivee
$requete2 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.arrivee FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'arrivee';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

//depart
$requete3 = "UPDATE wp_usermeta SET meta_value = (SELECT personnelWP2.depart FROM personnelWP2 WHERE personnelWP2.num = wp_usermeta.user_id) WHERE meta_key = 'depart';";
$res2 = mysql_query($requete3);
if ($res2) {
  echo "yes";
}else echo "non";
*/


//add default rows
/*
$cmp = 1;

while ($cmp < 4) {

$req = "INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES
(".$cmp.",'arrivee',''),
(".$cmp.",'depart','')
;";
/*
(".$cmp.",'axe_primaire',''),
(".$cmp.",'groupe_secondaire',''),
(".$cmp.",'axe_secondaire',''),
(".$cmp.",'groupe_tertiaire',''),
(".$cmp.",'axe_tertiaire',''),
(".$cmp.",'twitter',''),
(".$cmp.",'facebook',''),
(".$cmp.",'google',''),
(".$cmp.",'youtube',''),
(".$cmp.",'flickr',''),
(".$cmp.",'vimeo',''),
(".$cmp.",'linkedin',''),
(".$cmp.",'dribbble',''),
(".$cmp.",'pinterest',''),
(".$cmp.",'instagram',''),
(".$cmp.",'nickname',''),
(".$cmp.",'first_name',''),
(".$cmp.",'last_name',''),
(".$cmp.",'description',''),
(".$cmp.",'rich_editing','true'),
(".$cmp.",'syntax_highlighting','true'),
(".$cmp.",'comment_shortcuts','false'),
(".$cmp.",'admin_color','fresh'),
(".$cmp.",'use_ssl','0'),
(".$cmp.",'show_admin_bar_front','true'),
(".$cmp.",'locale',''),
(".$cmp.",'wp_capabilities','a:0:{}'),
(".$cmp.",'wp_user_level','0'),
(".$cmp.",'tlphone_recherche',''),
(".$cmp.",'tlphone_ensg',''),
(".$cmp.",'hdr','0'),
(".$cmp.",'tablissement_de_rattachement',''),
(".$cmp.",'actv_rech',''),
(".$cmp.",'office_num','0'),
(".$cmp.",'activit_de_recherche',''),
(".$cmp.",'activit_enseig',''),
(".$cmp.",'resp_coll','')
;";

$res2 = mysql_query($req);
if ($res2) {
  echo "yes";
}else echo "non";
$cmp++;
}*/


//  CORRESPONDANCE BDD
/*
//groupe primaire
$requete2 = "UPDATE wp_usermeta SET meta_value = UPPER(meta_value) WHERE meta_key = 'groupe_primaire';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";


//groupe secondaire
$requete2 = "UPDATE wp_usermeta SET meta_value = UPPER(meta_value) WHERE meta_key = 'groupe_secondaire';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

//groupe tertiaire
$requete2 = "UPDATE wp_usermeta SET meta_value = UPPER(meta_value) WHERE meta_key = 'groupe_tertiaire';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";

*/
/*
//status
$requete2 = "UPDATE wp_usermeta SET meta_value = 'Professeur associé' WHERE meta_key = 'status' AND meta_value = 'pra';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";
*/
/*
//etablissement rattachement
$requete2 = "UPDATE wp_usermeta SET meta_value = 'UPS' WHERE meta_key = 'tablissement_de_rattachement' AND meta_value = 'ups';";
$res = mysql_query($requete2);
if ($res) {
  echo "yes";
}else echo "non";
*/