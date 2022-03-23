<?php
include('../connection.php');
$id = $_REQUEST['id'];
$deleteSql = mysqli_query($conn,"DELETE FROM `add_wishlist` WHERE `id`='$id'");
?>