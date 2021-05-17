<!DOCTYPE html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>ANR ICARE Project</title> 
<link type="text/css" rel="stylesheet" media="all" href="menus.css?Y" /> 
<link type="text/css" rel="stylesheet" media="all" href="lacan_style.css?Y" />
<link rel="icon" type="image/png" href="/ica.png" />
</head> 
<body class="sidebars"> 
 
<!-- Layout --> 
  <div id="header-region" class="clear-block"></div> 
    <div id="wrapper"> 
    <div id="container" class="clear-block"> 
     <div id="header"> 
        <div id="left-up-corner-header"></div> 
        <div id="titol-lacan"> 
          <a href="/projets/icare/" title="ANR ICARE"><div id="header-text-lacan"> <h5>ICARE Project</h5></a>
</div></div> 
        <div id="titol-upc"> 
            <a href="http://www.institut-clement-ader.org/projets/icare" title="ANR Icare"><div id="header-text-upc">ICARE ANR-12-MONU-0002</div></a>
	    <a href="http://www.agence-nationale-recherche.fr" title="Agence Nationale de la Recheche"><img src="anr.png" height=40 ></a>
        
          
        </div> 
        <div id="right-up-corner-header"></div> 
      </div> <!-- /header --> 
      
      <!--Primary links - blue bar --> 
      <div id="primary-links"> 
        <div id="left-blue-bar"></div> 
        <div id="text-primary-links"> 
<ul class="links primary-links"><li class="menu-176 first"><a href="/projets/icare/" title="Home link">Home</a></li> 
<li class="menu-166"><a href="index.php?id=news" title="See the news">News</a></li> 
<li class="menu-166"><a href="index.php?id=partners" title="See the partners">Partners</a></li> 
<li class="menu-164"><a href="index.php?id=publi" title="See the publications">Publications</a></li> 
<li class="menu-165 last"><a href="https://eroom.eads.net/eroom" title="dowloads section">e-room</a></li> 
</ul>                  </div> 
        <div id="right-blue-bar"></div> 
      </div> 
       <div id="center"><div id="squeeze"><div class="right-corner"><div class="left-corner"> 
                                                             <div class="clear-block"> 
            <div id="node-2" class="node"> 
  <div class="clear-block"> 
  <div class="content clear-block"> 
<!-- BODY OF THE DOCUMENT --> 
<?php 
$id=$_GET["id"];
include("sql.inc");
$connection=mysql_connect($serveur,$utilisateur,$password);
$base=mysql_select_db($db,$connection);
if(!$base){echo "connection non &eacute;tablie";}

$texte="<h1>Publication:</h1><br>";

$requete="SELECT * FROM icare_publi ORDER BY icare_publi.ref DESC;";
$resultat=mysql_query($requete);
while($ligne=mysql_fetch_row($resultat)){
	$ref=$ligne[0];
	if($ref==$id){
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
		$type=$ligne[18];
		$abstract=$ligne[19];
    		$special=$ligne[20];

	$texte.="<b>Year:</b> ".$year." &nbsp; &nbsp; <b>".$special."</b><br>";
	$texte.="<b>Authors:</b> ".$authors.".<br><b>Title:</b> ".htmlentities($title).".<br>";
	
	if($journal) {
	if($type=="paper") $texte.="<b>Journal: </b><i>";
	if($type=="talk") $texte.="<b>Conference: </b> ";
	$texte.=htmlentities($journal).".</i> ";
	}
	if($lieu) $texte.=$lieu.". ";
	if($inbook){
		$texte.="<b>Book:</b> ".$inbook."<br>";
		if($chap) $texte.="<b>Chapter:</b> ".$chap.". ";
		else $texte.=". ";
	}
	if($edition) $texte.="Ed. ".$edition.". ";
	if($vol) $texte.=$vol." ";
	if($num) $texte.="(".$num.") ";
	if($pages) $texte.=$pages.". <br>";
	$texte.="<br>";
	if($draft) $texte.=" <a href=\"./drafts/".$draft."\"><img src=\"pdf.gif\" border=0><b>Download the draft</b></a><br> ";
	if($doi) $texte.=" <a href=\"http://dx.doi.org/".$doi."\"><img src=\"doi.gif\" border=0><b>Digital Object Identifier</b> </a><br> ";
	if($hal) $texte.=" <a href=\"http://hal.archives-ouvertes.fr/".$hal."\"><b><img src=\"hal.gif\" border=0> HAL reference </a></b><br> ";
	if($isbn) $texte.="<b>ISBN:</b> ".$isbn;
	if($abstract){
		$texte.="<br><br>";
		$texte.="<b>Abstract: </b>".htmlentities($abstract);
	}
	$texte.="<br><br>";

	if($type=="paper"){
	$texte.="<b>Bibtex citation: </b><br>";
	$texte.="@article{";
	$texte.="pap".$ref.",<br>";
	$texte.="Author = {".$authors."},<br>";
	$texte.="Title = {".$title."},<br>";
	$texte.="Journal = {".$journal."},<br>";
	if($vol) $texte.="Volume = {".$vol."}, <br>";
	if($num) $texte.="Number = {".$num."}, <br>";
	if($pages) $texte.="Pages = {".$pages."}, <br>";
	$texte.="Year = {".$year."}}";
	}
	if($type=="book"){
	$texte.="<b>Bibtex citation: </b><br>";
	$texte.="@incollection{";
	$texte.="pap".$ref.",<br>";
	$texte.="Author = {".$authors."},<br>";
	$texte.="Title = {".$title."},<br>";
	$texte.="Booktitle = {".$inbook."},<br>";
	$texte.="Chapter = {".$chap."},<br>";
	$texte.="Publisher = {".$edition."},<br>";
	if($pages) $texte.="Pages = {".$pages."}, <br>";
	$texte.="Year = {".$year."}}";
	}

	}
}

echo $texte;

?>

 <!-- BODY OF THE DOCUMENT --> 
  <div class="clear-block"> 
    <div class="meta"> 
        </div> 
      </div> 
</div> 
</div> 
          </div> 
                    <div id="footer"></div> 
      </div></div></div></div> <!-- /.left-corner, /.right-corner, /#squeeze, /#center --> 
      <!--Primary links - blue bar --> 
      <div id="primary-links"> 
        <div id="left-blue-bar"></div> 
        <div id="text-primary-links"> 
<ul class="links primary-links"><li class="menu-176 first"><a href="/projets/icare" title="Home link">Home</a></li> 
<li class="menu-166"><a href="index.php?id=news" title="See the news">News</a></li> 
<li class="menu-166"><a href="index.php?id=partners" title="See the partners">Partners</a></li> 
<li class="menu-164"><a href="index.php?id=publi" title="See the publications">Publications</a></li> 
<li class="menu-165 last"><a href="https://eroom.eads.net/eroom" title="dowloads section">e-room</a></li> 
</ul>                
         </div> 
        <div id="right-blue-bar"></div> 
      </div> 
 
    
    </div> <!-- /container --> 
  </div> <!-- /wrapper --> 
<!-- /layout --> 
 

  </body> 
</html> 
