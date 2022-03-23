<?php
	include('../connection.php');
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    date_default_timezone_set('Asia/Kolkata');
    $date= date('Y-m-d');
    $time = date('h:i A');
    
    $tomorrow = date('m/d/Y',strtotime($date . "+1 days"));
    
    $data = [];
    $array = array();
    
    $u_id = mysqli_real_escape_string($conn,$_REQUEST['u_id']);
    $coupon = mysqli_real_escape_string($conn,$_REQUEST['coupon']);
    $total = mysqli_real_escape_string($conn,$_REQUEST['total']);
    $delivery_charges = mysqli_real_escape_string($conn,$_REQUEST['delivery_charges']);
     $payment_type = mysqli_real_escape_string($conn,$_REQUEST['payment_type']);
      $payment_status = mysqli_real_escape_string($conn,$_REQUEST['payment_status']);
      $address_id = mysqli_real_escape_string($conn,$_REQUEST['address_id']);
    
    
   // $delivery_time = mysqli_real_escape_string($conn,$obj['delivery_time']);
   
   // $exp_status = mysqli_real_escape_string($conn,$obj['exp_status']);
   
   if($coupon !=""){
      
          $sql_upd = "INSERT INTO check_cupon (user_id, coupon, date)
              VALUES ('$u_id', '$coupon', '$date')";
       $conn->query($sql_upd);
   }
   
   $sql2 = "SELECT * FROM user_delivery_address WHERE da_id='$address_id' AND selected='1'";
	$result2 = $conn->query($sql2);
	$row2 = $result2->fetch_assoc();
	
	$name = $row2['name'];
    $house_address = $row2['house_no'];
    $street_address = $row2['street'];
    $city = $row2['city'];
    $state = $row2['state'];
    $pin = $row2['pin_code'];
    $phno = $row2['mobile'];
    $landmark = $row2['landmark'];
   
	
    
    $chk_invoice_query = mysqli_query($conn,"SELECT * FROM `order_list`");
    $chk_invoice_row = mysqli_num_rows($chk_invoice_query);
    
    $invoice_no = 'AH'.time();
    
    $insert_booking_query = mysqli_query($conn,"INSERT INTO `order_list`(`user_id`, `invoice_no`, `total`, `delivery_charges`, `status`, `name`, `house_address`, `street_address`, `city`, `state`, `pin`, `landmark`, `phno`, `date`, `payment_type`, `payment_status`,`order_time`,`delivery_time`) VALUES ('$u_id','$invoice_no','$total','$delivery_charges','PLACED','$name','$house_address','$street_address','$city','$state','$pin','$landmark','$phno','$date','$payment_type','$payment_status','$time','')");
    if($insert_booking_query){
    	$chk_cart_query = mysqli_query($conn,"SELECT * FROM `add_cart` WHERE `user_id`='$u_id'");
    	while($chk_cart_result = mysqli_fetch_assoc($chk_cart_query)){
    		$product_query = mysqli_query($conn,"SELECT `product_name`,`main_image` FROM `product` WHERE `product_id`='".$chk_cart_result['product_id']."'");
    		$product_result = mysqli_fetch_assoc($product_query);
    		
    		$qty_query = mysqli_query($conn,"SELECT * FROM `qty_per_unit` WHERE `qty_id`='".$chk_cart_result['quantity_id']."'");
    		$qty_result = mysqli_fetch_assoc($qty_query);
    		$quentity = $qty_result['qtu_per_unit'].' '.$qty_result['unit'];
    		
    		$insert_product_query = mysqli_query($conn,"INSERT INTO `ordered_product`(`invoice_no`, `product_id`, `product_name`, `product_quntity`, `product_count`, `product_price`,`product_imge`,`qty_id`,`add_by`) VALUES
    		('$invoice_no','".$chk_cart_result['product_id']."','".$product_result['product_name']."','$quentity','".$chk_cart_result['count']."','".$chk_cart_result['total_amount']."','".$product_result['main_image']."','".$chk_cart_result['quantity_id']."','".$chk_cart_result['add_by']."')");
    		
    		$sql = "SELECT number_of_product FROM qty_per_unit WHERE qty_id='".$chk_cart_result['quantity_id']."'";
			$result = $conn->query($sql);
		    $row = $result->fetch_assoc();
		    $qnt=$row['number_of_product'];
		    $new_qnt= $qnt - $chk_cart_result['count'];
		    if($new_qnt == 0){
		    		$sql3 = "UPDATE qty_per_unit SET number_of_product='$new_qnt',status='N' WHERE qty_id='".$chk_cart_result['quantity_id']."'";
                $conn->query($sql3);
		    
		    		    }else{
		    	$sql3 = "UPDATE qty_per_unit SET number_of_product='$new_qnt' WHERE qty_id='".$chk_cart_result['quantity_id']."'";
                $conn->query($sql3);
		    	
		    }
			
    	}
    	
    	$delete_cart_query = mysqli_query($conn,"DELETE FROM `add_cart` WHERE `user_id`='$u_id'");
    	
/*    	$mobile = $phno;
        $msg = "Dear ".$name.",
Thank you for choosing us. It will be delivered as per our policy.
Happy Shopping!

Team e-bazaar";*/
    /*mobile sms get way*/
        //$num="91".$mobile;
        // $msg="Your Forget Password OTP is ".$password."";

       /* $apiKey = urlencode('SYiMQ0JupCM-bAk5wjVtpXQM4TVAuTkhdZp3rucu56');
        $numbers = array($num);
        $sender = urlencode('ebazar');
        $message = rawurlencode($msg);
        $numbers = implode(',', $numbers);
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        */
       /* if($exp_status == 'Y'){
        	$msg = "You have a express booking. Kindly check your admin panel.";*/
    /*mobile sms get way*/
        // $msg="Your Forget Password OTP is ".$password."";

	        /*$apiKey = urlencode('SYiMQ0JupCM-bAk5wjVtpXQM4TVAuTkhdZp3rucu56');
	        $numbers = array('919830894820','917003659281');
	        $sender = urlencode('ebazar');
	        $message = rawurlencode($msg);
	        $numbers = implode(',', $numbers);
	        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
	        $ch = curl_init('https://api.textlocal.in/send/');
	        curl_setopt($ch, CURLOPT_POST, true);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        $response = curl_exec($ch);
	        curl_close($ch);*/
       // }
    	
    	$data['status'] = true;
    	$data['data'] = null;
    	$data['error'] = null;
    }else{
    	$data['status'] = false;
    	$data['data'] = null;
    	$data['error'] = "Something went wrong !!! Please try again.";
    }
	
    echo json_encode($data);
?>