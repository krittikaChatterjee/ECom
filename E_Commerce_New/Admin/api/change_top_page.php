<?php
include("../connection.php");
$id=$_REQUEST['id'];

$sql_match=mysqli_query($conn,"SELECT * FROM product WHERE product_id='$id'");
$fetch_Data = mysqli_fetch_array($sql_match);
if($fetch_Data['top_selection'] == 'Y'){

	$sql_updateY4=mysqli_query($conn,"UPDATE product SET top_selection='N' WHERE product_id='$id'");
	if($sql_updateY4){
		$var['status']='in';
	}
}else {
  
  $sql_updateY4=mysqli_query($conn,"UPDATE product SET top_selection='Y' WHERE product_id='$id'");

  if($sql_updateY4){
		$var['status']='a';
	}

}
echo json_encode($var);
?>