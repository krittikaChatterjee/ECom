<?php
	include('../connection.php');
	$json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    $data = [];
    
    $user_id = mysqli_real_escape_string($conn,$_REQUEST['user_id']);
    $product_id = mysqli_real_escape_string($conn,$_REQUEST['c_id']);
   
    
    $delete_query = mysqli_query($conn,"DELETE FROM `add_cart` WHERE `user_id`='$user_id' AND `cart_id`='$product_id'");
    
    if($delete_query){
    	$data['status'] = true;
    	$data['data'] = null;
    	$data['error'] = null;
    }else{
    	$data['status'] = false;
    	$data['data'] = null;
    	$data['error'] = "Something went wrong !!! Please try again.";
    }
    
    echo json_encode($data);
?>