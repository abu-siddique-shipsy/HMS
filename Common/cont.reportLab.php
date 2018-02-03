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
			<h2>Lab Reports</h2>
			<table id="labTables"></table>
		</div>
		
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
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
</script>
