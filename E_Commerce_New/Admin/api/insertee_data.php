<?php
include("../connection.php");
$invoice_no=$_REQUEST['invoice_no'];
$status=$_REQUEST['status'];
$remarks=$_REQUEST['remarks'];
$traking_no=$_REQUEST['traking_no'];

$updateQry = mysqli_query($conn,"UPDATE `order_list` SET `status`='$status',`remarks`='$remarks',`tracking_no`='$traking_no' WHERE `invoice_no`='$invoice_no'");


?>

