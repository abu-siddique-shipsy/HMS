<?php

include __DIR__.'\..\config.php';
include root.'\assets\bootstrap.php';
include root.'\Common\header.php';

?>
<div id="update" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-body">
        <div id="question">
          <div class="row">
            <div class="col-lg-12">
              <h3><center><label id="lab">Are you the Consultant?
              </label></center></h3>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <button class="btn pull-right" id="yes">Yes</button>
            </div>
            <div class="col-lg-6">
              <button class="btn" id="no">No</button>
            </div>
          </div>        
        </div>
        
        <div id="updates" style="display: none">
          <div class="row">
            <div class="col-lg-12">
              <h3><center><label id="lab">Update Consultant Visit
              </label></center></h3>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <select class="form-control" id="doc">
                <option>Select Doctor</option>
              </select>
            </div>
            <div class="col-md-4">
              <input type="text" class="form-control" disabled value="<?php echo date('Y-m-d H:m:s');?>">
            </div>
            <div class="col-md-4">
              <input type="text" id="comments" class="form-control" placeholder="Comments">
            </div>
          </div>        
          <hr>
          <div style="text-align: center;">
            <button class="btn btn-success" id="save">Save</button>
          </div>
        </div>
      </div>

      <!-- <div class="modal-footer">
        <center><button type="button" class="btn btn-" data-dimdiss="modal">Close</button></center>
      </div> -->
    </div>
  </div>
</div>
<div id="show_visits" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="color: white">Visits</div><br>
      <div class="modal-body">
        
        <div class="row">
        <div class="col-md-12">
            <table class="table table-stripped" id="visits_table">
              <thead>
                <th>Doctor</th>
                <th>Consulted on</th>
                <th>Comments</th>
              </thead>
              <tbody id="visit_body">
                
              </tbody>

            </table>
        </div>
        </div>
        
      </div>
      <div class="modal-footer center-block">
        <button type="button" class="btn " id="valid">OK</button>
        <!-- <button type="button" class="btn " id="not_valid">NOT VALID</button> -->
      </div> 
    </div>

  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-md-3">
            <input type="text" name="" class="form-control" placeholder="Registration ID" id="reg_id">
          
        </div>
        <div class="col-md-9" style="margin-top: 5px;">
        <div class="col-md-4">
            <label>Name:<span id="name"></span></label>
          
        </div>
        <div class="col-md-4">
            <label>DOB:<span id="dob"></span></label>
          
        </div>
        <div class="col-md-4">
            <label>Condition:<span id="complaint"></span></label>
        </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
      <div class="col-md-6">
        <div class="row">
        <div class="col-md-6">
          <div class="panel panel-default">
              <div class="panel-body">
                <button class="btn btn-info" data-toggle="modal" data-target="#update">UPDATE VISIT</button>
                <button class="btn btn-info" data-toggle="modal" data-target="#show_visits" id="show_visits_btn">SHOW VISITS</button>
              </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-default">
              <div class="panel-body">
                <label>Change to Reallocate Bed<span>
                  <select class="form-control" id="room">
                    <option>Bed No.</option>
                  </select>
                </span></label>
              </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
              <div class="panel-body">
                <table class="table">
                  <thead>
                    <th></th>
                    <th>Medicine Name</th>
                    <th>Used Date</th>
                    <th>Prescriped Doctor</th>
                    
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
                <label class="pull-right">Total amt:<span>250</span></label>
              </div>
          </div>
        </div>
      </div>
    </div>
        <div class="col-md-6">
          <div class="panel panel-default">
              <div class="panel-body">
                <h3>Clinical Data</h3> 
                <table class="table">
                  <thead>
                    <th></th>
                    <th>BP-IID</th>
                    <th>BP-ID</th>
                    <th>UPD</th>
                    <th>BP-IID vs UPD</th>
                    <th>BP-IID vs BP-ID</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>doc 1</td>
                      <td>24/7/2017 12:30:43</td>
                    </tr>
                  </tbody>
                </table>
                <label class="pull-right">Total amt:<span>250</span></label>
              </div>
          </div>
        </div>
        
  </div>
  
</div>
<script type="text/javascript">
$(document).ready(function() {
  var amt = 0;
  var type = 0;
  var price = 0;
  var total = 0;
  var row = "";
  var medicines = [];
  var reg_id = 0;
  $('#reg_id').on('change',function(){
    value = $(this).val();
    get_details(value);
    
  });    
  $('#show_visits_btn').on('click',function(){
    $.ajax({
      url    :    "<?php echo inpatient; ?>",  
      method   :      "post",
      data     : {'reg_id':reg_id},
      success : function(response){
        // if (response.data.total_visits.length) 
        // {
          response = JSON.parse(response);
          result = "";
          result1 = "";
           for(var i = 0 ; i< response.data.length ; i++)
            {
              result += "<tr>";
              result += "<td>"+response.data[i].name+"</td>";
              result += "<td>"+response.data[i].visited_on+"</td>";
              result += "<td>"+response.data[i].comments+"</td>";
              result += "</tr>";
              
            }
              result1 += "<tr>";
              result1 += "<td></td>";
              result1 += "<td>Total Charged</td>";
              result1 += "<td>"+response.data[0].total_amt+"</td>";
              result1 += "</tr>";
            // $('#total').html(response.data[0].total_amt);  
            $('#visit_body').html(result);
            $('#visits_table').DataTable();
        // }
      },   

        
    });
    
    
  });    
  
  $('#yes').on('click',function(){
    $('#updates').css('display','block');
    $('#doc').html('<option value="<?php echo $_SESSION['userId'];?>">Dr. <?php echo $_SESSION['userSession'];?></option>');
    $('#question').css('display','none');
  });
  $('#no').on('click',function(){
    $('#updates').css('display','block');
    $('#question').css('display','none');
  });
  $('#save').on('click',function(){
    comments = $('#comments').val();
    doc_id = $('#doc').val();
    $.ajax({
      url: "<?php echo inpatient; ?>",
      method : 'post',
      dataType: 'JSON',
      data: {'save_visit': 1,'doc_id' : doc_id, 'comments' : comments ,'reg_id' : reg_id},
      success: function(response) {
        
        
      }
    });  
  });
  $.ajax({
      url: "<?php echo patientDetails1; ?>",
      method : 'post',
      dataType: 'JSON',
      data: {'team_id' : 10},
      success: function(response) {
        if(response.status="success")
        {
        $('#doc').html("<option selected disabled>Select Doctor</option>");
        for(var i = 0 ; i<response.data.length;i++)
        {
          $('#doc').append('<option value="'+response.data[i].staff_id+'">Dr. '+ response.data[i].name+'</option>');
        }
      }
        
      }
    });
  function get_details(value)
  {
    $.ajax({
      url: '<?php echo patientDetails; ?>',
      method : 'post',
      dataType : 'json',
      data: {'patient_id' : value, 'complaint' : 1},
      success: function(response) {
        console.log(response);
        if(!response.data)
        {
          $('#alert').html("Patient Id not available");
        }
        if(response.status == "success")
        {
          if(response.is_inp == "1")
          {

            var options = "";
            var result = "";
            reg_id = value;
            $('#name').html(response.data[0].name);
            $('#dob').html(response.data[0].dob);
            $('#complaint').html(response.now_complaint);  
            rooms(response.data[0].room_id);
          }
          else
          {
            $('#out_pat').modal('show');  
          }
        }
        
      }   

    });

  }
  function rooms(value)
  {
      $.ajax({
        url: "<?php echo patientDetails1; ?>",
        method : 'post',
        dataType: 'JSON',
        data: {'get_room' : 'true'},
        success: function(response) {
        if(response.status="success")
        {
          console.log(response);
          $('#room').html("<option selected disabled>"+value+"</option>");
          for(var i = 0 ; i<response.data.length;i++)
          {
            $('#room').append('<option value="'+response.data[i].room_id+'">Room Type:'+response.data[i].type_name +'-floor -'+ response.data[i].floor +'</option>');
          }

          
        }
          
        }
      });
  }
}); 
</script>