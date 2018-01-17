<?php
include __DIR__.'/../config.php';
include root.'/assets/bootstrap.php';

$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
$id = $_GET['reg_id'];
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
	<div class="row">
		
			<table class="tb">
				<tbody>
				<tr><td><label>Name  </label></td><td><?php echo $profile->name ?></td></tr>
				<tr><td><label>Age  </label></td><td><?php echo (date('Y') - date('Y',strtotime($profile->dob))) ?></td></tr>
				<tr><td><label>Gender  </label></td><td><?php echo $profile->sex ?></td></tr>
				<tr><td><label>Email  </label></td><td><?php echo $profile->email ?></td></tr>
				</tbody>	
	<!-- <tr><td><label>Complaint  </label></td><td><?php echo $profile->complaint ?></td></tr>
	<tr><td><label>Appointment  </label></td><td><?php echo date('Y-m-d')." ".$profile->at_time; ?></td></tr> -->
				
			</table>
		
	</div><br>

	<div class="row">
		<div class="col-md-12">
			<h3>Hello <b><?php echo $profile->name ?></b>,</h3>	
		</div>
		
	</div>
	<div class="row">
		<div class="col-md-offset-1 col-md-11">
			<h4>Your appointment has been fixed on <?php echo date('Y-m-d') ?> at <?php echo $profile->at_time ?> for the complaint "<?php echo $profile->complaint ?>" with Dr. <?php echo $profile->l_name ?></h4><br>
			<h4>If you are not able to make it up to the appointment please call us and reschedule it 24 hours before the appointment for more convienient time.</h4>
			
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h4 style="float: left">Sincerely<br>
				The Staff and Physicians at<br>
			<?php echo $hospital->name ?></h4>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	window.print();
});
</script>
