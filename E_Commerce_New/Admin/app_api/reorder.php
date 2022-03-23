<?php
	include('../connection.php');
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    date_default_timezone_set('Asia/Kolkata');
    $date= date('Y-m-d');
    $time = date('h:i A');
    
    $data = [];
    $array = array();
    
    $inv_id = mysqli_real_escape_string($conn,$obj['inv_no']);
    
    $chk_invoice_query = mysqli_query($conn,"SELECT * FROM `order_list`");
    $chk_invoice_row = mysqli_num_rows($chk_invoice_query);
    
    $invoice_no = 'EB'.date('Y').str_pad($chk_invoice_row,3,0,STR_PAD_LEFT);
    
    $order_fetch_query = mysqli_query($conn,"SELECT * FROM `order_list` WHERE `invoice_no`='$inv_id'");
	$order_fetch_result = mysqli_fetch_assoc($order_fetch_query);
    	
    $order_insert_query = mysqli_query($conn,"INSERT INTO `order_list`(`user_id`, `invoice_no`, `total`, `delivery_charges`, `status`, `name`, `house_address`, `street_address`, `city`, `state`, `pin`, `landmark`, `phno`, `date`, `payment_type`, `payment_status`, `delivery_time`,`order_time`) VALUES ('".$order_fetch_result['user_id']."','$invoice_no','".$order_fetch_result['total']."','".$order_fetch_result['delivery_charges']."','PLACED','".$order_fetch_result['name']."','".$order_fetch_result['house_address']."','".$order_fetch_result['street_address']."','".$order_fetch_result['city']."','".$order_fetch_result['state']."','".$order_fetch_result['pin']."','".$order_fetch_result['landmark']."','".$order_fetch_result['phno']."','$date','Cash','Due','$date','$time')");
    
    if($order_insert_query){
    	$product_fetch_query = mysqli_query($conn,"SELECT * FROM `ordered_product` WHERE `invoice_no`='$inv_id'");
    	while($product_fetch_result = mysqli_fetch_assoc($product_fetch_query)){
    		$product_insert_query = mysqli_query($conn,"INSERT INTO `ordered_product`(`invoice_no`, `product_id`, `product_name`, `product_quntity`, `product_count`, `product_price`,`product_imge`,`qty_id`) VALUES ('$invoice_no','".$product_fetch_result['product_id']."','".$product_fetch_result['product_name']."','".$product_fetch_result['product_quntity']."','".$product_fetch_result['product_count']."','".$product_fetch_result['product_price']."','".$product_fetch_result['product_imge']."','".$product_fetch_result['qty_id']."')");
    	}
    	
    	$order_query = mysqli_query($conn,"SELECT * FROM `order_list` WHERE `user_id`='".$order_fetch_result['user_id']."' ORDER BY `order_id` DESC");
    	while($order_result = mysqli_fetch_assoc($order_query)){
    		array_push($array,$order_result);
    	}
    	
    	$data['status'] = true;
    	$data['data'] = $array;
    	$data['error'] = null;
    	
    }else{
    	$data['status'] = true;
    	$data['data'] = null;
    	$data['error'] = "Something went wrong !! Please try again.";
    }
    
    echo json_encode($data);
?>