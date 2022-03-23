<?php
include("../connection.php");
 $id=mysqli_real_escape_string($conn, $_REQUEST['id']);
 $stat=mysqli_real_escape_string($conn, $_REQUEST['stat']);

$sql_match=mysqli_query($conn,"UPDATE `order_list` SET `status`='$stat' WHERE `order_id`='$id'");
if($sql_match)
{
    $var['msg']="Y";
}
else
{
    $var['msg']="N";
}


echo json_encode($var);
?>