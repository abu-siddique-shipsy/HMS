<?php

require __DIR__.'/../config.php';
include Class_path.'class.amount.php';
include Class_path.'class.pharmacy.php';
class inpatient{
	function save_visit($data)
	{
		$data = json_decode($data);
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "insert into inp_doc_visits (reg_id,doc_id,comments) values ('$data->reg_id',$data->doc_id,'$data->comments')";
		// print_r($query);
		$result = $con->query($query);
		if($result)
		{
			$result = amountController::get_consultation_amt($data->doc_id);
			if($result)
			{
				$result = amountController::add_amt(3,$data->reg_id,$result,1);
			}

		}
		return $result;
	}
	function show_visits($reg_id)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT idv.comments,idv.visited_on,stf.l_name,(select SUM(amt) from patient_charges where registration_id =idv.reg_id and charged_by = 3) as total_amt FROM `inp_doc_visits` idv join staff stf on stf.staff_id = idv.doc_id where idv.reg_id = $reg_id";
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
	function update_room($room_id,$reg_id)
	{
		$query = "update registration set room_id = '$room_id' where registration_id = '$reg_id'";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$res = $con->query($query);
		if($res)
		{
			$sql6 = "update rooms set status = 1 where room_id = '$room_id'";

			$res = $con->query($sql6);
			if($res)
			{
				$amt = amountController::get_room_amt($room_id);
				$res = amountController::add_amt(4,$reg_id,$amt,1);
				// $this->room = $room_id;
			}
		}
		return $res;
	}
	function reset_room($reg_id)
	{
		$query = "select * from registration  where registration_id = '$reg_id'";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$res = $con->query($query);
		$exe = $res->fetch_assoc();
		
		if($exe['room_id'])
		{
			$query = "update rooms set status = 0 where room_id = $exe[room_id]";
			$res = $con->query($query);
		}
		return $res;
	}
	function get_lab_details($reg_id)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "select * from lab_requests lr join lab_procedures lp on lp.procedure_id = lr.test_id join staff stf on stf.staff_id = lr.doc_id where reg_id = $reg_id";
		// print_r($query);
		$result = $con->query($query);
		$re = [];
		while ($exe = $result->fetch_assoc()) {
			$re[] = $exe;
		}
		return $re;
	}
}