<?php 
 include('header.php');
 include('sidebar.php');
 ?>
  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Delivery Location</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Delivery Location</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Add Delivery Location</li>
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

                         $pin=mysqli_real_escape_string($conn,$_POST['pin']);
                        
                       
                                $sql = "INSERT INTO `nearest_point`( `name`,`status`) VALUES ('$pin','Y')";
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
                                        <span><center><strong> Success !!! Pickup Location Inserted Successfully </strong></center></span>
                                    </div>
                                </div>
                                <?php
                                      echo '<meta http-equiv="refresh" content="2;url=add_location.php">';
                                  }
                                  else{
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
                  ADD DELIVERY LOCATION
                </h4>

                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Pin Code</label>
                    <div class="col-sm-6">
                        <input type="text" name="pin" id="pin"  class="form-control" placeholder="Pin Code"  required>
                      
                    </div>
                </div>
                
                <!--<div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-6">
                        <input type="text" name="location" id="location"  class="form-control" placeholder="Location"  required>
                      
                    </div>
                  
                </div>-->

                <!--<div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-6">
                        <textarea type="text" name="address" id="address"  class="form-control" placeholder="Address"  required> </textarea>
                      
                    </div>
                  
                </div>-->


               
                
                <!--<div class="form-group row">-->
                <!--    <label for="input-5" class="col-sm-2 col-form-label">Upload Poster Image</label>-->
                <!--    <div class="col-sm-6">-->
                <!--        <input type="file" name="image" id="img"  class="form-control" placeholder="Product Amount"  onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])" required>-->
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
<script>
	  $("#pin").keypress(function(){
      
                    this.value = this.value.replace(/[^0-9\.]/g,'');
                var phoneNo = document.getElementById('pin');
                var mb_lth = phoneNo.value.length;
               if (phoneNo.value.length >= 6) {
                  return false;
                }
             });
	
</script>

