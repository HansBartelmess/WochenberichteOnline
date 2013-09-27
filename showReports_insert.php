<?php
require_once('functions.php');
	
	
$sql = "UPDATE reports SET division = '".$_POST['division']."', company = '".$_POST['company']."', ";
$sql .= "training = '".$_POST['training']."', reportNumber = '".$_POST['reportNumber']."', school = '".$_POST['school']."' WHERE reportid = '".$_POST['reportid']."' ";
 
sql($sql);
	
?>
