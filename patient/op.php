<?php

include __DIR__.'/../config.php';
include root.'/assets/bootstrap.php';
include root.'/Common/header.php';
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
.container-fluid{
		margin-right: 180px;
	}
</style>
<div class="right_not_pan">
	<h4>Patients in Waiting Hall</h4>
	<br><br>
	<div class="waiting">
		
	</div>
	
</div>
<div id="medicine" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
        	<table class="table" >
        		<thead id="pres_table">
        			<th>Medicine Name</th>
        			<th>Morning</th>
        			<th>Afternoon</th>
        			<th>Night</th>
        			<th>Total Days</th>
        			<th></th>
        		</thead>
        		<tbody>
        		<tr>
        		<td><select class="form-control" id="med_nam">
        			<option>Medicine Name</option>
        			<?php while ($exe = $result->fetch_assoc()) {
        				echo "<option value=".$exe['id'].">".$exe['medicine_name']."</option>";
        			}

        			?>
        		</select>
        		<p id="price"></p></td>
        	
        	
        		
        			<td><input type="number" class="form-control" id="mor" placeholder="qty"></td>
        		
        		
        			<td><input type="number" class="form-control" id="aft" placeholder="qty"></td>
        		
        		
        			<td><input type="number" class="form-control" id="nig" placeholder="qty"></td>
        			<td><input type="number" class="form-control" id="day" placeholder="Days"></td>
        			<td><button class="btn btn-default" id="add_med">Add</button></td>
        		</tr>
        		</tbody>
        	
        		
        			
        	</table>	
        	
        	
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
			        		<th>Morning</th>
			        		<th>Afternoon</th>
			        		<th>Night</th>
			        		<th>Total Days</th>
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
			        		<th>Morning</th>
			        		<th>Afternoon</th>
			        		<th>Night</th>
			        		<th>Total Days</th>
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
<div class="container-fluid">
<div class="row">
	<!-- <div class="col-sm-4" style="text-align: center;">
		<button class="btn btn-default big-button" data-toggle="modal" data-target="#test">Assign Test</button>

	</div> -->
	<div class="col-sm-4  ">
		<div class="panel panel-default">
		  	<div class="panel-body patient">
		  		<div class="form-group">
					<input type="text" class="form-control" name="name" placeholder="Registration ID" id="pat_id">
					<label id="alert"></label>
					<div class="row">
						<div class="col-md-6">
							<button type="button" class="form-control" onclick="get_details_with_register_number($('#pat_id').val())">Registration ID</button>
						</div>
						<div class="col-md-6">
							<button type="button" class="form-control" onclick="get_details_with_patient_id($('#pat_id').val())">Patient ID</button>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
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
	<!-- <div class="col-sm-2">
		<button type="button" class="btn btn-default big-button" data-toggle="modal" data-target="#pres">Total Prescribed</button>
	</div> -->
</div>
<div class="row">
	<div class="col-md-1" id="reg_buttons">
		<button class="btn btn-default">test</button>
		<button class="btn btn-default">test</button>
		<button class="btn btn-default">test</button>
		<button class="btn btn-default">test</button>
		<button class="btn btn-default">test</button>
	</div>
	<div class="col-md-11" id="navs">
		<ul class="nav nav-tabs">
	        <li id="complaintTab1"><a  href="#complaintTab" data-toggle="tab">Complain</a></li>
	        <li id="investTab1"><a href="#investTab" data-toggle="tab">Investigation</a></li>
	        <li id="diagTab1"><a href="#diagTab" data-toggle="tab">Diagnosis</a></li>
	        <li id="newTicketTab1"><a  href="#presTab" data-toggle="tab">Prescription</a></li>
	        <li id="adviceTab1"><a href="#adviceTab" data-toggle="tab">Advice</a></li>
	        <li id="labTab1"><a href="#labTab" data-toggle="tab">Lab Tests</a></li>
	        <li id="vitTab1"><a  href="#newticket" data-toggle="tab">Vitals</a></li>
	        <li id="bilTab1"><a  href="#bilTab" data-toggle="tab">Billing</a></li>
    	</ul>
    	<div class="tab-content" >
            <div id="complaintTab" class="tab-pane pad">
            	
            </div>
            <div id="investTab" class="tab-pane pad">
            	
            </div>
            <div id="diagTab" class="tab-pane pad">
            	
            </div>
            <div id="adviceTab" class="tab-pane pad">
            	
            </div>
            <div id="presTab" class="tab-pane pad">
            	
            </div>
            <div id="labTab" class="tab-pane pad">
          
            </div>
            <div id="bilTab" class="tab-pane pad">
          
            </div>
         </div>
         <button type="button" class="btn btn-default pull-right" id="save_all">Save</button>
	</div>
</div>


<div id="history_modal" class="modal fade" role="dialog">
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- <div style="text-align: center; margin-bottom: -40px; ">
	<button class="btn btn-default" data-toggle="modal" data-target="#history_modal">Click of History</button>
</div>
<div class="row">
	<div class="col-sm-12 pad">
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
</div>
 -->
<script type="text/javascript">
$(document).ready(function(){
	$('#reg_buttons').hide();
	$('#navs').hide();
	var currentReg = 0;
	var amt = 0;
	var type = 0;
	var price = 0;
	var total = 0;
	var row = "";
	var row1 = "";
	var medicines = [];
	var reg_id = 0;
	var tests = [];
	// get_waiting_list();
	// $('#pat_id').on('change',function(){
	// 	value = $(this).val();
		

		
	// });	
	
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
		var morn = $('#mor').val();
		var aft = $('#aft').val();
		var nig = $('#nig').val();
		var days = $('#day').val();

		

		console.log(total);
		var name = $('#med_nam').find("option:selected").text();
		if(days != "" && name != ""){
			qty = (parseInt(morn)+parseInt(aft)+parseInt(nig))*days;
		  	medicines.push({'id' : $('#med_nam').val(), 'morning' : morn , 'afternoon' : aft,'night' : nig,'days':days , 'qty' : qty});
			total += parseInt(qty)*parseInt(price);
			 row += "<tr><td>"+name+"</td><td>"+morn+"</td><td>"+aft+"</td><td>"+nig+"</td><td>"+days+"</td></tr>";
			 var tot = "<tr><td>Total Amt:</td><td>"+total+"</td>";
		}
	 	$('.med').html(row+tot);
	});
	$('#save_pres').on('click',function(){
		if(medicines.length && window.reg_id){
		$.ajax({
		  url: '<?php echo update_op; ?>',
		  method : 'post',
		  dataType : 'json',
		  data: {'medicines' : JSON.stringify(medicines) , 'reg_id' : window.reg_id},
		  success: function(response) {
			
		  	alert("Added Success");
		  	rowq = "";
			  	for(var i = 0; i< response.data.length ; i++)
			  	{
					rowq += "<tr><td>"+response.data[i].medicine_name+"</td><td>"+response.data[i].morning+"</td><td>"+response.data[i].afternoon+"</td><td>"+response.data[i].night+"</td><td>"+response.data[i].days+"</td><td>"+response.data[i].on_date+"</td></tr>";
			  	}
			  	$('.med_pres').html(rowq);
		  }
		 });
		}
		else{alert("Please Add Medicines");}
	});
	$('#save_all').on('click',function(){
		var diag = $('#diag_text').val();
		var inv = $('#investigation_text').val();
		var advice = $('#advice_text').val();
		var nxt_vist = $('#nxt_vist').val();
		var complaint = $('#complaint_text').val();

		var data = {'complaint': complaint,'diagnosis' : diag, 'investigation' : inv, 'advice' : advice,'next_visit' : nxt_vist,'attented_by': <?php echo $_SESSION['userId'];?>}
		$.ajax({
		  url: '<?php echo update_op; ?>',
		  method : 'post',
		  dataType : 'json',
		  data: {'data' : JSON.stringify(data) , 'reges_id' :window.reg_id },
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
			 row1 += "<tr><td>"+test_name+"</td></tr>";
			 // var tot = "<tr><td>Total Amt:</td><td>"+total+"</td>";
			 $('.tst').html(row1);
		}
	 	
	});
	$('#save_test').on('click',function(){
		// console.log(medicines);
		if(tests.length && window.reg_id){
		$.ajax({
		  url: '<?php echo update_op; ?>',
		  method : 'post',
		  dataType : 'json',
		  data: {'tests' : JSON.stringify(tests) , 'reg_id' : window.reg_id , 'doc_id': <?php echo $_SESSION['userId'];?>},
		  success: function(response) {
			tests = [];
		  	alert("Added Success");
		  	
		  }
		 });
		}
		else{alert("Please Add tests");}
	});
	$(document).on('click','.reg_button',function(){
		currentReg = $(this).val();
		getAllDetails(currentReg);
	});

});
function get_waiting_list(reg_id)
{
	$.ajax({
		  url: '<?php echo patientDetails1; ?>',
		  method : 'post',
		  dataType : 'json',
		  data: {'waiting_list' : 1},
		  success: function(response) {
			
		  	console.log(response);
		  	
		  }
		 });
}
function get_details_with_patient_id(value)
{
	$.ajax({
      url: '<?php echo patientDetails1; ?>',
      method : 'post',
      dataType : 'json',
      data: {'get_last_reg': 1 ,'pat_id' : value},
      success : function(response){
      	reg_id = response.data.registration_id;
      	get_details_with_register_number(reg_id);

      }
  });
		
}
function get_details_with_register_number(value)
{
	$('#reg_buttons').show();
	window.reg_id = value;
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
			  		
			  		for(var i = 0 ; i< 5 ; i++)
			  		{
			  			$('#alert').html("");
			  			if(response.complaint[i])
			  				options +='<button class="btn btn-default reg_button" value="'+response.complaint[i].registration_id+'">Visit No '+response.complaint[i].registration_id+'</button>'
			  			
			  			
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
			  		$('#reg_buttons').html(options);	
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
						rowq += "<tr><td>"+response.data[i].medicine_name+"</td><td>"+response.data[i].morning+"</td><td>"+response.data[i].afternoon+"</td><td>"+response.data[i].night+"</td><td>"+response.data[i].days+"</td><td>"+response.data[i].on_date+"</td></tr>";
				  	}
				  	$('.med_pres').html(rowq);
				}
			  }
			 });
		  }		

		});
}
function getAllDetails(value)
{
	$.ajax({
		url: '<?php echo patientDetails; ?>',
		method : 'post',
		dataType : 'json',
		data: {'patient_id' : value, 'complaint' : 1,'single' :1},
		success: function(response) {
			$('#navs').show();
			window.reg_id = response.complaint.registration_id;
			addComplaint(response.complaint.complaint);
			addInvestigation(response.complaint.investigation);
			addDiagnosis(response.complaint.diagnosis);
			addPrescription();
			addAdvice(response.complaint.advice,response.complaint.next_visit);
			addLabTest(window.reg_id);
			genBill(window.reg_id);
			// addVitals(response.complaint.complaint);
		}
	});
}
function addLabTest(reg_id)
{
	var text = '<table id="labTables"></table>';
	text += '<button class="btn btn-default" data-toggle="modal" data-target="#test">Assign Test</button>';
	$('#labTab').html(text);
	$.ajax({
		url: '<?php echo patientDetails1; ?>',
		method : 'post',
		dataType : 'json',
		data: {'labRequest' : reg_id},
		success: function(response) {
			if(response.data.length){
			$('#labTables').DataTable({
	        "data": response.data,
	        "destroy": true,
	        "columns": [
	        	{"title":"Request ID","data": "req_id", "orderable": false},
	        	{"title":"Procedure Name", "data": "procedure_name", "orderable": false },
	        	{"title":"Prescribed Doctor", "data": "name", "orderable": true },
	        	{"title":"Status", "data": "status", "orderable": false },
	        	{"title":"Result", "data": "result", "orderable": false },
	        	{"title":"Result Value", "data": "result_value", "orderable": false },
	        ],
	        language: {
	            searchPlaceholder: "Search records"
	        },
	        order: [
	            [0, 'desc']
	        ],
	        "searching": false
	    	});
			}
		}
	});

}
function addPrescription()
{
	var text = '<div class="row"><div class="col-sm-4" style="text-align: center;">'
	text = '<button class="btn btn-default" data-toggle="modal" data-target="#medicine">CLICK TO ADD PRESCRIPTION</button></div><div class="col-sm-2"><button type="button" class="btn btn-default" data-toggle="modal" data-target="#pres">Total Prescribed</button></div></div>';
	$('#presTab').html(text);
}
function addComplaint(data)
{
	var text = '<textarea id="complaint_text" value="">'+data+'</textarea>';
	$('#complaintTab').html(text);
}
function addInvestigation(data)
{
	var text = '<textarea id="investigation_text" value="">'+data+'</textarea>';
	$('#investTab').html(text);	
}
function addDiagnosis(data)
{
	var text = '<textarea id="diag_text" value="">'+data+'</textarea>';
	$('#diagTab').html(text);
}
function addAdvice(data,nxt_vist)
{
	var text = '<textarea id="advice_text" value="">'+data+'</textarea><input class="form-control" type="date" id="nxt_vist" value="'+nxt_vist+'">';
	$('#adviceTab').html(text);
}
function genBill(reg_id)
{
	var text = '<table class="table table-hover" id="amt1"></table>';
	$('#bilTab').html(text);
    $('.item').html("");
    $.ajax({
      url: '<?php echo biller ?>',
      method : 'post',
      dataType : 'json',
      data: {'gen_bil' : 1 , 'reg_num' : reg_id},

      success: function(response) {
        var data = "<tbody>";
        var data1 = "";
        payments = response.data;
        for(var i = 0; i < response.data.length ; i++)
        {
            if(response.data[i].total)
            {
                data1 = "<tr><td>Total</td><td>"+response.data[i].total+"</td>";
            }    
            else
            {
            	if(response.data[i][1])
            	{
	                data += "<tr>";
	                data +="<td>"+response.data[i][1]+"</td>";
	                data +="<td>"+response.data[i][2]+"</td>";
	                data +="<td>"+response.data[i][3]+"</td>";
	                data +="<td>"+(response.data[i][4] == "1"?"Paid":"Not Paid")+"</td>";
	                data += "</tr>"; 
	            }
            }
            

        }   
        data1 += "</tbody>";    
        $('#amt1').append(data+data1); 
        
        
      }
    });
}
</script>
<!-- "The Amount of $amt for Registration Id $rid is already Charged. Do you want to charge Again?"; -->
<!-- "The Amount of $amt for Registration Id $rid is Successfully Charged"; -->
<!-- "The Amount of $amt for Registration Id $rid is Not Charged. Try Again or contact admin."; -->