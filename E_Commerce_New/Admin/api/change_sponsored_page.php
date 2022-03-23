<?php
include("../connection.php");
$id=$_REQUEST['id'];

$sql_match=mysqli_query($conn,"SELECT * FROM product WHERE product_id='$id'");
$fetch_Data = mysqli_fetch_array($sql_match);
if($fetch_Data['sponsored_product'] == 'Y'){

	$sql_updateY3=mysqli_query($conn,"UPDATE product SET sponsored_product='N' WHERE product_id='$id'");
	if($sql_updateY3){
		$var['status']='in';
	}
}else {
  
  $sql_updateY3=mysqli_query($conn,"UPDATE product SET sponsored_product='Y' WHERE product_id='$id'");

  if($sql_updateY3){
		$var['status']='a';
	}

}
echo json_encode($var);
?>