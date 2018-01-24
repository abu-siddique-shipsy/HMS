<?php
include __DIR__.'/../config.php';
include 'cont.reportheader.php';

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
		
	</div><br>

	<div class="row">
		<div class="col-md-12">
			<h3>Hello <b><?php echo $profile->name ?></b>,</h3>	
		</div>
		
	</div>
	<div class="row">
		<div class="col-md-offset-1 col-md-11">
			<h4>Your appointment has been fixed on <?php echo $profile->at_date ?> at <?php echo $profile->at_time ?> for the complaint "<?php echo $profile->complaint ?>" with Dr. <?php echo $profile->l_name ?></h4><br>
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
