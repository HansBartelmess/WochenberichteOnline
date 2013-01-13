<?php // Einstiegsseite
require_once('include.php');
EnsureLogin();

$smarty = new Smarty;

CreateMenu($smarty);

if(isset($_POST["submit"]) && isset($_POST['reportNumber']) && isset($_POST['division']) && isset($_POST['startDate']) && (isset($_POST['company']) || isset($_POST['training']) || isset($_POST['school'])))  {
   $user = R::findOne('user', 'username = ?', array($_SESSION['username']));

   $reports = R::dispense('reports');
   $reports->reportNumber = $_POST['reportNumber'];
   $reports->division = $_POST['division'];
   $reports->startDate = $_POST['startDate'];
   $reports->company = $_POST['company'];
   $reports->training = $_POST['training'];
   $reports->school = $_POST['school'];
   $user->ownReport[] = $reports;
   R::store($user);

   $smarty->assign('saved', true);
}


$smarty->display('templates/createReport.tpl');
R::close();

?>
