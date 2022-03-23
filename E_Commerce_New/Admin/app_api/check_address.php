<?php
	include('../connection.php');
	$json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    $data = [];
    $array = array();
    
    $u_id = mysqli_real_escape_string($conn,$_REQUEST['u_id']);
    
    $address_query = mysqli_query($conn,"SELECT * FROM `user_delivery_address` WHERE `user_id`='$u_id'");
    $row = mysqli_num_rows($address_query);
    
    if($row != 0){
    
    	$data['status'] = true;
    	$data['data'] = $array;
    	$data['error'] = null;
    }else{
    	$data['status'] = false;
    	$data['data'] = null;
    	$data['error'] = "No Data Found";
    }
    
    echo json_encode($data);
?>