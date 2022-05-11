<?php

/**
   * Améliorations à apporter :
   * Ajouter un commentaire sur l'utilité de la page
   * Ajouter des commentaires sur le code
   */

$string = '<script type="text/javascript">';
$string .= 'window.location = "' . get_home_url() . '"';
$string .= '</script>';
if ( !is_user_logged_in() ) {
    echo $string;
} else {
   $rl = array();
   $id = get_current_user_id();
   $user_info = get_userdata($id);
   $user_roles = $user_info->roles;
   if (!in_array("administrator", $user_roles)) {
      echo $string;
   }
}
?>