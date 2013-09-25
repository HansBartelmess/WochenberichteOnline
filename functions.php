<?php
	function sql($sql) {
		require_once('config.php');
		
		$conn=mysql_pconnect($mysql_host,$mysql_username,$mysql_password) or die("sql: no mysql conn ".date("Y-m-d H:i:s")." ");
		mysql_select_db($mysql_dbname); 
		
		return mysql_query($sql,$conn);
	}
?>
