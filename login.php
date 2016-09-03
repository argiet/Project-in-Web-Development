<?php
	session_start();	
	header('Content-Type: text/html; charset=utf-8');

	include('header2.php');

	include('connect_database.php');

	if(isset($_POST['user']) && isset($_POST['pass'])){
		$_SESSION['session_username'] = $_POST['user'];
		$_SESSION['session_pass'] = $_POST['pass'];

		$newusername = check($_SESSION['session_username']); //elegxos timwn me th sunarthsh check
		$newpassword = check($_SESSION['session_pass']);

		$my_query = "SELECT * FROM admin WHERE username = '$newusername' AND password = '$newpassword'";
			
		$result = $mysql_con->query($my_query);

		if (!$result)
			die('Invalid query: ' . $mysql_con->error);

		$count = mysqli_num_rows($result);
		if($count==1)
			header('location:admin.php'); //an uparxei username k password sth bash redirecting sto admin.php

		else{
			echo "<h2>Wrong Username or Password</h2>";
			//header('location:index.php'); //an username k password den einai kataxwrhmena sth bash
			echo "<a href='index2.php#admin'>Try Again</a>";
			session_unset(); //epistrofh sthn arxikh selida kai eleutherwnoume tis session metablhtes
		}

	}

	//mysqli_close($mysql_con);

	function check($data) {
   		$data = trim($data); //bgazw ta kena an yparxoun 
   		$data = stripslashes($data); //bgazw ta '\'
   		$data = htmlspecialchars($data); //metatrepw eidikous xarakthres p.x.'<' se ontothtes ths HTML
   		return $data;
   	}
?>