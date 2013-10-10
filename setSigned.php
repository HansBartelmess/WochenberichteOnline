<?php
require_once('functions.php');
$heute = date("d.m.y");	
$report = $_POST['report'];	
$sql = "INSERT INTO reportid_signed(reportid, signAusbilder, signDate) VALUES ($report, 1, '$heute');";

sql($sql);
?>
