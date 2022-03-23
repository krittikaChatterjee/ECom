<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php
    $invoice_no = base64_decode($_REQUEST['id']);
?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">User Order</h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <!--<li class="breadcrumb-item">Order</li>-->
              <li class="breadcrumb-item" aria-current="page"><a href="user_order.php">User Order</a></li>
              <li class="breadcrumb-item active" aria-current="page">Order Details</li>
           </ol>
       </div>
      </div><!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Order Details Of <?=$invoice_no?></div>
            <div class="card-body">
              <div class="table-responsive">
              	<div>
              	</div>
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                    <tr>
                        <th>Sl. Number</th>
                        <th>Product Name</th>
                        <th>Product Count</th>
                        <th>Product Variant</th>
                        <th>Product Price (in Rs.)</th>
                        <th>Tax(in Rs.)</th>
                        <th>Total Product Price(in Rs.)</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                 
                    $c=1;
                    $sql="SELECT * FROM `ordered_product` WHERE `invoice_no` = '$invoice_no' ORDER BY ordered_id DESC";
                    $queary=mysqli_query($conn,$sql);
                    $c=1;
                    while($row=mysqli_fetch_assoc($queary)){
                        $qty_id = $row['product_id'];
                        $qty_table_details = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `qty_per_unit` WHERE `qty_id` = '$qty_id'"));
                    
                        ?>
                        <tr>
                            <td><?php echo $c; $c++; ?></td>
                            <td><?php
                                $product_id = $qty_table_details['product_id'];
                                $product_res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `product` WHERE `product_id` = '$product_id'"));
                                echo $product_res['product_name'];
                            ?></td>
                            <td><?=$row['cart_quantity']?></td>
                            <td><?=$qty_table_details['qtu_per_unit'].$qty_table_details['unit']?></td>
                            <td><?=$qty_table_details['discount_price']?></td>
                            <td><?=$qty_table_details['product_price'] - $qty_table_details['discount_price']?></td>
                            <td><?=$qty_table_details['product_price']?></td>
                            
                        </tr>
                        <?php
                        
                    }

                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Sl. Number</th>
                        <th>Product Name</th>
                        <th>Product Count</th>
                        <th>Product Variant</th>
                        <th>Product Price (in Rs.)</th>
                        <th>Tax(in Rs.)</th>
                        <th>Total Product Price(in Rs.)</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div><!-- End Row-->
    </div><!-- End container-fluid-->
  </div><!-- End content-wrapper-->

<?php include('footer.php'); ?>


