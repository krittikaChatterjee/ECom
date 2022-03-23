<?php
    include('../connection.php');
    $join_bonus = $_POST['join_bonus'];
    $refer_bonus = $_POST['referral_bonus'];
    $query = mysqli_query($conn,"UPDATE `shopping_bonus` SET `order_amount`='$join_bonus',`bonus`='$refer_bonus' WHERE `s_id`='1'");
    if($query){
        echo "1";
    }else{
        echo "2";
    }
?>