
<?php
include("../connection.php");
$Product_id = $_REQUEST['Product'];
$fetch_qty_stock = "SELECT * FROM `qty_per_unit` WHERE product_id='$Product_id'";
$fetch_qty_stock_read = mysqli_query($conn,$fetch_qty_stock);
while($row_qty_stock = mysqli_fetch_array($fetch_qty_stock_read)){
	?>
	<option value="<?=$row_qty_stock['qty_id']?>"><?=$row_qty_stock['qtu_per_unit']?> <?=$row_qty_stock['unit']?></option>
	<?php
}



?>