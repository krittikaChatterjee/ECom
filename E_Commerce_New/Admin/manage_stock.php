<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Manage Stock</h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item">Stock</li>
              <li class="breadcrumb-item active" aria-current="page">Manage Stock</li>
           </ol>
       </div>
      </div><!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Stock</div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                    <tr>
                        <th>Sl. Number</th>
                        <th>Product name</th>
                        <th>Number of Stock</th>
                          <th>Add date</th>
                        <!--<th>Edit</th>-->
                        <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    if(isset($_REQUEST['del']))
                    {
                      $del_id=base64_decode($_REQUEST['del']);
                      $d_query = mysqli_query($conn,"SELECT * FROM `original_stock` WHERE `or_stock_id`='$del_id'");  
                      $d_result = mysqli_fetch_assoc($d_query);
                      $name_no=$d_result['product_name'];
                       $number_of_product=$d_result['number_of_product'];

                       $fetch_number_of=mysqli_query($conn,"SELECT * FROM use_stock WHERE product_name='$name_no'");
                       $raw_num_of=mysqli_fetch_assoc($fetch_number_of);
                       $total_num=$raw_num_of['number_of_product'];

                       $final=($total_num - $number_of_product);

                    
                      $delete_query=mysqli_query($conn,"DELETE FROM `original_stock` WHERE `or_stock_id`='$del_id'");
                      if($delete_query)
                      {
                      	$delete_query1=mysqli_query($conn,"UPDATE use_stock SET number_of_product='$final' WHERE `product_name`='$name_no'");
                        
                        echo '<script>swal("Successful", "You have successfully deleted", "success")</script>';
                        echo "<script>
                                setTimeout(function() {
                                    window.location='manage_stock.php'
                                }, 3000);
                            </script>";
                      }
                    }
                    $c=1;
                    $sql="SELECT * FROM original_stock ORDER BY or_stock_id DESC";
                    $queary=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($queary))
                    {
                      $id=$row['or_stock_id'];
                      $category_name=$row['product_name'];
                   
                  ?>
                    <tr>
                      <td><?php echo $c;  ?></td>
                      <td><?php echo $category_name;  ?></td>
                      <td><?=$row['number_of_product'];?></td>
                        <td><?=$row['add_date'];?></td>
                   
                      <!--<td><a href="edit_stock.php?i=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-edit"></i></td>-->
                      <td><a href="manage_stock.php?del=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-trash"></i></td>
                    </tr>
                  <?php
                      $c++;
                    }

                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Sl. Number</th>
                      <th>Product name</th>
                      <th>Number of Stock</th>
                      <th>Add date</th>
                      <!--<th>Edit</th>-->
                      <th>Delete</th>
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