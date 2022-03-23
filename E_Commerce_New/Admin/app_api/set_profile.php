<?php
	include('../connection.php');
    
	$json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    
    $data = [];
	
	$name = mysqli_real_escape_string($conn,$_REQUEST['name']);
	$u_id = mysqli_real_escape_string($conn,$_REQUEST['u_id']);
	$email = mysqli_real_escape_string($conn,$_REQUEST['email']);
	$phNo = mysqli_real_escape_string($conn,$_REQUEST['phNo']);
	$password = mysqli_real_escape_string($conn,$_REQUEST['password']);
	$user_image = $_REQUEST['image'];
	
	$rand=rand(111,999).time();

    $upload_path="user_img/".$rand.".jpg";

    $image_name=$rand.".jpg";
 
	 if($user_image==""){
		$sql = "UPDATE `users` SET `name`='$name',`email`='$email',`mobile`='$phNo',`password`='$password' WHERE `u_id`='$u_id'";
	}
	else{
	
	$sql = "UPDATE `users` SET `name`='$name',`email`='$email',`mobile`='$phNo',`password`='$password',`image`='$image_name' WHERE `u_id`='$u_id'";
	}
	if ($conn->query($sql)) {
	    file_put_contents($upload_path,base64_decode($user_image));
	    $arr=array('rec'=>1);
	} else {
	    $arr=array('rec'=>0);
	}

	
	echo json_encode($arr);
?>