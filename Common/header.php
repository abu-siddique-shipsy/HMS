<?php
session_start();
if (isset($_SESSION['userSession'])=="") {
 header("Location: ../login/login.php");
  exit;

}
function get_label($link){
  $con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
  $query = "SELECT * from screens where link = '$link'";
  $res = $con->query($query);
  $exe = $res->fetch_array();
  $con->close();
  return $exe['screen_name'];
}


?>


<link rel="stylesheet" type="text/css" href="../assets/style.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="btn" data-toggle="collapse" data-target="#link" id="header_btn"><img src="<?php echo domain.'/assets/imgs/bars.png';?>" style="height: 10px;width: 10px"></button>
  <?php print_r(get_label($_SERVER[REQUEST_URI])); ?>
  <ul class="nav navbar-nav navbar-right">
      <li><a href="<?php echo domain.'/login/logout.php'?>"><span class="glyphicon glyphicon-user"></span> Log Out</a></li>
  </ul>
  
</nav>
<div class="collapse" id="link" >
  <div class="header_panel">
    <!--   <a class="" href="<?php echo domain ?>">
        <img class="img-rounded" src="<?php echo domain.'/assets/imgs/logo.jpeg';?>">
      </a> -->
      <ul style="list-style: none;">
      <?php foreach ($_SESSION['screens'] as $key => $value) {
        ?>

        <li><a href="<?php echo domain.$value['link'] ?>"><?php echo $value['screen_name'] ?></a></li>
        <?php
      }?>
      </ul>
  </div>
</div>
<script type="text/javascript">
$(document).on('click','#header_btn',function(){
  if($('#link').attr('aria-expanded') === "true")
  {
    $('.container').css('display','none');
    $('.container').css('margin-left','180');
    $('.container-fluid').css('margin-left','180');
  }
  else
  {
    $('.container').css('display','none');
    $('.container').css('margin-left','auto');
    $('.container-fluid').css('margin-left','auto');
  }
  $('.container').css('display','block');
});
</script>
