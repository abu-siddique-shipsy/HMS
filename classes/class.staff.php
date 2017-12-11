<?php

require __DIR__.'/../config.php';
// include Class_path.'class.staff.php';
class staff{
	function get_staff($staff_id)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * from staff stf where staff_id = $staff_id";
		$result = $con->query($query);
		$exe = $result->fetch_array();
		$con->close();
		return $exe;
	}
	function get_doctor($staff_id)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * from staff stf join physician phy on phy.id = stf.staff_id where staff_id = $staff_id";
		$result = $con->query($query);
		$exe = $result->fetch_array();
		$con->close();
		return $exe;
	}
	function get_all_staff()
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * from staff";
		$result = $con->query($query);
		while ($exe = $result->fetch_assoc()) {
			$response[] = $exe; 
		}
		$con->close();
		return $response;
	}
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
	function get_staff_type()
	{
		$response = [];
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "select * from staff_type_map";
		$result = $con->query($query);
		while ($exe = $result->fetch_assoc()) {
			$response[] = $exe; 
		}
		$con->close();
		return $response;
	}
	function add_staff_type($staff_type)
	{
		$response = "";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "insert into staff_type_map (staff_type_name) values ('$staff_type')";
		$result = $con->query($query);
		$con->close();
		return $result;
	}
	function create_staff($staff)
	{
		$response = "";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "insert into staff (l_name,staff_type,email,dept_id) values ('$staff->l_name','$staff->staff_type','$staff->email','$staff->dept_id')";
		$result = $con->query($query);
			
		foreach ($staff as $key => $value) {
			$query1 = "update staff set `$key` = '$value' where email = '$staff->email'";
			// print_r($query1);
			$result1 = $con->query($query1);
		}
		$query = "select * from staff where email = '$staff->email'";
		$result1 = $con->query($query);
		$exe = $result1->fetch_array();		
			
		
		$con->close();
		return $exe['staff_id'];
	}
	function create_contact($staff)
	{
		$response = [];

		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "insert into staff_personal_info (staff_id) values ('$staff->id')";
		$result = $con->query($query);
		foreach ($staff as $key => $value) {
			$query1 = "update staff_personal_info set `$key` = '$value' where staff_id = '$staff->id'";
			// print_r($query1);
			$result1 = $con->query($query1);
			if($result1) 
				$response[] = $key;
		}
		
		$con->close();
		return $response;
	}
	function create_clinic($staff)
	{
		$response = [];

		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "insert into physician_clinic_details (staff_id) values ('$staff->id')";
		$result = $con->query($query);
		foreach ($staff as $key => $value) {
			$query1 = "update physician_clinic_details set `$key` = '$value' where staff_id = '$staff->id'";
			// print_r($query1);
			$result1 = $con->query($query1);
			if($result1) 
				$response[] = $key;
		}
		
		$con->close();
		return $response;
	}
	function update_qualification($staff)
	{
		$response = [];
		// print_r($staff);
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "insert into physician (id) values ('$staff->id')";
		$result = $con->query($query);
		foreach ($staff as $key => $value) {
			$query1 = "update physician set `$key` = '$value' where id = '$staff->id'";
			// print_r($query1);
			$result1 = $con->query($query1);
			if($result1) 
				$response[] = $key;
		}
		
		$con->close();
		return $response;
	}
	function get_all_screens()
	{
		$response = [];
		// print_r($staff);
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "select * from screens";
		$result = $con->query($query);
		while($exe = $result->fetch_assoc()) {
		
				$response[] = $exe;
		}
		
		$con->close();
		return $response;
	}
}