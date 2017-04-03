<?php
  // Define database connection constants
	
	$dbhost = 'mysql.cs.orst.edu';
	$dbname = 'cs340_yeja';
	$dbuser = 'cs340_yeja';
	$dbpass = '5271';

	$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
		or die("Error connecting to database server");

	mysql_select_db($dbname, $mysql_handle)
		or die("Error selecting database: $dbname");

	echo 'Successfully connected to database!';

	mysql_close($mysql_handle);

?>
