<?php

function select_fun($table, $temp){
	
	header('Content-Type: text/html; charset=utf-8');
	include ('connect_database.php');
	if ($table==3){

			$table_3 = "SELECT page_id FROM pages";
			$result = $mysql_con->query($table_3);

	        $i=0;
			if ($result->num_rows > 0) {
			
				while($row = $result->fetch_assoc()) {
				
				$array_id[$i]=$row["page_id"];
				$i=$i+1;
			}

			}else {
				
			echo "0 results";
		}

		return $array_id;


	}elseif($table==4){

			@$table_4 = "SELECT category FROM pages";
			@$result = $mysql_con->query($table_4);

	        $i=0;
			if ($result->num_rows > 0) {
				
				while($row = $result->fetch_assoc()) {
				
				$array_id[$i]=$row["category"];
				$i=$i+1;
				}

			}else {
				
			echo "0 results";
		}

		return $array_id;

	}

}

?>