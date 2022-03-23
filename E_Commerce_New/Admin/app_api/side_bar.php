<?php
	include('../connection.php');
	  $user_id = mysqli_real_escape_string($conn,$_REQUEST['u_id']);
	  
	  $sql = "SELECT * FROM users WHERE u_id='$user_id'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
	  $row = $result->fetch_assoc();
	  $arr=array('rec'=>1,'name'=>$row['name'],'phone'=>$row['mobile'],'image'=>$row['image']);
	} else {
	   $arr=array('rec'=>0);
	}
	echo json_encode($arr);
	?>