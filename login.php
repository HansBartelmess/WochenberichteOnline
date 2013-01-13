<?php // Beinhaltet Login und Weiterleitung zur Einstiegsseite
require_once('include.php');

$smarty = new Smarty;

if (!CheckLogin()) {
   if (isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['password'])) {
      $username = strtolower($_POST['username']);
      $password = $_POST['password'];

      $user = R::findOne('user', 'LOWER(username) = ?', array($username));
      if (isset($user) && $user->password == md5($password)) {
         $_SESSION['username'] = $user->username;
         $smarty->assign('login', true);
      }
      else {
         $smarty->assign('error', 'Benutzername oder Passwort falsch');
      } 
   }
}
else {
   $smarty->assign('login', true);
}

// anzeige und cleanup
$smarty->display('templates/login.tpl');
R::close();

?>

