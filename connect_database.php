
<?php
	header('Content-Type: text/html; charset=utf-8');
	$db_server["host"] = "localhost"; //database server
	$db_server["username"] = "root"; // DB username
	$db_server["password"] = ""; // DB password
	$db_server["database"] = "db_15";// database name



	$mysql_con = mysqli_connect($db_server["host"], $db_server["username"], $db_server["password"], $db_server["database"]);
	$mysql_con->query ('SET CHARACTER SET utf8');
	$mysql_con->query ('SET COLLATION_CONNECTION=utf8_general_ci');

	if (!$mysql_con) 
		die("Connection failed: " . mysqli_connect_error());
?>