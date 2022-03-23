<?php
	include('../connection.php');
	$json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    $data = [];
    
    $u_id = mysqli_real_escape_string($conn,$obj['u_id']);
    $p_name = mysqli_real_escape_string($conn,$obj['p_name']);
    $qty = mysqli_real_escape_string($conn,$obj['qty']);
    
	$insert_query = mysqli_query($conn,"INSERT INTO `product_suggest`(`p_name`, `quentity`, `u_id`) VALUES ('$p_name','$qty','$u_id')");
	
	if($insert_query){
		$data['status'] = true;
		$data['data'] = null;
		$data['error'] = "Submited Successfully.";
	}else{
		$data['status'] = false;
		$data['data'] = null;
		$data['error'] = "Something went wrong!! Please try again.";
	}
	
	echo json_encode($data);
?>
