<?php
include __DIR__.'/../config.php';
include Class_path.'class.laboratory.php';
include Class_path.'class.fileuploader.php';
$response = new stdClass();
if(isset($_POST['get_reports']))
{
	$data = $_POST['get_reports'];
	$response->data = laboratory::get_tests($data);
}
if(isset($_POST['get_tests']))
{
	$data = $_POST['get_tests'];
	$response->data = laboratory::get_tests($data);
}
if(isset($_POST['get_samples']))
{
	$data = $_POST['get_samples'];
	$response->data = laboratory::get_samples($data);
}
if(isset($_POST['get_samples_types']))
{
	$data = $_POST['get_samples'];
	$response->data = laboratory::get_samples_types();
}
if(isset($_POST['add_samples']))
{
	$data = json_decode($_POST['add_samples']);
	$response->status = (laboratory::add_samples($data) ?  "success" : "failure");
}
if(isset($_POST['from']))
{
	$file = new fileuploader();
	$file->reg_id = $_POST['reg_id'];
	$file->name = $_FILES['file']['name'];
	$file->type = end(explode('.', $_FILES['file']['name']));
	$file->error = $_FILES['file']['error'];
	$file->size = $_FILES['file']['size'];
	
	$file->from = $_POST['from'];
	$file->Content = file_get_contents($_FILES['file']['tmp_name']);
	$response = $file->name; 
	$file->upload();
	$response = $file;
	unset($file);
}
if(isset($_POST['from_rec']))
{
	$file = new fileuploader();
	$file->reg_id = $_POST['reg_id'];
	// $file->name = $_FILES['file']['name'];
	// $file->type = end(explode('.', $_FILES['file']['name']));
	// $file->error = $_FILES['file']['error'];
	// $file->size = $_FILES['file']['size'];
	$file->from = $_POST['from_rec'];
	$file->get_rec();
	
	// $file->Content = file_get_contents($_FILES['file']['tmp_name']);
	// $response = $file->name; 
	$response = $file;
	unset($file);
}
echo json_encode($response);
?>