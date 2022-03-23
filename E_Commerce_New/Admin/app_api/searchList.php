<?php
	include('../connection.php');
	
	$sql = "SELECT * FROM product";
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