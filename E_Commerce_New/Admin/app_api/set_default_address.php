<?php
	include('../connection.php');
    
	$json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    $data = [];
    $array = array();

	$u_id = mysqli_real_escape_string($conn,$_REQUEST['u_id']);
	$address_id = mysqli_real_escape_string($conn,$_REQUEST['address_id']);
	
	$update_query = mysqli_query($conn,"UPDATE `user_delivery_address` SET `selected`= 0 WHERE `user_id`='$u_id'");
	
	if($update_query){
		$final_update_query = mysqli_query($conn,"UPDATE `user_delivery_address` SET `selected`= 1 WHERE `da_id`='$address_id'");
		
		$address_query = mysqli_query($conn,"SELECT * FROM `user_delivery_address` WHERE `user_id`='$u_id'");
		while($address_result = mysqli_fetch_assoc($address_query)){
			array_push($array,$address_result);
		}
		
		if($final_update_query){
			$data['status'] = true;
			$data['data'] = $array;
			$data['error'] = null;
		}else{
			$data['status'] = false;
			$data['data'] = null;
			$data['error'] = "Something went wrong";
		}
	}else{
		$data['status'] = false;
		$data['data'] = null;
		$data['error'] = "Something went wrong";
	}
	
	echo json_encode($data);

?>