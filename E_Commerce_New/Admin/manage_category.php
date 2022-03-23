<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Manage Category</h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item">Category</li>
              <li class="breadcrumb-item active" aria-current="page">Manage Category</li>
           </ol>
       </div>
      </div><!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Category</div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                    <tr>
                        <th>Sl. Number</th>
                        <th>Category</th>
                        <!--<th>Status</th>
                        <th>Active Navbar</th>
                         <th>View Our Product</th>-->
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    if(isset($_REQUEST['de']))
                    {
                      $del_id=base64_decode($_REQUEST['de']);
                      $d_query = mysqli_query($conn,"SELECT * FROM `category` WHERE `cat_id`='$del_id'");  
                      $d_result = mysqli_fetch_assoc($d_query);
                      $_SESSION['del_img'] = "category_image/".$d_result['cat_image'];
                      $delete_query=mysqli_query($conn,"DELETE FROM `category` WHERE `cat_id`='$del_id'");
                      if($delete_query)
                      {
                        unlink($_SESSION['del_img']);
                        echo '<script>swal("Successful", "You have successfully deleted", "success")</script>';
                        echo "<script>
                                setTimeout(function() {
                                    window.location='manage_category.php'
                                }, 3000);
                            </script>";
                      }
                    }
                    $c=1;
                    $sql="SELECT * FROM category ORDER BY cat_id DESC";
                    $queary=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($queary))
                    {
                      $id=$row['cat_id'];
                      $category_name=$row['cat_name'];
                   
                  ?>
                    <tr>
                      <td><?php echo $c;  ?></td>
                      <td><?php echo $category_name;  ?></td>
                      <!--<?php
                        if($row['status'] == 'Y')
                        {
                      ?>
                      <td><button type="button" class="btn btn-success status_<?=$row['cat_id']?>" onclick="change_status(<?=$row['cat_id']?>)">Approve</button></td>

                      <?php     
                        }else{ 
                      ?>

                      	<td><button type="button" class="btn btn-danger status_<?=$row['cat_id']?>" onclick="change_status(<?=$row['cat_id']?>)">Disapprove</button></td>
                      <?php 
                        } 
                      ?>-->


                       <!--<?php
                          if($row['active_nav'] == 'Y')
                          {
                      ?>
                      <td><button type="button" class="btn btn-success statusnav_<?=$row['cat_id']?>" onclick="change_nav(<?=$row['cat_id']?>)">Active Navbar</button></td>

                      <?php 
                          }else{ 
                      ?>
                      	<td><button type="button" class="btn btn-danger statusnav_<?=$row['cat_id']?>" onclick="change_nav(<?=$row['cat_id']?>)">Deactivate Navbar</button></td>
                      <?php
                          } 
                      ?>-->


                      <!-- <?php
                      if($row['active_our'] == 'Y'){
                      ?>
                      <td><button type="button" class="btn btn-success statuspro_<?=$row['cat_id']?>" onclick="change_product(<?=$row['cat_id']?>)">Approve Our Products</button></td>

                      <?php } else { ?>

                      	<td><button type="button" class="btn btn-danger statuspro_<?=$row['cat_id']?>" onclick="change_product(<?=$row['cat_id']?>)">Disapprove  Our Products</button></td>

                      <?php } ?>-->



                      <td><a href="edit_category.php?id=<?php echo $id; ?>"><i aria-hidden="true" class="fa fa-edit"></i></td>
                      <td><a href="manage_category.php?de=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-trash"></i></td>
                    </tr>
                  <?php
                      $c++;
                    }

                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Sl. Number</th>
                      <th>Category</th>
                      <!--<th>Status</th>
                      <th>Active Navbar</th>
                      <th>View Our Product</th>-->
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
  	function change_status(id){
  		// alert(id);
  		$.ajax({
  			url: "api/change_category_staus.php",
  			type: "post",
  			data : { id : id },

  			beforeSend:function(){
  				$(".status_"+id).html('processing...');
  			},
  			success:function(data){

  				var jsonObj = JSON.parse(data);
  				if(jsonObj.status == 'a'){

  					$(".status_"+id).html('Approve');
  					$(".status_"+id).css('background-color','#15ca20');
  					$(".status_"+id).css('border','1px solid #15ca20');

  				}else if(jsonObj.status == 'in'){

  					 $(".status_"+id).html('Disapprove');
                    $(".status_"+id).css('background-color','#bd2130');
                    $(".status_"+id).css('border','1px solid #bd2130');

  				}


  			}
  		});
  	}

  	function change_nav(id){

  		$.ajax({
  			url: "api/change_nav_status.php",
  			type: "post",
  			data : { id : id },

  			beforeSend:function(){
  				$(".statusnav_"+id).html('processing...');
  			},
  			success:function(data){

  				var jsonObj = JSON.parse(data);
  				if(jsonObj.status == 'a'){

  					$(".statusnav_"+id).html('Active Navbar');
  					$(".statusnav_"+id).css('background-color','#15ca20');
  					$(".statusnav_"+id).css('border','1px solid #15ca20');

  				}else if(jsonObj.status == 'in'){

  					 $(".statusnav_"+id).html('Deactivate Navbar');
                    $(".statusnav_"+id).css('background-color','#bd2130');
                    $(".statusnav_"+id).css('border','1px solid #bd2130');

  				}


  			}
  		});

  	}

  	function change_product(id){
  		$.ajax({
  			url: "api/change_product_status.php",
  			type: "post",
  			data : { id : id },

  			beforeSend:function(){
  				$(".statuspro_"+id).html('processing...');
  			},
  			success:function(data){

  				var jsonObj = JSON.parse(data);
  				if(jsonObj.status == 'a'){

  					$(".statuspro_"+id).html('Approve Our Products');
  					$(".statuspro_"+id).css('background-color','#15ca20');
  					$(".statuspro_"+id).css('border','1px solid #15ca20');

  				}else if(jsonObj.status == 'in'){

  					 $(".statuspro_"+id).html('Disapprove Our Products');
                    $(".statuspro_"+id).css('background-color','#bd2130');
                    $(".statuspro_"+id).css('border','1px solid #bd2130');

  				}


  			}
  		});

  	}
  </script>
<?php include('footer.php'); ?>