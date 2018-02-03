<?php

include __DIR__.'/../config.php';
include root.'/assets/bootstrap.php';
include root.'/Common/header.php';
$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
$query = "select * from medicines";
$result = $DBcon->query($query);

?>
<!-- <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css"> -->
<style type="text/css">
	.container{
		margin-right: 180px;
	}
</style>
<div class="right_not_pan">
	<h4>Current Notifications</h4>
	<br><br>
	<div class="requirements">
		
	</div>
	
</div>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-body">
					<button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#external">External</button>
					<button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#internal">Internal</button>
									
				</div>
			</div>
			<button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#add">Add to Inventory</button>
		</div>
		<div class="col-md-8">
			<div class="col-md-12">
			<div class="panel panel-default">	
				<div class="panel-body">
					<table class="table table-stripped table-hover" id="example">
						<thead>
							<tr>
							<th>Medicine Name</th>
							<!-- <th>Inventory</th> -->
							<th>Total Available</th>
							<th>Rate</th>
							</tr>
						</thead>
		<!-- 				<tbody>
							
						</tbody> -->
					</table>
				</div>
			</div>
		</div>
		</div>
	</div>
	
	
</div>
<div id="add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Medicine</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-12">
      			<input type="text" id="grn" placeholder="GRN Number" class="form-control">
      		</div>
      	</div>
      	<div class="row">
      		<div class="col-md-12">
      			<input type="text" id="medi_type" placeholder="Medicine Type" class="form-control">
      		</div>
      	</div>
      	<div class="row">
      		<div class="col-md-12">
      			<input type="text" id="medi_brand" placeholder="Medicine brand" class="form-control">
      		</div>
      	</div>
      	<div class="row">
      		<div class="col-md-12">
      			<input type="text" id="medi_nam" placeholder="Medicine Name" class="form-control">
      		</div>
      	</div>
        <div class="row">
      		<div class="col-md-12">
      			<input type="text" id="quant" placeholder="Quantity" class="form-control">
      		</div>
      	</div>
      	<div class="row">
      		<div class="col-md-12">
      			<input placeholder="Expiry Date" class="form-control" type="text" onfocus="(this.type='date')"  id="exp_date"> 
      		</div>
      	</div>
        
      </div>
      <div class="modal-footer">
      	<label id="alert_med"></label>
      	<button type="button" class="btn btn-default" id="add_med_into_inventory">Add</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="internal" class="modal fade" role="dialog" >
  <div class="modal-dialog" style="width:100%;">

    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Prescription</h4>
      </div>
      <div class="modal-body">
        <div class="row">
			<div class="col-sm-6  ">
				<div class="panel panel-default">
				  	<div class="panel-body patient">
				  		<div class="form-group">
							<input type="text" class="form-control" name="name" placeholder="ID" id="pat_id">
							<label id="alert"></label>
							<div class="row">
								<div class="col-md-6">
									<button type="button" class="form-control" onclick="get_details_with_register_number($('#pat_id').val())">Visit ID</button>
								</div>
								<div class="col-md-6">
									<button type="button" class="form-control" onclick="get_details_with_patient_id($('#pat_id').val())">Patient ID</button>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
			  <div class="col-sm-12 patient" style="display: none" id="det">
				<label>Name: <span id="name1"></span></label><br>
				<label>DOB: <span id="dob1"></span></label><br>
				<label>Regid: <span id="reg1"></span></label><br>
			  </div>	
			</div>
		</div>	
		<div class="row" id="tbls" style="display: none">
        	<div class="col-sm-12">
	        	<div>
	        		<div class="row">
			        <table class="table">
			        	<thead>
			        		<th>Name</th>
			        		<th>Morning</th>
			        		<th>Afternoon</th>
			        		<th>Night</th>
			        		<th>Days</th>
			        		<th>Estimated Qty</th>
			        		<th>Requested Qty</th>	
			        		<th>Expiry Date</th>
			        		<th>Total Available</th>
			        		<th>Total Price</th>

			 
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
        <button type="button" class="btn btn-default" data-dismiss="modal" id="save_pres1">Save</button>
      </div>
    </div>

  </div>
</div>
<div id="external" class="modal fade" role="dialog">
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
<div id="cash" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
      	<div class="pad center-block">
      		<label>Collect amt <span class="collect"></span></label>
      	</div>
      </div> 
    </div>

  </div>
</div>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>   -->
  <!-- <script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>   -->
<script type="text/javascript">
$(document).ready(function() {
	var req_list = [];
	datatable();
	
	function datatable()
	{
    $('#example').DataTable({
    	"ajax"     :     {
    	"url"	   :  	"<?php echo pharmacy; ?>",  
    	"contentType" : "application/json",
    	"method"   :  		"post",
    	"data"	   :  function(){
    			return {'test':1};
    			}

    	  
    	},
    	"columns"     :     [  
                {     "data"     :     "medicine_name"     },  
                {     "data"     :     "total_available"},  
                {     "data"     :     "price"}  
           ],
        
           
    });
    }
    var amt = 0;
	var type = 0;
	var price = 0;
	var total = 0;
	var row = "";
	var medicines = [];
	var reg_id = 0;
	$('#add_med_into_inventory').on('click',function(){
		var to_inventrory = {
			'grn' : $('#grn').val(),
			'type' : $('#medi_type').val(),
			'brand' : $('#medi_brand').val(),
			'name' : $('#medi_nam').val(),
			'qty' : $('#quant').val(),
			'exp' : $('#exp_date').val()
		};
		add_to_inventory(to_inventrory);
	});
	$(document).on('click','.med_save_ot',function(){
		dispatch_ot_meds($(this).val());
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
		
		save(0)
	});
	$('#save_pres1').on('click',function(){
		medicines = addRequested(medicines);
		save(1)
	});
	$('#pat_id').on('change',function(){
		value = $(this).val();
		$.ajax({
		  url: '<?php echo patientDetails; ?>',
		  method : 'post',
		  dataType : 'json',
		  data: {'patient_id' : value, 'complaint' : 1},
		  success: function(response) {
		  	// console.log(response);
		  	if(!response.data)
		  	{
		  		$('#alert').html("Patient Id not available");
		  	}
		  	if(response.status == "success")
		  	{
		  		reg_id = response.data[0].reg_id;
	  			$('#name1').html(response.data[0].name);
	  			$('#dob1').html(response.data[0].dob);
	  			$('#reg1').html(response.data[0].reg_id);
		  		$('#det').css('display','block');
		  		$.ajax({
					  url: '<?php echo pharmacy; ?>',
					  method : 'post',
					  dataType : 'json',
					  data: {'medicine_used_by' : reg_id },
					  success: function(response) {
						window.medicines = response.data;				  
						console.log(medicines);
					  	rowq = "";
					  	for(var i = 0; i< response.data.length ; i++)
					  	{
							rowq += "<tr data-value='"+response.data[i].log_med_id+"'><td>"+response.data[i].medicine_name+"</td><td>"+response.data[i].morning+"</td><td>"+response.data[i].afternoon+"</td><td>"+response.data[i].night+"</td><td>"+response.data[i].days+"</td><td>"+response.data[i].qty+"</td><td><input type='number' class='req_med_qty form-control'></td><td>"+response.data[i].expiry_date+"</td><td>"+response.data[i].total_available+"</td><td>$"+(response.data[i].price)*(response.data[i].qty)+"</td></tr>";
					  	}
					  	$('.med_pres').html(rowq);
					  	$('#tbls').css('display','block');
					  }
					
				});
			  	
		  	}
		  	
			
		  }		

		});

		
	});
	function addRequested(medicines)
	{
		medicines = window.medicines;
		$('.req_med_qty').each(function(){
			log_id = ($(this).parent().parent().data('value'));
			total_requested = $(this).val();
			for (var i = 0; i < medicines.length; i++) 
			{
				if(medicines[i].log_med_id == log_id)
				{
					medicines[i].tot_req = total_requested;	
				}
			}
		});
		window.medicines = medicines;
		return medicines;
	}
	function save(inter)	
	{
		if(medicines.length){
		$.ajax({
		  url: '<?php echo pharmacy; ?>',
		  method : 'post',
		  dataType : 'json',
		  data: {'medicines' : JSON.stringify(medicines) , 'internal' : inter ,'reg_id' : reg_id},
		  success: function(response) {
		  	// alert("Added Success");
		  	$('#example').DataTable().ajax.reload();
			$('.collect').html(response.price);	  	
			$('#cash').modal('show');
		  }
		 });
		}
		else{alert("Please Add Medicines");}
	}
	function dispatch_ot_meds(log_id)	
	{
		if(log_id)
		{
		$.ajax({
		  url: '<?php echo pharmacy; ?>',
		  method : 'post',
		  dataType : 'json',
		  data: {'ot_med_log_id' : log_id},
		  success: function(response) {
		  	$('#example').DataTable().ajax.reload();
		  	// rowq = "";
		  	$(this).parent().find('.resultt').html("dispatched");
			  // 	for(var i = 0; i< response.data.length ; i++)
			  // 	{
					// rowq += "<tr><td>"+response.data[i].medicine_name+"</td><td>"+response.data[i].on_date+"</td></tr>";
			  // 	}
			  // 	$('.med_pres').html(rowq);
		  }
		 });
		}
		else{alert("Please Add Medicines");}
	}
	
    setInterval(function() 
    {
    	$.ajax({
			url: '<?php echo pharmacy;?>',
			method : 'get',
			dataType : 'json',
			data: {'req_list_all': 1,},
			success: function(response) 
			{
				medicines = [];
				$('.med').html("");
				for(var i = 0 ; i < response.data.length ; i++)
				{
					if($.inArray(response.data[i].log_med_id,req_list) == -1)
					{
						req_list.push(response.data[i].log_med_id);
						construct_medicine_request_list(".requirements",response.data[i]);
					}
				}
				
			}
		});
    },5000);
    function construct_medicine_request_list(label,response)
    {
      var data = "";
        data = "<button class='noti ' data-toggle='modal' data-target='#"+response.log_med_id+"''>";
        			
        
        data += "Requested "+response.medicine_name+" from OT</button>";
        $(label).append(data);

        var master = response.medicine_name+" of quantity "+response.qty+ "<br> requested at room number "+response.room.room_id+"<br> on floor number "+response.room.floor_num+"<br> of " +response.room.ward_name+ " ward in<br> block " +response.room.block_name;  
        create_modal(response.log_med_id,master);
      
      
    }
    function create_modal(id,body)
    {
    	data = '<div id="'+id+'" class="modal fade" role="dialog">';
		data +=				  	'<div class="modal-dialog">';

		data +='<!-- Modal content-->';
		data +='<div class="modal-content pharm">';
		data +=		      '<div class="modal-body">';
		data +=		        '<label>'+body+'</label>';
		data +=		      '</div>';
		data +=		      '<div class="modal-footer">';
		data +=		        '<label class="resultt"></label>'
		data +=		        '<button type="button" class="btn btn-default med_save_ot" value="'+id+'" >Dispatch</button>';
		data +=		      '</div>';
		data +=		    '</div>';
		data +=		  '</div>';
		data +=		'</div>';
		$('body').append(data);
    }
    function add_to_inventory(data)
    {
    	$.ajax({
			url: '<?php echo pharmacy;?>',
			method : 'POST',
			dataType : 'json',
			data: {'update_inventory': 1, 'data' : JSON.stringify(data)},
			success: function(response) 
			{
				$('#alert_med').html(response.alert);			
			}
		});
    }
} );
function get_details_with_patient_id(value)
{
	$.ajax({
      url: '<?php echo patientDetails1; ?>',
      method : 'post',
      dataType : 'json',
      data: {'get_last_reg': 1 ,'pat_id' : value},
      success : function(response){
      	window.reg_id = response.data.registration_id;
      	get_details_with_register_number(window.reg_id);

      }
  });
		
}
function get_details_with_register_number(value)
{
	window.reg_id = value;
	$.ajax({
		  url: '<?php echo patientDetails; ?>',
		  method : 'post',
		  dataType : 'json',
		  data: {'patient_id' : value, 'complaint' : 1},
		  success: function(response) {
		  	
		  	if(!response.data)
		  	{
		  		alert("Patient Id not available");
		  	}
		  	else
		  	{
		  	 	getAllDetails(window.reg_id);
		  	}

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
			window.reg_id = response.complaint.registration_id;
			$('.reg_id').val(window.reg_id);
			getDetails(window.reg_id);
			// addComplaint(response.complaint.complaint,window.reg_id);
			// addInvestigation(response.complaint.investigation,window.reg_id);
			// addDiagnosis(response.complaint.diagnosis,window.reg_id);
			// addPrescription(window.reg_id);
			// addAdvice(response.complaint.advice,response.complaint.next_visit,window.reg_id);
			// addLabTest(window.reg_id);
			// addVitals(response.vitals,window.reg_id);
			// genBill(window.reg_id);
			// addVitals(response.complaint.complaint);
		}
	});
}
function getDetails(value)
{
	$.ajax({
		  url: '<?php echo patientDetails; ?>',
		  method : 'post',
		  dataType : 'json',
		  data: {'patient_id' : value, 'complaint' : 1},
		  success: function(response) {
		  	// console.log(response);
		  	if(!response.data)
		  	{
		  		$('#alert').html("Patient Id not available");
		  	}
		  	if(response.status == "success")
		  	{
		  		reg_id = response.data[0].reg_id;
	  			$('#name1').html(response.data[0].name);
	  			$('#dob1').html(response.data[0].dob);
	  			$('#reg1').html(response.data[0].reg_id);
		  		$('#det').css('display','block');
		  		$.ajax({
					  url: '<?php echo pharmacy; ?>',
					  method : 'post',
					  dataType : 'json',
					  data: {'medicine_used_by' : reg_id },
					  success: function(response) {
						window.medicines = response.data;				  
						console.log(medicines);
					  	rowq = "";
					  	for(var i = 0; i< response.data.length ; i++)
					  	{
							rowq += "<tr data-value='"+response.data[i].log_med_id+"'><td>"+response.data[i].medicine_name+"</td><td>"+response.data[i].morning+"</td><td>"+response.data[i].afternoon+"</td><td>"+response.data[i].night+"</td><td>"+response.data[i].days+"</td><td>"+response.data[i].qty+"</td><td><input type='number' class='req_med_qty form-control'></td><td>"+response.data[i].expiry_date+"</td><td>"+response.data[i].total_available+"</td><td>$"+(response.data[i].price)*(response.data[i].qty)+"</td></tr>";
					  	}
					  	$('.med_pres').html(rowq);
					  	$('#tbls').css('display','block');
					  }
					
				});
			  	
		  	}
		  	
			
		  }		

		});

}
</script>