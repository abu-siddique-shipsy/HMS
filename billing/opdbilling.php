<?php

include __DIR__.'/../config.php';
include root.'/assets/bootstrap.php';
include root.'/Common/header.php';

?>
<style type="text/css">
.panel1{
	height: 130px;	
}
.table1{
	margin-top: -10px;
}
</style>
<div class="container-fluid">
<div class="row">
	<div class="col-sm-4">
		<div class="panel panel-default panel1">
		  	<div class="panel-body patient">
		  		<div class="form-group">
					<input type="text" class="form-control" name="name" placeholder="Registration Number" id="id">
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="panel panel-default panel1">
		  	<div class="panel-body">
		  		<table class="table table-hover">
				<thead>
					<th>Name</th>
					<th>DOB</th>
					<th>Sex</th>
                    <th>Complaint</th>
				</thead>
				<tbody>

					<tr id='det'>
					</tr>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
		
<div class="row pad">
	<div class="col-sm-3">
		<div class="panel panel-default">
		  	<div class="panel-body">
		  		<div class="form-group">
					<label>History</label>

					<table class="table">
						<thead>
							<th>Complaint</th>
							<th>Date</th>
						</thead>
						<tbody id="history">
			             				
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-9 ">
		<div class="panel panel-default">
		  	<div class="panel-body">
		  		<div class="row">
		  			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#bill" id="gen_bil">Show Bill</button>

		  		</div>
		  		<br>
		  		<div class="row">
		  			<button type="button" class="btn" >Pay By Cash</button>
		  			<button type="button" class="btn" >Pay By Card</button>
		  		</div>
		  		
		  		
			</div>
		</div>
	</div>
</div>
</div>

<div id="bill" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Biller</h4>
      </div>
      <div class="modal-body">
        <div class="invoice-box">
        <table cellpadding="0" cellspacing="0" id="amt">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                <div style="width:100%; max-width:300px;">
                                	<h2>HMS Solutions</h2>
                                </div>
                            </td>
                            
                            <td>
                                Invoice #: 123<br>
                                Created: <?php echo date('Y-m-d')?><br>
                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                HMS Soulutins<br>
                                12345 Sunny Road<br>
                                Sunnyville, CA 12345
                            </td>
                            
                            <td>
                                HMS Corp.<br>
                                <?php echo $_SESSION['userSession']?><br>
                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Discription
                </td>
                
                <td>
                    Amt
                </td>
                <td>
                    Charged On
                </td>
                <td>
                    Status
                </td>
            </tr>
            
            
        </table>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="paid">Mark Paid</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <p id="bil_resp"></p>
      </div>
    </div>

  </div>
</div>


<script type="text/javascript">
$(document).ready(function(){
    var amt = 0;
    var type = 0;
    var price = 0;
    var payments = 0;
    var total = 0;
    var row = "";
    var medicines = [];
    var reg_id = 0;
    $('#id').on('change',function(){
        value = $(this).val();
        $.ajax({
          url: '<?php echo patientDetails; ?>',
          method : 'post',
          dataType : 'json',
          data: {'patient_id' : value, 'complaint' : 1},
          success: function(response) {
            console.log(response);
            if(response.status == "success")
            {
                var options = "";
                var result = "";
                reg_id = value;
                for(var i = 0 ; i< response.complaint.length ; i++)
                {
                    options += "<tr>"
                    options += "<td>"+response.complaint[i].complaint+"</td>"
                    options += "<td>"+response.complaint[i].on_date+"</td>"
                    options += "</tr>"
                }
                for(var i = 0 ; i< response.data.length ; i++)
                {
                    
                    
                    // result += "<tr>";    
                    result += "<td>"+response.data[i].name+"</td>";
                    result += "<td>"+response.data[i].dob+"</td>";
                    result += "<td>"+response.data[i].sex+"</td>";
                    result += "<td>"+response.now_complaint+"</td>";
                    // result += "<td>"+response.data[i].last_visit+"</td>";
                    // result += "</tr>";   
                }
                // head += result + "</tbody></table>"
                $('#history').html(options);    
                $('#det').html(result); 
            }
          }
            
        });
        
    }); 
    $('#gen_bil').on('click',function(){
        gen_bill();
    });
    $('#paid').on('click',function(){
        $.ajax({
          url: '<?php echo biller ?>',
          method : 'post',
          dataType : 'json',
          data: {'pay_bil' : 1 , 'details' : payments ,'reg_id' : reg_id},

          success: function(response) {
            console.log(response);
            if(response.status=="success")
            {
                // $('#bill').modal('hide');
                $('#bil_resp').html("Payment Made Successfully");
                // $('#gen_bil').trigger("click");
                gen_bill();
            }
            else
                $('#bil_resp').html("Payment Failed");    
          }

        });
    });
    function generate_table(val)
    {
        var response = "";
        response += "<table><thead>";
        response += "<th>Name</th>";
        response += "<th>Qty</th>";
        response += "<th>Date</th>";

    }
    function gen_bill()
    {
        $('.item').html("");
        $.ajax({
          url: '<?php echo biller ?>',
          method : 'post',
          dataType : 'json',
          data: {'gen_bil' : 1 , 'reg_num' : reg_id},

          success: function(response) {
            var data = "";
            var data1 = 0;
            payments = response.data;
            for(var i = 0; i < response.data.length ; i++)
            {
                if(response.data[i].total)
                {
                    data1 = "<tr class='item'><td>Total</td><td>"+response.data[i].total+"</td>";
                }    
                else
                {
                
                    data += "<tr class='item'>"
                    data +="<td>"+response.data[i][1]+"</td>"
                    data +="<td>"+response.data[i][2]+"</td>"
                    data +="<td>"+response.data[i][3]+"</td>"
                    data +="<td>"+(response.data[i][4] == "1"?"Paid":"Not Paid")+"</td>"
                    // data +="<td>"+response.data[i][4]+"</td>"
                    data += "</tr>"; 
                }
                

            }   
                
            $('#amt').append(data+data1); 
            
            
          }
        });
    }
});
</script>