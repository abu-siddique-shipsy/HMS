<?php

include __DIR__.'/../config.php';
// include root.'/assets/bootstrap.php';
// include root.'/assets/style.php';
$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
$id = $_POST['consultant_id'];
// echo $id;
if($id != 0)
{
	
	$query = "select * from staff where staff_type = 10 and staff_id = $id";
}
else
{$query = "select * from staff where staff_type = 10";}
$result_array= [];
$response = new stdClass();
$result = $DBcon->query($query);
while ($exe = $result->fetch_assoc()) {
	$result_array[] = $exe;
	$response->data = $result_array;
}



$response->status = "success";
echo json_encode($response);
?>
