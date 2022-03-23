<?php 
 include('header.php');
 include('sidebar.php');
 ?>
  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Retailer </h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Retailer</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Add Retailer</li>
         </ol>
       </div>
     </div><!-- End Breadcrumb-->

     <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <?php
                    if(isset($_POST['submitbtn']))
                    {

                        $name=mysqli_real_escape_string($conn,$_POST['name']);
                        $email=mysqli_real_escape_string($conn,$_POST['email']);
                        $password=mysqli_real_escape_string($conn,$_POST['password']);
                        $password2=md5($password);
                       
                 
                        $check_query="SELECT * FROM `retailers` WHERE `email`='$email'";
                        $check_data=mysqli_query($conn,$check_query);
                        $check_row=mysqli_num_rows($check_data);
                        if($check_row>0)
                        {
                ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon contrast-alert">
                      <i class="icon-info"></i>
                    </div>
                    <div class="alert-message">
                      <span><center><strong> Sorry!! Email Id Already Exist.. </strong></center></span>
                    </div>
                </div>
                <?php
                            echo '<meta http-equiv="refresh" content="2;url=add_retailer.php">';
                        }
                        else
                        {
                            $insert_query=mysqli_query($conn,"INSERT INTO `retailers`(`name`, `email`, `password`) VALUES ('$name','$email','$password2')");
                            if($insert_query)
                            {
                                ?>
                                 <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <div class="alert-icon contrast-alert">
                                      <i class="icon-info"></i>
                                    </div>
                                    <div class="alert-message">
                                      <span><center><strong> Successfully Inserted.. </strong></center></span>
                                    </div>
                                </div>
                                <?php
                                echo '<meta http-equiv="refresh" content="2;url=add_retailer.php">';
                            }
                            else
                            {
                                ?>
                                  <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <div class="alert-icon contrast-alert">
                                      <i class="icon-info"></i>
                                    </div>
                                    <div class="alert-message">
                                      <span><center><strong> Sorry!! Something Went Wrong.. </strong></center></span>
                                    </div>
                                </div>
                                <?php
                                echo '<meta http-equiv="refresh" content="2;url=add_retailer.php">';
                            }
                          
                        }    
                    }
                ?>
              <form id="personal-info" method="post" enctype="multipart/form-data">
                <h4 class="form-header">
                  <i class="fa fa-file-text-o"></i>
                  ADD RETAILER
                </h4>

                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Email Id</label>
                  <div class="col-sm-10">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email Id" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="password" id="password" class="form-control" placeholder="PASSWORD" required>
                  </div>
                </div>
                
                <!--<div class="form-group row">-->
                <!--    <label for="input-5" class="col-sm-2 col-form-label">Upload Image</label>-->
                <!--    <div class="col-sm-6">-->
                <!--        <input type="file" name="image" id="img"  class="form-control" placeholder="Product Amount"  onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">-->
                        <!--<span>Image Size Should Be 120 x 400</span>-->
                <!--    </div>-->
                <!--    <div class="col-sm-4">-->
                <!--        <img src="assets/images/newproduct.png" id="image" width="100" height="200" class="form-control">-->
                <!--    </div>-->
                <!--</div>-->
          
                <div class="form-footer">
                    <button type="button" onclick="location.reload()" class="btn btn-danger"><i class="fa fa-times"></i> CANCEL</button>
                    <button type="submit" name="submitbtn" class="btn btn-success"><i class="fa fa-check-square-o"></i> SAVE</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!--End Row-->
    </div><!-- End container-fluid -->
  </div><!-- End content-wrapper-->
  
<?php 
include('footer.php');
?>