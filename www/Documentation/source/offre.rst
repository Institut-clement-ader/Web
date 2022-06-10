======
Offres
======

Cette page utilise les fichiers (snippet) *redirect-user* et *liste-gestion-offre-emploi* qui reprends le code du fichier liste-offres-emploi
et un **pod template** offre emploie.
La page fait appel aussi à *supprimer-offre*.

Nombre d'offres
===============

Pour calculer le nombre d'offres on fait appel à la fonction **nombreOffres** 
Ensuite on retrouve l'affichage selon le nombre d'offres.
Le template appelé est : *Tableau des offres (gestion)*

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

Supprimer offre
===============

Pour supprimer une offre on vérifie qu'un id à été transmis avec le *$_GET*.
Ensuite on fait appel à la requête **suprimerOffre** prenant pour parametre le *$id* récupéré avec le get.

Pour la suite de la suppression on utilise un *$_GET* pour récupérer l'url et on supprime le fichier associer si il existe.