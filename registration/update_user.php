<?php
include __DIR__.'\..\config.php';

$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);

if (isset($_POST['del_email'])) {
    $email = $_POST['del_email'];
    $query = "delete from users where email = '$email'";
    $query1 = "delete from user_credentials where email = '$email'";

    $result1 = $DBcon->query($query);
    $result1 = $DBcon->query($query1);

    echo json_encode($result1);
}
else
{

    $result = $_POST;
    switch ($result['type']) {
        case 1:
            $role = "Student";
            break;
        case 2:
            $role = "Staff";
            break;
        case 3:
            $role = "Admin";
            break;
    }
    $mail_result = false;

    $token = bin2hex($result['name']);
    $query = "insert into users (name,email,role,token) values ('$result[name]','$result[email]','$role','$token')";
    $result1 = $DBcon->query($query);
    if($result1)
    {
    	$headers  = 'MIME-Version: 1.0' . "\r\n";
    	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     
    	$msg = "Hello $result[name], <br>Your Account has been Created.<br> Please Click the following link to reset the Password and Login.<br><br>";
    	$msg .= domain."reset_password/reset.php?token=$token";
    	$mail_result = mail($result['email'],"Welcome to so and so school",$msg,$headers);
    }
     echo json_encode($mail_result);
}
?>