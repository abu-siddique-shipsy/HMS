<?php 

include __DIR__.'/../config.php';
include root.'/assets/bootstrap.php';
include root.'/Common/header.php';
// include root.'/Common/reception_sidebar.php';

//session_start();
// if (isset($_SESSION['userSession'])=="") {
//  header("Location: ../login/login.php");
//   exit;
// }

$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);

if(isset($_GET['title']))
{
	$type = Ucfirst($_GET['title']);
}
else
{
	$type = "Patient";
}


$query = "select * from $type";
$result = $DBcon->query($query);



?>
<style type="text/css">

</style>
<!-- style="margin-left: 200px" -->
<div class="container" >
	<br>
	<div class="row">
		<div class="col-md-12">
		  <div class="panel panel-defalut ">
		  	<div class="panel-body">
				<div class="radio-inline col-md-2">
				  <label><input type="radio" name="optradio" value="1" class="type">Patient Details</label>
				</div>
				<div class="radio-inline col-md-2">
				  <label><input type="radio" name="optradio" value="2" class="type">Physician Details</label>
				</div>
				<div class="radio-inline col-md-2">
				  <label><input type="radio" name="optradio" value="3" class="type">Tarrif</label>
				</div>
				<div class="radio-inline col-md-2">
				  <label><input type="radio" name="optradio" value="4" class="type">Appointment</label>
				</div>
				<div class="radio-inline col-md-3">
				  <label><input type="radio" name="optradio" value="5" class="type">In Patient Enquiry</label>
				</div>
			</div>
		  </div>
		</div>
	</div>

	<br>

	<div class="row" style="max-height: 100px">
		
		
		
		<div class="col-md-12" style="margin-top: -10px ; text-align: center;" id="las_vis">
			<a class="btn btn-default" href="<?php echo domain.'/View/patient_reg.php'?>">Book An Appointment</a>
		</div>
	</div>

	
	<div class="row" >
		<div class="col-md-12">

		<div class="panel panel-body" id="details_tab" style="display: none">
			<table class="table table-hover" id="pat">
			<thead id="head">
				<th>Patient Id</th>
				<th>Name</th>
				<th>Date Of Birth</th>
				<th>Sex</th>
				<th>Phone Number</th>
				<th>Number of Visits</th>
				<th>Last Visit</th>
				
			</thead>
			<tbody id="body">
				
			</tbody>
		</table>	
		</div>
		</div>
		<div class="panel panel-body" id="consultant_det" style="display: none">
			<table class="table table-stripped" id="cons2">
			<thead id="head">
				<th>Name</th>
				<th>Department</th>
				<th>Status</th>
				
			</thead>
			<tbody id="body">
				
			</tbody>
		</table>	
		</div>
		</div>
	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){
	$(document).on( 'click', '#pat tbody tr', function (){
		window.location.href = "/View/patient_reg.php?pat_id="+($(this).find('td').html());
	});
	var type = 0;
	$('.type').on('change',function(){

	type = parseInt($(this).val());
	// console.log(type);
	switch(type){
		case 1: patient(0);break;
		case 2: consultant(0);break;
		case 3: tarrif(0);break;
		case 4: appointment(0);break;
		case 5: inpatientEnq(0);break;
	}
	
	});
	function patient(value)
	{
		$('#details_tab').html('<table id="pat"></table>');
		$.ajax({
		  url: "<?php echo patientDetails; ?>",
		  method : 'post',
		  dataType: 'JSON',
		  success: function(response) {
		  	if(response.status="success")
			{
				initializePatientDataTable(response.data);		
			}
		  	
		  }
		});
		
  		$('#details_tab').css('display','block');	
    }	
	
	function consultant(value)
	{
		$('#details_tab').html('<table id="cons"></table>');
		$.ajax({
		  url: "<?php echo ConsultantDetails; ?>",
		  method : 'post',
		  dataType: 'JSON',
		  success: function(response) {
		  	if(response.status="success")
			{
				initializeConsultantDataTable(response.data);		
			}
		  	
		  }
		});
  		$('#details_tab').css('display','block');	
	}
	function appointment(value)
	{
		$('#details_tab').html('<table id="app"></table>');
		$.ajax({
		  url: "<?php echo controller.'cont.reception.php'; ?>",
		  method : 'post',
		  dataType: 'JSON',
		  data: {'get_appointment' : 1},
		  success: function(response) {
		  	if(response.status="success")
			{
				initializeAppointmentDataTable(response.data);		
			}
		  	
		  }
		});
  		$('#details_tab').css('display','block');	
	}
	function initializePatientDataTable(data)
	{
		$('#pat').DataTable({   
    	"data": data,
        "destroy": true,
    	"columns"     :     [  
    			{ "title": "ID",    "data"     :     "id"     },  
                {"title": "Name",     "data"     :     "name"     },  
                {"title": "Date Of Birth",     "data"     :     "dob"},  
                {"title": "Gender",     "data"     :     "sex"},  
                {"title": "Phone Number",     "data"     :     "phone_number"     },  
                {"title": "Total Visit" ,     "data"     :     "num_vis"},  
                {"title": "Last Visit Date",     "data"     :     "last_visit"}  
           ],

           
    	});
	}
	function initializeConsultantDataTable(data)
	{
		$('#cons').DataTable({   
    	"data": data,
        "destroy": true,
    	"columns"     :     [  
    			{ "title": "ID",    "data"     :     "id"     },  
                {"title": "Name",     "data"     :     "name"     },  
                {"title": "Email",     "data"     :     "email"},  
                {"title": "Qualification",     "data"     :     "qualification"},  
                {"title": "Specialization",     "data"     :     "specialization"     },  
                {"title": "Working Hours" ,     "data"     :     "working_hrs"},  
                {"title": "Charge",     "data"     :     "fee"}  
           ],

           
    	});
	}
	function initializeAppointmentDataTable(data)
	{
		$('#app').DataTable({   
    	"data": data,
        "destroy": true,
    	"columns"     :     [  
    			{ "title": "Doctor ",    "data"     :     "doc_name"     },  
                {"title": "Patient ",     "data"     :     "pt_name"     },  
                {"title": "Date",     "data"     :     "scheduled_date"},  
                {"title": "Time",     "data"     :     "scheduled_time"},  
                {"title": "For",     "data"     :     "complaint"     }
           ],

           
    	});
	}
});

</script>