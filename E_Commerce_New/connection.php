<?php
 
        	$servername = "localhost";
            $username = "ecommerce_new";
            $password = "ecommerce_new";
            $dbname = "ecommerce_new";
// 			date_default_timezone_set('Asia/Kolkata');
            // Create connection
            $conn =mysqli_connect($servername, $username, $password, $dbname);
            //$conn->set_charset("utf8");
            // Check connection
            if ($conn) {
               //die("Connection failed: " . $conn->connect_error);
               //echo "success";
            }
            else{
          //  echo "error";
            }
            
?>