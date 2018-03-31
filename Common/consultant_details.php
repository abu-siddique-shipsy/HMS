<?php

include __DIR__.'/../config.php';
// include root.'/assets/bootstrap.php';
// include root.'/assets/style.php';
$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
$query = 'select id,concat("Dr. " , f_name, " " , m_name , " " , l_name) as name, email as email ,qualification , speciality as specialization , concat(consulting_hrs_frm , " to " ,consulting_hrs_to) as working_hrs, fee from staff stf join physician phy on phy.id = stf.staff_id where staff_type = 10';
$result_array= [];
$response = new stdClass();
$result = $DBcon->query($query);
while ($exe = $result->fetch_assoc()) {
	$result_array[] = $exe;
	$response->data = $result_array;
}



$response->status = "success";
echo json_encode($response);
?>
