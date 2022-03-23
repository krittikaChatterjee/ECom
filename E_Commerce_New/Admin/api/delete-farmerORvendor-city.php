<?php
include('../connection.php');

$id=$_REQUEST['id'];

$delete_query=mysqli_query($conn,"DELETE FROM `farmer_vendor` WHERE `id`='$id'");
if($delete_query==true)
{
    echo "success";
}
else
{
    echo "0";
}



?>