<?php

require __DIR__.'/../config.php';
// include Class_path.'class.amount.php';
// include Class_path.'class.mailer.php';
// include Class_path.'class.pharmacy.php';
class patient{
	function get_patient_with_reg_id($reg_id)
	{
		$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$id = $reg_id;
		// echo $id;
		
			
		$query = "SELECT pt.id,rg.room_id,rg.is_inp,rg.registration_id as reg_id,id,sex,name,address,phone_number,dob from patient pt join registration rg on rg.patient_id = pt.id where rg.registration_id = $id group by pt.id";
		$result_array= [];
		$result = $DBcon->query($query);
		while ($exe = $result->fetch_assoc()) {
			$result_array = $exe;
		}
		return $result_array;
	}
	function getLabRequests($reg_id)
	{
		$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$id = $reg_id;
		$query = "SELECT lr.req_id,lp.procedure_name,concat(stf.f_name,' ',stf.l_name) as name,lr.result,lr.result_value,lr.min_value,lr.max_value  FROM  lab_requests lr join lab_procedures lp on lp.procedure_id = lr.test_id join staff stf on stf.staff_id = lr.doc_id where reg_id = $id";
		$result_array= [];
		$result = $DBcon->query($query);
		while ($exe = $result->fetch_object()) {
			if($exe->result == null) $exe->status = "Pending";
			else $exe->status = "Completed";
			$result_array[] = $exe;
		}
		return $result_array;
	}

}