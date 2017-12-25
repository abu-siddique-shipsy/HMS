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

		<div class="panel panel-body" id="patient_det" style="display: none">
			<table class="table table-hover" id="pat">
			<thead id="head">
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
	$('#sel1').on('change',function(){
		var value = $(this).val(); 
		// console.log(type);
		switch(type){
		case 1: patient(value);break;
		case 2: consultant(value);break;
		case 3: tarrif(value);break;
		case 4: appointment(value);break;
		case 5: inpatientEnq(value);break;
		}
		// patient(value);
	});
	function patient(value)
	{
		// head = "<th>Name</th><th>Date Of Birth</th><th>Sex</th><th>Phone Number</th><th>Number of Visits</th><th>Last Visit</th>";
		$('#pat').DataTable({   
    	"ajax"     :     {
    	"url"	   :  	"<?php echo patientDetails; ?>",  
    	"contentType" : "application/json",
    	"method"   :  		"post",
    	"data"	   :  function(){
    			return {'test':1};
    			}

    	  
    	},
    	"columns"     :     [  
                {     "data"     :     "name"     },  
                {     "data"     :     "dob"},  
                {     "data"     :     "sex"},  
                {     "data"     :     "phone_number"     },  
                {     "data"     :     "num_vis"},  
                {     "data"     :     "last_visit"}  
           ],

           
    	});
  		// $('#head').html(head);	
  		$('#patient_det').css('display','block');	
    }	
	
	function consultant(value)
	{
		$('#cons2').DataTable({   
    	"ajax"     :     {
    	"url"	   :  	"<?php echo ConsultantDetails; ?>",  
    	"contentType" : "application/json",
    	"method"   :  		"post",
    	"data"	   :  function(){
    			return {'test':1};
    			}

    	  
    	},
    	"columns"     :     [  
                {     "data"     :     "name"     },  
                {     "data"     :     ""},  
                {     "data"     :     ""},  
                {     "data"     :     ""     },  
                {     "data"     :     ""},  
                {     "data"     :     ""}  
           ],

           
    	});
  		// $('#head').html(head);	
  		$('#consultant_det').css('display','block');	
		// $.ajax({
		//   url: '<?php //echo ConsultantDetails; ?>',
		//   method : 'post',
		//   dataType : 'json',
		//   data: {'consultant_id' : value},
		//   success: function(response) {
		//   	console.log(response);
		//   	if(response.status == "success")
		//   	{
		//   		var options = "";
		//   		var result = "";
		//   		var head = "";
		//   		head += "<table class='table table-hover' id='pat'><thead><th>Name</th><th>Date Of Birth</th><th>Address</th><th>Number Of Visits</th><th>Last Visit</th></thead><tbody>";
		//   		for(var i = 0 ; i< response.data.length ; i++)
		//   		{
		//   			options += "<option value='"+response.data[i].staff_id+"' >"+response.data[i].name+"</option>";
		  			
		//   			result += "<tr>";	
		//   			result += "<td>"+response.data[i].name+"</td>";
		// 			result += "<td>"+response.data[i].dob+"</td>";
		// 			result += "<td>"+response.data[i].address+"</td>";
		// 			result += "<td>"+response.data[i].num_vis+"</td>";
		// 			result += "<td>"+response.data[i].last_visit+"</td>";
		//   			result += "</tr>";	
		//   		}
		//   		head += result + "</tbody></table>"
		//   		// $('#body').html(result);	
		//   		$('#patient_det').html(head);	
		//   		if(value == 0)
		//   			$('#sel1').html(options);
		//   	}

		//   }		
		// });	
	}
});

</script>