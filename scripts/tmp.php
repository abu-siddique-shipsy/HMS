<?php
ini_set('max_execution_time', 300000);
include 'PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = PHPExcel_IOFactory::load("rn1.xlsx");

$objPHPExcel->setActiveSheetIndex(0);
$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$result1 = [];
$i = 0;
$keys_array = [];
// print_r($sheetData);die;
foreach($sheetData as $key => $value)
{
	if($key == 1) continue;

	$url = "https://npiregistry.cms.hhs.gov/api/?number=".$value['A'];
	// print_r($url);
	$curl = curl_init();
	curl_setopt_array($curl, array(
    		CURLOPT_RETURNTRANSFER => 1,

    		CURLOPT_URL => $url
	));
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);
	curl_setopt($curl, CURLOPT_CAINFO, "C:/xampp/php/extras/ssl/cacert.pem");
	$result = json_decode(curl_exec($curl));
	// var_dump($result);
	$response = new stdClass();
	if($result->result_count == 1){	
		$response->npi = ($result->results[0]->number);
		$response->authorized_official_first_name = $result->results[0]->basic->authorized_official_first_name;
		$response->authorized_official_last_name = $result->results[0]->basic->authorized_official_last_name;
		// $response->authorized_official_name_prefix = $result->results[0]->basic->authorized_official_name_prefix;
		$response->authorized_official_telephone_number = $result->results[0]->basic->authorized_official_telephone_number;
		$response->authorized_official_title_or_position = $result->results[0]->basic->authorized_official_title_or_position;
		$response->organization_name = $result->results[0]->basic->name;
		foreach ($result->results[0]->taxonomies as $k => $val) {
				$code = 'code'.$k;
				$desc = 'Description '.$k;
				$response->$code = $val->code;
				$response->$desc = $val->desc;
		}
		
	    foreach ($response as $k => $v) {
	    	if (!in_array($k, $keys_array)) {
	    		$keys_array[] = $k;	
	    	}
	    	
	    }	
		$result1[] = $response;	
	}
	if ($key > 10) {
		break;
	}

	
	
}
 // print_r($result1);
	header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=NPI.csv');
    $output = fopen('php://output', 'w');
    
    fputcsv($output, $keys_array);

    if (count($result1) > 0) {
        foreach ($result1 as $row) 
        {
            fputcsv($output, (array)$row);
        }
    }
?>
