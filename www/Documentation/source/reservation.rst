============
Réservations
============

.. note::
    Nous allons voir ici la page la plus complexe de tout le site, il est conseillé d'utiliser une recherche navigateur (ctrl+f) pour
    retrouver plus facilement les informations qui vous sont nécéssaires.

.. important::

    la table réservation la rubrique axe_recherche a été remplacer par groupe suite à des amélioration dans le code

Events
======

Ce fichier permet de récupérer les événements (réservations) en fonction de différentes options.
Ce fichier est utilisé dans *afficherjournee.php* , *calendrier.php* , *getCalendrier.php* , *getTableau.php* , *GetMoyen.php* , *mesReservation.php* , *supprimerReservation.php* , *tableauReservation.php* et *voirReservation.php* .
Ce fichier import *GestionBdd.php* qui va permettre d’envoyer les requêtes.

Les fonctions Event
-------------------

**getEventsBetween** : Récupère les évènements qui sont entre deux dates.

**getEventsBetweenByDay** : Récupère les évènements qui sont entre 2 dates indexé par jour.
Il appelle la fonction **getEventsBetween** contenu dans *Events.php* .
Pour chaque événement entre les deux dates, on récupère la date de début de l’événement et la date de fin et toutes les autres dates entre date de début et de fin que l’on renvoie.

**getEventsBetweenByDayByMoyen** : Récupère les évènements qui sont entre 2 dates indexé par jour et par moyen.
Il appelle la fonction **dateDansUnMoisParMoyen** contenu dans *GestionBdd.php*.
Pour chaque événement entre les deux dates, on récupère la date de début de l’événement et la date de fin et toutes les autres dates entre date de début et de fin que l’on renvoie.

**getEventByDayandCategorie** :Cherche un événement en fonction du jour et d’une catégorie donné.
Il appelle la fonction **getParJourEtCategorie** contenu dans *GestionBdd.php* renvoie le résultat.

**getEventByDayandMoyen** :Cherche un événement en fonction du jour et d’un moyen donné.
Il appelle la fonction **getParJourEtMoyen** contenu dans *GestionBdd.php* et renvoie le résultat.

**getEventById** :Cherche un événement par son Id .
Il appelle la fonction **getRéservationById** contenu dans *GestionBdd.php* renvoie le résultat.

**getMoyenByCategorie** :Cherche tous les moyens de la catégorie.
Il appelle la fonction **getMoyenCategorie** contenu dans *GestionBdd.php* renvoie le résultat.

**getResponsable** :Cherche tous les responsables d’un moyen.
Il appelle la fonction **getResponsableParMoyen** contenu dans *GestionBdd.php* renvoie le résultat.

**deleteEventById** :Supprimer une réservation par son ID.
Il appelle la fonction **deleteReservationById** contenu dans *GestionBdd.php* renvoie le résultat.

**getEventByName** :Cherche tous les événements en fonction de son titre.
Il appelle la fonction **getReservationByNom** contenu dans *GestionBdd.php* renvoie le résultat.

**getEventByName** :Cherche tous les événements en fonction de son titre.
Il appelle la fonction **getReservationByNom** contenu dans *GestionBdd.php* renvoie le résultat.

**getEventsByCategorie** :Cherche tous les événements en fonction de la catégorie du moyen.
Il appelle la fonction **getReservationParCatégorie** contenu dans *GestionBdd.php* renvoie le résultat.

**getEventsByCategorieAndUser** :Cherche tous les événements en fonction de la catégorie du moyen et l’utilisateur.
Il appelle la fonction **getReservationParCatégorieEtUtilisateur** contenu dans *GestionBdd.php* renvoie le résultat.

**getEventsByMoyen** :Cherche tous les événements en fonction du moyen.
Il appelle la fonction **getReservationParMoyen** contenu dans *GestionBdd.php* renvoie le résultat.

**getEventsByMoyenAndUser** :Cherche tous les événements en fonction du moyen.
Il appelle la fonction *getReservationParMoyenEtUtilisateur* contenu dans *GestionBdd.php* renvoie le résultat.

**afficherLesCategorie** :Cherche toutes les catégories.
Il appelle la fonction **getCategorie** contenu dans *GestionBdd.php* renvoie le résultat.

**getUtiEventsByMoyen** :Cherche tous les utilisateurs qui ont réservés le moyen donné.
Il appelle la fonction **getUtiReservationParMoyen** contenu dans *GestionBdd.php* renvoie le résultat.

**getUtiEventsByCategorie** :Cherche tous les utilisateurs qui ont réservé un moyen de la catégorie donné. 
Il appelle la fonction **getUtiReservationParCatégorie** contenu dans *GestionBdd.php* renvoie le résultat.

Month
=====

Ce fichier permet de récupérer le mois, de connaitre son nombre de semaines et de jours.
Ce fichier est utilisé dans *calendrier.php* .
Ce fichier import lang-fr ou lang-en en fonction de la langue sélectionner qui va permettre de changer la langue grâce aux variables TXT.
Cette classe à 4 attributs.

- *$days* qui corresponds au jours de la semaine. 
- *$months* représente les mois de l’année.
- *$month* le mois sélectionner.
- *$year* l’année sélectionner.

Les fonctions Month
-------------------

**Constructeur** : à en paramètre le numéro du mois et l’année pour déterminer le nombre de jour dans le mois.

**getDays** : récupère *$days*.

**getMonth** : récupère *$month*.

**getYear** : récupère *$year*.

**getStartDay** : retourne le premier jour du mois .

**toString** : retourne le mois et l’année sous forme de chaine de caractère. 

**getWeeks** : retourne le nombre de semaine. 

**withinMouth** : récupère les jours qui ne sont pas dans le mois mais dans les même semaine que le premier jour et le dernière jour du mois.

**nextMonth** : passe au mois suivant $month prend +1 et si $month = 12 alors il retourne à 1.

**previousMonth** : passe au mois précédent $month prend -1 et si $month = 1 alors il retourne à 12.

Nouvelle Réservation
====================

Ce fichier permet de vérifier les différentes exceptions pour la création ou la modification d’une réservation.
Ce fichier est utilisé dans *ajouterReservation.php* et *ModifierReservation.php* .
Ce fichier import *GestionBdd.php* qui va permettre d’envoyer les requêtes.

**Chevauchement2jours** : Vérifie si la date de début de la réservation est supérieure à la date de fin.
Si la date de début et supérieur à la date de fin la fonction renvoie true.
Sinon renvoie false.

**Chevauchement2heures** : Vérifie si l’heure de début de la réservation est supérieure à l’heure de fin.
Si l’heure de début et supérieur à l’heure de fin la fonction renvoie true.
Sinon renvoie false.

**CreationReservation** : créer la réservation dans la bdd.
Récupère toutes les infos pour créer une réservation.
Appel la fonction **fusionDateEtHeure** de *NouvelleReservation.php* .
Appel la fonction **creerReservation** de *GestionBdd.php* .
Renvoie true si tout est bon.

**chevauchementMemeMoyen** : vérifie si le moyen de la réservation n’est pas déjà réserver pendant l’intervalle.
Appel la fonction **fusionDateEtHeure** de *NouvelleReservation.php* .
Récupère la date de début et on ajoute 1 minute.
Récupère la date de fin et on enlève 1 minute.
Appel la fonction **verificationChevauchementMemeMoyen** de *GestionBdd.php* et la renvoie.


**fusionDateEtHeure** : fusionne la date et l’heure pour faire un type DATETIME et renvoie le datetime.

**separeDateEtHeure** :  sépare la date et l’heure pour avoir un type Date et l’autre Time et renvoie les deux type dans un tableau.

**getMoyenParCategorie** : Recherche les moyens en fonction de leur catégorie.
Appel la fonction **getMoyensCategorie** de *GestionBdd.php* et la renvoie.

**afficherLesEncadrant** : Recherche les encadrants possible.
Appel la fonction **getEncadrantPossible** de *GestionBdd.php* et la renvoie.

**afficherLesGroupes** : Recherche les groupes possibles . 
Appel la fonction **getGroupePossible** de *GestionBdd.php* et la renvoie. 

**getEventById** : Recherche une réservation en fonction de son Id.
Appel la fonction getReservationById de *GestionBdd.php* et la renvoie.

**modifierReservation** : modifie la réservation dans la bdd.
Récupère toutes les infos pour créer une réservation.
Appel la fonction **fusionDateEtHeure** de *NouvelleReservation.php* .
Appel la fonction **updateReservationById** de *GestionBdd.php* et la renvoie.

**chevauchementMemeMoyenIdDifferent** : vérifie si le moyen de la réservation n’est pas déjà réserver pendant l’intervalle sans compter les réservations qui ont le même Id.
Appel la fonction **fusionDateEtHeure** de *NouvelleReservation.php* .
Récupère la date de début et on ajoute 1 minute.
Récupère la date de fin et on enlève 1 minute.
Appel la fonction **verificationChevauchementMemeMoyenIdDifferent** de *GestionBdd.php* et la renvoie.


**envoieMailAjout** : Envoie un mail au responsable pour chaque ajout d’une réservation.
Récupère toutes les infos de la réservation.
Appel la fonction **getResponsableParMoyen** de *GestionBdd.php*.
Appel la fonction **RechercheMailResponsable** de *GestionBdd.php*. 
Envoie le mail au différent responsable récupérer via **RechercheMailResponsable**.

**afficherLesCategorie** :Cherche toutes les catégories.
Il appelle la fonction **getCategorie** contenu dans *GestionBdd.php* renvoie le résultat.

**envoieMailModif** : Envoie un mail au responsable pour chaque modification d’une réservation.
Récupère toutes les infos de la réservation.
Appel la fonction **getResponsableParMoyen** de *GestionBdd.php*.
Appel la fonction **rechercheMailResponsable** de *GestionBdd.php*. 
Envoie le mail au différent responsable récupérer via **RechercheMailResponsable**.

Afficher Journée
================

Ce fichier permet d’afficher les réservations de la journée en fonction de la categorie ou du moyen mis dans la session.
Ce fichier est utilisé dans la page ‘Réservation d’une journée’.
Ce fichier import *Events.php* qui va permettre d’envoyer les requêtes et lang-fr ou lang-en en fonction de la langue sélectionner qui va permettre de changer la langue grâce aux variables TXT.

S’il n’y a pas de GET alors le fichier renvoie l’utilisateur sur la page ‘Calendrier des réservation’.
On récupère la date et on appelle la fonction **getEventByDayAndCateogire** de *Events.php* avec la catégorie dans la session et la date.
On appelle la fonction **getMoyenParCategorie** de *Events.php* avec la catégorie dans la session.
Si le moyen dans la SESSION est dans la catégorie dans la session alors on appelle **getEventByDayAndMoyen** sinon on garde le résultat de **getEventByDayAndCateogire**.
On affiche la requête garder dans un tableau.
Le lien ‘consulter’ va permettre d’aller sur la page ‘Réservation’.

Ajouter Reservation
===================

.. important::

    le $POST[axe_recherche] a été remplacer par les groupes suite à des améliorations du code

Ce fichier est le formulaire de la création d’une réservation ainsi que son ajout dans la bdd et la vérification des exceptions.
Ce fichier est utilisé dans la page ‘Ajouter une réservation’.

Ce fichier import *NouvelleReservation.php* qui va permettre d’envoyer les requêtes et lang-fr ou lang-en en fonction de la langue sélectionner qui va permettre de changer la langue grâce aux variables TXT.

L’utilisateur via le formulaire va écrire toutes les informations qu’il veut mettre sauf nom d’utilisateur qui est récupéré via le nom de l’utilisateur courant et encadrant s’il n’est pas doctorant.
Pour chaque rubrique du formulaire on vérifie si le $_POST contient le résultat pour pouvoir l’afficher sinon on n’affiche rien.

Moyen, raison et encadrant sont des menus déroulants pour aider l’utilisateur à choisir parmi les choix disponibles.

Le menu déroulant Moyen appelle **afficherLesCategorie** et **getMoyenParCategorie** de *NouvelleReservation.php* pour pouvoir faire le menu déroulant et affiche tous les moyens et les catégories possible.

Le menu déroulant Encadrant appelle **afficehrLesEncadrant** de *NouvelleReservation.php* pour afficher tous les encadrants possibles.

Pour vérifier les exceptions le fichier appelle **chevauchementMemeMoyen** , **chevauchement2jours** , **chevauchement2heures** de *NouvelleReservation.php* si une des 4 retournes true alors il y a une erreur et un message s’affiche en fonction de l’erreur.
S’il n’y a pas d’erreur dans les informations que l’utilisateur à mis alors on envoie le mail au responsable via envoieMailAjout de *NouvelleReservation.php* et on crée la réservation via creationReservation de *NouvelleReservation.php* et on envoie un message de succès.

Calendrier
==========

Ce fichier d’afficher les réservations sous forme de calendrier, il permet aussi de filtrer les réservations avec les catégories ou directement le moyen.
Ce fichier est utilisé dans la page ‘Calendrier des réservations’.

Ce fichier import *Events.php* qui va permettre d’envoyer les requêtes, *Month.php* qui va permettre de voir le mois du calendrier et lang-fr ou lang-en en fonction de la langue sélectionner qui va permettre de changer la langue grâce aux variables TXT.

On crée le Month avec comme mois par defaut le mois actuel et on récupère toutes informations du mois via **getStartDay** , **GetWeeks** de *Month.php* .
Si le POST existe alors on récupère la catégorie et on le met dans la SESSION.
Si le POST contient un moyen alors on le récupère et on le met dans la SESSION.
Sinon on récupère les informations par la SESSION.

On récupère la date et on appelle la fonction **getEventsBetweenByDay** de Events.php avec la catégorie récupérer.

On appelle la fonction **getMoyenParCategorie** de *Events.php* avec la catégorie récupérée.
Si le moyen est dans la catégorie alors on appelle **getEventsBetweenByDay**ByMoyen sinon on garde le résultat de **getEventsBetweenByDay**.

On affiche le mois et l’année grâce au toString de *Month.php*.

Le formulaire est constitué de deux menus déroulants l’un les catégories affichées via **afficherLesCatégorie** de *Events.php* et le moyen via **getMoyenParCategorie** de *Events.php* avec la catégorie récupèrer.
Les deux boutons avec des flèches permettent de passer aux mois précédents via **previousMonth** de *Month.php* et au mois suivant via **nextMonth** de *Month.php* .

On affiche les résultats de la requête **getEventsBetweenByDayByMoyen** ou **getEventsBetweenByDay** dans le calendrier.
On grise les jours qui ne sont pas dans le mois via **withinMonth** de *Month.php*.

Get Calendrier
==============

Ce fichier permet d’actualiser le calendrier en fonction du filtre des menus déroulants. 
Ce fichier est utilisé dans la page ‘Calendrier des réservations’ grâce au Javascript.

Ce fichier import *Events.php* qui va permettre d’envoyer les requêtes, *Month.php* qui va permettre de voir le mois du calendrier et lang-fr ou lang-en en fonction de la langue sélectionner qui va permettre de changer la langue grâce aux variables TXT.

S’il y a une catégorie dans le GET on appelle **getEventsBetweenByDay** de Events.php avec les deux dates ainsi que la catégorie dans le GET et on met la catégorie dans le GET dans la SESSION.
    On appelle la fonction **getMoyenParCategorie** de *Events.php* avec la catégorie dans le GET pour récupérer tous les moyens dans la catégorie.
    Si le moyen dans la SESSION est dans la catégorie alors on appelle **getEventsBetweenByDayByMoyen** et la requête sera affichée dans le tableau sinon on affiche le résultat de **getEventsBetweenByDay** de *Event.php* .

Sinon si un moyen dans le GET et il n’est pas null on appelle **getEventsBetweenByDayByMoyen** de *Events.php* avec le moyen dans le GET et on met le moyen dans le GET dans la SESSION.

Sinon on appelle **getEventsBetweenByDay** de *Events.php* avec la catégorie dans la SESSION.

On affiche les résultats de la requête **getEventsBetweenByDayByMoyen** ou **getEventsBetweenByDay** dans le calendrier.
On grise les jours qui ne sont pas dans le mois via **withinMonth** de *Month.php* .

Get Mon Tableau
===============

Ce fichier permet d’actualiser le tableau de la page ‘Mes réservations’ en fonction du filtre des menus déroulants.
Ce fichier est utilisé dans la page ‘Mes réservations’ grâce au Javascript.

Ce fichier import *Events.php* qui va permettre d’envoyer les requêtes et lang-fr ou lang-en en fonction de la langue sélectionner qui va permettre de changer la langue grâce aux variables TXT.

On récupère les GET de la date de début et de fin (sachant que par défaut date de début et la date du jour et la date de fin 1er janvier 3000).

On appelle **getEventByName** de *Event.php* avec le nom d’utilisateur et les deux dates qui vont permettre de récupérer les réservations.
S’il n’y a pas de résultat dans la requête alors on affiche un message pour dire qu’il n’y a pas de réservation.
Sinon On affiche la requête dans un tableau.

Le lien ‘consulter’ va permettre d’aller sur la page ‘Réservation’.


Get Moyen
=========

Ce fichier permet de changer la liste déroulant des moyens en fonction de la catégorie choisi.
Ce fichier est utilisé dans la page ‘Calendrier des réservation’ et ‘Tableau des réservation’ grâce au Javascript.

Ce fichier import *Events.php* qui va permettre d’envoyer les requêtes.
On appelle la fonction **getMoyenParCategorie** de *Events.php* avec la catégorie dans le GET pour récupérer tous les moyens dans la catégorie.
Si le moyen dans la SESSION est égal à un des résultats de la requête alors on le sélectionne dans le menu.

Get Tableau
===========

Ce fichier permet d’actualiser le tableau de la page ‘Tableau des réservations’ en fonction du filtre des menus déroulants.
Ce fichier est utilisé dans la page ‘Tableau des réservations’ grâce au Javascript.

Ce fichier import **Events.php** qui va permettre d’envoyer les requêtes et lang-fr ou lang-en en fonction de la langue sélectionner qui va permettre de changer la langue grâce aux variables TXT.
On récupère les GET de la date de début et de fin (sachant que par défaut date de début et la date du jour et la date de fin 1er janvier 3000).

S’il y a la catégorie dans le GET existe alors on appelle **getEventsByCategorie** de **Events.php** avec la catégorie dans le GET ainsi que les deux dates et on met la catégorie dans le GET dans la SESSION.  
    S’il y a un utilisateur dans le GET alors :
        S’il n’est pas null alors on le récupère et on appelle **getEventsByCategorieAndUser** de **Events.php** avec la catégorie et l’utilisateur dans le GET ainsi que les deux dates et on met l’utilisateur dans le GET dans la SESSION.
        Sinon on met juste l’utilisateur null dans la SESSION.
    Sinon on appelle **getUtiEventsByCategorie** de **Events.php** avec la catégorie dans le GET ainsi que les deux dates.
        Si parmi les résultats de **getUtiEventsByCategorie** s’il y en a un qui est égal à l’utilisateur dans la SESSION alors on appelle **getEventsByCategorieAndUser** de **Events.php** avec la catégorie dans le GET ainsi que les deux dates.
    On appelle **getMoyenParCategorie** de **Events.php** avec la catégorie dans le GET ainsi que les deux dates et on récupère le résultat. 
        Si parmi les résultats de **getEventsByMoyen** s’il y en a un qui est égal à l’utilisateur dans la SESSION alors on appelle **getEventsByCategorieAndUser** de **Events.php** avec l’utilisateur dans la SESSION ainsi que les deux dates.
    On parcourt tous les éléments de la requête de **getEventsByMoyen** et si un des résultats est égal au moyen dans la session alors.   
        On appelle **getEventsByMoyen** de **Events.php** avec le moyen dans la SESSION ainsi que les deux dates et on récupère le résultat.
        S’il y a un utilisateur dans le GET alors :

            Si l’utilisateur dans le GET n’est pas null alors :   
                On appelle **getEventsByMoyenAndUser** de **Events.php** avec le moyen dans la SESSION ainsi que les deux dates et on récupère le résultat et on met le nom d’utilisateur dans la SESSION l’utilisateur.
            
            Sinon :
				On met l’utilisateur dans la SESSION a null.    

        Sinon :
            On appelle **getUtiEventsByMoyen** avec le moyen dans la SESSION ainsi que les deux dates et on parcourt tous les résultats de la requête et Si l’utilisateur d’un des résultats est égal au nom d’utilisateur dans la SESSION alors :
                On appelle **getEventsByMoyenAndUser** avec le moyen dans la SESSION et de l’utilisateur ainsi que les deux dates.

Sinon s’il y a un moyen dans le GET et il est différent de null alors :
    On met le moyen dans le GET dans la SESSION et on appelle getEventsByMoyen de **Events.php** avec le moyen dans le GET ainsi que les deux dates.
    S’il y a un utilisateur dans le GET alors : 

        Si l’utilisateur dans le GET n’est pas null alors :
            On appelle **getEventsByMoyenAndUser** de **Events.php** avec le moyen dans le GET ainsi que les deux dates et on récupère le résultat et on met le nom d’utilisateur dans la SESSION.
                Sinon :	
                    On met l’utilisateur dans la SESSION a null.

            Sinon :
                On appelle getUtiEventsByMoyen avec le moyen dans le GET ainsi que les deux dates et on parcourt tous les résultats de la requête et si l’utilisateur d’un des résultats est égal au nom d’utilisateur dans la SESSION alors :
                    On appelle getEventsByMoyenAndUser avec le moyen dans le GET et nom d’utilisateur dans la SESSION ainsi que les deux dates.

Sinon on appelle getUtiEventsByCategorie de **Events.php** avec la catégorie dans la SESSION et les deux dates et on parcourt tous les résultats de la requête et si l’utilisateur d’un des résultats est égal au nom d’utilisateur dans la SESSION alors :
    On appelle getEventsByCategorieAndUser de **Events.php** avec la catégorie dans la SESSION et du nom d’utilisateur ainsi que les deux dates.

S’il n’y a pas de résultat dans la requête alors on affiche un message pour dire qu’il n’y a pas de réservation.

Sinon On affiche la requête dans un tableau.
Le lien ‘consulter’ va permettre d’aller sur la page ‘Réservation’.

Get Utilisateur
===============

Ce fichier permet de changer la liste déroulant des utilisateurs en fonction des réservations du tableau.
Ce fichier est utilisé dans la page ‘Tableau des réservation’ grâce au Javascript.

Ce fichier import *Events.php* qui va permettre d’envoyer les requêtes. 
On récupère les GET de la date de début et de fin (sachant que par défaut date de début et la date du jour et la date de fin 1er janvier 3000).

Si la catégorie dans le GET existe alors : 
	On le récupère et on le met dans la SESSION. 

    On appelle **getUtiEventsByCategorie** de *Events.php* avec la catégorie dans le GET.
        On appelle *getMoyenParCategorie* de *Events.php* avec la catégorie dans le GET et on parcourt on parcourt tous les résultats de la requête et si le moyen d’un des résultats est égal au moyen dans la SESSION alors :
        On appelle *getUtiEventsByMoyen* de *Events.php* avec le moyen dans la SESSION.

    Sinon :
        On prend le GET du moyen et on le met dans la SESSION.
            S’il n’est pas null alors : 
                On appelle **getUtiEventsByMoyen** de *Events.php* avec le GET du moyen.
            Sinon :
                On appelle **getUtiEventsByMoyen** de *Events.php* avec la catégorie dans la SESSION.

Via les résultats de la requête gardée on met tous dans le menu déroulent de l’utilisateur. 
Si l’utilisateur dans la SESSION est égal à un des résultats de la requête alors on le sélectionne dans le menu.

Mes Reservations
================

Ce fichier permet d’afficher les réservations de l’utilisateur qu’il soit encadrant, responsable du moyen réservé ou l’utilisateur qui réserve.
Ce fichier est utilisé dans la page ‘Mes réservations’.

Ce fichier import *Events.php* qui va permettre d’envoyer les requêtes et lang-fr ou lang-en en fonction de la langue sélectionner qui va permettre de changer la langue grâce aux variables TXT.

On initialise la date de début avec la date courante et la date de fin avec 3000-01-01.
On récupère le nom de l’utilisateur connecté.
On appelle **getEventsByName** de *Events.php* avec le nom de l’utilisateur connecté, la date de début et la date de fin. 

Le formulaire est constitué de deux inputs de type date pour filtrer les réservations selon la date de début et de fin.

Si le résultat de la requête **getEventsByName** est null alors on affiche un message. 
Sinon on affiche les résultats dans un tableau.
Le lien ‘consulter’ permet d’accéder à la page réservations.

Modifier Reservation
====================

.. important::

    le $POST[axe_recherche] a été remplacer par les groupes suite à des améliorations du code


Ce fichier est le formulaire de modification d’une réservation ainsi que sa modification dans la bdd et la vérification des exceptions.
Ce fichier est utilisé dans la page ‘Modifier une réservation’.

Ce fichier import *NouvelleReservation.php* qui va permettre d’envoyer les requêtes et lang-fr ou lang-en en fonction de la langue sélectionner qui va permettre de changer la langue grâce aux variables TXT.

S’il n’y a pas d’id dans le GET alors on redirige l’utilisateur dans la page calendrier des réservations.
On appelle **GetEventById** de *NouvelleReservation.php* avec l’id dans le GET pour récupérer la réservation à modifier. 
On appelle **separeDateEtHeure** de *NouvelleReservation.php* avec la date de la réservation pour séparer les heures avec les dates.

L’utilisateur via le formulaire va écrire toutes les informations qu’il veut mettre sauf nom d’utilisateur qui est récupéré via le nom de l’utilisateur courant et encadrant s’il n’est pas doctorant.

Pour chaque rubrique du formulaire on affiche le résultat de la requête **GetEventById** s’il contient des choses sinon on n’affiche rien.
Moyen, raison et encadrant sont des menus déroulants pour aider l’utilisateur à choisir parmi les choix disponibles.

Le menu déroulant Moyen appelle **afficherLesCategorie** et **getMoyenParCategorie** de *NouvelleReservation.php* pour pouvoir faire le menu déroulant et affiche tous les moyens et les catégories possible.

Le menu déroulant Encadrant appelle **afficehrLesEncadrant** de *NouvelleReservation.php* pour afficher tous les encadrants possibles.

Pour vérifier les exceptions le fichier appelle **chevauchementMemeMoyenIdDifferent** , **chevauchement2jours** , **chevauchement2heures** de *NouvelleReservation.php* si une des 4 retournes true alors il y a une erreur et un message s’affiche en fonction de l’erreur.
S’il n’y a pas d’erreur dans les informations que l’utilisateur à mis alors on envoie le mail au responsable via **envoieMailModif** de *NouvelleReservation.php* et on crée la réservation via **modifierReservation** de *NouvelleReservation.php* et on envoie un message de succès.


Supprimer Reservation
=====================

Ce fichier permet de supprimer une réservation
Ce fichier est utilisé dans la page ‘Supprimer une réservation’.

Ce fichier import *Events.php* qui va permettre d’envoyer les requêtes et lang-fr ou lang-en en fonction de la langue sélectionner qui va permettre de changer la langue grâce aux variables TXT.
S’il n’y a pas d’id dans le GET alors on redirige l’utilisateur dans la page ‘Calendrier des réservations’.

On appelle **deleteEventById** de *Events.php* avec l’id dans le GET et on le renvoie dans la page ‘Calendrier des réservations’.


Tableau des Reservations
========================

Ce fichier permet d’afficher les réservations sous forme de tableau, il permet aussi de filtrer les réservations avec la catégorie, le moyen, les dates, ou l’utilisateur.
Ce fichier est utilisé dans la page ‘Tableau des réservations’.

Ce fichier import *Events.php* qui va permettre d’envoyer les requêtes et lang-fr ou lang-en en fonction de la langue sélectionner qui va permettre de changer la langue grâce aux variables TXT.
On initialise la date de début avec la date courante et la date de fin avec 3000-01-01.

Si la SESSION contient une catégorie alors on la récupère sinon on prend la première catégorie de la liste (simulateur numérique).
On appelle **getEventsByCategorie** de *Events.php* avec la catégorie et les deux dates.
On appelle **getUtiEventsByCategorie** de *Events.php* avec la catégorie et les deux dates.

Si parmi les résultats de **getUtiEventsByCategorie** s’il y en a un qui est égal à l’utilisateur dans la SESSION alors on appelle **getEventsByCategorieAndUser** de *Events.php* avec la catégorie dans la SESSION ainsi que les deux dates.
On appelle getMoyenParCategorie de *Events.php* avec la catégorie récupérée

Si parmi les résultats de **getMoyenParCategorie** s’il y en a un qui est égal au moyen dans la SESSION alors on appelle **getEventsByMoyen** de *Events.php* avec l’utilisateur dans la SESSION ainsi que les deux dates et on appelle **getUtiEventsByMoyen** avec le moyen dans la SESSION ainsi que les deux dates.
    
    On parcourt tous les résultats de la requête **getUtiEventsByMoyen** et si l’utilisateur d’un des résultats est égal au nom d’utilisateur dans la SESSION alors on appelle **getEventsByMoyenAndUser** de *Events.php* avec le moyen dans la session. 

Le premier formulaire est constitué de deux menus déroulants l’un les catégories affichées via **afficherLesCatégorie** de *Events.php* et le moyen via **getMoyenParCategorie** de *Events.php* avec la catégorie récupèrer.

Le deuxième formulaire est constitué de deux inputs de type date pour filtrer les réservations selon la date de début et de fin.

Le troisième formulaire est constitué de 1 menu déroulant pour les utilisateurs avec une des requêtes **getUti** conservée. 

On récupère tous les résultats de la requête dans le menu déroulant et s’il est égal à l’utilisateur dans la SESSION alors on l’affiche.

Si le résultat de la requête **getEvents** sélectionnée est null alors on affiche un message. 
Sinon on affiche les résultats dans un tableau.
Le lien ‘consulter’ permet d’accéder à la page réservations.


Voir Reservation
================

Ce fichier permet d’afficher une réservation.
Ce fichier est utilisé dans la page ‘Réservation’.

Ce fichier import *Events.php* qui va permettre d’envoyer les requêtes et lang-fr ou lang-en en fonction de la langue sélectionner qui va permettre de changer la langue grâce aux variables TXT.
S’il n’y a pas d’id dans le GET alors on redirige l’utilisateur dans la page ‘Calendrier des réservations’.

On appelle **GetEventById** de *Events.php* avec l’id dans le GET pour récupérer la réservation à afficher.

On affiche la réservation.

On appelle **getResponsable** de *Events.php* avec le moyen de la réservation.

On récupère le nom de l’utilisateur courant.
Si l’utilisateur courant et l’utilisateur qui a réservé, l’encadrant ou un des responsables de la réservation alors on affiche les boutons modifier et supprimer qui renvoient à modifier une réservation et supprimer une réservation.