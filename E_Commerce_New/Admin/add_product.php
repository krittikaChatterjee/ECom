<?php
include('header.php');
include('sidebar.php');
// include('connection.php');
 ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
.marg{
margin: 0 16px;
}
</style>
<div class="content-wrapper">
    <div class="container-fluid">
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Products</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item">Products</li>
            <li class="breadcrumb-item active" aria-current="page">Add Product</li>
         </ol>
       </div>
     </div><!-- End Breadcrumb-->

     <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <?php
                    if(isset($_POST['submitbtn'])){
                        $sub_category =mysqli_real_escape_string($conn, $_POST['sub_category']);

                        $category_id=mysqli_real_escape_string($conn,$_POST['category_id']);
                        $product_name =mysqli_real_escape_string($conn, $_POST['product_name']);
                        $product_price = $_POST['product_price'];
                        $product_selling_price ='';
                        $gst_percentage ='0';
                        $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);
                        
                        $quantity_unit= $_POST['quantity_unit'];
                        $persentage_of= $_POST['persentage_of'];
                        
                        $unit=$_POST['unit'];
                        $discount_price=$_POST['discount_price'];
                        
                        $imp_product_price = '';
		                  foreach($product_price as $key=>$product_pricee)
		                  {
		                      if($product_pricee!='')
		                      {
		                        $imp_product_pricee .= $product_pricee.',';
		                      }
		                  }
		                  $imp_product_price= rtrim($imp_product_pricee,',');
		                  
		                  $imp_quantity_unit = '';
		                  foreach($quantity_unit as $key=>$quantity_unitt)
		                  {
		                      if($quantity_unitt!='')
		                      {
		                        $imp_quantity_unitt .= $quantity_unitt.',';
		                      }
		                  }
		                  $imp_quantity_unit= rtrim($imp_quantity_unitt,',');
		                  
		                  $imp_unit = '';
		                  foreach($unit as $key=>$unitt)
		                  {
		                      if($unitt!='')
		                      {
		                        $imp_unitt .= $unitt.',';
		                      }
		                  }
		                  $imp_unit= rtrim($imp_unitt,',');
		                  
		                  $imp_discount_price = '';
		                  foreach($discount_price as $key=>$discount_pricee)
		                  {
		                      if($discount_pricee!='')
		                      {
		                        $imp_discount_pricee .= $discount_pricee.',';
		                      }
		                  }
		                  $imp_discount_price= rtrim($imp_discount_pricee,',');
		                  
                        
                        // $imp_product_price = implode(",",$product_price);
                        // $imp_quantity_unit = implode(",",$quantity_unit);
                        // $imp_unit = implode(",",$unit);
                        // $imp_discount_price = implode(",",$discount_price);
                        $quantity='';
                        $discount='';
                        
                        $r_quantity='';
                        $r_discount='';
                        
                        $i_quantity='';
                        $i_discount='';
                        
                        $date = date("Y-m-d");
                        
                 
                        $check_query="SELECT * FROM `product` WHERE `product_name`='$product_name' AND `category_id`= '$category_id'";
                        $check_data=mysqli_query($conn,$check_query);
                        $check_row=mysqli_num_rows($check_data);
                        if($check_row>0)
                        {
                        ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <div class="alert-icon contrast-alert">
                              <i class="icon-info"></i>
                            </div>
                            <div class="alert-message">
                              <span><center><strong> Sorry!! Product Already Exist.. </strong></center></span>
                            </div>
                        </div>
                        <?php
                            echo '<meta http-equiv="refresh" content="2;url=add_product.php">';
                        }
                        else
                        {
                            $img=$_FILES["image"]["name"];
                            $img1=$_FILES["sub_image1"]["name"];
                            $img2=$_FILES["sub_image2"]["name"];
                            $img3=$_FILES["sub_image3"]["name"];
                            $img4=$_FILES["sub_image4"]["name"];
                            if($img!='')
                            {
                               $ext = pathinfo($img, PATHINFO_EXTENSION); 
                               if( $ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' )
                               {
                                    $foll=rand(1111,9999)."_".$img;
                                    $pathh="product_image/".$foll;                            
                                    $tmpp=$_FILES["image"]["tmp_name"];
                                    if($img1 !='')
                                    {
                                        $ext1 = pathinfo($img1, PATHINFO_EXTENSION);
                                        if( $ext1 == 'gif' || $ext1 == 'png' || $ext1 == 'jpg' || $ext1 == 'jpeg' )
                                        {
                                            $foll1=rand(1111,9999)."_".$img1;
                                            $pathh1="product_image/".$foll1;                            
                                            $tmpp1=$_FILES["sub_image1"]["tmp_name"];
                                        }
                                    }
                                    
                                    if($img2 !='')
                                    {
                                        $ext2 = pathinfo($img2, PATHINFO_EXTENSION);
                                        if( $ext2 == 'gif' || $ext2 == 'png' || $ext2 == 'jpg' || $ext2 == 'jpeg' )
                                        {
                                            $foll2=rand(1111,9999)."_".$img2;
                                            $pathh2="product_image/".$foll2;                            
                                            $tmpp2=$_FILES["sub_image2"]["tmp_name"];
                                        }
                                    }
                                    
                                    if($img3 !='')
                                    {
                                        $ext3 = pathinfo($img3, PATHINFO_EXTENSION);
                                        if( $ext3 == 'gif' || $ext3 == 'png' || $ext3 == 'jpg' || $ext3 == 'jpeg' )
                                        {
                                            $foll3=rand(1111,9999)."_".$img3;
                                            $pathh3="product_image/".$foll3;                            
                                            $tmpp3=$_FILES["sub_image3"]["tmp_name"];
                                        }
                                    }
                                    
                                    if($img4 !='')
                                    {
                                        $ext4 = pathinfo($img4, PATHINFO_EXTENSION);
                                        if( $ext4 == 'gif' || $ext4 == 'png' || $ext4 == 'jpg' || $ext4 == 'jpeg' )
                                        {
                                            $foll4=rand(1111,9999)."_".$img4;
                                            $pathh4="product_image/".$foll4;                            
                                            $tmpp4=$_FILES["sub_image4"]["tmp_name"];
                                        }
                                    }
                                    
                                    $sql="INSERT INTO product (`category_id`,`sub_cat_id`,`product_name`,`quantity_per_unit`,`unittt`,`price`,`product_description`,`main_image`,`sub_img1`,`sub_img2`,`sub_img3`,`sub_img4`,`product_discount_price`,`persentage_of`,`status`,`bestseller_product`,`featured_product`) VALUES ('$category_id','$sub_category','$product_name','$imp_quantity_unit','$imp_unit','$imp_product_price','$product_description','$foll','$foll1','$foll2','$foll3','$foll4','$imp_discount_price','$persentage_of','Y','N','N')";
                                  
                                    $query=mysqli_query($conn,$sql);
                                    $last_id = mysqli_insert_id($conn);
                                    if($query){
                                    move_uploaded_file($tmpp,$pathh);
                                    move_uploaded_file($tmpp1,$pathh1);
                                    move_uploaded_file($tmpp2,$pathh2);
                                    move_uploaded_file($tmpp3,$pathh3);
                                    move_uploaded_file($tmpp4,$pathh4);
                                            
                                    foreach($_POST['quantity_unit'] as $key=> $vall){
			                        $quantity_unitt = $vall;
			                        $unitt = $_POST['unit'][$key];
			                        $product_pricee = $_POST['product_price'][$key];
			                        $discount_pricee = $_POST['discount_price'][$key];
			                                    	
			                        if($discount_pricee != ''){
			                        $ins2 = "INSERT INTO `qty_per_unit`( `product_id`, `qtu_per_unit`, `unit`, `product_price`, `discount_price`) VALUES ('$last_id','$quantity_unitt','$unitt','$product_pricee','$discount_pricee')";
			                        $ins2_read = mysqli_query($conn,$ins2);
			                        }
                                }
                                ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon contrast-alert">
                        <i class="icon-info"></i>
                    </div>
                    <div class="alert-message">
                        <span><center><strong> Success !!! Product Inserted Successfully </strong></center></span>
                    </div>
                </div>
                <?php
                    // echo '<meta http-equiv="refresh" content="2;url=add_product.php">';
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
                                   echo '<meta http-equiv="refresh" content="2;url=add_product.php">';
                               }
                            }
                        }    
                    }
                ?>
              <form id="personal-info" method="post" enctype="multipart/form-data">
                <h4 class="form-header">
                  <i class="fa fa-file-text-o"></i>
                  ADD PRODUCT   
                </h4>

                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Category</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="category_id" id="categoryid" required>
                      <option value="0">--Select Category--</option>
                      <?php
                      $select_query=mysqli_query($conn,"SELECT * FROM `category` WHERE status='Y'");
                      while($select_fetch=mysqli_fetch_assoc($select_query))
                      {
                          $category_name=$select_fetch['cat_name'];
                          $category_id=$select_fetch['cat_id'];
                          ?>
                          <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                          <?php
                      }
                      
                      ?>
                     
                    </select>

                  </div>
                </div>

                 <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Sub-Category</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="sub_category" id="sub_category" >
                        <option value="0">--Select Sub Category--</option>
                      
                     
                    </select>

                  </div>
                </div>

                <!-- <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Brand</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="brand" id="brandid" required>
                      <option value="0">--Select Brand--</option>
                    </select>

                  </div>
                </div>-->
                
                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Product Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Product Name" required>
                  </div>
                </div>
                
                 <div class="form-group row">
                     <label for="input-5" class="col-sm-2 col-form-label">Quantity Per Unit</label>
                  <div class="col-sm-4">
                    <input type="text" name="quantity_unit[]" id="quantity_unit" class="form-control" placeholder="Quantity Per Unit" required>
                  </div>
                  <label for="input-5" class="col-sm-2 col-form-label">Unit</label>
                  <div class="col-sm-4">
                    <select class="form-control" name="unit[]" id="unit" required>
                      <option value="">--Select Unit--</option>
                      <option value="ml">Ml</option>
                      <option value="L">L</option>
                      <option value="Kg">Kg</option>
                      <option value="g">Gram</option>
                      <option value="Pcs">Pcs</option>
                      <option value="Packet">Packet</option>
                   </select>
                  </div>
				</div>
                <div class="form-group row">
                    
                  <label for="input-5" class="col-sm-2 col-form-label" style="text-decoration: line-through;">Product Price(per unit)</label>
                  <div class="col-sm-4">
                    <input type="text" name="product_price[]" id="product_price" class="form-control" placeholder="Product Price" required>
                  </div>
                  <label for="input-5" class="col-sm-2 col-form-label">Discount Price</label>
                  <div class="col-sm-3">
                    <input type="text" name="discount_price[]"  class="form-control" placeholder="Discount Price" required>
                  </div>
                  <div class="col-sm-1">
                    <!--<input type="number" name="product_price" id="product_price" class="form-control" placeholder="Product Price" required>-->
                    <button type="button" id="addmore" class="btn btn-primary add_more" onclick="createEditor();">Add</button>
                  </div>
               </div>
               
                
                    <?php for ($i=2; $i<=40; $i++){
                    echo "<center><div class='form-group row' id='div_editor_".$i."' style='display:none;'>";
                    ?>
                    <div class="form-group row">
                     <label for="input-5" class="col-sm-2 col-form-label">Quantity Per Unit</label>
                  <div class="col-sm-4">
                    <input type="text" name="quantity_unit[]" id="quantity_unit<?=$i?>" class="form-control" placeholder="Quantity Per Unit" >
                  </div>
                  <label for="input-5" class="col-sm-2 col-form-label">Unit</label>
                  <div class="col-sm-4">
                    <select class="form-control" name="unit[]" id="unit<?=$i?>" >
                      <option value="">--Select Unit--</option>
                      <option value="ml">Ml</option>
                      <option value="L">L</option>
                      <option value="Kg">Kg</option>
                      <option value="g">Gram</option>
                      <option value="Pcs">Pcs</option>
                      <option value="Packet">Packet</option>
                   </select>
                  </div>
				</div>
                <div class="form-group row">
                    
                  <label for="input-5" class="col-sm-2 col-form-label" style="text-decoration: line-through;">Product Price(per unit)</label>
                  <div class="col-sm-4">
                    <input type="text" name="product_price[]" id="product_price<?=$i?>" class="form-control" placeholder="Product Price" >
                  </div>
                  <label for="input-5" class="col-sm-2 col-form-label">Discount Price</label>
                  <div class="col-sm-3">
                    <input type="text" name="discount_price[]" id="discount_price<?=$i?>" class="form-control" placeholder="Discount Price" >
                  </div>
                  <div class="col-sm-1">
                    <!--<input type="number" name="product_price" id="product_price" class="form-control" placeholder="Product Price" required>-->
                    <!--<button type="button" id="addmore" class="btn btn-primary add_more" onclick="createEditor();">Add</button>-->
                    <i class='fa fa-times rem' aria-hidden='true' data-id="<?=$i?>"></i>
                  </div>
               </div>
                          
                <?php
                      echo "</div></center>";
                   }
                 ?>
               
               
                  <!-- <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label"> Retailer Quantity</label>
                  <div class="col-sm-4">
                    <input type="number" name="r_quantity" id="r_quantity" class="form-control" placeholder="Quantity" required>
                  </div>
                  <label for="input-5" class="col-sm-2 col-form-label">Discount (%)</label>
                  <div class="col-sm-4">
                    <input type="number" name="r_discount" id="r_discount" class="form-control" placeholder="Discount Percentage" required>
                  </div>
                </div>
                
                  <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label"> Wholeseller Quantity</label>
                  <div class="col-sm-4">
                    <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Quantity" required>
                  </div>
                  <label for="input-5" class="col-sm-2 col-form-label">Discount (%)</label>
                  <div class="col-sm-4">
                    <input type="number" name="discount" id="discount" class="form-control" placeholder="Discount Percentage" required>
                  </div>
                </div>
                
                    <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label"> Importer Quantity</label>
                  <div class="col-sm-4">
                    <input type="number" name="i_quantity" id="i_quantity" class="form-control" placeholder="Quantity" required>
                  </div>
                  <label for="input-5" class="col-sm-2 col-form-label">Discount (%)</label>
                  <div class="col-sm-4">
                    <input type="number" name="i_discount" id="i_discount" class="form-control" placeholder="Discount Percentage" required>
                  </div>
                </div>-->
                
                <!--<div class="form-group row">-->
                <!--  <label for="input-5" class="col-sm-2 col-form-label">Product Price</label>-->
                <!--  <div class="col-sm-10">-->
                <!--    <input type="number" name="product_price" id="product_price" class="form-control" placeholder="Product Price" required>-->
                <!--  </div>-->
                <!--</div>-->
                
                <!--<div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Product Selling Price</label>
                  <div class="col-sm-10">
                    <input type="number" name="product_selling_price" id="product_selling_price" class="form-control" placeholder="Product Selling Price" required>
                  </div>
                </div>-->
                
               <!-- <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Product GST Percentage</label>
                  <div class="col-sm-10">
                    <input type="number" name="gst_percentage" id="gst_percentage" class="form-control" placeholder="Product GST Percentage" required>
                  </div>
                </div>-->
                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">GST Percentage</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="persentage_of" required>
                            <option value="">--Select GST--</option>
                            <option value="5">5</option>
                            <option value="12">12</option>
                            <option value="18">18</option>
                            <option value="28">28</option>
                        </select>
                    <!--<input type="number" min="0" class="form-control" name="persentage_of">-->
                    </div>
                </div>
                
                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Product Description</label>
                  <div class="col-sm-10">
                    <textarea name="product_description" class="form-control" required></textarea>
                  </div>
                </div>
                
                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Upload Main Image</label>
                    <div class="col-sm-6">
                        <input type="file" name="image" id="image"  class="form-control" onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])" required>
                        <!--<span>Image Size Should Be 120 x 400</span>-->
                    </div>
                    <div class="col-sm-4">
                        <img src="assets/images/product_image.png" id="img" width="100" height="200" class="form-control">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Sub Image 1</label>
                    <div class="col-sm-6">
                        <input type="file" name="sub_image1" id="sub_image1"  class="form-control" onchange="document.getElementById('image1').src = window.URL.createObjectURL(this.files[0])" required>
                        
                    </div>
                    <div class="col-sm-4">
                        <img src="assets/images/product_image.png" id="image1" width="100" height="200" class="form-control">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Sub Image 2</label>
                    <div class="col-sm-6">
                        <input type="file" name="sub_image2" id="sub_image2"  class="form-control" onchange="document.getElementById('image2').src = window.URL.createObjectURL(this.files[0])">
                        
                    </div>
                    <div class="col-sm-4">
                        <img src="assets/images/product_image.png" id="image2" width="100" height="200" class="form-control">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Sub Image 3</label>
                    <div class="col-sm-6">
                        <input type="file" name="sub_image3" id="sub_image3"  class="form-control" onchange="document.getElementById('image3').src = window.URL.createObjectURL(this.files[0])">
                        
                    </div>
                    <div class="col-sm-4">
                        <img src="assets/images/product_image.png" id="image3" width="100" height="200" class="form-control">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Sub Image 4</label>
                    <div class="col-sm-6">
                        <input type="file" name="sub_image4" id="sub_image4"  class="form-control" onchange="document.getElementById('image4').src = window.URL.createObjectURL(this.files[0])">
                        
                    </div>
                    <div class="col-sm-4">
                        <img src="assets/images/product_image.png" id="image4" width="100" height="200" class="form-control">
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
    
         

$(".rem").click(function(){
    var d_id = $(this).attr('data-id');
    // alert(d_id);
    $("#div_editor_"+d_id).css('display','none');
    $("#chapter_"+d_id).val('');
    $('#quantity_unit'+d_id).removeAttr('required');
    $('#unit'+d_id).removeAttr('required');
    $('#product_price'+d_id).removeAttr('required');
    $('#discount_price'+d_id).removeAttr('required');
    
})

$("#rmv_main").click(function(){
    alert();
        $('#image').parent(".pip").remove();
        // $('#image').val("");
        $('#img').val("");
        // $('#image').remove();

      });
      
      
      
      num_chapter = 2;
    var editor = new Array();

    function createEditor()
      {
        // alert();
        if (num_chapter <= 40)
        {
        toggle_visibility(num_chapter );

        // document.getElementById('div_editor_' + num_chapter).insertAdjacentHTML( "afterbegin", "<span style='display:inline;'>Chapter " + num_chapter + ": </span>");

        num_chapter += 1;
        }
       else
        {
        alert("Sorry, maximum is 40 chapters.");
        }
        
        // Fetch Mesur
       // $.ajax({
       //    url:'api/fetch_mesur_unit.php',
       //    type:'post',
       //    success:function(data)
       //    {
       //        $(".mesur_unit").html(data);
       //    }
           
       //})
        
      }
      function toggle_visibility(ids) {
         var id = 'div_editor_'+ids
        var e = document.getElementById(id);
        e.style.display = ((e.style.display!='none') ? 'none' : 'block');
       // alert(ids);
         $("#quantity_unit"+ids).attr("required", "true");
         $("#unit"+ids).attr("required", "true");
         $("#product_price"+ids).attr("required", "true");
         $("#discount_price"+ids).attr("required", "true");
        }
 $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
<?php
include('footer.php'); 
?>