<?php

require __DIR__.'/../config.php';
include root.'\assets\bootstrap.php';
include root.'\Common\header.php';

?>

<html lang="en">

<head>
  <title>Opertation Theatre</title>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-body">
        
        <div class="col-md-12" style="margin-top: 5px;">
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
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-body">
          <h3>Scheduled Operations</h3>
          <div class="pending">
            
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
    <div class="panel panel-default">
      
      <div class="panel-body">
          <div style="text-align: center; font-size: 20px;"><label>Select OT Details</label></div>

          <form action="otwork.php" method="post">
          <div class="row"> 
            <div class="col-md-offset-4 col-md-4">
              <select class="form-control surg" name="surg">
                <option>Select Surgery Type</option>
              </select>
            </div>
          </div>  
          <br>
          <div class="row">
            <div class="col-md-4">
              <select class="form-control ot" name="room">
                <option selected disabled>Select Operation Theatre</option>
              </select>
            </div>
            <div class="col-md-8">
          	<div class="input-group control-group after-add-more">
              <input type="hidden" name="reg_id" value="<?php echo $_POST['reg_id']?>">
              <select class="form-control doc" name="staff_id[]">
                
              </select>
              <div class="input-group-btn"> 
                <button class="btn btn-success add-more" type="button" style="margin-top: 0px;"><i class="glyphicon glyphicon-plus"></i> Add</button>
              </div>
             </div>
           </div>
          </div>  
          <button class="btn btn-success" type="submit"></i> Add</button>

          </form>

          <!-- Copy Fields -->
          <div class="copy hide">
            <div class="control-group input-group" style="margin-top:10px">
              <select class="form-control doc" name="staff_id[]" >
                
              </select>
              <div class="input-group-btn"> 
                <button class="btn btn-danger remove" type="button" style="margin-top: 0px;"><i class="glyphicon glyphicon-remove"></i> Remove</button>
              </div>
            </div>
          </div>

      </div>
    </div>
    </div>
  </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {

      get_details(<?php echo $_POST['reg_id']?>);
      get_scheduled_tasks(<?php echo $_POST['reg_id']?>);
      get_doc_det();

      get_ot();
      get_surg();



      $(".add-more").click(function(){ 
          var html = $(".copy").html();
          $(".after-add-more").after(html);
      });

      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
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

              // rooms(response.data[0].room_id);
              room = response.data[0].room_id;
            }
            else
            {
              $('#out_pat').modal('show');  
            }
          }
          
        }   

      });

    }
    function get_doc_det()
    {
      $.ajax({
      url: "<?php echo patientDetails1; ?>",
      method : 'post',
      dataType: 'JSON',
      data: {'team_id' : 10},
      success: function(response) {
        if(response.status="success")
        {
        $('.doc').html("<option selected disabled>Select Doctor</option>");
        for(var i = 0 ; i<response.data.length;i++)
        {
          $('.doc').append('<option value="'+response.data[i].staff_id+'">Dr. '+ response.data[i].f_name+'</option>');
        }
      }
        
      }
    });
    }
    function get_ot()
    {
      $.ajax({
      url: "<?php echo patientDetails1; ?>",
      method : 'post',
      dataType: 'JSON',
      data: {'get_ot' : 1},
      success: function(response) {
        if(response.status="success")
        {
        $('.ot').html("<option selected disabled>Select Operation Theatre</option>");
        for(var i = 0 ; i<response.data.length;i++)
        {
          $('.ot').append('<option value="'+response.data[i].room_id+'">Theatre ID is '+response.data[i].room_id +" on "+ response.data[i].floor +" floor of " + response.data[i].ward_name + " ward in block " + response.data[i].block_name +   '</option>');
        }
      }
        
      }
    });
    }
    function get_surg()
    {
      $.ajax({
      url: "<?php echo patientDetails1; ?>",
      method : 'post',
      dataType: 'JSON',
      data: {'get_surg' : 1},
      success: function(response) {
        if(response.status="success")
        {
        $('.surg').html("<option selected disabled>Select Surgery</option>");
        for(var i = 0 ; i<response.data.length;i++)
        {
          $('.surg').append('<option value="'+response.data[i].surg_id+'">'+response.data[i].surg_name+'</option>');
        }
      }
        
      }
    });
    }
    function get_scheduled_tasks(reg_id)
    {
      $.ajax({
      url: "<?php echo patientDetails1; ?>",
      method : 'post',
      dataType: 'JSON',
      data: {'get_operations' : reg_id},
      success: function(response) {
        if(response.status="success")
        {
          $('.pending').html("No Pending test");
          var res = "";
          for(var i = 0 ; i<response.data.length;i++)
          { 
            res += '<a href="otwork.php?log_id='+response.data[i].log_id+'">'+response.data[i].surg_name+'</a><br>';
            $('.pending').html(res);  
          }
          
        }
      }
        
      
    });
    }
  });
</script>

</body>
</html>