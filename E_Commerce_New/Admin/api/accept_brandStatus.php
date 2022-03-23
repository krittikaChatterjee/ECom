<?php
include("../connection.php");
 $id=mysqli_real_escape_string($conn, $_POST['id']);

$sql_match=mysqli_query($conn,"SELECT * FROM brand WHERE b_id='$id'");
$fetch_Data = mysqli_fetch_array($sql_match);
if($fetch_Data['status'] == 'Y'){

	$sql_updateY=mysqli_query($conn,"UPDATE brand SET status='N' WHERE b_id='$id'");
	if($sql_updateY){
		$var['status']='in';
	}
}else {
  
  $sql_updateY=mysqli_query($conn,"UPDATE brand SET status='Y' WHERE b_id='$id'");

  if($sql_updateY){
		$var['status']='a';
	}

}
echo json_encode($var);
?>