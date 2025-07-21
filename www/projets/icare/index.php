<!DOCTYPE html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>ANR ICARE Project</title> 
<link type="text/css" rel="stylesheet" media="all" href="menus.css?Y" /> 
<link type="text/css" rel="stylesheet" media="all" href="lacan_style.css?Y" />
<link rel="icon" type="image/png" href="/projets/icare/anr.png" />
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
	    <a href="http://www.agence-nationale-recherche.fr/projet-anr/?tx_lwmsuivibilan_pi2%5BCODE%5D=ANR-12-MONU-0002" title="Agence Nationale de la Recheche"><img src="anr.png" height=40 ></a>
        
          
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

switch($id){
case "publi" : include("publi.inc");break;
case "partners" : include("partners.inc");break;
case "news" : include("news.inc");break;
default : include("home.inc");break;
}
echo "<br> $texte";

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
