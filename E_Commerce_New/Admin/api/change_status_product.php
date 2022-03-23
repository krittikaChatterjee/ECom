<?php
include("../connection.php");
$id=$_REQUEST['id'];

$sql_match=mysqli_query($conn,"SELECT * FROM product WHERE product_id='$id'");
$fetch_Data = mysqli_fetch_array($sql_match);
if($fetch_Data['status'] == 'Y'){

	$sql_updateY=mysqli_query($conn,"UPDATE product SET status='N' WHERE product_id='$id'");
	if($sql_updateY){
		$var['status']='in';
	}
}else {
  
  $sql_updateY=mysqli_query($conn,"UPDATE product SET status='Y' WHERE product_id='$id'");

  if($sql_updateY){
		$var['status']='a';
	}

}
echo json_encode($var);
?>