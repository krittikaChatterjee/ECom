<?php 
include('header.php');
?>
<div class="wrapper">
	<!--<div class="gambo-Breadcrumb">-->
	<!--	<div class="container">-->
	<!--		<div class="row">-->
	<!--			<div class="col-md-12">-->
	<!--				<nav aria-label="breadcrumb">-->
	<!--					<ol class="breadcrumb">-->
	<!--						<li class="breadcrumb-item"><a href="index.php">Home</a></li>-->
	<!--						<li class="breadcrumb-item active" aria-current="page">My Cart</li>-->
	<!--					</ol>-->
	<!--				</nav>-->
	<!--			</div>-->
	<!--		</div>-->
	<!--	</div>-->
	<!--</div>-->
    <div class="container border mt-5">
        <div class="row">
            <div class="col-sm-12 col-12 col-md-12 col-md-offset-1" id="cart">
            <table class="table table-responsive mt-5 table-hover">
                <thead>
                    <?php
                    $empty_check=mysqli_query($conn,"SELECT * FROM add_cart WHERE user_id='$user_id'");
                    $empty_rows=mysqli_num_rows($empty_check);
                    if($empty_rows>0){
                    ?>
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th> </th>
                    </tr>
                    <?php } else { ?>
                        <h1 class="text-center">Your Cart Is Empty</h1>
                    <?php } ?>
                </thead>
                <tbody>
                    <?php
                    $cart=mysqli_query($conn,"SELECT * FROM add_cart WHERE user_id='$user_id'");
                    $cart_rows=mysqli_num_rows($cart);
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
                    <tr>
                        <td class="col-sm-5 col-5col-2  col-md-5">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> <img class="media-object mr-3" src="Admin/product_image/<?=$product_fetch['main_image']?>" height="75" width="75"> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#"><?=$product_fetch['product_name']?></h4>
                                <h7><?=$quantity_per_unit_fetch['qtu_per_unit']?> <?=$quantity_per_unit_fetch['unit']?></h7>
                            </div>
                        </div></td>
                        <td class="col-sm-1 col-1 col-md-1" style="text-align: center">
                       	    <div class="quantity buttons_added">
                       	        <button type="button" class="minus minus-btn" style="background-color:#F55D2C;border:none;" onclick="reduceQuantity(<?=$qty_id?>,<?=$user_id?>)"> - </button>
                       	        <input type="number" name="quantity" value="<?=$product_count?>" class="input-text qty text" readonly>
                       	        <button type="button" class="plus plus-btn" style="background-color:#F55D2C;border:none;" onclick="addQuantity(<?=$qty_id?>,<?=$user_id?>)"> + </button>
							</div>
                        </td>
                        <td class="col-sm-2 col-2 col-md-2 pl-0 pr-0 text-center"><strong>&#8377;<?=$selling_price?></strong></td>
                        <td class="col-sm-2 col-2 col-md-2 pl-0 pr-0 text-center"><strong>&#8377;<?=$product_total?></strong></td>
                        <td class="col-sm-2 col-2 col-md-2">
                            <button type="button" class="btn btn-danger" onclick="cart_remove(<?=$cart_id?>,<?=$user_id?>)" style="background-color:#F55D2C;border:none;">
                                <span class="glyphicon glyphicon-remove"></span>Remove
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                    
                    <?php if($cart_rows>0) { ?>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h6>Subtotal</h6></td>
                        <td class="text-right pl-0 pr-0" id="subtotal"><h4>&#8377;<?=$sub_total?></h4></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h6>Delivery Charge</h6></td>
                        <td class="text-right pl-0 pr-0" id="delivery"><h4>&#8377;<?=$charge_amount?></h4></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h6>Total</h6></td>
                        <td class="text-right pl-0 pr-0" id="total"><h4>&#8377;<?=$grand_total?></h4></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td></td>
                        <td>
                         <a href="checkout.php"><button type="button" class="btn btn-success" style="background-color:#F55D2C;border:none;">Checkout<span class="glyphicon glyphicon-play"></span>
                        </button></a>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>