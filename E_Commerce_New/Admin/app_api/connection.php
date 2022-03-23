<?php
	
    	$servername = "localhost";
        $username = "rnassociate_dooarsba";
        $password = "dooarsbarna321";
        $dbname = "rnassociate_dooarsba";
	 date_default_timezone_set('Asia/Kolkata');
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    //$conn->set_charset("utf8");
    // Check connection
    if ($conn) {
       //die("Connection failed: " . $conn->connect_error);
      // echo "success";
    }
    else{
   //  echo "error";
    }
            
?>