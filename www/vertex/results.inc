<?php 

$texte="";

?>

<P ALIGN=CENTER STYLE="margin-bottom: 0.14in; line-height: 100%"><FONT COLOR="#000000"><FONT FACE="Trebuchet MS, serif"><FONT SIZE=5 STYLE="font-size: 20pt"><B>Principaux
résultats</B></FONT></FONT></FONT></P>
<P STYLE="margin-bottom: 0.14in; line-height: 100%"><FONT COLOR="#000000"><FONT FACE="Trebuchet MS, serif"><FONT SIZE=4><B>Essais</B></FONT></FONT></FONT></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Le montage a été
réceptionné en Mai 2015 après une phase importante de déverminage,
d’apprentissage et de validation de la méthodologie. 12 essais
servant de référence commune aux partenaires du projet ont été
réalisés&nbsp;: 4 type de sollicitations pour 3 drapages différents
de C3-1 à C3-3).</P>
<P ALIGN=CENTER  STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_460d5f34.png" NAME="Image 7" ALIGN=BOTTOM WIDTH=605 HEIGHT=166 BORDER=0></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Le film d'un essai
de cisaillement (gauche) et celui d'un essai combiné traction-cisaillement (droite) sont visibles ci-après&nbsp;:</P>
<P ALIGN=CENTER  STYLE="margin-bottom: 0.14in">   
<iframe width="420" height="315"
src="https://www.youtube.com/embed/G5nbiq3b7OA">
</iframe>
<iframe width="420" height="315"
src="https://www.youtube.com/embed/45AgoMu3fXs">
</iframe>
</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">On observe la création
d’une cloque liée au flambement en cisaillement. Il y a une
interaction entre la réponse en postflambement et la propagation de
défauts en pointe de coupure avant la rupture finale. 
</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><FONT COLOR="#000000"><FONT FACE="Trebuchet MS, serif"><FONT SIZE=4><B>Mesures
(ICA)&nbsp;</B></FONT></FONT></FONT></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Dans ce projet, on
s’oriente vers l’utilisation de la Stéréo Corrélation d’Images
Numériques avec un formalisme Eléments-Finis (Stéréo-CIN-EF ou
SCIN-EF). Elle permet de fournir (a) des champs cinématiques mesurés
à comparer aux champs cinématiques calculés en vue de la
validation et (b) une information (partielle) des conditions aux
limites à imposer au modèle. 
</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Une méthode de mesure
de champs éléments finis. Les champs fournis par les codes
commerciaux de SCIN et d’analyse par élément finis (FEA) sont
très différents. Par exemple, les logiciels éléments finis
expriment le déplacement comme les degrés de liberté aux nœuds
d’un maillage éléments finis. De leur côté, les logiciels de
CIN commerciaux expriment le déplacement comme des valeurs
ponctuelles sur un nuage de point dans un repère différent de celui
de maillage. La difficulté supplémentaire réside dans le fait que
les domaines de définition de ces champs différent, puisque, par
exemple, les logiciels actuels en CIN ne permettent pas de
s’approcher des bords, ou tout simplement parce que des contraintes
expérimentales conduisent parfois à n’observer qu’une partie
seulement de l’éprouvette. Enfin, quantifier la distance
entre un champ mesuré par SCIN et un champ simulé n’est pas une
tache évidente.
</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"> <b>Dans ce projet, une méthode de SCIN basée sur les
éléments finis a été développée</b> pour permettre d’unifier les descriptions des champs simulés et mesurés. Elle se base sur une formulation du problème de conservation des niveaux de gris écrite dans le repère du maillage en se basant sur des modèles non-linéaires de caméra.</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="feSDIC.png" NAME="Image 13" ALIGN=BOTTOM BORDER=0></P>

<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"> Cette formulation s'écrit dans le repère du maillage directement. Le problème de corrélation a pour seule inconnue, le déplacement <b>U</b> tridimensionnel interpolé par éléments finis sur le même maillage que la simulation:</P>

<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="scheme.png" NAME="Image 13" ALIGN=BOTTOM WIDTH=455 BORDER=0></P>

<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"> Cette méthode de mesure de champs de déplacement par Stéréo Corrélation d'images éléments finis a consistué la première étape. Avec une telle formulation, il est également possible d'utiliser directement le modèle pour régulariser le champs de déplacement mesuré pendant la mesure. </P>

<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="animation.gif" NAME="Image 13" ALIGN=BOTTOM WIDTH=605 BORDER=0></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"> Exemple de mesure de Corrélation Stéréo éléments finis sur un essai de traction sur éprouvette double épaisseur. Comparaison avec la mesure local VIC3D</P>

<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Une deuxième phase à consisté à <b>mesurer les
conditions aux limites que l'éprouvette subit véritablement pendant l'essai</b>, afin d'être capable de l'imposer au modèle pour la simulation. Il ne s'agit plus à proprement parlé d'une mesure surfacique, puisqu'elle permet d'obtenir de l'information sur la cinématique dans l'épaisseur, compte tenu des images de la peau supérieure et de la connaissance d'un modèle de comportement élastique réputé fiable. En effet, en SCIN, seul le
déplacement de la peau visible est mesuré, mais le déplacement à
cœur n’est pas accessible directement. Ainsi Réthoré propose de
faire l’hypothèse de l’homogénéité du déplacement dans
l’épaisseur de l’éprouvette, ce qui est envisageable dans des
cas d’éprouvettes de faible épaisseur avec des chargements
uni-axiaux, ce qui n’est pas le cas ici. Dans cette étude, pour
aller plus loin dans le dialogue essais/calculs, l’objectif est de
mesurer directement les conditions aux limites à appliquer à la
simulation (déplacements et rotations ou déplacements dans
l’épaisseur selon la modélisation). Pour ce faire, on se propose
de s’appuyer sur un modèle EF réputé fiable pour régulariser la
mesure Stéréo-CIN.</P>

<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_b41824f4.png" NAME="Image 13" ALIGN=BOTTOM WIDTH=605 HEIGHT=212 BORDER=0></P>

<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Mesure de champs
multiéchelles. Pour estimer ces conditions aux limites, le champ de
vision doit impérativement visualiser la plus grande partie de
l’éprouvette. Cependant, compte tenu de la finitude de la
définition des capteurs CCD, ce choix fixe la résolution de mesure.
Dans le cas de structures de grande taille, cette résolution s’avère
souvent insuffisante. On se propose donc d’instrumenter l’essai
avec au moins deux bancs de deux caméras, ce qui permet de lever ce
compromis et réduire les incertitudes de mesure et d’identification.</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><FONT COLOR="#000000"><FONT FACE="Trebuchet MS, serif"><FONT SIZE=4><B>Modélisation
DPM (ICA)&nbsp;</B></FONT></FONT></FONT></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Le modèle «&nbsp;Discrete
Ply Model&nbsp;» initié et développé par Christophe Bouvet permet
la simulation des endommagements des structures composites
stratifiées composites à base d’UD. Il est basé sur un maillage
orienté dans les directions des plis&nbsp;: 
</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="image111.png" NAME="Image 1" ALIGN=BOTTOM WIDTH=605 HEIGHT=365 BORDER=0></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Des éléments
cohésifs sont utilisés pour le délaminage et pour la fissuration
matricielle. Une hypothèse implicite est que seules les fissures
traversantes sont importantes. Ici le modèle ne peut prendre en
compte la fissuration diffuse. Par contre, cette géométrie permet
un couplage naturel des endommagements intra et inter laminaire ce
qui est un point clef pour l’efficacité d’une stratégie de
modélisation. Les lois d’endommagements sont décrites
succinctement ci-après&nbsp;:</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="image032.jpg" NAME="Image 9" ALIGN=BOTTOM WIDTH=605 HEIGHT=372 BORDER=0></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Cette modélisation a
été initialement conçue pour les problématiques d’impact et a
pu modéliser  de manière prédictive les endommagements dans de
nombreux cas (Impact basse vitesse/basse énergie, Compression Après
Impact, Edge Impact, Impact on dropped Plies). Cette approche a aussi
été étendue au crash, au pull-through et très récemment à la
rupture trouvée. Pour plus de renseignements, voir les publications
des pages personnelles de C. Bouvet, B. Castanié et S. Rivallant.</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Un avantage
significatif est que cette méthode repose sur seulement 13
caractéristiques mécaniques, intrinséques et obtenues par des
essais classiques. Il n’y a pas de recalage. Le principal
inconvénient est un maillage complexe, qui pour l’instant n’a
pas été automatisée par un éditeur de logiciel.</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="image222.png" NAME="Image 12" ALIGN=BOTTOM HEIGHT=125 BORDER=0></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Le modèle a d’abord
été testé sur des éprouvettes trouées pour vérifier son
aptitude à capturer les effets d’échelle (J. Serra et al,
Composite Structures 2016) puis sur des éprouvettes entaillées
sollicitées en traction. 
</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="image333.png" NAME="Image 14" ALIGN=BOTTOM WIDTH=605 BORDER=0></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Le suivi d’essai a
été réalisé par D.I.C mais aussi par thermographie infrarouge,
plus adaptée au suivi des ruptures de fibres à l’intérieur de
l’éprouvette.</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_bda0ee42.png" NAME="EprouvetteEntaillee1.wmv" ALIGN=BOTTOM WIDTH=605 HEIGHT=340 BORDER=0></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">(Inserer le film)</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Le modèle DPM permet
de bien retrouver les courbes Contraintes/Déformations&nbsp; mais
aussi le scénario de rupture :</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_365eb00c.png" NAME="Image 16" ALIGN=BOTTOM WIDTH=605 HEIGHT=394 BORDER=0></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_4e91d3b0.png" NAME="Image 17" ALIGN=BOTTOM WIDTH=568 HEIGHT=314 BORDER=0></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_bca96b0b.png" NAME="Image 19" ALIGN=BOTTOM WIDTH=605 HEIGHT=417 BORDER=0></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><FONT COLOR="#000000"><FONT FACE="Trebuchet MS, serif"><FONT SIZE=4><B>Dialogue
Calcul/essais sur VERTEX (ICA).&nbsp;</B></FONT></FONT></FONT></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">La mesure du champ de
déplacement est effectuée dans la Zone 1 et les conditions limites
sont imposées sur le bord de la Zone 1bis  (trois déplacements)
ainsi que sur 3 rangées de nœuds supplémentaires (déplacement
hors plan) selon la méthode développée par Stevek et Olsson. La
zone utile (Zone 1bis), c’est-à-dire celle utilisée pour le
calcul par éléments finis (Figure 5) est plus petite (300 × 300
mm2) que la portion de la plaque observée (Zone 1). Cela permet de
réduire les effets de bords liés à la régularisation de la mesure
par S-CIN-EF [6].</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_e84c9cef.png" ALIGN=BOTTOM></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">La mesure par
stéréovision s’effectue en plusieurs étapes. D’abord la mesure
de forme initiale est réalisée (courbure de la plaque), ensuite les
déformations associées à la fixation de la plaque sur le bâti
sont déterminées en comparant les images avant et après serrage,
enfin les variations des déplacements liées aux véritables étapes
de chargement sont évaluées.</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="lien2.png" ALIGN=BOTTOM></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Le passage de la
plaque non fixée à la plaque fixée inclut un mouvement de corps
solide non négligeable. De plus, un changement dans l’éclairage
entre les deux photos (plaque non fixée et plaque fixée) a souvent
été observé lors des différents essais. Cette variation
d’intensité lumineuse est très probablement due à un léger
déplacement du spot lumineux utilisé pour éclairer la plaque,
survenu lors des nombreuses manutentions nécessaires à son
installation (serrage de nombreuses vis  et câblage des jauges de
déformation). Ces deux facteurs ont généré des erreurs de mesure.
L’image de « référence » choisie pour la détermination des
conditions limites utiles à la simulation numérique est donc
l’image de la plaque fixée. 
</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="lien3.png" NAME="graphics2" ALIGN=BOTTOM WIDTH=640 HEIGHT=316 BORDER=0></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Numériquement, le
calcul est donc divisé en « n » pas de calcul correspondant aux «
n+1 » images fournies par les caméras de stéréocorrélation. Une
variation linéaire des déplacements est appliquée entre les
différents états déterminés. Une approximation du chargement
(discrétisation en « n » segments de droite) est donc inhérente à
la méthode proposée. Un protocole d’échanges de données entre
les résultats de la mesure et le code Abaqus a aussi été
développé. Les figures ci-dessous présentent quelques comparaisons
calcul/essai en traction et cisaillement avec des résultats très
correct en traction. En cisaillement des efforts sont en cours pour
maitriser à la fois le postflambement et son interaction avec les
endommagements. 
</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_27750411.png" NAME="Image 20" ALIGN=BOTTOM WIDTH=605 HEIGHT=362 BORDER=0></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_d09335b0.png" NAME="Image 21" ALIGN=BOTTOM WIDTH=605 HEIGHT=369 BORDER=0></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><FONT COLOR="#000000"><FONT FACE="Trebuchet MS, serif"><FONT SIZE=4><B>Apport
LMT &nbsp;</B></FONT></FONT></FONT></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in; widows: 0; orphans: 0">
<FONT COLOR="#191919">L’ambition de la thèse réalisée au LMT
était d’étendre le domaine</FONT> <FONT COLOR="#191919">de
prédiction du mésomodèle à des éprouvettes dites technologiques
notamment en</FONT> <FONT COLOR="#191919">améliorant en améliorant
la robustesse des calculs et les capacités prédictives du modèle
en matière de fissuration. La démarche proposée a consisté à
introduire des interfaces endommageables à l’intérieur du pli,</FONT>
<FONT COLOR="#191919">capables de reproduire fidèlement l’initiation
et la propagation du phénomène de splitting observé
expérimentalement et qui conduit, s’il est mal pris en compte, à
un conservatisme bien trop important des résultats numériques par
rapport aux résultats expérimentaux.</FONT> <FONT COLOR="#191919">Pour
cela, l’idée a été d’exploiter le logiciel commercial SAMCEF,
qui intègre le mésomodèle amélioré. Ce choix est motivé par les
exigences des partenaires industriels qui</FONT> <FONT COLOR="#191919">souhaitent,
en vue du transfert vers l’industrie, des développements sur leurs
outils</FONT> <FONT COLOR="#191919">numériques commerciaux.</FONT></P>
<OL>
	<OL>
		<LI><H2 CLASS="western" ALIGN=LEFT STYLE="margin-bottom: 0.08in"><A NAME="_Toc231700982"></A>
		Enjeux et problématique, état de l’art</H2>
	</OL>
</OL>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Les travaux réalisés
dans le cadre du projet VERTEX visent à franchir un pas décisif
dans la mise en place d’une démarche numérique de prédiction de
la tenue à rupture des structures stratifiées dans le but
d’accélérer la conception des futurs aéronefs tout en allégeant
leur structure. L’idée développée ici consiste à construire
une stratégie prédictive de détection pour la prise en compte des
différentes zones dans lesquelles apparaissent des fissures de type
splitting (figure 1). Ces fissures jouent un rôle crucial dans le
scenario qui conduit à la rupture d’une pièce en matériau
composite. Leur non prise en compte conduit à grandement
sous-estimer la tenue à rupture de la structure. La stratégie
développée ici permet de prédire finement l’apparition et la
propagation de ces fissures et a été prévue pour être intégrée
dans les outils logiciels commerciaux utilisés par les industries
aéronautiques. Elle a notamment été introduite dans le code
SAMCEF. L’intégration dans un logiciel commercial permet en plus
de prendre en compte les paramètres de conception (dans le cas qui
nous intéresse les diverses séquences d’empilement ainsi que les
différentes géométries d’éprouvettes) en vue d’explorer et
d’optimiser simplement les séquences d’empilement, voire d’en
concevoir de nouvelles.</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_998d3093.png" NAME="Image 28" ALIGN=BOTTOM WIDTH=290 HEIGHT=207 BORDER=0><I><B><BR>Figure
1. Mise en évidence expérimentale du phénomène de splitting</B></I></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">La problématique est
de prendre en compte les phénomènes qui interviennent à une
échelle microscopique (en l’occurrence la microfissuration …)
pour déterminer le lieu d’apparition des macrofissures. Un projet
de Recherche Collaboratif lancé par l'union européenne en 2008
intitulé MAAXIMUS (More Affordable Aircraft Structure Lifecycle
through eXtended, Integrated, &amp; Mature nUmerical Sizing) avait
permis de proposer une version du mésomodèle dite améliorée
permettant la prédiction de la tenue à rupture des structures
stratifiées. Les résultats numériques obtenus dans [Abisset 2011]
avait montré une remarquable fidélité vis-à-vis des résultats
expérimentaux mais aussi certaines imprécisions notamment dans le
cas de structures présentant un splitting fort (localisation de la
fissuration transverse). Cette version est implémentée et
disponible dans le code de calcul commercial SAMCEF. L’introduction,
dans le cadre du projet VERTEX, d’une approche de détection/calcul
basée sur des indicateurs du mésomodèle des composites LMT
([Ladevèze 2017]) permet de rendre compte du phénomène de
splitting et de prédire avec précision la charge à rupture des
éprouvettes. 
</P>
<OL>
	<OL START=2>
		<LI><H2 CLASS="western" ALIGN=LEFT STYLE="margin-bottom: 0.08in"><A NAME="_Toc231700983"></A>
		Approche scientifique et technique</H2>
	</OL>
</OL>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Un premier aspect est
la maîtrise du calcul. Pour développer une stratégie de calcul
robuste, des études paramétriques ont été menées afin d’étudier
l’influence des paramètres numériques liés à la discrétisation
du problème physique et des constantes liées aux limiteurs de
localisation. Ainsi, un domaine de paramètres a été mis en
évidence afin de proposer une stratégie de calcul précise et
robuste.</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Un second aspect pour
la construction d’un outil d’aide à la conception virtuelle de
nouvelles structures en matériau composite a concerné la prise en
compte des contraintes du cahier des charges. Pour cela, les
développements informatiques ont été intégrés dans le logiciel
de calcul SAMCEF utilisé par les industriels. Ceci permet de
proposer dans un outil performant et documenté, la dernière version
du mésomodèle LMT ainsi que le critère de détection nécessaire à
l’intégration des splits dans les simulations. Ainsi le critère
de détection a été implémenté en utilisant uniquement les
commandes SAMCEF, disponibles dans le module de post traitement du
code.</P>
<P STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<OL>
	<OL START=3>
		<LI><H2 CLASS="western" ALIGN=LEFT STYLE="margin-bottom: 0.08in"><A NAME="_Ref231902820"></A><A NAME="_Toc231700984"></A>
		Résultats obtenus</H2>
	</OL>
</OL>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">La méthode de
prédiction-simulation des splits mise en place dans le projet VERTEX
a été testée sur nombreuses éprouvettes composites, présentant
des géométries et des séquences d’empilement différentes, qui
correspondent aux matériaux employés en aéronautique. Ces
éprouvettes ont été testées virtuellement jusqu’à rupture et
les résultats numériques confrontés aux résultats expérimentaux
(figures 2 et 3). La nouvelle stratégie a permis de discriminer de
manière très claire 3 séquences d’empilements proposées par
l’industrie aéronautique. Fondée sur la potentialité
d’apparition de fissures de type splitting et leur propagation, la
nouvelle méthode a permis d’expliquer et de prédire précisément
le comportement à rupture des éprouvettes. Des stratégies
d’intégration de ces macrofissures dans les simulations «&nbsp;on
the fly&nbsp;» ont été imaginées en lieu et place de l’actuelle
stratégie.</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="lmt.png" NAME="Image 29" ALIGN=BOTTOM WIDTH=490 HEIGHT=360 BORDER=0></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><I><B>Figure 2.
Prédiction de la charge à rupture pour 3 empilements avec
l’ancienne méthode et la stratégie développée dans VERTEX pour
prédire les splits&nbsp;: les résultats expérimentaux sont
reproduits avec précision</B></I></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_621a1066.png" NAME="Image 30" ALIGN=BOTTOM WIDTH=198 HEIGHT=382 BORDER=0></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><I><B>Figure 3. Mise en
évidence numérique du phénomène de splitting</B></I></P>
<OL>
	<OL START=4>
		<LI><H2 CLASS="western" ALIGN=LEFT STYLE="margin-bottom: 0.08in"><A NAME="_Toc231700985"></A>
		Exploitation des résultats</H2>
	</OL>
</OL>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">La nouvelle
méthodologie mise en place pour coupler la détection et la
simulation des splits basée sur la théorie du mésomodèle LMT
permet de mixer de manière très simple les effets des paramètres
micromécaniques (typiquement dans le cas des stratifiés, la
microfissuration dans les plis) sur les quantités macromécaniques
(typiquement des macrofissures de type splits).</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Les études réalisées
sur les éprouvettes composites ont permis une compréhension
beaucoup plus fine des phénomènes mis en jeu dans l’initiation et
la détection des macrofissures de type split et la possibilité
d’optimiser la précision des prédictions sur la tenue à rupture
de la structure en fonction des séquences d’empilement réelles
dans les structures aéronautiques, ce qui n’était pas le cas
jusqu’à présent.</P>
<OL>
	<OL START=5>
		<LI><H2 CLASS="western" ALIGN=LEFT STYLE="margin-bottom: 0.08in">Conclusions</H2>
	</OL>
</OL>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Les essais virtuels
réalisés en introduisant dans les simulations des interfaces
cohésives précisément à l’endroit calculé via un critère ad
hoc développé au cours de l’étude ont montré le fort potentiel
prédictif de cette nouvelle approche par rapport à une approche
classique exhibant des erreurs pouvant aller jusqu’à 30% pour les
approches classiques et ouvrant la perspective à de nouvelles
solutions technologiques pour les futurs aéronefs.</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><FONT COLOR="#000000"><FONT FACE="Trebuchet MS, serif"><FONT SIZE=4><B>Apport
ONERA&nbsp;</B></FONT></FONT></FONT></P>
<OL>
	<OL START=6>
		<LI><H2 CLASS="western"><A NAME="_Toc473553297"></A><A NAME="_Ref473535478"></A>
		Problématique</H2>
	</OL>
</OL>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Du point de vue de
l’Onera, l’un des enjeux majeurs de l’ANR Vertex consistait à
mettre en œuvre le modèle de comportement avancé développé pour
les composites stratifiés – et par extension toutes les lois de
comportement développées à l’Onera – dans un code de calcul
commercial, en l’occurrence ABAQUS, de manière à transférer plus
aisément ces travaux aux partenaires industriels, ici Airbus Group.
Or, la majorité des modes de ruine du pli unidirectionnel induisent
par construction un comportement adoucissant, de manière à
modéliser la rupture progressive au voisinage d’une singularité.
Or, l’adoucissement cause en pratique la perte d’ellipticité
(respectivement d’hyperbolicité) de l’équation d’équilibre
(respectivement de l’équation de la dynamique), ce qui induit la
localisation des déformations sur quelques éléments de maillage
[3]. Quand on raffine le maillage, la déformation tend à se
localiser sur une couche d’un élément, voire sur une “ligne”
de points d’intégration. Cette localisation qui pourrait être
souhaitable a priori – car on voudrait voir une fissure d’épaisseur
nulle se créer – est en fait un véritable problème. En effet,
lorsque la taille de maille diminue, le volume endommagé et donc
l’énergie dissipée diminue également. Quand on fait tendre la
taille des éléments vers zéro, ce que l’on peut légitimement
vouloir faire dans une analyse de convergence, l’énergie dissipée
à rupture tend également vers zéro ce qui n’est pas acceptable.
De ce fait, la localisation due à une perte d’ellipticité ne
permet pas d’obtenir une solution convergée.</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Les solutions
numériques sont nombreuses. Parmi les méthodes les plus connues et
les plus employées on peut citer (i) la classe des méthodes à
effet retard, (ii) les techniques de type crack band (parfois
appelées smeared crack) ou encore (iii) la famille des méthodes
non-locales.</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Les méthodes
non-locales consistent à ajouter explicitement aux équations de la
mécanique un mécanisme permettant de diffuser une des quantités
qui localise (la déformation, une force thermodynamique ou encore
directement l’endommagement). Cela peut se faire notamment par
l’introduction d’une forme de diffusion d’une de ces variables,
<I>via</I> une méthode à gradient implicite, dont le formalisme
s’intègre très bien dans un formalisme par éléments finis.
Cette méthode reste néanmoins très intrusive car elle nécessite
l’utilisation d’éléments non standards. C’est précisément
sur ce point que se sont concentrés les efforts de l’Onera dans le
cadre de l’ANR Vertex. 
</P>
<OL>
	<OL START=7>
		<LI><H2 CLASS="western"><A NAME="_Toc473553298"></A>Formalisme de
		la méthode non locale</H2>
	</OL>
</OL>
<P STYLE="margin-bottom: 0.14in">En régime quasi-statique, la
méthode non locale implicite consiste à résoudre le système
d’équations suivant&nbsp;: 
</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_c4be4add.png" NAME="Image 15372" ALIGN=BOTTOM WIDTH=267 HEIGHT=52 BORDER=0></P>
<P STYLE="margin-bottom: 0.14in">Connaissant les conditions aux
limites&nbsp;: 
</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_5746c165.png" NAME="Image 15373" ALIGN=BOTTOM WIDTH=170 HEIGHT=65 BORDER=0></P>
<P STYLE="margin-bottom: 0.14in">Et la loi de comportement <FONT FACE="Lucida Calligraphy, serif"><B>F
</B></FONT>telle que&nbsp;:</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_5378d102.png" NAME="Image 15374" ALIGN=BOTTOM WIDTH=122 HEIGHT=32 BORDER=0></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">On retrouve dans ce
formalisme l’équation d’équilibre «&nbsp;classique&nbsp;», à
laquelle s’ajoute une équation non locale qui introduit un terme
de diffusion qui porte sur la variable à délocaliser <I>f</I>.
Celle-ci peut être une mesure de la déformation, une force
thermodynamique ou encore directement l’endommagement. On associe à
cette variable une version non locale 
<IMG SRC="i_75865f7e271f1242_html_d444d304.gif" ALIGN=ABSMIDDLE HSPACE=8>,
qui est traitée comme une inconnue primale du problème EF, au même
titre que les déplacements. C’est celle-ci qui sera utilisée dans
la loi de comportement plutôt que la version localisée. Cette
équation de diffusion est paramétrée par la grandeur <I>c</I>. Des
travaux récents à l’Onera semblent indiquer que ce paramètre
peut s’interpréter physiquement comme la taille de la «&nbsp;<I>process
zone</I>&nbsp;» autour d’une fissure en formation. Néanmoins,
dans le cadre de ces travaux, nous utiliserons <I>c</I> comme un
simple paramètre matériau recalé numériquement. 
</P>
<P STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<OL>
	<OL START=8>
		<LI><H2 CLASS="western"><A NAME="_Toc473553299"></A>Application à
		la loi Onera-Vertex</H2>
		<OL>
			<LI><H3 CLASS="western"><A NAME="_Toc473553300"></A>Choix de la
			variable non-locale</H3>
		</OL>
	</OL>
</OL>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">S’il est en théorie
possible d’introduire un nombre quelconque de variables non
locales, nous avons choisi de privilégier une variable unique, par
souci de simplicité et d’efficacité. Au travers de cette variable
non locale, l’objectif est de régulariser le comportement du
matériau lorsque les modes de ruine en rupture de fibres sont
actifs. Ainsi, le mode de ruine catastrophique par compression
transverse du pli sera dans un premier temps sans effet sur le
comportement du pli endommagé. Les cas-tests sont choisis de sorte
que cette hypothèse ne soit pas critique.</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Pour rassembler les
deux modes de ruine de rupture fibre dans une unique variable non
locale, nous introduisons le critère 
<IMG SRC="i_75865f7e271f1242_html_5c8861fb.gif" ALIGN=ABSMIDDLE HSPACE=8>
tel que&nbsp;:</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_1cbb82e3.gif" ALIGN=ABSMIDDLE HSPACE=8></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">On associe à ce
critère de rupture une variable d’endommagement 
<IMG SRC="i_75865f7e271f1242_html_342bd848.gif" ALIGN=ABSMIDDLE HSPACE=8>
et un tenseur des effets 
<IMG SRC="i_75865f7e271f1242_html_f9d05ffa.gif" ALIGN=ABSMIDDLE HSPACE=8>
de manière identique aux variables d’endommagement introduites
dans la section 2. Ce tenseur pourra éventuellement prendre lui
aussi des valeurs différentes en traction ou en compression. 
</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<OL>
	<OL>
		<OL START=2>
			<LI><H3 CLASS="western"><A NAME="_Toc473553301"></A>Description du
			cas-test de l’implémentation ABAQUS du non local</H3>
		</OL>
	</OL>
</OL>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">L’implémentation de
la méthode non-locale implicite dans le code ABAQUS nécessite de
développer intégralement un élément utilisateur adapté. Dans le
cadre de l’ANR Vertex, nous avons développé un élément basé
sur l’hexaèdre quadratique C3D20, représenté sur la 11. Les
déplacements de chacun des vingt nœuds de l’élément suivent
donc un schéma quadratique. A ces degrés de liberté est associé
un degré de liberté supplémentaire qui est celui de la variable
non locale f<SUB>1</SUB><SUP>nl</SUP>. Celle-ci suit en revanche un
schéma linéaire, et n’est donc définie que sur les nœuds 1 à 8
de l’élément. Ce choix d’interpolation est nécessaire afin
d’éviter toute oscillation numérique [16].</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in; page-break-after: avoid">
<IMG SRC="i_75865f7e271f1242_html_49005e81.png" NAME="Image 15375" ALIGN=BOTTOM WIDTH=337 HEIGHT=233 BORDER=0></P>
<P LANG="en-GB" STYLE="margin-bottom: 0.14in; line-height: 100%"><A NAME="_Ref473550617"></A>
<FONT COLOR="#1f497d"><FONT FACE="Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><I><SPAN LANG="fr-FR">Figure
11: Représentation de l'élément C3D20 dans l'espace
isoparamétrique.</SPAN></I></FONT></FONT></FONT></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Par ailleurs, puisque
l’élément est reconstruit intégralement, il n’est pas <I>a
priori </I>possible de lui donner une orientation au moyen des
techniques usuelles en ABAQUS, car le code ignore tout de la
géométrie de l’élément, de la définition de ses faces et donc
de leurs orientations. Il est alors nécessaire de rentrer
l’orientation matériau comme un paramètre de l’élément, et on
gère directement dans l’élément les rotations du repère global
au repère local dans lequel la loi du pli est exécutée.</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Le cas-test choisi
pour valider l’implémentation numérique est celui d’une plaque
carré de longueur 400mm, munie d’une grande entaille de longueur
100mm. Cette plaque est similaire à celles qui ont été testées
sur le moyen d’essai Vertex. Le but était en effet de pouvoir
transitionner rapidement vers la comparaison entre les simulations et
les vrais essais. Cette plaque est munie de trois plis –
contrairement aux 13 plis des plaques réelles – pour pouvoir
étudier le cas d’un empilement croisé. Le chargement est une
traction simple dans la direction normale à l’entaille.</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Le modèle utilisé
est représenté en 12. On observe que seul un quart de la plaque a
été modélisé pour des raisons de symétrie. Notons que ce choix
est possible ici car nous nous limiterons pour cette validation à
des orientations de pli égales à 0° ou 90°. Pour des orientations
quelconques, cette symétrie est brisée, et il faudrait alors
représenter l’intégralité de la plaque, ce qui ne pose pas de
difficulté supplémentaire. La 13 montre un plan rapproché sur
l’extrémité de l’entaille. En l’absence de zones cohésives,
nous avons pu garder un maillage relativement grossier pour cet
exercice de mise au point, afin de limiter les temps de calcul.</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in; page-break-after: avoid">
<IMG SRC="i_75865f7e271f1242_html_40aa768.png" NAME="Image 15376" ALIGN=BOTTOM WIDTH=341 HEIGHT=346 BORDER=0></P>
<P LANG="en-GB" STYLE="margin-bottom: 0.14in; line-height: 100%"><A NAME="_Ref473551108"></A>
<FONT COLOR="#1f497d"><FONT FACE="Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><I><SPAN LANG="fr-FR">Figure
12 : Modèle EF de la plaque entaillée</SPAN></I></FONT></FONT></FONT></P>
<P STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<P STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<P ALIGN=CENTER STYLE="text-indent: 0.2in; margin-bottom: 0.14in; page-break-after: avoid">
<IMG SRC="i_75865f7e271f1242_html_2c68249d.png" NAME="Image 15377" ALIGN=BOTTOM WIDTH=330 HEIGHT=219 BORDER=0></P>
<P LANG="en-GB" STYLE="margin-bottom: 0.14in; line-height: 100%"><A NAME="_Ref473551512"></A>
<FONT COLOR="#1f497d"><FONT FACE="Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><I><SPAN LANG="fr-FR">Figure
13: Détail de la plaque entaillée</SPAN></I></FONT></FONT></FONT></P>
<P STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<P STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<OL>
	<OL>
		<OL START=3>
			<LI><H3 CLASS="western"><A NAME="_Toc473553302"></A>Résultats
			pour un stratifié unidirectionnel</H3>
		</OL>
	</OL>
</OL>
<P STYLE="margin-bottom: 0.14in">Le premier cas étudié est celui du
stratifié unidirectionnel, orienté dans la direction de chargement,
c’est-à-dire que les trois plis sont orientés dans la direction
90° par rapport au repère global (<I>cf. 12</I>). La 14 montre la
concentration de contrainte observée au droit de l’entaille. On
observe que celle-ci se localise sur quelques points de Gauss les
plus sollicités. La conséquence attendue est la localisation de la
force motrice 
<IMG SRC="i_75865f7e271f1242_html_5c8861fb.gif" ALIGN=ABSMIDDLE HSPACE=8>
sur quelques points de Gauss des éléments les plus chargés, comme
on peut le voir sur la 15. 
</P>
<P ALIGN=CENTER STYLE="text-indent: 0.2in; margin-bottom: 0.14in; page-break-after: avoid">
<IMG SRC="i_75865f7e271f1242_html_7f142fb.png" NAME="Image 15382" ALIGN=BOTTOM WIDTH=377 HEIGHT=264 BORDER=0></P>
<P LANG="en-GB" STYLE="margin-bottom: 0.14in; line-height: 100%"><A NAME="_Ref473551745"></A>
<FONT COLOR="#1f497d"><FONT FACE="Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><I><SPAN LANG="fr-FR">Figure
14: Concentration de contrainte au droit du trou pour le stratifié
UD.</SPAN></I></FONT></FONT></FONT></P>
<P ALIGN=CENTER STYLE="text-indent: 0.2in; margin-bottom: 0.14in; page-break-after: avoid">
<IMG SRC="i_75865f7e271f1242_html_b9590e9f.png" NAME="Image 15383" ALIGN=BOTTOM WIDTH=369 HEIGHT=265 BORDER=0></P>
<P LANG="en-GB" STYLE="margin-bottom: 0.14in; line-height: 100%"><A NAME="_Ref473551957"></A>
<FONT COLOR="#1f497d"><FONT FACE="Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><I><SPAN LANG="fr-FR">Figure
15: Localisation de l'endommagement en l'absence de régularisation</SPAN></I></FONT></FONT></FONT></P>
<P STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<P STYLE="margin-bottom: 0.14in">Néanmoins, grâce à la méthode
non locale implicite introduite <I>via </I> notre élément
utilisateur, on observe sur la 16 que l’endommagement des fibres
–ici en mode traction – est correctement délocalisé, et ainsi
reste réaliste et indépendant du maillage sous-jacent.</P>
<P STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in; page-break-after: avoid">
<IMG SRC="i_75865f7e271f1242_html_1c18a640.png" NAME="Image 15384" ALIGN=BOTTOM WIDTH=358 HEIGHT=265 BORDER=0></P>
<P LANG="en-GB" STYLE="margin-bottom: 0.14in; line-height: 100%"><A NAME="_Ref473552174"></A>
<FONT COLOR="#1f497d"><FONT FACE="Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><I><SPAN LANG="fr-FR">Figure
16: Endommagement des fibres près de l'entaille, pour le stratifié
unidirectionnel.</SPAN></I></FONT></FONT></FONT></P>
<OL>
	<OL>
		<OL START=4>
			<LI><H3 CLASS="western"><A NAME="_Toc473553303"></A>Résultats
			pour un stratifié [90°/0°/90°]</H3>
		</OL>
	</OL>
</OL>
<P STYLE="margin-bottom: 0.14in">Une analyse similaire a été
entreprise sur un stratifié croisé [90/0/90]. L’objectif
principal était de vérifier que la prise en compte de l’orientation
matériau dans l’élément utilisateur était valide. Pour cela, on
représente sur la 17 le champ de la contrainte normale dans la
direction de chargement. On vérifie alors que cette contrainte est
maximale dans les plis à 90°, dont les fibres sont <I>orientées
dans la direction de chargement</I>, et négligeable dans le pli à
0°, qui est du coup sollicité en mode interfibre. Ce point est
confirmé sur la 18, qui montre que le critère de rupture fibre
n’est pas actif dans ce pli à 0°, alors qu’il est maximal et
qu’il localise dans les plis à 90°. 
</P>
<P STYLE="margin-bottom: 0.14in">Pourtant, la 19 montre que la
variable d’endommagement des fibres est non nulle dans le pli à
0°. Ce résultat non physique, et incompatible avec les champs de
contraintes observés, s’explique par le fait que la variable non
locale f<SUB>1</SUB><SUP>nl</SUP> est définie aux nœuds, comme les
déplacements, et interpolée par rapport aux valeurs de tous les
nœuds adjacents, y compris dans les plis voisins. Si cette
interpolation est justifiée pour les déplacements, qui restent
homogènes dans la structure en absence de discontinuité, elle n’est
plus nécessairement justifiée pour cette variable d’endommagement,
qui est censée être définie pli par pli. Il parait donc nécessaire
d’introduire des conditions de compatibilité entre les d.d.l. d’un
élément à un autre afin de forcer cette variable à rester
confinée dans chaque pli. Alternativement, des travaux antérieurs
[10] ont montré qu’en introduisant, à l’interface entre les
plis, des éléments de zone cohésive pour lesquels ce degré de
liberté supplémentaire n’est pas défini, on obtenait le
comportement attendu. Il est donc raisonnable de penser que cet
artefact numérique sera absent des calculs complets sur les essais
réels.</P>
<P STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<P ALIGN=CENTER STYLE="text-indent: 0.2in; margin-bottom: 0.14in; page-break-after: avoid">
<IMG SRC="i_75865f7e271f1242_html_b2d610a9.png" NAME="Image 15385" ALIGN=BOTTOM WIDTH=408 HEIGHT=371 BORDER=0></P>
<P LANG="en-GB" STYLE="margin-bottom: 0.14in; line-height: 100%"><A NAME="_Ref473552401"></A>
<FONT COLOR="#1f497d"><FONT FACE="Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><I><SPAN LANG="fr-FR">Figure
17: Concentration de contraintes au droit de l'entaille, pour un
stratifié croisé.</SPAN></I></FONT></FONT></FONT></P>
<P ALIGN=CENTER STYLE="text-indent: 0.2in; margin-bottom: 0.14in; page-break-after: avoid">
<IMG SRC="i_75865f7e271f1242_html_c96a8262.png" NAME="Image 15386" ALIGN=BOTTOM WIDTH=365 HEIGHT=321 BORDER=0></P>
<P LANG="en-GB" STYLE="margin-bottom: 0.14in; line-height: 100%"><A NAME="_Ref473552696"></A>
<FONT COLOR="#1f497d"><FONT FACE="Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><I><SPAN LANG="fr-FR">Figure
18: Localisation de la force motrice dans les plis les plus chargés.</SPAN></I></FONT></FONT></FONT></P>
<P ALIGN=CENTER STYLE="text-indent: 0.2in; margin-bottom: 0.14in; page-break-after: avoid">
<IMG SRC="i_75865f7e271f1242_html_b0475016.png" NAME="Image 15387" ALIGN=BOTTOM WIDTH=367 HEIGHT=321 BORDER=0></P>
<P LANG="en-GB" STYLE="margin-bottom: 0.14in; line-height: 100%"><A NAME="_Ref473552862"></A>
<FONT COLOR="#1f497d"><FONT FACE="Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><I><SPAN LANG="fr-FR">Figure
19: Diffusion de l'endommagement fibre au travers des  interfaces de
pli.</SPAN></I></FONT></FONT></FONT></P>
<OL>
	<OL START=9>
		<LI><H2 CLASS="western"><A NAME="_Toc473553304"></A>Perspectives 
		</H2>
	</OL>
</OL>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Si l’implémentation
de la méthode non locale implicite dans le code de calcul ABAQUS est
un succès, le temps consacré à sa mise au point n’a pas permis
de mettre bout à bout les différentes briques méthodologiques
permettant de valider la loi sur les essais réalisés dans le cadre
de l’ANR Vertex. Un certain nombre de points restent à vérifier
lors des prochains travaux.</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Dans un premier temps,
il s’agira de coupler les éléments non locaux développés ici
avec des éléments de zone cohésive placés à l’interface entre
les plis. Ceux-ci ont une double fonction. D’abord, ils permettent
naturellement de modéliser la tenue de l’interface, et de prévoir
l’amorçage et la propagation du délaminage. Il s’agira alors
d’introduire le couplage des endommagements inter et
intralaminaires, c’est-à-dire l’influence des microdélaminages
dans les plis sur l’amorçage d’un grand délaminage à
l’interface entre les plis. De plus, les zones cohésives
permettent aussi de confiner l’endommagement intralaminaire à
l’intérieur d’un unique pli, et d’éviter ainsi la diffusion
entre plis adjacents, non physique, et visible par exemple sur la 19.</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Une fois cette étape
validée, il sera alors finalement possible de simuler les essais
réalisés sur les grandes plaques entaillées avec le moyen d’essai
développé pour l’ANR Vertex. Pour ces derniers, le chargement
imposé est défini par un champ de déplacements des nœuds
externes, ces derniers étant eux-mêmes le résultat du traitement
de la corrélation d’images (<I>cf. </I>travaux de J.E. Pierré).
L’Onera a développé un outil qui permet de traiter ces
déplacements et de les convertir en un fichier texte qui est fourni
en entrée au logiciel ABAQUS, de manière à assigner nœud par nœud
chaque composante de déplacement imposée. 
</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Les premiers résultats
obtenus sur les essais de validation, et leur comparaison avec les
mesures de l’essai, permettront de valider la pertinence du modèle
proposé par l’Onera, ainsi que de mettre en évidence ses
éventuelles limitations. L’ensemble de ces travaux pourront,
compte-tenu de l’avancement actuel, être lancés rapidement dans
le cadre d’une suite à l’ANR Vertex.</P>
<P STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><FONT COLOR="#000000"><FONT FACE="Trebuchet MS, serif"><FONT SIZE=4><B>Apport
HOLO 3&nbsp;</B></FONT></FONT></FONT></P>
<P ALIGN=JUSTIFY STYLE="line-height: 100%">Lors du projet VERTEX,
subventionné par l’ANR, la société Holo3 a pu refondre
complétement la structure du logiciel Correli<SUP>STC</SUP>
permettant ainsi d’obtenir un logiciel robuste et ergonomique pour
l’utilisateur. La gestion de projet, de la langue, de différents
format bruts (jusqu’à 940), de la corrélation d’images avec des
images de 70 millions de pixels, rendent l’utilisation du logiciel
Correli<SUP>STC</SUP> plus convivial. Cette nouvelle version 2.0
possède en plus des particularités de la version 1.54 (jauges
virtuelles, profils.) un éditeur de rapport automatique, un import
des résultats issus des simulateurs, une calculatrice qui utilise
les résultats des jauges virtuelles. Ces ajouts facilitent le
travail des opérateurs après les essais mécaniques.</P>
<P ALIGN=CENTER STYLE="line-height: 100%; page-break-after: avoid"><IMG SRC="i_75865f7e271f1242_html_58b4ecef.png" NAME="Image 26" ALIGN=BOTTOM WIDTH=605 HEIGHT=328 BORDER=0></P>
<P LANG="en-GB" ALIGN=CENTER STYLE="margin-bottom: 0.14in; line-height: 100%">
<FONT COLOR="#1f497d"><FONT FACE="Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><I><FONT SIZE=2 STYLE="font-size: 11pt"><SPAN LANG="fr-FR">Figure
1: Interface du logiciel Correli</SPAN></FONT><SUP><FONT SIZE=2 STYLE="font-size: 11pt"><SPAN LANG="fr-FR">STC</SPAN></FONT></SUP><FONT SIZE=2 STYLE="font-size: 11pt"><SPAN LANG="fr-FR">
V2.1.0.1</SPAN></FONT></I></FONT></FONT></FONT></P>
<P ALIGN=JUSTIFY STYLE="line-height: 100%"> L’accélération ainsi
que la parallélisation des calculs ont permis d’obtenir une
nouvelle fonctionnalité&nbsp;: l’analyse en temps réel. Pendant
l’enregistrement des images, le calcul par stéréo corrélation
est effectué tous les n niveaux, ce qui permet de suivre l’évolution
des déplacements et des déformations lors de l’essai mécanique,
tout en enregistrant des entrées analogiques. Une démonstration a
été réalisée au mois de mars 2016 dans les locaux de l’ICA. Le
transfert sur carte graphique est en cours de programmation dans nos
locaux.</P>
<P ALIGN=CENTER STYLE="line-height: 100%; page-break-after: avoid"><IMG SRC="i_75865f7e271f1242_html_eb8ef1b5.png" NAME="Image 27" ALIGN=BOTTOM WIDTH=605 HEIGHT=385 BORDER=0></P>
<P LANG="en-GB" ALIGN=CENTER STYLE="margin-bottom: 0.14in; line-height: 100%">
<FONT COLOR="#1f497d"><FONT FACE="Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><I><FONT SIZE=2 STYLE="font-size: 11pt"><SPAN LANG="fr-FR">Figure
2: Calculs réalisés en temps réel</SPAN></FONT></I></FONT></FONT></FONT></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><FONT COLOR="#000000"><FONT FACE="Trebuchet MS, serif"><FONT SIZE=4><B>Apport
LMS SIEMENS-SAMTECH FRANCE&nbsp;</B></FONT></FONT></FONT></P>
<P STYLE="margin-bottom: 0.14in"><B>Modélisation</B></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_a13c14cc.png" NAME="Image 31" ALIGN=BOTTOM WIDTH=605 HEIGHT=288 BORDER=0></P>
<P STYLE="margin-bottom: 0.14in"><I>Conversion des données de
mesures fournies par ICA :</I></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Les déplacements
mesurés en cours d’essai (Trois translations et deux rotations)
sont fournis dans un fichier transmis par ICA. Un programme de
conversion traduit ces données en une suite de commandes écrites en
syntaxe de SAMCEF.</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_11690f8c.png" NAME="Image 32" ALIGN=BOTTOM WIDTH=605 HEIGHT=447 BORDER=0></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Le délaminageest
modélisée par des éléments d’interface placés entre deux plis
consécutifs et un maillage en quadrangles.</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_45b0167d.png" NAME="Image 33" ALIGN=BOTTOM WIDTH=498 HEIGHT=185 BORDER=0></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Le comportement de
matériau utilisé est celui du modèle augmenté pour plis UD, mis
au point par le LMT Cachan, qui prend en considération ;
endommagement, plasticité, rupture.</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Il est possible
d’introduire un couplage entre les comportements intra et inter
laminaires.</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Le modèle augmenté
de Cachan est obtenu en superposant au schéma standard, une
description de la fissuration transverse considérée du point de vue
micromécanique. L’interface est également modifiée. En plus de
sa définition classique, on considère que l’endommagement dépend
de la fissuration transverse du pli.</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Il est non local:
l’endommagement est constant sur l’épaisseur du pli et il n’y
a pas d’interaction entre le pli et l’interface. Dans le but de
tenir compte de ce comportement non local, l’utilisateur doit le
préciser en utilisant un élément au comportement adéquat doté
d’une hypothèse spécifique dite NON LOCALE. Si une autre
hypothèse est choisie, l’aspect non local est ignoré. En
conséquence, l’endommagement n’est plus constant sur l’épaisseur
du pli, et l’interface ne voit pas la densité de fissuration.</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Il est également
possible d’introduire un endommagement initial.</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Le modèle est le
fruit des travaux de G. Lubineau et P. Ladevèze: Construction of a
micromechanics-based intralaminar model and illustrations in Abaqus
standard, Computational Materials Science, v. 43(1), pp. 137-145,
2008.</P>
<P STYLE="margin-bottom: 0.14in"><B>Résultats de calcul</B></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><I>Plaque en Traction
; empilement C3-2</I></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><I>Temps CPU : 11H37mn</I></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_12920b13.png" NAME="Image 35" ALIGN=BOTTOM WIDTH=605 HEIGHT=338 BORDER=0></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_bd665852.png" NAME="Image 36" ALIGN=BOTTOM WIDTH=605 HEIGHT=407 BORDER=0></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><I>Plaque en combiné
Traction Cisaillement ; empilement C3-2</I></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in">Temps CPU : 5h35mn</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_ee08036e.png" NAME="Image 37" ALIGN=BOTTOM WIDTH=605 HEIGHT=297 BORDER=0></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in">Module des déplacements
en combiné traction cisaillement C32 :</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><IMG SRC="i_75865f7e271f1242_html_8a76c99e.png" NAME="Image 38" ALIGN=BOTTOM WIDTH=605 HEIGHT=222 BORDER=0></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
