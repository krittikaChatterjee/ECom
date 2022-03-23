<?php
    include("../connection.php");
	include('../noti.php');
	
    $id = $_REQUEST['id'];
    $order_status = $_REQUEST['order_status'];
    $user_id = $_REQUEST['user_id'];
    
    $up_ststus = "UPDATE `order_list` SET`status`='$order_status' WHERE `invoice_no`='$id'";
    $up_ststus_read = mysqli_query($conn,$up_ststus);
    
    $user_query = mysqli_query($conn,"SELECT `token` FROM `users` WHERE `u_id`='$user_id'");
    $user_result = mysqli_fetch_assoc($user_query);
    
    if($order_status =='PACKED'){
    	$title = "Order Packed";
		$message = "Your order is packed. We will notify you once it’s dispatched. Team E-Bazaar. #staysafe #stayhome";
    }else if($order_status =='DISPATCHED'){
    	$title = "Order Dispatched";
		$message = "Your order is on its way. Please co-operate for a NO-CONTACT DELIVERY. Team E-Bazaar. #staysafe #stayhome";
    }else if($order_status == 'DELIVERED'){
    	$title = "Order Delivered";
		$message = "Your order has been successfully delivered. Thank you for choosing E-Bazaar. Always at your service. #staysafe #stayhome";
    }
    
	$device_id = array($user_result['token']);
	
    $push = push_notification_android($title,$message,$device_id);
?>