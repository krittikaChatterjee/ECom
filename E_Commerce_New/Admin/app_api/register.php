<?php 
    include('../connection.php');
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    date_default_timezone_set('Asia/Kolkata');
    $date= date('Y-m-d');
    $time = date('h:i A');
    
    $data = [];
    $array = array();
    
    $name = mysqli_real_escape_string($conn,$_REQUEST['name']);
    $email = mysqli_real_escape_string($conn,$_REQUEST['email']);
    $mobile = mysqli_real_escape_string($conn,$_REQUEST['mobile']);
    $pass = mysqli_real_escape_string($conn,$_REQUEST['pass']);
    
    $chk_query = mysqli_query($conn,"SELECT * FROM `users` WHERE `email`='$email' OR `mobile`='$mobile'");
    $chk_row = mysqli_num_rows($chk_query);
    if($chk_row == 0 ){
    	$reg_query= mysqli_query($conn,"INSERT INTO `users`(`name`, `email`, `password`, `mobile`, `register_date`, `time`) VALUES ('$name','$email','$pass','$mobile','$date','$time')");
    	if($reg_query){
    		$fetch_query = mysqli_query($conn,"SELECT * FROM `users` WHERE `email`='$email' AND `mobile`='$mobile'");
    		$fetch_result = mysqli_fetch_assoc($fetch_query);
    		
    		$data['status'] = true;
	    	$data['data'] = $fetch_result;
	    	$data['error'] = null;
    	}else{
    		$data['status'] = false;
	    	$data['data'] = null;
	    	$data['error'] = "Something Went Wrong !!! Please try again.";
    	}
    }else{
    	$data['status'] = false;
    	$data['data'] = null;
    	$data['error'] = "Email Id or Mobile No already registered !!!";
    }
    
    echo json_encode($data);
?>