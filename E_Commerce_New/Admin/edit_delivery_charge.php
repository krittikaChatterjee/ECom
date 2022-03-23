<?php
include('header.php');
include('sidebar.php');
 ?>
 <style>
 	.marg {
 		margin: 0 16px;
 	}
 </style>
  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Delivery Charge</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <!--<li class="breadcrumb-item"><a href="#">Products</a></li>-->
            <li class="breadcrumb-item active" aria-current="page">Update Delivery Charge</li>
         </ol>
       </div>
     </div><!-- End Breadcrumb-->

     <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <?php
                 date_default_timezone_set('Asia/Kolkata'); 
                 $datee=date("Y-m-d");   
                 $time=date("g:i a");
                 $quesy=mysqli_query($conn,"SELECT * FROM delivery_charges");
                 $query_rows=mysqli_num_rows($quesy);
                 $get_data=mysqli_fetch_assoc($quesy);
                    if(isset($_POST['submitbtn'])){
                    $amount=mysqli_real_escape_string($conn,$_POST['amount']);
                    $delivery_charge=mysqli_real_escape_string($conn,$_POST['delivery_charge']);
                    
                    if($query_rows==0){
                        $insert=mysqli_query($conn,"INSERT INTO delivery_charges (`amount`,`delivery_charge`) VALUES ('$amount','$delivery_charge')");
                    }
                    else{
                        $update=mysqli_query($conn,"UPDATE `delivery_charges` SET `amount`='$amount',`delivery_charge`='$delivery_charge' WHERE id='1'");
                    }

                    ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <div class="alert-icon contrast-alert">
                            <i class="icon-info"></i>
                        </div>
                        <div class="alert-message">
                            <span><center><strong> Success !!! Delivery Details Update Successfully </strong></center></span>
                        </div>
                    </div>
                    <?php
                    echo '<meta http-equiv="refresh" content="2;url=edit_delivery_charge.php">';
                }
                ?>
              <form id="personal-info" method="post" enctype="multipart/form-data">
                <h4 class="form-header">
                  <i class="fa fa-file-text-o"></i>
                 DELIVERY CHARGE DETAILS   
                </h4>
                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Amount</label>
                  <div class="col-sm-10">
                    <input type="text" name="amount" id="amount" class="form-control" value="<?=$get_data['amount']?>" placeholder="Amount" required>
                   
                  </div>
                </div>
                
             
                 <div class="form-group row">
                     <label for="input-5" class="col-sm-2 col-form-label">Delivery Charge</label>
                  <div class="col-sm-10">
                    <input type="text" name="delivery_charge" id="delivery_charge" class="form-control" value="<?=$get_data['delivery_charge']?>" placeholder="Delivery Charge" required>
               
                  </div>
				</div>
                
              
				   
          
                <div class="form-footer">
                    <button type="button" onclick="location.reload()" class="btn btn-danger"><i class="fa fa-times"></i> CANCEL</button>
                    <input type="submit" name="submitbtn" class="btn btn-success" value="UPDATE"> 
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
   CKEDITOR.replace( 'editor1' );
 
  
    
</script>
<?php
include('footer.php'); 
?>