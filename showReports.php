<?php // Einstiegsseite
require_once('include.php');
EnsureLogin();

$smarty = new Smarty;

CreateMenu($smarty);

if(isset($_GET['id']) && isset($_GET['reportNumber'])) {
   $activeReport = $_GET['reportNumber'];
   $activeReport = $activeReport - 1;
}
else
{
$user_id=1;

$activeReport = 0;
//   $reports = R::load('reports', $user_id);


$smarty->assign('activeReport', "1");
}




$azubi = R::getALL( 'select * from user' );
$smarty->assign('azubi', $azubi);

$smarty->assign('activeReport', $activeReport);
$reports = R::getAll( 'select * from reports where user_id = 1' );
$smarty->assign('reports', $reports);

function getEndDate($activeReport) {
$reports = R::getAll( 'select * from reports where user_id = 1' );

   $date  = $reports[$activeReport]['startDate'];;
   $teile = explode(".", $date);
   $y = $teile[2];
   $m = $teile[1];
   $d = $teile[0];
   $date     = new Datetime();
   $date->setDate($y, $m, $d);
   $day2 = $date->format('d.m.Y');
   $nextDay = strtotime("+4 day", strtotime($day2));
   echo date("d.m.Y", $nextDay); 
}

function getEndDateByStart($startDate) {
$reports = R::getAll( 'select * from reports where user_id = 1' );

   $teile = explode(".", $startDate);
   $y = $teile[2];
   $m = $teile[1];
   $d = $teile[0];
   $date     = new Datetime();
   $date->setDate($y, $m, $d);
   $day2 = $date->format('d.m.Y');
   $nextDay = strtotime("+4 day", strtotime($day2));
   echo date("d.m.Y", $nextDay); 
}




$smarty->display('templates/showReport.tpl');
R::close();


?>
