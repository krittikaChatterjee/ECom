<?php
	include('../connection.php');
$coupon=$_REQUEST['coupon'];
$user_id=$_REQUEST['user_id'];

$sql = "SELECT * FROM coupon WHERE coupon_name='$coupon' AND status='Y'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    $sql2 = "SELECT * FROM check_cupon WHERE coupon='$coupon' AND user_id='$user_id'";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
 
  $arr=array('rec'=>2);
} else {
     
$arr=array('amount'=>$row['dis_per'],'rec'=>1);
}
    
} else {
 $arr=array('rec'=>0);
}
echo json_encode($arr);
?>