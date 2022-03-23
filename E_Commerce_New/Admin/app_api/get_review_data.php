<?php
	include('../connection.php');
    
	$json = file_get_contents('php://input');
    $obj = json_decode($json,true);
	
	$data = [];
	$array = array();
	
	$u_id = mysqli_real_escape_string($conn,$obj['u_id']);
	
	$inv_query = mysqli_query($conn,"SELECT `invoice_no` FROM `order_list` WHERE `user_id`='$u_id' AND `status`='DELIVERED'");
	$row = mysqli_num_rows($inv_query);
	
	if($row != 0){
		while($inv_result = mysqli_fetch_assoc($inv_query)){
			$product_query = mysqli_query($conn,"SELECT * FROM `ordered_product` WHERE `invoice_no`='".$inv_result['invoice_no']."'");
			while($product_result = mysqli_fetch_assoc($product_query)){
				array_push($array,$product_result);
			}
		}
		$data['status'] = true;
    	$data['data'] = $array;
    	$data['base_url'] = "http://admin.e-bazaar.online/product_image/";
    	$data['error'] = null;
	}else{
		$data['status'] = false;
    	$data['data'] = null;
    	$data['error'] = "No Data Found.";
	}
	
	echo json_encode($data);
?>
