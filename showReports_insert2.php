<?php
require_once('functions.php');
	
	
$sql = "UPDATE reports SET noteCompany = '".$_POST['noteCompany']."', ";
$sql .= "noteTraining = '".$_POST['noteTraining']."', noteSchool = '".$_POST['noteSchool']."' WHERE id = '".$_POST['reportid']."' ";
 
sql($sql);
	
?>
