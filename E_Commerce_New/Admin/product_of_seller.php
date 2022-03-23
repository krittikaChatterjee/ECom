<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Product of Seller</h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item">Seller</li>
              <li class="breadcrumb-item active" aria-current="page">Product of Seller</li>
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
                        <th>Seller Name</th>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Selling Price</th>
                        <th>GST Percentage</th>
                        <th>Product Description</th>
                         <th>Status</th>
                        <!--<th>Edit</th>-->
                        <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    if(isset($_GET['del_id']))
                    {
                      $del_id=base64_decode($_GET['del_id']);
                      $d_query = mysqli_query($conn,"SELECT * FROM `tmp_product` WHERE `product_id`='$del_id'");  
                      $d_result = mysqli_fetch_assoc($d_query);
                      $del_img = "product_image/".$d_result['main_image'];
                      $del_img1 = "product_image/".$d_result['sub_img1'];
                      $del_img2 = "product_image/".$d_result['sub_img2'];
                      $del_img3 = "product_image/".$d_result['sub_img3'];
                      $del_img4 = "product_image/".$d_result['sub_img4'];
                      $delete_query=mysqli_query($conn,"DELETE FROM `tmp_product` WHERE `product_id`='$del_id'");
                      if($delete_query)
                      {
                        unlink($del_img);
                        unlink($del_img1);
                        unlink($del_img2);
                        unlink($del_img3);
                        unlink($del_img4);
                        echo '<script>swal("Successful", "You have successfully deleted", "success")</script>';
                        echo "<script>
                                setTimeout(function() {
                                    window.location='manage_product.php'
                                }, 3000);
                            </script>";
                      }
                    }
                    $c=1;
                    $sql="SELECT * FROM tmp_product WHERE `status`='N' ORDER BY product_id DESC";
                    $queary=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($queary))
                    {
                      $c_query = mysqli_query($conn,"SELECT * FROM category WHERE `cat_id`='".$row['category_id']."'");
                      $c_result = mysqli_fetch_assoc($c_query);
                      $id=$row['product_id'];
                      $category_name = $c_result['cat_name'];
                      $product_name = $row['product_name'];
                      $product_price = $row['price'];
                      $selling_price = $row['selling_price'];
                      $gst_percentage = $row['gst_percentage'];
                      $product_description = $row['product_description'];
                      $seller_id = $row['seller_id'];
                      $seller_query = mysqli_query($conn,"SELECT * FROM `seller` WHERE `seller_id`='$seller_id'");
                      $seller_result = mysqli_fetch_assoc($seller_query);
                   
                  ?>
                    <tr>
                      <td><?php echo $c;  ?></td>
                      <td><?=$seller_result['name'];?></td>
                      <td><?php echo $category_name;  ?></td>
                      <td><?php echo $product_name;  ?></td>
                      <td><?php echo $product_price;  ?></td>
                      <td><?php echo $selling_price;  ?></td>
                      <td><?php echo $gst_percentage;  ?></td>
                      <td><?php echo substr($product_description,0,50);  ?>...</td>

                       <?php 
                      if($row['status'] == 'Y')
                            {
                        ?>
                        <td><button type="button" class="btn btn-success status_<?=$row['product_id']?>" onclick="change_status(<?=$row['product_id']?>)">Approve</td>
                        <?php
                            }
                            else
                            {
                        ?>
                        <td><button type="button" class="btn btn-danger status_<?=$row['product_id']?>" onclick="change_status(<?=$row['product_id']?>)">Disapprove</td>
                        <?php
                            }
                        ?>
                        
                   
                      <!--<td><a href="edit_product.php?id=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-edit"></i></td>-->
                      <td><a href="manage_product.php?del_id=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-trash"></i></td>
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
                      <th>Category</th>
                      <th>Product Name</th>
                      <th>Price</th>
                      <th>Selling Price</th>
                      <th>GST Percentage</th>
                      <th>Product Description</th>
                       <th>Status</th>
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
  <script type="text/javascript">

  	 function change_status(id)
      {
        //   alert(id);
        $.ajax({
            type:"post",
            url:"api/seller_product_status.php",
            data:{id:id},
            beforeSend: function() {
                $(".status_"+id).html('Processing...');
            },
            success:function(data)
            { 
                // // alert(data);
                var jsonObj = JSON.parse(data);
                // // alert(jsonObj.status);
                if(jsonObj.status == 'in')
                {
                //     $(".status_"+id).html('Approve');
                //     $(".status_"+id).css('background-color','#15ca20');
                //     $(".status_"+id).css('border','1px solid #15ca20');
                    location.reload();
                }
                // else if(jsonObj.status == 'in')
                // {
                //     $(".status_"+id).html('Disapprove');
                //     $(".status_"+id).css('background-color','#bd2130');
                //     $(".status_"+id).css('border','1px solid #bd2130');
                //     location.reload();
                // }
                // // console.log(jsonObj);
            }
        })
      }

  </script>
<?php include('footer.php'); ?>