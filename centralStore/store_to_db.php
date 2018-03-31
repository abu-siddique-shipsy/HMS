<?php

include __DIR__.'/../config.php';
 include root.'/assets/bootstrap.php';
// include root.'/assets/style.php';
session_start();
$id= $_SESSION['userId'];
$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
$name_array = [];
$qty_array = [];
if(isset($_POST))
{
	$res = $_POST;
	$name = $_POST['product_id'];
	$qty = $_POST['qty'];
	foreach ($res as $key => $value) {
		$keys[] =  $key;
	}
	$key1 = ("(requested_by,".implode(",",$keys).")");
	foreach ($name as $key => $value) {
		array_push($name_array,"('".$id."','".$value."','".$qty[$key]."')");
		// array_push($qty_array,$qty[$key]);
	}
	$value1 = implode(",",$name_array);
    $sql = "INSERT INTO product_request $key1 VALUES  $value1";
    if($DBcon->query($sql))
    {
    	header('Location: request_item.php?message=1');
    }
    else
    {
    	header('Location: request_item.php?message=2');
    }
}
?>