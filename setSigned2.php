<?php
require_once('functions.php');
$heute = date("d.m.y");	
$report = $_POST['report'];	
$sql = "UPDATE reportid_signed SET reportid = $report, signBetreuer=1, signDate = $heute WHERE reportid = $report;";

sql($sql);
?>
