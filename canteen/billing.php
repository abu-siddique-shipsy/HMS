<?php

include __DIR__.'/../config.php';
include root.'/assets/bootstrap.php';
include root.'/Common/header.php';
$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);

$query = "select * from canteen";
$result = $DBcon->query($query);
?>
<div class="container">
	<div class="row">
		<div class="col-md-4">
				<div class="panel panel-default panel1">
				  	<div class="panel-body patient">
				  		<div class="form-group">
							<select class="form-control" id="proc_type">
								<option disabled selected>Select Food Type</option>
								<?php while($exe = $result->fetch_assoc()){ 
									echo '<option value="'.$exe[price].'">'.$exe[name].'</option>';
								 } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="panel panel-default panel1"  id="resu" style="display: none">
				  	<div class="panel-body patient">
				  		<div class="form-group">
							<button type="button" class="btn" data-toggle="modal" data-target="#submit">Add Items</button>
							<button type="button" class="btn" data-toggle="modal" data-target="#report" >View Bill</button>
						</div>
					</div>
				</div>
			</div>
	</div>
	<div class="row">
		<div class="col-md-12">
				<div class="panel panel-default panel1">
				  	<div class="panel-body patient">
				  		<table class="table">
				  			<thead>
				  				<th>Item Name</th>
				  				<th>Item Price</th>
				  			</thead>
				  			<tbody>
				  			<?php
				  			$result = $DBcon->query($query); 
				  			while($exe = $result->fetch_assoc()){ ?>
				  				<tr>
				  					<td><?php echo $exe['name'];?></td>
				  					<td><?php echo $exe['price'];?></td>

				  				</tr>
									
							<?php		 } ?>
							</tbody>
				  		</table>
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
        <h4 class="modal-title">Bill</h4>
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
	        		<th>Item</th>
	        		<th>Price</th>
	        	</thead>
	        	<tbody id="det">
	        		
	        	</tbody>
	        </table>
	        <label class="pull-right">Total:<span id="tot"></span></label>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="pat_bill" data-toggle="modal" data-target="#submit1">Add To Patient Bill</button>
        <button type="button" class="btn btn-default" onclick='printDiv("tet");'>Print</button>
        <label id="pat_res"></label>
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
				<div class="panel panel-default">
				  	<div class="panel-body">
				  		<div class="form-group">
				  			<label for="reslt1" id="res"></label>
							<input type="number" name="result" class="form-control" placeholder="Quantity" id="reslt1">
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
<div id="submit1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="width: 200px">
      <div class="modal-body">
      	<div class="row">
        	<div class="col-md-12">
				<div class="panel panel-default ">
				  	<div class="panel-body">
				  		<div class="form-group">
				  			<label for="reslt2" id="res"></label>
							<input type="number" name="result" class="form-control" placeholder="Registration ID" id="reslt2">
							<label id="alert"></label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div style="text-align: center;">
	        <button type="button" class="btn btn-default" data-dismiss="modal" id="add_res1">Add</button>
	        <label id="pat_res"></label>
        </div>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var total = 0;
	var item_price = 0;
	var item_name = 0;
	var qty = 0;
	$('#proc_type').on('change',function(){
		$('#reslt1').val("");
		item_price = $(this).val();		
		item_name = $(this).find("option:selected").text();
		// $('#alert').html("");
		$('#resu').css("display","block");

		
	});
	// $('#reslt1').on('keyup',function(){
		
	// });
	$('#add_res').on('click',function(){
		qty = parseInt($('#reslt1').val());
		cost = item_price * qty;
		total += cost ;
		$response = '<tr class="details">';
		$response += "<td>"+item_name+"</td>";
		$response += "<td><label>Price:"+item_price+" Cost:<span>"+cost+"</span></label></td>";
		$response += '</tr>';
		$('#det').append($response);
		$('#tot').html(total);

	});
	$('#add_res1').on('click',function(){
		// qty = cost = total = 0;
		var reg_id = $('#reslt2').val();
		$.ajax({
		  url: "../Common/patient_charges.php",
		  method : 'post',
		  dataType: 'JSON',
		  data: {'amt' : total , id : 13, 'reg_id' : reg_id},
		  success: function(response) {
		  	if(response.status="success")
			{
				
				$('#pat_res').html("Charges Updated To Record. Please Print The Bill");
				 max = response.data.min_value;
				 min = response.data.max_value;
				 qty = cost = total = 0;
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
