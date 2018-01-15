<?php

include __DIR__.'/../config.php';
include root.'/assets/bootstrap.php';
// include root.'/Common/header.php';

?>
<link rel="stylesheet" type="text/css" href="../assets/style.css">
<div class="col-sm-12" id="pre_process" style="display: none">
    <img src="../assets/imgs/loader.webp" height="100%">
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
          	<h3><center><label id="lab">Do You Have a Patient ID?
          	</label></center></h3>
          </div>
        </div>
        <div class="row">
        	<div class="col-lg-6">
        		<button class="btn pull-right" id="hav_pat_id_yes">Yes</button>
        	</div>
        	<div class="col-lg-6">
        		<button class="btn" id="hav_pat_id_no">No</button>
        	</div>
        </div>        
      </div>
      <!-- <div class="modal-footer">
        <center><button type="button" class="btn btn-" data-dimdiss="modal">Close</button></center>
      </div> -->
    </div>
  </div>
</div>
<div id="patientid" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
          	<h3><center><label style="position:center;" id="lab">Enter patient ID
          	</label></center></h3>
          </div>
        </div>
        <div class="panel-body">
        <div class="row">
        	<div>
        		<center><input type="text" class="form-control" id="pid"></center>
        		</input>
            <label id="error" style="color: #F6846C"></label>
        	</div>
        </div><br>
        <div class="row">
        	<div>
        		<center><button class="btn" id="checkPt_id">OK</button></center>
        	</div>
        </div>
      </div>
      </div>
      <!-- <div class="modal-footer">
        <center><button type="button" class="btn btn-" data-dimdiss="modal">Close</button></center>
      </div> -->
    </div>
  </div>
</div>
<div id="patientdet" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
          	<h3><center><label style="position:center;" id="lab">Enter Patient Details</label></center></h3>
          </div>
        </div>
        
        <div class="row">
    		<div class="col-md-12">
      			<form class="form-horizontal" role="form">
        			<fieldset>
          				<div class="form-group">
            				<label class="col-md-2 control-label" >Name</label>
            				<div class="col-md-10">
              				<input type="text" class="form-control" id="name1">
            				</div>
          				</div>

				        <div class="form-group">
				        	<label class="col-md-2 control-label" >Address</label>
				            <div class="col-md-10">
				            <input type="text" class="form-control" id="add1">
				            </div>
				        </div>

				        <div class="form-group">
				            <label class="col-md-2 control-label" >DOB
				            </label>
				            <div class="col-md-10">
				            <input class="form-control" type="date" id="dob1" min="2000-01-02" max="<?php echo date('Y-m-d')?>"> 
				            </div>
				        </div>

				        <div class="form-group">
				        	<label class="col-md-2 control-label" >Gender</label>
				            <div class="col-md-10">
				            <input type="radio" name="gender" value="Male">Male
				            <input type="radio" name="gender" value="Female">Female
				            </div>
				        </div>

				        <div class="form-group">
				            <label class="col-md-2 control-label" >Phone Number
				            </label>
                    <div class="col-md-2">
                    <input type="text" class="form-control" id="ph_num_cc" placeholder="CC">
                    </div>
				            <div class="col-md-8">
				            <input type="text" class="form-control" id="ph_num" placeholder="Number">
				            </div>
				        </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" >Email
                    </label>
                    <div class="col-md-10">
                    <input type="text" class="form-control" id="email">
                    </div>
                </div>
				        <div class="form-group">
				            <label class="col-md-2 control-label" >Referal
				            </label>
				            <div class="col-md-10">
				            <input type="text" class="form-control" id="ref">
				            </div>
				        </div>

				        <div class="form-group">
				            <button type="button" class="btn btn-success center-block" id="pat_det_sub">Submit</button>
				        </div>
					</fieldset>
      			</form>
    		</div>
		</div>

      </div>
      <!-- <div class="modal-footer">
        <center><button type="button" class="btn btn-" data-dimdiss="modal">Close</button></center>
      </div> -->
    </div>

  </div>
</div>
<div id="patype" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
        	<div class="col-md-12">
            
      		</div>
      	</div>
      </div>
      <!-- <div class="modal-footer">
        <center><button type="button" class="btn btn-" data-dimdiss="modal">Close</button></center>
      </div> -->
    </div>

  </div>
</div>
<div id="op" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">Out Patient Details</div>
        </div>
        
      <div class="modal-body">
      	<br>
        <div class="row">
    		<div class="col-md-12">
      			<form class="form-horizontal" role="form">
        			<fieldset>
          				<div class="form-group">
            				<label class="col-md-2 control-label">Complaint</label>
            				<div class="col-md-10">
              				<input type="text" class="form-control" id="comp">
            				</div>
          				</div>

				        <div class="form-group">
				        	
				            <div class="col-md-12">
                      <select class="consul form-control" id="op_doc">
				                <option>Doctor</option>
                      </select>
				            </div>
				        </div>				   
                <div class="form-group">
                  
                    <div class="col-md-12" id="doctor_schedule">
                      
                    </div>
                </div>           

				        <div class="form-group">
				            <button type="button" class="btn btn-success center-block" id="final_sub_op">Submit</button>
				        </div>
					</fieldset>
      			</form>
    		</div>
		</div>

      </div>
      <!-- <div class="modal-footer">
        <center><button type="button" class="btn btn-" data-dimdiss="modal">Close</button></center>
      </div> -->
    </div>

  </div>
</div>
<div id="ip" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">Inpatient Details</div>
        </div>
        
      <div class="modal-body">
        <br>
        <div class="row">
          <div class="col-md-3">
              <select class="form-control" id="room">
                <option>Select Room</option>
              </select>  
          </div>
          <div class="col-md-3">
              <select class="form-control consul" id="ctv">
                <option>Consultant Incharge</option>
              </select>    
          </div>
          <div class="col-md-3">
              <input type="text" class="form-control" name="1stLine" placeholder="Treatment Required"  id="comp1">    
          </div>
          <div class="col-md-3">
              <input type="text" class="form-control" name="1stLine" placeholder="Insurance Number" id="ins_num">
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success center-block" id="final_sub_ip">Submit</button>
      </div>
    </div>

  </div>
</div>
<div id="gatherDetails" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">Gather Details</div>
        </div>
        
      <div class="modal-body">
        <form action="<?php echo patientDetails1 ?>" method="POST">
          <input type="hidden" name="vitals" value="1">
          <input type="hidden" name="reg_id" class="reg_id">
          <input type="text" class="form-control" placeholder="height" name="height">
          <input type="text"  placeholder="weight" class="form-control" name="weight">
          <input type="text"  placeholder="BP" class="form-control" name="bp">
          <button type="submit" class="btn btn-success center-block" >Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>
<div id="confirm_pat" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="color: white">Verify Details</div><br>
      <div class="modal-body">
        
        <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
              <label>Patient ID</label><br>
              <label>Name</label><br>
              <label>Date Of Birth</label><br>
              <label>Gender</label><br>
              <label>Contact Number</label><br>
              
              
            </div>
            <div class="col-md-6">
              <label class="pat_id"></label><br>
              <label class="pat_name"></label><br>
              <label class="pat_dob"></label><br>
              <label class="pat_gen"></label><br>
              <label class="pat_ph_num"></label><br>
 

            </div>
        </div>
    </div>
      </div>
      <div class="modal-footer center-block">
        <button class="btn" id="inp_pat">Inpatient</button>
        <button class="btn" id="op_pat">OutPatient</button>
        <button type="button" class="btn " id="not_valid">NOT VALID</button>
      </div> 
    </div>

  </div>
</div>
<div class="container">
  <div id="printer">
  <div class="panel">
  <link rel="stylesheet" type="text/css" href="../assets/style.css">
  <div class="row">
    <div class="col-md-6 pad">
      <table class="table table-default" id="patientData">
        <tr><td>Patient ID</td><td><span class="pat_id"></span></td></tr>
        <tr><td>Name</td><td><span class="pat_name"></span></td></tr>
        <tr><td>DOB</td><td><span class="pat_dob"></span></td></tr>
        <tr><td>Gen</td><td><span class="pat_gen"></span></td></tr>
        <tr><td>Phone Number</td><td><span class="pat_ph_num"></span></td></tr>

      </table>
      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#patientid">Change Id</button>    
    </div>
    <div class="col-md-6 pad">
      <table class="table table-default" >
        <tr><td>Registration ID</td><td><span class="reg_id"></span></td></tr>
        <tr><td>Complaint</td><td><span class="com"></span></td></tr>
        <tr><td>Consultant</td><td><span class="con"></span></td></tr>
        <tbody id="regData">
          
        </tbody>
      </table>
      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#confirm_pat">Change Id</button>    
      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#gatherDetails">Gather Vaitals</button>    
    </div>
  </div>
  <br>
  <br>
  </div>
  </div>
  <button type="button" class="btn btn-default" onclick='printDiv("printer");'>Print</button>
  <button type="button" class="btn btn-default" onclick='javascript:window.location.href = "<?php echo domain ?>"'>Back To Home</button>
</div>


<script type="text/javascript">
$( document ).ready(function() {
<?php if($_GET['pat_id']){ ?>
      var pat_id = <?php echo $_GET['pat_id']; ?>;
<?php }else{ ?>
      var pat_id = 0; 
<?php } ?>
  $.ajax({
      url: "<?php echo patientDetails1; ?>",
      method : 'post',
      dataType: 'JSON',
      data: {'team_id' : 10},
      success: function(response) {
        if(response.status="success")
        {
        $('.consul').html("<option selected disabled>Select Doctor</option>");
        for(var i = 0 ; i<response.data.length;i++)
        {
          $('.consul').append('<option value="'+response.data[i].staff_id+'">Dr. '+ response.data[i].f_name+" "+ response.data[i].l_name+'</option>');
        }
      }
        
      }
    });
  checkPT(pat_id);
  var pat_name = "";
  
  var pat_dob = 0;
  var pat_gen = "";
  var pat_ph_num = 0;
  var pat_nation = "";
  var complaint = "";
  var doctors = 0;
  var reg_id = 0;
  if (!pat_id) 
    $('#myModal').modal('show');

	$('#checkPt_id').click(function () {
		checkPT($('#pid').val());
    pat_id = $('#pid').val();
	});
   $('#pat_det_sub').click(function () {
  //   // $('#patientdet').modal('hide');
      pat_name = $('#name1').val();
      pat_dob = $('#dob1').val();
      pat_gen = $("input[name='gender']:checked").val();
      pat_ph_num = $('#ph_num_cc').val() + " " + $('#ph_num').val();
      pat_email = $('#email').val();
      pat_ref = $('#ref').val();
      
      if(!validateEmail(pat_email))
      {
        $('#email').focus();
        $('#email').val('Enter A Valid Email');return;
      } 

      pat_add = $('#add1').val();
      console.log(pat_name);
      console.log(pat_dob);
      console.log(pat_gen);
      console.log(pat_ph_num);
      console.log(pat_ref);
      console.log(pat_add);
      $.ajax({
        url: "<?php echo patientDetails1; ?>",
        method : 'post',
        dataType: 'JSON',
        data: {'pat_reg' : 1,'data' : {'name' : pat_name , 'dob' : pat_dob, 'sex' : pat_gen ,'phone_number' : pat_ph_num,'email' : pat_email,'referer' : pat_ref,'address' : pat_add}},
        success: function(response) {
          if(response.patient_id)
          {
              pat_id = response.patient_id;
              $(".pat_name").html(pat_name);
              $(".pat_id").html(pat_id);
              $(".pat_dob").html(pat_dob);
              $(".pat_gen").html(pat_gen);
              $(".pat_ph_num").html(pat_ph_num);
              
              $('#patientdet').modal('hide');
              $('#confirm_pat').modal('show'); 
            
          }
        }
        
      });  

      
   });
	$('#hav_pat_id_no').click(function () {
		$('#myModal').modal('hide');
  		$('#patientdet').modal('show');
	})
	$('#hav_pat_id_yes').click(function () {
		$('#myModal').modal('hide');
      $('#patientid').modal('show');
	})
  $('#valid').click(function () {
    $('#confirm_pat').modal('hide');
      $('#patype').modal('show');
  })
  $('#not_valid').click(function () {
    $('#confirm_pat').modal('hide');
      $('#patientid').modal('show');
  })
	$('#op_pat').click(function () {
    $('#confirm_pat').modal('hide');
		$('#patype').modal('hide');
  		$('#op').modal('show');
	})
  $('#inp_pat').click(function () {
    $('#confirm_pat').modal('hide');
    $('#patype').modal('hide');
    $.ajax({
      url: "<?php echo patientDetails1; ?>",
      method : 'post',
      dataType: 'JSON',
      data: {'get_room' : 'true'},
      success: function(response) {
      if(response.status="success")
      {
        console.log(response);
        $('#room').html("<option selected disabled>Select Room</option>");
        for(var i = 0 ; i<response.data.length;i++)
        {
          $('#room').append('<option value="'+response.data[i].room_id+'">Room Type:'+response.data[i].type_name +'-floor -'+ response.data[i].floor +'</option>');
        }

        $('#ip').modal('show');
      }
        
      }
    });

        
    
      
  });
  $('#final_sub_op').click(function () {
    $('.container').hide();
    $('#op').modal('hide');
    doctors = $('#op .consul :selected').val();
    doctors_text = $('#op .consul :selected').text();
    schedule = $('input[name="optradio"]:checked').val()
    console.log(pat_id);
    $('.con').html(doctors_text);
    complaint = $('#comp').val();
    $('.com').html(complaint);
    $('#pre_process').css('display','block');
     if(doctors)
     {
        var datum = {'pat_id' : pat_id , 'cons_id' : doctors , 'complaint' : complaint,'schedule' : schedule};
        $.ajax({
        url: "<?php echo patientDetails1; ?>",
        method : 'post',
        dataType: 'JSON',
        data: {'inp_pat' : 0, 'data' : datum},
        success: function(response) {
            $('#pre_process').hide();
            reg_id = response.data.reg_id; 
            $('.reg_id').html(reg_id);
            $('.container').show();
            get_latest_registration(pat_id);
        }
        
      });  
     } 
  });
  $('#final_sub_ip').click(function () {
    
    $('.container').hide();
    $('#ip').modal('hide');
    doctors = $('#ip .consul :selected').val();
    room_id = $('#room').val();
    doctors_text = $('#ip .consul :selected').text();
    $('.con').html(doctors_text);
    complaint = $('#comp1').val();
    ins_num = $('#ins_num').val();
    $('.com').html(complaint);
    $('#pre_process').css('display','block');
     if(doctors)
     {
        var datum = {'pat_id' : pat_id , 'cons_id' : doctors , 'complaint' : complaint , 'ins_num' : ins_num , 'room' : room_id};
        $.ajax({
        url: "<?php echo patientDetails1; ?>",
        method : 'post',
        dataType: 'JSON',
        data: {'inp_pat' : 1, 'data' : datum},
        success: function(response) {
          $('#pre_process').css('display','none');
            reg_id = response.data.reg_id; 
            $('.reg_id').html(reg_id);
            $('.reg_id').val(reg_id);
            $('.container').show();
            get_latest_registration(pat_id);
        }
        
      });  
     } 
  });
  $('#op_doc').on('change',function(){
    getSchedule($(this).val());
  });

}); 
function printDiv(divName) {

      var printContents = document.getElementById(divName).innerHTML;     
   var originalContents = document.body.innerHTML;       
   document.body.innerHTML = printContents;      
   window.print();      
   document.body.innerHTML = originalContents;
   }

function validateEmail(email) 
{
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
function checkPT(pt)
{
  $.ajax({
      url: '<?php echo patientDetails1; ?>',
      method : 'post',
      dataType : 'json',
      data: {'patient_id' : pt},
      success : function(response){
        if(response.status == "success")
        {
          if(response.data != 1)
          {
              pat_name = response.data[0].name;
              pat_id = response.data[0].id;
              pat_dob = response.data[0].dob;
              pat_gen = response.data[0].sex;
              pat_ph_num = response.data[0].phone_number;
              $(".pat_name").html(pat_name);
              $(".pat_id").html(pat_id);
              $(".pat_dob").html(pat_dob);
              $(".pat_gen").html(pat_gen);
              $(".pat_ph_num").html(pat_ph_num);
              
              $('#patientid').modal('hide');
              <?php if(!$_GET['pat_id']){ ?>
              $('#confirm_pat').modal('show');
              <?php } ?>
              get_latest_registration(pt);
          }
          else
          {
              $('#error').html("Patient Id Not available");
          }
        }
      }
    });
}
function get_latest_registration(pt)
{
  $.ajax({
      url: '<?php echo patientDetails1; ?>',
      method : 'post',
      dataType : 'json',
      data: {'get_last_reg': 1 ,'pat_id' : pt},
      success : function(response){
        console.log(response);
        $('.reg_id').html(response.data.registration_id);
        $('.reg_id').val(response.data.registration_id);
        $('.con').html("Dr "+response.data.f_name+" "+response.data.l_name);
        $('.com').html(response.data.complaint);
        var data = "";
        if(parseInt(response.data.is_inp))
        {

          data = "<tr><td>Patient Type</td><td>In Patient</td></tr>";
          data += "<tr><td>Room Number</td><td>"+response.data.room_id+"</td></tr>";
          data += "<tr><td>Insurance Number</td><td>"+response.data.ins_num+"</td></tr>";
          
        }
        else{
          data += "<tr><td>Patient Type</td><td>Out Patient</td></tr>";
          data += "<tr><td>Scheduled At</td><td>"+response.data.at_time+"</td></tr>";
        }
        $('#regData').html(data);

      }
  });
}
function getSchedule($doc)
{
  $.ajax({
      url: '<?php echo patientDetails1; ?>',
      method : 'post',
      dataType : 'json',
      data: {'sched_doc_id': $doc },
      success : function(response){
        var rest = createSlots(response.data);
        $('#doctor_schedule').html(rest);
      }
  });
}
function createSlots(data1)
{
  data = '<div class="row">';
  for(var i = 0 ; i < data1.length;i++)
  {    
    data += '<div class="radio-inline">';
    data += '<label><input type="radio" name="optradio" value="'+data1[i].slot_id+'">'+'From '+data1[i].frm_time+' to '+data1[i].to_time;+'</label>';
    data += '</div>';
  }  
  data +='</div>';
  return data;
}
</script>