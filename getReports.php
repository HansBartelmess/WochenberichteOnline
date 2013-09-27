<?php
require_once('functions.php');

$sql = "select * from reports reports,user user WHERE user.username = '".$_POST['username']."' && user.id = reports.user_id && user.jobid = '".$_POST['sessjobid']."';";

$ergebnis = sql($sql);

$reports =array();
while($row = mysql_fetch_array($ergebnis)) {
   $reports[$row['reportid']][0] = $row['reportid'];
   $reports[$row['reportid']][1] = $row['reportNumber'];
   $reports[$row['reportid']][2] = $row['division'];
   $reports[$row['reportid']][3] = $row['startDate'];
   $reports[$row['reportid']][4] = getEndDateByStart($row['startDate'], $_POST['username']);
   $reports[$row['reportid']][5] = $row['company'];
   $reports[$row['reportid']][6] = $row['training'];
   $reports[$row['reportid']][7] = $row['school'];
   $reports[$row['reportid']][8] = $row['noteCompany'];
   $reports[$row['reportid']][9] = $row['noteTraining'];
   $reports[$row['reportid']][10] = $row['noteSchool'];


}
//print_r($reports);
echo json_encode($reports);
?>
