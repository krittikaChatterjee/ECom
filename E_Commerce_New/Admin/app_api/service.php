<?php
	include('../connection.php');
	 $name= mysqli_real_escape_string($conn,$_REQUEST['name']);
    $email = mysqli_real_escape_string($conn,$_REQUEST['email']);
    $mobile = mysqli_real_escape_string($conn,$_REQUEST['mobile']);
    $address = mysqli_real_escape_string($conn,$_REQUEST['address']);
    $service= mysqli_real_escape_string($conn,$_REQUEST['service']);
    $des= mysqli_real_escape_string($conn,$_REQUEST['des']);
    $qun= mysqli_real_escape_string($conn,$_REQUEST['qun']);
    $image=$_REQUEST['image'];
    
    $rand=rand(111,999).time();

    $upload_path="service_img/".$rand.".jpg";

    $image_name=$rand.".jpg";
    
    $sql = "INSERT INTO service (name, email, mobile,address,service,description,quntity,image)
VALUES ('$name', '$email', '$mobile','$address','$service','$des','$qun','$image_name')";

if ($conn->query($sql)) {
	 file_put_contents($upload_path,base64_decode($image));
  $arr=array('rec'=>1);
} else {
  $arr=array('rec'=>0);
}
    echo json_encode($arr);
    ?>