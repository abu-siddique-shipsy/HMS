<?php

include __DIR__.'\..\config.php';
// include root.'\assets\bootstrap.php';
// include root.'\assets\style.php';
// include Class_path.'class.staff.php';
include Class_path.'class.pharmacy.php';
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
		$query = "insert into pharmacy_transaction (med_id,qty) values ($value->id,$value->qty)";
		$msg= $DBcon->query($query);
		$result += $msg;
		if($msg)
		{
			$res = pharmacy::deduct_inventory($value->qty,$value->id);
		}
		if($int)
		{
			$query = "update medicine_used set status = 1 where medicine_id = '$value->id' and reg_id = '$reg_id'";
			print_r($query);
			$msg= $DBcon->query($query);
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
	
	$query = "select m.id,mu.qty,m.medicine_name,m.price from medicine_used mu join medicines m on m.id = mu.medicine_id where reg_id = '$reg_id' and mu.status = 0";

	$result = $DBcon->query($query);
	$re = [];
	$total = 0;
	while ($exe = $result->fetch_assoc()) {
		$re[] = $exe;
		$total += $exe['price'];
	}
	$DBcon->close();
	$response->data = $re;
	$response->total = $total;
	$response->status = "success"; 
	// else $response->status = "failed";
}
echo json_encode($response);
?>