<?php

include __DIR__.'\..\config.php';
include root.'\assets\bootstrap.php';
include root.'\Common\header.php';
// session_start();
$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);

$query = "select urs.name,urs.email,urs.role from user_credentials uc join users urs on urs.username = uc.username order by urs.role ASC";
$result = $DBcon->query($query);



?>
<style type="text/css">
body{
    background-image: url("../assets/imgs/bgimage.jpg");
/* The image used */
}
</style>

<div class="container">
	<div class="row">
		<div class="panel panel-default">	
			<div class="panel-body">
				<div class="col-md-4">
					<h4>Welcome, <?php echo $_SESSION['userSession'];?></h4>
				</div>
				<div class="pull-right">
					<button class="btn btn-success" data-toggle="modal" data-target="#Add_User">ADD USER</button>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-default">	
			<div class="panel-body">
				<table class="table table-stripped table-hover">
					<thead>
						<th>Name</th>
						<th>Email</th>
						<th>Role</th>
						<th></th>
						<th></th>
					</thead>
					<tbody>
						<?php while($exe = $result->fetch_assoc()){?>
						<tr>
							<td><?php echo $exe['name']?></td>
							<td class="email"><?php echo $exe['email']?></td>
							<td><?php echo $exe['role']?></td>
							<td><button class="btn btn-link alter" id="edit">Edit</button></td>
							<td><button class="btn btn-link alter" id="delete">Delete</button></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<form action="../login/logout.php" method="GET">
			<button class="btn btn-success" name='logout' >LOG OUT</button>
		</form>
	</div>
	<div id="Add_User" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add Users</h4>
	      </div>
	      <div class="modal-body">
	        <div class="row">
	        	<div class="col-md-4">
	        		<input id="name_user" type="text" name="name" class="form-control" placeholder="Name of User">
	        		
	        	</div>
	        	<div class="col-md-4">
	        		<input id="email_user" type="email" name="email" class="form-control" placeholder="Email of User">
	        		
	        	</div>
	        	<div class="col-md-4">
					  <select class="form-control" id="type_user">
					    <option value="1">Student</option>
					    <option value="2">Staff</option>
					    <option value="3">Admins</option>
					  </select>
	        	</div>
	        	
	        </div>
	      </div>
	      <div class="modal-footer">
	      	<label id="result_add"></label>
	      	<button type="button" class="btn btn-default" id="add_user_into_db">Add</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#add_user_into_db').on('click',function(){
			var name = $('#name_user').val();
			var email = $('#email_user').val();
			var type = $('#type_user').val();
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
				  data: {'name' : name , 'email' : email , 'type' : type}
				}).done(function(response) {
					if(response)
				  		$('#result_add').html("Account Created, Mail Sent to User");	
				  	else 
				  		$('#result_add').html("NOT UPDATED PLEASE CONTACT ADMIN");	
				});
			}
			
		});
		$('.alter').on('click',function(){
			if(event.currentTarget.id == "delete")
			{
				var result = $(this).closest('tr').find('td.email').text();
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
	});
</script>