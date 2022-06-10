===============
Fichiers Public
===============

Dans le dossier public nous trouvons deux fichiers : *liste-equipements.php* ainsi que *liste-offres-emploi.php* .
Sachant que la méthode utilisée pour les deux est la même nous allons regrouper les explications en deux parties.

.. note::
    Ces deux fichiers sont les seuls de leurs pages dans le dossier Public, nous n'avons donc pas créer de dossier dédié
    pour éviter les dossier avec un unique fichier.


Composition de la page
======================

Page Equipements
----------------

Si nous observons les widgets qui composent cette page nous pouvons observer qu'il y a un widget **MetaSlider** qui permet d'afficher un diaporama sur la page.
Parmis ces widgets nous pouvons retrouver un **Insert Snippet** faisant appel à la page décrite plus bas dans la documentation.
De plus on peut aussi trouver un bouton menant à la page de réservation des équipements ainsi qu'un widget **SiteOrigin Editeur** ajoutant un titre.

Le nombre d'equipement et d'offres
==================================

Nombre d'équipements
--------------------

Pour calculer le nombre d'équipements on fait appel à la fonction **nombreEquipement** 
Ensuite on retrouve l'affichage selon le nombre d'équipements.

Nombre d'offres
---------------

Pour calculer le nombre d'offres on fait appel à la fonction **nombreOffresDispo** 
Ensuite on retrouve l'affichage selon le nombre d'offres.
Le template appelé est : *Tableau des offres*


Les listes
==========

Pour expliquer le fonctionnement des listes nous allons prendre pour exemple la partie Contrat CDD du fichier *liste-offres-emploi* :

.. code-block:: PHP
    :caption: Exemple de code

	$type_offre ="Contrat CDD";
	$res = $bdd->analyseListeOffresDispo($type_offre);
	if ($res[0][0] > 0)
		?>
		<p style='font-size: 1.33em; padding-left: 45px; color: #ba2133;'><strong><?=TXT_CDD_EMPLOI?></strong></p>
		<?php
		echo do_shortcode('[pods name="offre_emploi" where="type_offre=\'Contrat CDD\' AND date_fin >= \''.date('Y-m-d').'\'" template="Liste des offres" limit="1000"]');

Nous allons décomposer le code ci-dessus pour mieux comprendre son fonctionnement.
Premièrement on va définir notre parametre avec la variable **$type_offre** .
Ensuite on va faire appel à la requete **analyseListeOffresDispo** se trouvant dans le fichier *GestionBdd.php* .
Cette requete nécéssite un parametre qui est ici défini avec **$type_offre**.
Enfin la derniere partie de ce code va utiliser une balise **<p>** pour afficher le titre de la partie.
La dernière ligne du code fait appel au pod que nous retrouverons sur WordPress.