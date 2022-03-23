<?php
    include('../connection.php');
    $join_bonus = $_POST['join_bonus'];
    $refer_bonus = $_POST['referral_bonus'];
    $query = mysqli_query($conn,"UPDATE `referral_bonus` SET`rb_amount`='$join_bonus',`rb_under_user_amount`='$refer_bonus' WHERE `rb_id`='1'");
    if($query){
        echo "1";
    }else{
        echo "2";
    }
?>