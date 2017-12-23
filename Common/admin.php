<?php

include __DIR__.'\..\config.php';
include Class_path.'class.staff.php';
include Class_path.'class.department.php';
include Class_path.'class.structure.php';
$response = new stdClass();
if(isset($_POST['get_staff_type']))
{
	$response->data = staff::get_staff_type();

}
if(isset($_POST['add_staff_type']))
{
	$staff_type = $_POST['add_staff_type'];
	$result = staff::get_staff_type_by_name($staff_type);
	if($result['type_id']) 
		$response->data = $result;
	else{
		staff::add_staff_type($staff_type);
		$result = staff::get_staff_type_by_name($staff_type);
		$response->data = $result;
	}

}
if(isset($_POST['get_dept']))
{
	// $staff_type = $_POST['get_dept'];
	$response->data = department::get_dept();

}
if(isset($_POST['create_staff']))
{
	$data = json_decode($_POST['data']);
	// print_r($data);
	$response->data = staff::create_staff($data);

}
if(isset($_POST['create_contact']))
{
	$data = json_decode($_POST['data']);
	// print_r($data);
	$response->data = staff::create_contact($data);

}
if(isset($_POST['create_clinic']))
{
	$data = json_decode($_POST['data']);
	// print_r($data);
	$response->data = staff::create_clinic($data);

}
if(isset($_POST['update_qualification']))
{
	$data = json_decode($_POST['data']);
	// print_r($data);
	$response->data = staff::update_qualification($data);

}

if(isset($_POST['update_screens']))
{
	$data = json_decode($_POST['update_screens']);
	$type_id = $_POST['type_id'];
	$response->data = staff::update_type_screen_access($data,$type_id);

}
if(isset($_POST['update_screens_for_staff']))
{
	$data = json_decode($_POST['update_screens_for_staff']);
	$staff_id = $_POST['staff_id'];
	$response->data = staff::update_screens_for_staff($data,$staff_id);

}
if(isset($_POST['get_all_staff']))
{
	$data = json_decode($_POST['data']);
	// print_r($data);
	$response->data = staff::get_all_staff($data);

}
if(isset($_POST['get_all_blocks']))
{
	$data = json_decode($_POST['data']);
	// print_r($data);
	$response->data = structure::get_all_blocks();

}
if(isset($_POST['add_block']))
{
	$data = json_decode($_POST['data']);
	// print_r($data);
	$response->data = structure::add_blocks($data);

}
if(isset($_POST['get_all_wards']))
{
	$data = $_POST['data'];
	$response->data = structure::get_wards($data);
}
if(isset($_POST['get_screens']))
{
	$data = $_POST['data'];
	$response->data = staff::get_all_screens();
}
if(isset($_POST['add_ward']))
{
	$data = json_decode($_POST['data']);
	// print_r($data);
	$res = structure::validate_floor($data->block,$data->floor);
	if($res)
	{
		$response->details = "Added Successfully";
		$response->data = structure::add_ward($data);
	}
	else
	{
		$response->details = "Floor Out Of Range Of Block";
	}

}
if(isset($_POST['get_screens_with_access']))
{
	$data = $_POST['get_screens_with_access'];
	$all_screens = staff::get_all_screens();
	$selected_screens = staff::get_selected_screens($data);
	$response->data = staff::get_all_screens_with_access($all_screens,$selected_screens);
}
// get_screens_with_access
echo json_encode($response);
?>