<!DOCTYPE html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>ANR VULCOMP 2 Project</title> 
<link type="text/css" rel="stylesheet" media="all" href="menus.css?Y" /> 
<link type="text/css" rel="stylesheet" media="all" href="lacan_style.css?Y" />
<link rel="icon" type="image/png" href="anr.png" />
</head> 
<body class="sidebars"> 
 
<!-- Layout --> 
  <div id="header-region" class="clear-block"></div> 
    <div id="wrapper"> 
    <div id="container" class="clear-block"> 
     <div id="header"> 
        <div id="left-up-corner-header"></div> 
        <div id="titol-lacan"> 
          <a href="http://www.institut-clement-ader.org/projets/icare/" title="ANR VULCOMP"><div id="header-text-lacan"> <h5>Projet VULCOMP 2</h5></a>
</div></div> 
        <div id="titol-upc"> 
            <a href="http://www.institut-clement-ader.org/projets/vulcomp2" title="ANR Vulcomp 2"><div id="header-text-upc">VULCOMP2 ANR-12-RMNP-0018</div></a>
	    <a href="http://www.agence-nationale-recherche.fr/suivi-bilan/ingenierie-procedes-securite/materiaux-et-procedes-pour-des-produits-performants/detail-des-projets-finances-matetpro/?tx_lwmsuivibilan_pi2%5BCODE%5D=ANR-12-RMNP-0018" title="Agence Nationale de la Recheche"><img src="anr.png" height=40 ></a>
        
          
        </div> 
        <div id="right-up-corner-header"></div> 
      </div> <!-- /header --> 
      
      <!--Primary links - blue bar --> 
      <div id="primary-links"> 
        <div id="left-blue-bar"></div> 
        <div id="text-primary-links"> 
<ul class="links primary-links"><li class="menu-176 first"><a href="/projets/vulcomp2" title="Home link">Accueil</a></li> 
<li class="menu-166"><a href="index.php?id=news" title="See the news">Actualités</a></li> 
<li class="menu-166"><a href="index.php?id=partners" title="See the partners">Partenaires</a></li> 
<li class="menu-164"><a href="index.php?id=publi" title="See the publications">Publications</a></li> 
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
case "publi" : include("publi.inc");break;
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
<ul class="links primary-links"><li class="menu-176 first"><a href="/projets/vulcomp2" title="Home link">Accueil</a></li> 
<li class="menu-166"><a href="index.php?id=news" title="See the news">Actualités</a></li> 
<li class="menu-166"><a href="index.php?id=partners" title="See the partners">Partenaires</a></li> 
<li class="menu-164"><a href="index.php?id=publi" title="See the publications">Publications</a></li> 

</ul>                
        </div> 
        <div id="right-blue-bar"></div> 
      </div> 
 
    
    </div> <!-- /container --> 
  </div> <!-- /wrapper --> 
<!-- /layout --> 
 
 
  </body> 
</html> 
