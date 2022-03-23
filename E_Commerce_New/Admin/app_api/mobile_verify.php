<?php 
    include('../connection.php');
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    date_default_timezone_set('Asia/Kolkata');
    $date= date('Y-m-d');
    $time = date('h:i A');
    
    $data = [];
    $array = array();
    
    $name = mysqli_real_escape_string($conn,$obj['name']);
    $email = mysqli_real_escape_string($conn,$obj['email']);
    $mobile = mysqli_real_escape_string($conn,$obj['mobile']);
    $pass = mysqli_real_escape_string($conn,$obj['pass']);
    
    $chk_query = mysqli_query($conn,"SELECT * FROM `users` WHERE `email`='$email' OR `mobile`='$mobile'");
    $chk_row = mysqli_num_rows($chk_query);
    if($chk_row == 0 ){
    	$otp = rand(0000,9999);
    	
    	$mobile = $mobile;
        $msg = "Your Registration OTP is : ".$otp."

Team e-bazaar";
    /*mobile sms get way*/
        $num="91".$mobile;
        // $msg="Your Forget Password OTP is ".$password."";

        $apiKey = urlencode('SYiMQ0JupCM-bAk5wjVtpXQM4TVAuTkhdZp3rucu56');
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
        
		$data['status'] = true;
    	$data['data'] = $otp;
    	$data['error'] = null;
    }else{
    	$data['status'] = false;
    	$data['data'] = null;
    	$data['error'] = "Email Id or Mobile No already registered !!!";
    }
    
    echo json_encode($data);
?>