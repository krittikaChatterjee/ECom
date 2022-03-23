<?php
	include('../connection.php');
	
	date_default_timezone_set('Asia/Kolkata');
    $date= date('Y-m-d');
    $time = date('h:i:s');
    
	$json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    $data = [];
    $array = array();
    
    $user_id = mysqli_real_escape_string($conn,$_REQUEST['user_id']);
    $product_id = mysqli_real_escape_string($conn,$_REQUEST['product_id']);
    $qty_id = mysqli_real_escape_string($conn,$_REQUEST['qty_id']);
    $price = mysqli_real_escape_string($conn,$_REQUEST['price']);
    $discount_price = mysqli_real_escape_string($conn,$_REQUEST['discount_price']);
    $add_by = mysqli_real_escape_string($conn,$_REQUEST['add_by']);
    
    $check_cart_query = mysqli_query($conn,"SELECT * FROM `add_cart` WHERE `user_id`='$user_id' AND `product_id`='$product_id' AND `quantity_id`='$qty_id'");
    $chk_row = mysqli_num_rows($check_cart_query);
    if($chk_row == 0){
    
    	$add_cart_query = mysqli_query($conn,"INSERT INTO `add_cart`(`user_id`, `product_id`, `quantity_id`, `date`, `time`, `count`, `selling_price`, `total_amount`, `total`, `add_by`,`buy_status`) VALUES ('$user_id','$product_id','$qty_id','$date','$time','1','$price','$discount_price','$discount_price','$add_by','')");
    
	    if($add_cart_query == true){
	    	$data['status'] = true;
	    	$data['data'] = null;
	    	$data['error'] = null;
	    }else{
	    	$data['status'] = false;
	    	$data['data'] = null;
	    	$data['error'] = "Something went wrong !!! Please try again.";
	    }
    }else{
    	$data['status'] = false;
    	$data['data'] = null;
    	$data['error'] = "This Product is Already in Cart.";
    }
   
    
    echo json_encode($data);
?>