<?php 
include('header.php');
include('sidebar.php');
?>
  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Brand</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Brand</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Edit Brand</li>
         </ol>
       </div>
     </div><!-- End Breadcrumb-->

     <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <?php
                   $Edit_id=base64_decode($_REQUEST['i']);
                    $select_query=mysqli_query($conn,"SELECT * FROM brand WHERE b_id='$Edit_id'");
                    $select_result=mysqli_fetch_assoc($select_query);
                    $category = $select_result['name'];
                    $pic=$select_result['brand_img'];
                    if(isset($_POST['submitbtn']))
                    {

                        $category_name=$_POST['category_name'];

                            $img=$_FILES["image"]["name"]; 
                            
                            if($img!='')
                            {
                                $ext = pathinfo($img, PATHINFO_EXTENSION);
                                if($ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg')
                                {
                                    
                                    $foll=rand(1111,9999)."_".$img;
                                    $pathh1="brand_img/".$foll;                            
                                    $tmpp=$_FILES["image"]["tmp_name"];
                                    $del_img = "brand_img/".$pic;
                                    unlink($del_img);
                                }
                                else{
                ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon contrast-alert">
                        <i class="icon-info"></i>
                    </div>
                    <div class="alert-message">
                        <span><center><strong> Sorry!! Image Type Dosen't Exist.. </strong></center></span>
                    </div>
                </div>
                <?php
                            $foll = $pic;
                // echo '<meta http-equiv="refresh" content="2;url=manage_category.php">';
                                }
                            }
                            else
                            {
                                $foll = $pic;
                            }
                            $sql = "UPDATE `brand` SET `name` = '$category_name',`brand_img` ='$foll' WHERE `b_id` ='$Edit_id'";
                            
                            $query = mysqli_query($conn,$sql);
                            if($query)
                            {
                                move_uploaded_file($tmpp,$pathh1);
                ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon contrast-alert">
                        <i class="icon-info"></i>
                    </div>
                    <div class="alert-message">
                        <span><center><strong> Success !!! Brand Updated Successfully </strong></center></span>
                    </div>
                </div>
                <?php
                                echo '<meta http-equiv="refresh" content="2;url=manage_brand.php">';
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
                  EDIT Brand
                </h4>

                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Brand</label>
                  <div class="col-sm-10">
                    <input type="text" name="category_name" id="category_name" class="form-control" value="<?php echo $category; ?>"  required>
                  </div>
                </div>
                
                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Upload Image</label>
                    <div class="col-sm-6">
                        <input type="file" name="image" id="img"  class="form-control" placeholder="Product Amount"  onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                        <!--<span>Image Size Should Be 120 x 400</span>-->
                    </div>
                    <div class="col-sm-4">
                        <img src="brand_img/<?php echo $pic; ?>" id="image" width="100" height="200" class="form-control">
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
<?php include('footer.php'); ?>