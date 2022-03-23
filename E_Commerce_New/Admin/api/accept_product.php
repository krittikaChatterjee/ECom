
<?php
include("../connection.php");
// echo $_POST['id'];
$select_QRY = mysqli_query($conn,"SELECT * FROM product WHERE product_id='".$_POST['id']."'");
$fetch_Data = mysqli_fetch_array($select_QRY);
if($fetch_Data['status']=='Y')
{
   $update_Qry =mysqli_query($conn,"UPDATE product SET status='N' WHERE product_id='".$_POST['id']."'");
    if($update_Qry)
    {
        $var['status'] ='in';
    }
}
else
{
  $update_Qry =mysqli_query($conn,"UPDATE product SET status='Y' WHERE product_id='".$_POST['id']."'");
    if($update_Qry)
    {
        $var['status'] = 'a';
    }
}
echo json_encode($var);
?>