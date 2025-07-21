<?php

/**
 * Template Name: excelUser
 *
 * Displays the Page Builder Template via the theme.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.4.9
 */


include(dirname(__FILE__) . '/Excel/fonctionsExcel.php');
require_once(dirname(__FILE__) . '/Excel/Classes/PHPExcel.php');

$colonne = array('ID', 'NOM', 'PRENOM', 'GROUPE', 'AXE', 'GROUPE2', 'AXE2', 'EMAIL', 'DEBUT');
$donnees = array();

$users = get_users();
foreach ($users as $user) {
    $donnees[] = array(esc_attr($user->ID), esc_attr($user->last_name), esc_attr($user->first_name), esc_attr($user->groupe_primaire), esc_attr($user->axe_primaire), esc_attr($user->groupe_secondaire), esc_attr($user->axe_secondaire), esc_attr($user->user_email), esc_attr($user->arrivee));
}
createTable($colonne, $donnees, 'liste personnel');
