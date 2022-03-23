<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Manage Product Stock</h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item">Product </li>
              <li class="breadcrumb-item active" aria-current="page">Manage Product Stock</li>
           </ol>
       </div>
      </div><!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Product</div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                    <tr>
                        <th>Sl. Number</th>
                        <!--<th>Category</th>-->
                        <th>Product Name</th>
                        <th>Quantity Unit</th>
                        <th>Total Stock</th>
                        
                        <!--<th>Delete</th>-->
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    if(isset($_GET['del_id']))
                    {
                      $del_id=base64_decode($_GET['del_id']);
                      
                      $delete_query=mysqli_query($conn,"DELETE FROM `use_stock` WHERE `use_stock_id`='$del_id'");
                      if($delete_query)
                      {
                        
                        echo '<script>swal("Successful", "You have successfully deleted", "success")</script>';
                        echo "<script>
                                setTimeout(function() {
                                    window.location='manage_esencial_product_stock.php'
                                }, 3000);
                            </script>";
                      }
                    }
                    $c=1;
                    $sql="SELECT * FROM `qty_per_unit` ORDER BY qty_id DESC";
                    $queary=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($queary))
                    {
                      $c_query = mysqli_query($conn,"SELECT * FROM product WHERE `product_id`='".$row['product_id']."'");
                      $c_result = mysqli_fetch_assoc($c_query);
                      
                      $c_queryy = mysqli_query($conn,"SELECT * FROM qty_per_unit WHERE `qty_id`='".$row['quantity_unit_id']."'");
                      $c_resultt = mysqli_fetch_assoc($c_queryy);
                      
                      $id=$row['use_stock_id'];
                      
                   
                  ?>
                    <tr>
                      <td><?php echo $c;  ?></td>
                      <td><?php echo $c_result['product_name'];  ?></td>
                      <td><?php echo $row['qtu_per_unit'];  ?></td>
                      <td><?php echo $row['number_of_product'];  ?></td>
                      
                      <!--<td><a href="manage_esencial_product_stock.php?del_id=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-trash"></i></td>-->
                    </tr>
                  <?php
                      $c++;
                    }

                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Sl. Number</th>
                        <!--<th>Category</th>-->
                        <th>Product Name</th>
                        <th>Quantity Unit</th>
                        <th>Total Stock</th>
                        
                        <!--<th>Delete</th>-->
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
  <script type="text/javascript">

  	 function change_status(id)
      {
        //   alert(id);
        $.ajax({
            type:"post",
            url:"api/accept_product.php",
            data:{id:id},
            beforeSend: function() {
                $(".status_"+id).html('Processing...');
            },
            success:function(data)
            { 
                // alert(data);
                var jsonObj = JSON.parse(data);
                // alert(jsonObj.status);
                if(jsonObj.status == 'a')
                {
                    $(".status_"+id).html('Approve');
                    $(".status_"+id).css('background-color','#15ca20');
                    $(".status_"+id).css('border','1px solid #15ca20');
                }
                else if(jsonObj.status == 'in')
                {
                    $(".status_"+id).html('Disapprove');
                    $(".status_"+id).css('background-color','#bd2130');
                    $(".status_"+id).css('border','1px solid #bd2130');
                }
            }
        })
      }

  </script>
<?php include('footer.php'); ?>