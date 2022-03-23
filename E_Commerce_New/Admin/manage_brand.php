<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<style type="text/css">
.bnd_img{
	width:154px;
	height: 90px;
}
</style>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Manage Brand</h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item">Brand</li>
              <li class="breadcrumb-item active" aria-current="page">Manage Brand</li>
           </ol>
       </div>
      </div><!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Brand</div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                    <tr>
                        <th>Sl. Number</th>
                       <th>Brand Name</th>
                        <th>Brand Image</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    if(isset($_REQUEST['del']))
                    {
                      $del_id=base64_decode($_REQUEST['del']);
                      $d_query = mysqli_query($conn,"SELECT * FROM `brand` WHERE `b_id`='$del_id'");  
                      $d_result = mysqli_fetch_assoc($d_query);
                      $_SESSION['del_img'] = "brand_img/".$d_result['brand_img'];
                      $delete_query=mysqli_query($conn,"DELETE FROM `brand` WHERE `b_id`='$del_id'");
                      if($delete_query)
                      {
                        unlink($_SESSION['del_img']);
                        echo '<script>swal("Successful", "You have successfully deleted", "success")</script>';
                        echo "<script>
                                setTimeout(function() {
                                    window.location='manage_brand.php'
                                }, 3000);
                            </script>";
                      }
                    }
                    $c=1;
                    $sql="SELECT * FROM brand ORDER BY b_id DESC";
                    $queary=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($queary))
                    {
                      $id=$row['b_id'];
                      $category_name=$row['name'];
                   
                  ?>
                    <tr>
                      <td><?php echo $c;  ?></td>
                      <td><?php echo $category_name;  ?></td>
                      <td><img src="brand_img/<?=$row['brand_img'];?>" alt="" class="bnd_img"></td>
                      <?php 
                      if($row['status'] == 'Y')
                            {
                        ?>
                        <td><button type="button" class="btn btn-success status_<?=$row['b_id']?>" onclick="change_status(<?=$row['b_id']?>)">Approve</td>
                        <?php
                            }
                            else
                            {
                        ?>
                        <td><button type="button" class="btn btn-danger status_<?=$row['b_id']?>" onclick="change_status(<?=$row['b_id']?>)">Disapprove</td>
                        <?php
                            }
                        ?>
                   
                      <td><a href="edit_brand.php?i=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-edit"></i></td>
                      <td><a href="manage_brand.php?del=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-trash"></i></td>
                    </tr>
                  <?php
                      $c++;
                    }

                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Sl. Number</th>
                      <th>Brand Name</th>
                        <th>Brand Image</th>
                        <th>Status</th>
                      <th>Edit</th>
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
          //alert(id);
        $.ajax({
            type:"post",
            url:"api/accept_brandStatus.php",
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