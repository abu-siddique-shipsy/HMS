<?php

require __DIR__.'/../config.php';
// include Class_path.'class.amount.php';
include Class_path.'class.pharmacy.php';
class mailer{
	function registration($reg_id)
	{
		$query = "Select pt.name as pat_name,pt.email as pat_email, stf.email as doc_email,reg.time from registration reg join patient pt on pt.id = reg.patient_id left join staff stf on stf.staff_id  = reg.consultant_id where reg.registration_id = '$reg_id'";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$result = $con->query($query);
		$data = $result->fetch_assoc();
		$headers  = 'MIME-Version: 1.0' . "\r\n";
    	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     
    	$msg = "Hello $data->pat_name, <br>
    			Your Registration is successful.<br> 
    			Your Booking Has been Confirmed at $data->time <br>
    			Please be 5 mins before time.<br>";
    	
    	$mail_result = mail($data->pat_email,"Welcome to HMS",$msg,$headers);
    	if ($mail_result) {
    		$mail_result = mail($data->doc_email,"Welcome to HMS",$msg,$headers);
    	}
    	return $mail_result;
	}

}