<?php

include __DIR__.'/../config.php';
// include root.'/assets/bootstrap.php';
// include root.'/assets/style.php';
include Class_path.'class.patient.php';
include Class_path.'class.pharmacy.php';
include Class_path.'class.structure.php';

$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
$response = new stdClass();


$data = pharmacy::get_all_med();
$response->data = $data;



if(isset($_POST['medicines']))
{
	$request = json_decode($_POST['medicines']);
	$reg_id = $_POST['reg_id'];
	$result = 0;

	$amt = 0;
	$res;
	$int = $_POST['internal'];
	foreach ($request as $key => $value) {
		if ($value->tot_req == "" ) continue;
		$res = pharmacy::check_quantity($value->tot_req,$value->id);
		if($res >= 0)
		{
			$query = "insert into pharmacy_transaction (med_id,qty) values ($value->id,$value->tot_req)";
			$msg= $DBcon->query($query);
			$result += $msg;
			if($msg)
			{
				$amt += ($value->tot_req)*pharmacy::getUnitPrice($value->id);
				$res = pharmacy::deduct_inventory($value->tot_req,$value->id);
			}
			if($int)
			{
				($value->tot_req - $value->qty) == 0 ? $status =1 : $status =0;
				$query = "update medicine_used set tot_req = $value->tot_req, status = $status where medicine_id = '$value->id' and reg_id = '$reg_id'";
				$msg= $DBcon->query($query);
			}
		}

	}
	
	
	if($res) $response->status = "success"; 
	else $response->status = "failed";
	$response->price = $amt;
}
if(isset($_POST['ot_med_log_id']))
{
	$log_id = $_POST['ot_med_log_id'];
	$result = 0;
	$request = pharmacy::get_med_with_log_id($log_id);
	$amt = 0;
	$res;
	$int = 1;
	foreach ($request as $key => $value) {
		$value = (object) $value;
		$res = pharmacy::check_quantity($value->qty,$value->medicine_id);

		if($res >= 0)
		{
			$query = "insert into pharmacy_transaction (med_id,qty) values ($value->medicine_id,$value->qty)";
			$msg= $DBcon->query($query);
			$result += $msg;
			if($msg)
			{
				$res = pharmacy::deduct_inventory($value->qty,$value->id);
			}
			if($int)
			{
				$query = "update medicine_used set status = 1 where medicine_id = '$value->medicine_id' and reg_id = '$value->reg_id'";
				// print_r($query);
				$msg= $DBcon->query($query);
			}
		}

	}
	
	
	if($res) $response->status = "success"; 
	else $response->status = "failed";
}
if(isset($_POST['medicine_used_by']))
{
	
	$reg_id = $_POST['medicine_used_by'];
	$result = 0;
	$amt = 0;
	$res;
	
	$query = "select * from medicine_used mu join medicines m on m.id = mu.medicine_id where reg_id = '$reg_id' and mu.status = 0";

	$result = $DBcon->query($query);
	$re = [];
	$total = 0;
	while ($exe = $result->fetch_assoc()) {
		$re[] = $exe;
		$total += $exe['price'];
	}
	
	$response->data = $re;
	$response->total = $total;
	$response->status = "success"; 
	// else $response->status = "failed";
}
if(isset($_GET['req_list_all']))
{
	
	$reg_id = $_POST['medicine_used_by'];
	$result = 0;
	$amt = 0;
	$res;
	
	$query = "select * from medicine_used mu join medicines m on m.id = mu.medicine_id join surgery_log sl on sl.reg_id = mu.reg_id where mu.status = 0 and mu.is_op=1";

	$result = $DBcon->query($query);
	$re = [];
	$total = 0;
	while ($exe = $result->fetch_assoc()) {
		$patient = patient::get_patient_with_reg_id($exe['reg_id']);
		$exe['patient_name'] = $patient['name'];
		$exe['room'] = structure::get_room_details($exe['room_id'])[0];
		$re[] = $exe;
		
	}
	$response->data = $re;
	$response->status = "success"; 
	// else $response->status = "failed";
}
if(isset($_POST['update_inventory']))
{
	
	$data = json_decode($_POST['data']);
	$response->alert = "";
	foreach ($data as $key => $value) {
		// print_r($value);
		if($value == ""){
			$response->alert = "$key Cannot be empty";break;
		}
	}
	if($response->alert == "")
	{
		$response->alert = pharmacy::update_inventory($data);
	}
}
$DBcon->close();
echo json_encode($response);
?>