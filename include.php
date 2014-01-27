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

function sql($sql) {
     require_once('config.php');

   $mysql_username = 'root';
   $mysql_password = 'Lin87ux';
   $mysql_host     = 'localhost';
   $mysql_dbname   = 'berichtsheftonline'; 
   
   $conn=mysql_pconnect($mysql_host,$mysql_username,$mysql_password) or die("sql: no mysql conn ".date("Y-m-d H:i:s")." ");
		mysql_select_db($mysql_dbname); 
		
		return mysql_query($sql,$conn);
   }

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

function CreateMenu ($smarty) {
   if ($_SESSION['role'] == '1') {
      $smarty->assign('navigation', array(
         array('url' => 'createReport.php', 'active' => false,  'name' => 'Nachweis eintragen'),
         array('url' => 'showReports.php',   'active' => false, 'name' => 'Nachweis ansehen'),
         array('url' => 'preferences.php',   'active' => false, 'name' => 'Einstellungen'),
         array('url' => 'logout.php',        'active' => false, 'name' => 'Abmelden')
   ));
}
if ($_SESSION['role'] == '2' || $_SESSION['role'] == '3') {
      $smarty->assign('navigation', array(
         array('url' => 'showReports.php',   'active' => false, 'name' => 'Nachweis ansehen'),
         array('url' => 'preferences.php',   'active' => false, 'name' => 'Einstellungen'),
         array('url' => 'logout.php',        'active' => false, 'name' => 'Abmelden')
   ));
   }
}

function isBetreuer() {
   

}



R::setup('mysql:host=' . $mysql_host . ';dbname=' . $mysql_dbname , $mysql_username, $mysql_password);

if (!session_start()) {
   throw new Exception("Fehler beim erzeugen der Session");
}

?>
