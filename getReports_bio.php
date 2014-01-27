<?php

	include('functions.php');
	
	header('Content-type: text/json');
	header('Content-type: application/json');
	
	$sql = "SELECT * FROM bio_report WHERE nachweis='".$_GET['nachweis']."' ";
	$res = sql($sql);
	
	while($rw=mysql_fetch_array($res)){
		echo $rw['data'];
	}

?>