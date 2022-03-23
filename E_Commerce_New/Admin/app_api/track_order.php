<?php
	include('../connection.php');
	 $order_id = mysqli_real_escape_string($conn,$_REQUEST['order_id']);
	 
	 $sql = "SELECT * FROM order_list WHERE invoice_no='$order_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $arr[]=$row;
  }
} else {
$arr=[];
}

echo json_encode($arr);
	 
	 ?>