
<?php

include __DIR__.'\..\config.php';
include root.'\assets\bootstrap.php';
include root.'\Common\header.php';
// session_start();

?>
<style type="text/css">
body{
	background-image: url(../assets/imgs/panel_img.jpg);
}
</style>

<?php
$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
if(isset($_GET['email']))
{
	$email = $_GET['email'];
	$query = "select * from users urs join staff stf on stf.staff_id = urs.id join staff_personal_info spi on spi.staff_id = urs.id join staff_type_map stp on stp.type_id = stf.staff_type where urs.email = '$email'";
	$result = $DBcon->query($query);	
	$exe = $result->fetch_array();
	$query1 = "select * from departments dpt join staff stf on stf.staff_id = dpt.manager_id where dpt.dept_id = '$exe[dept_id]'";
	// print_r($query1);
	$result1 = $DBcon->query($query1);	
	$exe1 = $result1->fetch_array();
	// print_r($exe1);
?>
	<div class="container">
		<div class="row">
			<div class="col-md-12" style="text-align: center;">
				<h2 class="prof_head"><?php print_r($exe['name']); ?></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<table class="table">
					<tr><td>ID</td><td><?php print_r($exe['id']); ?></td></tr>
					<tr><td>Date Of Birth</td><td><?php print_r($exe['dob']); ?></td></tr>
					<tr><td>Contact Number</td><td><?php print_r($exe['contact_num']); ?></td></tr>
					<tr><td>Alternate Number</td><td><?php print_r($exe['add_contact_num']); ?></td></tr>
					<tr><td>Address</td><td><?php print_r($exe['first_line_add']."<br>".$exe['zip']."<br>".$exe['city']."<br>".$exe['state']); ?></td></tr>
				</table>
			</div>
			<div class="col-md-6">
				<table class="table">
					<tr><td>User Role</td><td><?php print_r($exe['staff_type_name']); ?></td></tr>
					<tr><td>Department Name</td><td><?php print_r($exe1['dept_name']); ?></td></tr>
					<tr><td>Reporting Manager</td><td><?php print_r($exe1['f_name']." ".$exe1['m_name']." ".$exe1['l_name']); ?></td></tr>
				</table>
			</div>
		</div>
	</div>
<?php
}
?>