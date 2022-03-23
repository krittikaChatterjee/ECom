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
                        <th>Last Update date</th>                       
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    
                    $c=1;
                    $sql="SELECT * FROM use_stock ORDER BY use_stock_id DESC";
                    $queary=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($queary))
                    {
                      $id=$row['use_stock_id'];
                      $category_name=$row['product_name'];
                   
                  ?>
                    <tr>
                      <td><?php echo $c;  ?></td>
                      <td><?php echo $category_name;  ?></td>
                      <td><?=$row['number_of_product'];?></td>
                        <td><?=$row['update_date'];?></td>
                   
                      
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
                      <th>Last Update date</th>
                      
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