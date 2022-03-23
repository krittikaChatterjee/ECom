<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">View Services</h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item">Services</li>
              <li class="breadcrumb-item active" aria-current="page">View Services</li>
           </ol>
       </div>
      </div><!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Services</div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                    <tr>
                        <th>Sl. Number</th>
                        <th>Name</th>
                        <th>Email </th>
                        <th>Mobile</th>
                         <th>Address</th>
                        <th>Services</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Image</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    if(isset($_REQUEST['de']))
                    {
                      $del_id=base64_decode($_REQUEST['de']);
                      $d_query = mysqli_query($conn,"DELETE FROM `coupon` WHERE `coupon_id`='$del_id'");  
                      //$d_result = mysqli_fetch_assoc($d_query);
                      
                      if($d_query)
                      {
                       
                        echo '<script>swal("Successful", "You have successfully deleted", "success")</script>';
                        
                      }
                    }
                    $c=1;
                    $sql="SELECT * FROM `service`";
                    $queary=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($queary))
                    {
                      $id=$row['coupon_id'];
                      $category_name=$row['cat_name'];
                   
                  ?>
                    <tr>
                      <td><?php echo $c;  ?></td>
                      <td><?php echo $row['name'];  ?></td>
                      <td><?php echo $row['email'];  ?></td>
                      <td><?php echo $row['mobile'];  ?></td>
                      <td><?php echo $row['address'];  ?></td>
                      <td><?php echo $row['service'];  ?></td>
                      <td><?php echo $row['description'];  ?></td>
                      <td><?php echo $row['quntity'];  ?></td>
                     <td><img src="app_api/service_img/<?php echo $row['image'];  ?>" alt="" class="img_posert" style="width:100px;height:100px">  </td>
                      



                      <!--<td><a href="edit_coupon.php?id=<?php echo $id; ?>"><i aria-hidden="true" class="fa fa-edit"></i></td>-->
                      <!--<td><a href="manage_coupon.php?de=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-trash"></i></td>-->
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
                        <th>Email </th>
                        <th>Mobile</th>
                         <th>Address</th>
                        <th>Services</th>
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