<?php
include_once('config.php');
	function sql($sql) {
		/*$dbase="berichtsheftonline";
		$host="127.0.0.1:3306";
		$user="root";
		$pw="";
       */
		$conn=mysql_pconnect($mysql_host,$mysql_username,$mysql_password) or die("sql: no mysql conn ".date("Y-m-d H:i:s")." ");
		$db=mysql_select_db($mysql_dname,$conn); 
		
		return mysql_query($sql,$conn);
	}
?>
