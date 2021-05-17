<?php
if ( !is_user_logged_in() ) {
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . get_home_url() . '"';
    $string .= '</script>';
    echo $string;
}
?>