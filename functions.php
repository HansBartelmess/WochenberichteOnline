<?php
	function sql($sql) {
		$dbase="berichtsheftonline";
		$host="127.0.0.1:3306";
		$user="XXX";
		$pw="XXX";

		$conn=mysql_pconnect($host,$user,$pw) or die("sql: no mysql conn ".date("Y-m-d H:i:s")." ");
		$db=mysql_select_db($dbase,$conn); 
		
		return mysql_query($sql,$conn);
	}
?>