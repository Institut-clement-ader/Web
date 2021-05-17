<?php 

$texte="
<h1>VULCOMP 2</h1>
<b>VULnérabilité des matériaux COMPosites - Phase 2</b><br><br>

<TABLE CELLPADDING=3 BORDER=0><COL SPAN=2>
<TR>
<TD  align=\"center\"><img src=\"logo_vulcomp.jpg\" width=400> </TD>
</TR>
</TABLE>


<h3>Présentation synthétique du projet </h3> 
Dans le contexte des développements de fuselages d'aéronefs de seconde génération, les structures composites deviennent un choix majeur comme pour d'autres secteurs industriels en raison de leur excellente tenue spécifique. Pour l'environnement, le gain de masse va dans le sens de la réduction des rejets polluants (sonores, chimiques), et contribue à la diminution des coûts d'exploitation pour les compagnies aériennes. Dans le cas d'atterrissage d'urgence, d'impact rapide et de crash, les passagers doivent rester indemnes. Au minimum, un fuselage composite devra garantir un niveau de <b>survivabilité</b> équivalent à celui offert aujourd'hui par un fuselage métallique. Le projet VULCOMP phase2 constitue le sous projet suite du programme plus étendu VULnérabilité des structures COMposites labellisé en 2005 par le pôle Aéronautique, Espace et Systèmes Embarqués. L'objectif de ce <b>projet suite</b> est de pouvoir <b>dépasser les limites actuelles de description physique d'endommagement des matériaux composites et de leurs lois mathématiques sous sollicitations dynamiques extrêmes</b>. Cette phase s'inscrit pleinement dans l'objectif global du programme VULCOMP afin de prédire l'absorption d'énergie avec un degré de confiance telle qu'il permettra de s'affranchir à terme d'essais coûteux par une utilisation renforcée de la simulation numérique via l'approche du Virtual Structural Testing. Pour atteindre ce but ambitieux, il faut <b>mettre en oeuvre les nouvelles méthodes développées dans Vulcomp1</b>, implanter <b>les lois numériques de façon robuste</b> et <b>lever d'autres verrous scientifiques via des technologies en rupture</b> afin d'étudier le niveau sous-structural de la pyramide d'essais. Sous sollicitations extrêmes, les matériaux composites présentent des phénomènes multiples de dégradation qui peuvent s'avérer très complexes (interaction délaminage/fissuration transverse, fragmentation, phénomènes de frottement lors des ruptures), <b>la dépendance à la vitesse de chargement étant également un point clé</b>, il sera consolidé. Cette seconde phase de la programmatique VULCOMP s'appuiera largement sur les résultats de Vulcomp1 afin d'arriver à l'objectif global fixé. Les <b>partenaires</b> impliqués dans sa réalisation sont <b>complémentaires</b> en termes de savoir-faire académique (LMT, I2M, ICA), industriels (EADS IW, Holo3, Impetus) et une EPIC (ONERA). Ils apporteront les meilleurs savoir-faire français dans la réalisation d'étude sur le comportement des composites tout en assurant les meilleures retombées nationales et régionales aux bureaux d'études AESE. Airbus France est d'ailleurs membre du comité de suivi industriel de ce projet
<br><br>

<TABLE CELLPADDING=3 BORDER=0><COL SPAN=2>
<TR>
<TD  align=\"center\"><img src=\"pyramide.png\" width=400> </TD>
</TR>
<TR>
<TD  align=\"center\">Pyramide essai/calcul (courtesy of Airbus) </TD>
</TR>
</TABLE>

<h3>Verrous scientifiques et techniques:</h3>
<UL TYPE=\"BULLET\">
<LI>- disposer de résultats d'essais dynamiques fiables et indiscutables sur les modes prépondérants de dégradation des trois familles de matériaux étudiés et des assemblages collés. Le caractère novateur est l'utilisation de caméras rapides ainsi que de méthodes de mesures de champs adaptées à la dynamique rapide (notamment calcul spatio-temporel)
<LI>- déploiement de la (stéréo)corrélation d'images lors des différents essais (nécessité d'évaluer de manière aussi fiable que possible les champs de vitesse, d'accélération, de vitesses de déformation)
<LI>- Prise en compte des effets de vitesse pertinents à l'échelle d'un stratifié dans les codes explicites (Europlexus, Abaqus Explicit) et benchmark de solutions alternatives (FE/ED, Impetus)
<LI>- Modèle matériau prédictifs et robustes dans leur implémentation: référence indiscutable en vue de respecter les nombreux acquis sur les modélisations en termes de comportement micro et/ou méso sur les énergies dissipées à rupture
<LI>- Evaluation de l'apport des techniques alternatives (GPU, iso-géométrique, couplage ED/MEF, méthode particulaire) dans les cas de crash et d'impact dynamique
<LI>- Evaluation avec critère TRL sur un/deux cas test à l'échelle sous-structurale
<LI>- Logiciel Correli-STC mis à jour : transfert et intégration robuste de méthodes et d'outils d'identification évolués
</UL>
<br><br>


<h3>Structuration des Work Packages :</h3>
<P>
<UL TYPE=\"BULLET\">
 <LI> WP 1 : Coordination et management (T0-T0+42)
   <UL TYPE=\"CIRCLE\">
     <LI> T1.1 Coordination globale
     <LI> T1.2 Coordination scientifique par thématique
     <LI> T1.3. Actions générales de valorisation 
   </UL>
 <LI> WP 2 : Spécification et Définition (T0-T0+2)
   <UL TYPE=\"CIRCLE\">
     <LI> T2.1 Sélection et définition des matériaux d'études et des programmes d'essais
     <LI> T2.2 Spécification détaillée des stratégies de modélisation
     <LI> T2.3 Spécification détaillée des stratégies d'identification et méthodes de suivi avancées
     <LI> T2.4 Spécification détaillée des critères d'évaluation sur démonstrateur
   </UL>
 <LI> WP 3 : Développement de nouvelles méthodologies expérimentales en dynamique rapide (T0+2-T0+40)
   <UL TYPE=\"CIRCLE\">
     <LI> T3.1 Fabrication des éprouvettes et contrôle CND
     <LI> T3.2 Développement des moyens et  méthodes d'identification 
     <LI> T3.3 Réalisation des Essais d'identification pli et interface - échelle coupon 
     <LI> T3.4 Réalisation des Essais de traction sur assemblages en dynamique – échelle élémentaire 
     <LI> T3.5 Réalisation des Essais de crash sur plaque – échelle élémentaire 
     <LI> T3.6 Réalisation des Essais d'impact choc dur – échelle élémentaire 
     <LI> T3.7 Réalisation des essais de validation et investigation quantitative– échelle démonstrateur
   </UL>
 <LI> WP 4 : Modélisation des comportements et implantation numérique (T0+6-T0+40)
   <UL TYPE=\"CIRCLE\">
     <LI> T4.1 Etat de référence des modèles actuels
     <LI> T4.2 Implantation numérique des nouveaux modèles dans les codes 
     <LI> Développement de modèles de comportements avancés pour la dynamique transitoire 
     <LI> T4.3 Développement de Stratégies numériques dédiées (GPU, iso-géométrique, couplage FE/discret, …)  
     <LI> T4.4 Développement du code CorreliSTC
   </UL>
 <LI> WP 5 : Validation et dissémination des méthodes et outils (T0+36-T0+42)
   <UL TYPE=\"CIRCLE\">
     <LI> T5.1. Recette et dissémination de l'outil CorreliSTC
     <LI> T5.2. Recette des cas de validation essai/calcul
   </UL>
</UL>
</P>



<TABLE CELLPADDING=3 BORDER=0><COL SPAN=2>
<TR>
<TD align=\"center\"><img src=\"holo3.png\" height=200> </TD>
<TD align=\"center\"><img src=\"notch.png\" height=200> </TD>
<TD align=\"center\"><img src=\"crash.png\" height=200> </TD>
</TR>
<TR>
<TD align=\"center\"> Essai multi-instrumenté de traction sur composite épais (Holo3)</TD>
<TD align=\"center\"> endommagement associé au kinking et réseau de fissures créés<br> lors d’un essai de compression sur éprouvette entaillée (LMT)</TD>
<TD align=\"center\"> Crash de plaque composite stratifiée : Comparaison modèle / essai (ICA)</TD>
</TR>
</TABLE>

<TABLE CELLPADDING=3 BORDER=0><COL SPAN=2>
<TR>
<TD  align=\"center\"><img src=\"tissu.jpg\" width=400> </TD>
<TD  align=\"center\"><img src=\"matage.png\" width=500> </TD>
</TR>
<TR>
<TD  align=\"center\">Simulation par éléments discrets : tissu sec (I2M) </TD>
<TD  align=\"center\">Essai multi-instrumenté de matage sur stratifié composite (ONERA)</TD>
</TR>
</TABLE>

<TABLE CELLPADDING=3 BORDER=0><COL SPAN=2>
<TR>
<TD  align=\"center\"><img src=\"impetus01.png\" width=400> </TD>
<TD  align=\"center\"><img src=\"agi_picture.png\" width=500> </TD>
</TR>
<TR>
<TD  align=\"center\">simulation d'absorption par découpes multiples (IMPETUS) </TD>
<TD  align=\"center\">... (AGI)</TD>
</TR>
</TABLE>



";


?>
