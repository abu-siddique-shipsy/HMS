<?php

 include __DIR__.'/../config.php';
 include root.'/assets/bootstrap.php';
 include root.'/Common/header.php';
// include root.'/assets/style.php';
$id = $_SESSION['userId'];

?>

<div class="container-fluid">
	<div class="row">

		<div class="col-md-12">
			<div class="col-md-4">
				<div class="panel panel-default panel1">
					<?php if(isset($_GET['message'])){?>
				  		<label>Your Request Has been Accepted</label>
				  		<?php }?>
				  	<div class="panel-body patient" style="text-align: center;">
				  		<div class="col-md-8">
				  		
				  		<div class="form-group">

							<select class="form-control" id="type">
								<option selected disabled>Select Product type</option>
								<?php $DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
								$prod = $DBcon->query("SELECT * from products");
								while($val = $prod->fetch_assoc()){
									echo '<option value="'.$val['product_id'].'">'.$val['product_name'].'</option>';
								}?>
								<option>Others</option>
								

							</select>
						</div>
						</div>
						<div class="col-md-4">
							<input type="number" id="qty1" class="form-control" placeholder="qty">
						</div>
						
						<button class="btn btn-default" id="submit">Submit</button>
						
					</div>
					</div>
				</div>
			
				<div class="col-md-4" id="pan-req" style="display: none">
					<div class="panel panel-default">
					  	<div class="panel-body patient">
					  		<form action="store_to_db.php" method="post">
					  			<table class="table">
					  				<thead>
					  					<th>Item Name</th>
					  					<th>Item Quantity</th>
					  					<th>Price</th>
					  				</thead>
					  				<tbody id="item-req">

					  				</tbody>
					  			</table>
					  			<button>Submit</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading">Budget Panel</div>
					  	<div class="panel-body">
					  		<div id="item-value">
					  			<label class="left-side">Available Balance<span class="right-side">$100</span></label>
					  		</div>
					  		<hr>
					  		<div id="rem-budget">
					  			<label class="left-side">Resulting Balance<span class="right-side" id="res_bal">$100</span></label>
					  		</div>

					  	</div>
					</div>
				</div>	
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading">Your Requests</div>
						<div class="panel-body reqs">
							<table class="table req">
								<thead>
									<th>Request ID</th>
									<th>Item</th>
									<th>Quantity</th>
								</thead>
								<tbody>
									<?php $DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
									$prod = $DBcon->query("SELECT * from product_request pdq join products  pd on pd.`product_id` = pdq.`product_id` where pdq.`requested_by` = '$id' and flag = 0");
									while($val = $prod->fetch_assoc()){?>
										<tr>
											<td> <?php echo $val['request_id'];?> </td>
											<td><?php echo $val['product_name'];?></td>
											<td><?php echo $val['qty'];?></td>
										</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="other" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter Item</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-md-4">
        		<input class="form-control" type="text" id="prod" placeholder="type">
        	</div>
        	<div class="col-md-4" >
        		<input class="form-control" type="number" id="qty" placeholder="Quantity">
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="submit1">Submit</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#type').on('change',function(){
		var value = $(this).val();
		if (value == "Others") 
		{
			$('#other').modal('show'); 
		}
	});
	$('#prod').on('change',function(){
		$('#qty').css('display','block'); 
	});
	$('#submit').on('click',function(){
		
		var name_val = $('#type').val();
		var name_text = $('#type').find("option:selected").text();
		var type = $('#qty1').val();
		if((name_val != "") & (type != ""))
		{
			var item_value = '<tr><td>'+name_text+'</td><td>'+type+'</td></tr>';
			item_value += '<input type="hidden" name="product_id[]" value="'+name_val+'">'; 
			item_value += '<input type="hidden" name="qty[]" value="'+type+'">'; 
			$('#item-req').append(item_value);
			$('#pan-req').css('display','block'); 	

		}
	});
	$('#submit1').on('click',function(){
		
		var name = $('#prod').val();
		var type = $('#qty').val();
		if((name != "") & (type != ""))
		{
			var item_value = '<tr><td>'+name+'</td><td name="qty[]">'+type+'</td></tr>';
			item_value += '<input type="hidden" name="product_id[]" value="'+name+'">'; 
			item_value += '<input type="hidden" name="qty[]" value="'+type+'">'; 
			$('#item-req').append(item_value);
			$('#pan-req').css('display','block'); 	

		}
	});
});
</script>