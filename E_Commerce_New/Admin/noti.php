<?php
// include("../connection.php");
function push_notification_android($title,$message,$device_id){
		    //API URL of FCM
		    $url = 'https://fcm.googleapis.com/fcm/send';
			
		    /*api_key available in:
		    Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/    
		    $api_key ='AAAA-OwAKQM:APA91bGC97H91dvq1P349gx_DCub7NWcr9YRzUoGlUN6HcueowRYIorlZCkKaQzuS0su9i0q9pMu9vPC0P_w1bawvBXnM1S4WG3-QTt7vtAlIMAlPoTU8OQ_0Nl0ggFtfln3tMW0udL7';
		    
		    // $device_id ='dBT8joceTt29Ckac_x9ikp:APA91bESrQbGB0xCGxZQdfjOFotx9PrmgZYl0mawKxdBrdu8NI--IxaSG30J8cIKBTVVfzPNkWV5PBdOV_xtZdpVLRc67JxGIXibn1YVBdAb43ssrzbl1NgszecFfAzTtxfwQQOTss0N';
		       //$device_id = explode(',',$device_id);
		       $fields = array (
		        'registration_ids' => $device_id,
		        'notification' => array(
		        'title'=>$title,
		        'body'=> $message,
		        "vibrate"=> 1,
		        "sound"=> 1,
		        "show_in_foreground"=> true,
		        "priority"=>"high",
		        "content_available"=> true,
		        )
		       
		      
		        // 'data' => array (
		        //         "message" => $message
		        // )
		    );
			// $fields = json_encode ( $fields );
			// echo($fields);
		    //header includes Content type and api key
		    $headers = array(
		        'Content-Type:application/json',
		        'Authorization:key=AAAA-OwAKQM:APA91bGC97H91dvq1P349gx_DCub7NWcr9YRzUoGlUN6HcueowRYIorlZCkKaQzuS0su9i0q9pMu9vPC0P_w1bawvBXnM1S4WG3-QTt7vtAlIMAlPoTU8OQ_0Nl0ggFtfln3tMW0udL7'
		    );
		                
		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, $url);
		    curl_setopt($ch, CURLOPT_POST, true);
		    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		    $result = curl_exec($ch);
		    if ($result === FALSE) {
		        die('FCM Send Error: ' . curl_error($ch));
		    }
		    curl_close($ch);
		    // print_r($result);
		    return $result;
		}
		
		// $sql_user = mysqli_query($conn,"SELECT * FROM `order_list` WHERE `order_id`='$id'");
		// $row_user = mysqli_fetch_assoc($sql_user);
		// $user_id = $row_user['user_id'];

		
	  	// $array_user = [];
    //   	$sql_user_select = mysqli_query($conn,"SELECT * FROM `users` WHERE `u_id`='231'");
    //   	$num = mysqli_num_rows($sql_user_select);
    //   	while($row_fetch_user = mysqli_fetch_assoc($sql_user_select))
    //   	{
    //   			if($row_fetch_user['token']!='')
    //   			{
    //   				$array_user[] = $row_fetch_user['token'];
    //   			}
 
    //   	}
      	
      	
    //   	$title = "Order Cancel";
	   // $message = "Your Order Has Been Canceled.";
	  	// $device_id = implode(',',$array_user);
	   // $push =  push_notification_android($title,$message,$device_id);

?>