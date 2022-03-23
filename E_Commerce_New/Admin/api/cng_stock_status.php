
<?php
include("../connection.php");
$_POST['id'];
$select_QRY = mysqli_query($conn,"SELECT * FROM qty_per_unit WHERE qty_id='".$_POST['id']."'");
$fetch_Data = mysqli_fetch_array($select_QRY);
if($fetch_Data['status']=='Y')
{
   $update_Qry =mysqli_query($conn,"UPDATE qty_per_unit SET status='N' WHERE qty_id='".$_POST['id']."'");
    if($update_Qry)
    {
        $var['status'] ='in';
         $update_Qryy =mysqli_query($conn,"UPDATE product SET stock_status='N' WHERE product_id='".$fetch_Data['product_id']."'");
        
    }
}
else
{
  $update_Qry =mysqli_query($conn,"UPDATE qty_per_unit SET status='Y' WHERE qty_id='".$_POST['id']."'");
    if($update_Qry)
    {
        $var['status'] = 'a';
         $update_Qryy =mysqli_query($conn,"UPDATE product SET stock_status='Y' WHERE product_id='".$fetch_Data['product_id']."'");
    }
}
echo json_encode($var);
?>