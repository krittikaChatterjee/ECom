<?php
	include('../connection.php');
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

	$data = [];
	$array = array();
	
	$u_id = mysqli_real_escape_string($conn,$obj['u_id']);
	$inv_no = mysqli_real_escape_string($conn,$obj['inv_no']);
	
	$cancle_query = mysqli_query($conn,"UPDATE `order_list` SET `received_status`='Y' WHERE `invoice_no`='$inv_no'");
	
	if($cancle_query == true){
		$fetch_query = mysqli_query($conn,"SELECT * FROM `order_list` WHERE `user_id`='$u_id' ORDER BY `order_id` DESC");
		while($fetch_result = mysqli_fetch_assoc($fetch_query)){
			array_push($array,$fetch_result);
		}
		
		$data['status'] = true;
		$data['data'] = $array;
		$data['error'] - null;
	}else{
		$data['status'] = false;
		$data['data'] = null;
		$data['error'] = "Something went wrong !!! Please try again.";
	}
	
	echo json_encode($data);
?>