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
          <h4 class="page-title">Manage Retailer</h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item">Retailer</li>
              <li class="breadcrumb-item active" aria-current="page">Manage Retailer</li>
           </ol>
       </div>
      </div><!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Retailer</div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                    <tr>
                        <th>Sl. Number</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <!--<th>Edit</th>-->
                        <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    if(isset($_REQUEST['del']))
                    {
                      $del_id=base64_decode($_REQUEST['del']);
                      $delete_query=mysqli_query($conn,"DELETE FROM `retailers` WHERE `ret_id`='$del_id'");
                      if($delete_query)
                      {
          
                        echo '<script>swal("Successful", "You have successfully deleted", "success")</script>';
                        echo "<script>
                                setTimeout(function() {
                                    window.location='manage_retailer.php'
                                }, 3000);
                            </script>";
                      }
                      else
                      {
                          echo '<script>swal("Sorry!!", "Something went wrong", "error")</script>';
                      }
                    }
                    $c=1;
                    $sql="SELECT * FROM retailers ORDER BY ret_id DESC";
                    $queary=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($queary))
                    {
                      $id=$row['ret_id'];
                      $name=$row['name'];
                      $email=$row['email'];
                   
                  ?>
                    <tr>
                      <td><?php echo $c;  ?></td>
                      <td><?php echo $name;  ?></td>
                      <td><?php echo $email;  ?></td>
                  
                      <?php 
                      if($row['status'] == 'Y')
                            {
                        ?>
                        <td><button type="button" class="btn btn-success status_<?=$row['ret_id']?>" onclick="change_status(<?=$row['ret_id']?>)">Active</td>
                        <?php
                            }
                            else
                            {
                        ?>
                        <td><button type="button" class="btn btn-danger status_<?=$row['ret_id']?>" onclick="change_status(<?=$row['ret_id']?>)">Deactive</td>
                        <?php
                            }
                        ?>
                   
                      <!--<td><a href="edit_brand.php?i=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-edit"></i></td>-->
                      <td><a href="manage_retailer.php?del=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-trash"></i></td>
                    </tr>
                  <?php
                      $c++;
                    }

                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                     <th>Sl. Number</th>
                        <th>Name</th>
                        <th>Email</th>
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
        //   alert(id);exit;
        $.ajax({
            type:"post",
            url:"api/retailer_Status.php",
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
                    $(".status_"+id).html('Active');
                    $(".status_"+id).css('background-color','#15ca20');
                    $(".status_"+id).css('border','1px solid #15ca20');
                }
                else if(jsonObj.status == 'in')
                {
                    $(".status_"+id).html('Deactive');
                    $(".status_"+id).css('background-color','#bd2130');
                    $(".status_"+id).css('border','1px solid #bd2130');
                }
            }
        })
      }

  </script>
<?php include('footer.php'); ?>