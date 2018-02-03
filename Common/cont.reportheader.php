<?php
include __DIR__.'/../config.php';
include root.'/assets/bootstrap.php';

$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
$id = $_GET['reg_id'];?>
<script type="text/javascript">
	window.reg_id = <?php echo $id; ?>;
</script>
<?php
$hospital_query = "SELECT * from hosp_details limit 1";
$hospital_result = $con->query($hospital_query);
$hospital = $hospital_result->fetch_object();
$profile_query = "SELECT * from patient pt join registration rg on rg.patient_id = pt.id join staff stf on stf.staff_id = rg.consultant_id join registration_flow rf on rf.registration_id = rg.registration_id where rg.registration_id = $id group by pt.id";
$profile_result = $con->query($profile_query);
$profile = $profile_result->fetch_object();
// $doc_query = "SELECT concat('DR. ',l_name) as Doctor,at_time as Appointment_Time FROM registration rg join staff stf on stf.staff_id = rg.consultant_id where rg.registration = $id";
// $doc_result = $con->query($doc_query);
// $doc = $doc_result->fetch_object();
?>
<title><?php echo strtoupper($hospital->name); ?></title>
<link rel="stylesheet" type="text/css" href="/../assets/report.style.css">
<div class="container">
	<div class="row">
		<div style="float: left">
			<img src="<?php echo domain.$hospital->logo ?>" width="350" height="150">
		</div>
		<div style="float: right" >
			<h1><?php echo strtoupper($hospital->name); ?></h1>
			<p><?php echo $hospital->address_1stline ?></p>	
			<h4><?php echo $hospital->address_country ?></h4>	
		</div>
	</div>
</div>
