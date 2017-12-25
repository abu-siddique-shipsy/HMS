<?php
include __DIR__.'/../config.php';
include root.'/assets/bootstrap.php';
include root.'/assets/style.php'; 
session_start();


 $inputs = ($_POST);

$query = ("select * from user_credentials where email = '$inputs[email]' or username = '$inputs[email]'");
$query1 = ("select * from users urs join staff stf on stf.email = urs.email where urs.email = '$inputs[email]'");
print_r($query);echo "<br>";
print_r($query1);echo "<br>";
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
		$_SESSION['screens'] = get_screens($inputs['email']);
		$_SESSION['email'] = $inputs['email'];
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


function get_screens($email){
	$sql = "SELECT * FROM `screens` scr join screen_staff_map ssm on ssm.screen_id =  scr.screen_id join staff stf  on stf.staff_id = ssm.staff_id where stf.email = '$email'";
	$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
	$result = $con->query($sql);
	$re = [];
	while ($exe = $result->fetch_assoc()) {
		$re[] = $exe;
	}
	return $re;	

}
?>
