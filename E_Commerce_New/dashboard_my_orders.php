<?php
include('header.php');
session_start();
$user_id=$_SESSION['user'];

if(isset($_REQUEST['submit'])){
    date_default_timezone_set('Asia/Kolkata'); 
    $date = date("Y-m-d");
    $time = date("h:ia");
    $order_id = mysqli_real_escape_string($conn,$_REQUEST['order_id']);
    $cancel_reason = mysqli_real_escape_string($conn,$_REQUEST['cancel_reason']);
    
    $cancel = mysqli_query($conn,"UPDATE order_list SET status='CANCELED',cancel_reason='$cancel_reason',cancel_date='$date',cancel_time='$time' WHERE order_id='$order_id'");
    echo '<div class="alert alert-success alert-dismissible fade show myAlert" role="alert">
     <strong>Success!</strong> Order Cancelled Successfully
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
     <span aria-hidden="true">&times;</span>
     </button>
     </div>';
    // echo '<script>swal("Success", "Order cancelled successfully", "success")</script>';
    echo "<script>setTimeout(function() {window.location='dashboard_my_orders.php'}, 2000)</script>";
}
?>
<style>
.modal-dialog {
max-width: 350px;
margin: 15.75rem auto;
}
</style>
<div class="wrapper">
	<div class>
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-4">
					<div class="left-side-tabs">
						<div class="dashboard-left-links">
								<a href="dashboard_overview.php" class="user-item "><i class="uil uil-apps"></i>Overview</a>
								<a href="dashboard_my_orders.php" class="user-item active"><i class="uil uil-box"></i>My Orders</a>
								<a href="dashboard_my_wishlist.php" class="user-item"><i class="uil uil-heart"></i>My Wishlist</a>
								<a href="dashboard_my_addresses.php" class="user-item"><i class="uil uil-location-point"></i>My Address</a>
								<a href="logout.php" class="user-item"><i class="uil uil-exit"></i>Logout</a>
							</div>
					</div>
				</div>
				<div class="col-lg-9 col-md-8">
					<div class="dashboard-right">
						<div class="row">
							<div class="col-md-12">
								<div class="main-title-tab">
									<h4><i class="uil uil-box"></i>My Orders</h4>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
							    <?php
							    $query=mysqli_query($conn,"SELECT * FROM order_list WHERE user_id='$user_id' ORDER BY order_id DESC");
							    $rows=mysqli_num_rows($query);
							    while($order_list=mysqli_fetch_assoc($query)){
                                $date=$order_list['date'];
                                $time=$order_list['time'];
					            $view_date=date("j M",strtotime($date));
					            $view_time=date("h:iA",strtotime($time));
					            $order_id=$order_list['order_id'];
					            $invoice_no=$order_list['invoice_no'];
                                
                                $subtotal=$order_list['sub_total'];
                                $delivery=$order_list['delivery_charge'];
                                $grand_total=$order_list['total'];
                                $status=$order_list['status'];
                                ?>
								<div class="pdpt-bg">
									<div class="pdpt-title">
										<h6>Order Timing <?=$view_date?>, <?=$view_time?></h6>
									</div> 
									<div class="order-body10">
										<ul class="order-dtsll">
											<li>
												<div class="order-dt-img">
													<img src="images/groceries.svg">
												</div>
											</li>
											<li>
												<div class="order-dt47">
													<p><?=$status?> - <?=$invoice_no?></p>
													<span><b>Remarks : </b><?= (($order_list['remarks']=='') ? 'No Remarks' : $order_list['remarks']); ?></span>
													<span style="margin-left : 5px; float: right;"><b>Tracking Id : </b><?= (($order_list['tracking_no']=='') ? 'No Tracking No' : $order_list['tracking_no'])?></span>
												</div>
											</li>
										</ul>
										<table style="margin-left: 110px;margin-top: -45px; width:750px;" >
										    <tr align="center">
										        <th>Product Name</th>
										        <th>Product Count</th>
										        <th>Product Variant</th>
										        <th>Product Price(in Rs.)</th>
										        <th>Total Price(in Rs.)</th>
										    </tr>
										    <?php
										        $product_sql = mysqli_query($conn,"SELECT * FROM `ordered_product` WHERE `invoice_no` = '$invoice_no'");
										        while($product_res = mysqli_fetch_assoc($product_sql)) {
										            $qty_id = $product_res['product_id'];
										            $qty_res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `qty_per_unit` WHERE `qty_id` = '$qty_id'"));
										            $product_id = $qty_res['product_id'];
										            $productee_res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `product` WHERE `product_id` = '$product_id'"));
										    ?>
										    <tr align="center">
										        <td><?=$productee_res['product_name']?></td>
										        <td><?=$product_res['cart_quantity']?></td>
										        <td><?=$qty_res['qtu_per_unit'].$qty_res['unit']?></td>
										        <td><?php
										            $sell_price = $qty_res['discount_price'];
										            $gst = $productee_res['persentage_of'];
										            echo $total_price = $sell_price+($sell_price*$gst)/100;
										        ?></td>
										        <td><?=$total_price * $product_res['cart_quantity']?></td>
										    </tr>      
										    <?php } ?>
										    
										</table>
										
										<div class="total-dt">
										    <div class="total-checkout-group">
										       <h4>Delivery Address</h4>
										        <table>
										            <tr align="center">
										                <th>House No</th>
										                <th>Street Name</th>
										                <th>Landmark</th>
										                <th>State</th>
										                <th>City</th>
										                <th>Pincode</th>
										            </tr>
										            <tr align="center">
										                <td><?=$order_list['house_no']?></td>
										                <td><?=$order_list['street_name']?></td>
										                <td><?=$order_list['landmark']?></td>
										                <td><?php
										                    $state_id=$order_list['state'];
										                    $state_res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `states` WHERE `id` = '$state_id'"));
										                    echo $state_res['name'];
										                ?></td>
										                <td><?php
										                    $city_idddd = $order_list['city'];
										                    $city_res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `cities` WHERE `id` = '$city_idddd'"));
										                    echo $city_res['name'];
										                ?></td>
										                <td><?=$order_list['pincode']?></td>
										            </tr>
										        </table>
										        
										    </div>
										</div>
										
										
										
										<div class="total-dt">
											<div class="total-checkout-group">
												<div class="cart-total-dil">
													<h4>Sub Total</h4>
													<span>&#8377;<?=$subtotal?></span>
												</div>
												<div class="cart-total-dil pt-3">
													<h4>Delivery Charges</h4>
													<span>&#8377;<?=$delivery?></span>
												</div>
											</div>
											<div class="main-total-cart">
												<h2>Total</h2>
												<span>&#8377;<?=$grand_total?></span>
											</div>
										</div>
										<div class="track-order">
											<h4>Track Order</h4>
											<div class="bs-wizard" style="border-bottom:0;">
											    <?php if($status=="PLACED"){ ?>
												<div class="bs-wizard-step active">
													<div class="text-center bs-wizard-stepnum">Placed</div>
													<div class="progress"><div class="progress-bar"></div></div>
													<a href="#" class="bs-wizard-dot"></a>
												</div>
												<div class="bs-wizard-step disabled">
													<div class="text-center bs-wizard-stepnum">Packed</div>
													<div class="progress"><div class="progress-bar"></div></div>
													<a href="#" class="bs-wizard-dot"></a>
												</div>
												<div class="bs-wizard-step disabled">
													<div class="text-center bs-wizard-stepnum">On the way</div>
													<div class="progress"><div class="progress-bar"></div></div>
													<a href="#" class="bs-wizard-dot"></a>
												</div>
												<div class="bs-wizard-step disabled">
													<div class="text-center bs-wizard-stepnum">Delivered</div>
													<div class="progress"><div class="progress-bar"></div></div>
													<a href="#" class="bs-wizard-dot"></a>
												</div>
												<?php } if($status=="PACKED"){ ?>
												<div class="bs-wizard-step complete">
													<div class="text-center bs-wizard-stepnum">Placed</div>
													<div class="progress"><div class="progress-bar"></div></div>
													<a href="#" class="bs-wizard-dot"></a>
												</div>
												<div class="bs-wizard-step active">
													<div class="text-center bs-wizard-stepnum">Packed</div>
													<div class="progress"><div class="progress-bar"></div></div>
													<a href="#" class="bs-wizard-dot"></a>
												</div>
												<div class="bs-wizard-step disabled">
													<div class="text-center bs-wizard-stepnum">On the way</div>
													<div class="progress"><div class="progress-bar"></div></div>
													<a href="#" class="bs-wizard-dot"></a>
												</div>
												<div class="bs-wizard-step disabled">
													<div class="text-center bs-wizard-stepnum">Delivered</div>
													<div class="progress"><div class="progress-bar"></div></div>
													<a href="#" class="bs-wizard-dot"></a>
												</div>
												<?php } if($status=="DISPATCHED"){ ?>
												<div class="bs-wizard-step complete">
													<div class="text-center bs-wizard-stepnum">Placed</div>
													<div class="progress"><div class="progress-bar"></div></div>
													<a href="#" class="bs-wizard-dot"></a>
												</div>
												<div class="bs-wizard-step complete">
													<div class="text-center bs-wizard-stepnum">Packed</div>
													<div class="progress"><div class="progress-bar"></div></div>
													<a href="#" class="bs-wizard-dot"></a>
												</div>
												<div class="bs-wizard-step active">
													<div class="text-center bs-wizard-stepnum">On the way</div>
													<div class="progress"><div class="progress-bar"></div></div>
													<a href="#" class="bs-wizard-dot"></a>
												</div>
												<div class="bs-wizard-step disabled">
													<div class="text-center bs-wizard-stepnum">Delivered</div>
													<div class="progress"><div class="progress-bar"></div></div>
													<a href="#" class="bs-wizard-dot"></a>
												</div>
												<?php } if($status=="DELIVERED"){ ?>
												<div class="bs-wizard-step complete">
													<div class="text-center bs-wizard-stepnum">Placed</div>
													<div class="progress"><div class="progress-bar"></div></div>
													<a href="#" class="bs-wizard-dot"></a>
												</div>
												<div class="bs-wizard-step complete">
													<div class="text-center bs-wizard-stepnum">Packed</div>
													<div class="progress"><div class="progress-bar"></div></div>
													<a href="#" class="bs-wizard-dot"></a>
												</div>
												<div class="bs-wizard-step complete">
													<div class="text-center bs-wizard-stepnum">On the way</div>
													<div class="progress"><div class="progress-bar"></div></div>
													<a href="#" class="bs-wizard-dot"></a>
												</div>
												<div class="bs-wizard-step active">
													<div class="text-center bs-wizard-stepnum">Delivered</div>
													<div class="progress"><div class="progress-bar"></div></div>
													<a href="#" class="bs-wizard-dot"></a>
												</div>
												<?php } if($status=="CANCELLED"){ ?>
												<div class="bs-wizard-step active">
													<div class="text-center bs-wizard-stepnum">Cancelled</div>
													<a href="#" class="bs-wizard-dot"></a>
												</div>
												<div class="bs-wizard-step disabled"></div>
												<div class="bs-wizard-step disabled"></div>
												<div class="bs-wizard-step disabled"></div>
												<?php } ?>
											</div>
										</div>
										<div class="call-bill">
                                            <div>
											    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?=$order_id?>">Cancel</button>
											</div>
											<div class="order-bill-slip">
												<a href="print_invoice.php?invo=<?=base64_encode($invoice_no)?>" class="bill-btn5 hover-btn" target="_blank">View Bill</a>
											</div>
										</div>
									</div>
								</div>
								<div class="modal fade" id="exampleModal<?=$order_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                     <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cancel Reason</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post">
                                                <input type="hidden" value="<?=$order_id?>" name="order_id">
                                                <input type="text" name="cancel_reason" class="form-control">
                                                <button type="submit" name="submit" class="btn btn-primary mt-2">Submit</button>
                                            </form>
                                          </div>
                                        </div>
                                     </div>
                                </div>
								<?php } ?>
							</div>								
						</div>
					</div>
				</div>
			</div>	
		</div>	
	</div>	
</div>
<?php include('footer.php'); ?>
		 

<!--For search in header-->
<script>
function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
  var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(lat2 - lat1); // deg2rad below
  var dLon = deg2rad(lon2 - lon1);
  var a =
    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
    Math.sin(dLon / 2) * Math.sin(dLon / 2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  var d = R * c; // Distance in km
  return d;
}

function deg2rad(deg) {
  return deg * (Math.PI / 180)
}
var arr = [];
function changeOnee(){
    // alert("chnge");
    // var centerLat = centerLat;
    // var centerLng = centerLng;
    var centerLatLong = $('#locationeeee').val();
    var reseeee = centerLatLong.split("_");
    var centerLat = reseeee[0];
    var centerLng = reseeee[1];
    
    var posts = <?php echo json_encode($all_details); ?>;
    
    let closePosts = [];
    // var dInKm = 5;
    var dInKm = $('#distantKm').val();
    
    posts.forEach((post) => {
      if (getDistanceFromLatLonInKm(centerLat, centerLng, post.latitude, post.longitude) < dInKm) {
        closePosts.push(post);
      }
    });
    
    // console.log('>>>>>>>>>>>',closePosts);
    var usr_id_arr = [];
    closePostsLength = closePosts.length;
    // console.log(closePostsLength);
    for(i=0;i<closePostsLength;i++) {
        // console.log(closePosts[i]);
        var usr_id = closePosts[i].user_id;
        usr_id_arr.push(usr_id);
    }
    arr = usr_id_arr;
    console.log('usr_id_arr',usr_id_arr);
    console.log('centerLatLong',centerLatLong);
    console.log('dInKm',dInKm);
    
    
   
}

</script>		 