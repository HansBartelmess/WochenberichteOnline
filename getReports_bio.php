<?php
   session_start();
	include('functions.php');
	
	header('Content-type: text/json');
	header('Content-type: application/json');
	
	
		$sql = "SELECT * FROM bio_report WHERE nachweis='".$_GET['nachweis']."' && uid='".$_SESSION['id']."' ";
		$res = sql($sql);
		
		while($rw=mysql_fetch_array($res)){
			if($_GET['iid'] == 1) {
				echo $rw['data'];
			}
			else if($_GET['iid'] == 2) {
				$ARR['dept'][] = $rw['dept'];
				$ARR['date'][] = $rw['date'];
				$ARR['bis'][] = getEndDateByStart($rw['date']);
				$ARR['nachweis'][] = $rw['nachweis'];
				$ARR['updated'][] = $rw['updated'];
				
				echo json_encode($ARR);
			}
	}
	
	
	
?>
