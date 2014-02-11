<?php // Einstiegsseite
require_once('include.php');
EnsureLogin();


$smarty = new Smarty;

CreateMenu($smarty);

$smarty->force_compile = true;
$smarty->assign('text', $_SESSION['username']);

$smarty->display('templates/start.tpl');
R::close();

?>
