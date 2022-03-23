<?php
	include('../connection.php');
	$json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    $data = [];
    $array = array();
    $qty_array = array();
    
    $search_txt = mysqli_real_escape_string($conn,$obj['search_txt']);
    $user_id = mysqli_real_escape_string($conn,$obj['user_id']);
    
    $product_query = mysqli_query($conn,"SELECT * FROM `product` WHERE `product_name` LIKE '%".$search_txt."%' AND `status`='Y'");
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
    			}else{
    				$qty_result['qty_status'] = false;
    				$qty_result['count'] = '1';
    			}
    			array_push($qty_array,$qty_result);
    		}
    		array_push($array,array('p_id'=>$product_result['product_id'],'product_name'=>$product_result['product_name'],'main_image'=>$product_result['main_image'],'stock_status'=>$product_result['stock_status'],'qty_details'=>$qty_array));
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