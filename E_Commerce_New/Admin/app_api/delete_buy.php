
<?php
	include('../connection.php');
	$user_id=$_REQUEST['user_id'];
$sql = "SELECT * FROM add_cart WHERE user_id='$user_id' AND buy_status='Y'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
 $row = $result->fetch_assoc();
 

$sql2 = "DELETE FROM add_cart WHERE user_id='$user_id' AND buy_status='Y'";

if ($conn->query($sql2)) {
   $arr=array('rec'=>1);
} else {
  $arr=array('rec'=>0);
}
  
} else {
 
 $arr=array('rec'=>2);
}
echo json_encode($arr);
?>