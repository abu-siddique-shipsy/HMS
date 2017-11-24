<?php
session_start();
if (isset($_SESSION['userSession'])=="") {
 header("Location: ../login/login.php");
  exit;
}


?>

<link rel="stylesheet" type="text/css" href="../assets/style.css">
<nav class="navbar" style="color: #fff; margin-bottom: 0px;border-radius: 0px;background-color: #007D9D">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo domain ?>">
        <img class="img-circle" src="<?php echo domain.'/assets/imgs/logo.jpeg';?>" style="width: 100px;height: 100px; margin-top: -40px ; padding: 10px;">
      </a>
    </div>
    <ul class="nav navbar-nav" style="">
      <li><a href="<?php echo domain ?>">Home</a></li>
      <li>  
        <a class="dropdown-toggle" data-toggle="dropdown" >Patient<span class="caret"></span></a></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo domain.'/patient/register.php' ?>">Registration</a></li>
          <li><a href="<?php echo domain.'/patient/op.php' ?>">OP Details</a></li>
          <li><a href="<?php echo domain.'/billing/opdbilling.php' ?>">OPD Billing</a></li>
          <li><a href="<?php echo domain.'/patient/inpatient.php' ?>">In Patient Management</a></li>
        </ul>
      </li>
      <li><a href="<?php echo domain.'/pharmacy/pharmacy.php' ?>">Pharmacy</a></li>
      <li><a href="<?php echo domain.'/Pathology_and_imaging/reporting.php'?>">Pathology & Imaging</a></li>
      <li>
        <a class="dropdown-toggle" data-toggle="dropdown" >Store<span class="caret"></span></a></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo domain.'/centralStore/request_item.php' ?>">Requisition</a></li>
          <li><a href="<?php echo domain.'/centralStore/store.php' ?>">Inventory</a></li>
        </ul></li>
      <li><a href="<?php echo domain.'/canteen/billing.php'?>">Canteen</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="<?php echo domain.'/login/logout.php'?>"><span class="glyphicon glyphicon-user"></span> Log Out</a></li>
      
    </ul>
      
    </ul>
  </div>
</nav>
