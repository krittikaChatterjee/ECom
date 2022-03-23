<?php
session_start();
include('../connection.php');
$user_id=$_SESSION['user'];
if(isset($_FILES['file']['name'])){
    /* Getting file name */
//   echo $filename = $_FILES['file']['name'];
   
   
   
    $file=$_FILES["file"]["name"];
    $foll=rand(1111,9999)."_".$file;
    $pathh1="../images/user_img/".$foll;                     
    $tmpp=$_FILES["file"]["tmp_name"];                             
    move_uploaded_file($tmpp,$pathh1);                 
                     
                    //  $img;
                    //  if ($file=='') {
                    //   $img=$image;
                    //  }
                    //  if ($file!='')  {
                      
                    //   $img=$foll;
                    //  }
    $updateSql = mysqli_query($conn,"UPDATE `users` SET `image`='$foll' WHERE `u_id`='$user_id'"); 
    
    $FetchImg = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users  WHERE `u_id`='$user_id'"));
    if($updateSql){
        $FetchImg = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users  WHERE `u_id`='$user_id'"));
        echo  $FetchImg['image'];
    } else {
        echo false;
    }
}


?>