<?php
include('../connection.php');
$qty_id = $_POST['qty_id'];
$user_id = $_POST['user_id'];

$user_cart = mysqli_query($conn,"SELECT * FROM add_cart WHERE user_id='$user_id' AND qty_id='$qty_id'");
$user_fetch = mysqli_fetch_assoc($user_cart);
$count = $user_fetch['count'];

if($count==1){
    $new_count = 1;
}
else{
    $new_count = $count - 1;
}
$update_cart = mysqli_query($conn,"UPDATE add_cart SET `count`='$new_count' WHERE user_id='$user_id' AND qty_id='$qty_id'");