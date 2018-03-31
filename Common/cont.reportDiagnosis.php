<?php
include __DIR__.'/../config.php';
include 'cont.reportheader.php';
?>
<div class="container">
	<div class="row">
		
			<table class="tb">
				<tbody>
				<tr><td><label>Name  </label></td><td><?php echo $profile->name ?></td></tr>
				<tr><td><label>Age  </label></td><td><?php echo (date('Y') - date('Y',strtotime($profile->dob))) ?></td></tr>
				<tr><td><label>Gender  </label></td><td><?php echo $profile->sex ?></td></tr>
				<tr><td><label>Email  </label></td><td><?php echo $profile->email ?></td></tr>
				</tbody>	
			</table>
		
	</div><br>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<tr>
					<th>Complaint</th>
					<td><?php echo $profile->complaint ?></td>
				</tr>
				<tr>
					<th>Diagnosis</th>
					<td><?php echo $profile->diagnosis ?></td>
				</tr>
				<tr>
					<th>Investigation</th>
					<td><?php echo $profile->investigation ?></td>
				</tr>
				<tr>
					<th>Advice</th>
					<td><?php echo $profile->advice ?></td>
				</tr>
				<tr>
					<th>Next Visit</th>
					<td><?php echo $profile->next_visit ?></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h2>Prescription</h2>
			<table id="medTab"></table>
		</div>
		
	</div>
	<div class="row">
		<div class="col-md-12">
			<h2>Lab Reports</h2>
			<table id="labTables"></table>
		</div>
		
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	prescription(window.reg_id);
	addLabTest(window.reg_id)	
});
function print_page()
{
	window.print();
}
function addLabTest(reg_id)
{
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
	        	{"title":"Procedure Name", "data": "procedure_name", "orderable": false },
	        	{"title":"Prescribed Doctor", "data": "name", "orderable": true },
	        	{"title":"Status", "data": "status", "orderable": false },
	        	{"title":"Minimum", "data": "min_value", "orderable": false },
	        	{"title":"Maximum", "data": "max_value", "orderable": false },
	        	{"title":"Result", "data": "result", "orderable": false },
	        	{"title":"Result Value", "data": "result_value", "orderable": false },
	        ],
	        language: {
	            searchPlaceholder: "Search records"
	        },
	        order: [
	            [0, 'desc']
	        ],
	        "paging" : false,
	        "searching": false,
	        "info": false
	    	});
			}
			print_page();	  	
		}
	});

}
function prescription(reg_id)
{
	$.ajax({
	  url: '<?php echo update_op; ?>',
	  method : 'post',
	  dataType : 'json',
	  data: {'reg_id': reg_id},
	  success: function(response) {

	  	for (var i = 0; i < response.data.length; i++) {
	  		response.data[i].bef_aft = (response.data[i].bef_aft == 1) ? "After Food" : "Before Food";
	  	}
	 	$('#medTab').DataTable({
	        "data": response.data,
	        "destroy": true,
	        "columns": [
	        	{"title":"Name","data": "medicine_name", "orderable": false},
	        	{"title":"Morning", "data": "morning", "orderable": false },
	        	{"title":"Afternoon", "data": "afternoon", "orderable": true },
	        	{"title":"Night", "data": "night", "orderable": false },
	        	{"title":"When", "data": "bef_aft", "orderable": false },
	        	{"title":"Total Days", "data": "days", "orderable": false },
	        	{"title":"Prescribed On", "data": "on_date", "orderable": false },
	        ],
	        language: {
	            searchPlaceholder: "Search records"
	        },
	        order: [
	            [0, 'desc']
	        ],
	        "paging" : false,
	        "searching": false,
	        "info": false
	    	}); 	
			
		}

	});
}
</script>
