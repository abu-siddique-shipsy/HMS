<?php

include __DIR__.'\..\config.php';
include root.'\assets\bootstrap.php';
include Class_path.'class.ot.php';
$response = new stdClass();
if(isset($_GET['log_id']))
{
	$data = $_GET;
	// print_r($data);
	$operation = new ot($data,0);

	// print_r($operation);
}
else if(isset($_POST))
{
	$data = $_POST;
	// print_r($data);
	$operation = new ot($data,1);
	// print_r($operation);
}

?>
<link rel="stylesheet" type="text/css" href="../assets/style.css">

<div class="container-fluid">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-body">
        
        <div class="col-md-12" style="margin-top: 5px;">
        <div class="col-md-4">
            <label>Name:<span id="name"></span></label>
          
        </div>
        <div class="col-md-4">
            <label>DOB:<span id="dob"></span></label>
          
        </div>
        <div class="col-md-4">
            <label>Condition:<span id="complaint"></span></label>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
	<div class="row">
	  <div class="col-md-3">
		<div class="panel left_pan">
			<label class="head">Doctors In Procedure</label>
			<br><br>
			<?php 
				foreach ($operation->all_docs_names as $key => $value) {
				 	echo "<label class='body'>".$value."</label><br>";
				 } 
				
			?>	
		</div>
	  </div>
	  <div class="col-md-6">
		<div class="row">
		  	<div class="panel">
				<label class="head">Details of Procedure</label>
				<br><br>
				<div class="row">
					<div class="col-md-6">
						<label class="body">Procedure Name : <?php print_r($operation->surgery_name);?></label>
					</div>
					
					<div class="col-md-offset-2 col-md-4">
						<button class="btn btn-info" id="start">Start Procedure</button>
						<button class="btn btn-danger" id="stop" style="display: none">Stop Procedure</button>
					</div>
				</div>
			</div>
		</div>		  	
		<div class="row panel comments" style="display: none">
			<input type="text" name="comment" id="comment" class="form-control">
			<button  class="btn btn-info" id="add_comment">Add Comment</button><br>
			<hr>
			<div class="comment">
				
			</div>
		</div>
	  </div>
	  <div class="col-md-3">
	  	<div class="panel left_pan">
			<label class="head">Doctors In Procedure</label>
			<br><br>
			<?php 
				foreach ($operation->docs as $key => $value) {
				 	echo "<label class='body'>".$value."</label><br>";
				 } 
				
			?>	
		</div>
	  </div>
	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){
	get_details(<?php echo $operation->reg_id?>);
	$('#stop').on('click',function(){
		stop_procedure();

	});
	$('#start').on('click',function(){
		$('.comments').css('display','block');
		$('#start').css('display','none');
		$('#stop').css('display','block');
		get_comments();
	});
	$('#add_comment').on('click',function(){
		var comment = $('#comment').val();	
		add_comment(comment);
		$('#comment').val("");
	});

});
	function get_details(value)
    {
      $.ajax({
        url: '<?php echo patientDetails; ?>',
        method : 'post',
        dataType : 'json',
        data: {'patient_id' : value, 'complaint' : 1},
        success: function(response) {
          console.log(response);
          if(!response.data)
          {
            $('#alert').html("Patient Id not available");
          }
          if(response.status == "success")
          {
            if(response.is_inp == "1")
            {

              var options = "";
              var result = "";
              reg_id = value;
              $('#name').html(response.data[0].name);
              $('#dob').html(response.data[0].dob);
              $('#complaint').html(response.now_complaint);  

           
            }
            else
            {
              $('#out_pat').modal('show');  
            }
          }
          
        }   

      });

    }
    function add_comment(value)
    {

      $.ajax({
        url: '<?php echo controller."cont.theatre.php";?>',
        method : 'get',
        dataType : 'json',
        data: {'comment' : value , 'log_id' : '<?php print_r($operation->log_id); ?>'},
        success: function(response) {
          	 if(response.data)
          	 {
          	 	get_comments();
          	 }
          
        }   

      });

    }
    function get_comments()
    {

      $.ajax({
        url: '<?php echo controller."cont.theatre.php";?>',
        method : 'get',
        dataType : 'json',
        data: {'get_comment' : 1 , 'log_id' : '<?php print_r($operation->log_id); ?>'},
        success: function(response) {
          	 if(response.data)
          	 {
          	 	$('.comment').html(response.data);
          	 }
          
        }   

      });

    }
    function stop_procedure()
    {

      $.ajax({
        url: '<?php echo controller."cont.theatre.php";?>',
        method : 'get',
        dataType : 'json',
        data: {'stop_procedure' : 1 , 'log_id' : '<?php print_r($operation->log_id); ?>'},
        success: function(response) {
          	 if(response.data)
          	 {
         		document.body.innerHTML = "<label style='text-align : center;'>Procedure Has Stopped. You may Close the screen</label>"; 	 	
          	 }
          
        }   

      });

    }
</script>