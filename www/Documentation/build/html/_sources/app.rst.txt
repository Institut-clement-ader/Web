===
App
===

Les dossier Public et Intranet
==============================

Ces deux dossiers seront décrits dans le reste de la documentation.
La principale chose à savoir c'est que tous les fichiers présents dans le dossier App 
sont pour la plus part réutilisés dans la majorité des pages du site.

Le fichier database
===================

Ce fichier a une utilité très simple, il permet la connexion avec la base de donnée.
On peut y retrouver l'id du serveur auquel on souhaite se connecter, le nom du serveur, le pseudo de connexion
ainsi que le mot de passe pour se connecter.
Ces identifiants de connexion sont définis dans des variables réutilisables.

.. note::
    Ce fichier est utilisé dans le fichier *GestionBdd* que nous verrons ci-dessous.

Le fichier GestionBdd
=====================

Le fichier GestionBDD est divisé en deux grandes parties.

La connexion GestionBdd
-----------------------
La première n'est autre que la connexion à la base de donnée grâce à la fonction : fonction __construct()
Les variables **DB_SERVEUR**, **DB_NAME**, **DB_USERNAME** et **DB_PASSWORD** sont définis dans le fichier *database*

Les requêtes SQL
----------------
La deuxième partie contient toutes les requêtes SQL du site ICA.
La plus part de ces requêtes sont commentées pour une compréhension plus simple.
La méthode utilisée pour faire ces requêtes est très simple, elle utilise une base répétitive.

.. code-block:: PHP
    :caption: Exemple de code

        public function getTheses(<parametre>){
            $req = $this->bdd->prepare('SELECT th.id, th.date_debut, th.date_soutenance FROM wp_pods_these th, wp_podsrel rel WHERE rel.pod_id = 862 AND rel.field_id = 1380 AND rel.item_id = th.id AND rel.related_item_id = ?');
            $req->execute(array(<parametre>));
            return $req;
        }

Dans l'exemple ci-dessus on peut voir que nous préparons la requete en faisant : 
    *$req = $this->bdd->prepare* (**REQUETE**)

Enfin on execute la requete, avec le array les '?' dans la requete seront remplacés par le paramètre de notre fonction.
Si nous avons plusieurs paramètres ils seront remplacés dans l'ordre du array.
Selon l'utilisation il est intéréssant ou pas de return le resultat.

Le fichier lang-en
==================

Ce fichier permet la traduction automatique du site.
Nous allons définir un mot en anglais à une variable qui sera identique à celle du fichier lang-fr.
Cela nous permettra d'alterner entre la version anglaise contenue dans cette page et la version française
contenue dans la page *lang-fr*

Le code ci-dessous se retrouvera en tête de page pour permettre de changer de langue de la page en un clic.

.. code-block:: PHP
    :caption: Code de traduction

        if(strpos($currentlang,'fr')!==false){
            include('App/lang-fr.php');
        }elseif(strpos($currentlang,'en')!==false){
            include('App/lang-en.php');
        }else{
            echo("échec de reconnaissance de la langue");
        }   

Le fichier lang-fr
==================

Comme le fichier précedant,ce fichier permet la traduction automatique du site.
Nous allons définir un mot en français à une variable qui sera identique à celle du fichier lang-en.
Cela nous permettra d'alterner entre la version française contenue dans cette page et la version anglaise
contenue dans la page *lang-en*

Le code ci-dessous se retrouvera en tête de page pour permettre de changer de langue de la page en un clic.

.. code-block:: PHP
    :caption: Code de traduction

        if(strpos($currentlang,'fr')!==false){
            include('App/lang-fr.php');
        }elseif(strpos($currentlang,'en')!==false){
            include('App/lang-en.php');
        }else{
            echo("échec de reconnaissance de la langue");
        }   

Le fichier redirect-admin-user
==============================


Ce fichier permet simplement de rediriger un utilisateur qui n'est pas connecté vers la page de connexion.
De plus les utilisateurs n'ayant pas les permissions d'administrateur sur le site ICA d'être redirigé vers la page d'accueil.

Le fichier redirect-user
========================

Ce fichier permet simplement de rediriger un utilisateur qui n'est pas connecté vers la page de connexion.

