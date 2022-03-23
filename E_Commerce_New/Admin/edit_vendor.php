<?php 
 include('header.php');
 include('sidebar.php');
 ?>
  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Edit Vendor</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Vendor</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Edit Vendor</li>
         </ol>
       </div>
     </div><!-- End Breadcrumb-->

     <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <?php
                $sql=mysqli_query($conn,"SELECT * FROM farmer_vendor WHERE id='".base64_decode($_REQUEST['id'])."'");
                $fethc=mysqli_fetch_assoc($sql);
                $fullname=explode(' ',$fethc['name']);
                    if(isset($_POST['submitbtn']))
                    {
                        date_default_timezone_set('Asia/Kolkata'); 
                        $date=date('Y-m-d');
                     
                        $frist_name=mysqli_real_escape_string($conn,$_POST['frist_name']);
                        $last_name=mysqli_real_escape_string($conn,$_POST['last_name']);
                        $email=mysqli_real_escape_string($conn,$_POST['email']);
                        $mobile=mysqli_real_escape_string($conn,$_POST['mobile']);
                        $address=mysqli_real_escape_string($conn,$_POST['address']);
                        $bank_name=mysqli_real_escape_string($conn,$_POST['bank_name']);
                        $account_number=mysqli_real_escape_string($conn,$_POST['account_number']);
                        $branch_name=mysqli_real_escape_string($conn,$_POST['branch_name']);
                        $ifsc_code=mysqli_real_escape_string($conn,$_POST['ifsc_code']);
                        // $type_of_user=mysqli_real_escape_string($conn,$_POST['type_of_user']);
                        $District=mysqli_real_escape_string($conn,$_POST['District']);
                        $State=mysqli_real_escape_string($conn,$_POST['State']);
                        $Company_Brand=mysqli_real_escape_string($conn,$_POST['Company_Brand']);
                        $GST=mysqli_real_escape_string($conn,$_POST['GST']);
                        
                        $img=$_FILES["image"]["name"]; 
                            $ext = pathinfo($img, PATHINFO_EXTENSION);
                            if( $ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' )
                            {
                                if($img!='')
                                {
                                    $foll=rand(1111,9999)."_".$img;
                                    $pathh1="vender_farmer/".$foll;                            
                                    $tmpp=$_FILES["image"]["tmp_name"];
                                     move_uploaded_file($tmpp,$pathh1);
                                }
                            }else{
                                    $foll = $fethc['image'];
                                }
                            
                      
                        $password=mysqli_real_escape_string($conn,$_POST['password']);
                        $password2=md5($password);
                        $fullname=$frist_name.' '.$last_name;
                 
                        $check_query="SELECT * FROM `farmer_vendor` WHERE `mobile`='$mobile' AND id!='".base64_decode($_REQUEST['id'])."'";
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
                              <span><center><strong> Sorry!! Mobile Number Already Exist.. </strong></center></span>
                            </div>
                        </div>
                        <?php
                            echo '<meta http-equiv="refresh" content="2;url=view-statement-vendor.php">';
                        }
                        else
                        {
                            
                            
                          
                           $update="UPDATE `farmer_vendor` SET `name`='$fullname',`email`='$email',`mobile`='$mobile',`password`='$password',`address`='$address',`bank_name`='$bank_name',`account_number`='$account_number',`branch_name`='$branch_name',`ifsc_code`='$ifsc_code',`image`='$foll',`District`='$District',`State`='$State',`Company_Brand`='$Company_Brand',`GST`='$GST'  WHERE id='".base64_decode($_REQUEST['id'])."'";
                           $update_read = mysqli_query($conn,$update);
                            if($update_read==true){?>
                               <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <div class="alert-icon contrast-alert">
                                      <i class="icon-info"></i>
                                    </div>
                                    <div class="alert-message">
                                      <span><center><strong>well done!  Update  Successfully </strong></center></span>
                                    </div>
                                </div> 
                            <?php
                            echo '<meta http-equiv="refresh" content="2;url=view-statement-vendor.php">';
                            }else{
                            
                           
                                ?>
                                  <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <div class="alert-icon contrast-alert">
                                      <i class="icon-info"></i>
                                    </div>
                                    <div class="alert-message">
                                      <span><center><strong> Sorry!! Something Went Wrong.. </strong></center></span>
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
                 EDIT FARMER & VENDOR
                </h4>
                  <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Frist Name</label>
                  <div class="col-sm-4">
                    <input type="text" name="frist_name" id="frist_name" class="form-control" value="<?=$fethc['name']?>" placeholder="Frist Name" required>
                  </div>
                   <label for="input-5" class="col-sm-2 col-form-label">Mobile No.</label>
                  <div class="col-sm-4">
                    <input type="text" name="mobile" id="mobile" maxlength="10" class="form-control" placeholder="Mobile No" required value="<?=$fethc['mobile']?>">
                  </div>
                </div>
                
                <!--<div class="form-group row">-->
                <!--  <label for="input-5" class="col-sm-2 col-form-label">Name</label>-->
                <!--  <div class="col-sm-10">-->
                <!--    <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>-->
                <!--  </div>-->
                <!--</div>-->
                
                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Email Id</label>
                  <div class="col-sm-4">
                    <input type="email" name="email" id="email" class="form-control" value="<?=$fethc['email']?>" placeholder="Email Id" required>
                  </div>
                  
                   <label for="input-5" class="col-sm-2 col-form-label">District</label>
                  <div class="col-sm-4">
                    <input type="text" name="District" id="District" class="form-control" placeholder="District" required value="<?=$fethc['District']?>">
                    <p class="mess"></p>
                  </div>
                </div>
                
                <!--<div class="form-group row">-->
                <!--  <label for="input-5" class="col-sm-2 col-form-label">Mobile No</label>-->
                <!--  <div class="col-sm-10">-->
                <!--    <input type="text" name="mbl_no" id="mbl_no" class="form-control" placeholder="Mobile No" required>-->
                <!--  </div>-->
                <!--</div>-->
                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-4">
                    <input type="text" name="password" id="password" value="<?=$fethc['password']?>" class="form-control" placeholder="PASSWORD" required>
                  </div>
                   <label for="input-5" class="col-sm-2 col-form-label">State</label>
                  <div class="col-sm-4">
                    <input type="text" name="State" id="State" class="form-control" placeholder="State" required value="<?=$fethc['State']?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Company / Brand</label>
                  <div class="col-sm-4">
                    <input type="text" name="Company_Brand" id="Company_Brand" class="form-control" placeholder="Company / Brand" required value="<?=$fethc['Company_Brand']?>">
                  </div>
                   <label for="input-5" class="col-sm-2 col-form-label">GST</label>
                  <div class="col-sm-4">
                   <input type="text" name="GST" id="GST" class="form-control" placeholder="GST" required value="<?=$fethc['GST']?>">
                  </div>
                </div>
                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Upload Image</label>
                    <div class="col-sm-6">
                        <input type="file" name="image" id="img"  class="form-control" placeholder="Product Amount"  onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                        <!--<span>Image Size Should Be 120 x 400</span>-->
                    </div>
                    <div class="col-sm-4">
                        <img src="vender_farmer/<?=$fethc['image']?>" id="image" width="100" height="200" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Address</label>
                  <div class="col-sm-10">
                    <textarea name="address" id="address" class="form-control" placeholder="Address"  required><?=$fethc['address']?></textarea>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Bank Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="bank_name" id="bank_name" value="<?=$fethc['bank_name']?>" class="form-control" placeholder="Bank Name" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Account Number</label>
                  <div class="col-sm-10">
                    <input type="text" name="account_number" id="account_number" value="<?=$fethc['account_number']?>" class="form-control" placeholder="Account Number" required>
                  </div>
                </div>
                 <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Branch Name</label>
                  <div class="col-sm-10">
                    <input type="text"  name="branch_name" id="branch_name" value="<?=$fethc['branch_name']?>" class="form-control" placeholder="Branch Name" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">IFSC CODE</label>
                  <div class="col-sm-10">
                    <input type="text"  name="ifsc_code" id="ifsc_code" class="form-control" value="<?=$fethc['ifsc_code']?>"  placeholder="IFSC CODE" required>
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
    <script src="assets/plugins/jquery-multi-select/jquery.multi-select.js"></script>
    <script src="assets/plugins/jquery-multi-select/jquery.quicksearch.js"></script>
      <script>
        $(document).ready(function() {
            $('.single-select').select2();
      
            $('.multiple-select').select2();

        //multiselect start

            $('#selectQQ').multiSelect();
            
          });
    
    
     $("#mobile").keyup(function(){
      var sat = $(this).val();
      var id='<?=base64_decode($_REQUEST['id'])?>';
     var  mobile =sat.trim();
      if(mobile !=''){
    //   alert(mobile);
    $.ajax({
        url:'api/update-mobile-check.php',
        type:'POST',
        data: { mobile : mobile, id : id },
        success:function(data){
            // alert(data);
            var myObj=JSON.parse(data);
            
            if(myObj.status=='new'){
              
                $(".mess").html(' ');
                 
                $(".btn").removeAttr('disabled');
            }else  if(myObj.status=='exist'){
                
                 $(".mess").html('<p class="mess text-danger" style="color:red;">Already  Exist!!</p>');
                  $(".btn").attr('disabled',true); 
                  
            }else  if(myObj.status=='blank'){
                //  $(".mess").css("display":"none");
            }
            
        }
    })
      }
     
    });
    </script>