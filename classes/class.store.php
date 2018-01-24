<?php

require __DIR__.'/../config.php';

class store 
{
	function getInventory()
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * from products";

		$result = $con->query($query);
		$response = [];
		while ($exe = $result->fetch_object()) {
			$response[] = $exe; 
		}
		$con->close();
		return $response;
	}
	function getRequest()
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * from products pd 
		join product_request pr on pr.product_id = pd.product_id
		join staff stf on stf.staff_id = pr.requested_by
		where pr.flag = 0";

		$result = $con->query($query);
		$response = [];
		while ($exe = $result->fetch_object()) {
			$response[] = $exe; 
		}
		$con->close();
		return $response;
	}
	function acceptRequisition($request_id)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * FROM product_request where request_id = $request_id";
		$result = $con->query($query);
		$exe = $result->fetch_object();
		$query = "UPDATE products set total_available = (total_available - $exe->qty) where product_id = $exe->product_id";
		$result = $con->query($query);
		$query = "UPDATE product_request set flag = 1 where request_id = $request_id";
		$result = $con->query($query);
		$con->close();
	}
	function declineRequisition($request_id,$reason)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "UPDATE product_request set flag = 2 , reason_for_decline = '$reason' where request_id = $request_id";
		$result = $con->query($query);
		$con->close();
	}
	function getSupplierDetails($supplier_id=NULL)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * from supplier";
		if($supplier_id)
			$query = "SELECT * from supplier where supplier_id = $supplier_id";
		$result = $con->query($query);
		$response = [];
		while ($exe = $result->fetch_object()) {
			$response[] = $exe; 
		}
		$con->close();
		return $response;
	}
	function getProductType($type)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT DISTINCT(product_type) as text from products where product_type like '$type%'";
		// print_r($query);
		$result = $con->query($query);
		$response = [];
		while ($exe = $result->fetch_object()) {
			$response[] = $exe; 
		}
		$con->close();
		return $response;
	}
	function getProductSubType($type)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT DISTINCT(product_sub_type) as text from products where product_sub_type like '$type%'";
		// print_r($query);
		$result = $con->query($query);
		$response = [];
		while ($exe = $result->fetch_object()) {
			$response[] = $exe; 
		}
		$con->close();
		return $response;
	}
	function getProductName($type)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME); 
		$query = "SELECT DISTINCT(product_name) as text from products where product_name like '$type%'";
		// print_r($query);
		$result = $con->query($query);
		$response = [];
		while ($exe = $result->fetch_object()) {
			$response[] = $exe; 
		}
		$con->close();
		return $response;
	}
	function sendPo($po)
	{
		$po = (object)$po;
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME); 
		$query = "INSERT INTO products (product_type,product_sub_type,product_name) VALUES ('$po->product_type','$po->product_sub_type','$po->product_name')";
		
		$result = $con->query($query);
		$query = "SELECT * FROM products  where product_type = '$po->product_type' and product_sub_type = '$po->product_sub_type' and product_name = '$po->product_name'";
		$result = $con->query($query);
		$exe = $result->fetch_object();
		$query = "INSERT INTO purchase_orders (supplier_id,product_id,quantity) VALUES ('$po->supplier_id','$exe->product_id','$po->quantity')";
		$result = $con->query($query);
		$con->close();
	}
}