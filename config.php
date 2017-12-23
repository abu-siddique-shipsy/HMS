<?php

ini_set('display_errors', 0);
define("DBHOST", "localhost:3306");
define("DBUSER", "test1");
define("DBPASS", "test1");
define("DBNAME", "hospital");
define("root",__DIR__); 
define("root1","c:/xampp/htdoc/hospital"); 

define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);


define("domain","http://hospital.localhost:8080"); 
define("controller",domain."/Common/");
define("patientDetails",domain."/Common/patient_details.php");
define("patientDetails1",domain."/Common/patient_details1.php");
define("pharmacy",domain."/Common/pharmacy.php");
define("Class_path",root."\classes\\");
define("ConsultantDetails",domain."/Common/consultant_details.php");
define("med_price",domain."/Common/med_price.php");
define("update_op",domain."/Common/update_op.php");
define("biller",domain."/Common/biller.php");
define("inpatient",domain."/Common/inpatient.php");


?>
