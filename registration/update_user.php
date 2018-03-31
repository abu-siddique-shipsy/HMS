<?php
include __DIR__.'/../config.php';

$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);

if (isset($_POST['del_email'])) {
    $email = $_POST['del_email'];
    $query = "delete from users where email = '$email'";
    $query1 = "delete from user_credentials where email = '$email'";

    $result1 = $DBcon->query($query);
    $result1 = $DBcon->query($query1);

    echo json_encode($result1);
}
if(isset($_POST['send_mail']))
{
    $mail_result = false;
    $data = json_decode($_POST['data']);
    $token = bin2hex($data->name);
    $query = "insert into users (name,email,role,token,id) values ('$data->name','$data->email','$data->type','$token','$data->id')";
    print_r($query);
    $result1 = $DBcon->query($query);
    if($result1)
    {
    	$headers  = 'MIME-Version: 1.0' . "/r/n";
    	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "/r/n";
     
    	$msg = "Hello $data->name, <br>Your Account has been Created.<br> Please Click the following link to reset the Password and Login.<br><br>";
    	$msg .= domain."/reset_password/reset.php?token=$token";
    	$mail_result = mail($data->email,"Welcome to HMS",$msg,$headers);
    }
     echo json_encode($mail_result);
}
?>