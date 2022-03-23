<?php
	include('../connection.php');
	$json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    $data = [];
    $array = array();
    
    $u_id = mysqli_real_escape_string($conn,$_REQUEST['u_id']);
    $name = mysqli_real_escape_string($conn,$_REQUEST['name']);
    $mobile = mysqli_real_escape_string($conn,$_REQUEST['mobile']);
    $city = mysqli_real_escape_string($conn,$_REQUEST['city']);
    $state = mysqli_real_escape_string($conn,$_REQUEST['state']);
    $houseNo = mysqli_real_escape_string($conn,$_REQUEST['houseNo']);
    $street = mysqli_real_escape_string($conn,$_REQUEST['street']);
    $pinCode = mysqli_real_escape_string($conn,$_REQUEST['pinCode']);
    $landmark = mysqli_real_escape_string($conn,$_REQUEST['landmark']);
    
    $pin_chk_query = mysqli_query($conn,"SELECT * FROM `nearest_point` WHERE `name`='$pinCode' AND `status`='Y'");
    $pin_chk_row = mysqli_num_rows($pin_chk_query);
    if($pin_chk_row != 0){
    	$update_query = mysqli_query($conn,"UPDATE `user_delivery_address` SET `selected`= 0 WHERE `user_id`='$u_id'");
    
	    $address_query = mysqli_query($conn,"INSERT INTO `user_delivery_address`(`user_id`, `name`, `mobile`, `city`, `state`, `house_no`, `street`, `pin_code`, `landmark`,`selected`) VALUES ('$u_id','$name','$mobile','$city','$state','$houseNo','$street','$pinCode','$landmark',1)");
	    
	    if($address_query == true){
	    	$address_query = mysqli_query($conn,"SELECT * FROM `user_delivery_address` WHERE `user_id`='$u_id'");
		    $row = mysqli_num_rows($address_query);
		    
		    if($row != 0){
		    	while($address_result = mysqli_fetch_assoc($address_query)){
		    		array_push($array,$address_result);
		    	}
		    }
	    	$data['status'] = true;
	    	$data['data'] = $array;
	    	$data['error'] = null;
	    }else{
	    	$data['status'] = false;
	    	$data['data'] = null;
	    	$data['error'] = "NO Data Found.";
	    }	
    }else{
    	$data['status'] = false;
    	$data['data'] = null;
    	$data['error'] = "Service not available in this pin code.";
    }
    
    echo json_encode($data);
?>