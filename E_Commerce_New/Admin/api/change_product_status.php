<?php
include("../connection.php");
$id=mysqli_real_escape_string($conn, $_POST['id']);

$sql_match=mysqli_query($conn,"SELECT * FROM category WHERE cat_id='$id'");
$fetch_Data = mysqli_fetch_array($sql_match);
if($fetch_Data['active_our'] == 'Y'){

	$sql_updateY=mysqli_query($conn,"UPDATE category SET active_our='N' WHERE cat_id='$id'");
	if($sql_updateY){
		$var['status']='in';
	}
}else {
  
  $sql_updateY=mysqli_query($conn,"UPDATE category SET active_our='Y' WHERE cat_id='$id'");

  if($sql_updateY){
		$var['status']='a';
	}

}
echo json_encode($var);
?>