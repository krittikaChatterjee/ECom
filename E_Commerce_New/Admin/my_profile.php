<?php
include('header.php');
include('sidebar.php');

$admin_query=mysqli_query($conn,"SELECT * FROM admin WHERE admin_id='$admin_id'");
$admin_result=mysqli_fetch_assoc($admin_query);

?>



    <div class="clearfix"></div>
  
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row pt-2 pb-2">
          <div class="col-sm-9">
            <h4 class="page-title">Admin Profile</h4>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Admin Profile</li>
            </ol>
          </div><!-- End col-sm-9 -->
        </div><!-- End row pt-2 pb-2 -->

        <div class="row">
          <div class="col-lg-4">
            <div class="profile-card-4">
              <div class="card">
                <div class="card-body text-center bg-primary rounded-top">
                  <div class="user-box">
                    <img src="admin_image/admin.png" alt="Admin avatar" style="height: 100px;" />
                  </div>
                  <h5 class="mb-1 text-white"><?php echo $admin_result['name'] ?></h5>
                </div><!-- End card-body text-center bg-primary rounded-top-->
                <div class="card-body">
                  <ul class="list-group shadow-none">
                    <li class="list-group-item">
                      <div class="list-icon">
                        <i class="fa fa-phone-square"></i>
                      </div>
                      <div class="list-details">
                        <span><?php echo $admin_result['mobile'] ?></span>
                        <small>Mobile Number</small>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="list-icon">
                        <i class="fa fa-envelope"></i>
                      </div>
                      <div class="list-details">
                        <span><?php echo $admin_result['email']?></span>
                        <small>Email Address</small>
                      </div>
                    </li>        
                  </ul>
                </div><!-- End card-body-->
              </div><!-- End card-->
            </div><!-- End profile-card-4 -->
          </div><!--End col-lg-4-->

          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <ul class="nav nav-pills nav-pills-primary nav-justified">
                  <li class="nav-item">
                      <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="icon-user"></i> <span class="hidden-xs">Profile</span></a>
                  </li>
                  <li class="nav-item">
                      <a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link"><i class="icon-note"></i> <span class="hidden-xs">Edit</span></a>
                  </li>
                </ul>

                <div class="tab-content p-3">
                  <div class="tab-pane active" id="profile">
                    <h5 class="mb-3">Admin Profile</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>About</h6>
                            <p>
                                <?php echo $name; ?>, Admin
                            </p>
                            <h6>Website</h6>
                            <p>
                                Grocery
                            </p>
                        </div>                     
                    </div><!--End row-->
                  </div>

                  <div class="tab-pane" id="edit">
                    <?php
                      if (isset($_POST['submitbtn'])) {
                        $u_name = $_POST['name'];
                        $u_phno = $_POST['mobile'];
                        $u_pass = $_POST['pwd'];
                        $u_con_pass = $_POST['con_pwd'];
                        if ($u_pass == $u_con_pass) {
                          $u_sql = "UPDATE `admin` SET `name`='$u_name', `mobile`='$u_phno', `password`='$u_pass' WHERE admin_id='$admin_id'";
                          $u_query = mysqli_query($conn,$u_sql);
                          if ($u_query) {
                            echo '<script>swal("Success", "You have Successfully Updated Profile ", "success");</script>';
                            echo "<meta http-equiv='refresh' content='3;url=my_profile.php'>";
                          }else{
                            echo '<script>swal("Sorry!!", "Something Went Wrong", "error");</script>';
                            echo "<meta http-equiv='refresh' content='3;url=my_profile.php'>";
                          }
                        }else{
                          echo '<script>swal("Sorry!!", "Confirm Password Not Match", "error");</script>';
                          echo "<meta http-equiv='refresh' content='3;url=my_profile.php'>";
                        }
                      }
                    ?>
                    <form method="post" enctype="multipart/form-data">
                      <div class="form-group row">
                          <label class="col-lg-3 col-form-label form-control-label">Name</label>
                          <div class="col-lg-9">
                              <input class="form-control" type="text" value="<?php echo $admin_result['name'];  ?>" name="name">
                          </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Email</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="email" name="email" value="<?php echo $admin_result['email']; ?>" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Mobile</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" value="<?php echo $admin_result['mobile']; ?>" name="mobile">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Password</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="password" name="pwd" value="<?php echo $admin_result['password']; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Confirm password</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="password" name="con_pwd" value="<?php echo $admin_result['password']; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label"></label>
                        <div class="col-lg-9">
                            <input type="reset" class="btn btn-secondary" value="Cancel">
                            <input type="submit" class="btn btn-primary" value="Save Changes" name="submitbtn">
                        </div>
                      </div>
                    </form>
                  </div>
                </div><!-- End tab-content p-3 -->
              </div><!-- card-body -->
            </div><!-- End card -->
          </div><!-- End col-lg-8 -->
        </div><!-- End row-->
      </div><!-- End container-fluid -->
    </div><!-- end content-wrapper-->




<?php include('footer.php'); ?>