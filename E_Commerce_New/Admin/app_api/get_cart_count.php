<?php
	include('../connection.php');
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    $data = [];
    
    $u_id = mysqli_real_escape_string($conn,$_REQUEST['u_id']);
    
    
    $sql = "SELECT * FROM `add_cart` WHERE `user_id`='$u_id' AND buy_status=''";
   $result = $conn->query($sql);
   $num=$result->num_rows;

	if ($result->num_rows > 0) {
	 
	 $arr=array('status'=>true,'data'=>$num);
	} else {
	   $arr=array('status'=>false);
	}
    
   
    echo json_encode($arr);
?>