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
                <h4 class="page-title">Customer Contacts</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item">Customer Contacts</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i>Customer Contacts</div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="default-datatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl. Number</th>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Messege</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $c=1;
                            $sql="SELECT * FROM contact_enquiry ORDER BY id DESC";
                            $queary=mysqli_query($conn,$sql);
                            while($row=mysqli_fetch_assoc($queary)){
                            ?>
                                <tr>
                                    <td><?=$c?></td>
                                    <td><?=$row['name']?></td>
                                    <td><?=$row['email']?></td>
                                    <td><?=$row['subject']?></td>
                                    <td><?=$row['message']?></td>
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