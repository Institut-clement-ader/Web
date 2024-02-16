<?php

/**
 * Améliorations à apporter :
 * Ajouter un commentaire sur l'utilité de la page
 * Ajouter des commentaires sur le code
 */

$currentlang = get_bloginfo('language');
if (strpos($currentlang, 'fr') !== false) {
    include('App/lang-fr.php');
} elseif (strpos($currentlang, 'en') !== false) {
    include('App/lang-en.php');
} else {
    echo ("échec de reconnaissance de la langue");
}


if (!is_user_logged_in()) {
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . get_home_url() . '/' . TXT_LOGIN . '"';
    $string .= '</script>';
    echo $string;
}
