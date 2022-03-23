<?php
	include('../connection.php');

    
    $data = [];
    $array = array();
    $qty_array = array();
    
    $p_name = mysqli_real_escape_string($conn,$_REQUEST['p_name']);
    $user_id = mysqli_real_escape_string($conn,$_REQUEST['user_id']);
    
    $product_query = mysqli_query($conn,"SELECT * FROM `product` WHERE `product_name`='$p_name' AND `status`='Y'");
    $product_row = mysqli_num_rows($product_query);
    
    if($product_row != 0){
    	while($product_result = mysqli_fetch_assoc($product_query)){
    		$qty_query = mysqli_query($conn,"SELECT * FROM `qty_per_unit` WHERE `product_id`='".$product_result['product_id']."'");
    		while($qty_result = mysqli_fetch_assoc($qty_query)){
    			$user_chk_query = mysqli_query($conn,"SELECT * FROM `add_cart` WHERE `user_id`='$user_id' AND `product_id`='".$product_result['product_id']."' AND `quantity_id`='".$qty_result['qty_id']."'");
    			
    			$user_chk_row = mysqli_num_rows($user_chk_query);
    			if($user_chk_row != 0){
    				$user_chk_result = mysqli_fetch_assoc($user_chk_query);
    				
    				$qty_result['qty_status'] = true;
    				$qty_result['count'] = $user_chk_result['count'];
    				$qty_result['cart_id'] = $user_chk_result['cart_id'];
    			}else{
    				$qty_result['qty_status'] = false;
    				$qty_result['count'] = '1';
    			}
    			
    			array_push($qty_array,$qty_result);
    		}
    		
    		$tot_review = 0;
    		
    		$review_query = mysqli_query($conn,"SELECT * FROM `ordered_product` WHERE `product_id`='".$product_result['product_id']."' AND `review`!='0'");
    		$review_count = mysqli_num_rows($review_query);
    		while($review_result = mysqli_fetch_assoc($review_query)){
    			$tot_review = $tot_review + $review_result['review'];
    		}
    		if($review_count != 0){
    			$avg_review = $tot_review / $review_count;
    		}else{
    			$avg_review = $tot_review;
    		}
    		
    		array_push($array,array('p_id'=>$product_result['product_id'],'product_name'=>$product_result['product_name'],'persentage_of'=>$product_result['persentage_of'],'main_image'=>$product_result['main_image'],'add_by'=>$product_result['vender_or_admin'],'stock_status'=>$product_result['stock_status'],'qty_details'=>$qty_array,'review'=>$avg_review,'exp_status' => $product_result['exp_status']));
    		$qty_array = [];
    	}
    	
    	$data['status'] = true;
    	$data['data'] = $array;
    	$data['base_url'] = "http://admin.e-bazaar.online/product_image/";
    	$data['error'] = null;
    }else{
    	$data['status'] = false;
    	$data['data'] = null;
    	$data['error'] = 'No Data Found.';
    }
    
    echo json_encode($data);
?>