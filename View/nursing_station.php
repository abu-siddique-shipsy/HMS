<?php

include __DIR__.'/../config.php';
include root.'/assets/bootstrap.php';
include root.'/Common/header.php';

?>
<div id="add_task" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <label>Adding Task For ID <span class="reg_id"></span></label>
            <div class="row">
              <div class="col-md-6">
                <input type="text" class="form-control" id="task_desc" placeholder="Describe Task">
              </div>
              <div class="col-md-6">
                <select id="taskType" class="form-control">
                  <option value="0"></option>
                  <option value="1">Every</option>
                  <option value="2">On</option>
                  <option value="3">Prescirbe</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <input type="date" class="form-control" id="task_date" placeholder="Date" style="display: none;">
              </div>
              <div class="col-md-4" id="time2" style="display: none">
                <input type="text" class="time" id="task_time_hr" placeholder="hr" >
                <input type="text" class="time" id="task_time_min" placeholder="min">
                <select id="task_time_m" class="time">
                  <option></option>
                  <option>AM</option>
                  <option>PM</option>
                </select>
              </div>
              <div class="col-md-4" >
                <input type="number" class="form-control" id="task_days" placeholder="Total Days" style="display: none">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default" id="add_task_into_db">Add</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
</div>
<div id="gatherFailureReason" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <textarea id="gatherFailureReasonText" rows="8" cols="50" placeholder="Reason For Decline">
            
          </textarea>
          <div class="checkbox">
            <label><input type="checkbox" id="closeParentTask">Close All Respective Task</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="gatherFailureReasonSubmit">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-md-3">
          <select id="block" class="form-control">
            
          </select>
        </div>
        <div class="col-md-3">
          <select id="ward" class="form-control">
            
          </select>
        </div>
        <div class="col-md-6 add_task">

          <table id="patient_details"></table>
          <!-- <button class="btn btn-success" data-toggle="modal" data-target="#add_task" id="add_task">ADD TASK</button> -->
        </div>
      </div>
    </div>
  </div>
  <div class="row taskTable">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="">
          <button class="btn btn-default" id="refreshTaskTable">Refresh</button>
          <table id="taskTable"></table>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  var failedWtlTaskId ='';
});
$('#refreshTaskTable').on('click',function(){
  getTasks(window.ward_id);
});
$(document).on( 'click', '#patient_details tbody tr', function (){
  // window.location.href = "/View/patient_reg.php?pat_id="+($(this).find('td').html());
  console.log($(this).find('td').html());
  window.reg_id = $(this).find('td').html();
  $('.reg_id').html($(this).find('td').html());
  $('#add_task').modal('show');
});
$(document).on('change','#taskType',function(){
  $('#time2').hide();
  $('#task_date').hide();
  $('#task_days').hide();
  if ($(this).val() == 1) {
    $('#time2').show();
    $('#task_days').show();
  }
  if ($(this).val() == 2) {
    $('#time2').show();
    $('#task_date').show();
  }
});
$(document).on('click','.marktaskcompleted',function(){
  markTaskCompleted($(this).val());
});
$(document).on('click','.marktaskfailed',function(){
  $('#gatherFailureReasonText').empty();
  failedWtlTaskId = $(this).val();
  $('#gatherFailureReason').modal('show');
});
$('#gatherFailureReasonSubmit').on('click',function(){
  var failingText = $('#gatherFailureReasonText').val();
  failTask(failedWtlTaskId,failingText);
});
$(document).ready(function(){
  window.ward_id = 0;
  $('.add_task').hide();
  $('.taskTable').hide();
  getBlocks();
  $('#block').on('change',function(){
    getWard($(this).val());
    
  });
  $('#ward').on('change',function(){
    window.ward_id = $(this).val();
    getTasks($(this).val());
    $('.add_task').show();
    patient(window.ward_id);
  });
  $('#add_task_into_db').on('click',function(){
    var task_desc = $('#task_desc').val();
    var task_time = $('#task_time_hr').val() != "" ? $('#task_time_hr').val() : "00";
    task_time += $('#task_time_min').val() != "" ? ":" + $('#task_time_min').val() + " " : ":00";
    task_time += $('#task_time_m').val() ;
    var task_days = $('#task_days').val();
    var task_type = $('#taskType').val();
    var task_date = $('#task_date').val();
    
    var task = {
      'reg_id': window.reg_id,
      'ward' : window.ward_id,
      'desc' : task_desc,
      'time' : task_time,
      'days' : task_days,
      'type' : task_type,
      'date' : task_date
    };
    console.log(task);
    addTask(task);
    getTasks(window.ward_id);
  });
  
});
// setInterval(function() {
//     getTasks(window.ward_id);
// }, 5000);
function markTaskCompleted(taskId)
{
  $.ajax({
        url: '<?php echo controller."cont.nursingStation.php"; ?>',
        method : 'post',
        dataType : 'json',
        data : {'completeTask' : taskId},
        success: function(response) {
              getTasks(window.ward_id);
      }
  }); 
}
function failTask(failedWtlTaskId,failingText)
{
  $.ajax({
        url: '<?php echo controller."cont.nursingStation.php"; ?>',
        method : 'post',
        dataType : 'json',
        data : {'failTask' : failedWtlTaskId,'failText' : failingText},
        success: function(response) {
            $('#gatherFailureReason').modal('hide');
              getTasks(window.ward_id);
      }
  });   
}
function getBlocks()
{
  $.ajax({
        url: '<?php echo controller."cont.nursingStation.php"; ?>',
        method : 'post',
        dataType : 'json',
        data : {'getBlocks' : 1},
        success: function(response) {
          createOption(response.data,'block');
        }
       });
}
function getWard(block_id)
{
  $.ajax({
        url: '<?php echo controller."cont.nursingStation.php"; ?>',
        method : 'post',
        dataType : 'json',
        data : {'getWard' : block_id},
        success: function(response) {
          createOption(response.data,'ward');
        }
       });
}
function addTask(task)
{
  $.ajax({
        url: '<?php echo controller."cont.nursingStation.php"; ?>',
        method : 'post',
        dataType : 'json',
        data : {'addTask' : task},
        success: function(response) {
          
        }
  }); 
}
function getTasks(ward_id)
{
  $.ajax({
        url: '<?php echo controller."cont.nursingStation.php"; ?>',
        method : 'post',
        dataType : 'json',
        data : {'getTasks' : ward_id},
        success: function(response) {
          for(var i = 0 ; i < response.data.length ; i++)
          {
            if (response.data[i].background == 'green' || response.data[i].background == 'red') 
            {
              response.data[i].accept = '<button class="marktaskcompleted" value="'+response.data[i].wtlTaskId+'"><span class="glyphicon glyphicon-ok"></button>';
              response.data[i].decline = '<button class="marktaskfailed" value="'+response.data[i].wtlTaskId+'" ><span class="glyphicon glyphicon-remove"></button>';
            }
            else
            {
              response.data[i].accept = '<button class="marktaskcompleted" disabled value="'+response.data[i].wtlTaskId+'"><span class="glyphicon glyphicon-ok"></button>';
              response.data[i].decline = '<button class="marktaskfailed" disabled value="'+response.data[i].wtlTaskId+'" ><span class="glyphicon glyphicon-remove"></button>';
            }
          }
          IntializeTaskTable(response.data);
        }
       }); 
}
function IntializeTaskTable(data)
{
  $('#taskTable').DataTable({   
  "data": data,
  "destroy": true,
  "columns"     :     [  
            {"title": "Visit Id",    "data"     :     "reg"     },  
            {"title": "Task Description",    "data"     :     "task_desc"     },  
            {"title": "Scheduled At",     "data"     :     "scheduled_at"     },  
            {"title": "Status",     "data"     :     "status"},  
            {"title": "Task Type",     "data"     :     "task_type"},
            {"title": "Room",     "data"     :     "room"},
            {     "data"     :     "accept"},
            {     "data"     :     "decline"}    
       ],
  "order": [[ 2, "asc" ]],
  "createdRow": function( row, data, dataIndex){
                $(row).css('background-color',data.background);
            }

       
  }).draw();
  $('.taskTable').show();
}
function createOption(data,id)
{
  option = "<option selected disabled>Select "+id+"</option>";
  for(var i = 0; i < data.length ; i++)
  {
    option += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
  }
  $('#'+id).html(option);
}
function initializePatientDataTable(data)
{
  $('#patient_details').DataTable({   
    "data": data,
      "destroy": true,
    "columns"     :     [  
              {"title": "Visit ID",     "data"     :     "reg_id"     },  
              {"title": "Name",     "data"     :     "name"     },  
         ],
      "pageLength": 1,
      "searching" : true,
      "lengthChange": false,
      "info":false,
      "paging":false,
      "language": { 
          "search": "",
          searchPlaceholder: "Search Patient By ID or Name" 
      },

         
    });
}
function patient(ward_id)
{
  $.ajax({
    url: "<?php echo patientDetails; ?>",
    method : 'post',
    dataType: 'JSON',
    data : {'ward_id' : ward_id },
    success: function(response) {
      if(response.status="success")
    {
      initializePatientDataTable(response.data);    
    }
      
    }
  });
  
 
} 
</script>