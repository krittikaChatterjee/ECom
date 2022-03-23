<?php
include('../connection.php');
$user_id=$_POST['user_id'];
$cart_count=mysqli_query($conn,"SELECT * FROM add_cart WHERE user_id='$user_id'");
$cart_rows=mysqli_num_rows($cart_count);
?>
<div class="bs-canvas-header side-cart-header p-3 ">
	<div class="d-inline-block  main-cart-title">My Cart <span>(<?=$cart_rows?> Items)</span></div>
	<button type="button" class="bs-canvas-close close" aria-label="Close"><i class="uil uil-multiply"></i></button>
</div> 
<div class="bs-canvas-body">
	<div class="side-cart-items">
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
	    
	    $product=mysqli_query($conn,"SELECT * FROM product WHERE product_id='$product_id'");
	    $product_fetch=mysqli_fetch_assoc($product);
	    $gst_percentage=$product_fetch['persentage_of'];
	    $selling_price=$discount_price+(($discount_price*$gst_percentage)/100);
	    ?>
		<div class="cart-item">
			<div class="cart-product-img">
				<img src="Admin/product_image/<?=$product_fetch['main_image']?>" height="90" width="90">
				<div class="offer-badge"><?=$discount_percentage?>% OFF</div>
			</div>
			<div class="cart-text">
				<h4><?=$product_fetch['product_name']?></h4>
				<div class="cart-radio">
					<ul class="kggrm-now">
						<li>
							<input type="radio" id="a1" name="cart1">
							<label for="a1"><?=$quantity_per_unit_fetch['qtu_per_unit']?> <?=$quantity_per_unit_fetch['unit']?></label>
						</li>
					</ul>
				</div>
				<div class="qty-group">
					<div class="quantity buttons_added">
						<input type="button" value="-" class="minus minus-btn" onclick="reduceQuantity(<?=$qty_id?>,<?=$user_id?>)">
						<input type="number" step="1" name="quantity" value="<?=$product_count?>" min="1" class="input-text qty text">
						<input type="button" value="+" class="plus plus-btn" onclick="addQuantity(<?=$qty_id?>,<?=$user_id?>)">
					</div>
					<div class="cart-item-price">₹<?=$selling_price?> <span>₹<?=$product_price?></span></div>
				</div>
				
				<button type="button" class="cart-close-btn"><i class="uil uil-multiply" onclick="cart_remove(<?=$cart_id?>,<?=$user_id?>)"></i></button>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
<div class="bs-canvas-footer">
	<div class="checkout-cart">
		<a href="cart.php" class="cart-checkout-btn hover-btn">Proceed to Cart</a>
		<a href="checkout.php" class="cart-checkout-btn hover-btn">Proceed to Checkout</a>
	</div>
</div>