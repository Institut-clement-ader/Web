<?php 

$texte=" <h1>ICARE</h1>
Interfaces généralisées et couplage non intrusif : Application de codes de recherche au sein de codes industriels pour l'analyse de structures fortement non linéaires<br><br>
<div align=\"center\"> <img src=\"gendre.png\" width=400><br> Principe de la méthode [Gendre Allix Gosselet, IJNME, 2011]</div>

";


$texte.="<h3>Résumé du projet</h3> Le projet vise au <b>développement de méthodes</b> pour l’analyse de <b>structures complexes et de grande taille</b>.<br>
<br>
<b>Le défi scientifique consiste à investiguer des zones très localisées</b>, mais potentiellement critiques vis-à-vis de la tenue mécanique d’ensemble, <b>au sein de structures de grande complexité géométrique et de grande taille</b>. Classiquement, sont mis en œuvre aux échelles globale et locale des représentations, discrétisations, modèles de comportement et outils numériques adaptés à des besoins de simulation gradués en complexité. Le problème global est traité avec un code généraliste (ABAQUS, NASTRAN…), dans le cadre d’idéalisations topologiques (formulation plaque, simplification géométrique), comportementales (homogénéisation), statistiques (cadre déterministe) ; l’analyse locale quant à elle demande la mise en œuvre d’outils spécialisés (routines, codes dédiés) pour une représentation fidèle de la géométrie et du comportement (contact, hétérogénéité, dégradations, incertitudes).<br>
<br>
Certes, des technologies numériques permettent le raccord de différents modèles. <b>Toutefois, ces technologies restent contraignantes, en particulier du point de vue industriel</b> ; en effet, garantir des échanges entre une variété d’objets contraint la conception de ces objets : doivent être anticipés la représentation topologique d’une zone d’échanges (interface), sa discrétisation (contrainte de maillage), l’extraction sur cette zone des quantités d’intérêt, et leur éventuel retraitement (cas d’un couplage coque / volume).<br>
<br>
<b>Le couplage non-intrusif lève ce verrou scientifique et industriel</b>, en proposant une forme innovante de communication entre les différents modèles, caractérisée par :<br>
<br>
- une minimisation des contraintes sur la topologie et le maillage du modèle global : le déploiement industriel est facilité, puisqu'<b>aucune intervention n’est nécessaire sur la maquette globale</b> ;<br>
- une minimisation de la quantité d’échanges (<b>optimisation du temps de calcul</b>) ;<br>
- une minimisation des développements spécifiques au code généraliste : <b>les codes restent indépendants</b>, en particulier en termes de maillages et de solveurs.<br>
<br>
Ainsi, une retombée majeure du projet ICARE sera de <b>faciliter la dissémination d’outils de recherche spécifiques</b> : en effet, la simplification du couplage rend le déploiement d’outils spécialisés issus de la R&D compatible avec un cadre industriel.<br>
<br>
Le consortium est constitué de deux groupes industriels (EADS et EDF), trois partenaires académiques (GeM, LMT, UTO) et une PME (DISTENE). Le laboratoire LAMCoS est fortement associé au consortium et apporte une contribution significative.<br>";

?>
