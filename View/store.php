<?php

include __DIR__.'/../config.php';
include root.'/assets/bootstrap.php';
include root.'/Common/header.php';
?>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#request" onclick="getRequest()">Check Requests</button>
		</div>
		<div class="col-md-4">
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#add">Add to Inventory</button>
		</div>
		<div class="col-md-4">
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#createPurchaseOrder" id="createPurchaseOrderButton">Create Purchase Order</button>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">	
				<div class="panel-body">
					<table class="table table-stripped table-hover" id="inventory">
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
      			<input type="text" placeholder="Enter Order ID" class="form-control" id="orderId">
      		</div>
      		<div class="col-md-4">
      			<input type="text" placeholder="Enter MRN ID" class="form-control" disabled>
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
<div id="request" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 80%">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Item</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<table id="requestTable">
      			
      		</table>
        	
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="reasonForDecline" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
      	<div class="row pad" >
        	<textarea id="reasonForDeclineText" rows="3" cols="70" placeholder="Reason For Decline"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="reasonForDeclineSubmit">Submit</button>
      </div>
    </div>

  </div>
</div>
<div id="createPurchaseOrder" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
      	<div class="row patient" >
      		<div class="col-md-4">
      			<select class="form-control" id="purchaseOrderSupplierName">
      			
      			</select>
      		</div>
      		<div class="col-md-8">
    			<table id="supplierDetials" class="table table-hover">
    				
    			</table>
      		</div>
      	</div>
      	<div class="row">
      		<div class="col-md-4">
      			<input type="text" id="purchaseOrderProductType" class="form-control" placeholder="Product Type" list="ProductTypeList" >
      			<datalist id="ProductTypeList">
      				
      			</datalist>
      		</div>
      		<div class="col-md-4">
      			<input type="text" id="purchaseOrderProductSubType" class="form-control" placeholder="Product Sub Type" list="ProductSubTypeList" >
      			<datalist id="ProductSubTypeList">
      				
      			</datalist>
      		</div>
      		<div class="col-md-4">
      			<input type="text" id="purchaseOrderProductName" class="form-control" placeholder="Product Name" list="ProductNameList">
      			<datalist id="ProductNameList">
      				
      			</datalist>
      		</div>
      	</div>
      	<div class="row">
      		<div class="col-md-4">
      			<input type="number" id="purchaseOrderProductQty" class="form-control" placeholder="Product Quantity">
      		</div>
      	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="createPurchaseOrderSubmit">Submit</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	getInventory();
});
$(document).on('click','.accept',function(){
	acceptRequisition($(this).val());
});
$(document).on('click','.decline',function(){
	$('#reasonForDecline').modal('show');
	window.close = $(this).val();
});
$('#reasonForDeclineSubmit').on('click',function(){
	declineRequisition(window.close,$('#reasonForDeclineText').val());
	$('#reasonForDeclineText').val("");
});
$(document).on('click','.requestForPurchase',function(){
	$('#createPurchaseOrder').modal('show');
	var i = 0;
	var arr = [];
	$(this).parent().parent().find('td').each(function(){
		if(i<3)
			arr.push($(this).text());	
		i++;
	});
	getSupplierDetails();
	$('#purchaseOrderProductType').val(arr[0]);
	$('#purchaseOrderProductSubType').val(arr[1]);
	$('#purchaseOrderProductName').val(arr[2]);	
	$('#purchaseOrderProductId').val($(this).val());
});
$('#createPurchaseOrderButton').on('click',function(){
	getSupplierDetails();
});
$('#purchaseOrderSupplierName').on('change',function(){
	getSingleSupplierDetails($(this).val());
});
$('#purchaseOrderProductType').on('keyup',function(){
	getProductType($(this).val());
});
$('#purchaseOrderProductSubType').on('keyup',function(){
	getProductSubType($(this).val());
});
$('#purchaseOrderProductName').on('keyup',function(){
	getProductName($(this).val());
});
$('#createPurchaseOrderSubmit').on('click',function(){
	var supplier_id = $('#purchaseOrderSupplierName').val();
	var product_type = $('#purchaseOrderProductType').val();
	var product_sub_type = $('#purchaseOrderProductSubType').val();
	var product_name = $('#purchaseOrderProductName').val();
	var product_qty = $('#purchaseOrderProductQty').val();
	if(supplier_id < 0) 
	{
		$('#purchaseOrderSupplierName').focus();return;
	}
	if(product_type == "") 
	{
		$('#purchaseOrderProductType').attr('placeholder','Product Type Cannot be Empty');
		$('#purchaseOrderProductType').focus();return;
	}
	if(product_sub_type == "") 
	{
		$('#purchaseOrderProductSubType').attr('placeholder','Product Sub Type Cannot be Empty');
		$('#purchaseOrderProductSubType').focus();return;
	}
	if(product_name == "")
	{
		$('#purchaseOrderProductName').attr('placeholder','Product Name Cannot be Empty');
		$('#purchaseOrderProductName').focus();return;
	}
	if(product_qty < 0) 
	{
		$('#purchaseOrderProductQty').attr('placeholder','Quantity Cannot be Empty');
		$('#purchaseOrderProductQty').focus();return;
	}
	var po = {
		'supplier_id' : supplier_id,
		'product_type' : product_type,
		'product_sub_type':product_sub_type,
		'product_name': product_name,
		'quantity' : product_qty
	};
	sendPo(po);
});

function sendPo(po)
{
	$.ajax({
	  url: "<?php echo controller.'cont.store.php'; ?>",
	  method : 'POST',
	  dataType: 'JSON',
	  data : {'sendPo': po},
	  success: function(response) 
	  {
	  		$('#createPurchaseOrder').modal('submit');
	  }
	});		
}
function getSupplierDetails()
{	
	$.ajax({
	  url: "<?php echo controller.'cont.store.php'; ?>",
	  method : 'POST',
	  dataType: 'JSON',
	  data : {'getSupplierDetails': 1},
	  success: function(response) 
	  {
	  	if(response.status="success")
		{
			createOptionsForSupplier(response.data);
		}
	  	
	  }
	});		
}
function getProductType(type)
{	
	console.log(type);
	$.ajax({
	  url: "<?php echo controller.'cont.store.php'; ?>",
	  method : 'POST',
	  dataType: 'JSON',
	  data : {'getProductType': type},
	  success: function(response) 
	  {
	  	
		createOptionsForProduct(response.data,'#ProductTypeList');
	  	
	  }
	});		
}
function getProductSubType(type)
{	
	console.log(type);
	$.ajax({
	  url: "<?php echo controller.'cont.store.php'; ?>",
	  method : 'POST',
	  dataType: 'JSON',
	  data : {'getProductSubType': type},
	  success: function(response) 
	  {
	  	
		createOptionsForProduct(response.data,'#ProductSubTypeList');
	  	
	  }
	});		
}
function getProductName(type)
{	
	console.log(type);
	$.ajax({
	  url: "<?php echo controller.'cont.store.php'; ?>",
	  method : 'POST',
	  dataType: 'JSON',
	  data : {'getProductName': type},
	  success: function(response) 
	  {
	  	
		createOptionsForProduct(response.data,'#ProductNameList');
	  	
	  }
	});		
}
function getSingleSupplierDetails(supplier_id)
{	
	$.ajax({
	  url: "<?php echo controller.'cont.store.php'; ?>",
	  method : 'POST',
	  dataType: 'JSON',
	  data : {'getSupplierDetails': 1, 'supplier_id' : supplier_id},
	  success: function(response) 
	  {
	  	if(response.status="success")
		{
			createSupplierDetails(response.data[0]);
		}
	  	
	  }
	});		
}
function createSupplierDetails(data)
{
	console.log(data.supplier_name);
	var tr = "";
	tr += '<tr><td>Supplier Name</td><td>'+data.supplier_name+'</td></tr>';
	tr += '<tr><td>Type</td><td>'+data.vendor_type+'</td></tr>';
	tr += '<tr><td>Tax ID</td><td>'+data.tax_id+'</td></tr>';
	tr += '<tr><td>GST Number</td><td>'+data.GST_number+'</td></tr>';
	tr += '<tr><td>Contact Name</td><td>'+data.contact_name+'</td></tr>';
	tr += '<tr><td>Phone Number</td><td>'+data.phone_number+'</td></tr>';
	tr += '<tr><td>Email Id</td><td>'+data.email_id+'</td></tr>';
	$('#supplierDetials').html(tr);
}
function createOptionsForSupplier(data)
{
	var option = '<option disabled selected>Select Supplier</option>';
	for(var i = 0 ; i< data.length ; i++)
	{
		option += '<option value="'+data[i].supplier_id+'">'+data[i].supplier_name+'</option>';
	}
	$('#purchaseOrderSupplierName').html(option);
}
function createOptionsForProduct(data,id)
{
	var option = '';
	for(var i = 0 ; i< data.length ; i++)
	{
		option += '<option>'+data[i].text+'</option>';
	}
	$(id).html(option);
}
function getRequest()
{	
	$.ajax({
	  url: "<?php echo controller.'cont.store.php'; ?>",
	  method : 'POST',
	  dataType: 'JSON',
	  data : {'getRequest': 1},
	  success: function(response) 
	  {
	  	if(response.status="success")
		{
			for(var i = 0 ; i < response.data.length ; i++)
			{
				if(response.data[i].total_available > response.data[i].qty)
				{
					response.data[i].accept = '<button class"btn btn-default" class="accept" value="'+response.data[i].request_id+'"><span class="glyphicon glyphicon-ok"></button>';
					response.data[i].decline = '<button class"btn btn-default" value="'+response.data[i].request_id+'" class="decline"><span class="glyphicon glyphicon-remove"></button>';
				}
				else
				{
					response.data[i].accept = '<button class="requestForPurchase" value="'+response.data[i].request_id+'">Apply For Purchase</button>';;
					response.data[i].decline = '';	
				}
			}
			initializeRequestTable(response.data);		
		}
	  	
	  }
	});		
}
function acceptRequisition(request_id)
{	
	$.ajax({
	  url: "<?php echo controller.'cont.store.php'; ?>",
	  method : 'POST',
	  dataType: 'JSON',
	  data : {'acceptRequisition': request_id},
	  success: function(response) 
	  {
	  	if(response.status="success")
		{
			getRequest();		
		}
	  }
	});		
}
function declineRequisition(request_id,reason)
{	
	$.ajax({
	  url: "<?php echo controller.'cont.store.php'; ?>",
	  method : 'POST',
	  dataType: 'JSON',
	  data : {'declineRequisition': request_id , 'reason' : reason},
	  success: function(response) 
	  {
	  	if(response.status="success")
		{
			getRequest();
		}
	  }
	});		
}
function getInventory()
{	
	$.ajax({
	  url: "<?php echo controller.'cont.store.php'; ?>",
	  method : 'POST',
	  dataType: 'JSON',
	  data : {'getInventory': 1},
	  success: function(response) 
	  {
	  	if(response.status="success")
		{
			initializeDataTable(response.data);		
		}
	  }
	});		
}
function initializeDataTable(data)
{
	$('#inventory').DataTable({   
	"data": data,
    "destroy": true,
	"columns"     :     [  
			{ "title": "Type",    "data"     :     "product_type"     },  
            {"title": "Sub Type",     "data"     :     "product_sub_type"     },  
            {"title": "Name",     "data"     :     "product_name"},  
            {"title": "Material Code",     "data"     :     "product_code"},  
            {"title": "Description",     "data"     :     "product_desc"     },  
            {"title": "Available" ,     "data"     :     "total_available"},  
            {"title": "Price",     "data"     :     "price"}  
       ],
	});
}
function initializeRequestTable(data)
{
	var table = $('#requestTable').DataTable({   
	"data": data,
    "destroy": true,
	"columns"     :     [  
			{ "title": "Type",    "data"     :     "product_type"     },  
            {"title": "Sub Type",     "data"     :     "product_sub_type"     },  
            {"title": "Name",     "data"     :     "product_name"},  
            {"title": "Material Code",     "data"     :     "product_code"},  
            {"title": "Description",     "data"     :     "product_desc"     },  
            {"title": "Requested",     "data"     :     "qty"     },  
            {"title": "Available" ,     "data"     :     "total_available"},  
            {"title": "Price",     "data"     :     "price"},
            {     "data"     :     "accept"},
            {     "data"     :     "decline"}    
       ],

       
	});
	table.draw();
}
</script>