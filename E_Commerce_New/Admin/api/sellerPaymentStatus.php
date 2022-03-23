<?php
    include('../connection.php');
    $id = mysqli_real_escape_string($conn,$_REQUEST['id']);
    // echo $id;
    // $test = "UPDATE `seller_order` SET `request_status`='Paid' WHERE `seller_order_id`='$id'";
    // echo $test;
    $sql = mysqli_query($conn,"UPDATE `seller_order` SET `request_status`='Paid' WHERE `seller_order_id`='$id'");
    if($sql)
    {
        echo 1;
    }
?>