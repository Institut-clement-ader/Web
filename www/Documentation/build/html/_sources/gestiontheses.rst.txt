======
Theses
======

Composition de la page
======================

Si nous visualisons le gestionnaire Wordpress nous pouvons voir que la page fait appel à 5 snippet :

- *redirect-user*
- *10doctorants-theses*
- *supprimer-theses*
- *nomre-thesesencours*
- *nombrethesessoutenues*

Il y a aussi 3 **pods** Theses ainsi qu'un **pod Formulaire**  Theses. On peut aussi retrouver un bouton pour télécharger 
les documents en format excel. Les derniers widgets du gestionnaire affichent du texte, des titres ou autre.

Ajout nouvelle Theses
=====================

Pour ajouter un nouvelle these nous faisons appel au **pod Formulaire** These qui crée le formulaire avec les différents champ :
doctorant, titre_these, nom_doct, prenom_doct, directeur_int, encadrant_int1, encadrant_int2, encadrants_ext, ecole_doctorale, date_debut, fin_previsionnelle


Affichage des doctorants
========================

Pour afficher les doctorants nous allons voir le snippet *10doctorants-theses*.

Le début du code fait appel à trois requetes permettant la suppression d'un doctorant. Les trois requetes
sont :

- **supprimerDoctorantTableUser**
- **supprimerDoctorantTableUserMeta**
- **supprimerDoctorantTablePodsrel**

Ensuite le reste du code présente le tableau, dans les <td> on peut retrouver les différentes parties des lignes : textes, variables , formulaires ...

