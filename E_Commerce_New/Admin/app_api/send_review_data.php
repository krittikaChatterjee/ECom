<?php
	include('../connection.php');
    
	$json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    $data = [];
    
    $invoice_no = mysqli_real_escape_string($conn,$obj['invoice_no']);
    $product_id = mysqli_real_escape_string($conn,$obj['product_id']);
    $feedback = mysqli_real_escape_string($conn,$obj['feedback']);
    $review = mysqli_real_escape_string($conn,$obj['review']);
    
    $review_query = mysqli_query($conn,"UPDATE `ordered_product` SET `review`='$review',`review_txt`='$feedback' WHERE `invoice_no`='$invoice_no' AND `product_id`='$product_id'");
    if($review_query){
    	$data['status'] = true;
    	$data['data'] = null;
    	$data['error'] = null;
    }else{
    	$data['status'] = false;
    	$data['data'] = null;
    	$data['error'] = "No Data Found.";
    }
    
    echo json_encode($data);
?>