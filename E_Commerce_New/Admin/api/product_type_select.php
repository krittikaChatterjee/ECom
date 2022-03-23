<?php
include('../connection.php');
// print_r($_POST); 
 $category=mysqli_real_escape_string($conn,$_POST['category']);
$array=array();

 $sql = "SELECT * FROM `sub_category` WHERE `catagory_id`='$category'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        $array[]=array('sub_category_name'=>$row['sub_name'],'sub_category_id'=>$row['sub_id']);
    }
} else {
    $array[]=array('message'=>'0');
}


echo json_encode($array);







?>