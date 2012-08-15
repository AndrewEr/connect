<?php
/**
* Checks the connection to the local install of MySQL
*/
	require_once('db.php');
	echo 'Connecting mySQL...';
	
	if (!$dbconn = mysql_connect(DB_HOST, DB_USER, DB_PW)) 
	{
		echo '<font color="red">Could not connect to mysql on ' . DB_HOST . "\n";
		exit; 
	}
	echo '<font color="green">Done </font><br>';
	echo 'Connecting Database...';
	
	if (!mysql_select_db(DB_NAME, $dbconn)) 
	{
		echo '<font color="red">Could not use database ' . DB_NAME . "\n";
		echo mysql_error() . "\n";
		exit;
	}
	
	echo '<font color="green">Done</font>';
?>