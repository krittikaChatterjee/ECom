	<?php include('header.php'); 
	$sql=mysqli_query($conn,"SELECT * FROM `order_list` ORDER BY order_id DESC LIMIT 1");
    $fetch_data=mysqli_fetch_assoc($sql);
    if($fetch_data['invoice_no'] !=''){
        $num=substr($fetch_data['invoice_no'],3);
        $serial=$num + 1;
        $code="INV".$serial;
    }
    else {
        $code="INV10001";
    }
	
	if(isset($_REQUEST['place_order'])){
	date_default_timezone_set("Asia/kolkata");
    $date=date("Y-m-d");
    $time=date("h:i:sa");
    
    $name=mysqli_real_escape_string($conn,$_REQUEST['name']);
    $email=mysqli_real_escape_string($conn,$_REQUEST['email']);
    $address=mysqli_real_escape_string($conn,$_REQUEST['address']);
    $paymentmethod=mysqli_real_escape_string($conn,$_REQUEST['paymentmethod']);
    $sub_total=mysqli_real_escape_string($conn,$_REQUEST['sub_total']);
    $delivery_charge=mysqli_real_escape_string($conn,$_REQUEST['delivery_charge']);
    $grand_total=mysqli_real_escape_string($conn,$_REQUEST['grand_total']);
    
    
    $phone      =   mysqli_real_escape_string($conn,$_REQUEST['phone']);
    $house_no   =   mysqli_real_escape_string($conn,$_REQUEST['house_no']);
    $street_name=   mysqli_real_escape_string($conn,$_REQUEST['street_name']);
    $landmark   =   mysqli_real_escape_string($conn,$_REQUEST['landmark']);
    $state      =   mysqli_real_escape_string($conn,$_REQUEST['state']);
    $city       =   mysqli_real_escape_string($conn,$_REQUEST['city']);
    $pincode    =   mysqli_real_escape_string($conn,$_REQUEST['pincode']);
    
    
    
    
    $user_cart=mysqli_query($conn,"SELECT * FROM add_cart WHERE user_id='$user_id'");
        while($user_cart_fetch=mysqli_fetch_assoc($user_cart)){
        $qty_id=$user_cart_fetch['qty_id'];
        $cart_quantity=$user_cart_fetch['count'];

        $ordered_product=mysqli_query($conn,"INSERT INTO ordered_product (`invoice_no`,`user_id`,`product_id`,`cart_quantity`,`date`,`time`,`status`) VALUES ('$code','$user_id','$qty_id','$cart_quantity','$date','$time','PLACED')");
        }
        
        $order_list=mysqli_query($conn,"INSERT INTO order_list (`user_id`,`invoice_no`,`sub_total`,`delivery_charge`,`total`,`status`,`name`,`email`,`address`, `payment`,`date`,`time`,`phone`,`house_no`,`street_name`,`landmark`,`state`,`city`,`pincode`) VALUES ('$user_id','$code','$sub_total','$delivery_charge','$grand_total','PLACED','$name','$email','$address','$paymentmethod','$date','$time','$phone','$house_no','$street_name','$landmark','$state','$city','$pincode')");
        
        $clear_cart=mysqli_query($conn,"DELETE FROM add_cart WHERE user_id='$user_id'");
        
        echo '<script>swal("Success", "Order Successfully Placed", "success")</script>';
        echo "<script>setTimeout(function() {window.location='dashboard_my_orders.php'}, 3000)</script>";
	}
	?>
<body onload="check_avail()">	
	<div class="wrapper">
		<?php
		$user=mysqli_query($conn,"SELECT * FROM `users` WHERE `u_id`='$user_id'");
		$user_fetch=mysqli_fetch_assoc($user);
		?>
		<div class="all-product-grid">
			<div class="container">
			    <form method="POST">
				<div class="row">
					<div class="col-lg-8 col-md-7">
						<div id="checkout_wizard" class="checkout accordion left-chck145">
							<div class="checkout-step">
								<div class="checkout-card" id="headingTwo">
									<span class="checkout-step-number">1</span>
									<h4 class="checkout-step-title">
										<button class="btn btn-primary" style="background-color:#EB5C4C; border:none;" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">Delivery Address</button>
									</h4>
								</div>
								<div id="collapseTwo" class="collapse in show" aria-labelledby="headingTwo" data-parent="#checkout_wizard">
									<div class="checkout-step-body">
										<div class="checout-address-step">
											<div class="row">
												<div class="col-lg-12">												
													<div class="address-fieldset">
														<div class="row">
															<div class="col-lg-4 col-md-12">
																<div class="form-group">
																	<label class="control-label">Name*</label>
																	<input id="name" name="name" type="text" placeholder="Name" class="form-control input-md" required=""  value="<?=$user_fetch['name']?>" >
																</div>
															</div>
															<div class="col-lg-4 col-md-12">
																<div class="form-group">
																	<label class="control-label">Email Address*</label>
																	<input id="email1" name="email" type="text" placeholder="Email Address" class="form-control input-md" required=""  value="<?=$user_fetch['email']?>">
																</div>
															</div>
															<div class="col-lg-4 col-md-12">
																<div class="form-group">
																	<label class="control-label">Phone*</label>
																	<input  name="phone" type="text" placeholder="Phone" class="form-control input-md" required=""  value="<?=$user_fetch['mobile']?>" id="phone">
																</div>
															</div>
															<div class="col-lg-3 col-md-12">
															    <div class="form-group">
																	<label class="control-label">House No</label>
																	<input name="house_no" type="text" placeholder="House No" class="form-control input-md" required=""  value="<?=$user_fetch['house_no']?>" id="house_no">
																</div>
															</div>
															<div class="col-lg-6 col-md-12">
															    <div class="form-group">
																	<label class="control-label">Street Name</label>
																	<input name="street_name" type="text" placeholder="Street Name" class="form-control input-md" required=""  value="<?=$user_fetch['street_name']?>" id="street_name">
																</div>
															</div>
															<div class="col-lg-3 col-md-12">
															    <div class="form-group">
																	<label class="control-label">Landmark</label>
																	<input name="landmark" type="text" placeholder="Landmark" class="form-control input-md" required=""  value="<?=$user_fetch['landmark']?>" id="landmark">
																</div>
															</div>
															<div class="col-lg-4 col-md-12">
															    <div class="form-group">
																	<label class="control-label">State</label>
																	<select class="form-control" name="state" required id="state" onchange="fetch_city()">  
        										    	                <option value="">--Choose--</option>
        										    	                <?php
        										    	                    $stateSql = mysqli_query($conn,"SELECT * FROM `states` WHERE `country_id` = '101'");
        										    	                    while($stateRes = mysqli_fetch_assoc($stateSql)) {
        										    	                        ?>
        										    	                            <option <?= (($stateRes['id'] == $user_fetch['state']) ? 'selected' : '') ?>  value="<?=$stateRes['id'];?>"><?=$stateRes['name'];?></option>
        										    	                        <?php
        										    	                    }
        										    	                ?>
        										    	            </select>
																</div>
															</div>
															<div class="col-lg-4 col-md-12">
															    <div class="form-group">
																	<label class="control-label">City</label>
																	<?php
        										    	                $userCity = $user_fetch['city'];
        										    	                $cityRessaa = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `cities` WHERE `id` = '$userCity'"));
        										    	            ?>
        										    	            <select class="form-control" name="city" id="city" required> 
        										    	                <option value="<?=$cityRessaa['id']?>"><?=$cityRessaa['name']?></option>
        										    	            </select>
																</div>
															</div>
															<div class="col-lg-4 col-md-12">
															    <div class="form-group">
																	<label class="control-label">Pincode</label>
																	<input name="pincode" type="text" placeholder="Pincode" class="form-control input-md" required=""  value="<?=$user_fetch['pincode']?>" id="pincode" onchange="check_avail()">
																	<span id="pincodeError1" style="color:red;font-size:12px;"></span><br>
																	<span id="pincodeError2" style="color:red;font-size:12px;"></span>
																</div>
															</div>
															<!--<div class="col-lg-12 col-md-12">-->
															<!--	<div class="form-group">-->
															<!--		<label class="control-label">Flat / House / Office No.*</label>-->
															<!--		<input id="flat" name="address" type="text" placeholder="Address" class="form-control input-md" required value="<?//=$user_fetch['address']?>" readonly>-->
															<!--	</div>-->
															<!--</div>-->
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						
							<div class="checkout-step">
								<div class="checkout-card" id="headingFour">
									<span class="checkout-step-number">2</span>
									<h4 class="checkout-step-title"> 
										<button class="btn btn-success" style="background-color:#EB5C4C; border:none;" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Payment</button>
									</h4>
								</div>
								<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#checkout_wizard">
									<div class="checkout-step-body">
										<div class="payment_method-checkout">	
											<div class="row">	
												<div class="col-md-12">
													<div class="rpt100">													
														<ul class="radio--group-inline-container_1">
															<li>
																<div class="radio-item_1">
																	<input id="cashondelivery1" value="cashondelivery" name="paymentmethod" type="radio" data-minimum="50.0" required>
																	<label for="cashondelivery1" class="radio-label_1">Cash on Delivery</label>
																</div>
															</li>
															<li>
																<div class="radio-item_1">
																	<input id="card1" value="card" name="paymentmethod" type="radio" data-minimum="50.0" required>
																	<label  for="card1" class="radio-label_1">Online</label>
																</div>
															</li>
														</ul>
													</div>
													<input type="submit" name="place_order" id="submitee" class="next-btn16 hover-btn" value="Place Order">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-5">
						<div class="pdpt-bg mt-0">
							<div class="pdpt-title">
								<h4>Order Summary</h4>
							</div>
							<?php
                            $cart=mysqli_query($conn,"SELECT * FROM add_cart WHERE user_id='$user_id'");
                            while($cart_fetch=mysqli_fetch_assoc($cart)){
                                $qty_id=$cart_fetch['qty_id'];
                                $product_count=$cart_fetch['count'];
                                $cart_id=$cart_fetch['cart_id'];
                                
                                $quantity_per_unit=mysqli_query($conn,"SELECT * FROM qty_per_unit WHERE qty_id='$qty_id'");
                    		    $quantity_per_unit_fetch=mysqli_fetch_assoc($quantity_per_unit);
                    		    $product_id=$quantity_per_unit_fetch['product_id'];
                    		    $product_price=$quantity_per_unit_fetch['product_price'];
                    		    $discount_price=$quantity_per_unit_fetch['discount_price'];
                    		    $discount=$product_price-$discount_price;
                    		    $discount_percentage=(($discount*100)/$product_price);
                    		    $product_total=$discount_price*$product_count;
                    		    
                    		    $product=mysqli_query($conn,"SELECT * FROM product WHERE product_id='$product_id'");
                    		    $product_fetch=mysqli_fetch_assoc($product);
                    		    $gst_percentage=$product_fetch['persentage_of'];
                    		    $selling_price=$discount_price+(($discount_price*$gst_percentage)/100);
                    		    $product_total=$selling_price*$product_count;
                    		    
                                $sub_total+=$product_total;
                                $delivery_charge=mysqli_query($conn,"SELECT * FROM delivery_charges");
                                $delivery_charge_fetch=mysqli_fetch_assoc($delivery_charge);
                                $minimum_amount=$delivery_charge_fetch['amount'];
                                if($sub_total>$minimum_amount){
                                    $charge_amount=$delivery_charge_fetch['delivery_charge'];
                                }
                                else{
                                    $charge_amount=0;
                                }
                                $grand_total=$sub_total+$charge_amount;
                            ?>
							<div class="right-cart-dt-body">
								<div class="cart-item border_radius">
									<div class="cart-product-img">
										<img src="Admin/product_image/<?=$product_fetch['main_image']?>" height="75" width="100">
									</div>
									<div class="cart-text">
										<h4><?=$product_fetch['product_name']?> <?=$quantity_per_unit_fetch['qtu_per_unit']?><?=$quantity_per_unit_fetch['unit']?> x<?=$product_count?></h4>
										<div class="cart-item-price">&#8377;<?=$product_total?></div>
									</div>		
								</div>
							</div>
							<?php } ?>
							<div class="total-checkout-group">
								<div class="cart-total-dil">
									<h4>Subtotal</h4>
									<span>&#8377;<?=$sub_total?></span><input type="hidden" value="<?=$sub_total?>" name="sub_total">
								</div>
								<div class="cart-total-dil pt-3">
									<h4>Delivery Charges</h4>
									<span>&#8377;<?=$charge_amount?></span><input type="hidden" value="<?=$charge_amount?>" name="delivery_charge">
								</div>
							</div>
							<div class="main-total-cart">
								<h2>Total</h2>
								<span>&#8377;<?=$grand_total?></span><input type="hidden" value="<?=$grand_total?>" name="grand_total">
							</div>
						</div>
					</div>
				</div>
			 </form>
			</div>
		</div>
	</div>
</body>
	<?php include('footer.php'); ?>
	<script>
function fetch_city(){
    var state = $('#state').val();
    $.ajax({
       type: "post",
       url : "api/fetch_city.php",
       data : {state:state},
       success : function(res){
            $('#city').html(res);
       }
   });
    
    
}    
</script>


<script>
function check_avail(){
    var pincode = $('#pincode').val();
    $.ajax({
           type: "post",
           url : "api/check_pin_avail.php",
           data : {pincode:pincode},
           success : function(res){
                if(res == 'pincode_nei'){
                    // swal("Delivery in this Pincode is Not Possible!!! Please Contact Us For More Details !!");
                    $('#pincodeError1').text("Delivery in this Pincode is Not Possible !!!");
                    $('#pincodeError2').text("Please Contact Us For More Details !!!");
                    $( "#submitee" ).prop( "disabled", true );
                } else {
                    $('#pincodeError1').text("");
                    $('#pincodeError2').text("");
                    $( "#submitee" ).prop( "disabled", false );
                }
           }
        });
}    
</script>


