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
          <h4 class="page-title">User Reviews</h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item">User Reviews</li>
              <li class="breadcrumb-item active" aria-current="page">View Reviews</li>
           </ol>
       </div>
      </div><!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i>Reviews</div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                    <tr>
                        <th>Sl. Number</th>
                        <th>User Name</th>
                        <th>Product Name </th>
                         <th>Rating</th>
                         <th> Massage</th>
                         <th> Reply</th>
                         <!--<th> Address</th>
                         <th> Register Date</th>-->
                         <!--<th>Status</th>-->
                        <!-- <th>Edit</th>-->
                        <!--<th>Delete</th>-->
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
                    
                    $c=1;
                    $sql="SELECT * FROM `product_rating`";
                    $queary=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($queary))
                    {
                      $id=$row['sub_id'];
                      $catagory_id=$row['catagory_id'];
                      $category_name=$row['sub_name'];
                      $product_id=$row['product_id'];
                      $user_id=$row['user_id'];

                      $fetch_cat=mysqli_query($conn,"SELECT * FROM `product` WHERE product_id='$product_id'");
                      $fetch_raw_cat=mysqli_fetch_assoc($fetch_cat);
                      
                      $fetch_user=mysqli_query($conn,"SELECT * FROM `users` WHERE u_id='$user_id'");
                      $fetch_raw_user=mysqli_fetch_assoc($fetch_user);
                   
                  ?>
                    <tr>
                      <td><?php echo $c;  ?></td>
                      <td><?php echo $fetch_raw_user['name'];  ?></td>
                      <td><?php echo $fetch_raw_cat['product_name'];  ?></td>
                      <td><?php echo $row['rating'];  ?></td>
                      <td><?php echo $row['comment'];  ?></td>
                      <td><a href="review_reply.php?rating_id=<?=base64_encode($row['id'])?>" class="btn btn-success">Reply</a></td>
                      
                      
                      
                      
                     
                    </tr>
                  <?php
                      $c++;
                    }

                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                         <th>Sl. Number</th>
                         <th>User Name</th>
                        <th>Product Name </th>
                         <th>Rating</th>
                         <th> Massage</th>
                         <th> Reply</th>
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