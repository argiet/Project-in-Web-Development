<?php

function insert_fun($table,$i,$a,$n,$p,$c,$f,$g,$k,$d,$x,$l)
{
	header('Content-Type: text/html; charset=utf-8');
	include ('connect_database.php');

	if ($table==3){

		$k = mysqli_real_escape_string($mysql_con, $k);
		$p = mysqli_real_escape_string($mysql_con, $p);
		$a = mysqli_real_escape_string($mysql_con, $a);
		$n = mysqli_real_escape_string($mysql_con, $n);
		$c = mysqli_real_escape_string($mysql_con, $c);
		$f = mysqli_real_escape_string($mysql_con, $f);
		$g = mysqli_real_escape_string($mysql_con, $g);

		$table_3="INSERT IGNORE INTO events (id, name,day,time,photo,organizer,category,description,latitude,longitude,page) 
			VALUES ($i, '$a',' $n','$p','$c','$f','$g','$k', '$d', '$x', $l)";

			$result = $mysql_con->query($table_3);

			if (!$result)
				die('Invalid query: ' . $mysql_con->error);

			$mysql_con->close();

	}elseif($table==4)

	{

			$p = mysqli_real_escape_string($mysql_con, $p);
			$a = mysqli_real_escape_string($mysql_con, $a);
			$n = mysqli_real_escape_string($mysql_con, $n);
			$c = mysqli_real_escape_string($mysql_con, $c);

			$table_4="INSERT IGNORE INTO pages (page_id,name,photo,address,category) 
			VALUES ($i, '$a', '$n','$p','$c')"; 

			$result = $mysql_con->query($table_4);

			if (!$result)
				die('Invalid query: ' . $mysql_con->error);

			$mysql_con->close();
	}
}

?>