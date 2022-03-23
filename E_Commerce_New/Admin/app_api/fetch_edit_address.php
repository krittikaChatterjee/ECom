<?php
	include('../connection.php');
	$id = mysqli_real_escape_string($conn,$_REQUEST['id']);
	
	$sql = "SELECT * FROM user_delivery_address WHERE da_id='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$arr[]=$row;
} else {
  $arr=[];
}

echo json_encode($arr);
	?>