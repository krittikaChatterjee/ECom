<?php
	include('../connection.php');
/*	$json = file_get_contents('php://input');
    $obj = json_decode($json,true);*/
    
	$data = [];
	$array = array();
	
	$u_id = mysqli_real_escape_string($conn,$_REQUEST['u_id']);
	
	$sql = "SELECT SUM(total) AS total FROM `add_cart` WHERE `user_id`='$u_id'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
	 $row = $result->fetch_assoc();
	 $total=$row['total'];
	} else {
	 $total=0;
	}
	
	
	
	
	
	$cart_query = mysqli_query($conn,"SELECT * FROM `add_cart` WHERE `user_id`='$u_id'");
	$row = mysqli_num_rows($cart_query);
	
	if($row != 0){
		while($cart_result = mysqli_fetch_assoc($cart_query)){
			$product_query = mysqli_query($conn,"SELECT * FROM `product` WHERE `product_id`='".$cart_result['product_id']."'");
			$product_result = mysqli_fetch_assoc($product_query);
			
			$qty_query = mysqli_query($conn,"SELECT * FROM `qty_per_unit` WHERE `qty_id`='".$cart_result['quantity_id']."'");
			$qty_result = mysqli_fetch_assoc($qty_query);
			
			array_push($array,array('cart_id'=>$cart_result['cart_id'],'p_id'=>$cart_result['product_id'],'qty_id'=>$cart_result['quantity_id'],'product_name'=>$product_result['product_name'],'main_image'=>$product_result['main_image'],'qtu_per_unit'=>$qty_result['qtu_per_unit'],'unit'=>$qty_result['unit'],'u_id'=>$u_id,'price'=>$cart_result['selling_price'],'discount_price'=>$cart_result['total_amount'],'count'=>$cart_result['count'],'exp_status'=>$product_result['exp_status'],'p_stock'=>$qty_result['status'],'total'=>$total));
		}
		
		$data['status'] = true;
		$data['data'] = $array;
		$data['base_url'] = "http://admin.e-bazaar.online/product_image/";
		$data['error'] = null;
	}else{
		$data['status'] = false;
		$data['data'] = null;
		$data['error'] = "Your Cart is Empty.";
	}
	
	echo json_encode($data);
	
?>