<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">User Express Order</h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item">Order</li>
              <li class="breadcrumb-item active" aria-current="page">User Express Order</li>
           </ol>
       </div>
      </div><!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> User Order</div>
            <div class="card-body">
              <div class="table-responsive">
              	<div>
              		Filter By Status:
              		<select class="form-control col-lg-2" onchange="filter(this.value)">
              			<option value="All">All</option>
              			<option value="PLACED">PLACED</option>
              			<option value="PACKED">PACKED</option>
              			<option value="DISPATCHED">DISPATCHED</option>
              			<option value="DELIVERED">DELIVERED</option>
              			<option value="CANCELLED">CANCELLED</option>
              		</select>
              	</div>
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                    <tr>
                        <th>Sl. Number</th>
                        <th>User Name</th>
                        <th>Invoice</th>
                        <!--<th>User Name</th>-->
                        <th>Product Name</th>
                        <th>Quentity</th>
                        <th>Product Price </th>
                        <th>Total Amount</th>
                        <th>Delivery Charges</th>
                        <th>Status</th>
                        <th>User Received</th>
                        <th>House Address</th>
                        <th>Street Address</th>
                        <th>User State</th>
                        <th>User City</th>
                        <th>User Pin</th>
                        <th>Landmark</th>
                        <th>Phone Number</th>
                        <th>Order Date</th>
                        <th>Order Time</th>
                        <th>Payment Type</th>
                        <th>Payment Status</th>
                        <th>Delivery Date</th>
                        <th>Cancel Order</th>
                        
                       
                    
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                 
                    $c=1;
                    $sql="SELECT * FROM `order_list` WHERE `exp_status`='Y' ORDER BY order_id DESC";
                    $queary=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($queary))
                    {
                        $delivery_type_id=$row['delivery_type_id'];
                        $loc_query=mysqli_query($conn,"SELECT * FROM nearest_point WHERE id='$delivery_type_id'");
                        $loc_fetch=mysqli_fetch_assoc($loc_query);
                        
                        $loc_name=$loc_fetch['name'];
                        $locc=$loc_fetch['location'];
                        $location=$loc_name.",".$locc;
                   
                    $idd=$row['order_id'];
                      $invoice_no=$row['invoice_no'];
                      
                      // fetch user 
                      $fetch_user_name = "SELECT * FROM `users` WHERE u_id='".$row['user_id']."'";
                      $fetch_user_name_read = mysqli_query($conn,$fetch_user_name);
                      $row_user_name = mysqli_fetch_array($fetch_user_name_read);
                     
                   
                  ?>
                    <tr>
                      <td><?php echo $c;  ?></td>
                      <td><?php echo $row_user_name['name'];  ?></td>
                      <td><?php echo $row['invoice_no'];  ?></td>
                      <td><?php 
                      $inv =  $row['invoice_no']; 
                      $fetch_product_id = "SELECT * FROM `ordered_product` WHERE invoice_no='$inv'";
                      $fetch_product_id_read = mysqli_query($conn,$fetch_product_id);
                      while($row_product = mysqli_fetch_array($fetch_product_id_read)){
                      	$product_id = $row_product['product_id'];
                      	// fetch product name 
                      	$fetch_product_name = "SELECT * FROM `product` WHERE product_id='$product_id'";
                      	$fetch_product_name_read = mysqli_query($conn,$fetch_product_name);
                      	$row_product_name = mysqli_fetch_array($fetch_product_name_read);
                      	echo $row_product_name['product_name']." ".$row_product['product_quntity']."<br>";
                      	
                      }
                      
                      ?></td>
                      <td>
                      	<?php
                      		$qtu_query = mysqli_query($conn,"SELECT * FROM `ordered_product` WHERE invoice_no='".$row['invoice_no']."'");
                      		while($qtu_result = mysqli_fetch_assoc($qtu_query)){
                      			echo $qtu_result['product_count']."<br>";
                      		}
                      	?>
                      </td>
                      <td><?php 
                       $inv =  $row['invoice_no']; 
                      $fetch_product_id = "SELECT * FROM `ordered_product` WHERE invoice_no='$inv'";
                      $fetch_product_id_read = mysqli_query($conn,$fetch_product_id);
                      while($row_product = mysqli_fetch_array($fetch_product_id_read)){
                      	$product_count = $row_product['product_count'];
                      	$product_price = $row_product['product_price'];
                      	// fetch product name 
                    	$tot_prc = $product_count*$product_price;
                    		echo $tot_prc."<br>";
                    	
                      }
                      
                      
                      ?></td>
                      <td><?php echo $row['total'];  ?></td>
                      <td><?php echo $row['delivery_charges'];  ?></td>
                      
                      <?php
                    	if($row['status'] != 'CANCELLED'){
                      ?>
                      <td>
	                      <select class="form-control" name="order_status" id="order_status<?=$row['invoice_no']?>" onchange="order_status_cng('<?=$row['invoice_no']?>','<?=$row['user_id']?>')">
	                      		<option value="PLACED" <?php echo ($row['status'] == 'PLACED') ? 'selected' : ''; ?>>PLACED</option>
	                      		<option value="PACKED" <?php echo ($row['status'] == 'PACKED') ? 'selected' : ''; ?>>PACKED</option>
	                      		<option value="DISPATCHED" <?php echo ($row['status'] == 'DISPATCHED') ? 'selected' : ''; ?>>DISPATCHED</option>
	                      		<option value="DELIVERED" <?php echo ($row['status'] == 'DELIVERED') ? 'selected' : ''; ?>>DELIVERED</option>
	                      		
	                      </select>
	                   </td>
                      <?php
                    	}else{
                    		echo "<td style='color:red'>".$row['status']."</td>";
                    	}
                      ?>
                      
                      <td style="color:<?=$row['received_status'] == 'N' ? 'red' : 'green'?>">
                      	<?=$row['received_status'] == 'N' ? 'No' : 'Yes'?>
                      </td>
                      
                      <td><?php echo $row['house_address'];  ?></td>
                      <td><?php echo $row['street_address'];  ?></td>
                      <td><?php echo $row['state'];  ?></td>
                      <td><?php echo $row['city'];  ?></td>
                      <td><?php echo $row['pin'];  ?></td>
                      <td><?php echo $row['landmark'];  ?></td>
                      <td><?php echo $row['phno'];  ?></td>
                      <td><?php echo $row['date'];  ?></td>
                      <td><?php echo $row['order_time'];  ?></td>
                      <td><?php echo $row['payment_type'];  ?></td>
                      <td><?php echo $row['payment_status'];  ?></td>
                      <td><?php echo $row['delivery_time'];  ?></td>
                      <?php
                      if($row['status'] == 'CANCELLED'){
                      ?>
                      <td><button type="button" class="btn btn-danger statuspro_<?=$row['order_id']?>">CANCELLED</button></td>

                      <?php }else if($row['status'] == 'DELIVERED') {?>
                    	<td></td>
                      <?php }else { ?>

                      	<td><button type="button" class="btn btn-info statuspro_<?=$row['order_id']?>" onclick="change_status_cancel('<?=$row['order_id']?>','<?=$row['user_id']?>')">CANCEL</button></td>

                      <?php } ?>
                      
                      
                      
                      
                          

                     
                      
                    </tr>
                  <?php
                      $c++;
                    }

                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Sl. Number</th>
                        <th>User Name</th>
                        <th>Invoice</th>
                        <!--<th>User Name</th>-->
                        <th>Product Name</th>
                        <th>Quentity</th>
                        <th>Product Price </th>
                        <th>Total Amount</th>
                        <th>Delivery Charges</th>
                        <th>Status</th>
                        <th>User Received</th>
                        <th>House Address</th>
                        <th>Street Address</th>
                        <th>User State</th>
                        <th>User City</th>
                        <th>User Pin</th>
                        <th>Landmark</th>
                        <th>Phone Number</th>
                        <th>Order Date</th>
                        <th>Order Time</th>
                        <th>Payment Type</th>
                        <th>Payment Status</th>
                        <th>Delivery Date</th>
                        <th>Cancel Order</th>
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

  	/* function change_status(id)
      {
        //   alert(id);
          var stat=document.getElementById('order_type'+id).value;
        //   alert(stat);
        $.ajax({
            type:"post",
            url:"api/user_order_status.php",
            data:{id:id,stat:stat},
            success:function(data)
            { 
                
                var Value=JSON.parse(data);
                if(Value.msg=='Y')
                {
                    swal("Successfully", "Updated Status", "success");
                }
                else
                {
                    swal("Sorry!!", "Something Went Wrong", "error");
                }
          
            }
        })
      }*/
      
      function order_status_cng(id){
      	 var order_status = $("#order_status"+id).val();
      	 //alert(order_status);
      	 $.ajax({
            type:"post",
            url:"api/user_order_status_cng.php",
            data:{id:id,order_status:order_status},
            success:function(data)
            { 
                
                swal("Success!", "Order Status Change Successfully!", "success");
          
            }
        })
      	
      }
      
    function filter(val){
    	$.ajax({
            type:"post",
            url:"api/filter_order.php",
            data:{val:val},
            success:function(data){
            	$("#default-datatable").html(data);
            }
        })
    }
    function change_status_cancel(id){
      	// alert(id);exit;
  		$.ajax({
  			url: "api/cng_order_cancel_status.php",
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

  					 $(".statuspro_"+id).html('CANCELLED');
                    $(".statuspro_"+id).css('background-color','#bd2130');
                    $(".statuspro_"+id).css('border','1px solid #bd2130');

  				}


  			}
  		});

  	}

  </script>
<?php include('footer.php'); ?>