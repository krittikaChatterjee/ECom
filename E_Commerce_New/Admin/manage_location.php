<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<style type="text/css">
	.img_posert{
    width: 177px;
    height: 90px;
}

</style>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Delivery Location </h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item">Delivery Location</li>
              <li class="breadcrumb-item active" aria-current="page">Delivery Location </li>
           </ol>
       </div>
      </div><!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i>Delivery  Location</div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                    <tr>
                        <th>Sl. Number</th>
                        <th>Pin</th>   
                        <!--<th>Location</th>-->  
                        <!--<th>COD Status</th>-->
                        <th>Status</th>
                        <!--<th>Express Status</th>-->
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    if(isset($_REQUEST['del_id']))
                    {
                      $del_id=base64_decode($_REQUEST['del_id']);
               
                      $delete_query=mysqli_query($conn,"DELETE FROM `nearest_point` WHERE `id`='$del_id'");
                      if($delete_query)
                      {
                   
                        echo '<script>swal("Successful", "You have successfully deleted", "success")</script>';
                        echo "<script>
                                setTimeout(function() {
                                    window.location='manage_location.php'
                                }, 3000);
                            </script>";
                      }
                      else
                      {
                          echo '<script>swal("Sorry!!", "Something Went Wrong", "error")</script>';
                            echo "<script>
                                setTimeout(function() {
                                    window.location='manage_location.php'
                                }, 3000);
                            </script>";
                      }
                    }
                    $c=1;
                    $sql="SELECT * FROM nearest_point ORDER BY id DESC";
                    $queary=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($queary))
                    {
                      $id=$row['id'];
                      $name=$row['name'];
                      $status=$row['status'];
                      $cash_status = $row['cash_status'];
                   
                  ?>
                    <tr>
                      <td><?php echo $c;  ?></td>
                      <td><?php echo $name;  ?></td>
                	  <!--<?php 
                    	if($cash_status == 'Y')
                            {
                      ?>
                        <td><button type="button" class="btn btn-success cod_status_<?=$row['id']?>" onclick="cod_change_status(<?=$row['id']?>)">Active</td>
                      <?php
                            }
                            else
                            {
                      ?>
                        <td><button type="button" class="btn btn-danger cod_status_<?=$row['id']?>" onclick="cod_change_status(<?=$row['id']?>)">Deactive</td>
                      <?php
                            }
                      ?>
                        -->
                      <?php 
                      if($row['status'] == 'Y')
                            {
                        ?>
                        <td><button type="button" class="btn btn-success status_<?=$row['id']?>" onclick="change_status(<?=$row['id']?>)">Active</td>
                        <?php
                            }
                            else
                            {
                        ?>
                        <td><button type="button" class="btn btn-danger status_<?=$row['id']?>" onclick="change_status(<?=$row['id']?>)">Deactive</td>
                        <?php
                            }
                        ?>
                        
                       <!-- <?php
                      if($row['exp_status'] == 'Y'){
                      ?>
                      <td><button type="button" class="btn btn-success statuspro_<?=$row['id']?>" onclick="change_exp(<?=$row['id']?>)">Approve</button></td>

                      <?php } else { ?>

                      	<td><button type="button" class="btn btn-danger statuspro_<?=$row['id']?>" onclick="change_exp(<?=$row['id']?>)">Disapprove</button></td>

                      <?php } ?>-->
                   
                      <td><a href="edit_location.php?i=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-edit"></i></td>
                      <td><a href="manage_location.php?del_id=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-trash"></i></td>
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
                        <!--<th>Location</th>-->
                        <!--<th>COD Status</th>-->
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
        //   alert(id);
        $.ajax({
            type:"post",
            url:"api/pickup_location_status.php",
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
      
    function cod_change_status(id){
    	$.ajax({
    		type : 'post',
    		url: 'api/pin_code_cod_status.php',
    		data:{id:id},
    		beforeSend: function() {
                $(".cod_status_"+id).html('Processing...');
            },
            success:function(data)
            { 
                // alert(data);
                var jsonObj = JSON.parse(data);
                // alert(jsonObj.status);
                if(jsonObj.status == 'a')
                {
                    $(".cod_status_"+id).html('Active');
                    $(".cod_status_"+id).css('background-color','#15ca20');
                    $(".cod_status_"+id).css('border','1px solid #15ca20');
                }
                else if(jsonObj.status == 'in')
                {
                    $(".cod_status_"+id).html('Deactive');
                    $(".cod_status_"+id).css('background-color','#bd2130');
                    $(".cod_status_"+id).css('border','1px solid #bd2130');
                }
            }
    	})
    }
    function change_exp(id){
      	// alert(id);exit;
  		$.ajax({
  			url: "api/cng_exp_status_pin.php",
  			type: "post",
  			data : { id : id },

  			beforeSend:function(){
  				$(".statuspro_"+id).html('processing...');
  			},
  			success:function(data){

  				var jsonObj = JSON.parse(data);
  				if(jsonObj.status == 'a'){

  					$(".statuspro_"+id).html('Approve');
  					$(".statuspro_"+id).css('background-color','#15ca20');
  					$(".statuspro_"+id).css('border','1px solid #15ca20');

  				}else if(jsonObj.status == 'in'){

  					 $(".statuspro_"+id).html('Disapprove');
                    $(".statuspro_"+id).css('background-color','#bd2130');
                    $(".statuspro_"+id).css('border','1px solid #bd2130');

  				}


  			}
  		});

  	}

  </script>
<?php include('footer.php'); ?>