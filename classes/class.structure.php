<?php

require __DIR__.'/../config.php';
// include Class_path.'class.staff.php';
class structure{
	function get_all_blocks()
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT bck.block_id as id,block_name as name,bck.block_id,f_name,l_name from block bck join staff stf on stf.staff_id = bck.incharge";
		// print_r($query);
		$result = $con->query($query);

		while ($exe = $result->fetch_assoc()) {
			$response[] = $exe; 
		}
		$con->close();
		return $response;
	}
	function add_blocks($data)
	{
		$response = "";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "insert into block (block_name,incharge,description,num_floors) values ('$data->block_name','$data->incharge','$data->desc','$data->num_floors')";
		// $query1 = "insert into staff_type_map (name) values ('$staff_type')";
		$result = $con->query($query);
		
		$con->close();
		return $result;
	}
	function add_ward($data)
	{
		$response = "";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);

		$query = "insert into ward (ward_name,block_id,floor_num,ward_incharge) values ('$data->ward_name','$data->block','$data->floor','$data->incharge')";
		// $query1 = "insert into staff_type_map (name) values ('$staff_type')"
		// print_r($query);
		$result = $con->query($query);
		
		$con->close();
		return $result;
	}
	function get_wards($data)
	{
		$response = [];
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		if(!$data)
			$query = "SELECT ward_id as id,ward_name as name,bck.block_id,floor_num,f_name,l_name from ward wrd join block bck on bck.block_id = wrd.block_id left join staff stf on stf.staff_id = wrd.ward_incharge";
		else
			$query = "SELECT ward_id as id,ward_name as name,bck.block_id,floor_num from ward wrd join block bck on bck.block_id = wrd.block_id where bck.block_id = '$data'";
		// print_r($query);
		$result = $con->query($query);
		while ($exe = $result->fetch_assoc()) {
			$response[] = $exe; 
		}
		$con->close();
		return $response;
		
	}
	function get_ward($data)
	{
		$response = new stdClass();
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * from ward wrd join block bck on bck.block_id = wrd.block_id where wrd.ward_id = '$data'";
		$result = $con->query($query);
		$exe = $result->fetch_array();
		$response->id = $exe['ward_id'];
		$response->name = $exe['ward_name'];
		$response->on_floor = $exe['floor_num'];
		$con->close();
		return $response;
		
	}
	function validate_floor($block,$floor)
	{
		$response = "";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
				
		$query = "select * from block where block_id = '$block'";
		// $query1 = "insert into staff_type_map (name) values ('$staff_type')";
		$result = $con->query($query);
		$exe = $result->fetch_array();
		
		$res = ($exe['num_floors'] >= $floor) ? true : false;
		return $res;
		$con->close();
		
	}
	function get_block($data)
	{
		$response = new stdClass();
		
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT bck.block_id,bck.block_name from ward wrd join block bck on bck.block_id = wrd.block_id where ward_id ='$data'";
		$result = $con->query($query);
		$exe = $result->fetch_assoc();
		$response->id = $exe['block_id'];
		$response->name = $exe['block_name']; 
		$con->close();
		return $response;
		
	}
	function get_rooms($data)
	{
		$response = [];
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		if(!$data)
			$query = "SELECT ward_id as id,ward_name as name,bck.block_id,floor_num,f_name,l_name from ward wrd join block bck on bck.block_id = wrd.block_id left join staff stf on stf.staff_id = wrd.ward_incharge";
		else
			$query = "SELECT ward_id as id,ward_name as name,bck.block_id,floor_num from ward wrd join block bck on bck.block_id = wrd.block_id where bck.block_id = '$data'";
		// print_r($query);
		$result = $con->query($query);
		while ($exe = $result->fetch_assoc()) {
			$response[] = $exe; 
		}
		$con->close();
		return $response;
		
	}
	function get_room_details($room_id)
	{
		$response = [];
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
	
		$query = "SELECT wrd.ward_id as id,ward_name as ward_name,bck.block_id,bck.block_name as block_name,floor_num,rm.room_id from ward wrd join block bck on bck.block_id = wrd.block_id join rooms rm on rm.ward_id = wrd.ward_id where rm.room_id = '$room_id'";
		// print_r($query);
		$result = $con->query($query);
		while ($exe = $result->fetch_assoc()) {
			$response[] = $exe; 
		}
		$con->close();
		return $response;
		
	}
}