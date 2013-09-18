<?php
require_once('functions.php');
	
	
$sql = "UPDATE reports SET noteCompany = '".$_POST['noteCompany']."', ";
$sql .= "noteTraining = '".$_POST['noteTraining']."', reportNumber = '".$_POST['reportNumber']."', noteSchool = '".$_POST['noteSchool']."' WHERE startDate = '".$_POST['startDate']."' ";
 
sql($sql);
	
?>
