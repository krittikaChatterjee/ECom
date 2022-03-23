<?php
	include('../connection.php');
    
	$json = file_get_contents('php://input');
    $obj = json_decode($json,true);

	$ph_no = mysqli_real_escape_string($conn,$obj['ph_no']);
	
	$chk_query = mysqli_query($conn,"SELECT * FROM `users` WHERE `mobile`='$ph_no'");
	$chk_row = mysqli_num_rows($chk_query);
	
	if($chk_row != 0){
		$otp = rand(000000,999999);
		
		$mobile = $ph_no;
        $msg = "Your Forgot Password OTP is : ".$otp.".";
    /*mobile sms get way*/
        $num="91".$mobile;

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
		$data['otp'] = $otp;
		$data['error'] = $response;
	}else{
		$data['status'] = false;
		$data['otp'] = null;
		$data['error'] = "This is not a registered Mobile No.";
	}
	
	echo json_encode($data);
?>