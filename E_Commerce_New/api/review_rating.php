<?php
include('../connection.php');
$rating_value = $_REQUEST['c'];
$user_id = $_REQUEST['id'];
$product = $_REQUEST['product'];

date_default_timezone_set('Asia/Kolkata'); 


$product_details_res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `qty_per_unit` WHERE `qty_id` = '$product'"));


$date = date('Y-m-d');

$product_check=mysqli_query($conn,"SELECT * FROM review WHERE product_id='$product' AND `user_id` = '$user_id'");
$count=mysqli_num_rows($product_check);

if($count==0){
    $insert=mysqli_query($conn,"INSERT INTO review (product_id,user_id,rating,status,date) VALUES ('$product','$user_id','$rating_value','Y','$date')");
}
else{
    $update=mysqli_query($conn,"UPDATE review SET rating='$rating_value' WHERE product_id='$product' AND `user_id` = '$user_id'");
}