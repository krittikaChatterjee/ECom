<?php
include("../connection.php");
include('../noti.php');
$id=$_REQUEST['id'];
$user_id = $_REQUEST['user_id'];


	$sql_updateY=mysqli_query($conn,"UPDATE order_list SET status='CANCELLED' WHERE order_id='$id'");
	if($sql_updateY){
		$var['status']='in';
		
		$user_query = mysqli_query($conn,"SELECT `token` FROM `users` WHERE `u_id`='$user_id'");
	    $user_result = mysqli_fetch_assoc($user_query);
	    
	    $title = "Order Cancelled";
		$message = "Your Order Has Been Cancelled. Team E-Bazaar. #staysafe #stayhome";
		$device_id = array($user_result['token']);
		
	    $push = push_notification_android($title,$message,$device_id);
	}

echo json_encode($var);
?>