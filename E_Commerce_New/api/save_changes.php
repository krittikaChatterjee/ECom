<?php
session_start();
$user_id = $_SESSION['user'];
include('../connection.php');
$name  = $_REQUEST['name'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];

$duplicateName_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `users` WHERE `name` = '$name' AND NOT `u_id`='$user_id'"));
$duplicateEmail_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `users` WHERE `email` = '$email' AND NOT `u_id`='$user_id'"));
$duplicatePhone_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `users` WHERE `mobile` = '$phone' AND NOT `u_id`='$user_id'"));

if($duplicateName_count == 0 && $duplicateEmail_count == 0 && $duplicatePhone_count == 0){
    $updateSql = mysqli_query($conn,"UPDATE `users` SET `name`='$name',`email`='$email',`mobile`='$phone' WHERE `u_id`='$user_id'");
    
    if($updateSql){
        echo true; 
    } else {
        echo false;
    }
} else {
    echo "duplicate_value";
}








?>