<?php

require __DIR__.'/../config.php';
include Class_path.'class.amount.php';
include Class_path.'class.pharmacy.php';
class biller{
	function generate_bill($reg_num)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT charged_by,amt,charged_at from patient_charges  where registration_id = '$reg_num'";
		// print_r($query);
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
					// if($value == 5)
					// {
					// 	$value1 = new stdClass();

					// 	$medicines = pharmacy::get_med_for_reg_id($reg_num);
					// 	$value1->charger = $name;
					// 	$value1->medicines = $medicines;
					// 	$value = $value1;
					// }
					// else
					// {
						$value = $name;
					// }
					

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
}