<?php

/**
 * Améliorations à apporter :
 * Ajouter un commentaire sur l'utilité de la page
 * Ajouter des commentaires sur le code
 */


if (!is_user_logged_in()) {
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . get_home_url() . '"';
    $string .= '</script>';
    echo $string;
}
