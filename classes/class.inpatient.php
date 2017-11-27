<?php

require __DIR__.'/../config.php';
include Class_path.'class.amount.php';
include Class_path.'class.pharmacy.php';
class inpatient{
	function save_visit($doc_id,$comments,$reg_id)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "insert into inp_doc_visits (reg_id,doc_id,comments) values ($reg_id,$doc_id,'$reg_id')";
		$result = $con->query($query);
		if($result)
		{
			$result = amountController::get_consultation_amt($doc_id);
			if($result)
			{
				$result = amountController::add_amt(3,$reg_id,$result,1);
			}

		}
		return $result;
	}
	function show_visits($reg_id)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT idv.comments,idv.visited_on,stf.name,(select SUM(amt) from patient_charges where registration_id =idv.reg_id and charged_by = 3) as total_amt FROM `inp_doc_visits` idv join staff stf on stf.staff_id = idv.doc_id where idv.reg_id = $reg_id";
		// print_r($query);
		$result = $con->query($query);
		$re = [];
		while ($exe = $result->fetch_assoc()) {
			$re[] = $exe;
			$total_amt = $exe['total_amt'];
		}
		// $bill = $this->customize_bill($re,$reg_num);
		$total_visits = $re;
		// $response = new stdClass();
		// $response->total_amt = $total_amt;
		$response = $total_visits;
		return $response;
		$con->close();
		
	}
}