<?php
include __DIR__.'/../config.php';
include root.'/assets/bootstrap.php';
session_start();

if (isset($_SESSION['userSession'])!="") {
 header("Location: ../registration/registration.php");
  exit;
}

?>
<link rel="stylesheet" type="text/css" href="../assets/style.css">
<style type="text/css">
label{
    font-size: 15px;
}
body{
    background-image: none;
    background-color: white;
/* The image used */
}
</style>


    <div class="col-sm-12 dLogin">
            <div class="col-sm-3">
                <!-- <h2>Hospital LOGO here</h2> -->
                <img src="../assets/imgs/logo.jpeg" width="350">
            </div>
            <div class="col-sm-4 d-gray-sec">
                <form action="login_submit.php" class="navbar-form navbar-left" role="search" method="POST"> 
                    <h3>Please Login to Continue!<h3>
                    <div class="form-group">
                        <input id="email" type="email" placeholder="Email" required name="email" class="form-control">
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <input id="password" type="password" placeholder="Password" required name="password" class="form-control">
                    </div>
                    <br>
                    <!-- <div class="form-group">
                        <a href="" class="pull-right d-backto-login" ng-click="backtoLoginClick()">Back to login</a>
                    </div> -->
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right" id="reset">Sign In</button>
                    </div>
                    
                    <br>
                    
                    
                    <?php 
                    if(isset($_GET['message']))
                    {   
                        ?><hr><?php
                        if($_GET['message'] == 1)
                        {
                            echo "<label>USER NOT FOUND</label>";
                        }
                         
                        if($_GET['message'] == 2)
                        {
                            echo "<label>PASSWORD NOT MATCH</label>";
                        }
                    }
                        ?>
                </form>
                
            </div>
    </div>
