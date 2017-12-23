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
$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
$query = "select * from medicines";
$result = $DBcon->query($query);
?>
<link rel="stylesheet" type="text/css" href="../assets/style.css">
<div id="pres" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Prescription</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-4">
            <select class="form-control" id="med_nam">
              <option>Medicine Name</option>
              <?php while ($exe = $result->fetch_assoc()) {
                echo "<option value=".$exe['id'].">".$exe['medicine_name']."</option>";
              }

              ?>
            </select>
            <p id="price"></p>
          </div>
          <div class="col-sm-4">
            <input type="number" class="form-control" id="qty" placeholder="qty">
              
            
          </div>
          <div class="col-sm-4">
            <button class="btn btn-default" id="add_med"> Add</button>
              
            
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
                
              <table class="table">
                <thead>
                  <th>Name</th>
                  <th>Qty</th>
       
                </thead>
                <tbody class="med">
                  
                </tbody>
              </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="save_pres">Save</button>
      </div>
    </div>

  </div>
</div>
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
			<label class="head">Raise Requests</label>
      <br><br>
			<div class="row">
        <div class="col-md-6">
          <button class="btn btn-default full-btn" data-toggle="modal" data-target="#pres">Medicine</button>
        </div>
        <div class="col-md-6">
          <button class="btn btn-default full-btn">Store</button>
        </div>
        

      </div>
      <hr>
      <table class="requirements table">
        
      </table>

		</div>
	  </div>
	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){
  var log_id = <?php print_r($operation->log_id); ?>;
  var total = 0;
  var medicines = [];
	get_details(<?php echo $operation->reg_id?>);
  req_list(log_id);
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
  $('#add_med').on('click',function(){
    var qty = $('#qty').val();
    $('#qty').val("");
    var name = $('#med_nam').find("option:selected").text();
    var row = "";
    if(qty != "" && name != ""){
        medicines.push({'id' : $('#med_nam').val(), 'qty' : qty});
      total += parseInt(qty)*parseInt(price);
       row += "<tr><td>"+name+"</td><td>"+qty+"</td></tr>";
       var tot = "<tr><td>Total Amt:</td><td>"+total+"</td>";
    }
    $('.med').html(row);
  });
  $('#save_pres').on('click',function(){
    // console.log(medicines);
    if(medicines.length && reg_id){
    $.ajax({
      url: '<?php echo controller."cont.theatre.php";?>',
      method : 'get',
      dataType : 'json',
      data: {'medicine_request' : JSON.stringify(medicines) , 'log_id' :log_id},
      success: function(response) {
        medicines = [];
        $('.med').html("");   
        construct_medicine_request_list(".requirements",response);
      }
     });
    }
    else{alert("Please Add Medicines");}
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
    function construct_medicine_request_list(label,response)
    {
      var data = "";
      for(var i = 0 ; i < response.data.length ; i++)
      {
        var btn_class = "default";
        var btn_name = "Request Sent";
        var disabled = "disabled";
        if(response.data[i].status == 1){
          var btn_class = "success";
          var btn_name = "Dispatched, Click if Received";
          var disabled = "";
        }
        else if(response.data[i].status == 2) {
          var btn_class = "default";
          var btn_name = '<span class="glyphicon glyphicon-ok"></span>';
          var disabled = "";
        }
        data += "<tr>";
        data += "<td>"+response.data[i].medicine_name+"</td>"  
        
        data += "<td><button class='med_click btn btn-"+btn_class+"' "+disabled+" value='"+response.data[i].medicine_id+"'>"+btn_name+"</button></td>";
        data += "</tr>";
      }
      $(label).html(data);
    }
    function req_list(log_id)
    {
      $.ajax({
      url: '<?php echo controller."cont.theatre.php";?>',
      method : 'get',
      dataType : 'json',
      data: {'req_list': 1,'log_id' :log_id},
      success: function(response) {
        medicines = [];
        $('.med').html("");
        construct_medicine_request_list(".requirements",response);
      }
     });
    }
</script>