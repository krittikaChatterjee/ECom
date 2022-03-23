<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title">Manage Product</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Product</li>
                </ol>
            </div>
        </div>

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
                                <th>Category</th>
                                <th>Product Name</th>
                                <th>Status</th>
                                <th>Bestseller Product</th>
                                <th>Featured Product</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(isset($_GET['del_id'])){
                            $del_id=base64_decode($_GET['del_id']);
                            $d_query = mysqli_query($conn,"SELECT * FROM `product` WHERE `product_id`='$del_id'");  
                            $d_result = mysqli_fetch_assoc($d_query);
                            $del_img = "product_image/".$d_result['main_image'];
                            $del_img1 = "product_image/".$d_result['sub_img1'];
                            $del_img2 = "product_image/".$d_result['sub_img2'];
                            $del_img3 = "product_image/".$d_result['sub_img3'];
                            $del_img4 = "product_image/".$d_result['sub_img4'];
                            $delete_query=mysqli_query($conn,"DELETE FROM `product` WHERE `product_id`='$del_id'");
                            
                            if($delete_query){
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
                            $sql="SELECT * FROM product ORDER BY product_id DESC";
                            $queary=mysqli_query($conn,$sql);
                            while($row=mysqli_fetch_assoc($queary)){
                            $c_query = mysqli_query($conn,"SELECT * FROM category WHERE `cat_id`='".$row['category_id']."'");
                            $c_result = mysqli_fetch_assoc($c_query);
                            $id=$row['product_id'];
                            $category_name = $c_result['cat_name'];
                            $product_name = $row['product_name'];
                            $product_price = $row['price'];
                            $selling_price = $row['selling_price'];
                            $gst_percentage = $row['gst_percentage'];
                            $status = $row['status'];
                            $bestseller = $row['bestseller_product'];
                            $featured = $row['featured_product'];
                            ?>
                            <tr>
                                <td><?=$c?></td>
                                <td><?=$category_name?></td>
                                <td><?=$product_name?></td>
                                <td id="status<?=$id?>" class="text-center">
                                    <?php if($status=='Y'){ ?>
                                    <button type="button" class="btn btn-success" onclick="change_status(<?=$id?>)">Active</button>
                                    <?php } else { ?>
                                    <button type="button" class="btn btn-danger" onclick="change_status(<?=$id?>)">Deactive</button>
                                    <?php } ?>
                                </td>
                                <td id="bestseller<?=$id?>" class="text-center">
                                    <?php if($bestseller=='Y'){ ?>
                                    <button type="button" class="btn btn-success" onclick="change_bestseller(<?=$id?>)">Yes</button>
                                    <?php } else { ?>
                                    <button type="button" class="btn btn-danger" onclick="change_bestseller(<?=$id?>)">No</button>
                                    <?php } ?>
                                </td>
                                <td id="featured<?=$id?>" class="text-center">
                                    <?php if($featured=='Y'){ ?>
                                    <button type="button" class="btn btn-success" onclick="change_featured(<?=$id?>)">Yes</button>
                                    <?php } else { ?>
                                    <button type="button" class="btn btn-danger" onclick="change_featured(<?=$id?>)">No</button>
                                    <?php } ?>
                                </td>
                                <td><a href="edit_product.php?id=<?=base64_encode($id)?>"><i aria-hidden="true" class="fa fa-edit"></i></td>
                                <td><a href="manage_product.php?del_id=<?=base64_encode($id)?>"><i aria-hidden="true" class="fa fa-trash"></i></td>
                            </tr>
                            <?php
                            $c++;
                            }
                            ?>
                            </tbody>
                        </table>
        				</div>
        			</div>
            	</div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function change_status(id){
    $.ajax({
    type:"post",
    url:"api/status.php",
    data:{id:id},
    success:function(data){
    $("#status"+id).html(data);
     }
  })
}
function change_bestseller(id){
    $.ajax({
    type:"post",
    url:"api/bestseller.php",
    data:{id:id},
    success:function(data){
    $("#bestseller"+id).html(data);
     }
  })
}
function change_featured(id){
    $.ajax({
    type:"post",
    url:"api/featured.php",
    data:{id:id},
    success:function(data){
    $("#featured"+id).html(data);
     }
  })
}
</script>
<?php include('footer.php'); ?>