<?php

require __DIR__.'/../config.php';
include Class_path.'class.amount.php';
include Class_path.'class.pharmacy.php';
class biller{
	function generate_bill($reg_num)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		
		$query = "SELECT charge_id,charged_by,amt,charged_at,status from patient_charges  where registration_id = '$reg_num'";
		if ($this->req) {
			$query = "SELECT charge_id,charged_by,amt,charged_at,status from patient_charges  where registration_id = '$reg_num' and charged_by = '$this->req'";	
		}
		$result = $con->query($query);
		$re = [];
		while ($exe = $result->fetch_assoc()) {
			$re[] = $exe;
		}
		$bill = $this->customize_bill($re,$reg_num);
		$con->close();
		return $bill;
	}
	function customize_bill($bill_array,$reg_num)
	{
		
		$tuple = [];
		$result = [];
		$total = 0;
		foreach ($bill_array as $key1 => $value1) {
			$tuple = [];
			foreach ($value1 as $key => $value) {

				$response = new stdClass();
				if($key ==  "charged_by")
				{
					$name = amountController::get_charger_type($value);
					$value = $name;
					

				}
				if ($key == "amt") {

					$total += $value;
				}
				
				
				$tuple[] = $value;	
			}
			array_push($result,$tuple);
		}
		$total_amt = new stdClass();
		$total_amt->total = $total;
		array_push($result,$total_amt);
		return $result;
	}
	function pay_bill($reg_num)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "update patient_charges set status=1 where registration_id = '$reg_num'";
		// print_r($query);
		$result = $con->query($query);
		$con->close();
		return $result;
	}
}