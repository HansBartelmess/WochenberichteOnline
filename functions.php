<?php



function sql($sql) {
     require_once('config.php');

   $mysql_username = 'root';
   $mysql_password = '';
   $mysql_host     = 'localhost';
   $mysql_dbname   = 'berichtsheftonline'; 
   
   $conn=mysql_pconnect($mysql_host,$mysql_username,$mysql_password) or die("sql: no mysql conn ".date("Y-m-d H:i:s")." ");
		mysql_select_db($mysql_dbname); 
		
		return mysql_query($sql,$conn);
   }

function getEndDateByStart($startDate, $username) {
   $sql = ( 'select * from reports where user_id = "'.$username.'";' );
   $reports = sql($sql);

   $teile = explode(".", $startDate);
   $y = $teile[2];
   $m = $teile[1];
   $d = $teile[0];
   $date     = new Datetime();
   $date->setDate($y, $m, $d);
   $day2 = $date->format('d.m.Y');
   $nextDay = strtotime("+4 day", strtotime($day2));
   return date("d.m.Y", $nextDay); 
}


?>
