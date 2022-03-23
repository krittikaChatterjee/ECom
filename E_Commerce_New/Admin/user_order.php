<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">User Order</h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <!--<li class="breadcrumb-item">Order</li>-->
              <li class="breadcrumb-item active" aria-current="page">User Order</li>
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
                        <th>Invoice</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Delivery House No</th>
                        <th>Street Name</th>
                        <th>Landmark</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Pincode</th>
                        <th>Order Status</th>
                        <th>Remarks</th>
                        <th>Tracking No</th>
                        <th>Payment Mode</th>
                        <th>Sub Total</th>
                        <th>Delivery Charges</th>
                        <th>Total Charges</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>View Order Details</th>
                        <th>Print Invoice</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                 
                    $c=1;
                    $sql="SELECT * FROM `order_list` ORDER BY order_id DESC";
                    $queary=mysqli_query($conn,$sql);
                    $c=1;
                    while($row=mysqli_fetch_assoc($queary))
                    {
                        ?>
                        <tr>
                            <td><?php echo $c; $c++; ?></td>
                            <td><?php echo $invoice_no = $row['invoice_no'];?></td>
                            <td><?=$row['name']?></td>
                            <td><?=$row['email']?></td>
                            <td><?=$row['house_no']?></td>
                            <td><?=$row['street_name']?></td>
                            <td><?=$row['landmark']?></td>
                            <td><?php
                                $state_id  = $row['state'];
                                $stateRes = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `states` WHERE `id` = '$state_id'"));
                                echo $state = $stateRes['name'];
                            ?></td>
                            <td><?php
                                $city_id        = $row['city'];
                                $cityRes = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `cities` WHERE `id` = '$city_id'"));
                                echo $city = $cityRes['name'];
                            ?></td>
                            <td><?=$row['pincode']?></td>
                            <td>
                                <select id="status<?=$invoice_no?>" onchange="insertee_data('<?=$invoice_no?>')" class="form-control" style="width:130px;">
                                    <option <?= (($row['status'] == 'PLACED') ? 'selected' : '') ?> value="PLACED">PLACED</option>
                                    <option <?= (($row['status'] == 'PACKED') ? 'selected' : '') ?>  value="PACKED">PACKED</option>
                                    <option <?= (($row['status'] == 'DISPATCHED') ? 'selected' : '') ?>  value="DISPATCHED">DISPATCHED</option>
                                    <option <?= (($row['status'] == 'DELIVERED') ? 'selected' : '') ?>  value="DELIVERED">DELIVERED</option>
                                    <option <?= (($row['status'] == 'CANCELLED') ? 'selected' : '') ?>  value="CANCELLED">CANCELLED</option>
                                </select>
                            </td>
                            <td><input type="text" id="remarks<?=$invoice_no?>" class="form-control" style="width:130px;" placeholder="Type Here..." value="<?=$row['remarks'];?>"></td>
                            <td><input type="text" id="traking_no<?=$invoice_no?>" class="form-control" style="width:130px;" placeholder="Type Here..." value="<?=$row['tracking_no'];?>"></td>
                            <td><?=$row['payment']?></td>
                            <td><?=$row['sub_total']?></td>
                            <td><?=$row['delivery_charge']?></td>
                            <td><?=$row['total']?></td>
                            <td><?=$row['date']?></td>
                            <td><?=$row['time']?></td>
                            <td><a href="order_details.php?id=<?=base64_encode($row['invoice_no'])?>">View</a></td>
                            <td><a href="print_invoice_admin.php?invo=<?=base64_encode($row['invoice_no'])?>" target="_blank">View</a></td>
                        </tr>
                        <?php
                        
                    }

                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Sl. Number</th>
                        <th>Invoice</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Delivery House No</th>
                        <th>Street Name</th>
                        <th>Landmark</th>
                        <th>City</th>
                        <th>Pincode</th>
                        <th>Order Status</th>
                        <th>Remarks</th>
                        <th>Tracking No</th>
                        <th>Payment Mode</th>
                        <th>Sub Total</th>
                        <th>Delivery Charges</th>
                        <th>Total Charges</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>View Order Details</th>
                        <th>Print Invoice</th>
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
            data:{val:val,order_type:'Normal'},
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

<script>
function insertee_data(invoice_no){
    var status = $('#status'+invoice_no).val();
    var remarks = $('#remarks'+invoice_no).val();
    var traking_no = $('#traking_no'+invoice_no).val();
    
    // console.log('status',status);
    // console.log('remarks',remarks);
    // console.log('transaction_no',transaction_no);
    $.ajax({
       type: "post",
       url : "api/insertee_data.php",
       data : {invoice_no:invoice_no,status:status,remarks:remarks,traking_no:traking_no},
       success : function(res){
    //       console.log(res);
		  // location.reload();
       }
   });
    
    
}    
</script>

