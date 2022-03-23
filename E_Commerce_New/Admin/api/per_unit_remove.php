<?php
include("../connection.php");
$product_id = $_REQUEST['product_id'];
$key_id = $_REQUEST['id'];
/*
$c = 0;
echo $fetch_peoduct = "SELECT * FROM `qty_per_unit` WHERE product_id='$product_id'";
$fetch_peoduct_read = mysqli_query($conn,$fetch_peoduct);
while($row_unit_product = mysqli_fetch_array($fetch_peoduct_read)){
	if($c == $key_id){
		echo $del_unit = "DELETE FROM `qty_per_unit` WHERE `qty_id`='".$row_unit_product['qty_id']."' AND product_id='$product_id'";
		$del_unit_read = mysqli_query($conn,$del_unit);
	}
	
	$c++;
	
}*/
 $del_unit = "DELETE FROM `qty_per_unit` WHERE `qty_id`='$key_id' AND product_id='$product_id'";
		$del_unit_read = mysqli_query($conn,$del_unit);
	

?>