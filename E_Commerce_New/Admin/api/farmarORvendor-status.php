<?php
include("../connection.php");
 $id=mysqli_real_escape_string($conn, $_POST['id']);

$sql_match=mysqli_query($conn,"SELECT * FROM farmer_vendor WHERE id='$id'");
$fetch_Data = mysqli_fetch_array($sql_match);
if($fetch_Data['status'] == 'Y'){

	$sql_updateY=mysqli_query($conn,"UPDATE farmer_vendor SET status='N' WHERE id='$id'");
	if($sql_updateY){
	
	}
}else {
  
  $sql_updateY=mysqli_query($conn,"UPDATE farmer_vendor SET status='Y' WHERE id='$id'");

  if($sql_updateY){
	
	}

}
// echo json_encode($var);
?>