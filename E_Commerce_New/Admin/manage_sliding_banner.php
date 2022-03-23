<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php
if(isset($_REQUEST['submit']))
{
	if($_FILES["image"]["name"]!='')
    {
    $flag=0;
    $fileName1 = $_FILES["image"]["name"]; 
    $fileTmpLoc1 = $_FILES["image"]["tmp_name"]; 
    $fileType1 = $_FILES["image"]["type"]; 
    $fileSize1 = $_FILES["image"]["size"]; 
    $fileErrorMsg1 = $_FILES["image"]["error"]; 


    $name1=time() . '_' .$fileName1;
    $target1=$target1.basename($name1);
    $type1=pathinfo($target1,PATHINFO_EXTENSION);
    $mimeArray1 = array('image/jpeg','image/png','application/pdf');
    
      if (!in_array($fileType1, $mimeArray1)) 
          {
            $msg='Only jpg,jpeg,pdf files format are allowed to Upload';
            $flag=1;
          }
      else if ($fileSize1 > 1024000000) 
          {
            $msg='File is too large. File must be less than 100 MB';
            $flag=1;
          }
      
      if($flag==0)
          {
          move_uploaded_file($fileTmpLoc1, "sliding_banner/$name1");
          }
    } 
    $insert="INSERT INTO `sliding_banner`(`image`) VALUES ('$name1')";
    $result=mysqli_query($conn,$insert);
}
?>
<style type="text/css">
	.img_posert{
    width: 177px;
    height: 90px;
}

</style>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Sliding Banner </h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <!--<li class="breadcrumb-item">Poster</li>-->
              <li class="breadcrumb-item active" aria-current="page">Sliding Banner </li>
           </ol>
       </div>
      </div><!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Sliding Banner</div>
            <div class="card-body">
            <form id="frmImage" method="post" enctype="multipart/form-data">
                <h4 class="form-header">
                  <i class="fa fa-file-text-o"></i>
                 ADD Banner
                </h4>
                  <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Upload Banner</label>
                    <div class="col-sm-6">
                        <!--<input type="file" name="image" id="img"  class="form-control" required>-->
                        <input type="file" class="form-control" name="image" required>
                        <!--<span>Image Size Should Be 120 x 400</span>-->
                    </div>
                    <input type="submit" class="btn btn-success" name="submit" value="ADD">
                    <!--<button class="btn btn-success"	 onclick="upload_banar()">ADD</button>-->
                    <!--<button type="submit" name="submitbtn" class="btn btn-success" onclick="uploadImage()"><i class="fa fa-check-square-o"></i> ADD</button>-->
                </div>
              </form>
              <div class="table-responsive">
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                    <tr>
                        <th>Sl. Number</th>
                        <th>Banar</th>   
                        <!--<th>Use For</th>   -->
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    if(isset($_REQUEST['del_id']))
                    {
                      $del_id=base64_decode($_REQUEST['del_id']);
                      $d_query = mysqli_query($conn,"SELECT * FROM `sliding_banner` WHERE `id`='$del_id'");  
                      $d_result = mysqli_fetch_assoc($d_query);
                      $_SESSION['del_img'] = "sliding_banner/".$d_result['image'];
                      $delete_query=mysqli_query($conn,"DELETE FROM `sliding_banner` WHERE `id`='$del_id'");
                      if($delete_query)
                      {
                        unlink($_SESSION['del_img']);
                        echo '<script>swal("Successful", "You have successfully deleted", "success")</script>';
                        echo "<script>
                                setTimeout(function() {
                                    window.location='manage_sliding_banner.php'
                                }, 3000);
                            </script>";
                      }
                    }
                    $c=1;
                    $sql="SELECT * FROM sliding_banner";
                    $queary=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($queary))
                    {
                      $id=$row['id'];
                      $poster=$row['image'];
                   
                  ?>
                    <tr>
                      <td><?php echo $c;  ?></td>
                      
                      <td><img src="sliding_banner/<?php echo $poster;  ?>" alt="" class="img_posert">  </td>

                     <!--<td><?php echo $row['use_for'];  ?></td>-->
                   
                      <td><a href="edit_static_banar.php?i=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-edit"></i></td>
                      <td><a href="manage_sliding_banner.php?del_id=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-trash"></i></td>
                    </tr>
                  <?php
                      $c++;
                    }

                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Sl. Number</th>
                      <th>Banar</th>
                        <!--<th>Use For</th> -->
                        <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div><!-- End Row-->
    </div><!-- End container-fluid-->
  </div><!-- End content-wrapper-->
   <script type="text/javascript">

  	 //function change_status(id)
    //   {
    //       //alert(id);
    //     $.ajax({
    //         type:"post",
    //         url:"api/accept_posterStatus.php",
    //         data:{id:id},
    //         beforeSend: function() {
    //             $(".status_"+id).html('Processing...');
    //         },
    //         success:function(data)
    //         { 
    //             // alert(data);
    //             var jsonObj = JSON.parse(data);
    //             // alert(jsonObj.status);
    //             if(jsonObj.status == 'a')
    //             {
    //                 $(".status_"+id).html('Approve');
    //                 $(".status_"+id).css('background-color','#15ca20');
    //                 $(".status_"+id).css('border','1px solid #15ca20');
    //             }
    //             else if(jsonObj.status == 'in')
    //             {
    //                 $(".status_"+id).html('Disapprove');
    //                 $(".status_"+id).css('background-color','#bd2130');
    //                 $(".status_"+id).css('border','1px solid #bd2130');
    //             }
    //         }
    //     })
    //   }
					// function upload_banar(){
					// 		fetch( 'api/upload_banar.php' , {
					//         method :"POST",
					//         body : new FormData( document.getElementById('frmImage'))
					// 		})
					// 	}
  </script>
 <!-- <script type="text/javascript">-->
	<!--function uploadImage(){-->
	<!--	     $.ajax({-->
 <!--            type:"post",-->
 <!--            url:"api/upload_banar.php",-->
 <!--            data:new FormData( document.getElementById('frmImage')),-->
 <!--         success:function(data)-->
 <!--           { -->
    
 <!--           }-->
 <!--        });-->
	<!--}-->
 <!-- </script>-->
<?php include('footer.php'); ?>