<?php // Einstiegsseite
require_once('include.php');
EnsureLogin();

session_destroy();

$smarty = new Smarty;
$smarty->display('templates/logout.tpl');
R::close();

?>

