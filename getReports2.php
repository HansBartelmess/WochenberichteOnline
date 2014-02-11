<?php
require_once('functions.php');

$sql = "select reports.id, reports.reportNumber, reports.division, reports.startDate, reports.company, reports.training, reports.school, reports.user_id, reports.noteCompany, reports.noteTraining, reports.noteSchool from reports reports,user user WHERE user.username = '".$_POST['username']."' && user.id = reports.user_id && user.jobid = ".$_POST['sessjobid']." && reports.division = '".$_POST['sessdept']."';";

$ergebnis = sql($sql);

$reports =array();
while($row = mysql_fetch_array($ergebnis)) {
   $reports[$row['id']][0] = $row['id'];
   $reports[$row['id']][1] = $row['reportNumber'];
   $reports[$row['id']][2] = $row['division'];
   $reports[$row['id']][3] = $row['startDate'];
   $reports[$row['id']][4] = getEndDateByStart($row['startDate'], $_POST['username']);
   $reports[$row['id']][5] = $row['company'];
   $reports[$row['id']][6] = $row['training'];
   $reports[$row['id']][7] = $row['school'];
   $reports[$row['id']][8] = $row['noteCompany'];
   $reports[$row['id']][9] = $row['noteTraining'];
   $reports[$row['id']][10] = $row['noteSchool'];


}
//print_r($reports);
echo json_encode($reports);
?>


