<?php
	include('../connection.php');
    
	$json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    $data = [];

	$mobile_no = mysqli_real_escape_string($conn,$obj['mobile_no']);
	$password = mysqli_real_escape_string($conn,$obj['password']);
	
	$update_query = mysqli_query($conn,"UPDATE `users` SET `password`='$password' WHERE `mobile`='$mobile_no'");
	
	if($update_query) {
		$data['status'] = true;
		$data['data'] = null;
		$data['error'] = null;
	}else{
		$data['status'] = false;
		$data['data'] = null;
		$data['error'] = null;
	}
	
	echo json_encode($data);
?>