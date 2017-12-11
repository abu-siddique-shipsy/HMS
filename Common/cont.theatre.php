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
echo json_encode($response);
?>