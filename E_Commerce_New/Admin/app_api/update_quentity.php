<?php
	include('../connection.php');
	$c_id = mysqli_real_escape_string($conn,$_REQUEST['c_id']);
	$u_id = mysqli_real_escape_string($conn,$_REQUEST['u_id']);
	$count = mysqli_real_escape_string($conn,$_REQUEST['count']);
	$price = mysqli_real_escape_string($conn,$_REQUEST['price']);
	

	
	$sql2 = "UPDATE add_cart SET count='$count',total='$price' WHERE user_id='$u_id' AND cart_id='$c_id'";

		if ($conn->query($sql2)) {
					$sql = "SELECT SUM(total) AS total FROM `add_cart` WHERE `user_id`='$u_id'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
	 $row = $result->fetch_assoc();
	 $total=$row['total'];
	} else {
	 $total=0;
	}
		  $data=array('status'=>true,'total'=>$total);
		} else {
		   $data=array('status'=>false);
		}
	
	echo json_encode($data);
?>