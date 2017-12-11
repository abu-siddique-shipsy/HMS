<?php
session_start();
if (isset($_SESSION['userSession'])=="") {
 header("Location: ../login/login.php");
  exit;
}


?>


<link rel="stylesheet" type="text/css" href="../assets/style.css">
<nav class="navbar" style="">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo domain ?>">
        <img class="img-rounded" src="<?php echo domain.'/assets/imgs/logo.jpeg';?>" style="width: 100px;height: 87px; margin-top: -40px ; padding: 10px;">
      </a>
    </div>
    <ul class="nav navbar-nav" style="max-width: 1200px">
      <?php foreach ($_SESSION['screens'] as $key => $value) {
        ?>

        <li><a href="<?php echo domain.$value['link'] ?>"><?php echo $value['screen_name'] ?></a></li>
        <?php


      }?>

    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="<?php echo domain.'/login/logout.php'?>"><span class="glyphicon glyphicon-user"></span> Log Out</a></li>
      
    </ul>
      
    </ul>
  </div>
</nav>

