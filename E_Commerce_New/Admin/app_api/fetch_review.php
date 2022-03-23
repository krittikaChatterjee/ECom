<?php
	include('../connection.php');
	$product_id = mysqli_real_escape_string($conn,$_REQUEST['product_id']);
	
	$sql = "SELECT * FROM product_rating WHERE product_id='$product_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  
  while($row = $result->fetch_assoc()) {
    $user_id=$row['user_id'];
    
    $sql2 = "SELECT name, image FROM users WHERE u_id='$user_id'";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    
    $arr[]=array('name'=>$row2['name'],'image'=>$row2['image'],'ratting'=>$row['rating'],'comment'=>$row['comment'],'reply'=>$row['admin_comment']);
    
  }
} else {
  $arr=[];
}

echo json_encode($arr);
?>