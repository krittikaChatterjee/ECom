<?php

 session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>E-Commerce</title>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>
  
</head>

<body class="authentication-bg">
 <!-- Start wrapper-->
 <div id="wrapper">
  <div class="card card-authentication1 mx-auto my-5 animated zoomIn bg-dark">
    <div class="card-body">
     <div class="card-content p-2">
      <div class="text-center">
        <img src="admin_image/User_ring.png"/ style="height:50px;weight:50px;">
      </div>
      <div class="card-title text-uppercase text-center py-2 text-white">Sign In</div>

      <?php
     
      include("connection.php");
      if (isset($_POST['submit'])) {
          
        
      
      $username=$_POST['username'];
      $password=$_POST['password'];

      $sql="SELECT * FROM admin WHERE email='$username' AND password='$password'";
      $query=mysqli_query($conn,$sql);
      $count=mysqli_num_rows($query);

      if ($count!=0) {
        $row=mysqli_fetch_assoc($query);
        $admin_id=$row['admin_id'];
        $_SESSION['admin_id']=$admin_id;
        

       echo '<meta http-equiv="refresh" content="0;url=dashboard.php">';
      }
      else{
        ?>
         <div class="alert alert-info alert-dismissible" role="alert" style="background-color: #F44336;">
                 <button type="button" class="close" data-dismiss="alert">×</button>
                  <div class="alert-icon contrast-alert">
                 <i class="icon-info"></i>
                  </div>
                  <div class="alert-message">
                    <span><center><strong>Sorry !!! Wrong Email Id Or Password</strong></center></span>
                  </div>
                </div>
        <?php
      }
      }
      ?>


        <form class="color-form" method="post"> 
        <div class="form-group">
         <div class="position-relative has-icon-left">
          <label for="exampleInputUsername" class="sr-only">Username</label>
          <input type="text" id="exampleInputUsername" class="form-control" placeholder="Email Id" name="username">
          <div class="form-control-position">
            <i class="icon-user"></i>
          </div>
         </div>
        </div>
        <div class="form-group">
         <div class="position-relative has-icon-left">
          <label for="exampleInputPassword" class="sr-only">Password</label>
          <input type="password" id="exampleInputPassword" class="form-control" placeholder="Password" name="password">
          <div class="form-control-position">
            <i class="icon-lock"></i>
          </div>
         </div>
        </div>
      <div class="form-row mr-0 ml-0">
       <div class="form-group col-6">
         <div class="demo-checkbox">
               <!--  <input type="checkbox" id="user-checkbox" class="filled-in chk-col-danger" checked="" />
                <label for="user-checkbox">Remember me</label> -->
        </div>
       </div>
       <!--<div class="form-group col-6 text-right">-->
       <!-- <a href="forget_pass.php">Reset Password</a>-->
       <!--</div>-->
      </div>
      
       <div class="form-group">
    <button type="submit" name="submit" class="btn btn-danger btn-block waves-effect waves-light" style="background-color: #3030c1;" >Sign In</button>
       </div>
        <div class="form-group text-center">
         <!-- <p class="text-white">Not a Member ? <a href="authentication-dark-signup.html"> Sign Up here</a></p> -->
       </div>
       <div class="form-group text-center">
          <hr class="border-secondary">
      <!--   <h5 class="text-white">OR</h5> -->
       </div>
        <div class="form-group text-center">
      <!--   <button type="button" class="btn btn-twitter text-white btn-block waves-effect waves-light"><i class="fa fa-twitter"></i> Sign In With twitter</button> -->
        </div>
       </form>
       </div>
      </div>
       </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
  </div><!--wrapper-->
  
  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- waves effect js -->
  <script src="assets/js/waves.js"></script>
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  
</body>


</html>
