<?php

include __DIR__.'\..\config.php';
include root.'\assets\bootstrap.php';
include root.'\Common\header.php';
$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);

$query = "select * from lab_procedures";
$result = $DBcon->query($query);
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-4">
				<div class="panel panel-default panel1">
				  	<div class="panel-body patient">
				  		<div class="form-group">
							<input type="text" class="form-control" name="name" placeholder="Registration Id" id="id">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="panel panel-default panel1">
				  	<div class="panel-body">
				  		<table class="table table-hover">
						<thead>
							<th>Name</th>
							<th>DOB</th>
							<th>Sex</th>
						</thead>
						<tbody id="det">

						</tbody>
						</table>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-4">
				<div class="panel panel-default panel1">
				  	<div class="panel-body patient">
				  		<div class="form-group">
							<select class="form-control" id="proc_type">
								<option disabled selected>Select Procedure Type</option>
								<!-- <?php// while($exe = $result->fetch_assoc()){ 
									//echo '<option value="'.$exe[procedure_id].'">'.$exe[procedure_name].'</option>';
								 } ?> -->
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="panel panel-default panel1"  id="resu" style="display: none">
				  	<div class="panel-body patient">
				  		<div class="form-group">
							<button type="button" class="btn" data-toggle="modal" data-target="#submit">Submit Results</button>
							<button type="button" class="btn" data-toggle="modal" data-target="#report" >View Report</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="report" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Report</h4>
      </div>
      <div class="modal-body" >
        <div class="invoice-box" id="tet">
	        <div class="row">
	        	<div class="col-md-5 head">
	        		<label>HMS SOLUTIONS</label>
	        	</div>
	        	<div class="col-md-5 col-md-offset-2">
	        		<label>Report #<span>125</span></label><br>
	        		<label>Created By<span>Siddique S</span></label><br>
	        		<label>Created at<span><?php echo date('Y-M-d');?></span></label><br>
	        	</div>
	        </div>
	        	
	        <table class="table">
	        	<thead>
	        		<th>Description</th>
	        		<th>Results</th>
	        	</thead>
	        	<tbody id="rep">
	        		
	        	</tbody>
	        </table>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="upt_res_db">Save</button>
        <button type="button" class="btn btn-default" onclick='printDiv("tet");'>Print</button>
      </div>
    </div>

  </div>
</div>
<div id="submit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
      	<div class="row">
        	<div class="col-md-12">
				<div class="panel panel-default ">
				  	<div class="panel-body">
				  		<div class="form-group">
				  			<label for="reslt1" id="res"></label>
							<input type="text" name="result" class="form-control" placeholder="result" id="reslt1">
							<label id="alert"></label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div style="text-align: center;">
	        <button type="button" class="btn btn-default" data-dismiss="modal" id="add_res">Add</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var test_results = [];
	var max = 100;
	var min = 0;
	var pro_id = 0;
	var pro_name = '';		
	var value = 0;
	var result;
	var reg_id =0 ;
	$('#id').on('change',function(){
		reg_id = $(this).val();

		$.ajax({
		  url: '<?php echo patientDetails; ?>',
		  method : 'post',
		  dataType : 'json',
		  data: {'patient_id' : reg_id},
		  success: function(response) {
		  	console.log(response);
		  	if(!response.data)
		  	{
		  		$('#alert').html("Patient Id not available");
		  	}
		  	if(response.status == "success")
		  	{
		  		
			  		var options = "";
			  		var result = "";
			  		// reg_id = value;
			  		// for(var i = 0 ; i< response.complaint.length ; i++)
			  		// {
			  		// 	$('#alert').html("");
			  		// 	options += "<tr>"
			  		// 	options += "<td>"+response.complaint[i].complaint+"</td>"
			  		// 	options += "<td>"+response.complaint[i].on_date+"</td>"
			  		// 	options += "</tr>"
			  		// }
			  		if(response.data)
			  		{
				  		for(var i = 0 ; i< response.data.length ; i++)
				  		{
				  			
				  			
				  			// result += "<tr>";	
				  			result += "<td>"+response.data[i].name+"</td>";
							result += "<td>"+response.data[i].dob+"</td>";
							result += "<td>"+response.data[i].sex+"</td>";
							// result += "<td>"+response.now_complaint+"</td>";
							// result += "<td>"+response.data[i].last_visit+"</td>";
				  			// result += "</tr>";	
				  		}
				  		// head += result + "</tbody></table>"
				  		// $('#history').html(options);	
				  		$('#det').html(result);	
				  		$.ajax({
							  url: '<?php echo patientDetails; ?>',
							  method : 'post',
							  dataType : 'json',
							  data: {'get_proc':1,'reg_id' : reg_id},
							  success: function(response) {
							  	console.log(response);
							  	var options = "";
							  	for(var i = 0 ; i< response.data.length ; i++)
						  		{
						  			options += "<option value='"+response.data[i].procedure_id+"'>"+response.data[i].procedure_name+"</option>";
						  			
						  		}
							  	$('#proc_type').append(options);
								}
							});
				  	}
				  	else
				  	{
				  		$('#det').html("<td>Registration ID not available</td>");		
				  	}
			  	
		  	}
		  }		

		});

		
	});	
	$('#proc_type').on('change',function(){
		pro_id = $(this).val();		
		$('#reslt1').val("");
		$('#alert').html("");
		$('#resu').css("display","block");
		$.ajax({
		  url: "gather_details.php",
		  method : 'post',
		  dataType: 'JSON',
		  data: {'procedure_id' : pro_id},
		  success: function(response) {
		  	if(response.status="success")
			{
				pro_name = response.data.procedure_name;
				$('#res').html(response.data.procedure_name);
				 max = response.data.min_value;
				 min = response.data.max_value;
			}
		  	
		  }
		});
	});
	$('#reslt1').on('keyup',function(){
		value =parseInt( $(this).val());
		console.log(value);
		console.log(max);
		console.log(min);
		if(value >= max || value < min)
		{
			$('#alert').html('<p style="color:red;">Please Inform Doctor Immidiately</p>');
			result = "Abnormal";
		}
		else
		{
			$('#alert').html("Normal Results");
			result = "Normal";
		}
	});
	$('#add_res').on('click',function(){
		test_results.push({'test_id' : pro_id , 'result' : result , 'result_value' : value});
		response = '<tr class="details">';
		response += "<td id='"+pro_id+"'>"+pro_name+"</td>";
		response += "<td>"+result+" <label>value:<span>"+value+"</span></label></td>";
		response += '</tr>';
		$('#rep').append(response);

	});
	$('#upt_res_db').on('click',function(){
		$.ajax({
		  url: "<?php echo patientDetails; ?>",
		  method : 'post',
		  dataType: 'JSON',
		  data: {'test_results' : JSON.stringify(test_results) , 'reg_id' : reg_id},
		  success: function(response) {
		  	if(response.status="success")
			{
				pro_name = response.data.procedure_name;
				$('#res').html(response.data.procedure_name);
				 max = response.data.min_value;
				 min = response.data.max_value;
			}
		  	
		  }
		});
	});
	
});
function printDiv(divName) {

      var printContents = document.getElementById(divName).innerHTML;     
   var originalContents = document.body.innerHTML;       
   document.body.innerHTML = printContents;      
   window.print();      
   document.body.innerHTML = originalContents;
   }

</script>