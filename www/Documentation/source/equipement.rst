==========
Equipement
==========

Cette page utilise le fichier (snippet) liste-gestion-equipements qui est presque identique à liste-equipement utilisé dans la page equipement dans le public.
La description sera donc la même 

Composition de la page
======================

Page Equipements
----------------

Si nous observons les widgets qui composent cette page nous pouvons observer qu'il y a deux widget des **Insert Snippet** faisant appel à **redirect-admin-user** ainsi qu'a **liste-equipement** .
De plus on peut voir un widget **Pod** faisant appel à moyen.

Supprimer un moyen
==================

Pour supprimer un moyen on vérifie qu'un id à été transmis avec le *$_GET*.
Ensuite on fait appel à la requête **suprimerMoyen** prenant pour parametre le *$id* récupéré avec le get.

Pour la suite de la suppression on utilise un *$_GET* pour récupérer l'url et on supprime le fichier associer si il existe.


Le nombre d'equipement et d'offres
==================================

Nombre d'équipements
--------------------

Pour calculer le nombre d'équipements on fait appel à la fonction **nombreEquipement** 
Ensuite on retrouve l'affichage selon le nombre d'équipements.

Nombre d'offres
---------------

Pour calculer le nombre d'offres on fait appel à la fonction **nombreOffresDispo** 
Ensuite on retrouve l'affichage selon le nombre d'équipements.
Le template appelé est : *Tableau des moyens (gestion)*

Les listes
==========

Pour expliquer le fonctionnement des listes nous allons prendre pour exemple la partie Contrat CDD du fichier *liste-offres-emploi* :

.. code-block:: PHP
    :caption: Exemple de code
	
	$categorie ="Analyse physico-chimique";
	$res = $bdd->analyseListeEquipement($categorie);
	if ($res[0][0] > 0)
  		?>
		<br><p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong>Equipement Analyse physico-chimique</strong></p>
		<?php
		echo do_shortcode('[pods name="moyen" where="categorie=\'Analyse physico-chimique\'" template="Tableau des moyens (gestion)" limit="1000"]');

Nous allons décomposer le code ci-dessus pour mieux comprendre son fonctionnement.
Premièrement on va définir notre parametre avec la variable **$categorie** .
Ensuite on va faire appel à la requete **analyseListeEquipement** se trouvant dans le fichier *GestionBdd.php* .
Cette requete nécéssite un parametre qui est ici défini avec **$categorie**.
Enfin la derniere partie de ce code va utiliser une balise **<p>** pour afficher le titre de la partie.
La dernière ligne du code fait appel au pod que nous retrouverons sur WordPress.