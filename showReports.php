<?php // Einstiegsseite
require_once('include.php');
EnsureLogin();

$smarty = new Smarty;

CreateMenu($smarty);

$activeReport = 0;

if(isset($_POST["submit"]) && isset($_POST['activeReport'])) {
   //$activereport = R::getrow( 'select reportNumber from reports where user_id = 1 && reportNumber = $_POST["activeReport"];');
   $activeReport = $_POST['activeReport'];
   $activeReport = $activeReport - 1;
   
}
else
{
$user_id=1;

//   $reports = R::load('reports', $user_id);


$smarty->assign('activeReport', "1");
}
$azubi = R::getALL( 'select * from user' );
$smarty->assign('azubi', $azubi);

$smarty->assign('activeReport', $activeReport);
$reports = R::getAll( 'select * from reports where user_id = 1' );
$smarty->assign('reports', $reports);
$smarty->display('templates/showReport.tpl');
R::close();


?>

