<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<style type="text/css">
.sub_img{
width: 149px;
height: 90px;
}
</style>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title">Manage Product Review</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item">Product Review</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i>Product Review</div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="default-datatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl. Number</th>
                                    <th>Product Name</th>
                                    <th>Product Variant</th>
                                    <th>Customer Name</th>
                                    <th>Rating</th>
                                    <th>Comment</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $c=1;
                            $sql="SELECT * FROM review ORDER BY id DESC";
                            $queary=mysqli_query($conn,$sql);
                            while($row=mysqli_fetch_assoc($queary)){
                                $id = $row['id'];
                            ?>
                                <tr>
                                    <td><?=$c?></td>
                                    <td><?php
                                        $qty_id = $row['product_id'];
                                        $qty_res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `qty_per_unit` WHERE `qty_id` = '$qty_id'"));
                                        $product_id = $qty_res['product_id'];
                                        $product_res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `product` WHERE `product_id` = '$product_id'"));
                                        echo $product_res['product_name'];
                                    ?></td>
                                    <td><?=$qty_res['qtu_per_unit'].$qty_res['unit']?></td>
                                    <td><?php
                                        $cust_id = $row['user_id'];
                                        $cust_res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `users` WHERE `u_id` = '$cust_id'"));
                                        echo $cust_res['name'];
                                    ?></td>
                                    <td><?=$row['rating']?></td>
                                    <td><?=$row['comment']?></td>
                                    
                                    
                                    <td id="status<?=$id?>" class="text-center">
                                        <?php if($row['status']=='Y'){ ?>
                                            <button type="button" class="btn btn-success" onclick="change_status(<?=$id?>)">Active</button>
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-danger" onclick="change_status(<?=$id?>)">Deactive</button>
                                        <?php } ?>
                                           
                                            
                                        
                                    </td>
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
<?php include('footer.php'); ?>

<script>
function change_status(id){
    $.ajax({
        type:"post",
        url:"api/review_status.php",
        data:{id:id},
        success:function(data){
            $("#status"+id).html(data);
        }
  })
}
</script>
