<?php

include __DIR__.'\..\config.php';
include root.'\assets\bootstrap.php';
include root.'\Common\header.php';
$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
$query = "select * from medicines";
$result = $DBcon->query($query);
$query1 = "select * from lab_procedures";
$result1 = $DBcon->query($query1);
// print_r();
?>
<style type="text/css">
td{
	font-size: 20px;
}
</style>

<div id="medicine" class="modal fade" role="dialog">
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
	        	<div>
	        		<div class="row">
			        	<div class="col-md-5 head">
			        		<label>HMS SOLUTIONS</label>
			        	</div>
			        	<div class="col-md-5 col-md-offset-2">
			        		<label>Report #<span>125</span></label><br>
			        		<label>Created By<span><?php echo $_SESSION['userSession'];?></span></label><br>
			        		<label>Created at<span><?php echo date('Y-M-d');?></span></label><br>
			        	</div>
			        </div>
			        	
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="save_pres">Save</button>
      </div>
    </div>

  </div>
</div>
<div id="test" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Assign Test</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-sm-4">
        		<select class="form-control" id="test_nam">
        			<option selected disabled>Test Name</option>
        			<?php while ($exe1 = $result1->fetch_assoc()) {
        				echo "<option value=".$exe1['procedure_id'].">".$exe1['procedure_name']."</option>";
        			}
        			?>
        		</select>
        		<p id="price"></p>
        	</div>
        	<div class="col-sm-4">
        		<button class="btn btn-default" id="add_test"> Add</button>
        			
        		
        	</div>
        </div>
        <div class="row">
        	<div class="col-sm-12">
	        	<div>
	        		
			        	
			        <table class="table">
			        	<thead>
			        		<th>Name</th>
			 
			        	</thead>
			        	<tbody class="tst">
			        		
			        	</tbody>
			        </table>
	        	</div>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="save_test">Save</button>
      </div>
    </div>

  </div>
</div>
<div id="out_pat" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Alert !</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
        	<label> The Entered ID is out Patient </label>
        </div>	
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Go Back</button>
        <button type="button" class="btn btn-default" onclick="javascript: window.location.href = '/patient/inpatient.php'">Go to Inpatient</button>
      </div>
    </div>

  </div>
</div>
<div id="pres" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Prescribed Medicines</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-sm-12">
	        	<div>
	        		<div class="row">
			        <table class="table">
			        	<thead>
			        		<th>Name</th>
			        		<th>Prescriped On</th>
			 
			        	</thead>
			        	<tbody class="med_pres">
			        		
			        	</tbody>
			        </table>
			    </div>
	        	</div>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="response" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-body">
        <div class="row">
        	<div class="col-sm-12">
	        	<div class="response_msg">
	        		
	        	</div>
	        	<div class="response_button" style="text-align: center;">
					<button class="btn btn-default" id="yes" style="display: none">Yes</button>	        		
	        	</div>
	        	
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div class="row">
	<div class="col-sm-4" style="text-align: center;">
		<button class="btn btn-default big-button" data-toggle="modal" data-target="#test">Assign Test</button>

	</div>
	<div class="col-sm-4  ">
		<div class="panel panel-default">
		  	<div class="panel-body patient">
		  		<div class="form-group">
					<input type="text" class="form-control" name="name" placeholder="Registration ID" id="pat_id">
					<label id="alert"></label>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-2">
		<button type="button" class="btn btn-default big-button" data-toggle="modal" data-target="#pres">Total Prescribed</button>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
		  	<div class="panel-body">
		  		<table class="table table-hover">
				<thead>
					<th>Name</th>
					<th>DOB</th>
					<th>Sex</th>
					<th>Complaint</th>
				</thead>
				<tbody>

					<tr id="pat_details">
						
					</tr>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
		
<div class="row">
	<div class="col-sm-3 pad">
		<div class="panel panel-default">
		  	<div class="panel-body">
		  		<div class="form-group">
					<label>History</label>

					<table class="table">
						<thead>
							<th>Complaint</th>
							<th>Date</th>
						</thead>
						<tbody id="history">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-9 pad">
		<div class="panel panel-default">
		  	<div class="panel-body">
		  		<table class="table table-hover">
				<thead>
					<th>Diagnosis</th>
					<th>Investigation</th>
					<th>Medicines</th>
					<th>Advice</th>
					<th>Next Visit</th>
				</thead>
				<tbody>

					<tr>
						<td><input class="form-control" type="text" id="diag"></td>
						<td><input class="form-control" type="text" id="inves"></td>
						<td><button class="btn btn-default" data-toggle="modal" data-target="#medicine">CLICK TO ADD PRESCRIPTION</button></td>
						<td><input class="form-control" type="text" id="advice"></td>
						<td><input class="form-control" type="date" id="nxt_vist"></td>
					</tr>
				</tbody>
				</table>
				<button type="button" class="btn btn-success" id="submit" >Submit</button>
			</div>
		</div>
	</div>

</div>

<script type="text/javascript">
$(document).ready(function(){
	var amt = 0;
	var type = 0;
	var price = 0;
	var total = 0;
	var row = "";
	var medicines = [];
	var reg_id = 0;
	var tests = [];

	$('#pat_id').on('change',function(){
		value = $(this).val();
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
		  		if(response.is_inp == "0")
		  		{

			  		var options = "";
			  		var result = "";
			  		reg_id = value;
			  		for(var i = 0 ; i< response.complaint.length ; i++)
			  		{
			  			$('#alert').html("");
			  			options += "<tr>"
			  			options += "<td>"+response.complaint[i].complaint+"</td>"
			  			options += "<td>"+response.complaint[i].on_date+"</td>"
			  			options += "</tr>"
			  		}
			  		for(var i = 0 ; i< response.data.length ; i++)
			  		{
			  			
			  			
			  			// result += "<tr>";	
			  			result += "<td>"+response.data[i].name+"</td>";
						result += "<td>"+response.data[i].dob+"</td>";
						result += "<td>"+response.data[i].sex+"</td>";
						result += "<td>"+response.now_complaint+"</td>";
						// result += "<td>"+response.data[i].last_visit+"</td>";
			  			// result += "</tr>";	
			  		}
			  		// head += result + "</tbody></table>"
			  		$('#history').html(options);	
			  		$('#pat_details').html(result);	
			  	}
			  	else
			  	{
			  		$('#out_pat').modal('show');	
			  	}
		  	}
		  	$.ajax({
			  url: '<?php echo update_op; ?>',
			  method : 'post',
			  dataType : 'json',
			  data: {'reg_id': reg_id},
			  success: function(response) {
			  	rowq = "";
			  	if(response.data)
			  	{
				  	for(var i = 0; i< response.data.length ; i++)
				  	{
						rowq += "<tr><td>"+response.data[i].medicine_name+"</td><td>"+response.data[i].on_date+"</td></tr>";
				  	}
				  	$('.med_pres').html(rowq);
				}
			  }
			 });
		  }		

		});

		
	});	
	
	$('#med_nam').on('change',function(){
		var med_name = $(this).val();
		$.ajax({
		  url: '<?php echo med_price; ?>',
		  method : 'post',
		  dataType : 'json',
		  data: {'med_id' : med_name},
		  success: function(response) {
		  	price = response.data.price;
		  	$('#price').html("$"+price);
		  }
		 });
		
	});
	$('#add_med').on('click',function(){
		var qty = $('#qty').val();
		$('#qty').val("");

		console.log(total);
		var name = $('#med_nam').find("option:selected").text();
		if(qty != "" && name != ""){
		  	medicines.push({'id' : $('#med_nam').val(), 'qty' : qty});
			total += parseInt(qty)*parseInt(price);
			 row += "<tr><td>"+name+"</td><td>"+qty+"</td></tr>";
			 var tot = "<tr><td>Total Amt:</td><td>"+total+"</td>";
		}
	 	$('.med').html(row+tot);
	});
	$('#save_pres').on('click',function(){
		// console.log(medicines);
		if(medicines.length && reg_id){
		$.ajax({
		  url: '<?php echo update_op; ?>',
		  method : 'post',
		  dataType : 'json',
		  data: {'medicines' : JSON.stringify(medicines) , 'reg_id' :reg_id},
		  success: function(response) {
			
		  	alert("Added Success");
		  	rowq = "";
			  	for(var i = 0; i< response.data.length ; i++)
			  	{
					rowq += "<tr><td>"+response.data[i].medicine_name+"</td><td>"+response.data[i].on_date+"</td></tr>";
			  	}
			  	$('.med_pres').html(rowq);
		  }
		 });
		}
		else{alert("Please Add Medicines");}
	});
	$('#submit').on('click',function(){
		var diag = $('#diag').val();
		var inv = $('#inves').val();
		var advice = $('#advice').val();
		var nxt_vist = $('#nxt_vist').val();

		var data = {'diagnosis' : diag, 'investigation' : inv, 'advice' : advice,'next_visit' : nxt_vist,'attented_by': <?php echo $_SESSION['userId'];?>}
		$.ajax({
		  url: '<?php echo update_op; ?>',
		  method : 'post',
		  dataType : 'json',
		  data: {'data' : JSON.stringify(data) , 'reges_id' :reg_id },
		  success : function(response){
		  	responsed(response);
		  }
		});
	});
	$('#yes').on('click',function(){
		var Repeat_transact;
		Repeat_transact = {charged_by : <?php echo $_SESSION['userId'];?> , 'amt' : amt , 'reg_id' : reg_id};

		$.ajax({
		  url: '<?php echo update_op; ?>',
		  method : 'post',
		  dataType : 'json',
		  data: { 'Repeat_transact' : JSON.stringify(Repeat_transact) },
		  success : function(response){
		  	responsed(response);
		  }
		});
	});
	function responsed(response)
	{
		var response_text = "";
	  	var buttons = "";
	  	amt = response.add_amt.amt;
	  	if(response.add_amt.result == 1)
	  	{
	  		response_text="<lable>The Amount of "+response.add_amt.amt+" for Registration Id "+response.add_amt.registration_id+" is already Charged. Do you want to charge Again?</label>";
	  		$('#yes').css('display','inline');
	  		
	  	}
	  	else if(response.add_amt.result == 2)
	  	{
	  		response_text="<lable>The Amount of "+response.add_amt.amt+" for Registration Id "+response.add_amt.registration_id+"Successfully Charged </label>";
	  		
	  	}
	  	else if(response.add_amt.result == 3)
	  	{
	  		response_text="<lable>The Amount of "+response.add_amt.amt+" for Registration Id "+response.add_amt.registration_id+" is Not Charged. Try Again or contact admin.</label>";
	  		
	  	}
	  	else
	  	{
	  		response_text="<lable>ERROR Contact </label>";
	  		
	  	}
	  	$('.response_msg').html(response_text);
	  	// $('.response_button').html(buttons);
	  	$('#response').modal('show');
	}
	$('#add_test').on('click',function(){
		// var qty = $('#qty').val();
		// $('#qty').val("");

		// console.log(total);
		var test_name = $('#test_nam').find("option:selected").text();
		if(test_name != "Test Name"){
		  	tests.push({'id' : $('#test_nam').val()});
			 row += "<tr><td>"+test_name+"</td></tr>";
			 // var tot = "<tr><td>Total Amt:</td><td>"+total+"</td>";
			 $('.tst').html(row);
		}
	 	
	});
	$('#save_test').on('click',function(){
		// console.log(medicines);
		if(tests.length && reg_id){
		$.ajax({
		  url: '<?php echo update_op; ?>',
		  method : 'post',
		  dataType : 'json',
		  data: {'tests' : JSON.stringify(tests) , 'reg_id' :reg_id , 'doc_id': <?php echo $_SESSION['userId'];?>},
		  success: function(response) {
			
		  	alert("Added Success");
		  	
		  }
		 });
		}
		else{alert("Please Add tests");}
	});

});
</script>
<!-- "The Amount of $amt for Registration Id $rid is already Charged. Do you want to charge Again?"; -->
<!-- "The Amount of $amt for Registration Id $rid is Successfully Charged"; -->
<!-- "The Amount of $amt for Registration Id $rid is Not Charged. Try Again or contact admin."; -->