<?php

require __DIR__.'/../config.php';
include Class_path.'class.amount.php';
include Class_path.'class.staff.php';
class ot{
	function __construct($data,$option)
	{
		// print_r($option);
		if($option)
		{

			$this->reg_id = $data['reg_id'];
			$this->create_procedure($data['surg']);
			$this->theatre_id = "Room Not Registed Contact Admin";
			$res = amountController::add_amt(8,$this->reg_id,amountController::get_room_amt($data['room']),1);
			if ($res->result == 2) {
				$this->theatre_id = $data['room'];
			}
			$this->all_docs = [];
			foreach ($data['staff_id'] as $key => $value) {
				$doc_id = "doc_".$key;
			
				$this->all_docs[] = $value;

				$name = $this->assign_doctor($value);
				if($name)
				{
					$this->all_docs_names[]	= $name;				
					$this->$doc_id = $name;	
				}

			}

			$this->log_id =	$this->store_details();
			foreach ($data['staff_id'] as $key => $value) {
					$this->store_doc($value);
			}
		}
		else
		{
			$this->log_id = $data['log_id'];
			
		}
		$this->retrive_details();
	}
	function assign_doctor($doctor)
	{
		$doc_id = $doctor;
		$doc_charge = amountController::get_ot_charge($doctor);
		$res = amountController::add_amt(9,$this->reg_id,$doc_charge,1);
		if($res->result == 2){
			$name = staff::get_doctor($doc_id);
			return "Dr. ".$name['f_name']." ".$name['l_name']." (".$name['speciality'].") ";
		}
		else
			return false;
	}
	function create_procedure($surg_id)
	{
		$surg_details = $this->get_surgery_details($surg_id);
		
		$res = amountController::add_amt(10,$this->reg_id,$surg_details['cost'],1);
		if($res->result == 2){
			$this->surgery_name = $surg_details['surg_name'];
			$this->surg_id = $surg_details['surg_id'];
			
		}
		else
		{
			$this->surgery_name = "Surgery Not Designated";
		}

	}
	function get_surgery_details($surg_id)
	{
		$query = "select * from surgery where surg_id = $surg_id";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$result = $con->query($query);
		$exe = $result->fetch_array();
		$con->close();
		return $exe;
	}
	function store_details()
	{
		$all_docs = implode(",",$this->all_docs);
		$query = "insert into surgery_log (surg_id,reg_id,doctors) values ('$this->surg_id','$this->reg_id','$this->all_docs_names')";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);

		$result = $con->query($query);
		$query = "SELECT * from surgery_log where surg_id = '$this->surg_id' and reg_id = '$this->reg_id' order by log_id DESC ";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);

		$result = $con->query($query);
		$exe = $result->fetch_array();

		$con->close();
		return $exe['log_id'];
	}
	function retrive_details()
	{
		// $all_docs = implode(",",$this->all_docs);
		$query = "select * from surgery_log where log_id = '$this->log_id'";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$result = $con->query($query);
		$exe = $result->fetch_array();
		$this->reg_id = $exe['reg_id'];
		$this->surg_id = $exe['surg_id'];
		$surg_details = $this->get_surgery_details($exe['surg_id']);
		$this->surgery_name = $surg_details['surg_name'];
		$all_docs = $this->get_docs($this->log_id);
		$this->docs = $all_docs;
		$this->log_id = $exe['log_id'];
		
		$con->close();
	}
	function add_comments($data)
	{
		// $all_docs = implode(",",$this->all_docs);
		$query = "update surgery_log set comments = concat('<br>$data<br>',comments) where log_id = '$this->log_id'";
		// print_r($query);
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$result = $con->query($query);

		$con->close();
		return $result;
	}
	function get_comments($data)
	{
		// $all_docs = implode(",",$this->all_docs);
		$query = "select * from surgery_log where log_id = '$this->log_id'";
		// print_r($query);
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$result = $con->query($query);
		$exe = $result->fetch_array();
		$con->close();
		return $exe['comments'];
	}
	function stop_procedure($data)
	{
		// $all_docs = implode(",",$this->all_docs);
		$query = "update surgery_log set status = 1 where log_id = '$this->log_id'";
		// print_r($query);
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$result = $con->query($query);
		$con->close();
		return 1;
	}
	function get_docs($log_id)
	{
		$query = "select * from surg_docs where log_id = '$this->log_id'";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$result = $con->query($query);
		$re = [];
		while ($exe = $result->fetch_assoc()) {
			
			$name = staff::get_doctor($exe['doc_id']);
			$re[] = "Dr. ".$name['f_name']." ".$name['l_name']." (".$name['speciality'].") ";
		}
		$con->close();
		$this->all_docs_names	= $re;		

		return $re;
	}
	function store_doc($doc_id)
	{
		$query = "insert into surg_docs (log_id,doc_id) value ('$this->log_id','$doc_id')";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$result = $con->query($query);
		$con->close();
		return $result;
	}
	function add_medicine($medicine)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		foreach ($medicine as $key => $value) {

			$query = "insert into medicine_used (medicine_id,reg_id,qty,is_op) values ($value->id,'$this->reg_id',$value->qty,1)";
			$msg= $con->query($query);
		}
		$con->close();

	}
	function get_medicines()
	{
		$query = "select * from medicine_used mu join medicines m on mu.medicine_id = m.id where reg_id = '$this->reg_id' and is_op = 1 ";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$result = $con->query($query);
		$re = [];
		while ($exe = $result->fetch_assoc()) {
			$re[] = $exe;
		}
		$con->close();
		return $re;

	}

}