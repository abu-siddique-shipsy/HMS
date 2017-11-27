<?php

include __DIR__.'\..\config.php';
include Class_path.'class.biller.php';
// $DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
$response = new stdClass();
if(isset($_POST['gen_bil']))
{
	$reg_num = $_POST['reg_num'];
	$obj =  new biller($reg_num);
	$response->data = $obj->generate_bill($reg_num);
}
if(isset($_POST['pay_bil']))
{
	$reg_num = $_POST['reg_id'];
	$data = $_POST['details'];
	$obj =  new biller();
	$response->data = $obj->pay_bill($reg_num);
	if($response->data)
		$response->status = "success";
}
echo json_encode($response);
?>