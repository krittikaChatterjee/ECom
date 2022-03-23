<?php
include('header.php');
include('sidebar.php');

// fetch coupon details 
$coupon_id = $_REQUEST['id'];
$fetch_coupon_det = "SELECT * FROM `coupon` WHERE `coupon_id`='$coupon_id'";
$fetch_coupon_det_read = mysqli_query($conn,$fetch_coupon_det);
$row_coupon = mysqli_fetch_array($fetch_coupon_det_read);



 ?>
  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Coupon</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Coupon</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Add Coupon</li>
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
                    	 $cupon_name=mysqli_real_escape_string($conn,$_POST['cupon_name']);
                        $start_date =mysqli_real_escape_string($conn, $_POST['start_date']);

                        $end_date=mysqli_real_escape_string($conn,$_POST['end_date']);
                        $max_use_user =mysqli_real_escape_string($conn, $_POST['max_use_user']);
                        $dis_percentsge = mysqli_real_escape_string($conn,$_POST['dis_percentsge']);
                        
                        $check_query="SELECT * FROM `coupon` WHERE `coupon_name`='$cupon_name' AND coupon_id!= '$coupon_id'";
                        $check_data=mysqli_query($conn,$check_query);
                        $check_row=mysqli_num_rows($check_data);
                        if($check_row>0)
                        {
                ?>
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon contrast-alert">
                      <i class="icon-info"></i>
                    </div>
                    <div class="alert-message">
                      <span><center><strong> Sorry!! Coupon Name Already Exist.. </strong></center></span>
                    </div>
                </div>
                <?php
                            echo '<meta http-equiv="refresh" content="2;url=manage_coupon.php">';
                        }
                        else
                        {
                            
                            
                                    
                                    
                                   
                                    $sql="UPDATE `coupon` SET `coupon_name`='$cupon_name',`dis_per`='$dis_percentsge' WHERE `coupon_id`='$coupon_id'";
                                  
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
                        <span><center><strong> Success !!! Coupon Updates Successfully </strong></center></span>
                    </div>
                </div>
                <?php
                    echo '<meta http-equiv="refresh" content="2;url=manage_coupon.php">';
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
                  ADD COUPON   
                </h4>

                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Coupon Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="cupon_name" class="form-control" placeholder="Coupon Name" required value="<?=$row_coupon['coupon_name']?>">

                  </div>
                </div>

                 

                 <!--<div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Start Date</label>
                  <div class="col-sm-10">
                    <input type="date" name="start_date" class="form-control" required value="<?=$row_coupon['start_date']?>">

                  </div>
                </div>-->
                
               <!-- <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">End Date</label>
                  <div class="col-sm-10">
                     <input type="date" name="end_date" class="form-control" required value="<?=$row_coupon['end_date']?>">
                  </div>
                </div>-->
                
                <!--<div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Max Use User</label>
                  <div class="col-sm-10">
                    <input type="number" name="max_use_user"  class="form-control" required value="<?=$row_coupon['max_user']?>">
                  </div>
                </div>-->
                
                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Discount Amount</label>
                  <div class="col-sm-10">
                    <input type="number" name="dis_percentsge"  class="form-control" required value="<?=$row_coupon['dis_per']?>">
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