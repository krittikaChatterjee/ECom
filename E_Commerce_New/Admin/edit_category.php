<?php 
include('header.php');
include('sidebar.php');
?>
  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Category</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item">Category</li>
            <li class="breadcrumb-item active" aria-current="page"> Edit Category</li>
         </ol>
       </div>
     </div><!-- End Breadcrumb-->

     <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <?php
                $select_query=mysqli_query($conn,"SELECT * FROM category WHERE cat_id='".$_GET['id']."'");
                $select_result=mysqli_fetch_assoc($select_query);
                $category = $select_result['cat_name'];
                $pic=$select_result['cat_image'];
                if(isset($_POST['submitbtn'])){
                    $category_name=$_POST['category_name'];
                    
                    if($_FILES["image"]["name"]!=''){
                    $file=$_FILES["image"]["name"];
                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                        if( $ext == 'jpeg' || $ext == 'jpg' || $ext == 'png'){
                        $foll=rand(1111,9999)."_".$file;
                        $pathh="category_image/".$foll;                 
                        $tmpp=$_FILES["image"]["tmp_name"];
                        move_uploaded_file($tmpp,$pathh);
                        unlink('category_image/'.$select_result['cat_image']);
                        }
                    }
                    else{
                        $foll = $select_result['cat_image'];
                    }

                    // if($_FILES["image1"]["name"]!=''){
                    // $file1=$_FILES["image1"]["name"];
                    // $ext = pathinfo($file1, PATHINFO_EXTENSION);
                    //     if( $ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' ){
                    //     $foll1=rand(1111,9999)."_".$file1;
                    //     $pathh1="category_image/".$foll1;                
                    //     $tmpp1=$_FILES["image1"]["tmp_name"];
                    //     move_uploaded_file($tmpp1,$pathh1);
                    //     unlink('category_image/'.$select_result['sub_img1']);
                    //     }
                    // }
                    // else{
                    //     $foll1=$select_result['sub_img1'];
                    // }

                    // if($_FILES["image2"]["name"]!=''){
                    // $file2=$_FILES["image2"]["name"];
                    // $ext = pathinfo($file2, PATHINFO_EXTENSION);
                    //     if( $ext == 'jpeg' || $ext == 'jpg' ||$ext == 'png' ){
                    //     $foll2=rand(1111,9999)."_".$file2;
                    //     $pathh2="category_image/".$foll2;                 
                    //     $tmpp2=$_FILES["image2"]["tmp_name"];
                    //     move_uploaded_file($tmpp2,$pathh2);
                    //     unlink('category_image/'.$select_result['sub_img2']);
                    //     }
                    // }
                    // else{
                    //     $foll2=$select_result['sub_img2'];
                    // }
                    
                    // if($_FILES["image3"]["name"]!=''){
                    // $file3=$_FILES["image3"]["name"];
                    // $ext = pathinfo($file3, PATHINFO_EXTENSION);
                    //     if( $ext == 'jpeg' || $ext == 'jpg' ||$ext == 'png' ){
                    //     $foll3=rand(1111,9999)."_".$file3;
                    //     $pathh3="category_image/".$foll3;                 
                    //     $tmpp3=$_FILES["image3"]["tmp_name"];
                    //     move_uploaded_file($tmpp3,$pathh3);
                    //     unlink('category_image/'.$select_result['sub_img3']);
                    //     }
                    // }
                    // else{
                    //     $foll3=$select_result['sub_img3'];
                    // }

                    $sql = "UPDATE `category` SET `cat_name`='$category_name' WHERE `cat_id`='".$_GET['id']."'";
                    $query = mysqli_query($conn,$sql);
                    if($query){
                    move_uploaded_file($tmpp,$pathh1);
                    ?>
                    
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon contrast-alert">
                        <i class="icon-info"></i>
                    </div>
                    <div class="alert-message">
                        <span><center><strong>Success !!! Category Updated Successfully</strong></center></span>
                    </div>
                </div>
                <?php
                echo '<meta http-equiv="refresh" content="2;url=manage_category.php">';
                }
                else{
                ?>
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon contrast-alert">
                        <i class="icon-info"></i>
                    </div>
                    <div class="alert-message">
                        <span><center><strong>Sorry !!! Please Try Again</strong></center></span>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
                <form id="personal-info" method="post" enctype="multipart/form-data">
                <h4 class="form-header">
                  <i class="fa fa-file-text-o"></i>
                  EDIT CATEGORY
                </h4>

                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <input type="text" name="category_name" id="category_name" class="form-control" value="<?=$category?>" required>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Main Image</label>
                    <div class="col-sm-6">
                        <input type="file" name="image" id="img" class="form-control" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="col-sm-4">
                        <img src="category_image/<?=$pic?>" id="image" width="100" height="200" class="form-control">
                    </div>
                </div>
                <!--<div class="form-group row">-->
                <!--    <label for="input-5" class="col-sm-2 col-form-label">Slider Image</label>-->
                <!--    <div class="col-sm-6">-->
                <!--        <input type="file" name="image1" id="img1"  class="form-control" placeholder="Product Amount"  onchange="document.getElementById('image1').src = window.URL.createObjectURL(this.files[0])">-->
                        <!--<span>Image Size Should Be 120 x 400</span>-->
                <!--    </div>-->
                <!--    <div class="col-sm-4">-->
                <!--        <img src="category_image/<?//=$select_result['sub_img1']?>" id="image1" width="100" height="200" class="form-control">-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="form-group row">-->
                <!--    <label for="input-5" class="col-sm-2 col-form-label">Slider Image</label>-->
                <!--    <div class="col-sm-6">-->
                <!--        <input type="file" name="image2" id="img2"  class="form-control" placeholder="Product Amount"  onchange="document.getElementById('image2').src = window.URL.createObjectURL(this.files[0])">-->
                        <!--<span>Image Size Should Be 120 x 400</span>-->
                <!--    </div>-->
                <!--    <div class="col-sm-4">-->
                <!--        <img src="category_image/<?//=$select_result['sub_img2']?>" id="image2" width="100" height="200" class="form-control">-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="form-group row">-->
                <!--    <label for="input-5" class="col-sm-2 col-form-label">Slider Image</label>-->
                <!--    <div class="col-sm-6">-->
                <!--        <input type="file" name="image3" id="img3"  class="form-control" placeholder="Product Amount"  onchange="document.getElementById('image3').src = window.URL.createObjectURL(this.files[0])">-->
                        <!--<span>Image Size Should Be 120 x 400</span>-->
                <!--    </div>-->
                <!--    <div class="col-sm-4">-->
                <!--        <img src="category_image/<?//=$select_result['sub_img3']?>" id="image3" width="100" height="200" class="form-control">-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Slider Image</label>
                    <div class="col-sm-6">
                        <input type="file" name="image4" id="img4"  class="form-control" placeholder="Product Amount"  onchange="document.getElementById('image4').src = window.URL.createObjectURL(this.files[0])">
                        
                    </div>
                    <div class="col-sm-4">
                        <img src="category_image/<?//=$select_result['sub_img4']?>" id="image4" width="100" height="200" class="form-control">
                    </div>
                </div>-->
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