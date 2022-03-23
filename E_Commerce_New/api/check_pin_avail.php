<?php
include('../connection.php');
$pincode = $_POST['pincode'];

$check_sql = mysqli_query($conn,"SELECT * FROM `nearest_point` WHERE `name` = '$pincode' AND `status` = 'Y'");
if(mysqli_num_rows($check_sql) > 0) {
    echo "pincode_ache";
} else {
    echo "pincode_nei";
}
?>