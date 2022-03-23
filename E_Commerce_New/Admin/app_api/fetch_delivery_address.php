<?php
	include('../connection.php');
 $u_id = mysqli_real_escape_string($conn,$_REQUEST['u_id']);
 
 
 $sql = "SELECT * FROM `user_delivery_address` WHERE `user_id`='$u_id' AND selected='1'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $arr=array('id'=>$row['da_id'],'name'=>$row['name'],'city'=>$row['city'],'state'=>$row['state'],'house_no'=>$row['house_no'],'street'=>$row['street'],'pin_code'=>$row['pin_code'],'landmark'=>$row['landmark'],'rec'=>1);
} else {
  $arr=array('rec'=>0);
}
echo json_encode($arr);
?>