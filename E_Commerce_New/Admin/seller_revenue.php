<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>


  <div class="content-wrapper">
      <div class="container-fluid">
        <!--<div class="row mt-4">-->
      <!--      <div class="col-12 col-lg-6 col-xl-3">-->
      <!--          <div class="card bg-purple shadow-purple">-->
      <!--            <div class="card-body">-->
      <!--                <div class="media">-->
      <!--                  <div class="media-body text-left">-->
                          <h4 class="text-white"> <?php // echo $no_of_product;     ?></h4>
      <!--                    <span class="text-white">Total Product</span>-->
      <!--                  </div>-->
      <!--              <div class="align-self-center"><span id="dash2-chart-1"></span></div>-->
      <!--              </div>-->
      <!--            </div>-->
      <!--          </div>-->
      <!--      </div>-->
        <!--  <div class="col-12 col-lg-6 col-xl-3">-->
      <!--          <div class="card bg-info shadow-info">-->
      <!--            <div class="card-body">-->
      <!--                <div class="media">-->
      <!--                  <div class="media-body text-left">-->
      <!--                    <h4 class="text-white"></h4>-->
      <!--                    <span class="text-white">Total Service</span>-->
      <!--                  </div>-->
      <!--              <div class="align-self-center"><span id="dash2-chart-2"></span></div>-->
      <!--              </div>-->
      <!--            </div>-->
      <!--          </div>-->
      <!--      </div>-->
      <!--      <div class="col-12 col-lg-6 col-xl-3">-->
      <!--          <div class="card bg-danger shadow-danger">-->
      <!--            <div class="card-body">-->
      <!--                <div class="media">-->
      <!--              <div class="media-body text-left">-->
                          <h4 class="text-white"><?php //echo $no_of_product_order;  ?></h4>
      <!--                    <span class="text-white">Total Products Order</span>-->
      <!--                  </div>-->
      <!--                  <div class="align-self-center"><span id="dash2-chart-3"></span></div>-->
      <!--              </div>-->
      <!--            </div>-->
      <!--          </div>-->
      <!--      </div>-->
      <!--      <div class="col-12 col-lg-6 col-xl-3">-->
      <!--          <div class="card bg-success shadow-success">-->
      <!--            <div class="card-body">-->
      <!--                <div class="media">-->
      <!--                  <div class="media-body text-left">-->
                          <h4 class="text-white"><?php //echo $total_service_order;  ?></h4>
      <!--                  <span class="text-white">Total Service Order</span>-->
      <!--                  </div>-->
      <!--                <div class="align-self-center"><span id="dash2-chart-4"></span></div>-->
      <!--              </div>-->
      <!--            </div>-->
      <!--        </div>-->
      <!--      </div>-->
      <!--    </div><!-- row mt-4 -->
            
            <div class="row pt-2 pb-2">
                <div class="col-sm-9">
                  <h4 class="page-title">Manage Order</h4>
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                      <!--<li class="breadcrumb-item">Category</li>-->
                      <!--<li class="breadcrumb-item active" aria-current="page">Manage Category</li>-->
                   </ol>
               </div>
             </div><!-- End Breadcrumb-->
            
           <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <i class="fa fa-table"></i> Order List</div>
                  <div class="card-body">
                      <div class="table-responsive">
                        <table id="default-datatable" class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>Sl. Number</th>
                                  <th>Seller Name</th>
                                  <!--<th>Byer Mobile</th>-->
                                  <!--<th>Total Price</th>-->
                                  <th>Product Name</th>
                                  <!--<th>Status</th>-->
                                  <!--<th>Order Date</th>-->
                                  <!--<th>Invoice</th>-->
                                  <th>Total Revenue</th>
                                  <th>Status</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                                  $r_query = mysqli_query($conn,"SELECT * FROM `seller_order` WHERE request_status='Request'");
                                  $c = 1;
                                  while($r_result = mysqli_fetch_assoc($r_query))
                                  {
                                     $seller_order_id = $r_result['seller_order_id'];
                                     $seller_id = $r_result['seller_id'];
                                     $product_id = $r_result['product_id'];
                                     $s_query = mysqli_query($conn,"SELECT * FROM `seller` WHERE `seller_id`='$seller_id'");
                                     $s_result = mysqli_fetch_assoc($s_query);
                                     
                                     $p_query = mysqli_query($conn,"SELECT * FROM `product` WHERE `product_id`='$product_id'");
                                     $p_result = mysqli_fetch_assoc($p_query);
                                     $seller_name = $s_result['name'];
                                     $product_name = $p_result['product_name'];
                                     $revenue = $r_result['product_price'];
                                    //   echo "<script>alert('".$product_name."')</script>";
                              ?>
                              <tr>
                                  <td><?=$c;?></td>
                                  <td><?=$seller_name;?></td>
                                  <!--<td><?=$phone;  ?></td>-->
                                      
                                  <td><?=$product_name;  ?></td>
                                  <!--<td><?=$admin_status;  ?></td>-->
                                  <!--<td><?=$order_date;  ?></td>-->
                                  <td>&#8377; <?=number_format($revenue,2);  ?></td>
                                  <td><button type="button" class="btn btn-danger" id="pay_status" onclick="statuschange_dt('<?=$seller_order_id?>')" >Request Pending...</button></td>
                                  
                                  <!--<td><button class="btn btn-danger"></button></td>-->
                       
                                  <!--<td><a href="../invoice.php?id=<?=$invoice; ?>" class="btn btn-info" target="_blank">View</a></td>-->
                              </tr>
                              <?php
                                      $c++;
                                  }
                              ?>
                            
                          </tbody>
                          <tfoot>
                              <tr>
                                   <th>Sl. Number</th>
                                  <th>Seller Name</th>
                                  <!--<th>Byer Mobile</th>-->
                                  <!--<th>Total Price</th>-->
                                  <th>Product Name</th>
                                  <!--<th>Status</th>-->
                                  <!--<th>Order Date</th>-->
                                  <!--<th>Invoice</th>-->
                                  <th>Total Revenue</th>
                                  <th>Status</th>
                              </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
            </div>
          </div><!-- End Row-->
      </div><!-- End container-fluid -->
    </div><!-- End content-wrapper -->
    
  <script src="assets/jquery/jquery.min.js"></script>
  <script>
    // $(document).ready(function(){
    //     // alert('ok');
    //     // $("#pay_status").click(function(){
    //     //     // alert('ok');
    //     //     var id = $("#pay_status").val();
    //     //     alert(id);
    //     // });
        
        
      
    // });
    function statuschange_dt(id){
        // alert(id);
        $.ajax({
            url:"api/sellerPaymentStatus.php",
               type:"post",
               data:{id:id},
               success:function(data){
                  if(data==1)
                  {
                      location.reload();
                  }

               }
        });
    }
    
  </script>


<?php include('footer.php'); ?>