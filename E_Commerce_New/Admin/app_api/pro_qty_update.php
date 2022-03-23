<?php
	include('../connection.php');
	
	date_default_timezone_set('Asia/Kolkata');
    $date= date('Y-m-d');
    $time = date('h:i A');
    
	$json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    $data = [];
    $array = array();
    
    $user_id = mysqli_real_escape_string($conn,$obj['user_id']);
    $product_id = mysqli_real_escape_string($conn,$obj['product_id']);
    $qty_id = mysqli_real_escape_string($conn,$obj['qty_id']);
    $count = mysqli_real_escape_string($conn,$obj['count']);
    
    $update_cart = mysqli_query($conn,"UPDATE `add_cart` SET `count`='$count' WHERE `user_id`='$user_id' AND `product_id`='$product_id' AND `quantity_id`='$qty_id'");
    if($update_cart){
    	$data['status'] = true;
    }else{
    	$data['status'] = false;
    }
    
    
    echo json_encode($data);
?>