<?php

include __DIR__.'\..\config.php';
include root.'\assets\bootstrap.php';
include root.'\Common\header.php';
$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
?>
<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<select class="form-conrol panel">
				<option>Item Name</option>
			</select>
		</div>
		<div class="col-md-4">
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#add">Add to Inventory</button>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">	
				<div class="panel-body">
					<table class="table table-stripped table-hover" id="example">
						<thead>
							<th>Item Id</th>
							<th>Item Name</th>
							<th>Purchased On</th>
							<th>Available In Inventory</th>
							<th>Total Available</th>
						</thead>
						<tbody>
							<?php 
							$prod = $DBcon->query("SELECT * from products");
							$i = 0;
								while($val = $prod->fetch_assoc())

							{?>
							<tr>
								<th><?php echo $val['product_id'] ?></td>
								<th><?php echo $val['product_name'] ?></td>
								<th><?php echo $i+1 ?>/7/2017</td>
								<th>Yes</td>
								<th><?php echo $i*70/5 ?></td>
							</tr>
							<?php $i++;
							}?>
						</tbody>
					</table>
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
        <h4 class="modal-title">Add Item</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-4">
      			<select class="form-control">
      				<option>Item Name</option>
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
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>