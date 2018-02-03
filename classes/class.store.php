<?php

require __DIR__.'/../config.php';

class store 
{
	function createRequest($reqObj)
	{
		$po = (object) $reqObj;
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * FROM products  where product_type = '$po->product_type' and product_sub_type = '$po->product_sub_type' and product_name = '$po->product_name'";
		session_start();
		$id= $_SESSION['userId'];
		$result = $con->query($query);
		if($result->num_rows) {
			$exe = $result->fetch_object();
			$sql = "INSERT INTO product_request (requested_by,product_id,qty) values ('$id','$exe->product_id','$po->quantity')";			
			$con->query($sql);
		}
		else{
			$query = "INSERT INTO products  (product_type,product_sub_type,product_name) values ('$po->product_type','$po->product_sub_type','$po->product_name')";
			$con->query($query);
			$con->close();
			self::createRequest($reqObj);
		}
		$con->close();
	}
	function updateMrn($mrnObj)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$price = $mrnObj['price'];
		if($price <= 0) 
			$price = self::checkPrice($mrnObj['oid']);
		if($price <= 0) return "Price Not Available";
		self::updatePrice($mrnObj,$price);
		$query = "UPDATE purchase_orders set mrn = '$mrnObj[mrn]' where order_id = '$mrnObj[oid]'";
		$result = $con->query($query);
		$con->close();
		if($result) {
			self::updateStock($mrnObj);
			return "MRN Updated";
		}
		else 
			return "Failed Update";
	}
	function updatePrice($mrnObject,$price)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * FROM purchase_orders where order_id = '$mrnObject[oid]'";
		$result = $con->query($query);
		
		if($result->num_rows > 0) {
			$exe = $result->fetch_object();
			$query1 = "UPDATE products set price = '$price' where product_id = '$exe->product_id'";
			$result1 = $con->query($query1);
			return "Price Updated";
		}
		else{
			$con->close();
			return "No Order Available";
		} 

			
	}
	function checkPrice($order_id)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * FROM purchase_orders where order_id = '$order_id'";
		$result = $con->query($query);
		
		if($result->num_rows > 0) {
			$exe = $result->fetch_object();
			$query1 = "SELECT * FROM products where product_id = '$exe->product_id'";
			$result1 = $con->query($query1);
			$exe1 = $result1->fetch_object();
			$con->close();
			return $exe1->price;
		}
		else{
			$con->close();
			return "No Order Available";
		} 

			
	}
	function updateStock($mrnObj)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * FROM purchase_orders where order_id = '$mrnObj[oid]'";
		$result = $con->query($query);
		$obj = $result->fetch_object();
		$query = "update products set total_available = total_available + $obj->Quantity where product_id = '$obj->product_id'";
		$result = $con->query($query);
		$con->close();
	}
	function getOrderDetails($orderId)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT po.created_at,s.supplier_name, po.order_id,p.product_name,po.quantity from purchase_orders po join products p on p.product_id = po.product_id join supplier s on s.supplier_id = po.supplier_id where order_id = '$orderId' and mrn is null";
		// print_r($query);
		$result = $con->query($query);
		$response = [];
		while ($exe = $result->fetch_object()) {
			$response[] = $exe; 
		}
		$con->close();
		return $response;
	}
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