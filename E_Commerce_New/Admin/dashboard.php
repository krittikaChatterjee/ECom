<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<?php
	
	$exp_stat_chk = mysqli_query($conn,"SELECT * FROM `express_delivery`");
	$exp_stat_result = mysqli_fetch_assoc($exp_stat_chk);
	
	if(isset($_REQUEST['exp_stat'])){
		if($exp_stat_result['status'] != $_REQUEST['exp_stat']){
			$update_exp_stat = mysqli_query($conn,"UPDATE `express_delivery` SET `status`='".$_REQUEST['exp_stat']."' WHERE `id`='1'");
			if($update_exp_stat){
				echo "<meta http-equiv='refresh' content='0;url=dashboard.php'>";
			}
		}
	}
?>

	<div class="content-wrapper">
    	<div class="container-fluid">
    		<div class="row mt-4">
        		<!--<div class="col-12 col-lg-6 col-xl-3">
          			<div class="card bg-purple shadow-purple">
            			<div class="card-body">
              				<div class="media">
              					<div class="media-body text-left">
                					<h4 class="text-white"> <?php // echo $no_of_product;     ?></h4>
                					<span class="text-white">Total Product</span>
              					</div>
        						<div class="align-self-center"><span id="dash2-chart-1"></span></div>
            				</div>
            			</div>
          			</div>
        		</div>-->
    			<!--<div class="col-12 col-lg-6 col-xl-3">
          			<div class="card bg-info shadow-info">
            			<div class="card-body">
              				<div class="media">
              					<div class="media-body text-left">
                					<h4 class="text-white"></h4>
                					<span class="text-white">Total Service</span>
              					</div>
        						<div class="align-self-center"><span id="dash2-chart-2"></span></div>
            				</div>
            			</div>
          			</div>
        		</div>-->
        		<!--<div class="col-12 col-lg-6 col-xl-3">
          			<div class="card bg-danger shadow-danger">
            			<div class="card-body">
              				<div class="media">
        						<div class="media-body text-left">
                					<h4 class="text-white"><?php //echo $no_of_product_order;  ?></h4>
                					<span class="text-white">Total Products Order</span>
              					</div>
               					<div class="align-self-center"><span id="dash2-chart-3"></span></div>
            				</div>
            			</div>
          			</div>
        		</div>-->
        		<!--<div class="col-12 col-lg-6 col-xl-3">
          			<div class="card bg-success shadow-success">
            			<div class="card-body">
              				<div class="media">
              					<div class="media-body text-left">
            						<span class="text-white">Express Delivery Status</span>
            						<?php
            							if($exp_stat_result['status'] == 'Y'){
            						?>
            						<a href="dashboard.php?exp_stat=N" type="button" class="btn btn-danger">Turn Off</a>
            						<?php
            							}else{
            						?>
            						<a href="dashboard.php?exp_stat=Y" type="button" class="btn btn-info">Turn On</a>
            						<?php
            							}
            						?>
              					</div>
            					<div class="align-self-center"><span id="dash2-chart-4"></span></div>
            				</div>
            			</div>
      				</div>
        		</div>-->
      		</div><!-- row mt-4 -->

      		 <div class="row">
		        <div class="col-lg-12">
		          <div class="card">
		            <div class="card-header">
		            	<i class="fa fa-table"></i> Order List</div>
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
                        <!--<th>Product Name</th>-->
                        <!--<th>Quentity</th>-->
                        <!--<th>Product Price </th>-->
                        <th>Total Amount</th>
                        <th>Product Details</th>
                        <th>Delivery Charges</th>
                        <th>Status</th>
                        <!--<th>User Received</th>-->
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
                        <!--<th>Delivery Date</th>-->
                        <th>Cancel Order</th>
                        <th>Print Invoice</th>
                        
                       
                    
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                 
                    $c=1;
                    $sql="SELECT * FROM `order_list` ORDER BY order_id DESC";
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
                      
                      <td><?php echo $row['total'];  ?></td>
                      <td>	<a href="view_product_details.php?invo=<?=$row['invoice_no']?>" class="bill-btn5 hover-btn">View</a></td>
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
                      <!--<td style="color:<?=$row['received_status'] == 'N' ? 'red' : 'green'?>">
                      	<?=$row['received_status'] == 'N' ? 'No' : 'Yes'?>
                      </td>-->
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
                      <!--<td><?php echo $row['delivery_time'];  ?></td>-->
                      <?php
                      if($row['status'] == 'CANCELLED'){
                      ?>
                      <td><button type="button" class="btn btn-danger statuspro_<?=$row['order_id']?>">CANCELLED</button></td>

                      <?php } else if($row['status'] == 'DELIVERED'){ ?>

                      	<td></td>

                      <?php } else{?>
                    	<td><button type="button" class="btn btn-info statuspro_<?=$row['order_id']?>" onclick="change_status_cancel('<?=$row['order_id']?>','<?=$row['user_id']?>')">CANCEL</button></td>
                      <?php } ?>
                      
                       <td>
                      	<a href="booking_invoice_pdf.php?invo=<?=base64_encode($row['invoice_no'])?>&user=<?=base64_encode($row['user_id'])?>" target="_blank" class="bill-btn5 hover-btn">View Bill</a>
                      </td>
                      
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
                        <!--<th>Product Name</th>-->
                        <!--<th>Quentity</th>-->
                        <!--<th>Product Price </th>-->
                        <th>Total Amount</th>
                        <th>Product Details</th>
                        <th>Delivery Charges</th>
                        <th>Status</th>
                        <!--<th>User Received</th>-->
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
                        <!--<th>Delivery Date</th>-->
                        <th>Cancel Order</th>
                        <th>Print Invoice</th>
                    </tr>
                  </tfoot>
            					</table>
            				</div>
            			</div>
          			</div>
        		</div>
      		</div><!-- End Row-->
    	</div><!-- End container-fluid -->
    </div><!-- End content-wrapper -->
    
    <script type="text/javascript">
    	function order_status_cng(id,user_id){
      	 var order_status = $("#order_status"+id).val();
      	 //alert(order_status);
      	 $.ajax({
            type:"post",
            url:"api/user_order_status_cng.php",
            data:{id:id,order_status:order_status,user_id:user_id},
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
            data:{val:val,order_type:'All'},
            success:function(data){
            	$("#default-datatable").html(data);
            	
            }
        })
    }
    
    
    	function change_status_cancel(id,user_id){
      	// alert(id);exit;
  		$.ajax({
  			url: "api/cng_order_cancel_status.php",
  			type: "post",
  			data : { id : id,user_id:user_id },

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