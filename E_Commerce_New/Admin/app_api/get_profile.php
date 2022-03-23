<?php
	include('../connection.php');
    
	$json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    $data = [];
    
    $u_id = mysqli_real_escape_string($conn,$_REQUEST['u_id']);
    
    $user_query = mysqli_query($conn,"SELECT * FROM `users` WHERE `u_id`='$u_id'");
    $row = mysqli_num_rows($user_query);
    
    if($row != 0){
    	$result  = mysqli_fetch_assoc($user_query);
    	
    	$data['status'] = true;
    	$data['data'] = $result;
    	$data['error'] = null;
    }else{
    	$data['status'] = false;
    	$data['data'] = null;
    	$data['error'] = "No Data Found.";
    }
    
    echo json_encode($data);
?>