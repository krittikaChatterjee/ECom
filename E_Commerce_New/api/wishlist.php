<?php
include('../connection.php');
$qty_id=$_REQUEST['qty_id'];
$user_id=$_REQUEST['user_id'];

$wishlist_check=mysqli_query($conn,"SELECT * FROM add_wishlist WHERE user_id='$user_id' AND product_id='$qty_id'");
$count=mysqli_num_rows($wishlist_check);

if($count==0){
    $insert_wishlist=mysqli_query($conn,"INSERT INTO add_wishlist (`user_id`,`product_id`) VALUES ('$user_id','$qty_id')");
    echo 1;
}
else{
    echo 2;
}
?>