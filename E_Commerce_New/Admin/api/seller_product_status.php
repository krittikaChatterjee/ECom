<?php
include("../connection.php");
// echo $_POST['id'];
$select_QRY = mysqli_query($conn,"SELECT * FROM tmp_product WHERE product_id='".$_POST['id']."'");
$fetch_Data = mysqli_fetch_array($select_QRY);
if($fetch_Data['status']=='N')
{
    $category_id = $fetch_Data['category_id'];
    $brand = $fetch_Data['brand_id'];
    $sub_category = $fetch_Data['sub_cat_id'];
    $product_name = $fetch_Data['product_name'];
    $quantity_unit = $fetch_Data['quantity_per_unit'];
    $unit = $fetch_Data['unit'];
    $product_price = $fetch_Data['price'];
    $r_quantity = $fetch_Data['retailer_quantity'];
    $r_discount = $fetch_Data['retailer_discount'];
    $quantity = $fetch_Data['wholeseller_quantity'];
    $discount = $fetch_Data['discount_percent'];
    $i_quantity = $fetch_Data['importer_quantity'];
    $i_discount = $fetch_Data['importer_discount'];
    $product_selling_price = $fetch_Data['selling_price'];
    $gst_percentage = $fetch_Data['gst_percentage'];
    $product_description = $fetch_Data['product_description'];
    $foll = $fetch_Data['main_image'];
    $foll1 = $fetch_Data['sub_img1'];
    $foll2 = $fetch_Data['sub_img2'];
    $foll3 = $fetch_Data['sub_img3'];
    $foll4 = $fetch_Data['sub_img4'];
    $date = date("Y-m-d");
    $seller_id = $fetch_Data['seller_id'];
    
    $sql = "INSERT INTO product(`category_id`,`brand_id`,`sub_cat_id`,`product_name`,`quantity_per_unit`,`unit`,`price`,`retailer_quantity`,`retailer_discount`,`wholeseller_quantity`,`discount_percent`,`importer_quantity`,`importer_discount`,`selling_price`,`gst_percentage`,`product_description`,`main_image`,`sub_img1`,`sub_img2`,`sub_img3`,`sub_img4`,`date`,`seller_id`) VALUES('$category_id','$brand','$sub_category','$product_name','$quantity_unit','$unit','$product_price','$r_quantity','$r_discount','$quantity','$discount','$i_quantity','$i_discount','$product_selling_price','$gst_percentage','$product_description','$foll','$foll1','$foll2','$foll3','$foll4','$date','$seller_id')";
        // echo '<script>console.log("hi");</script>';
        $product_query = mysqli_query($conn,$sql);
    
    if($product_query)
    {
        $update_Qry =mysqli_query($conn,"UPDATE tmp_product SET status='Y' WHERE product_id='".$_POST['id']."'");
        // $sql = "INSERT INTO product(`category_id`,`brand_id`,`sub_cat_id`,`product_name`,`quantity_per_unit`,`unit`,`price`,`retailer_quantity`,`retailer_discount`,`wholeseller_quantity`,`discount_percent`,`importer_quantity`,`importer_discount`,`selling_price`,`gst_percentage`,`product_description`,`main_image`,`sub_img1`,`sub_img2`,`sub_img3`,`sub_img4`,`date`) VALUES('$category_id','$brand','$sub_category','$product_name','$quantity_unit','$unit','$product_price','$r_quantity','$r_discount','$quantity','$discount','$i_quantity','$i_discount','$product_selling_price','$gst_percentage','$product_description','$foll','$foll1','$foll2','$foll3','$foll4','$date')";
        // echo '<script>console.log("hi");</script>';
        // $product_query = mysqli_query($conn,$sql);
        $var['status'] ='in';
    }
}
// else
// {
//   $update_Qry =mysqli_query($conn,"UPDATE product SET status='Y' WHERE product_id='".$_POST['id']."'");
//     if($update_Qry)
//     {
//         $var['status'] = 'a';
//     }
// }
echo json_encode($var);
?>