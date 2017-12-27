<?php

require __DIR__.'/../config.php';
include Class_path.'class.amount.php';
include Class_path.'class.mailer.php';
// include Class_path.'class.pharmacy.php';
class register{
	public $pat_id;
	function __construct($pat_id)
	{
		$this->pat_id = $pat_id;
	}
	function register_op($consultant_id,$inp_pat)
	{
		$query = "insert into registration (patient_id,consultant_id,is_inp) values ('$this->pat_id','$consultant_id',$inp_pat)";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$con->query($query);
		$query = "SELECT * from registration where patient_id = '$this->pat_id' order by in_at DESC";
		$result = $con->query($query);
		$exe = $result->fetch_array();
		$con->close();
		$this->reg_id = $exe['registration_id'];
	}
	function register_compliant($data)
	{
		$query = "insert into registration_flow (patient_id,registration_id,complaint) values ('$this->pat_id','$this->reg_id','$data')";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$this->complaint = $con->query($query);
		
		$con->close();	
	}
	function patient_update($data)
	{
		$query = "insert into patient (name) values ('$data[name]')";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$con->query($query);
		$name = $data['name'];
		$query1 = "SELECT id from patient where name = '$name' order by added_at DESC limit 1";
		$res = $con->query($query1);
		$exe = $res->fetch_array();
		
		foreach ($data as $key => $value) {
			$query = "UPDATE patient set `$key` = '$value' where id = '$exe[id]'";
			// echo "$key => $value";
			$con->query($query);
		}
		$con->close();	
		return $exe['id'];
	}
	function register_ip($room_id,$insurance)
	{
		$res = $this->register_room($room_id);
		if($res)
		{
			$query = "update registration set ins_num = '$insurance' where patient_id = '$this->pat_id' and registration_id = '$this->reg_id'";
			$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
			$res = $con->query($query);
		}

		$con->close();		
		return $res;
	}
	function register_room($room_id)
	{
		$query = "update registration set room_id = '$room_id' where patient_id = '$this->pat_id' and registration_id =  '$this->reg_id'";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$res = $con->query($query);
		if($res)
		{
			$sql6 = "update rooms set status = 1 where room_id = '$room_id'";
			$this->query = $sql6;
			$res = $con->query($sql6);
			if($res)
			{
				$amt = amountController::get_room_amt($room_id);
				$res = amountController::add_amt(4,$this->reg_id,$amt,0);
				$this->room = $room_id;
			}
		}
		return $res;
	}
	function send_mail()
	{
		$this->mail_result = mailer::registration($this->reg_id);
	}
	function waiting_list()
	{
		$query = "SELECT name,at_time,in_at FROM registration rg join patient pt on pt.id = rg.patient_id where is_inp = 0";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$result = $con->query($query);
		$re = [];
		while ($exe = $result->fetch_assoc())
		{
			$re[] = $exe;
		}
		
		$con->close();
		return $re;
	}
	
}