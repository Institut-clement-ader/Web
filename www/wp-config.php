<?php

/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */
// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('WP_CACHE', true);
define('WPCACHEHOME', '/opt/data/webusers/lab0612/lab0612/ica.cnrs.fr/www/wp-content/plugins/wp-super-cache/');
define('DB_NAME', 'lab0612sql3db');
/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'lab0612sql3');
/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'XY02b21aBLaq');
/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'mysql2.lamp.ods');
/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');
/** Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define('DB_COLLATE', '');
/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '8Dm9p[=n&^U6&l7`baU|J6&&e/)msfRjgnJ1ua3B X8n)qh2h=5uj}:GYuS0gn#7');
define('SECURE_AUTH_KEY',  'G^uq/{A,@z2EblwamfnoanWA%c%UZQo1L%$xI3zVUC))fR?aphM#q[`Q11VPbwm~');
define('LOGGED_IN_KEY',    '!pgLxQn!`yMAc-Sz/7V{jvoYx37}_`C?eFkhnVcSb;03w.<.@w8oJ%3Gs$TV#JcB');
define('NONCE_KEY',        '~bQRehAAWZQoayo>m/J}rg3~mmbW1U$kZEw!4GGS{y}tTDfj~_-_O!JVi_t_:6GL');
define('AUTH_SALT',        ' MA1]^VHFc+/9(gsR8&8_V3N :C~[%T7;XG9WbJCu3lozg>FiSO[j|QZ7}zf,TM[');
define('SECURE_AUTH_SALT', 'PXld2O/fJ_S7N7a4$yTJhs)m:@&V>NXm2dF: d3EO[%kNGGa.3=FK{}o~4-[78F3');
define('LOGGED_IN_SALT',   'tCXOcXG|N;fCZQ)k,z*R1cj3#3,2IMlFIqR_WV8_<350kPXLQtB(ExyJ$QaRD2[R');
define('NONCE_SALT',       'e-w*]?v8qzV20UR5^)}F:Tk+HopXzl)zdjd;XNby[^) Xy{rYiq? 2E:ymR;#7w/');
/**#@-*/
/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';
/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
///* DEBUG
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);
define('FORCE_SSL_ADMIN', false);
define('FORCE_SSL_LOGIN', false);
@ini_set('display_errors', 0);
//*/
/* C’est tout, ne touchez pas à ce qui suit ! */
/** Chemin absolu vers le dossier de WordPress. */
if (!defined('ABSPATH'))
  define('ABSPATH', dirname(__FILE__) . '/');
/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
