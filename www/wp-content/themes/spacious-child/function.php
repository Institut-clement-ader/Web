<?php
/**
** activation theme
**/

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}


add_action( 'wp', 'redirect_non_logged_users_to_specific_page' );
function redirect_non_logged_users_to_specific_page() {
  if ( !is_user_logged_in()) {
    auth_redirect();
  }
}

// ------- Désactive le filtre contre les balises "scripts"
function add_scriptfilter( $string ) {
  if (is_page('stats-publications') or is_page('stats-theses')) {
    global $allowedtags;
    $allowedtags['script'] = array( 'src' => array () );
    return $string;
  }
}
add_filter( 'pre_kses', 'add_scriptfilter' );

/*add_filter('wp_mail_from', 'new_mail_from');
add_filter('wp_mail_from_name', 'new_mail_from_name');

function new_mail_from() { return 'ica@institut-clement-ader.org'; }
function new_mail_from_name() { return 'ICA'; }
*/