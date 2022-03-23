<?php
include('header.php');
include('sidebar.php');
 ?>
  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Reply Review</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Product</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Reply Review</li>
         </ol>
       </div>
     </div><!-- End Breadcrumb-->

     <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <?php
                // fetch comment 
                $coment_id = base64_decode($_REQUEST['rating_id']);
                $fetch_comment = mysqli_query($conn,"SELECT * FROM `product_rating` WHERE id='$coment_id'");
                $fetch_comment_row = mysqli_fetch_array($fetch_comment);
                
                    if(isset($_POST['submitbtn']))
                    {
                    	 
                        
                        $Admin_Comment = mysqli_real_escape_string($conn,$_POST['Admin_Comment']);
                        
                      
                            
                            
                                    
                                    
                                   
                    $sql="UPDATE `product_rating` SET `admin_comment`='$Admin_Comment' WHERE `id`='$coment_id'";
                  
                        $query=mysqli_query($conn,$sql);
                        if($query)
                        {
                                           
                ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon contrast-alert">
                        <i class="icon-info"></i>
                    </div>
                    <div class="alert-message">
                        <span><center><strong> Success !!! Comment Added Successfully </strong></center></span>
                    </div>
                </div>
                <?php
                    echo '<meta http-equiv="refresh" content="2;url=view_rating_product.php">';
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
                  Reply Review
                </h4>

                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">User Comment</label>
                  <div class="col-sm-10">
                    <input type="text" name="cupon_name" class="form-control" placeholder="Coupon Name" value="<?=$fetch_comment_row['comment']?>" readonly>

                  </div>
                </div>

                 

                 <!--<div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Start Date</label>
                  <div class="col-sm-10">
                    <input type="date" name="start_date" class="form-control" required>

                  </div>
                </div>-->
                
                <!--<div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">End Date</label>
                  <div class="col-sm-10">
                     <input type="date" name="end_date" class="form-control" required>
                  </div>
                </div>-->
                
               <!-- <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Max Use User</label>
                  <div class="col-sm-10">
                    <input type="number" name="max_use_user"  class="form-control" required>
                  </div>
                </div>-->
                
                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label" >Admin Comment</label>
                  <div class="col-sm-10">
                    <input type="text" name="Admin_Comment"  class="form-control" required placeholder="Admin Comment" value="<?=$fetch_comment_row['admin_comment']?>">
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
  <script src="assets/js/jquery.min.js"></script>
  
  <script type="text/javascript">
  $(document).ready(function(){
    //   alert('');
  $("#categoryid").change(function () {
//    function p_type(id){
        // var category = this.val();
        var category = $("#categoryid").val();
        // alert('');
  $("#sub_category").html('');
  $("#sub_category").html('<option value="0">Select Sub Category</option>');
    $.ajax({
     
           url:'api/product_type_select.php',
           type:'post',
           data:{category:category},
           success:function(response){

            //   alert(response);
            var myData = JSON.parse(response);

            console.log(myData);
            var length = myData.length;
            for(i=0; i<length; i++) {
          var sub_category_name = myData[i].sub_category_name;
          var sub_category_id = myData[i].sub_category_id;
          var message = myData[i].message;
          if (message==0) 
          {
            // alert('No Sub Category Found');
            $("#sub_category").html('<option value="0">Select Sub Category</option>');
          }

          else{
            $("#sub_category").append(' <option value="'+sub_category_id+'">'+sub_category_name+'</option>');
          }

          

            }


           }
    });

    });

    });
</script>
<?php
include('footer.php'); 
?>