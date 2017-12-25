<?php

include __DIR__.'/../config.php';
include root.'/assets/bootstrap.php';
include root.'/Common/header.php';

?>

<div class="container">
  <div class="box-card">
    <div id="name">

    </div>
    <div id="dob">

    </div>
    <div id="Specialization">

    </div>  
    
  </div>
  
</div>

<script type="text/javascript">
$(document).ready(function(){
  name = "<label>Siddique</label>";
  dob = "<label>Siddique</label>";
  spec = "<label>Siddique</label>";
  $('#name').html(name);
  $('#dob').html(dob);
  $('#Specialization').html(spec);
});

</script>