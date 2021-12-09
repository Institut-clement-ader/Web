<?php

// ---------- FORMULAIRE DE CONNEXION ----------
// fichier : reservation/session/session_php.inc
// fonction : "printLoginForm()"
// ---------------------------------------------


// $Id: week.php 2784 2013-11-21 10:48:22Z cimorrison $

// mrbs/week.php - Week-at-a-time view

require "defaultincludes.inc";
require_once "mincals.inc";
require_once "functions_table.inc";

// Get non-standard form variables
$timetohighlight = get_form_var('timetohighlight', 'int');
$ajax = get_form_var('ajax', 'int');

$inner_html = week_table_innerhtml($day, $month, $year, $room, $area, $timetohighlight);

if ($ajax)
{
  if (checkAuthorised(TRUE))
  {
    echo $inner_html;
  }
  exit;
}

// Check the user is authorised for this page
checkAuthorised();

// print the page header
print_header($day, $month, $year, $area, isset($room) ? $room : "");

// Message d'avertissement pour l'utilisateur
echo "<div id=\"dwm_avertissement\" class=\"screenonly\">\n";
//echo "<h3> IMPORTANT : </h3>\n";
echo "<h3> Avant de réserver un créneau, veuillez vous assurer auprès du/des responsable(s) d'équipement de la faisabilité de vos essais </h3>\n";
echo "</div>\n";


// Section with areas, rooms, minicals.
echo "<div id=\"dwm_header\" class=\"screenonly\">\n";

// Show all available areas
echo make_area_select_html('week.php', $area, $year, $month, $day);   
// Show all available rooms in the current area:
echo make_room_select_html('week.php', $area, $room, $year, $month, $day);

// Draw the three month calendars
if (!$display_calendar_bottom)
{
  minicals($year, $month, $day, $area, $room, 'week');
}


echo "</div>\n";

// Show area and room:
// Get the area and room names
$this_area_name = sql_query1("SELECT area_name FROM $tbl_area WHERE id=$area AND disabled=0 LIMIT 1");
$this_room_name = sql_query1("SELECT room_name FROM $tbl_room WHERE id=$room AND disabled=0 LIMIT 1");
// Respo1
$this_room_admin1 = sql_query1("SELECT respo1 FROM $tbl_room WHERE id=$room AND disabled=0 LIMIT 1");
//mysql_real_escape_string($this_room_admin1);
// Respo2
$this_room_admin2 = sql_query1("SELECT respo2 FROM $tbl_room WHERE id=$room AND disabled=0 LIMIT 1");
// Respo3
$this_room_admin3 = sql_query1("SELECT respo3 FROM $tbl_room WHERE id=$room AND disabled=0 LIMIT 1");

// Recherche dans la database 'personnel'
$conne = mysql_connect($auth['db_ext']['db_host'],
                      $auth['db_ext']['db_username'],
                      $auth['db_ext']['db_password']);

mysql_select_db($auth['db_ext']['db_name'], $conne);

$critt1 = 0;
$critt2 = 0;
$critt3 = 0;

$result = mysql_query("SELECT * FROM personnel WHERE id='$this_room_admin1' LIMIT 1;",$conne);
$this_room_admin1_info= mysql_fetch_array($result);

if (!$this_room_admin1_info)
{
  $result = mysql_query("SELECT * FROM mrbs_exterieur WHERE id='$this_room_admin1' LIMIT 1;",$conne);
  $this_room_admin1_info= mysql_fetch_array($result);
  $critt1 = 1;
  if (!$this_room_admin1_info) {$critt1 = 0;}
}


$result = mysql_query("SELECT * FROM personnel WHERE id='$this_room_admin2' LIMIT 1;",$conne);
$this_room_admin2_info= mysql_fetch_array($result);

if (!$this_room_admin2_info)
{
  $result = mysql_query("SELECT * FROM mrbs_exterieur WHERE id='$this_room_admin2' LIMIT 1;",$conne);
  $this_room_admin2_info= mysql_fetch_array($result);
  $critt2 = 1;
  if (!$this_room_admin2_info) {$critt2 = 0;}
}

$result = mysql_query("SELECT * FROM personnel WHERE id='$this_room_admin3' LIMIT 1;",$conne);
$this_room_admin3_info= mysql_fetch_array($result);

if (!$this_room_admin3_info)
{
  $result = mysql_query("SELECT * FROM mrbs_exterieur WHERE id='$this_room_admin3' LIMIT 1;",$conne);
  $this_room_admin3_info= mysql_fetch_array($result);
  $critt3 = 1;
  if (!$this_room_admin3_info) {$critt3 = 0;}
}

mysql_close($conne);

// The room is invalid if it doesn't exist, or else it has been disabled, either explicitly
// or implicitly because the area has been disabled
if ($this_area_name === -1)
{
  $this_area_name = '';
}
if ($this_room_name === -1)
{
  $this_room_name = '';
}

// On affiche le nom des respos avec un lien quand le respo est de l'ICA

if ($this_room_admin1 === -1)
{
  $this_room_admin1 = '';
}
if ($this_room_admin2 === -1)
{
  $this_room_admin2 = '';
}
if ($this_room_admin3 === -1)
{
  $this_room_admin3 = '';
}
if (!$this_room_admin1_info)
{
  if ($this_room_admin1 != '')
  {
    $str_respo1 = " <b>" . htmlspecialchars("$this_room_admin1") . "</b>";
  }
}
else
{
   if($critt1 === 1)
   {
   $str_respo1 = " <a href=\"mailto:". htmlspecialchars("$this_room_admin1_info[3]") ."\">";
   }
   else
   {
   $str_respo1 = " <a href=\"https://ica.cnrs.fr/author/". htmlspecialchars("$this_room_admin1") ."\">";
   }
   $str_respo1 = $str_respo1 . "$this_room_admin1_info[2] $this_room_admin1_info[1] </a>";
}

if (!$this_room_admin2_info)
{
  if ($this_room_admin2 != '')
  {
    $str_respo2 = "- <b>" . htmlspecialchars("$this_room_admin2") . "</b>";
  }
}
else
{
   if($critt2 === 1)
   {
   $str_respo2 = " - <a href=\"mailto:". htmlspecialchars("$this_room_admin2_info[3]") ."\">";
   }
   else
   {
   $str_respo2 = " - <a href=\"https://ica.cnrs.fr/author/". htmlspecialchars("$this_room_admin2") ."\">";
   }
   $str_respo2 = $str_respo2 . "$this_room_admin2_info[2] $this_room_admin2_info[1] </a>";
}

if (!$this_room_admin3_info)
{
  if ($this_room_admin3 != '')
  {
    $str_respo3 = " - <b>" . htmlspecialchars("$this_room_admin3") . "</b>";
  }
}
else
{
   if($critt3 === 1)
   {
   $str_respo3 = " - <a href=\"mailto:". htmlspecialchars("$this_room_admin3_info[3]") ."\">";
   }
   else
   {
   $str_respo3 = " - <a href=\"https://ica.cnrs.fr/author/". htmlspecialchars("$this_room_admin3") ."\">";
   }
   $str_respo3 = $str_respo3 . "$this_room_admin3_info[2] $this_room_admin3_info[1] </a>";
}
  
  
$str_respo = "<h3> Responsable(s) :" ;
$str_respo = $str_respo . $str_respo1;
$str_respo = $str_respo . $str_respo2;
$str_respo = $str_respo . $str_respo3;
$str_respo = $str_respo . "</h3>\n";

echo "<div id=\"dwm\">\n";
echo "<h2>" . htmlspecialchars("$this_area_name - $this_room_name") . "</h2>\n";
echo $str_respo;
//echo "<h3> Responsable(s) : <a href=\"https://ica.cnrs.fr/author/". htmlspecialchars("$this_room_admin1") ."\">".htmlspecialchars("$this_room_admin1_prenom")."</a> </h3>\n";
echo "</div>\n";



//y? are year, month and day of the previous week.
//t? are year, month and day of the next week.

$i= mktime(12,0,0,$month,$day-7,$year);
$yy = date("Y",$i);
$ym = date("m",$i);
$yd = date("d",$i);

$i= mktime(12,0,0,$month,$day+7,$year);
$ty = date("Y",$i);
$tm = date("m",$i);
$td = date("d",$i);

// Show Go to week before and after links
$before_after_links_html = "
<div class=\"screenonly\">
  <div class=\"date_nav\">
    <div class=\"date_before\">
      <a href=\"week.php?year=$yy&amp;month=$ym&amp;day=$yd&amp;area=$area&amp;room=$room\">
          &lt;&lt;&nbsp;".get_vocab("weekbefore")."
      </a>
    </div>
    <div class=\"date_now\">
      <a href=\"week.php?area=$area&amp;room=$room\">
          ".get_vocab("gotothisweek")."
      </a>
    </div>
    <div class=\"date_after\">
      <a href=\"week.php?year=$ty&amp;month=$tm&amp;day=$td&amp;area=$area&amp;room=$room\">
          ".get_vocab("weekafter")."&nbsp;&gt;&gt;
      </a>
    </div>
  </div>
</div>
";

print $before_after_links_html;

echo "<table class=\"dwm_main\" id=\"week_main\" data-resolution=\"$resolution\">";
echo $inner_html;
echo "</table>\n";

print $before_after_links_html;

echo "<div id=\"dwm_header\" class=\"screenonly\">\n";

show_colour_key();

// Draw the three month calendars

if ($display_calendar_bottom)
{
  minicals($year, $month, $day, $area, $room, 'week');
}

echo "</div>\n";

output_trailer(); 

