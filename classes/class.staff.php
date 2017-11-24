<?php

require __DIR__.'/../config.php';
// include Class_path.'class.staff.php';
class staff{
	function get_dept($staff_id)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * from staff stf inner join department dpt on dpt.dept_id = stf.dept_id where staff_id = $staff_id";
		$result = $con->query($query);
		$exe = $result->fetch_array();
		$con->close();
		return $exe['dept_id'];
	}
	function get_staff_by_type($type_id)
	{
		$response = [];
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "select * from staff where staff_type=$type_id";
		$result = $con->query($query);
		while ($exe = $result->fetch_assoc()) {
			$response[] = $exe; 
		}
		$con->close();
		return $response;
	}

}