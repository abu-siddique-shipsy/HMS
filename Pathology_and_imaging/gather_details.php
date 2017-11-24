<?php

include __DIR__.'\..\config.php';
// include root.'\assets\bootstrap.php';
// include root.'\assets\style.php';

$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);

$id = $_POST['procedure_id'];

$query = "select * from lab_procedures where procedure_id = $id";

$result = $DBcon->query($query);
$exe = $result->fetch_array();
$response = new stdClass();
$data = $exe;
$response->data = $data;
$response->status = "success";
echo json_encode($response);
?>