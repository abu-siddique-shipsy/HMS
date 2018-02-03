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
            <div class="row">
              <div class="col-md-6">
                <input type="text" class="form-control" id="task_desc" placeholder="Describe Task">
              </div>
              <div class="col-md-3">
                <select class="form-control" id="task_type">
                  <option value="Once">One Time</option>
                  <option value="Recursive">Recursive</option>
                </select>
              </div>
              <div class="col-md-3">
                <input type="time" class="form-control" id="task_time" placeholder="Time">
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
          <button class="btn btn-success" data-toggle="modal" data-target="#add_task" id="add_task">ADD TASK</button>
        </div>
      </div>
    </div>
  </div>
  <div class="row taskTable">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="">
          <table id="taskTable"></table>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
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
  });
  $('#add_task_into_db').on('click',function(){
    var task_desc = $('#task_desc').val();
    var task_type = $('#task_type').val();
    var task_time = $('#task_time').val();
    var task = {
      'ward' : window.ward_id,
      'desc' : task_desc,
      'type' : task_type,
      'time' : task_time,
    };
    addTask(task);
    getTasks(window.ward_id);
  });
  
});
setInterval(function() {
    getTasks(window.ward_id);
}, 5000);
function getBlocks()
{
  $.ajax({
        url: '<?php echo controller."/cont.nursingStation.php"; ?>',
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
        url: '<?php echo controller."/cont.nursingStation.php"; ?>',
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
        url: '<?php echo controller."/cont.nursingStation.php"; ?>',
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
        url: '<?php echo controller."/cont.nursingStation.php"; ?>',
        method : 'post',
        dataType : 'json',
        data : {'getTasks' : ward_id},
        success: function(response) {
          // for(var i = 0 ; i < response.data.length ; i++)
          // {
          
          //     // response.data[i].accept = '<button class"btn btn-default" class="accept" value="'+response.data[i].request_id+'"><span class="glyphicon glyphicon-ok"></button>';
          //     // response.data[i].decline = '<button class"btn btn-default" value="'+response.data[i].request_id+'" class="decline"><span class="glyphicon glyphicon-remove"></button>';

          // }
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
            {"title": "Task Description",    "data"     :     "task_description"     },  
            {"title": "Scheduled At",     "data"     :     "scheduled_at"     },  
            {"title": "Status",     "data"     :     "status"},  
            {"title": "Task Type",     "data"     :     "task_type"}
            // {     "data"     :     "accept"},
            // {     "data"     :     "decline"}    
       ],
  "order": [[ 1, "asc" ]],
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
</script>