<?php
include('../connection.php');
$qty_id = $_POST['qty_id'];
$user_id = $_POST['user_id'];

$user_cart = mysqli_query($conn,"SELECT * FROM add_cart WHERE user_id='$user_id' AND qty_id='$qty_id'");
$product_exists = mysqli_num_rows($user_cart);
$user_fetch = mysqli_fetch_assoc($user_cart);
$count = $user_fetch['count'];

if($product_exists==0){
    $insert_cart = mysqli_query($conn,"INSERT INTO add_cart (`user_id`,`qty_id`,`count`) VALUES ('$user_id','$qty_id','1')");
}
else{
    $new_count = $count + 1;
    $update_cart = mysqli_query($conn,"UPDATE add_cart SET `count`='$new_count' WHERE user_id='$user_id' AND qty_id='$qty_id'");
}