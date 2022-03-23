<?php
include('connection.php');
$user_id1=base64_decode($_REQUEST['user']);
$invoice1=base64_decode($_REQUEST['invo']);
$sql_user1=mysqli_query($conn,"SELECT * FROM users WHERE u_id='$user_id1'");
$user_data=mysqli_fetch_assoc($sql_user1);

$ordersql1=mysqli_query($conn,"SELECT * FROM order_list WHERE invoice_no='$invoice1'");
$details1=mysqli_fetch_assoc($ordersql1);
?>

<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="Crop2kitchen">
        <meta name="author" content="Crop2kitchen">

        <title>Crop2kitchen Invoice</title>
        <link href="dashboard/assets/admin/css/bootstrap.min.css" rel="stylesheet">
        <link href="dashboard/assets/admin/css/font-awesome.min.css" rel="stylesheet">
        <link href="dashboard/assets/admin/css/themify-icon.css" rel="stylesheet">
        <link href="dashboard/assets/admin/css/perfect-scrollbar.min.css" rel="stylesheet">
        <link href="dashboard/assets/admin/css/bootstrap-colorpicker.css" rel="stylesheet">
        <link href="dashboard/assets/admin/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="dashboard/assets/admin/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="dashboard/assets/admin/css/style.css" rel="stylesheet">
        <link href="dashboard/assets/admin/css/responsive.css" rel="stylesheet">
         <link rel="icon" type="image/png" href="dashboard/assets/copy2kitchin.png">  
  <style type="text/css">
@page { size: auto;  margin: 0mm; }
@page {
  size: A4;
  margin: 0;
}
@media print {
  html, body {
    width: 210mm;
    height: 287mm;
  }

html {
    overflow: scroll;
    overflow-x: hidden;
}
::-webkit-scrollbar {
    width: 0px;  /* remove scrollbar space */
    background: transparent;  /* optional: just make scrollbar invisible */
}
  </style>
</head>
<body onload="window.print();">
                                        <div class="invoice-wrap" style="margin-top:-10px">
                                            <div class="invoice__title">
                                                <div class="row reorder-xs">
                                                    <div class="col-sm-6">
                                                        <div class="invoice__logo text-left">
                                                        	<h3>Just Carry</h3>
                                                            <!--<img src="dashboard/assets/copy2kitchin.png" alt="woo commerce logo">-->
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="invoice__metaInfo">
                                                        <div class="buyer" style="width: 70%;">
                                                            <p>Billing Address</p>
                                                            <strong><?=$user_data['name']?></strong>
                                                            <address>
                                                               <!--<?=$user_data['name']?><br>-->
                                                               <?=$user_data['address']?><br>
                                                               <?=$user_data['city']?><br>
                                                               <?=$user_data['state']?><br>
                                                                <?=$user_data['country']?><br>
                                                            </address>
                                                        </div>

                                                        <div class="invoce__date"  style="width: 20%;">
                                                            <strong>Invoice ID</strong>
                                                            <p>Order Date</p>
                                                            <p>Order ID</p>
                                                        </div>

                                                        <div class="invoce__number"  style="width: 10%;">
                                                            <strong><?= $invoice1?></strong>
                                                            <p> <?= date('d-M-Y', strtotime($details1['date']))?> <?=$details1['time']?></p>
                                                            <p><?=$invoice1?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="invoice__table">
                                                        <div class="table-responsive">
                                                          <table class="table table-hover">
                                                            <thead>
                                                              <tr>
                                                                <th>Product</th>
                                                                <th>Price</th>
                                                                <th>Quantity</th>
                                                                <th></th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                        <?php 
                                                        $sub_total1=0;
                                                        $sql_order1=mysqli_query($conn,"SELECT * FROM ordered_product WHERE invoice_no='$invoice1'");
                                                        while($order_data1=mysqli_fetch_assoc($sql_order1)){
                                                            // $sql_product1=mysqli_query($conn,"SELECT * FROM ordered_product WHERE invoice_no='$invoice1'");
                                                            // $produtc_data1=mysqli_fetch_assoc($sql_product1);
                                                            
                                                            $sub_total1 +=$order_data1['product_price'];
                                                            
                                                            // $selling1 +=$order_data1['product_price'];
                                                        ?>        
                                                 
                                                        <tr>
                                                                <td><a  href="javascript:void(0)"><?=$order_data1['product_name'].' '.$produtc_data1['product_quntity'].''.$order_data1['unit']?></a></td>
                                                               
                                                                <td><i class="fa fa-inr" aria-hidden="true"></i> <?=$order_data1['product_price']?></td>
                                                                <td><?=$order_data1['product_quntity']?></td>
                                                                <td></td>
                                                               
                    
                                                        </tr>
                                                        <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                              <tr>
                                                                <td colspan="3">Subtotal</td>
                                                                <td><i class="fa fa-inr" aria-hidden="true"></i><?=$sub_total1?></td>
                                                              </tr>
                                                              
                                                              <tr>
                                                                <td colspan="3">Shipping Cost</td>
                                                                <td><?=$details1['delivery_charges']?></td>
                                                              </tr>
                                                             
                                                              <!--<tr>-->
                                                              <!--  <td colspan="3">TAX({{$order->currency_sign}})</td>-->
                                                               
                                                              <!--  <td>{{round($tax, 2)}}</td>-->
                                                              <!--</tr>-->
                                                           
                                                              <!--<tr>-->
                                                              <!--  <td colspan="3">Coupon Discount({{$order->currency_sign}})</td>-->
                                                              <!--  <td>{{round($order->coupon_discount, 2)}}</td>-->
                                                              <!--</tr>-->
                                                              <!--@endif-->
                                                              <tr>
                                                                <td colspan="2"></td>
                                                                <td>Total</td>
                                                                  <td><i class="fa fa-inr" aria-hidden="true"></i><?=$sub_total1 + $details1['delivery_charges']?></td>
                                                              </tr>
                                                            </tfoot>         
                                                          </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                            <hr>

                                            
                                            
  <script src="dashboard/assets/admin/js/jquery.min.js"></script>
        <script src="dashboard/assets/admin/js/bootstrap.min.js"></script>
        <script src="dashboard/assets/admin/js/perfect-scrollbar.jquery.min.js"></script>
        <script src="dashboard/assets/admin/js/jquery.canvasjs.min.js"></script>
        <script src="dashboard/assets/admin/js/bootstrap-colorpicker.js"></script>
        <script src="dashboard/assets/admin/js/Chart.min.js"></script>
        <script src="dashboard/assets/admin/js/jquery.dataTables.min.js"></script>
        <script src="dashboard/assets/admin/js/dataTables.bootstrap.js"></script>
        <script src="dashboard/assets/admin/js/dataTables.responsive.min.js"></script>
        <script src="dashboard/assets/admin/js/notify.js"></script>
        <script src="dashboard/assets/admin/js/main.js"></script>

<!-- ./wrapper -->

<script type="text/javascript">
setTimeout(function () {
        window.close();
      }, 500);
</script>
</body>
</html>
