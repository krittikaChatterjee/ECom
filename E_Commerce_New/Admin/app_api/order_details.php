<?php
	include('../connection.php');
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

	$data = [];
	$array = array();
	
	$inv_no = mysqli_real_escape_string($conn,$_REQUEST['inv_no']);
	
	$order_query = mysqli_query($conn,"SELECT * FROM `ordered_product` WHERE `invoice_no`='$inv_no'");
	
	$row = mysqli_num_rows($order_query);
	if($row != 0){
		while($order_result = mysqli_fetch_assoc($order_query)){
			array_push($array,$order_result);
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