<?php

include __DIR__.'/../config.php';
// include root.'/assets/bootstrap.php';
// include root.'/assets/style.php';
$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
$id = $_POST['med_id'];
$query = "SELECT * from medicines where id = $id";

$response = new stdClass();
$result = $DBcon->query($query);
$exe = $result->fetch_array();
$response->data = $exe;
$response->status = "success";
echo json_encode($response);
?>
