<?php  include('header.php');?>
<?php include('sidebar.php'); ?>
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Products</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Edit Product</li>
         </ol>
       </div>
     </div><!-- End Breadcrumb-->

     <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <?php
                     $edit_id=base64_decode($_GET['id']);
                    $p_query= mysqli_query($conn,"SELECT * FROM product WHERE `product_id`='$edit_id'");
                    $p_result = mysqli_fetch_assoc($p_query);
                    
                    $q_query = mysqli_query($conn,"SELECT * FROM category WHERE `cat_id`='".$p_result['category_id']."'");
                    $q_result = mysqli_fetch_assoc($q_query);
                    if(isset($_POST['submitbtn']))
                    {

                        $category_id=mysqli_real_escape_string($conn,$_POST['category_id']);
                        $sub_category_id=mysqli_real_escape_string($conn,$_POST['sub_category']);
                        $product_name = mysqli_real_escape_string($conn,$_POST['product_name']);
                        // $product_price = mysqli_real_escape_string($conn,$_POST['product_price']);
                         $product_price = $_POST['product_price'];
                        $product_selling_price = mysqli_real_escape_string($conn,$_POST['product_selling_price']);
                        $gst_percentage = mysqli_real_escape_string($conn,$_POST['gst_percentage']);
                        $product_description = mysqli_real_escape_string($conn,$_POST['product_description']);
                        $unit=$_POST['unit'];
                        $discount_price=$_POST['discount_price'];
                        // $quantity_unit= mysqli_real_escape_string($conn,$_POST['quantity_unit']);
                        $quantity_unit= $_POST['quantity_unit'];
                        $persentage_of= $_POST['persentage_of'];
                        // $unit=mysqli_real_escape_string($conn,$_POST['unit']);
                        
                        $quantity='';
                        $discount='';
                        
                         $r_quantity='';
                        $r_discount='';
                        
                        $i_quantity='';
                        $i_discount='';
                        
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
                                    $del_img = "product_image/".$p_result['main_image'];
                                    // unlink($del_img);
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
                            else
                            {
                                $foll = $p_result['main_image'];
                            }
                            if($img1 !='')
                            {
                                $ext1 = pathinfo($img1, PATHINFO_EXTENSION);
                                if( $ext1 == 'gif' || $ext1 == 'png' || $ext1 == 'jpg' || $ext1 == 'jpeg' )
                                {
                                    $foll1=rand(1111,9999)."_".$img1;
                                    $pathh1="product_image/".$foll1;                            
                                    $tmpp1=$_FILES["sub_image1"]["tmp_name"];
                                    $del_img1 = "product_image/".$p_result['sub_img1'];
                                    unlink($del_img1);
                                }
                            }else{
                                $foll1 = $p_result['sub_img1'];
                            }
                            
                            if($img2 !='')
                            {
                                $ext2 = pathinfo($img2, PATHINFO_EXTENSION);
                                if( $ext2 == 'gif' || $ext2 == 'png' || $ext2 == 'jpg' || $ext2 == 'jpeg' )
                                {
                                    $foll2=rand(1111,9999)."_".$img2;
                                    $pathh2="product_image/".$foll2;                            
                                    $tmpp2=$_FILES["sub_image2"]["tmp_name"];
                                    $del_img2 = "product_image/".$p_result['sub_img2'];
                                    unlink($del_img2);
                                }
                            }else{
                                $foll2 = $p_result['sub_img2'];
                            }
                            
                            if($img3 !='')
                            {
                                $ext3 = pathinfo($img3, PATHINFO_EXTENSION);
                                if( $ext3 == 'gif' || $ext3 == 'png' || $ext3 == 'jpg' || $ext3 == 'jpeg' )
                                {
                                    $foll3=rand(1111,9999)."_".$img3;
                                    $pathh3="product_image/".$foll3;                            
                                    $tmpp3=$_FILES["sub_image3"]["tmp_name"];
                                    $del_img3 = "product_image/".$p_result['sub_img3'];
                                    unlink($del_img3);
                                }
                            }else{
                                $foll3 = $p_result['sub_img3'];
                            }
                            
                            if($img4 !='')
                            {
                                $ext4 = pathinfo($img4, PATHINFO_EXTENSION);
                                if( $ext4 == 'gif' || $ext4 == 'png' || $ext4 == 'jpg' || $ext4 == 'jpeg' )
                                {
                                    $foll4=rand(1111,9999)."_".$img4;
                                    $pathh4="product_image/".$foll4;                            
                                    $tmpp4=$_FILES["sub_image4"]["tmp_name"];
                                    $del_img4 = "product_image/".$p_result['sub_img4'];
                                    unlink($del_img4);
                                }
                            }else{
                                $foll4 = $p_result['sub_img4'];
                            }
                            
                            
                            // echo            $sql="UPDATE product SET `product_name`='$product_name',`category_id`='$category_id',`sub_cat_id`='$sub_category_id',`quantity_per_unit`='$imp_quantity_unit',`unittt`='$imp_unit',`price`='$imp_product_price',`retailer_quantity`='$r_quantity',`discount_percent`='$discount',`importer_quantity`='$i_quantity',`importer_discount`='$i_discount',`selling_price`='$product_selling_price',`gst_percentage`='$gst_percentage',`product_description`='$product_description',`main_image`='$foll',`sub_img1`='$foll1',`sub_img2`='$foll2',`sub_img3`='$foll3',`sub_img4`='$foll4',`product_discount_price`='$imp_discount_price',`persentage_of`='$persentage_of' WHERE `product_id`='$edit_id'";
                            
                            
                            
                                        $sql="UPDATE product SET `product_name`='$product_name',`category_id`='$category_id',`sub_cat_id`='$sub_category_id',`quantity_per_unit`='$imp_quantity_unit',`unittt`='$imp_unit',`price`='$imp_product_price',`product_description`='$product_description',`main_image`='$foll',`sub_img1`='$foll1',`sub_img2`='$foll2',`sub_img3`='$foll3',`sub_img4`='$foll4',`product_discount_price`='$imp_discount_price',`persentage_of`='$persentage_of' WHERE `product_id`='$edit_id'";
                            
                            
                            
                                      
                                        $query=mysqli_query($conn,$sql);
                                        if($query)
                                        {
                                            move_uploaded_file($tmpp,$pathh);
                                            move_uploaded_file($tmpp1,$pathh1);
                                            move_uploaded_file($tmpp2,$pathh2);
                                            move_uploaded_file($tmpp3,$pathh3);
                                            move_uploaded_file($tmpp4,$pathh4);
                                            
                                            $fetchrow = "SELECT * FROM `qty_per_unit` WHERE `product_id` = '$edit_id'";
                                      
                                        $fetchrow_read = mysqli_query($conn,$fetchrow);
                                        $i = 0;
                                        $p_quantity_per_unit = explode(",",$p_result['quantity_per_unit']);
                                        $p_unit= explode(",",$p_result['unit']);
                                        $p_price= explode(",",$p_result['price']);
                                        $p_product_discount_price= explode(",",$p_result['product_discount_price']);
                                        
                                        foreach($discount_price as $key => $link) 
                                        { 
                                            if($link === '') 
                                            { 
                                                unset($product_price[$key]); 
                                                unset($quantity_unit[$key]); 
                                                unset($unit[$key]); 
                                                unset($discount_price[$key]); 
                                            } 
                                        } 
                                         $count_product_price = count($discount_price);
                                         $count_qry_rows = mysqli_num_rows($fetchrow_read);
                                         while($row_qry = mysqli_fetch_assoc($fetchrow_read)){   
                                            $iddd = $row_qry['qty_id'];
                                            $product_idd = $row_qry['product_id'];
                                            $item_product_price = $product_price[$i];
                                            $item_quantity_unit = $quantity_unit[$i];
                                            $item_unit = $unit[$i];
                                            $item_discount_price = $discount_price[$i];
                                            
                                            // if()
                                                $update_sql= "UPDATE `qty_per_unit` SET `qtu_per_unit`='$item_quantity_unit',`unit`='$item_unit',`product_price`='$item_product_price',`discount_price`='$item_discount_price' WHERE `qty_id`='$iddd' AND `product_id`='$product_idd'";
                                                $update_sql_read = mysqli_query($conn,$update_sql);
                                            
                                            
                                            $i++;
                                        }
                                         $j = 1;
                                         $count_qry_rows;
                                        foreach($discount_price as $keyy => $val) {
                                             $j;
                                            if($j > $count_qry_rows){
                                                $discount_pricecy  = $val;
                                                // $product_priceey  = $val;
                                                $quantity_unitty = $quantity_unit[$keyy];
                                                $unitty = $unit[$keyy];
                                                $product_priceey = $product_price[$keyy];
                                                
                                                    // $email = $_POST['email'][$index];
                                                if($discount_pricecy != ''){
                                                    $sql2 = "INSERT INTO `qty_per_unit`( `product_id`, `qtu_per_unit`, `unit`, `product_price`, `discount_price`) VALUES ('$edit_id','$quantity_unitty','$unitty','$product_priceey','$discount_pricecy')";
                                                    $result = mysqli_query($conn, $sql2);
                                                }
                                            }
                                            $j++;
                                           
                                        }
                                        
                                    //     $releted_product = $_POST['releted_prod'];
                                    //     // del old 
                                    //     $dell_old_rel = mysqli_query($conn,"DELETE FROM `related_product` WHERE `product_id`='$edit_id'");
                                    //   foreach($_POST['releted_prod'] as $key=> $vall){
                                    //       $ins_releted = mysqli_query($conn,"INSERT INTO `related_product`(`product_id`, `related_product_id`) VALUES ('$edit_id','$vall')");
                                    //   }
                                            
                ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon contrast-alert">
                        <i class="icon-info"></i>
                    </div>
                    <div class="alert-message">
                        <span><center><strong> Success !!! Product Updated Successfully </strong></center></span>
                    </div>
                </div>
                <?php
                    echo '<meta http-equiv="refresh" content="2;url=manage_product.php">';
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
                  EDIT PRODUCT   
                </h4>

                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Category</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="category_id" id="categoryid">
                      <!--<option value="<?php echo $q_result['cat_id']; ?>"><?php echo $q_result['cat_name']; ?></option>-->
                      <?php
                      $select_query=mysqli_query($conn,"SELECT * FROM `category` WHERE status='Y'");
                      while($select_fetch=mysqli_fetch_assoc($select_query))
                      {
                          $category_name=$select_fetch['cat_name'];
                          $category_id=$select_fetch['cat_id'];
                          ?>
                          <option value="<?php echo $category_id; ?>"<?php echo ($category_id == $q_result['cat_id']) ? 'selected' : ''; ?>><?php echo $category_name; ?></option>
                          <?php
                      }
                      
                      ?>
                     
                    </select>

                  </div>
                </div>
               

                 <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Sub-Category</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="sub_category" id="sub_category">
                        <?php
                $sub_id=$p_result['sub_cat_id'];
                $sub_sql=mysqli_query($conn,"SELECT * FROM sub_category WHERE catagory_id='".$q_result['cat_id']."'");
                while($fetch_raw_sub=mysqli_fetch_assoc($sub_sql)){
                    
                    ?>
                    <option value="<?=$fetch_raw_sub['sub_id'];?>"<?php echo ($fetch_raw_sub['sub_id'] == $p_result['sub_cat_id']) ? 'selected' : ''; ?>><?=$fetch_raw_sub['sub_name'];?></option>
                    <?php
                }
                ?>
                        
                      
                     
                    </select>

                  </div>
                </div>

                <?php
                   $bran=$p_result['brand_id'];
                   $fetch_b_sql=mysqli_query($conn,"SELECT * FROM brand WHERE b_id='$bran'");
                   $fethc_raw_b=mysqli_fetch_assoc($fetch_b_sql);

                   ?>

                 <!--<div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Brand</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="brand" id="brandid" disabled>
                       <option value="<?=$p_result['brand_id'];?>"><?=$fethc_raw_b['name'];?></option>
                      <?php
                      $select_brand=mysqli_query($conn,"SELECT * FROM brand WHERE status='Y' ");
                      while($select_brand1=mysqli_fetch_assoc($select_brand))
                      {                         
                          ?>
                          <option value="<?php echo $select_brand1['b_id']; ?>"><?php echo $select_brand1['name']; ?></option>
                          <?php
                      }
                      
                      ?>                     
                    </select>

                  </div>
                </div>-->
                
                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Product Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="product_name" id="product_name" class="form-control" value="<?php echo $p_result['product_name']; ?>" required>
                  </div>
                </div>
                <button type="button" id="addmore" class="btn btn-primary add_more" onclick="createEditor();" style="float:right">Add</button>
                
                 <?php
                  $fetch_un_product = "SELECT * FROM `qty_per_unit` WHERE product_id='$edit_id'";
                  $fetch_un_product_read = mysqli_query($conn,$fetch_un_product);
                  while($row_un_product = mysqli_fetch_array($fetch_un_product_read)){
                       
                  ?>
                  <div id="rem_id<?=$row_un_product['qty_id']?>">
                <div class="form-group row">
                     <label for="input-5" class="col-sm-2 col-form-label">Quantity Per Unit</label>
                  <div class="col-sm-4">
                    <input type="text" name="quantity_unit[]" id="quantity_unit<?=$row_un_product['qty_id']?>" class="form-control" placeholder="Quantity Per Unit"  value="<?=$row_un_product['qtu_per_unit']?>">
                  </div>
                  <label for="input-5" class="col-sm-2 col-form-label">Unit</label>
                  <div class="col-sm-4">
                    <select class="form-control" name="unit[]" id="unit<?=$row_un_product['qty_id']?>" >
                      <option value="">--Select Unit--</option>
                      <option value="ml" <?=('ml' == $row_un_product['unit']) ? 'selected' : '' ?>>Ml</option>
                      <option value="L" <?=('L' == $row_un_product['unit']) ? 'selected' : '' ?>>L</option>
                      <option value="Kg" <?=('Kg' == $row_un_product['unit']) ? 'selected' : '' ?>>Kg</option>
                      <option value="g" <?=('g' == $row_un_product['unit']) ? 'selected' : '' ?>>G</option>
                      <option value="Pcs" <?=('Pcs' == $row_un_product['unit']) ? 'selected' : '' ?>>Pcs</option>
                      <option value="Packet" <?=('Packet' == $row_un_product['unit']) ? 'selected' : '' ?>>Packet</option>
                   </select>
                  </div>
				</div>
                <div class="form-group row">
                    
                  <label for="input-5" class="col-sm-2 col-form-label" style="text-decoration: line-through;">Product Price</label>
                  <div class="col-sm-4">
                    <input type="text" name="product_price[]" id="product_price<?=$row_un_product['qty_id']?>" class="form-control" placeholder="Product Price"  value="<?=$row_un_product['product_price']?>">
                  </div>
                  <label for="input-5" class="col-sm-2 col-form-label">Discount Price</label>
                  <div class="col-sm-3">
                    <input type="text" name="discount_price[]"  class="form-control" placeholder="Discount Price"  value="<?=$row_un_product['discount_price']?>" id="discount_price<?=$row_un_product['qty_id']?>">
                  </div>
                  
                    <!--<input type="number" name="product_price" id="product_price" class="form-control" placeholder="Product Price" required>-->
                    <!--<button type="button" id="addmore" class="btn btn-primary add_more" onclick="createEditor();">Add</button>-->
                 
                  <div class="col-sm-1">
                    <!--<input type="number" name="product_price" id="product_price" class="form-control" placeholder="Product Price" required>-->
                   <i class='fa fa-times' aria-hidden='true' onclick="del_ad_more('<?=$row_un_product['qty_id']?>')"></i>
                   <!--<input type="hidden" value="<?=$edit_id?>" id="productt_id<?=$key?>">-->
                  </div>
               </div>
                
			</div>
                
                <?php
                }
                ?>
                   
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
                      <option value="ml">ml</option>
                      <option value="L">L</option>
                      <option value="Kg">kg</option>
                      <option value="g">g</option>
                      <option value="Pcs">Pcs</option>
                      <option value="Pcs">Packet</option>
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
                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Percentage  Of</label>
                  <div class="col-sm-10">
                    <!--<textarea name="product_description" class="form-control"></textarea>-->
                    <input type="number" min="0" class="form-control" name="persentage_of" value="<?=$p_result['persentage_of']?>">
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Product Description</label>
                  <div class="col-sm-10">
                    <textarea name="product_description" class="form-control" required><?php echo $p_result['product_description']; ?></textarea>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Related Product </label>
                  <div class="col-sm-10">
                      <select class="form-control js-example-basic-multiple" name="releted_prod[]" multiple="multiple">
                          <option value=""></option>
                          <?php
                          // fetch product 
                          $fetch_product = mysqli_query($conn,"SELECT * FROM `product`");
                          while($row_productt = mysqli_fetch_array($fetch_product)){
                              
                              // releted product 
                              $releted_product = mysqli_query($conn,"SELECT * FROM `related_product` WHERE product_id='$edit_id'");
                              while($row_releted_product = mysqli_fetch_array($releted_product)){
                                  if($row_releted_product['related_product_id']==$row_productt['product_id']){
                                      ?>
                                      <option value="<?=$row_productt['product_id']?>" selected><?=$row_productt['product_name']?></option>
                                      <?php
                                  }else{
                                      ?>
                                  <option value="<?=$row_productt['product_id']?>"><?=$row_productt['product_name']?></option>
                                  <?php
                                  }
                              }
                              
                              
                          }
                          
                          ?>
                      </select>
                    <!--<textarea name="product_description" class="form-control"></textarea>-->
                  </div>
                </div>
                
                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Upload Main Image</label>
                    <div class="col-sm-6">
                        <input type="file" name="image" id="image"  class="form-control" onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])">
                        <!--<span>Image Size Should Be 120 x 400</span>-->
                    </div>
                    <div class="col-sm-4">
                        <img src="product_image/<?=$p_result['main_image']?>" id="img" width="100" height="200" class="form-control">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Sub Image 1</label>
                    <div class="col-sm-6">
                        <input type="file" name="sub_image1" id="sub_image1"  class="form-control" onchange="document.getElementById('image1').src = window.URL.createObjectURL(this.files[0])" >
                        
                    </div>
                    <div class="col-sm-4">
                        <img src="product_image/<?=$p_result['sub_img1']?>" id="image1" width="100" height="200" class="form-control">
                    </div>
                </div>
                
               <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Sub Image 2</label>
                    <div class="col-sm-6">
                        <input type="file" name="sub_image2" id="sub_image2"  class="form-control" onchange="document.getElementById('image2').src = window.URL.createObjectURL(this.files[0])">
                        
                    </div>
                    <div class="col-sm-4">
                        <?php if($p_result['sub_img2']==''){ ?>
                        <img src="assets/images/product_image.png" width="100" height="200" class="form-control">
                        <?php } else { ?>
                        <img src="product_image/<?=$p_result['sub_img2']?>" id="image2" width="100" height="200" class="form-control">
                        <?php } ?>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Sub Image 3</label>
                    <div class="col-sm-6">
                        <input type="file" name="sub_image3" id="sub_image3"  class="form-control" onchange="document.getElementById('image3').src = window.URL.createObjectURL(this.files[0])">
                        
                    </div>
                    <div class="col-sm-4">
                        <?php if($p_result['sub_img3']==''){ ?>
                        <img src="assets/images/product_image.png" width="100" height="200" class="form-control">
                        <?php } else { ?>
                        <img src="product_image/<?=$p_result['sub_img3']?>" id="image3" width="100" height="200" class="form-control">
                        <?php } ?>
                    </div>
                </div>
                
               <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Sub Image 4</label>
                    <div class="col-sm-6">
                        <input type="file" name="sub_image4" id="sub_image4"  class="form-control" onchange="document.getElementById('image4').src = window.URL.createObjectURL(this.files[0])">
                       
                    </div>
                    <div class="col-sm-4">
                        <?php if($p_result['sub_img4']==''){ ?>
                        <img src="assets/images/product_image.png" width="100" height="200" class="form-control">
                        <?php } else { ?>
                        <img src="product_image/<?=$p_result['sub_img4']?>" id="image4" width="100" height="200" class="form-control">
                        <?php } ?>
                    </div>
                </div>
        		<input type="hidden" value="<?=$edit_id?>" id="ed_id"> 
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
        $("#quantity_unit"+ids).attr("required", "true");
         $("#unit"+ids).attr("required", "true");
         $("#product_price"+ids).attr("required", "true");
         $("#discount_price"+ids).attr("required", "true");
        }
        
        function del_ad_more(id){
        	// alert(id);
        	var product_id = $("#ed_id").val();
        		// alert(ed_id);
        		// alert(id);
        		$.ajax({
     
           url:'api/per_unit_remove.php',
           type:'post',
           data:{product_id:product_id,id:id},
           success:function(response){
           		$("#rem_id"+id).hide();
           		$("#quantity_unit"+id).val("");
           		$("#unit"+id).val("");
           		$("#product_price"+id).val("");
           		$("#discount_price"+id).val("");
           }
    });
        	
        }
         $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
        
</script>
<?php include('footer.php'); ?>