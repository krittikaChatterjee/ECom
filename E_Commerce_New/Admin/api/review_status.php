<?php
include("../connection.php");
$id=$_REQUEST['id'];

$fetch_Data=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `review` WHERE `id`='$id'"));
if($fetch_Data['status'] == 'Y'){
$sql_updateY=mysqli_query($conn,"UPDATE review SET status='N' WHERE id='$id'");
?>
<button type="button" class="btn btn-danger" onclick="change_status(<?=$id?>)">Deative</button>
<?php } else {
$sql_updateY=mysqli_query($conn,"UPDATE review SET status='Y' WHERE id='$id'");
?>
<button type="button" class="btn btn-success" onclick="change_status(<?=$id?>)">Active</button>
<?php } ?>