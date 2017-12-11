<?php

require __DIR__.'/../config.php';
class amountController{
	function add_amt($cid,$rid,$amt,$check)
	{
		$insert = !$check;
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$response = new stdClass();
		$response->charged_by = $cid;
		$response->registration_id = $rid;
		$response->amt = $amt;
		$resul = 0;
		$date = date('Y-m-d');
		if(!$check)
		{
			$check_charge = $con->query("select * from patient_charges where registration_id = $rid and charged_by= $cid and amt = $amt and charged_at = '$date'");
			$insert = $check_charge->num_rows;
			$resul = 1;
		}
		
		if(!$insert)
		{
			
			$resul = $con->query("insert into patient_charges (registration_id,charged_by,amt,charged_at) values ($rid,$cid,$amt,'$date')");
			$con->close();
			if($resul) $resul = 2;
			else $resul = 3;
		}
		$response->result = $resul;
		return $response;
	}
	function get_medicine_amt($medicine_id)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$resul = $con->query("Select * from medicines where id = $medicine_id");
		$exe = $resul->fetch_array();
		$con->close();
		return $exe['price'];
	}
	function get_consultation_amt($value)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$resul = $con->query("Select * from physician where id = $value");
		$exe = $resul->fetch_array();
		$con->close();
		return $exe['fee'];	
	}
	function get_ot_charge($value)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$resul = $con->query("Select * from physician where id = $value");
		$exe = $resul->fetch_array();
		$con->close();
		return $exe['ot_fee'];	
	}
	function get_charger_type($value)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$resul = $con->query("Select * from charges where charge_id = $value");
		$exe = $resul->fetch_array();
		$con->close();
		return $exe['charger_type'];	
	}
	function get_room_amt($value)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$resul = $con->query("SELECT * FROM rooms rm join room_type_map rtm on rm.room_type = rtm.type_id where rm.room_id = $value");
		$exe = $resul->fetch_array();
		$con->close();
		return $exe['charge'];	
	}
	function add_lab_cost($rid,$pid)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$resul = $con->query("SELECT * FROM lab_procedures where procedure_id = $pid");
		$exe = $resul->fetch_array();
		
		$con->close();
		return $this->add_amt(6,$rid,$exe['procedure_cost'],1);		
	}
}
?>