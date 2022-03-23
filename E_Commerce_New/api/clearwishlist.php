<?php
include('../connection.php');
$qty_id=$_REQUEST['qty_id'];
$user_id=$_REQUEST['user_id'];

$remove=mysqli_query($conn,"DELETE FROM add_wishlist WHERE product_id='$qty_id' AND user_id='$user_id'");
?>