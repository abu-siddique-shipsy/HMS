<?php

include __DIR__.'\..\config.php';
include root.'\assets\bootstrap.php';
include root.'\Common\header.php';

?>
<div id="get_access_details" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Accessable Screens</h4>
      </div>
      <div class="modal-body">

        <div id="screens" style="padding: 20px;">
        	
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="staff" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add Users</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-md-12">
	      			<table class="table table-stripped">
	      				<thead>
	      					<th>Staff Id</th>
	      					<th>Staff Type</th>
	      					<th>Created At</th>
	      				</thead>
	      				<tbody id="staff_body">
	      					
	      				</tbody>
	      			</table>
	      		</div>
	      	</div>
	        <div class="row">
	        	<div class="col-md-12">
        			<input type="text" class="form-control" id="stf_typ" placeholder="Staff Type">
        		</div>
        	</div>
        	<div class="row">
	        	<div class="col-md-12">
        			<label id="res"></label>
        		</div>
        	</div>
	      </div>
	      
	      <div class="modal-footer">
	      	<label id="result_add"></label>
	      	<button type="button" class="btn btn-default" id="add_user_into_db">Add</button>
	        
	      </div>
	    </div>

	  </div>
	</div>
	<div id="block" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add Hospital Blocks</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-md-12">
	      			<table class="table table-stripped">
	      				<thead>
	      					<th>Block Name</th>
	      					<th>Description</th>
	      					<th>Incharge</th>
	      				</thead>
	      				<tbody id="block_body">
	      					
	      				</tbody>
	      			</table>
	      		</div>
	      	</div>
	        <div class="row">
	        	<div class="col-md-3">
        			<input type="text" class="form-control" id="block_name" placeholder="Block Name">
        		</div>
        		<div class="col-md-3">
        			<input type="text" class="form-control" id="block_desc" placeholder="Description">
        		</div>
        		<div class="col-md-3">
        			<select class="form-control incharge">
        				<option selected disabled>Select Incharge</option>
        				
        			</select>
        		</div>
        		<div class="col-md-3">
        			<input type="number" class="form-control" id="floors" placeholder="Floors">
        		</div>
        	</div>
        	<div class="row">
	        	<div class="col-md-12">
        			<label id="res"></label>
        		</div>
        	</div>
	      </div>
	      
	      <div class="modal-footer">
	      	<label class="result_add"></label>
	      	<button type="button" class="btn btn-default" id="add_block_into_db">Add</button>
	        
	      </div>
	    </div>

	  </div>
	</div>
	<div id="ward" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add Hospital Blocks</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-md-12">
	      			<table class="table table-stripped">
	      				<thead>
	      					<th>Ward Name</th>
	      					<th>Description</th>
	      					<th>Incharge</th>
	      				</thead>
	      				<tbody id="ward_body">
	      					
	      				</tbody>
	      			</table>
	      		</div>
	      	</div>
	        <div class="row">
	        	<div class="col-md-3">
	        		<select class="form-control block">
        				<option selected disabled>Select Incharge</option>
        				
        			</select>
	        	</div>
	        	<div class="col-md-3">
        			<input type="text" class="form-control" id="ward_name" placeholder="Ward Name">
        		</div>
        		<div class="col-md-3">
        			<input type="number" class="form-control" id="floor" placeholder="Floor">
        		</div>
        		<div class="col-md-3">
        			<select class="form-control incharge">
        				<option selected disabled>Select Incharge</option>
        				
        			</select>
        		</div>
        		
        	</div>
        	<div class="row">
	        	<div class="col-md-12">
        			<label id="res"></label>
        		</div>
        	</div>
	      </div>
	      
	      <div class="modal-footer">
	      	<label class="result_add"></label>
	      	<button type="button" class="btn btn-default" id="add_ward_into_db">Add</button>
	        
	      </div>
	    </div>

	  </div>
	</div>
<div class="container">
	<button class="btn btn-default" data-toggle="modal" data-target="#staff" id="add_staff" >Add Staff Type</button>
	<button class="btn btn-default" data-toggle="modal" data-target="#block" id="add_block" >Add Hospital Block</button>
	<button class="btn btn-default" data-toggle="modal" data-target="#ward" id="add_ward" >Add Ward</button>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#add_staff').on('click',function(){
		get_staff();

	});
	$('#add_block').on('click',function(){
		get_block();
		get_incharge();
	});
	$('#add_ward').on('click',function(){
		get_ward();
		get_block_list();
		get_incharge();

	});
	$('#add_user_into_db').on('click',function(){
		var staff_type = $('#stf_typ').val();
		$.ajax({
		  url: "<?php echo controller.'admin.php'; ?>",
		  method : 'post',
		  dataType : 'json',
		  data: {'add_staff_type': staff_type},
		  success:function(response){
		  	if(response.data)
		  	{
		  		get_staff();
		  		$('#staff').modal('hide');
		  		get_screens();
		  		$('#get_access_details').modal('show');
		  	}
		  	else
		  	{
		  		$('#res').html("Failed Addition");
		  	}
		  	
		  }
			
		});
	});
	$('#add_block_into_db').on('click',function(){
		var block_name = $('#block_name').val();
		
		data = {'block_name' : block_name , 'desc' : $('#block_desc').val() , 'incharge' : $('.incharge').val() ,'num_floors' : $('#floors').val()};
		console.log(data);
		$.ajax({
		  url: "<?php echo controller.'admin.php'; ?>",
		  method : 'post',
		  dataType : 'json',
		  data: {'add_block': 1 , 'data' : JSON.stringify(data)},
		  success:function(response){
		  	if(response.data)
		  	{
		  		get_block();
		  	}
		  	else
		  	{
		  		$('#res').html("Failed Addition");
		  	}
		  	
		  }
			
		});
	});
	$('#add_ward_into_db').on('click',function(){
		var ward_name = $('#ward_name').val();
		
		data = {'ward_name' : ward_name , 'block' : $('.block').val() , 'incharge' : $(this).parent().parent().find('.incharge').val() ,'floor' : $('#floor').val()};
		console.log(data);
		$.ajax({
		  url: "<?php echo controller.'admin.php'; ?>",
		  method : 'post',
		  dataType : 'json',
		  data: {'add_ward': 1 , 'data' : JSON.stringify(data)},
		  success:function(response){
		  	if(response.data)
		  	{
		  		get_ward();
		  	}
		  	else
		  	{
		  		$('#res').html("Failed Addition");
		  	}
		  	
		  }
			
		});
	});
	function get_incharge()
	{
		$.ajax({
		  url: "<?php echo controller.'admin.php'; ?>",
		  method : 'post',
		  dataType : 'json',
		  data: {'get_all_staff': 1},
		  success:function(data){
		  	console.log(data);
		  	data = data.data;
		  	if(data)
		  	{
		  		var content = "<option selected disabled>Select Incharge</option>"
		  		for (var i = 0; i < data.length; i++) {
		  			content += "<option value='"+data[i].staff_id+"'>"+data[i].f_name+" "+data[i].l_name+"</option>";
		  		}
		  		$(".incharge").html(content);
		  	}
		  }
			
		});	
	}
	function get_staff()
	{
		$.ajax({
		  url: "<?php echo controller.'admin.php'; ?>",
		  method : 'post',
		  dataType : 'json',
		  data: {'get_staff_type': 1},
		  success:function(data){
		  	console.log(data);
		  	data = data.data;
		  	if(data)
		  	{
		  		var content="";
		  		for (var i = 0; i < data.length; i++) {
		  			content += create_row(data[i].type_id,data[i].staff_type_name,data[i].created_at);
		  		}
		  		$('#staff_body').html(content);
		  		
		  	}
		  }
			
		});
	}
	function get_block()
	{
		$.ajax({
		  url: "<?php echo controller.'admin.php'; ?>",
		  method : 'post',
		  dataType : 'json',
		  data: {'get_all_blocks': 1},
		  success:function(data){
		  	console.log(data);
		  	data = data.data;
		  	if(data)
		  	{
		  		var content="";
		  		for (var i = 0; i < data.length; i++) {
		  			content += create_row(data[i].block_name,data[i].description,data[i].f_name+" "+data[i].l_name);
		  		}
		  		$('#block_body').html(content);
		  		
		  	}
		  }
			
		});
	}
	function get_block_list()
	{
		$.ajax({
		  url: "<?php echo controller.'admin.php'; ?>",
		  method : 'post',
		  dataType : 'json',
		  data: {'get_all_blocks': 1},
		  success:function(data){
		  	console.log(data);
		  	data = data.data;
		  	if(data)
		  	{
		  		var content = "<option selected disabled>Select Incharge</option>"
		  		for (var i = 0; i < data.length; i++) {
		  			content += "<option value='"+data[i].id+"'>"+data[i].name+"</option>";
		  		}
		  		$(".block").html(content);
		  		
		  	}
		  }
			
		});
	}
	function get_ward()
	{
		$.ajax({
		  url: "<?php echo controller.'admin.php'; ?>",
		  method : 'post',
		  dataType : 'json',
		  data: {'get_all_wards': 1 , data : 0},
		  success:function(data){
		  	console.log(data);
		  	data = data.data;
		  	if(data)
		  	{
		  		var content="";
		  		for (var i = 0; i < data.length; i++) {
		  			content += create_row(data[i].name,"Block Name :"+data[i].name+"<br>Floor :"+data[i].floor_num,data[i].f_name+" "+data[i].l_name);
		  		}
		  		$('#ward_body').html(content);
		  		
		  	}
		  }
			
		});	
	}
	function get_screens()
	{
		$.ajax({
		  url: "<?php echo controller.'admin.php'; ?>",
		  method : 'post',
		  dataType : 'json',
		  data: {'get_screens': 1 },
		  success:function(data){
		  	console.log(data);
		  	data = data.data;
		  	if(data)
		  	{
		  		var content = "";
		  		for(var i = 0; i< data.length ; i++)
		  		{
		  			content += '<label class="checkbox"><input type="checkbox" value="'+data[i].screen_id+'">'+data[i].screen_name+'</label>'
		  		}
		  		$('#screens').html(content);
		  		
		  	}
		  }
			
		});		
	}
	function create_row(v1,v2,v3)
	{
		response = "<tr>"
		response += "<td>"+v1+"</td>"
		response += "<td>"+v2+"</td>"
		response += "<td>"+v3+"</td>"
		response += "</tr>"
		return response;
	}
});
</script>
