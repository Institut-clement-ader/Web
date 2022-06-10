==========
Formulaire
==========

Particularité du formulaire
===========================

La page de formulaire fais appel à un snippet qui n'est pas celui présent dans le dossier.
Le fichier utilisé est trouvable dans le dossier wp_admin/formulaire-inscription.php cependant le fichier modification se trouve 
dans le dossier formulaire de l'intranet.

Inscription formulaire
======================

.. important::
    
    Le fichier formulaire-inscription n'étant pas dans le dossier App nous avons mis une copie identique dans celui-ci même si elle n'est pas utilisée.
    Cela permet de retrouver et comprendre rapidement le fonctionnement de la page.

Sur le gestionnaire WordPress de cette page on trouvera un bouton permettant de se diriger vers la page de modification d'un utilisateur.
On peut ensuite trouver un widget **SiteOrigin Editeur** qui fait appel au snippet *formulaire-inscription*.
Le dernier widget present est un **Pod** faisant appel à theses.

Pour expliquer le fonctionnement de la page les deux grandes étapes sont la récupération de l'utilisateur et l'affichage des options différentes.
Les selects présents sont : id,axe_1,axe_2,axe_3,etablissement,actv_rech.


Modification d'un utilisateur
=============================

Cette page reprend un code très similaire à celui présent au dessus les différences se trouvent dans les widgets.
On ne fait appel à aucun pod dans le gestionnaire actuel.

Certains éléments ont étés retirés du formulaire.