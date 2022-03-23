<?php
include('../connection.php');
$cart_id = $_POST['cart_id'];

$cart_delete = mysqli_query($conn,"DELETE FROM add_cart WHERE cart_id='$cart_id'");
?>