========
Annuaire
========

Le fichier Annuaire
===================

Le fichier Annuaire fais appel à *annuaire_fonction.php* que nous verrons après.

On peut retrouver la traduction de la page avec le code faisant appel au pages lang-en et lang-fr.
Les variables exemple : **TXT_NOM_ANNUAIRE** permettent la traduction automatique des entete tu tableau.

Le tableau représentant l'annuaire est trié par nom de famille :
    *$users = get_users("orderby=user_lastname");*

**statusToString** est une fonction que l'on retrouve dans la page annuaire_fonctions que nous définirons après.

On vérifie si le statut de l'utilisateur n'est pas professeur et on affichera *HDR* avec "echo HDR" devant son status si c'est le cas.
Enfin on effectue une vérification des groupes des utilisateurs pour echo *AXTR* et on echo l'établissement de rattachement de l'utilisateur.


Les fonctions d'Annuaire
========================

Ce fichier ne contient qu'une seule fonction, elle utilise un switch case pour vérifier le status de l'utilisateur. 

.. note::
    Ce fichier est utilisé dans le fichier *annuaire.php* que nous avons vu ci-dessus.
