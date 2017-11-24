<?php
include __DIR__.'\..\config.php';
include root.'\assets\bootstrap.php';
include root.'\assets\style.php'; 
session_start();


 $inputs = ($_POST);
$query = ("select * from user_credentials where email = '$inputs[email]' or username = '$inputs[email]'");
$query1 = ("select * from users urs join staff stf on stf.email = urs.email where urs.email = '$inputs[email]'");
$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
$result = $DBcon->query($query);
$result1 = $DBcon->query($query1);

$row1 = $result1->fetch_array();

if($result->num_rows)
{
	$row = $result->fetch_array();

	if (password_verify($inputs['password'], $row['password'])) 
	{
		$_SESSION['userSession'] = $row1['name'];
		$_SESSION['userType'] = $row1['staff_type'];
		$_SESSION['userId'] = $row1['id'];
		header('Location: ../reception/reception.php');
	}
	else
	{
		header("Location: login.php?message=2");		
	}
}
else
{
	header("Location: login.php?message=1");
}

 ?>