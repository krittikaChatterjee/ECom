<?php 
 include('header.php');
 include('sidebar.php');
 ?>
  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Stock </h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Stock</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Add Stock</li>
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

                        $stock_number=mysqli_real_escape_string($conn,$_POST['stock_number']);
                        $product_id_pro=mysqli_real_escape_string($conn,$_POST['product_name']);
                        date_default_timezone_set('Asia/Kolkata'); 
                        $datee =date("Y-m-d ");    
                        $time=date('g:i a'); 

                        $fetch_product_id=mysqli_query($conn,"SELECT * FROM product WHERE product_id='$product_id_pro'");
                        $fetch_pro_raw=mysqli_fetch_assoc($fetch_product_id);
                        $produc_price=$fetch_pro_raw['selling_price'];
                         $product_name=$fetch_pro_raw['product_name'];
                      
                       
           
                    $sql = mysqli_query($conn,"INSERT INTO original_stock(`product_name`,`number_of_product`,`price`,`add_date`) VALUES('$product_name','$stock_number','$produc_price','$datee')");
                  
                    if($sql) {

                    // { echo "SELECT * FROM use_stock WHERE product_id='$product_id_pro'";
                         $sql_name_chk=mysqli_query($conn,"SELECT * FROM use_stock WHERE product_id='$product_id_pro'");
                         $fetch_num=mysqli_fetch_assoc($sql_name_chk);
                        $total_num= $fetch_num['number_of_product'];
                        $update= $total_num + $stock_number;
                      
                        if(mysqli_num_rows($sql_name_chk) >0){
                        $update=mysqli_query($conn,"UPDATE use_stock SET product_name='$product_name',number_of_product='$update',price='$produc_price',update_date='$datee',time='$time' WHERE product_id='$product_id_pro'");
                       
                    }else{
                    	// echo "INSERT INTO use_stock(`product_name`,`product_id`,`price`number_of_product`,`add_date`) VALUES('$product_name','$product_id_pro','$produc_price','$stock_number','$datee')";

           $sql = mysqli_query($conn,"INSERT INTO use_stock(`product_name`,`product_id`,`price`,`number_of_product`,`add_date`) VALUES('$product_name','$product_id_pro','$produc_price','$stock_number','$datee')");

                    }
                                   
                ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon contrast-alert">
                        <i class="icon-info"></i>
                    </div>
                    <div class="alert-message">
                        <span><center><strong> Success !!! Stock Inserted Successfully </strong></center></span>
                    </div>
                </div>
                <?php
                 echo '<meta http-equiv="refresh" content="1;url=add_stock.php">';
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
                  ADD Stock
                </h4>

                 <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Product Name</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="product_name" id="category_id" required>
                      <option value="0">--Select Name--</option>
                      <?php
                      $select_query=mysqli_query($conn,"SELECT * FROM `product`");
                      while($select_fetch=mysqli_fetch_assoc($select_query))
                      {
                          $category_name=$select_fetch['product_name'];
                          // $category_id=$select_fetch['cat_id'];
                          ?>
                          <option value="<?php echo $select_fetch['product_id']; ?>"><?php echo $category_name; ?></option>
                          <?php
                      }
                      
                      ?>
                     
                    </select>

                  </div>
                </div>

                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Stock</label>
                  <div class="col-sm-10">
                    <input type="number" name="stock_number" id="stock_number" class="form-control" placeholder="Number of Product" required>
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