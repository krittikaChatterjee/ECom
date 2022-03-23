<?php 
 include('header.php');
 include('sidebar.php');
 ?>
  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Sub Category</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item">SubCategory</li>
            <li class="breadcrumb-item active" aria-current="page">Edit SubCategory</li>
         </ol>
       </div>
     </div><!-- End Breadcrumb-->

     <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <?php
                  if(isset($_REQUEST['i'])){
                  	$edit=base64_decode($_REQUEST['i']);
                  	$fethc_edit=mysqli_query($conn,"SELECT * FROM sub_category WHERE sub_id='$edit'");
                  	$fethc_raw_edit=mysqli_fetch_assoc($fethc_edit);
                  	 $cat_id=$fethc_raw_edit['catagory_id'];
                  	 $fetch_name=mysqli_query($conn,"SELECT * FROM category WHERE cat_id='$cat_id'");
                  	 $fetch_cat_nameraw=mysqli_fetch_assoc($fetch_name);
                  }
                    if(isset($_POST['submitbtn']))
                    {
                          // $id=mysqli_real_escape_string($conn,$_POST['i']);
                         date_default_timezone_set('Asia/Kolkata'); 
						$datee =date("Y-m-d ");
						$time=date('g:i a'); 

                        $sub_category_name=mysqli_real_escape_string($conn,$_POST['sub_category_name']);
                        $category=mysqli_real_escape_string($conn,$_POST['category']);

                 
                        $check_query="SELECT * FROM `sub_category` WHERE `sub_name`='$sub_category_name' AND catagory_id='$category'";
                        $check_data=mysqli_query($conn,$check_query);
                        $check_row=mysqli_num_rows($check_data);
                        if($check_row>0)
                        {
                ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon contrast-alert">
                      <i class="icon-info"></i>
                    </div>
                    <div class="alert-message">
                      <span><center><strong > Sorry!! Sub Category Already Exist.. </strong></center></span>
                    </div>
                </div>
                <?php
                            echo '<meta http-equiv="refresh" content="2;url=add_sub-category.php">';
                        }
                        else
                        {
                            // $img=$_FILES["image"]["name"];
                            
                            // $ext = pathinfo($img, PATHINFO_EXTENSION);
                            if($_FILES["image"]["name"]!='')
              {
                  $file=$_FILES["image"]["name"];
                   $ext = pathinfo($file, PATHINFO_EXTENSION);
                  if( $ext == 'jpeg' || $ext == 'jpg' ||$ext == 'png' )
                   {
                  $foll=rand(1111,9999)."_".$file;
                  $pathh="category_image/sub_category/".$foll;                 
                  $tmpp=$_FILES["image"]["tmp_name"];
                  move_uploaded_file($tmpp,$pathh);
                  unlink('category_image/sub_category/'.$fethc_raw_edit['sub_img']);
                }
                  
              }
              else
              {
                  $foll = $select_result['sub_img'];
              }


             /*if($_FILES["image1"]["name"]!='')
             {
                  $file1=$_FILES["image1"]["name"];
                   $ext = pathinfo($file1, PATHINFO_EXTENSION);
                  if( $ext == 'jpeg' || $ext == 'jpg' )
                   {
                  $foll1=rand(1111,9999)."_".$file1;
                  $pathh1="category_image/sub_category/".$foll1;                
                  $tmpp1=$_FILES["image1"]["tmp_name"];
                  move_uploaded_file($tmpp1,$pathh1);
                  unlink('category_image/sub_category/'.$fethc_raw_edit['sub_cat1']);
                }
             }
             else
             {
                 $foll1=$fethc_raw_edit['sub_cat1'];
             }
*/
              /*if($_FILES["image2"]["name"]!='')
             {
              $file2=$_FILES["image2"]["name"];
               $ext = pathinfo($file2, PATHINFO_EXTENSION);
                  if( $ext == 'jpeg' || $ext == 'jpg' )
                   {
              $foll2=rand(1111,9999)."_".$file2;
              $pathh2="category_image/sub_category/".$foll2;                 
              $tmpp2=$_FILES["image2"]["tmp_name"];
              move_uploaded_file($tmpp2,$pathh2);
              unlink('category_image/sub_category/'.$fethc_raw_edit['sub_cat2']);
            }
             }
             else
             {
                 $foll2=$fethc_raw_edit['sub_cat2'];
             }*/
            /*if($_FILES["image3"]["name"]!='')
             {
              $file3=$_FILES["image3"]["name"];
               $ext = pathinfo($file3, PATHINFO_EXTENSION);
                  if( $ext == 'jpeg' || $ext == 'jpg' )
                   {
              $foll3=rand(1111,9999)."_".$file3;
              $pathh3="category_image/sub_category/".$foll3;                 
              $tmpp3=$_FILES["image3"]["tmp_name"];
              move_uploaded_file($tmpp3,$pathh3);
              unlink('category_image/sub_category/'.$fethc_raw_edit['sub_cat3']);
            }
             }
             else
             {
                 $foll3=$fethc_raw_edit['sub_cat3'];
             }
             */
              /*if($_FILES["image4"]["name"]!='')
             {
              $file4=$_FILES["image4"]["name"];
               $ext = pathinfo($file4, PATHINFO_EXTENSION);
                  if( $ext == 'jpeg' || $ext == 'jpg' )
                   {
              $foll4=rand(1111,9999)."_".$file4;
              $pathh4="category_image/sub_category/".$foll4;                 
              $tmpp4=$_FILES["image4"]["tmp_name"];
              move_uploaded_file($tmpp4,$pathh4);
              unlink('category_image/sub_category/'.$fethc_raw_edit['sub_cat4']);
            }
             }
             else
             {
                 $foll4=$fethc_raw_edit['sub_cat4'];
             }
                */               
                               
                                $sql=mysqli_query($conn,"UPDATE sub_category SET sub_name='$sub_category_name',sub_img='$foll',`sub_cat1`='$foll1',`sub_cat2`='$foll2',`sub_cat3`='$foll3',`sub_cat4`='$foll4',date='$datee',time='$time' WHERE sub_id='$edit'");
                                if($sql)
                                {
                                    move_uploaded_file($tmpp,$pathh1);
                ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon contrast-alert">
                        <i class="icon-info"></i>
                    </div>
                    <div class="alert-message">
                        <span><center><strong> Success !!! Sub Category Updated Successfully </strong></center></span>
                    </div>
                </div>
                <?php
                        echo '<meta http-equiv="refresh" content="2;url=manage_sub-category.php">';
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
                    }
                ?>
              <form id="personal-info" method="post" enctype="multipart/form-data">
                <h4 class="form-header">
                  <i class="fa fa-file-text-o"></i>
                  ADD Sub-CATEGORY
                </h4>


                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Select Category</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="category" id="category_id"  disabled>
                        <option value="<?=$cat_id;?>"><?=$fetch_cat_nameraw['cat_name'];?></option>
                
                   </select>
                  </div>
                </div> 

                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Sub-Category</label>
                  <div class="col-sm-10">
                    <input type="text" name="sub_category_name" id="sub_category_name" class="form-control" placeholder="Category Name" value="<?=$fethc_raw_edit['sub_name'];?>" required>
                  </div>
                </div>
                
                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Main Image</label>
                    <div class="col-sm-6">
                        <input type="file" name="image" id="img"  class="form-control" placeholder="Product Amount"  onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])" >
                        <!--<span>Image Size Should Be 120 x 400</span>-->
                    </div>
                    <div class="col-sm-4">
                        <img src="category_image/sub_category/<?=$fethc_raw_edit['sub_img'];?>" id="image" width="100" height="200" class="form-control">
                    </div>
                </div>
                <!--<div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Upload Image</label>
                    <div class="col-sm-6">
                        <input type="file" name="image1" id="img1"  class="form-control" placeholder="Product Amount"  onchange="document.getElementById('image1').src = window.URL.createObjectURL(this.files[0])" >
                        
                    </div>
                    <div class="col-sm-4">
                        <img src="category_image/sub_category/<?=$fethc_raw_edit['sub_cat1'];?>" id="image1" width="100" height="200" class="form-control">
                    </div>
                </div>-->
                <!--<div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Upload Image</label>
                    <div class="col-sm-6">
                        <input type="file" name="image2" id="img2"  class="form-control" placeholder="Product Amount"  onchange="document.getElementById('image2').src = window.URL.createObjectURL(this.files[0])" >
                        
                    </div>
                    <div class="col-sm-4">
                        <img src="category_image/sub_category/<?=$fethc_raw_edit['sub_cat2'];?>" id="image2" width="100" height="200" class="form-control">
                    </div>
                </div>-->
               <!-- <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Upload Image</label>
                    <div class="col-sm-6">
                        <input type="file" name="image3" id="img3"  class="form-control" placeholder="Product Amount"  onchange="document.getElementById('image3').src = window.URL.createObjectURL(this.files[0])" >
                        
                    </div>
                    <div class="col-sm-4">
                        <img src="category_image/sub_category/<?=$fethc_raw_edit['sub_cat3'];?>" id="image3" width="100" height="200" class="form-control">
                    </div>
                </div>-->
                <!--<div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Upload Image</label>
                    <div class="col-sm-6">
                        <input type="file" name="image4" id="img4"  class="form-control" placeholder="Product Amount"  onchange="document.getElementById('image4').src = window.URL.createObjectURL(this.files[0])" >
                        
                    </div>
                    <div class="col-sm-4">
                        <img src="category_image/sub_category/<?=$fethc_raw_edit['sub_cat4'];?>" id="image4" width="100" height="200" class="form-control">
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
  
<?php 
include('footer.php');
?>