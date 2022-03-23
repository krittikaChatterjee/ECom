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
          <h4 class="page-title">Product Stock</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Add Product Stock</li>
         </ol>
       </div>
     </div><!-- End Breadcrumb-->

     <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <?php
                date_default_timezone_set('Asia/Kolkata');
				$timestamp = date("Y-m-d ");
                
                    if(isset($_POST['submitbtn']))
                    {
                    	$Product = $_POST['Product'];
                    	$qty_stock = $_POST['qty_stock'];
                    	$product_stock_val = $_POST['product_stock'];
                    	
                    	$fetch_old_stock = "SELECT * FROM `qty_per_unit` WHERE product_id='$Product' AND qty_id='$qty_stock'";
                    	$fetch_old_stock_read = mysqli_query($conn,$fetch_old_stock);
                    	$count_old_stock = mysqli_num_rows($fetch_old_stock_read);
                    	
                    	if($count_old_stock == 0){
                    		 $ins_new_stock = "UPDATE `qty_per_unit` SET `number_of_product`='$product_stock_val0' WHERE `product_id`='$Product' AND `qty_id`='$qty_stock'";
                    		$ins_new_stock_read = mysqli_query($conn,$ins_new_stock);
                    		if($ins_new_stock_read){
                    			?>
                    			<script>
                    				swal("Success!", "Add stock Successfully!", "success");
                    			</script>
                    			<?php
                    		}
                    	}else{
                    		$row_old_stock = mysqli_fetch_array($fetch_old_stock_read);
                    		$old_stock_val = $row_old_stock['number_of_product'];
                    		$new_stock = (int)$product_stock_val+(int)$old_stock_val;
                    		
                    		 $update_stock = "UPDATE `qty_per_unit` SET `number_of_product`='$new_stock' WHERE `product_id`='$Product' AND `qty_id`='$qty_stock'";
                    		$update_stock_read = mysqli_query($conn,$update_stock);
                    		if($update_stock_read){
                    			?>
                    			<script>
                    				swal("Success!", "Add stock Successfully!", "success");
                    			</script>
                    			<?php
                    		}
                    	}
                    	
                    	
                    }
                ?>
              <form id="personal-info" method="post" enctype="multipart/form-data">
                <h4 class="form-header">
                  <i class="fa fa-file-text-o"></i>
                  ADD PRODUCT STOCK 
                </h4>

                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Product</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="Product" id="Product" required>
                      <option value="0">--Select Product--</option>
                      <?php
                      $select_query=mysqli_query($conn,"SELECT * FROM `product`");
                      while($select_fetch=mysqli_fetch_assoc($select_query))
                      {
                          $product_name=$select_fetch['product_name'];
                          $product_id=$select_fetch['product_id'];
                          ?>
                          <option value="<?php echo $product_id; ?>"><?php echo $product_name; ?></option>
                          <?php
                      }
                      
                      ?>
                     
                    </select>

                  </div>
                </div>

                 <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Quantity Stock</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="qty_stock" id="qty_stock" required>
                        <option value="">--Select Quantity Stock--</option>
                      
                     
                    </select>

                  </div>
                </div>

                
                
                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Product Stock</label>
                  <div class="col-sm-10">
                    <input type="number" name="product_stock" id="product_stock" class="form-control" placeholder="Product Stock" required >
                  </div>
                </div>
                
               
               
                
                  
                
               
          
                <div class="form-footer">
                    <button type="button" onclick="location.reload()" class="btn btn-danger"><i class="fa fa-times"></i> CANCEL</button>
                    <input type="submit" name="submitbtn" class="btn btn-success" value="SAVE"> 
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
    
    
    
    
    
    $("#Product").change(function () {

        var Product = $("#Product").val();
        // alert(Product);exit;
  
    $.ajax({
     
           url:'api/product_qty_stock.php',
           type:'post',
           data:{Product:Product},
           success:function(response){
           	$("#qty_stock").html(response);
           	
           }
    });

    });
   
 
</script>
<?php
include('footer.php'); 
?>