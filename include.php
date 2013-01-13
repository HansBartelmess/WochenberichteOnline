<?php // Hilfsfunktionen und Include-Sammlung
require_once('contrib/include.php');

// redefine this in config.php
$mysql_username = '';
$mysql_password = '';
$mysql_host     = '';
$mysql_dbname   = '';

$latexpdf_path    = '';
$output_directory = '';
require_once('config.php');



function CheckLogin () 
{
   return isset($_SESSION['username']);
}

function EnsureLogin () 
{
   if (!CheckLogin()) {
      include('login.php');
      exit();
   }
}

function CreateMenu ($smarty) 
{
   $smarty->assign('navigation', array(
      array('url' => 'createReport.php', 'active' => false,  'name' => 'Bericht eintragen'),
      array('url' => 'showReports.php',   'active' => false, 'name' => 'Berichte ansehen'),
      array('url' => 'preferences.php',   'active' => false, 'name' => 'Einstellungen'),
      array('url' => 'logout.php',        'active' => false, 'name' => 'Abmelden')
   ));
}


R::setup('mysql:host=' . $mysql_host . ';dbname=' . $mysql_dbname , $mysql_username, $mysql_password);

if (!session_start()) {
   throw new Exception("Fehler beim erzeugen der Session");
}

?>