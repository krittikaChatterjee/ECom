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
      <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">User</h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item">User</li>
              <li class="breadcrumb-item active" aria-current="page">View User</li>
           </ol>
       </div>
      </div><!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i>Sub-Category</div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                    <tr>
                        <th>Sl. Number</th>
                        <th>Name</th>
                         <th>Email</th>
                         <th> Mobile</th>
                         <th> Address</th>
                         <th> Register Date</th>
                         <!--<th>Status</th>-->
                        <!-- <th>Edit</th>-->
                        <!--<th>Delete</th>-->
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    if(isset($_REQUEST['del']))
                    {
                      $del_id=base64_decode($_REQUEST['del']);
                      $d_query = mysqli_query($conn,"SELECT * FROM `sub_category` WHERE `sub_id`='$del_id'");  
                      $d_result = mysqli_fetch_assoc($d_query);
                      $_SESSION['del_img'] = "category_image/sub_category/".$d_result['cat_image'];
                      $delete_query=mysqli_query($conn,"DELETE FROM `sub_category` WHERE `sub_id`='$del_id'");
                      if($delete_query)
                      {
                        unlink($_SESSION['del_img']);
                        echo '<script>swal("Successful", "You have successfully deleted", "success")</script>';
                        echo "<script>
                                setTimeout(function() {
                                    window.location='manage_sub-category.php'
                                }, 3000);
                            </script>";
                      }
                    }
                    $c=1;
                    $sql="SELECT * FROM `users` ORDER BY u_id DESC";
                    $queary=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($queary))
                    {
                      $id=$row['sub_id'];
                      $catagory_id=$row['catagory_id'];
                      $category_name=$row['sub_name'];

                      $fetch_cat=mysqli_query($conn,"SELECT * FROM category WHERE cat_id='$catagory_id'");
                      $fetch_raw_cat=mysqli_fetch_assoc($fetch_cat);
                   
                  ?>
                    <tr>
                      <td><?php echo $c;  ?></td>
                      <td><?php echo $row['name'];  ?></td>
                      <td><?php echo $row['email'];  ?></td>
                      <td><?php echo $row['mobile'];  ?></td>
                      <td><?php echo $row['address'];  ?></td>
                      <td><?php echo $row['register_date'];  ?></td>
                      
                      
                      
                      <!--<td><img src="category_image/sub_category/<?=$row['sub_img'];?>" alt="" class="sub_img"></td>-->
                       <!--<td><?= $fetch_raw_cat['cat_name'];  ?></td>-->

                        <!--<?php 
                      if($row['status'] == 'Y')
                            {
                        ?>
                        <td><button type="button" class="btn btn-success status_<?=$row['sub_id']?>" onclick="change_status(<?=$row['sub_id']?>)">Approve</td>
                        <?php
                            }
                            else
                            {
                        ?>
                        <td><button type="button" class="btn btn-danger status_<?=$row['sub_id']?>" onclick="change_status(<?=$row['sub_id']?>)">Disapprove</td>
                        <?php
                            }
                        ?>-->
                        
                   
                      <!--<td><a href="edit_sub-category.php?i=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-edit"></i></td>-->
                      <!--<td><a href="manage_sub-category.php?del=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-trash"></i></td>-->
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
                         <th> Mobile</th>
                         <th> Address</th>
                         <th> Register Date</th>
                         <!--<th>Status</th>-->
                        <!--<th>Edit</th>-->
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
            url:"api/status_subcategory.php",
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