<?php 
 include('header.php');
 include('sidebar.php');
 
 $check_sql = mysqli_query($conn,"SELECT * FROM `contact_us_manage`");
 $fetch_res = mysqli_fetch_assoc($check_sql);
 
 ?>
  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Manage Contact Us</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Manage Contact Us</li>
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
                        $heading     = mysqli_real_escape_string($conn,$_REQUEST['heading']);
                        $sub_heading = mysqli_real_escape_string($conn,$_REQUEST['sub_heading']);

                        
                        if(mysqli_num_rows($check_sql) > 0){
                            $sql = "UPDATE `contact_us_manage` SET `heading`='$heading',`sub_heading`='$sub_heading'";
                        } else {
                            $sql = "INSERT INTO `contact_us_manage`(`heading`, `sub_heading`) VALUES ('$heading','$sub_heading')";
                        }
                        
                        $query = mysqli_query($conn,$sql);
                        if($query)
                        {
                                    
                ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon contrast-alert">
                        <i class="icon-info"></i>
                    </div>
                    <div class="alert-message">
                        <span><center><strong> Success !!! Contact Us Updated Successfully </strong></center></span>
                    </div>
                </div>
                <?php
                      echo '<meta http-equiv="refresh" content="2;url=manage_contact.php">';
                  }else{
                ?>
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon contrast-alert">
                        <i class="icon-info"></i>
                    </div>
                    <div class="alert-message">
                        <span><center><strong> Sorry !!! Please Try Again </strong></center></span>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
              <form id="personal-info" method="post" enctype="multipart/form-data">
                <h4 class="form-header">
                  <i class="fa fa-file-text-o"></i>
                  Manage Contact Us
                </h4>

                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Heading</label>
                    <div class="col-sm-6">
                        <input type="text" name="heading"  class="form-control" placeholder="Heading"  required value="<?=$fetch_res['heading']?>">
                      
                    </div>
                  
                </div>

                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Sub Heading</label>
                    <div class="col-sm-6">
                        <textarea type="text" name="sub_heading"  class="form-control" placeholder="Sub Heading"  required><?=$fetch_res['sub_heading']?></textarea>
                      
                    </div>
                  
                </div>

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