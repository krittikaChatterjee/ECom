<?php
include("../connection.php");
$id=$_REQUEST['id'];

$sql_match=mysqli_query($conn,"SELECT * FROM nearest_point WHERE id='$id'");
$fetch_Data = mysqli_fetch_array($sql_match);
if($fetch_Data['exp_status'] == 'Y'){

	$sql_updateY=mysqli_query($conn,"UPDATE nearest_point SET exp_status='N' WHERE id='$id'");
	if($sql_updateY){
		$var['status']='in';
	}
}else {
  
  $sql_updateY=mysqli_query($conn,"UPDATE nearest_point SET exp_status='Y' WHERE id='$id'");

  if($sql_updateY){
		$var['status']='a';
	}

}
echo json_encode($var);
?>