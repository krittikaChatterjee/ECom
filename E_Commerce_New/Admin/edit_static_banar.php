<?php 
 include('header.php');
 include('sidebar.php');
 ?>
  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Sliding Banner</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Sliding Banner</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Edit Sliding Banner</li>
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

               	$fetch_post=mysqli_query($conn,"SELECT * FROM sliding_banner WHERE id='$edit'");
               	$fetct_raw_poster=mysqli_fetch_assoc($fetch_post);
               	$imh_poster=$fetct_raw_poster['image'];
               	// 	$imh_poster=$fetct_raw_poster['image'];
               }

                    if(isset($_POST['submitbtn']))
                    {

                        
                        date_default_timezone_set('Asia/Kolkata'); 
                        $datee =date("Y-m-d ");
                        $time=date('g:i a'); 
                 
                   
                            $img=$_FILES["image"]["name"]; 
                            $ext = pathinfo($img, PATHINFO_EXTENSION);
                            if( $ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext =='' )
                            {
                                if($img!='')
                                {
                                    $foll=rand(1111,9999)."_".$img;
                                    $pathh1="sliding_banner/".$foll;                            
                                    $tmpp=$_FILES["image"]["tmp_name"];
                                    $del_img = "sliding_banner/".$fetct_raw_poster['image'];
                                    unlink($del_img);
                                }else{
                                	$foll=$imh_poster;
                                }
                                // $sql = "INSERT INTO poster(name,title,description,date,time) VALUES('$foll','$title','$description','$datee','$time')";

                                $update_sql=mysqli_query($conn,"UPDATE sliding_banner SET image='$foll' WHERE id='$edit'");
                                // $query = mysqli_query($conn,$sql);
                                if($update_sql)
                                {
                                    move_uploaded_file($tmpp,$pathh1);
                ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon contrast-alert">
                        <i class="icon-info"></i>
                    </div>
                    <div class="alert-message">
                        <span><center><strong> Success !!!  Updated Successfully </strong></center></span>
                    </div>
                </div>
                <?php
                      echo '<meta http-equiv="refresh" content="2;url=manage_sliding_banner.php">';
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
                            }else{
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
                            }
                            
                    }
                ?>
              <form id="personal-info" method="post" enctype="multipart/form-data">
                <h4 class="form-header">
                  <i class="fa fa-file-text-o"></i>
                  EDIT DASHBOARD BANNER
                </h4>

                <!--<div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-6">
                        <input type="text" name="title" id="title" value="<?=$fetct_raw_poster['title'];?>" class="form-control" placeholder="Title"  >
                      
                    </div>
                  
                </div>-->

                <!--<div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-6">
                        <textarea type="text" name="description" id="description"  class="form-control" placeholder="Title"  > <?=$fetct_raw_poster['description'];?></textarea>
                      
                    </div>
                  
                </div>-->


               
                
                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Upload Poster Image</label>
                    <div class="col-sm-6">
                        <input type="file" name="image" id="img"  class="form-control" placeholder="Product Amount"  onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])" >
                        <!--<span>Image Size Should Be 120 x 400</span>-->
                    </div>
                    <div class="col-sm-4">
                        <img src="sliding_banner/<?=$fetct_raw_poster['image'];?>" id="image" width="100" height="200" class="form-control">
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