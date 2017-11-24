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
		print_r($data);
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		foreach ($data as $key => $value) {
			$query = "UPDATE lab_requests set status = 1,result = '$value->result' ,result_value = '$value->result_value' where reg_id = $reg_id and test_id = $value->test_id ";


			$result = $con->query($query);
			if($result)
			{
				$res = new amountController();
				$res->add_lab_cost($reg_id,$value->test_id);
			}	

		}
		
		return $res;	
	}


}