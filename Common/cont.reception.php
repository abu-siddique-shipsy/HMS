<?php

include __DIR__.'/../config.php';
include Class_path.'class.register.php';

$response = new stdClass();
if(isset($_POST['get_appointment']))
{
	$response->data = register::getAppointment();
}
echo json_encode($response);