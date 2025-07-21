============
Publications
============

Publications acl
================

Le fichier Annuaire fais appel à *publication_fonctions.php* que nous verrons après.

On va attribuer l'url de l'api à la variable *$url* .
Ensuite on utilise la variable pour récupérer le json qui sera lui attribué à la variable *$json*
Selon le nombre de résultats on aura différents affichages

Cette page n'affiche qu'une quantité limitée de publications.
Tout en bas de la page on peut retrouver un lien nous amenant vers la page *publication-tous-acl.php*
ainsi qu'un bouton nous permettant de rechercher une publication en nous redirigeant vers *search-publi.php*

Publications tous acl
=====================

Page reprenant le même code que la page *publications-acl* cependant ici nous affichons toutes les publications.
Pour cela on utilisera la fonction **affichagePublication** qui sera définie dans le fichier *publication-fonctions.php*


Search public
=============

Cette page permet de choisir des options de filtrage pour trier les publications.
Toutes ces optiosn se retrouvent dans les selects présents dans le code.
Il y a différentes parties : **Groupe**, **Type de document**, **Période**

Fonctions Publications
======================

Ce fichier contient deux fonctions : **affichagePublication** et **affichagePublicationAvancee**.
**affichagePublication** permet d'afficher les acl avec l'année, les auteurs, les titres, sous-titres, le volume, les pages, la ville ainsi que le pays.
**affichagePublicationAvancee** permet la recherche avancée ainsi que de voir les profils d'auteurs.
Celui-ci n'est pas utilisé actuellement dans le code de publications.