<?php // Einstellungen
require_once('include.php');
EnsureLogin();

$smarty = new Smarty;
CreateMenu($smarty);

$user_id=$_SESSION['id'];
$activeReport = 0;
$smarty->assign('activeReport', "1");


$azubi = R::getALL( 'select * from user' );
$smarty->assign('azubi', $azubi);

$smarty->assign('activeReport', $activeReport);
$reports = R::getAll( 'select * from reports where user_id = 1' );
$smarty->assign('reports', $reports);

$userstats = R::getAll( 'select * from user where id = '.$user_id );
$smarty->assign('userstats', $userstats);


$smarty->display('templates/preferences.tpl');
R::close();


?>
