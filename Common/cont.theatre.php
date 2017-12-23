<?php

include __DIR__.'\..\config.php';
// include root.'\assets\bootstrap.php';
include Class_path.'class.ot.php';
$response = new stdClass();
if(isset($_GET['comment']))
{
	$comments = $_GET['comment'];
	$operation = new ot($_GET['log_id'],0);
	$response->data = $operation->add_comments($comments);
	unset($operation);
	// print_r($operation);
}
if(isset($_GET['get_comment']))
{
	// $comments = $_GET['comment'];
	$operation = new ot($_GET['log_id'],0);
	$response->data = $operation->get_comments($comments);
	unset($operation);

	// print_r($operation);
}
if(isset($_GET['stop_procedure']))
{
	// $comments = $_GET['comment'];
	$operation = new ot($_GET['log_id'],0);
	$response->data = $operation->stop_procedure($comments);
	unset($operation);

	// print_r($operation);
}
if(isset($_GET['medicine_request']))
{
	$medicine = json_decode($_GET['medicine_request']);

	
	$operation = new ot($_GET,0);
	$operation->add_medicine($medicine);
	$response->data = $operation->get_medicines();
	unset($operation);

	// print_r($operation);
}
if(isset($_GET['req_list']))
{
	$operation = new ot($_GET,0);
	$response->data = $operation->get_medicines();
	unset($operation);
}
echo json_encode($response);
?>