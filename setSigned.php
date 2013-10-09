<?php
require_once('functions.php');
$heute = date("d.m.y");	
	
$sql = "INSERT INTO 'reportid_signed'('reportid', 'signAusbilder', 'signDate') VALUES ('".$_POST['report']."','1','".$heute."');";

sql($sql);
	
?>
