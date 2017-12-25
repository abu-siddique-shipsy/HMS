<?php

include __DIR__.'/../config.php';
include root.'/assets/bootstrap.php';

include root.'/Common/header.php';
// session_start();
$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
$dept = $DBcon->query("select * from departments");
$consul = $DBcon->query("select * from staff where staff_type=10");

?>

<div class="container-fluid">
		<div class="panel panel-default">
		  <div class="panel-heading">Personal Details</div>
		  	<div class="panel-body">
		  		<button type="button" class="btn" value="1" data-toggle="collapse" data-target="#outpatient" id="inpatient">Click For In Patient</button>
		  		<div class="row">

		  			<div class="col-md-5">
		  				<div class="panel panel-info">
						  <div class="panel-heading">Patient </div>
						  	<div class="panel-body">
							  <div class="form-group">
							 	<input type="text" class="form-control" name="name" placeholder="Patient's Name" id="name">
							  </div>
							  <div class="form-group">

							   	<input placeholder="Date Of Birth" class="textbox-n form-control" type="text" onfocus="(this.type='date')"  id="dob"> 
							  </div>
							  <div class="form-group">
							 	<input type="text" class="form-control" name="name" placeholder="Nationality" id="nation">
							  </div>
							  
							  <div class="radio-inline">
								  <label><input type="radio" name="optradio" value="Male">Male</label>
								</div>
								<div class="radio-inline">
								  <label><input type="radio" name="optradio" value="Female">Female</label>
								</div>
								<div class="radio-inline">
								  <label><input type="radio" name="optradio" value="Other">Other</label>
								</div>
								
								<div class="form-group">
								 	<input type="text" class="form-control" name="name" placeholder="Phone Number" id="num">
								  </div>
								<div class="form-group">
								 	<input type="text" class="form-control" name="name" placeholder="Referral Source" id="referral">
								  </div>
								  	
				  			</div>
				  		</div>
				  		
				  	</div>	
				  	<div class="col-md-7">
				  		<div class="panel panel-info">
						  <div class="panel-heading">Address</div>
						  	<div class="panel-body">
						  		<div class="form-group">
								 	<input type="text" class="form-control" name="1stLine" placeholder="First Line of Address" id="1stLine">
								</div>	
								<div class="form-group">
								 	<input type="text" class="form-control" name="1stLine" placeholder="Area of Residence" id="area">
								</div>	
								<div class="form-group">
								 	<input type="text" class="form-control" name="1stLine" placeholder="Postal Code" id="pincode">
								</div>	
								<div class="form-group">
								 	<input type="text" class="form-control" name="1stLine" placeholder="City" id="city">
								</div>	
								<div class="form-group">
								 	<input type="text" class="form-control" name="1stLine" placeholder="Country" id="country">
								</div>	
						  	</div>
						  </div>
						</div>
				  	</div>

					<div class="row">
						<div class="col-md-5">
							<div class="panel panel-info">
							  <div class="panel-heading">To Visit</div>
							  	<div class="panel-body">

						  			<div class="form-group col-md-6">
									 	<input type="text" class="form-control" id="depart" placeholder="Complaint">
									 		
								  	</div>
							  		<div class="form-group col-md-6">
									 	<select class="form-control" id="consul" >
									 		<option>Consultant</option>
									 	</select>
									  </div>
								</div>
							</div>
						</div>
						<div class="col-md-7 collapse" id="outpatient">
							<div class="panel panel-success">
							  <div class="panel-heading">Fill Only for In Patient</div>
							  	<div class="panel-body">

						  			<div class="form-group col-md-3">
									 	<select class="form-control" id="room">
									 		<option>Select Room</option>
									 	</select>
								  	</div>
							  		<div class="form-group col-md-3">
									 	<select class="form-control" id="ctv">
									 		<option>Consultant Incharge</option>
									 		<?php while ($exe=$consul->fetch_assoc()) {
									 			echo '<option value="'.$exe['staff_id'].'">Dr. '.$exe['name'].'</option>';
									 		} ?>
									 	</select>
									</div>
									<div class="form-group col-md-3">
									 	<input type="text" class="form-control" name="1stLine" placeholder="Treatment Required"  id="trt">
								  	</div>
							  		<div class="form-group col-md-3">
									 	<input type="text" class="form-control" name="1stLine" placeholder="Sponsor Authorization" id="auth">
									</div>
								</div>
							</div>
						</div>
					</div>
				
				<div class="row">
					<div class="col-md-12">
						<button class="btn btn-success big-btn" id="form-load" type="button" data-toggle="modal" data-target="#form">Submit</button>
					</div>
				</div>

		  	</div>
		</div>
	
</div>


<div id="form" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
	      	<div class="col-md-12">
			    <form action="update.php" method="GET">
			      	<input type="text" class="form-control" name="name" placeholder="Name" id="name1">
			      	<input type="text" class="form-control" name="dob" placeholder="Date Of Birth" id="dob1">
			      	<input type="text" class="form-control" name="nation" placeholder="Nationality" id="nation1">
			      	<input type="text" class="form-control" name="sex" placeholder="Sex" id="sex1">
			      	<input type="text" class="form-control" name="phnum" placeholder="Number" id="num1">
			      	<input type="text" class="form-control" name="address" placeholder="Address" id="address">  
			      	<input type="text" class="form-control" name="referral" placeholder="Referral" id="referral1">
			      	<input type="text" class="form-control" name="Complaint" placeholder="Department to Visit" id="dept">
			      	<input type="text" class="form-control" name="consultant" placeholder="Consultant Name" id="consultant">
			      	<input type="text" class="form-control" name="room" placeholder="Room Number" id="room1">
			      	<input type="text" class="form-control" name="treatment" placeholder="Treatment" id="treat1">
			      	<input type="text" class="form-control" name="sponser" placeholder="Sponser" id="sponser1">

			      	<button class="big-btn btn-success" >Verify and Submit</button>
			    </form>
	        </div>
	      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var room_details;
	$('#form-load').on('click',function(){
		
		$('#name1').val($('#name').val());
		$('#dob1').val($('#dob').val());
		$('#nation1').val($('#nation').val());
		$('#sex1').val($("input[name='optradio']:checked").val());
		$('#address').val($('#1stLine').val()+","+$('#area').val()+","+$('#city').val()+","+$('#country').val()+","+$('#pincode').val());
		$('#referral1').val($('#referral').val());
		$('#num1').val($('#num').val());
		
		
		$('#dept').val($('#depart').val());
		$('#consultant').val($('#consul').val());
		$('#room1').val($('#room').val());
		$('#treat1').val($('#trt').val());
		$('#sponser1').val($('#auth').val());
	});
	
		
		$.ajax({
		  url: "update.php",
		  method : 'post',
		  dataType: 'JSON',
		  data: {'dept_id' : 1},
		  success: function(response) {
		  	if(response.status="success")
			{
				$('#consul').html("<option selected disabled>Select Doctor</option>");
				for(var i = 0 ; i<response.data.length;i++)
				{
					$('#consul').append('<option value="'+response.data[i].staff_id+'">Dr.'+ response.data[i].name+'</option>');
				}
			}
		  	
		  }
		});
	
	$('#inpatient').on('click',function(){

		$.ajax({
		  url: "update.php",
		  method : 'post',
		  dataType: 'JSON',
		  data: {'get_room' : 'true'},
		  success: function(response) {
		  	if(response.status="success")
			{
				console.log(response);
				$('#room').html("<option selected disabled>Select Room</option>");
				for(var i = 0 ; i<response.data.length;i++)
				{
					$('#room').append('<option value="'+response.data[i].room_id+'">Room Type:'+response.data[i].type_name +'-floor -'+ response.data[i].floor +'</option>');
				}
			}
		  	
		  }
		});
	});
	
	
});


</script>