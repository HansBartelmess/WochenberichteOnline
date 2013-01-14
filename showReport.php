<?php // Einstiegsseite
require_once('include.php');
EnsureLogin();

$smarty = new Smarty;

CreateMenu($smarty);

   R::load($reports);


$smarty->display('templates/showReport.tpl');
R::close();

?>

