<?php
include('../connection.php');
$user_id = $_POST['user_id'];
$cart_count=mysqli_query($conn,"SELECT * FROM add_cart WHERE user_id='$user_id'");
$cart_rows=mysqli_num_rows($cart_count);
?>
<a href="#" class="cart__btn hover-btn pull-bs-canvas-left" title="Cart"><i class="uil uil-shopping-cart-alt"></i><span>Cart</span><ins><?=$cart_rows?></ins><i class="uil uil-angle-down"></i></a>