<?php
require __DIR__.'/../config.php';
// include Class_path.'class.amount.php';
class pharmacy{
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

}