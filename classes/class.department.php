<?php

require __DIR__.'/../config.php';
// include Class_path.'class.staff.php';
class department{
	function get_dept()
	{
		$response = [];
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * from departments";
		$result = $con->query($query);
		while ($exe = $result->fetch_assoc()) {
			$response[] = $exe; 
		}
		$con->close();
		return $response;
	}
}