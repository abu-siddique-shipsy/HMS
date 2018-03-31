<?php
require __DIR__.'/../config.php';
// include Class_path.'class.amount.php';
class pharmacy{
	function get_med_with_log_id($log_id)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * from  medicine_used where log_med_id = '$log_id'";
		$result = $con->query($query);

		$re = [];
		while ($exe = $result->fetch_assoc()) {
			$re[] = $exe;
		}
		// print_r($re);
		return $re;	
	}
	function get_all_med()
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * from  medicines";
		$result = $con->query($query);

		$re = [];
		while ($exe = $result->fetch_assoc()) {
			$re[] = $exe;
		}
		// print_r($re);
		return $re;
	}	
	function deduct_inventory($qty,$med_id)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "update medicines set total_available = (total_available - $qty) where id = $med_id";
		$result = $con->query($query);
		// print_r($query);
		
		return $result;
	}
	function update_inventory($data)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$date = date('d-m-y',strtotime($data->exp));
		if($date < date('d-m-y')) return "Expiry Should be More than present date";
		$query = "INSERT into pharmacy_inventory (grn,medicine_type,medicine_brand,medicine_name,qty,expiry_date) values ('$data->grn','$data->type','$data->brand','$data->name','$data->qty','$date')";
		
		$result = $con->query($query);
		self::update_medicine($data,$date);
		$re = "";
		if($result) $re = "Added Successfully"; 
		else $re = "Addition Failed";
		$con->close();
		return $re;	
	}
	function update_medicine($data,$date)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "INSERT into medicines (med_type,med_brand,medicine_name,total_available,expiry_date) values ('$data->type','$data->brand','$data->name','$data->qty','$date')";
		// print_r($query);
		$result = $con->query($query);
		$re = "";
		if($result) $re = "Added Successfully"; 
		else $re = "Addition Failed";
		$con->close();
		return $re;	
	}
	function get_med_for_reg_id($value)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT md.medicine_name,reg_id,qty,on_date from medicine_used mu inner join medicines md on md.id = mu.medicine_id where reg_id = '$value'";
		$result = $con->query($query);
		$re = [];
		while ($exe = $result->fetch_assoc()) {
			$re[] = $exe;
		}
		$con->close();
		return $re;
	}
	function check_quantity($qty,$id)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "select (total_available-$qty) as remaining from medicines where id = $id";
		// print_r($query);
		$result = $con->query($query);
		$exe = $result->fetch_assoc();
		$con->close();
		return $exe['remaining'];
	}
	function getUnitPrice($id)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "select price from medicines where id = $id";
		$result = $con->query($query);
		$exe = $result->fetch_assoc();
		$con->close();
		return $exe['price'];
	}

}