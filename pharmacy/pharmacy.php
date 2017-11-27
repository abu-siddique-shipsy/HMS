<?php

include __DIR__.'\..\config.php';
include root.'\assets\bootstrap.php';
include root.'\Common\header.php';
$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
$query = "select * from medicines";
$result = $DBcon->query($query);

?>
<!-- <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css"> -->
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-body">
					<select class="form-control select_box">
						<option>Medicine Name</option>
						<?php while ($exe = $result->fetch_assoc()) {
        				echo "<option value=".$exe['id'].">".$exe['medicine_name']."</option>";
	        			}
	        			$result->data_seek(0);
	        			?>

					</select>

				</div>
			</div>
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
      		<div class="col-md-4">
      			<select class="form-control">
      				<option>Medicine Name</option>
      			</select>
      		</div>
      		<div class="col-md-4">
      			<input type="text" placeholder="Qty" class="form-control">
      		</div>
      		<div class="col-md-4">
      			<button type="button" class="btn">Add</button>	
      		</div>
        	
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="internal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Prescription</h4>
      </div>
      <div class="modal-body">
        <div class="row">
			<div class="col-sm-6  ">
				<div class="panel panel-default">
				  	<div class="panel-body" style="margin-top: 10px;">
				  		<div class="form-group ">
							<input type="text" class="form-control select_box" name="name" placeholder="Registration ID" id="pat_id">
							<label id="alert"></label>
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
			        		<th>Qty</th>
			        		<th>Price</th>
			 
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
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>   -->
  <!-- <script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>   -->
<script type="text/javascript">
$(document).ready(function() {
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
		save(0)
	});
	$('#save_pres1').on('click',function(){
		// console.log(medicines);
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
						console.log(response);
						medicines = response.data;				  
					  	rowq = "";
					  	for(var i = 0; i< response.data.length ; i++)
					  	{
							rowq += "<tr><td>"+response.data[i].medicine_name+"</td><td>"+response.data[i].qty+"</td><td>$"+response.data[i].price+"</td></tr>";
					  	}
					  	$('.med_pres').html(rowq);
					  	$('#tbls').css('display','block');
					  }
					
				});
			  	
		  	}
		  	
			
		  }		

		});

		
	});
	function save(inter)	
	{
		if(medicines.length){
		$.ajax({
		  url: '<?php echo pharmacy; ?>',
		  method : 'post',
		  dataType : 'json',
		  data: {'medicines' : JSON.stringify(medicines) , 'internal' : inter ,'reg_id' : reg_id},
		  success: function(response) {
			
		  	alert("Added Success");
		  	$('#example').DataTable().ajax.reload();
		  	// rowq = "";
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
} );
</script>