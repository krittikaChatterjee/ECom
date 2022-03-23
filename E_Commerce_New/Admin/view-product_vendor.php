<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Manage Product</h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item">Product</li>
              <li class="breadcrumb-item active" aria-current="page">Manage Product</li>
           </ol>
       </div>
      </div><!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Product</div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                    <tr>
                        <th>Sl. Number</th>
                        <th>Category</th>
                        <th>Product Name</th>
                        <!--<th>Price</th>-->
                        <!--<th>Selling Price</th>-->
                        <!--<th>GST Percentage</th>-->
                        <!--<th>Product Description</th>-->
                         <!--<th>Stock Status</th>-->
                         <!--<th>Express Status</th>-->
                         <!--<th>Homepage Product</th>-->
                         <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    if(isset($_GET['del_id']))
                    {
                      $del_id=base64_decode($_GET['del_id']);
                      $d_query = mysqli_query($conn,"SELECT * FROM `product` WHERE `product_id`='$del_id'");  
                      $d_result = mysqli_fetch_assoc($d_query);
                      $del_img = "product_image/".$d_result['main_image'];
                      $del_img1 = "product_image/".$d_result['sub_img1'];
                      $del_img2 = "product_image/".$d_result['sub_img2'];
                      $del_img3 = "product_image/".$d_result['sub_img3'];
                      $del_img4 = "product_image/".$d_result['sub_img4'];
                      $delete_query=mysqli_query($conn,"DELETE FROM `product` WHERE `product_id`='$del_id'");
                      if($delete_query)
                      {
                        unlink($del_img);
                        unlink($del_img1);
                        unlink($del_img2);
                        unlink($del_img3);
                        unlink($del_img4);
                        echo '<script>swal("Successful", "You have successfully deleted", "success")</script>';
                        echo "<script>
                                setTimeout(function() {
                                    window.location='manage_product.php'
                                }, 3000);
                            </script>";
                      }
                    }
                    $c=1;
                    $sql="SELECT * FROM product WHERE vender_or_admin = '".$_REQUEST['id']."' ORDER BY product_id DESC";
                    $queary=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($queary))
                    {
                      $c_query = mysqli_query($conn,"SELECT * FROM category WHERE `cat_id`='".$row['category_id']."'");
                      $c_result = mysqli_fetch_assoc($c_query);
                      $id=$row['product_id'];
                      $category_name = $c_result['cat_name'];
                      $product_name = $row['product_name'];
                      $product_price = $row['price'];
                      $selling_price = $row['selling_price'];
                      $gst_percentage = $row['gst_percentage'];
                      //$product_description = $row['product_description'];
                   
                  ?>
                    <tr>
                      <td><?php echo $c;  ?></td>
                      <td><?php echo $category_name;  ?></td>
                      <td><?php echo $product_name;  ?></td>
                      <!--<td><?php echo $product_price;  ?></td>-->
                      <!--<td><?php echo $selling_price;  ?></td>-->
                      <!--<td><?php echo $gst_percentage;  ?></td>-->
                      <!--<td><?php echo substr($product_description,0,50);  ?>...</td>-->

                     <?php
                      if($row['status'] == 'Y'){
                      ?>
                      <td><button type="button" class="btn btn-success statusproi_<?=$row['product_id']?>" onclick="change_status(<?=$row['product_id']?>)">Approve</button></td>

                      <?php } else { ?>

                      	<td><button type="button" class="btn btn-danger statusproi_<?=$row['product_id']?>" onclick="change_status(<?=$row['product_id']?>)">Disapprove</button></td>

                      <?php } ?>
                      <!--
                       <?php
                      if($row['exp_status'] == 'Y'){
                      ?>
                      <td><button type="button" class="btn btn-success statuspro_<?=$row['product_id']?>" onclick="change_exp(<?=$row['product_id']?>)">Approve</button></td>

                      <?php } else { ?>

                      	<td><button type="button" class="btn btn-danger statuspro_<?=$row['product_id']?>" onclick="change_exp(<?=$row['product_id']?>)">Disapprove</button></td>

                      <?php } ?>
                      
                       <?php
                      if($row['home_page_product'] == 'Y'){
                      ?>
                      <td><button type="button" class="btn btn-success statusproo_<?=$row['product_id']?>" onclick="change_home_page(<?=$row['product_id']?>)">Approve</button></td>

                      <?php } else { ?>

                      	<td><button type="button" class="btn btn-danger statusproo_<?=$row['product_id']?>" onclick="change_home_page(<?=$row['product_id']?>)">Disapprove</button></td>

                      <?php } ?>-->
                        
                        
                   
                      <td><a href="edit_product.php?id=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-edit"></i></td>
                      <td><a href="manage_product.php?del_id=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-trash"></i></td>
                    </tr>
                    
                  <?php
                      $c++;
                      ?>
                      <div class="modal" id="myModal<?=$row['product_id']?>">
					    <div class="modal-dialog">
					      <div class="modal-content">
					      
					        <!-- Modal Header -->
					        <div class="modal-header">
					          <h4 class="modal-title">Modal Heading</h4>
					          <button type="button" class="close" data-dismiss="modal">&times;</button>
					        </div>
					        
					        <!-- Modal body -->
					        <div class="modal-body">
					         
					          <div class="row">
					          	<div class="col-sm-6" style="font-weight: 800;">Product per Unit</div>
					          	<div class="col-sm-6" style="font-weight: 800;">Status</div>
					          </div>
					           <?php
					          $product_id = $row['product_id'];
					          $fetch_unit_product = "SELECT * FROM `qty_per_unit` WHERE product_id='$product_id'";
					          $fetch_unit_product_read = mysqli_query($conn,$fetch_unit_product);
					          while($row_unit_product = mysqli_fetch_array($fetch_unit_product_read)){
					          	?>
					          	<div class="row" style="margin-bottom: 6px;">
					          	<div class="col-sm-6"><?=$row_unit_product['qtu_per_unit'].'('.$row_unit_product['unit'].')'?></div>
					          	<div class="col-sm-6">
					          		
					          		<?php 
			                      if($row_unit_product['status'] == 'Y')
			                            {
			                        ?>
			                        <button type="button" class="btn btn-success statuss_<?=$row_unit_product['qty_id']?>" onclick="change_status(<?=$row_unit_product['qty_id']?>)">IN STOCK
			                        <?php
			                            }
			                            else if($row_unit_product['status'] == 'N')
			                            {
			                        ?>
			                        <button type="button" class="btn btn-danger statuss_<?=$row_unit_product['qty_id']?>" onclick="change_status(<?=$row_unit_product['qty_id']?>)">OUT STOCK
			                        <?php
			                            }
			                        ?>
					          	</div>
					          </div>
					          	<?php
					          	?>
					          	 <input type="hidden" class="pro<?=$row_unit_product['qty_id']?>" value="<?=$product_id?>">
					          	<?php
					          	
					          }
					          
					          ?>
					          
					          
					          
					          
					          <?php
					          
					          
					          ?>
					        
					        </div>
					        
					        
					        <!-- Modal footer -->
					        <div class="modal-footer">
					          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					        </div>
					        
					      </div>
					    </div>
					  </div>
                      <?php
                      
                      
                    }

                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Sl. Number</th>
                        <th>Category</th>
                        <th>Product Name</th>
                        <!--<th>Price</th>-->
                        <!--<th>Selling Price</th>-->
                        <!--<th>GST Percentage</th>-->
                        <!--<th>Product Description</th>-->
                         <!--<th>Stock Status</th>-->
                         <!--<th>Express Status</th>-->
                         <!--<th>Homepage Product</th>-->
                         <th>Status</th>
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

  	 function change_status(id)
      {
          //alert(id);exit;
          var pro = $(".pro"+id).val();
        $.ajax({
            type:"post",
            url:"api/cng_stock_status.php",
            data:{id:id},
            beforeSend: function() {
                $(".statuss_"+id).html('Processing...');
            },
            success:function(data)
            { 
                // alert(data);
                var jsonObj = JSON.parse(data);
                // alert(jsonObj.status);
                if(jsonObj.status == 'a')
                {
                    $(".statuss_"+id).html('IN STOCK');
                    $(".statuss_"+id).css('background-color','#15ca20');
                    $(".statuss_"+id).css('border','1px solid #15ca20');
                     $(".wor_alert"+pro).html('Click');
                    $(".wor_alert"+pro).css('background-color','#449d44');
                    $(".wor_alert"+pro).css('border','1px solid #449d44');
                }
                else if(jsonObj.status == 'in')
                {
                    $(".statuss_"+id).html('OUT STOCK');
                    $(".statuss_"+id).css('background-color','#bd2130');
                    $(".statuss_"+id).css('border','1px solid #bd2130');
                    $(".wor_alert"+pro).html('Click');
                    $(".wor_alert"+pro).css('background-color','#f0ad4e');
                    $(".wor_alert"+pro).css('border','1px solid #f0ad4e');
                    
                    
                }
            }
        })
      }
      
      function change_exp(id){
      	// alert(id);exit;
  		$.ajax({
  			url: "api/cng_exp_status.php",
  			type: "post",
  			data : { id : id },

  			beforeSend:function(){
  				$(".statuspro_"+id).html('processing...');
  			},
  			success:function(data){

  				var jsonObj = JSON.parse(data);
  				if(jsonObj.status == 'a'){

  					$(".statuspro_"+id).html('Approve');
  					$(".statuspro_"+id).css('background-color','#15ca20');
  					$(".statuspro_"+id).css('border','1px solid #15ca20');

  				}else if(jsonObj.status == 'in'){

  					 $(".statuspro_"+id).html('Disapprove');
                    $(".statuspro_"+id).css('background-color','#bd2130');
                    $(".statuspro_"+id).css('border','1px solid #bd2130');

  				}


  			}
  		});

  	}
  	//change_home_page
  	function change_home_page(id){
      	// alert(id);exit;
  		$.ajax({
  			url: "api/change_home_page.php",
  			type: "post",
  			data : { id : id },

  			beforeSend:function(){
  				$(".statusproo_"+id).html('processing...');
  			},
  			success:function(data){

  				var jsonObj = JSON.parse(data);
  				if(jsonObj.status == 'a'){

  					$(".statusproo_"+id).html('Approve');
  					$(".statusproo_"+id).css('background-color','#15ca20');
  					$(".statusproo_"+id).css('border','1px solid #15ca20');

  				}else if(jsonObj.status == 'in'){

  					 $(".statusproo_"+id).html('Disapprove');
                    $(".statusproo_"+id).css('background-color','#bd2130');
                    $(".statusproo_"+id).css('border','1px solid #bd2130');

  				}


  			}
  		});

  	}
  	//change_status
  		function change_status(id){
      	// alert(id);exit;
  		$.ajax({
  			url: "api/change_status_product.php",
  			type: "post",
  			data : { id : id },

  			beforeSend:function(){
  				$(".statusproo_"+id).html('processing...');
  			},
  			success:function(data){

  				var jsonObj = JSON.parse(data);
  				if(jsonObj.status == 'a'){

  					$(".statusproi_"+id).html('Approve');
  					$(".statusproi_"+id).css('background-color','#15ca20');
  					$(".statusproi_"+id).css('border','1px solid #15ca20');

  				}else if(jsonObj.status == 'in'){

  					 $(".statusproi_"+id).html('Disapprove');
                    $(".statusproi_"+id).css('background-color','#bd2130');
                    $(".statusproi_"+id).css('border','1px solid #bd2130');

  				}


  			}
  		});

  	}

  </script>
<?php include('footer.php'); ?>