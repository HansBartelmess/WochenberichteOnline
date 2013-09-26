<?php
require_once('functions.php');

$sql = "select * from reports reports,user user WHERE user.username = '".$_POST['username']."' && user.id = reports.user_id && user.jobid = ".$_POST['sessjobid']." && reports.division = '".$_POST['sessdept']."';";

$ergebnis = sql($sql);

$reports =array();
while($row = mysql_fetch_array($ergebnis)) { 
   $reports[$row['reportid']][1] = $row['reportNumber'];
   $reports[$row['reportid']][2] = $row['division'];
   $reports[$row['reportid']][3] = $row['startDate'];
   $reports[$row['reportid']][4] = $row['company'];
   $reports[$row['reportid']][5] = $row['training'];
   $reports[$row['reportid']][6] = $row['school'];
}
//print_r($reports);
echo json_encode($reports);
?>


