<?php
    include("../connection.php");
    $id = $_POST['id'];
    $u_id = $_POST['u_id'];
    $wallet_id = $_POST['wallet_id'];
    $query = mysqli_query($conn,"UPDATE `withdraw_amount` SET `status`='Y' WHERE `w_id`='$id'");
    if($query){
        $wallet_query = mysqli_query($conn,"UPDATE `wallet` SET `status`='SUCCESS' WHERE `user_id`='$u_id' AND `id`='$wallet_id'");
        echo 1;
        
    }
?>