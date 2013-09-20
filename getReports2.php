<?php
require_once('functions.php');
	



$sql = 'select * from reports reports,user user, WHERE user.username = '. $_POST['username'] .' && user.id = reports.user_id && user.jobid = '. $_POST['sessjobid'].' && reports.division = '. $_POST['sessdept'] .' ';
sql($sql);


print_r('$sql');

?>
