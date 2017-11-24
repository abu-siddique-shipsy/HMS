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
echo json_encode($response);
?>