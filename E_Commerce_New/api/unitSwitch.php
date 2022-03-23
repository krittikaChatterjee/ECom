<?php
include('../connection.php');
$id = $_POST['id'];
$user_id = $_POST['user_id'];

$qty_res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `qty_per_unit` WHERE `qty_id` = '$id'"));

$qty_id  = $qty_res['qty_id'];
$sell_price = $qty_res['discount_price'];
$product_price = $qty_res['product_price'];

$product_id = $qty_res['product_id'];
$product_res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `product` WHERE `product_id` = '$product_id'"));

$tax = $product_res['persentage_of'];
$total_price = ($sell_price+(($sell_price*$tax)/100));


?>







<li><div class="main-price color-discount">Selling Price<span id="itemPrice">&#8377;<?=$total_price?></span></div></li>
<li><div class="main-price mrp-price">MRP Price<span id="marketPrice">&#8377;<?=$product_price?></span></div></li>
<li><span class="like-icon save-icon" title="wishlist" onclick="wishlist(<?=$qty_id?>,<?=$user_id?>)"></span></li>
<button type="button" class="btn btn-primary" style="background-color:#F55D2C;border:none;" onclick="addcart(<?=$qty_id?>,<?=$user_id?>)">Add to Cart</button>