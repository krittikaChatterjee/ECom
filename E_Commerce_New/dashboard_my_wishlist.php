<?php 
session_start();
include('header.php'); 
$user_id = $_SESSION['user'];
?>
<div class="wrapper">
    <div>
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-3 col-md-4">
    				<div class="left-side-tabs">
    					<div class="dashboard-left-links">
							<a href="dashboard_overview.php" class="user-item "><i class="uil uil-apps"></i>Overview</a>
							<a href="dashboard_my_orders.php" class="user-item "><i class="uil uil-box"></i>My Orders</a>
							<a href="dashboard_my_wishlist.php" class="user-item active"><i class="uil uil-heart"></i>My Wishlist</a>
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
    								<h4><i class="uil uil-heart"></i>Shopping Wishlist</h4>
    							</div>
    						</div>
    						<div class="col-lg-12 col-md-12">
    							<div class="pdpt-bg">
    								<div class="wishlist-body-dtt">
        							    <?php
        							    $user_wishlistSql=mysqli_query($conn,"SELECT * FROM `add_wishlist` WHERE `user_id`='$user_id'");
        							    while($user_wishlistRes=mysqli_fetch_assoc($user_wishlistSql)){
        					            $qty_id=$user_wishlistRes['product_id'];
        					            $wishlist_id=$user_wishlistRes['id'];
        					            
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
        							    ?>
        								<div class="cart-item">
        									<div class="cart-product-img">
        										<img src="Admin/product_image/<?=$product_fetch['main_image']?>">
        									</div>
        									<div class="cart-text">
        										<h7><?=$product_fetch['product_name']?></h7>
        										<h7><?=$quantity_per_unit_fetch['qtu_per_unit']?> <?=$quantity_per_unit_fetch['unit']?></h7>
        										<div class="cart-item-price d-flex">&#8377;<?=$selling_price?></div>
            									<button class="add-cart-btn hover-btn mt-2" onclick="wishlistcard(<?=$qty_id?>,<?=$user_id?>)">Add to Cart</button>
        										<button type="button" class="cart-close-btn" onclick="delete_wishlist(<?=$wishlist_id?>)">
        										    <i class="uil uil-trash-alt"></i></button>
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
	</div>
</div>
<script>
function delete_wishlist(id){
    $.ajax({
        type : "post",
        url  : "api/delete_wishlist.php",
        data : {id:id},
        success : function(res){
        swal("","Item Successfully Removed From Your Wishlist", "success");
        setTimeout(function(){window.location='dashboard_my_wishlist.php'}, 3000);
        }
    })
}
function wishlistcard(qty_id,user_id){
    $.ajax({
        type:"post",
        url:"api/addtocart.php",
        data:{qty_id:qty_id,user_id:user_id},
        success:function(data){
            swal("","Item Successfully Added Into Cart", "success");
            setTimeout(function() {window.location='dashboard_my_wishlist.php'}, 3000);
            $.ajax({
                type:"post",
                url:"api/headercartcount.php",
                data:{user_id:user_id},
                success:function(data){
                    $('#headercartcount').html(data);
                }
            })
            $.ajax({
                type:"post",
                url:"api/modalcart.php",
                data:{user_id:user_id},
                success:function(data){
                    $('#modalcart').html(data);
                }
            })
            $.ajax({
                type:"post",
                url:"api/clearwishlist.php",
                data:{qty_id:qty_id,user_id:user_id},
                success:function(data){
                    // $('#modalcart').html(data);
                }
            })
        }
    })
}
</script>
<?php include('footer.php'); ?>