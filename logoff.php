<?php
  	header('Content-Type: text/html; charset=utf-8');

	session_unset();
	mysqli_close($mysql_con);
	
	header('location:index2.php');

?>
