<?php
include('sql.inc');
$id=$_SERVER['REQUEST_URI'];
$id=substr($id, 1); // pour retirer le premier slash
$findme   = '/';
$pos = strpos($id, $findme);
if ($pos !== false) { //besoin de ! = = sinon 0(premier caractère) marche pas
	$id=substr($id, 0, -1); // pour retirer le dernier slash
}

$adress='Location: '.$dns.'/pageperso.php?id='.$id;
header($adress);
exit();
?>