<?php
	include('../connection.php');
    
	$json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    $data = [];
    
    $u_id = mysqli_real_escape_string($conn,$obj['user_id']);
    $token = mysqli_real_escape_string($conn,$obj['token']);
    
    $query = mysqli_query($conn,"UPDATE `users` SET `token`='$token' WHERE `u_id`='$u_id'");
    
    if($query){
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