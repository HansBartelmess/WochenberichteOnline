<?php

	session_start();
	
	include('functions.php');
	
	header('Content-type: text/json');
	header('Content-type: application/json');
	
	$ARR = array();
	$ARR['mon']['work'] = explode(",",$_POST['monwork']);
	$ARR['mon']['time'] =  explode(",",$_POST['montime']);
	
	$ARR['die']['work'] = explode(",",$_POST['diework']);
	$ARR['die']['time'] =  explode(",",$_POST['dietime']);
	
	$ARR['mit']['work'] = explode(",",$_POST['mitwork']);
	$ARR['mit']['time'] =  explode(",",$_POST['mittime']);
	
	$ARR['don']['work'] = explode(",",$_POST['donwork']);
	$ARR['don']['time'] =  explode(",",$_POST['dontime']);
	
	$ARR['frei']['work'] = explode(",",$_POST['freiwork']);
	$ARR['frei']['time'] =  explode(",",$_POST['freitime']);
	
	
	$sql = "SELECT * FROM bio_report WHERE uid='".$_SESSION['id']."' AND nachweis='".$_POST['reportNumber']."' ";
	$res = sql($sql);
	if(mysql_num_rows($res)>0) {
		die(json_encode(array('action'=>'fail','msg'=>'Nachweis schon vorhanden')));
	}
	$sql = "SELECT * FROM bio_report WHERE uid='".$_SESSION['id']."' AND date='".$_POST['startDate']."' ";
	$res = sql($sql);
	if(mysql_num_rows($res)>0) {
		die(json_encode(array('action'=>'fail','msg'=>'Datum schon vorhanden')));
	}
	
	
	
	
	$sql = "INSERT INTO bio_report SET username='".$_SESSION['username']."', uid='".$_SESSION['id']."', nachweis='".$_POST['reportNumber']."', ";
	$sql .= "betreuer='".$_POST['betreuer']."', role='".$_SESSION['role']."', jobid='".$_SESSION['jobid']."', dept='".$_POST['division']."', ";
	$sql .= "date='".$_POST['startDate']."', updated='now', data='".mysql_real_escape_string(trim(json_encode($ARR)))."' ";
		
	if (mysql_query($sql)){
		die(json_encode(array('action'=>'success','msg'=>'Erfolgreich eingefügt')));
	}
	else{
		die(json_encode(array('action'=>'fail','msg'=>'Fehler beim eingefügen')));
	} 

	
?>


