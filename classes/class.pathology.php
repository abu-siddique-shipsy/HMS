<?php
require __DIR__.'/../config.php';
include Class_path.'class.amount.php';
class pathology{
	function get_procedures($reg_id)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * FROM lab_requests lr join lab_procedures lp on lp.procedure_id = lr.test_id where reg_id = $reg_id and status = 0";
		$result = $con->query($query);

		$re = [];
		while ($exe = $result->fetch_assoc()) {
			$re[] = $exe;
		}
		// print_r($re);
		return $re;
	}
	function update_procedures($reg_id,$data)
	{
		// print_r($data);
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "UPDATE lab_requests set status = 1,result = '$data->result' ,result_value = '$data->result_value', sample_used = '$data->sample_used' , sample_used_qty = '$data->sample_used_qty',min_value = '$data->min_value',max_value = '$data->max_value' where reg_id = $reg_id and test_id = $data->test_id ";
		// print_r($query);

		$result = $con->query($query);
		if($result)
		{
			$res = new amountController();
			$res->add_lab_cost($reg_id,$data->test_id);
		}
		
		return $res;	
	}
	function update_sample_inventory($reg_id,$sample_log_id,$sample_used_qty)
	{
		print_r($data);
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "UPDATE sample_inventory set qty = qty - $sample_used_qty where sample_log_id = $sample_log_id";
		$result = $con->query($query);
		return $res;	
	}


}