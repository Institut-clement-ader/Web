=================
Fichiers Intranet
=================

Annuaire gestionnaire
=====================

Au début du code de notre snippet on peut retrouver la gestion des membres.
Les membres peuvent être cachés en utilisant la requete **cacherMembre**, on peut aussi
retablir les membres cachés précédement avec la requete  **retablirMembre1**
Ensuite on retrouve les requetes permettant la suppression :

- **supprimerDoctorantTableUser**
- **supprimerDoctorantTableUserMeta**
- **supprimerDoctorantTablePodsrel**

Dans la suite du code nous retrouvons la création du tableau pour la gestion de l'annuaire. Celui-ci ressemble au tableau
de la page d'annuaire publique. La différence se trouve dans l'apparition des boutons des 3 forms : Cacher, Supprimer, Rétablir. 

Mailing
=======

Le snippet mailing contient un très grand form, celui-ci contient différents group option  contenant eux meme de nombreuses options.
A la fin de la partie contenant les options nous pouvons retrouver le champ permettant la recherche.
On y récupère avec le POST le nombre qui sera attribué à la variable *$nb* .
Ensuite on retrouve le fonctionnement du submit permettant l'envoie des données. Celui-ci permet de rechercher par éléments précisés par l'utilisateur la liste.


Supprimer projet
================

Pour supprimer un projet on vérifie qu'un id à été transmis avec le *$_POST*.
Ensuite on fait appel à la requête **suprimerProjet1** prenant pour parametre le *$id* récupéré avec le post.
