<?php 
 include('header.php');
 include('sidebar.php');
 ?>
  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Banner</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item">Banner</li>
            <li class="breadcrumb-item active" aria-current="page">Add Banner</li>
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

                        $title=mysqli_real_escape_string($conn,$_POST['title']);
                        $category_name=mysqli_real_escape_string($conn,$_POST['category_name']);
                        $description=mysqli_real_escape_string($conn,$_POST['description']);
                        date_default_timezone_set('Asia/Kolkata'); 
                        $datee =date("Y-m-d ");
                        $time=date('g:i a'); 
                 
                   
                            $img=$_FILES["image"]["name"]; 
                            $ext = pathinfo($img, PATHINFO_EXTENSION);
                            if( $ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' )
                            {
                                if($img!='')
                                {
                                    $foll=rand(1111,9999)."_".$img;
                                    $pathh1="poster_image/".$foll;                            
                                    $tmpp=$_FILES["image"]["tmp_name"];
                                    move_uploaded_file($tmpp,$pathh1);
                    
                                }
                                $sql = "INSERT INTO poster(name,title,description,date,time) VALUES('$foll','$title','$description','$datee','$time')";
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
                        <span><center><strong> Success !!! Banner Inserted Successfully </strong></center></span>
                    </div>
                </div>
                <?php
                      echo '<meta http-equiv="refresh" content="2;url=add_poster.php">';
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
                  ADD Poster
                </h4>

                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-6">
                        <input type="text" name="title" id="title"  class="form-control" placeholder="Title"  required>
                      
                    </div>
                  
                </div>

                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-6">
                        <textarea type="text" name="description" id="description"  class="form-control" placeholder="Title"  required> </textarea>
                      
                    </div>
                  
                </div>


               
                
                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Upload Banner Image</label>
                    <div class="col-sm-6">
                        <input type="file" name="image" id="img" class="form-control" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])" required>
                        <!--<span>Image Size Should Be 120 x 400</span>-->
                    </div>
                    <div class="col-sm-4">
                        <img src="assets/images/product_image.png" id="image" width="100" height="200" class="form-control">
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