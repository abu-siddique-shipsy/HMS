<?php

require __DIR__.'/../config.php';
// include Class_path.'class.amount.php';
// include Class_path.'class.mailer.php';
// include Class_path.'class.pharmacy.php';
class laboratory{
	function get_samples($reg_id)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * FROM sample_inventory si join sample_log sl on sl.sample_id = si.sample_id where reg_id = $reg_id and si.qty > 0";
		$result = $con->query($query);
		$re = [];
		while ($exe = $result->fetch_assoc()) {
			$re[] = $exe;
		}
		return $re;
	}
	function get_samples_types()
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * FROM sample_log";
		$result = $con->query($query);
		$re = [];
		while ($exe = $result->fetch_assoc()) {
			$re[] = $exe;
		}
		return $re;
	}
	function get_tests($reg_id)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * FROM lab_requests lq join lab_procedures lp on lq.test_id = lp.procedure_id where reg_id = $reg_id";
		$result = $con->query($query);
		$re = [];
		while ($exe = $result->fetch_assoc()) {
			switch ($exe['status']) {
				case '1':
					$exe['status'] = "Completed";
					break;
				case '2':
					$exe['status'] = "Cancelled";
					break;
				case '0':
					$exe['status'] = "Prescriped";
					break;
			}
			$re[] = $exe;
		}
		return $re;
	}
	function add_samples($data)
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "INSERT INTO sample_inventory (sample_id,reg_id,qty) values ('$data->id','$data->reg_id','$data->qty')";
		$result = $con->query($query);
		return $result;
	}
}