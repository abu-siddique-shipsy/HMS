<?php

include __DIR__.'\..\config.php';

$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
if(isset($_POST['check_uname']))
{
	$uname = $_POST['check_uname'];
	$query = "select * from users where username = '$uname'";
	$result = $DBcon->query($query);
	if($result->num_rows)
	{
		$response = new stdClass();
		$response->status = "success";
		$response->result = 0;
	}	
	else
	{
		$response = new stdClass();
		$response->status = "success";
		$response->result = 1;
	}
	echo json_encode($response);


}
else
{
	$inputs = $_POST;



	$hashed_password = password_hash($inputs['pwd'], PASSWORD_DEFAULT);
	$uname = $inputs['uname'];
	$email = $inputs['email'];
	$query2 = "select * from users where email = '$email'";
	$result2 = $DBcon->query($query2); 
	$exe = $result2->fetch_array();

	$query = "INSERT INTO  `user_credentials` (`user_id`,`username`,`password`,`email`) values ('$exe[id]','$uname','$hashed_password','$email')";
	$query1 = "update users set username = '$uname',token = '' where email ='$email'";
	$result = $DBcon->query($query); 
	if($result)
	{
		$result = $DBcon->query($query1); 
	}
	echo json_encode($result);
}
?>
