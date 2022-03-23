<?php
	include('../connection.php');
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    $data = [];
    $array = array();
    
    $u_id = mysqli_real_escape_string($conn,$_REQUEST['u_id']);
    
    $booking_query = mysqli_query($conn,"SELECT * FROM `order_list` WHERE `user_id`='$u_id' ORDER BY `order_id` DESC");
    $row = mysqli_num_rows($booking_query);
    
    if($row != 0){
    	while($booking_result = mysqli_fetch_assoc($booking_query)){
    		array_push($array,$booking_result);
    	}
    	
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