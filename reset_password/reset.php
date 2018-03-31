<?php
require __DIR__.'/../config.php';
require root.'/assets/bootstrap.php';
// require root.'/assets/style.php';

$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
$token = $_GET['token'];
// print_r($token);die;
$query = "select * from users where token = '$token'";
$result = $DBcon->query($query);

$exe = $result->fetch_array();

?>
<link rel="stylesheet" type="text/css" href="../assets/style.css">
<style type="text/css">
body{
    background-image: url("../assets/imgs/books.jpg");
/* The image used */
}
label{
	color: white;
}
i{
	color: white;
}
</style>

<div class="container">
	<div class="row">
		<form>
		  <div class="form-group">
		    <label for="email">Email address:</label>
		    <input name="email" class="form-control" id="email" value="<?php echo $exe['email'];?>" disabled>
		  </div>
		  <div class="form-group">
		    <label for="email">User Name:</label>
		    <span id="usr_res"></span>
		    <input name="username" class="form-control" id="uname">
		  </div>
		  <div class="form-group">
		    <label for="pwd">Password:</label>
		    <input name="password" type="password" class="form-control" id="pwd">
		  </div>
		  <div class="form-group">
		    <label for="pwd">Confirm Password:</label>
		    <input name="password" type="password" class="form-control" id="pwd1">
		  </div>
		  <div class="row">
		  	<button id="submit" type="button" class="btn btn-default" disabled>Submit</button>
		  	<div class="pull-right">
		  		<a href="../login/login.php" disabled>Click to Login</a>
		  	</div>
		  </div>
		</form>
		<label id="result_add"></label>
		
	</div>
	
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#pwd1').on('keyup',function(){
			if($('#pwd').val() == $('#pwd1').val())
			{
				$('#submit').removeAttr('disabled');	
			}
			else
			{
				$('#submit').attr('disabled',true);	
			}
		});
		$('#uname').on('keyup',function(){
			$.ajax({
				  url: "add_user.php",
				  method : 'post',
				  dataType: 'JSON',
				  data: { 'check_uname' : $('#uname').val()},
				  success:function(response){
				  	  if(response.result)
					  	$('#usr_res').html('<i class="glyphicon glyphicon-ok"><label>User Name OK</label></i>')
					  else
					  {
					  	$('#usr_res').html('<i class="glyphicon glyphicon-remove"><label>Username Taken</label></i>')
					  }
					}
				});
		});
		$('#submit').on('click',function(){
			$.ajax({
				  url: "add_user.php",
				  method : 'post',
				  data: {'email' : $('#email').val() , 'pwd' : $('#pwd1').val() , 'uname' : $('#uname').val()}
				}).done(function(response) {
					if(response)
				  		{
				  			$('#result_add').html("done");	
				  			$('#login_link').removeAttr('disabled');
				  		}
				  	else 
				  		$('#result_add').html("NOT UPDATED PLEASE CONTACT ADMIN");	
				});
		});
	});
</script>