<?php 
 include('header.php');
 include('sidebar.php');
 
 $check_sql = mysqli_query($conn,"SELECT * FROM `about_us`");
 $fetch_res = mysqli_fetch_assoc($check_sql);
 
 ?>
  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Manage About Us</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Manage About Us</li>
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
                        $heading  = mysqli_real_escape_string($conn,$_REQUEST['heading']);
                        $texttt   = mysqli_real_escape_string($conn,$_REQUEST['texttt']);

                        
                        if(mysqli_num_rows($check_sql) > 0){
                            $sql = "UPDATE `about_us` SET `heading`='$heading',`texttt`='$texttt'";
                        } else {
                            $sql = "INSERT INTO `about_us`(`heading`, `texttt`) VALUES ('$heading','$texttt')";
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
                        <span><center><strong> Success !!! About Us Updated Successfully </strong></center></span>
                    </div>
                </div>
                <?php
                      echo '<meta http-equiv="refresh" content="2;url=about_us.php">';
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
                  Manage About Us
                </h4>

                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Heading</label>
                    <div class="col-sm-10">
                        <input type="text" name="heading"  class="form-control" placeholder="Heading"  required value="<?=$fetch_res['heading']?>">
                      
                    </div>
                  
                </div>

                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Text</label>
                    <div class="col-sm-10">
                        <textarea name="texttt" id="editor1" required><?=$fetch_res['texttt']?></textarea>
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
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor1' );
</script>
