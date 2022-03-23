<?php
	include('../connection.php');
	
	date_default_timezone_set('Asia/Kolkata');
    $date= date('Y-m-d');
    $time = date('h:i A');
    
	$json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    $data = [];
    
    $address_id = mysqli_real_escape_string($conn,$_REQUEST['address_id']);
  
	$delete_query = mysqli_query($conn,"DELETE FROM `user_delivery_address` WHERE `da_id`='$address_id'");
	if($delete_query){
		$data['status'] = true;
		$data['data'] = null;
		$data['error'] = "Address Deleted.";
	}else{
		$data['status'] = false;
		$data['data'] = null;
		$data['error'] = "Something went wrong!! Please try again.";
	}
	
	echo json_encode($data);
?>