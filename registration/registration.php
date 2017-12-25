<?php

include __DIR__.'/../config.php';
include root.'/assets/bootstrap.php';
include root.'/Common/header.php';
// session_start();
$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);

$query = "select urs.name,urs.email,urs.role from users urs";
$result = $DBcon->query($query);



?>
<style type="text/css">
body{
    /*background-image: url("../assets/imgs/bgimage.jpg");*/
/* The image used */
}
</style>
<div id="get_access_details" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Accessable Screens</h4>
      </div>
      <div class="modal-body">

        <div id="screens" style="padding: 20px;">
        	
        </div>
      </div>
      <div class="modal-footer">
      	<label id="screen_result"></label>
        <button type="button" class="btn btn-success" id="add_screens">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="panel panel-default">	
			<div class="panel-body">
				<div class="col-md-4">
					<h4>Welcome, <?php echo $_SESSION['userSession'];?></h4>
					<button class="btn btn-success" data-toggle="modal" data-target="#Add_User" id="add_usr">ADD USER</button>
				</div>
				
				
				
			</div>
		</div>
	</div>
	<div class="row">
		<?php while($exe = $result->fetch_assoc()){?>
		
		<button class="panel box-card" onclick="javascript: window.location.href = '<?php echo domain."/View/user_details.php?email=$exe[email]";?>'">
			<label>Name:<span><?php echo $exe['name']?></span></label><br>
			<label>Email:<span class="email"><?php echo $exe['email']?></span></label><br>
			<label>User Type:<span><?php echo $exe['role']?></span></label><br>
			<label><a class="btn btn-link alter" id="edit">Edit</a></label>
			<label><a class="btn btn-link alter" id="delete">Delete</a></label><br>
		</button>
		<?php }?>
		
	</div>
	<!-- <div class="row">
		<form action="../login/logout.php" method="GET">
			<button class="btn btn-success" name='logout' >LOG OUT</button>
		</form>
	</div> -->
	<div id="Add_User" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add Users <span class="staff_id"></span></h4>
	      </div>
	      <div class="modal-body">
	        <div class="row">
	        	<div class="col-md-2">
        			<input type="text" class="form-control" id="title" placeholder="Title">
        		</div>
	        	<div class="col-md-3">
        			<input type="text" class="form-control" id="fname" placeholder="First Name">
        		</div>
        		<div class="col-md-3">
        			<input type="text" class="form-control" id="mname" placeholder="Middle Name">
        		</div>
        		<div class="col-md-3">
        			<input type="text" class="form-control" id="lname" placeholder="Last Name">
        		</div>
    	
	        		
		    </div>
		    <br>
		    <div class="row">
		        <div class="col-md-6">	
					<select class="form-control" id="type_user">
						<option value="0" selected disabled>Select User Type</option>
				  </select>
				 </div>
				 <div class="col-md-6">	
				 	<input placeholder="Date Of Birth" class="form-control" type="text" onfocus="(this.type='date')"  id="dob"> 
				 </div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-4">	
					<input type="email" class="form-control" placeholder="Email Id" id="email">
				</div>
				<div class="col-md-4">	
					<select class="form-control" id="dept_name">
						
					</select>
				</div>
				<div class="col-md-4">	
					<select class="form-control" id="ct_type">
						<option selected disabled>Contract Type</option>
						<option value="1">Employment</option>
						<option value="2">Contract</option>
					</select>
				</div>
			</div>
	        	
	        	
	        </div>
	      
	      <div class="modal-footer">
	      	
	      	<button type="button" class="btn btn-default" id="add_staff_into_db">Add</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>
</div>
<div id="add_staff_contact" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Contact Information for id :<span class="staff_id"></span></h4>
	      </div>
	      <div class="modal-body">
	        <div class="row">
	        	<div class="col-md-12">
        			<input type="text" class="form-control" id="1stline" placeholder="First Line of Address"><br>
        		
	        	
        			<input type="text" class="form-control" id="zip" placeholder="Zip Code"><br>
        		
        		
        			<input type="text" class="form-control" id="city" placeholder="City"><br>
        		
        		
        			<input type="text" class="form-control" id="state" placeholder="State"><br>
        			<input type="text" class="form-control" id="contact" placeholder="Contact Number"><br>
        			<input type="text" class="form-control" id="contact_add" placeholder="Additional Contact Number"><br>
        		</div>
    	
	        		
		    </div>
		  </div>  
	      <div class="modal-footer">
	      	
	      	<button type="button" class="btn btn-default" id="back_staff">Back</button>
	      	<button type="button" class="btn btn-default" id="add_contact_into_db">Add</button>
	        
	      </div>
	    </div>

	  </div>
	</div>
<div id="doc_clinic_det" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Clinic Information for id :<span class="staff_id"></span></h4>
	      </div>
	      <div class="modal-body">
	        <div class="row">
	        	<div class="col-md-12">
        			<input type="text" class="form-control" id="doc_1stline" placeholder="First Line of Address"><br>
        		
	        	
        			<input type="text" class="form-control" id="doc_zip" placeholder="Zip Code"><br>
        		
        		
        			<input type="text" class="form-control" id="doc_city" placeholder="City"><br>
        		
        		
        			<input type="text" class="form-control" id="doc_state" placeholder="State"><br>
        			<input type="text" class="form-control" id="doc_contact" placeholder="Contact Number"><br>
        			<!-- <input type="text" class="form-control" id="contact_add" placeholder="Additional Contact Number"><br> -->
        		</div>
    	
	        		
		    </div>
		  </div>  
	      <div class="modal-footer">
	      	
	      	<button type="button" class="btn btn-default" id="back_staff">Back</button>
	      	<button type="button" class="btn btn-default" id="add_clinic_into_db">Add</button>
	        
	      </div>
	    </div>

	  </div>
	</div>
	<div id="doc_qualification" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Qualication Information for id :<span class="staff_id"></span></h4>
	      </div>
	      <div class="modal-body">
	        <div class="row">
	        	<div class="col-md-12">
        			<input type="text" class="form-control" id="qual" placeholder="Qualication"><br>
        		
	        	
        			<input type="text" class="form-control" id="spec" placeholder="Speciality"><br>
        		
        		
        			<input type="text" class="form-control" id="fee" placeholder="Fees"><br>
        			<select class="form-control" id="share_type">
        				<option selected disabled value="-1">Select Share Type</option>
        				<option value="0">Amount</option>
        				<option value="1">Percentage</option>

        			</select>
        		
        			
        			
        			<!-- <input type="text" class="form-control" id="contact_add" placeholder="Additional Contact Number"><br> -->
        		</div>
    	
	        		
		    </div>
		  </div>  
	      <div class="modal-footer">
	      	
	      	<button type="button" class="btn btn-default" id="back_staff">Back</button>
	      	<button type="button" class="btn btn-default" id="add_qual_into_db">Add</button>
	        
	      </div>
	    </div>

	  </div>
	</div>
<!-- Modal -->
<div id="all_update_success" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <label>All Update Success</label><br>
        <label class="name"></label><br>
        <label class="email"></label><br>
        
      </div>
      <div class="modal-footer">
      	<label id="result_add"></label>
        <button type="button" class="btn btn-default" id="send_mail">Send Registration Mail</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var fname = "";
		var mname = "";
		var lname = "";
		var dob = "";
		var email = "";
		var title = 0;
		var type = 0;
		var ct_type = 0;
		var dept = 0;
		var id = 0;
		
		$('.alter').on('click',function(){
			if(event.currentTarget.id == "delete")
			{
				var result = $(this).parent().parent().find('.email').text();
				$.ajax({
				  url: "update_user.php",
				  method : 'post',
				  data: {'del_email' : result}
				}).done(function(response) {
					if(response)
				  	{
				  		location.reload();
				  	}	
				  	 
				  		
				});	
			}
		


		});
		$('#add_usr').on('click',function(){
			$.ajax({
		  	url: "<?php echo controller.'admin.php'; ?>",
		  	method : 'post',
		  	dataType : 'json',
		  	data: {'get_staff_type': 1},
		  	success:function(data){
		  		console.log(data);
		  		data = data.data;
		  		if(data)
		  		{
		  			var content="";
		  			for (var i = 0; i < data.length; i++) {
		  				content = '<option value="'+data[i].type_id+'">'+data[i].staff_type_name+'</option>';
		  				$('#type_user').append(content);

		  			}
		  			
		  		
			  	}
			  }
			
			});
			$.ajax({
		  	url: "<?php echo controller.'admin.php'; ?>",
		  	method : 'post',
		  	dataType : 'json',
		  	data: {'get_dept': 1},
		  	success:function(data){
		  		console.log(data);
		  		data = data.data;
		  		if(data)
		  		{
		  			var content="<option value='0'>Select Department</option>";
		  			for (var i = 0; i < data.length; i++) {
		  				content += '<option value="'+data[i].dept_id+'">'+data[i].dept_name+'</option>';
		  				
		  			}
		  			$('#dept_name').html(content);
		  		
			  	}
			  }
			
			});
		});
		$('#add_staff_into_db').on('click',function(){
			 fname = $('#fname').val();
			 mname = $('#mname').val();
			 lname = $('#lname').val();
			 dob = $('#dob').val();
			 email = $('#email').val();
			 title = $('#title').val();
			 type = $('#type_user').val();
			 ct_type = $('#ct_type').val();
			 dept = $('#dept_name').val();
			 if(lname != "" && email != "" && ct_type && dept && type)
			 {
			 	details = {'f_name': fname,'m_name': mname,'l_name': lname,'dob':dob,'email':email,'emp_type':ct_type , 'dept_id' : dept ,'staff_type' : type};
				$.ajax({
				  	url: "<?php echo controller.'admin.php'; ?>",
				  	method : 'post',
				  	dataType : 'json',
				  	data: {'create_staff': 1 , 'data' : JSON.stringify(details)},
				  	success:function(response){
				  		// console.log(response);
				  		if(response.data)
				  		{

				  			$('#Add_User').modal('hide');
				  			$('.staff_id').html(response.data);
				  			id = response.data;
				  			get_screens(type);
				  			$('#get_access_details').modal('show');
				  			// $('#add_staff_contact').modal('show');
				  			
				  		}
					  }
					
					}); 	
			 }
			
		});
		$('#back_staff').on('click',function(){
			$('#add_staff_contact').modal('hide');
			$('#Add_User').modal('show');
				  			// $('.staff_id').html(response.data);
			
		});
		$('#add_contact_into_db').on('click',function(){
			 
			
			 	details = {'id': id, 'first_line_add': $('#1stline').val() , 'state' : $('#state').val() , 'city' : $('#city').val() , 'zip': $('#zip').val() , 'contact_num' : $('#contact').val() , 'add_contact_num' : $('#contact_add').val()};
				$.ajax({
				  	url: "<?php echo controller.'admin.php'; ?>",
				  	method : 'post',
				  	dataType : 'json',
				  	data: {'create_contact': 1 , 'data' : JSON.stringify(details)},
				  	success:function(response){
				  		// console.log(response);
				  		if(response.data)
				  		{
				  			
				  			
				  			$('#add_staff_contact').modal('hide');
				  			if (type == 10) 
				  			{
				  				$('#doc_clinic_det').modal('show');
				  			}
				  			else
				  			{
				  				$('#all_update_success').modal('show');
				  			}
				  			
				  		}
					  }
					
					}); 	
			 
			
		});
		$('#send_mail').on('click',function(){
			name = fname + " " + mname + " " + lname;
			data = {'id': id,'name' :  name, 'email' : email , 'type' : type};
			
			if (name == "" || email == "") 
			{
				$('#result_add').html("Please Enter the Details");
			}
			else
			{
				$('#result_add').html("Processing...");	
				$.ajax({
				  url: "update_user.php",
				  method : 'post',
				  data: {'send_mail' : 1 , 'data' : JSON.stringify(data)}
				}).done(function(response) {
					if(response)
				  		$('#result_add').html("Account Created, Mail Sent to User");	
				  	else 
				  		$('#result_add').html("NOT UPDATED PLEASE CONTACT ADMIN");	
				});
			}
			
		});
		$('#add_clinic_into_db').on('click',function(){
			 
			
			 	details = {'id': id, 'first_line_add': $('#doc_1stline').val() , 'state' : $('#doc_state').val() , 'city' : $('#doc_city').val() , 'zip': $('#doc_zip').val() , 'contact' : $('#doc_contact').val() };
				$.ajax({
				  	url: "<?php echo controller.'admin.php'; ?>",
				  	method : 'post',
				  	dataType : 'json',
				  	data: {'create_clinic': 1 , 'data' : JSON.stringify(details)},
				  	success:function(response){
				  		// console.log(response);
				  		if(response.data)
				  		{
				  			$('#doc_clinic_det').modal('hide');
				  			
				  			$('#doc_qualification').modal('show');
				  			
				  			
				  		}
					  }
					
					}); 	
			 
			
		});
		$('#add_qual_into_db').on('click',function(){
			 
			
			 	details = {'id': id, 'qualification': $('#qual').val() , 'speciality' : $('#spec').val() , 'fee_share' : $('#share_type').val() , 'fee': $('#fee').val()};
				$.ajax({
				  	url: "<?php echo controller.'admin.php'; ?>",
				  	method : 'post',
				  	dataType : 'json',
				  	data: {'update_qualification': 1 , 'data' : JSON.stringify(details)},
				  	success:function(response){
				  		// console.log(response);
				  		if(response.data)
				  		{
				  			$('#doc_qualification').modal('hide');
				  			
				  			$('#all_update_success').modal('show');
				  			
				  			
				  		}
					  }
					
					}); 	
			 
			
		});
		function get_screens(type)
		{
			$.ajax({
			  url: "<?php echo controller.'admin.php'; ?>",
			  method : 'post',
			  dataType : 'json',
			  data: {'get_screens_with_access': type },
			  success:function(data){
			  	console.log(data);
			  	data = data.data;
			  	if(data)
			  	{
			  		var content = "";
			  		for(var i = 0; i< data.length ; i++)
			  		{
			  			if(data[i].selected.toLowerCase() == "yes")
			  			{
			  				content += '<label class="checkbox"><input type="checkbox" class="screen_names" value="'+data[i].screen_id+'" checked>'+data[i].screen_name+'</label>'
			  			}
			  			else
			  				content += '<label class="checkbox"><input type="checkbox" class="screen_names" value="'+data[i].screen_id+'">'+data[i].screen_name+'</label>'
			  		}
			  		$('#screens').html(content);
			  		
			  	}
			  }
				
			});		
		}
		$('#add_screens').on('click',function(){
		selected_screens = get_all_screens();
		update_access(selected_screens);

		});
		function get_all_screens()
		{
			var  all_screens = []
			$('.screen_names:checkbox:checked').each( function() { 
		        
		        all_screens.push( $(this).val() );

		    });
			
			return all_screens;
		}
		function update_access(screens)
		{

			$.ajax({
			  url: "<?php echo controller.'admin.php'; ?>",
			  method : 'post',
			  dataType : 'json',
			  data: {'update_screens_for_staff': JSON.stringify(screens) ,'staff_id' : id},
			  success:function(data){
			  	if(data)
			  	{
					$('#screen_result').html('Addition Successful');
					$('#get_access_details').modal('hide');
				  	$('#add_staff_contact').modal('show');
			  		
			  	}
			  	else
			  		$('#screen_result').html('Addition Failed');
			  }
				
			});		
		}
	});


</script>