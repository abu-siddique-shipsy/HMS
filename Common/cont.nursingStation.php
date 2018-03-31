<?php
include __DIR__.'/../config.php';
include Class_path.'class.nursingStation.php';
include Class_path.'class.structure.php';

$response = new stdClass();
if(isset($_POST['getBlocks']))
{
	$response->data = structure::get_all_blocks();
}
if(isset($_POST['getWard']))
{
	$response->data = structure::get_wards($_POST['getWard']);
}
if(isset($_POST['addTask']))
{
	$response->data = nursingStation::addTask($_POST['addTask']);
}
if(isset($_POST['getTasks']))
{
	$response->data = nursingStation::getAllTasks($_POST['getTasks']);
}
echo json_encode($response);

?>