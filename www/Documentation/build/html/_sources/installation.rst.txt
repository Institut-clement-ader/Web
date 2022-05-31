============
Installation
============

Installation de l'environnement de travail
==========================================

Pour travailler sur le site de l'institut clément ader il va falloir installer différents logiciels.
Pour commencer vous pouvez choisir un éditeur de code de votre choix, l'éditeur que nous utilisons est Visual Studio Code.

Il faudra ensuite différents logiciels que je vais vous présenter ci-dessous.

.. note::

    Il n'y a pas d'ordre pour l'installation des logiciels. L'ordre pour le lancement sera donné dans les explications.

FileZilla
---------

FileZilla Client est un client FTP, FTPS et SFTP, développé sous la licence publique générale GNU.
Avec ce logiciel vous pourrez gérer les fichiers du site ICA. Pour commencer vous pouvez télécharger FileZilla
sur le lien ici : `Télécharger FileZilla <https://filezilla-project.org/>`__
Il vous suffit de choisir **FileZilla Client** et de suivre l'installation.

Après installation lancez le logiciel et cliquez sur le bouton permettant d'ouvrir le gestionnaire de sites.

.. image:: images/ConnexionFTP.png

On va maintenant installer le serveur ICA OFF. Deux serveurs et sites sont diponibles : 
- Préprod ICA, qui vous permet de tester toutes vos modifications et d'avoir un site permettant de laisser le site ICA OFF disponible pour les utilisateurs
- Prod ICA, nommé ICA OFF sur FileZilla est le site officiel que tous les utilisateurs utilisent.

Voici l'affichage du gestionnaire de sites :

.. image:: images/GestionServeurFTP.png

Pour vous connecter vous pouvez ajouter avec le bouton **Nouveau site** voici les informations
de connexion pour les deux sites.

ICA Prod :
__________

- Protocole : SFTP
- Hôte : 195.220.198.90
- Port : 50028
- Utilisateur : lab0612
- Mot de Passe : 53vw4KZxq4HF

ICA Préprod :
_____________

- Protocole : SFTP
- Hôte : 195.220.198.90
- Port : 50025
- Utilisateur : lab0611
- Mot de Passe : R4uaGV1S2sp8

