<?php

include __DIR__.'/../config.php';
include root.'/assets/bootstrap.php';
include root.'/Common/header.php';
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
			<div class="col-md-8 pat_det_pan" style="display: none">
				<div class="panel panel-default panel1">
				  	<div class="panel-body">
				  		<table class="table table-hover">
						<thead>
							<th>Name</th>
							<th>Age</th>
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
	<div class="row" id="buttons_div" style="display: none">
		<div class="col-md-12">
				<div class="panel panel-default">
				  	<div class="panel-body" style="padding: 0px !important;">
				  			<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3 center">
				  				<label class="fileContainer btn btn-info">
				  					Upload Image
					  			<input type="file" id="upload_image">
				  				</label>
				  			</div>
				  			<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3">
				  				<button class="btn btn-success" id="show_path" data-toggle="modal" data-target="#pathology">Show Pathology Reports</button>
				  			</div>
				  			<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3">
				  				<button class="btn btn-success" id="show_reports" data-toggle="modal" data-target="#report">Show Reports</button>
				  			</div>
				  			<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3">
				  				<button class="btn btn-warning" id="add_sam" data-toggle="modal" data-target="#sample_modal">Collect Sample</button>
				  			</div>
				  		
				  	</div>
				</div>
			</div>
		</div>
	<div class="row">
		<div class="col-md-12" id="tests" style="display: none">
				<div class="panel panel-default panel1">
				  	<div class="panel-body patient sample">
				  		<table class="table table-hover table-default" id="test_table">
				  			<thead>
				  				<th>Test Name</th>
				  				<th>Adviced On</th>
				  				<th>Status</th>
				  			</thead>
				  			
				  			<tbody id="test_body">

				  			</tbody>
				  			
				  		</table>
				  	</div>
				</div>
		</div>
		<div class="col-md-offset-2 col-md-8" id="sample_div" style="display: none">
				<div class="panel panel-default panel1">
				  	<div class="panel-body patient sample">
				  		<table class="table table-hover table-default" id="sample_table">
				  			<thead>
				  				<th>Sample Name</th>
				  				<th>Collected On</th>
				  				<th>Remaining Quantity</th>
				  				<th></th>
				  				<th></th>
				  			</thead>
				  			
				  			<tbody id="sample_body">

				  			</tbody>
				  			
				  		</table>
				  		
					</div>
				</div>
		</div>
		
		
	</div>	
	
	
</div>
<div id="pathology" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Report</h4>
      </div>
      <div class="modal-body" >
        <div id="path_rep">
        	
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
	        		<th>Procedure Name</th>
	        		<th>Submitted On</th>
	        		<th>Min Value</th>
	        		<th>Max Value</th>
	        		<th>Result</th>
	        		<th>Value</th>
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
<!-- <div class="col-md-8">
					<div class="panel panel-default panel1"  id="resu" style="display: none">
					  	<div class="panel-body patient">
					  		<div class="form-group">
								<button type="button" class="btn" data-toggle="modal" data-target="#report" >View Report</button>
							</div>
						</div>
					</div>
				</div> -->
<div id="submit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      	<div class="row">
			<div class="col-md-12">
		  		<div class="form-group">
					<select class="form-control" id="proc_type">
						<option disabled selected>Select Procedure Type</option>
					</select>
				</div>
					
				</div>
				
			
		</div>
		<div class="row" id="max_val_sample" style="display: none">
        	<div class="col-md-12">
        		<label>Enter Sample Value:</label>
        		<input type="number" id="final_qty_of_sample" class="form-control">
        	</div>
        </div>
        <div class="row" id="max_val" style="display: none">
        	<div class="col-md-12">
        		<label>Enter Max Value:</label>
        		<input type="number" id="max_val_qty" class="form-control">
        	</div>
        </div>
        <div class="row" id="min_val" style="display: none">
        	<div class="col-md-12">
        		<label>Enter Min Value:</label>
        		<input type="number" id="min_val_qty" class="form-control">
        	</div>
        </div>
      	<div class="row" id="resulttt" style="display: none">
        	<div class="col-md-12">
		  		<div class="form-group">
		  			<label for="reslt1" id="res"></label>
					<input type="text" name="result" class="form-control" placeholder="result" id="reslt1">
					<label id="alert"></label>
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
<div id="sample_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      	<div class="row pad">
        	<div class="col-md-6 patient">
		  		<select class="form-control" id="sample_select_box">
		  			<option>Select Sample</option>

		  		</select>
				
			</div>
			<div class="col-md-6 patient">
		  		<input class="form-control" type="number" id="sample_qty" placeholder="Quantity">
				
			</div>
		</div>
		<div style="text-align: center;">
	        <button type="button" class="btn btn-default" data-dismiss="modal" id="sub_sample_mod">Add</button>
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
	var sample_log_id = 0;
	var sample_final_qty = 0;
	$('#add_sam').on('click',function(){
		get_sample_types();
	});
	$('#show_reports').on('click',function(){
		get_reports(reg_id);
	});
	
	$('#sub_sample_mod').on('click',function(){
		var sample = {
			'id' : $('#sample_select_box').val(),
			'qty' : $('#sample_qty').val(),
			'reg_id': reg_id 
		};
		var res = add_sample_data(sample);
		get_samples(reg_id);
	});
	$('#id').on('change',function(){
		reg_id = $(this).val();
		get_samples(reg_id);
		get_tests(reg_id);

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
		  		$('#sample_div').css('display','block');
		  		$('.pat_det_pan').css('display','block');
		  		$('#buttons_div').css('display','block');
		  		$('#tests').css('display','block');
		  		
			  		var options = "";
			  		var result = "";
			  		if(response.data)
			  		{
				  		for(var i = 0 ; i< response.data.length ; i++)
				  		{
				  			result += '<tr>'
				  			result += "<td>"+response.data[i].name+"</td>";
							result += "<td>"+response.data[i].dob+"</td>";
							result += "<td>"+response.data[i].sex+"</td>";
							result += '</tr>'
				  		}
				  		$('#det').html(result);	
				  		$.ajax({
							  url: '<?php echo patientDetails; ?>',
							  method : 'post',
							  dataType : 'json',
							  data: {'get_proc':1,'reg_id' : reg_id},
							  success: function(response) {
							  	var options = "<option>Select Procedure</option>";
							  	for(var i = 0 ; i< response.data.length ; i++)
						  		{
						  			options += "<option value='"+response.data[i].procedure_id+"'>"+response.data[i].procedure_name+"</option>";
						  			
						  		}
							  	$('#proc_type').html(options);
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
	$('#upload_image').on('change',function(){
		var formData = new FormData();
		formData.append('file', $('#upload_image')[0].files[0]);
		formData.append('reg_id', reg_id);
		formData.append('from', 'pathalogy');
		console.log(formData);
		$.ajax({
		       url: "<?php echo controller."cont.lab.php" ?>",
		       type : 'POST',
		       data : formData,
		       processData: false,  // tell jQuery not to process the data
		       contentType: false,  // tell jQuery not to set contentType
		       success : function(data) {
		           console.log(data);
		           // alert(data);
		       }
		});
		console.log($(this).val());
	});
	
	
	$('#proc_type').on('change',function(){
		pro_id = $(this).val();		
		$('#reslt1').val("");
		$('#alert').html("");
		$('#resulttt').css("display","block");
		$('#max_val_sample').css("display","block");
		$('#max_val').css("display","block");
		$('#min_val').css("display","block");

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
			}
		  	
		  }
		});
	});
	$('#reslt1').on('keyup',function(){
		value =parseInt( $(this).val());
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
	$('#max_val_qty').on('keyup',function(){
		max = parseInt($(this).val());
	});
	$('#min_val_qty').on('keyup',function(){
		min = parseInt($(this).val());
	});
	$('#add_res').on('click',function(){
		sample_final_qty = $('#final_qty_of_sample').val();
		test_results = {
			'test_id' : pro_id, 
			'result' : result, 
			'result_value' : value, 
			'min_value' : min,
			'max_value' : max,
			'sample_used' : sample_log_id,
			'sample_used_qty' : sample_final_qty,
		};
		complete_procedure(test_results);
		response = '<tr class="details">';
		response += "<td id='"+pro_id+"'>"+pro_name+"</td>";
		response += "<td>"+result+" <label>value:<span>"+value+"</span></label></td>";
		response += '</tr>';
		$('#rep').append(response);

	});
	$('#show_path').on('click',function(){
		get_all_path_reports();
	});
	
	function complete_procedure(test_results)
	{
		$.ajax({
		  url: "<?php echo patientDetails; ?>",
		  method : 'post',
		  dataType: 'JSON',
		  data: {'test_results' : JSON.stringify(test_results) , 'reg_id' : reg_id},
		  success: function(response) {
		  	if(response.status="success")
			{
				get_samples(reg_id);
			}
		  	
		  }
		});
	}
	function get_all_path_reports()
	{
		$.ajax({
		  url: "<?php echo controller."cont.lab.php"; ?>",
		  method : 'post',
		  dataType: 'JSON',
		  data: {'get_all_path_reports' : 1 , 'reg_id' : reg_id, 'from_rec' : 'pathalogy'},
		  success: function(response) {
		  	if(response.status="success")
			{
				var html = "";
				for(var i = 0;i < response.files.length ; )
				{
					html += '<a href="'+response.path_to_access+'/'+response.files[i].name+'" target="_blank">Report '+(++i)+'</a>  <label> updated on '+response.files[i-1].last_mod+'</label><br>';
					
				}
				$('#path_rep').html(html);
			}
		  	
		  }
		});
	}
	$(document).on('click','.sample_id_use',function(){
		var val = $(this).val();
		var sample_name = [];
		$(this).parent().parent().find('td').each(function(ret){
			sample_name.push($(this).text());
		});
		var sample_string = sample_name[0] + " collected on " + sample_name[1] + " has max " + sample_name[2] ;
		$("#final_qty_of_sample").attr("placeholder", sample_string);
		sample_log_id = val;

	});
	
});

function printDiv(divName) 
{
    var printContents = document.getElementById(divName).innerHTML;     
	var originalContents = document.body.innerHTML;       
	document.body.innerHTML = printContents;      
	window.print();      
	document.body.innerHTML = originalContents;
}
function get_samples(reg_id)
{
	$.ajax({
	  url: "<?php echo controller."cont.lab.php" ?>",
	  method : 'post',
	  dataType: 'JSON',
	  data: {'get_samples' : reg_id},
	  success: function(response) {
	  	if(response.status="success")
		{
			// var html = ""
			// if(!response.data.length)
			// {
			// 	html = "-----------No Sample Available-------------";	
			// }
			for(var i = 0;i < response.data.length ; i++)
			{
				// html += '<tr>';
				// html += '<td>'+response.data[i].sample_name+'</td>'; 
				// html += '<td>'+response.data[i].collected_on+'</td>';
				// html += '<td>'+response.data[i].qty+" "+ response.data[i].units+'</td>';
				response.data[i].use = '<button type="button" class="btn sample_id_use" data-toggle="modal" data-target="#submit" value="'+response.data[i].sample_log_id+'">Use Sample</button>';
				response.data[i].remove = '<button type="button" class="btn sample_id_del" value="'+response.data[i].sample_log_id+'">Remove Sample</button>';
				// html += '</tr>'; 
				
			}
			// $('#sample_body').html(html);
			$("#sample_table").DataTable({
				"data": response.data,
				"destroy": true,
				"columns"     :     [  
					{ "title": "Sample Name",    "data"     :     "sample_name"     },  
		            {"title": "Collected On",     "data"     :     "collected_on"     },  
		            {"title": "Quantity",     "data"     :     "qty"},  
		            {     "data"     :     "use"},  
		            {     "data"     :     "remove"     }

		       ],
		       "pageLength" : 3 
			}).draw();
		}		  	
	  }
	});
}
function get_tests(reg_id)
{
	$.ajax({
	  url: "<?php echo controller."cont.lab.php" ?>",
	  method : 'post',
	  dataType: 'JSON',
	  data: {'get_tests' : reg_id},
	  success: function(response) {
	  	if(response.status="success")
		{
			var html = ""
			if(!response.data.length)
			{
				html = "-----------No Sample Available-------------";	
			}
			for(var i = 0;i < response.data.length ; i++)
			{
				html += '<tr>';
				html += '<td>'+response.data[i].procedure_name+'</td>'; 
				html += '<td>'+response.data[i].at_time+'</td>';
				html += '<td>'+(response.data[i].status)+'</td>';
				html += '</tr>'; 
				
			}
			$('#test_body').html(html);
			$("#test_table").DataTable();
		}		  	
	  }
	});
}
function get_sample_types()
{
	$.ajax({
	  url: "<?php echo controller."cont.lab.php" ?>",
	  method : 'post',
	  dataType: 'JSON',
	  data: {'get_samples_types' : 1},
	  success: function(response) {
	  	if(response.status="success")
		{
			var html = "<option>Select Sample Type</option>"
			if(!response.data.length)
			{
				html = "-----------No Sample Available-------------";	
			}
			for(var i = 0;i < response.data.length ; i++)
			{
				html += '<option value="'+response.data[i].sample_id+'">'+response.data[i].sample_name+'</option>';
			}
			$('#sample_select_box').html(html);
		}		  	
	  }
	});
}
function get_reports(reg_id)
{
	$.ajax({
	  url: "<?php echo controller."cont.lab.php" ?>",
	  method : 'post',
	  dataType: 'JSON',
	  data: {'get_reports' : reg_id},
	  success: function(response) {
	  	if(response.status="success")
		{
			var html = "";
			if(!response.data.length)
			{
				html = "-----------No Sample Available-------------";	
			}
			for(var i = 0;i < response.data.length ; i++)
			{
				if(response.data[i].status == "Completed")
				{
					html += '<tr>';
					html += '<td>'+response.data[i].procedure_name+'</td>'; 
					html += '<td>'+response.data[i].updated_at+'</td>';
					html += '<td>'+response.data[i].min_value+'</td>';
					html += '<td>'+response.data[i].max_value+'</td>';
					html += '<td>'+(response.data[i].result)+'</td>';
					html += '<td>'+(response.data[i].result_value)+'</td>';
					html += '</tr>'; 
				}
			}
			$('#rep').html(html);
		}		  	
	  }
	});
}
function add_sample_data(sample)
{
	$.ajax({
	  url: "<?php echo controller."cont.lab.php" ?>",
	  method : 'post',
	  dataType: 'JSON',
	  data: {'add_samples' : JSON.stringify(sample)},
	  success: function(response) {
	  	get_samples(reg_id);
	  }
	});

}

</script>