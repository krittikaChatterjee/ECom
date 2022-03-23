<?php
include("../connection.php");
$id=$_REQUEST['id'];

$fetch_Data=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `product` WHERE `product_id`='$id'"));
if($fetch_Data['featured_product'] == 'Y'){
$sql_updateY=mysqli_query($conn,"UPDATE product SET featured_product='N' WHERE product_id='$id'");
?>
<button type="button" class="btn btn-danger" onclick="change_featured(<?=$id?>)">No</button>
<?php } else {
$sql_updateY=mysqli_query($conn,"UPDATE product SET featured_product='Y' WHERE product_id='$id'");
?>
<button type="button" class="btn btn-success" onclick="change_featured(<?=$id?>)">Yes</button>
<?php } ?>