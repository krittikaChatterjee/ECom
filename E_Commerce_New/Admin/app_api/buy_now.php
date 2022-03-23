<?php
	include('../connection.php');
	
	date_default_timezone_set('Asia/Kolkata');
    $date= date('Y-m-d');
    $time = date('h:i A');
    
	$json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    $data = [];
    $array = array();
    
    $user_id = mysqli_real_escape_string($conn,$_REQUEST['user_id']);
    $product_id = mysqli_real_escape_string($conn,$_REQUEST['product_id']);
    $qty_id = mysqli_real_escape_string($conn,$_REQUEST['qty_id']);
    $price = mysqli_real_escape_string($conn,$_REQUEST['price']);
    $discount_price = mysqli_real_escape_string($conn,$_REQUEST['discount_price']);
    
 
    	$add_cart_query = mysqli_query($conn,"INSERT INTO `add_cart`(`user_id`, `product_id`, `quantity_id`, `date`, `time`, `selling_price`, `total_amount`,`total`,`buy_status`,`count`) VALUES ('$user_id','$product_id','$qty_id','$date','$time','$price','$discount_price','$discount_price','Y','1')");
    
	    if($add_cart_query == true){
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