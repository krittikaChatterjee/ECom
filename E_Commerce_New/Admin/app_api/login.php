<?php
	include('../connection.php');
	
	$data = [];
	$username = mysqli_real_escape_string($conn,$_REQUEST['username']);
	$password = mysqli_real_escape_string($conn,$_REQUEST['pass']);
	
	$login_query = mysqli_query($conn,"SELECT * FROM `users` WHERE `mobile`='$username' AND `password`='$password'");
	$row = mysqli_num_rows($login_query);
	
	if($row != 0){
		$login_result = mysqli_fetch_assoc($login_query);
		
		$arr=array('rec'=>1,'user_id'=>$login_result['u_id']);
	}else{
			$arr=array('rec'=>0);
	}
	
	echo json_encode($arr);
?>