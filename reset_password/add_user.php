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
	$query = "INSERT INTO  `user_credentials` (`username`,`password`,`email`) values ('$uname','$hashed_password','$email')";
	$query1 = "update users set username = '$uname',token = '' where email ='$email'";
	$result = $DBcon->query($query); 
	if($result)
	{
		$result = $DBcon->query($query1); 
	}
	echo json_encode($result);
}
?>
