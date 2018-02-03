<?php

include __DIR__.'/../config.php';
include Class_path.'class.amount.php';
// include root.'/assets/bootstrap.php';
// include root.'/assets/style.php';
$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
$response = new stdClass();
if(isset($_POST['data']))
{
	$data = json_decode($_POST['data']);
	$reges_id = $_POST['reges_id'];
	$amt_add_res = "";
	$result = -1;
	foreach ($data as $key => $value) {
		$query = "update registration_flow set `$key` = '$value' where registration_id = '$reges_id'";
		if($key == "attented_by")
		{
			$consultation_charge = amountController::get_consultation_amt($value);	
			if($consultation_charge)
			{
				$amt_add_res = amountController::add_amt(3,$reges_id,$consultation_charge,0);
			}
		}
		$result += $DBcon->query($query);
		
	}
	if($result) $response->status = "Success";
	else $response->status = "Failed";
	$keys = (implode(",",$keys));
	$values = (implode(",",$values));
	$response->add_amt = $amt_add_res;
}
if(isset($_POST['medicines']))
{
	$request = json_decode($_POST['medicines']);
	$reg_id = $_POST['reg_id'];
	$result = 0;
	$response = "";
	$amt = 0;
	foreach ($request as $key => $value) {
		$query = "insert into medicine_used (medicine_id,reg_id,qty,morning,afternoon,night,days,bef_aft) values ('$value->id','$reg_id','$value->qty','$value->morning','$value->afternoon','$value->night','$value->days','$value->bef_aft')";
		// print_r($query);
		$msg= $DBcon->query($query);
		$result += $msg;
		if(($result-1) == ($key)) $response->status = "Success";
		else $response->status = "Failure";	
	}
}

if(isset($_POST['Repeat_transact']))
{
	$requ = json_decode($_POST['Repeat_transact']);

	$amt_add_res = amountController::add_amt($requ->charged_by,$requ->reg_id,$requ->amt,1);
	$response->add_amt = $amt_add_res;
}
if(isset($_POST['reg_id']))
{
	$reg_id = $_POST['reg_id'];
	$result_array1= [];
	$query = "SELECT * from medicine_used mu join medicines m on m.id = mu.medicine_id where mu.reg_id = $reg_id";
	$result = $DBcon->query($query);
	while ($exe = $result->fetch_assoc()) {
			$result_array1[] = $exe;
			$response->data = $result_array1;
		}
	$response->data = $result_array1;
}
if(isset($_POST['tests']))
{
	$request = json_decode($_POST['tests']);
	$reg_id = $_POST['reg_id'];
	$doc_id = $_POST['doc_id'];
	$result = 0;
	// $response = "";
	$amt = 0;
	foreach ($request as $key => $value) {
		$query = "insert into lab_requests (test_id,reg_id,doc_id) values ($value->id,$reg_id,$doc_id)";

		$msg= $DBcon->query($query);
		// $result += $msg;
		if($msg) 
		{
			$res = new amountController();
			$res->add_lab_cost($reg_id,$value->id);
		}
		$response->status = "Success";
		$response->data = "Sucessfully Inserted";
	}
	// if($amt)
	// {
	// 	amountController::add_amt(5,$reg_id,$amt,0);
	// }
}
$DBcon->close();
echo json_encode($response);



?>