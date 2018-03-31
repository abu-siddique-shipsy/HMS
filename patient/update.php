<?php

include __DIR__.'/../config.php';
 
// include root.'/assets/style.php';

$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
if(isset($_POST['dept_id']))
{
	$id = $_POST['dept_id'];

	$query = "select * from staff where staff_type=10";
	$result = $DBcon->query($query);
	$doc_array = [];
	while($exe = $result->fetch_assoc())
	{
		array_push($doc_array,$exe);
	}
	$response = new stdClass();
	$data = $doc_array;
	$response->data = $data;
	$response->status = "success";
	
	echo json_encode($response);
}
else if(isset($_POST['get_room']))
{
	

	$query = "select * from rooms rm join room_type_map rmt on rm.room_type = rmt.type_id where rm.status = 0";
	$result = $DBcon->query($query);
	$doc_array = [];
	while($exe = $result->fetch_assoc())
	{
		array_push($doc_array,$exe);
	}
	$response = new stdClass();
	$data = $doc_array;
	$response->data = $data;
	$response->status = "success";
	echo json_encode($response);
}

else if(isset($_GET))
{
		$input = ($_GET);
		$sql = "insert into patient (name,dob,sex,phone_number,address,referer,nationality) values ('$input[name]','$input[dob]','$input[sex]','$input[phnum]','$input[address]','$input[referral]','$input[nation]')";
		$DBcon->query($sql);
		$sql1 = "select * from patient where dob='$input[dob]' and phone_number='$input[phnum]' and sex='$input[sex]'";
		$result =$DBcon->query($sql1);
		$exe=$result->fetch_array();
		if(is_numeric($input['room']))
		{
			$is_inp = 1;
		}
		else
		{
			$is_inp = 0;	
		}
		$sql2 = "insert into registration (patient_id,dept_id,consultant_id,is_inp,room_id,required_treatment,sponser) values ('$exe[id]','$input[dept]','$input[consultant]',$is_inp,'$input[room]','$input[treatment]','$input[sponser]')";
		// print_r($sql2);
		$DBcon->query($sql2);
		$sql3 = "select * from registration where patient_id = '$exe[id]' order by created_at DESC";
		$result1 =$DBcon->query($sql3);
		$exe1 = $result1->fetch_assoc();
		$sql6 = "update rooms set status = 1 where room_id = '$exe1[room_id]'";
		$DBcon->query($sql6);
		// print_r($exe1);
		// print_r($exe);
		include root.'/assets/bootstrap.php';
?>
<link rel="stylesheet" type="text/css" href="../assets/style.css">
<div class="container" id="tet">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-4">
				<label>Patient ID : <span><?php echo $exe['id'];?></span></label>
			</div>
			<div class="col-md-4 col-md-offset-4 ">
				<label>Registration ID : <span><?php echo $exe1['registration_id'];?></span></label>
			</div>
		</div>
	</div>

	<div class="row" style="margin-top: 100px;">
		<div class="col-md-offset-3 col-md-6">
		<label>Name : <span><?php echo $exe['name'];?></span></label><br>
		<label>Date of Birth : <span><?php echo $exe['dob'];?></span></label><br>
		<label>Gender : <span><?php echo $exe['sex'];?></span></label><br>
		<label>Contact : <span><?php echo $exe['phone_number'];?></span></label><br>
		<label>Nationality : <span><?php echo $exe['nationality'];?></span></label><br>
		<label>Address : <span><?php echo $exe['address'];?></span></label><br>
		<label>Consultant Incharge : <span>
		<?php 
			$sql4 = "select * from staff where staff_id = '$exe1[consultant_id]'";
			
			$result2 =$DBcon->query($sql4);
			$exe2 = $result2->fetch_assoc();
			echo $exe2['name'];
		;?></span></label><br>
		<?php if($is_inp)
		{?>
			<label>Room Number : <span><?php echo $exe1['room_id'];?></span></label><br>
			<label>Required Treatement : <span><?php echo $exe1['required_treatment'];?></span></label><br>
			<label>Sponser : <span><?php echo $exe1['sponser'];?></span></label><br>
		<?php } ?>
		</div>

	</div>
</div>
<div class="row" style="margin-top: 100px;">
	<div class="col-md-offset-3 col-md-6">
		<button type="button" onclick='printDiv("tet");' class="btn">Print</button>
	</div>
</div>				

<script type="text/javascript">
function printDiv(divName) {

      var printContents = document.getElementById(divName).innerHTML;     
   var originalContents = document.body.innerHTML;       
   document.body.innerHTML = printContents;      
   window.print();      
   document.body.innerHTML = originalContents;
   }
</script>
<?php
}
?>