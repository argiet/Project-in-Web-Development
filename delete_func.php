<?php

function delete_fun($table,$i){
	
	header('Content-Type: text/html; charset=utf-8');
	include ('connect_database.php');
	include('header2.php');

	if ($table==1){

			$table_1 = "DELETE FROM pages  WHERE page_id=$i ";

			if ($mysql_con->query($table_1) === TRUE) {
				echo "<h2>Page deleted successfully</h2>";
			} else {
				echo "Error deleting record: " . $mysql_con->error;
			}
	}elseif ($table==2){

			$table_2 = "DELETE FROM events WHERE page=$i ";
			if ($mysql_con->query($table_2) === TRUE) {
				echo "<h2>Events deleted successfully</h2><br>";
			} else {
				echo "Error deleting record: " . $mysql_con->error;
			}
	}

}

?>