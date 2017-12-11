<?php

include __DIR__.'\..\config.php';
// include root.'\assets\bootstrap.php';
// include root.'\assets\style.php';
include Class_path.'class.staff.php';
include Class_path.'class.register.php';
include Class_path.'class.structure.php';
// include Class_path.'class.inpatient.php';
$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
if(isset($_POST['patient_id']))
{
	$id = $_POST['patient_id'];
	$query = "select * from patient where id = $id";
	$result_array= [];
	$result_array1= [];
	$response = new stdClass();
	// print_r($query);
	$response->data = 1;
	$result = $DBcon->query($query);
	while ($exe = $result->fetch_assoc()) {
		$patient_id = $exe['id'];
		$result_array[] = $exe;
		$response->data = $result_array;
	}


	$response->status = "success";
}
if(isset($_POST['team_id']))
{
	$id = $_POST['team_id'];
	$data = staff::get_staff_by_type($id);
	$response->data = $data;
	$response->status = "success";
	
	
}
if(isset($_POST['inp_pat']))
{
	$inp_pat = $_POST['inp_pat'];
	$data =  $_POST['data'];
	$register_obj = new register($data['pat_id']);
	$register_obj->register_op($data['cons_id'],$inp_pat);
	$register_obj->register_compliant($data['complaint']);
	if($inp_pat)
	{
		$room_id =  $data['room'];
		$insurance =  $data['ins_num'];
		$register_obj->register_ip($room_id,$insurance);
	}
	$response->data = $register_obj;
	$response->status = "success";
	unset($register_obj);	
	
}
if(isset($_POST['pat_reg']))
{
	$data =  $_POST['data'];
	if($data)
	{
		$register_obj = register::patient_update($data);
	}

	$response->patient_id = $register_obj;
	$response->status = "success";
	
	
}
else if(isset($_POST['get_room']))
{
	if(isset($_POST['data']))
	{	
		$ward = $_POST['data'];
		$query = "select * from rooms rm join room_type_map rmt on rm.room_type = rmt.type_id where rm.status = 0 and rm.ward_id = '$ward' and rm.room_type != 7";
	}
	else
	{
		$query = "select * from rooms rm join room_type_map rmt on rm.room_type = rmt.type_id where rm.status = 0 and rm.room_type != 7";
	}
	$result = $DBcon->query($query);
	// print_r($query);
	$doc_array = [];
	while($exe = $result->fetch_assoc())
	{
		array_push($doc_array,$exe);
	}
	$response = new stdClass();
	$data = $doc_array;
	$response->data = $data;
	$response->status = "success";
	// echo json_encode($response);
}
else if(isset($_POST['get_room_1']))
{
	$query = "select * from rooms rm join room_type_map rmt on rm.room_type = rmt.type_id where rm.room_type != 7";
	$result = $DBcon->query($query);
	// print_r($query);
	$doc_array = [];
	while($exe = $result->fetch_assoc())
	{
		array_push($doc_array,$exe);
	}
	$response = new stdClass();
	$data = $doc_array;
	$response->data = $data;
	$response->status = "success";
	// echo json_encode($response);
}
else if(isset($_POST['get_ot']))
{
	$query = "select * from rooms rm join room_type_map rmt on rm.room_type = rmt.type_id join ward wrd on rm.ward_id = wrd.ward_id join block bck on bck.block_id = wrd.block_id where rm.room_type = 7";
	$result = $DBcon->query($query);
	// print_r($query);
	$doc_array = [];
	while($exe = $result->fetch_assoc())
	{
		array_push($doc_array,$exe);
	}
	$response = new stdClass();
	$data = $doc_array;
	$response->data = $data;
	$response->status = "success";
	// echo json_encode($response);
}
else if(isset($_POST['get_surg']))
{
	$query = "select * from surgery";
	$result = $DBcon->query($query);
	// print_r($query);
	$doc_array = [];
	while($exe = $result->fetch_assoc())
	{
		array_push($doc_array,$exe);
	}
	$response = new stdClass();
	$data = $doc_array;
	$response->data = $data;
	$response->status = "success";
	// echo json_encode($response);
}
else if(isset($_POST['get_operations']))
{
	$reg_id = $_POST['get_operations'];	
	$query = "select * from surgery srg join surgery_log sl on srg.surg_id = sl.surg_id where sl.reg_id = $reg_id and sl.status = '0'";
	$result = $DBcon->query($query);
	// print_r($query);
	$doc_array = [];
	while($exe = $result->fetch_assoc())
	{
		array_push($doc_array,$exe);
	}
	$response = new stdClass();
	$data = $doc_array;
	$response->data = $data;
	$response->status = "success";
	// echo json_encode($response);
}
else if(isset($_POST['get_ward_block']))
{
	$data = $_POST['get_ward_block'];
	$data1 = new stdClass(); 
	$selected = new stdClass();
	// $selected->room = $data;
	$selected->ward = structure::get_ward($data);
	$selected->block = structure::get_block($data);
	$data1->wards = structure::get_wards($selected->block->id);
	$data1->blocks = structure::get_all_blocks();
	$data1->selected = $selected;
	$response->data = $data1;

}
if(isset($_POST['get_wards']))
{	
	$data = $_POST['get_wards'];
	$response->data = structure::get_wards($data);
}

echo json_encode($response);

?>
