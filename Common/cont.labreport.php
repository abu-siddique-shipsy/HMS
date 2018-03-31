<?php
include __DIR__.'/../config.php';
include 'cont.reportheader.php';
$report_details_query = "SELECT * from lab_requests lr join lab_procedures lp on lp.procedure_id = lr.test_id where reg_id = '$id'";
$report_details_result = $con->query($report_details_query);
$report_details = [];
$report_keys = [];

while($exe = $report_details_result->fetch_object())
{
	$report_details[] = $exe;
}
$report_details_result->data_seek(0);
$exe = $report_details_result->fetch_object();
foreach ($exe as $key => $value) 
{
	$report_keys[] = $key;
}

?>
<div class="container">
	<div class="row">
		
			<table class="tb">
				<tbody>
				<tr><td><label>Name  </label></td><td><?php echo $profile->name ?></td></tr>
				<tr><td><label>Age  </label></td><td><?php echo (date('Y') - date('Y',strtotime($profile->dob))) ?></td></tr>
				<tr><td><label>Gender  </label></td><td><?php echo $profile->sex ?></td></tr>
				<tr><td><label>Email  </label></td><td><?php echo $profile->email ?></td></tr>
				</tbody>	
			</table>
	</div>
	<div class="row">
		<div class="line">
			<h3>REPORT</h3>
			<hr>
			<table class="table">
				<thead>
				<?php foreach ($report_keys as $value) { 
					echo "<th>$value</th>";
				} ?>
				</thead>
				<tbody>
					<?php foreach ($report_details as $value) { 
					echo "<tr>";
						foreach ($value as $val) {
							echo "<td>$val</td>";
						
						}
					echo "</tr>";
				 	} ?>
				</tbody>				
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	// window.print();
});
</script>