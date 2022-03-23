<?php

	include('../connection.php');

    $product_id= mysqli_real_escape_string($conn,$_REQUEST['product_id']);
    $user_id = mysqli_real_escape_string($conn,$_REQUEST['user_id']);
    $rating = mysqli_real_escape_string($conn,$_REQUEST['rating']);
    $comment = mysqli_real_escape_string($conn,$_REQUEST['comment']);


$sql = "SELECT * FROM product_rating WHERE product_id='' AND user_id='$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $arr=array('rec'=>2);
} else {

$sql2 = "INSERT INTO product_rating (product_id, user_id, rating,comment)
VALUES ('$product_id', '$user_id', '$rating','$comment')";

if ($conn->query($sql2)) {
 $arr=array('rec'=>1);
} else {
  $arr=array('rec'=>0);
}
}
echo json_encode($arr);
?>