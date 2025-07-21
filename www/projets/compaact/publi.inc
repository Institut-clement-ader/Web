<?php 

include("sql.inc");
$connection=mysql_connect($serveur,$utilisateur,$password);
$base=mysql_select_db($db,$connection);
if(!$base){echo "connection non &eacute;tablie";}
$texte="<h1> Publications </h1>";


$requete="SELECT * FROM vertex_publi ORDER BY vertex_publi.year DESC,vertex_publi.ref DESC;";
$resultat=mysql_query($requete);
$ycompt='0000';
$ipub=1;
while($ligne=mysql_fetch_row($resultat)){
	$ref=$ligne[0];
	$year=$ligne[1];
	$authors=$ligne[2];
	$title=$ligne[3];
	$journal=$ligne[4];
	$proc=$ligne[5];
	$lieu=$ligne[6];
	$chap=$ligne[7];
	$inbook=$ligne[8];
	$num=$ligne[9];
	$vol=$ligne[10];
	$pages=$ligne[11];
	$draft=$ligne[12];
	$doi=$ligne[13];
	$hal=$ligne[14];
	$isbn=$ligne[15];
	$edition=$ligne[16];
	$international=$ligne[17];
	$type=$ligne[18];
	$special=$ligne[20];
	if($ycompt!=$year){
		$ycompt=$year;
		$texte.="<br>";
		$texte.="<h3>".$ycompt."</h3><hr>";
	}
	$texte.="<b>".$authors.". </b><a href=\"publi.php?id=".$ref."\" title=\"more informations\" >".htmlentities($title)."</a>. ";
	//$texte.="<b>[".$ipub."] ".$authors.". </b><a href=\"publi.php?id=".$ref."\" title=\"more informations\" >".htmlentities($title)."</a>.<br>";
	if($journal) $texte.="<i>";
	if($proc)$texte.="Proceedings of ";
	if($journal) $texte.=htmlentities($journal).".</i> ";
	if($lieu) $texte.=$lieu.". ";
	if($inbook){
		$texte.="In book ".$inbook;
		if($chap) $texte.=", Chap. ".$chap.". ";
		else $texte.=". ";
	}
	if($edition) $texte.="Ed. ".$edition.". ";
	if($vol) $texte.="Vol. ".$vol." ";
	if($num) $texte.="Num. ".$num." ";
	if($pages) $texte.="pp. ".$pages.". ";
	$texte.="<b>".$special." ".$year."</b> ";
	if($doi) $texte.="<a href=\"http://dx.doi.org/".$doi."\">[DOI]</a> ";
	if($hal) $texte.="<a href=\"http://hal.archives-ouvertes.fr/".$hal."\">[HAL]</a> ";

	if($isbn) $texte.="(ISBN:".$isbn.")";

	$texte.="<br>";
	$ipub++;
}


?>
