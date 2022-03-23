<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">User Order</h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item">Order</li>
              <li class="breadcrumb-item active" aria-current="page">User Order</li>
           </ol>
       </div>
      </div><!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> User Order</div>
            <div class="card-body">
              <div class="table-responsive">
              	<!--<div>
              		Filter By Status:
              		<select class="form-control col-lg-2" onchange="filter(this.value)">
              			<option value="All">All</option>
              			<option value="PLACED">PLACED</option>
              			<option value="PACKED">PACKED</option>
              			<option value="DISPATCHED">DISPATCHED</option>
              			<option value="DELIVERED">DELIVERED</option>
              			<option value="CANCELLED">CANCELLED</option>
              		</select>
              	</div>-->
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                    <tr>
                        <th>Sl. Number</th>
                        <th>Added By</th>
                        <th>Product Name</th>
                        <!--<th>User Name</th>-->
                        <!--<th>Product Name</th>-->
                        <th>Quentity</th>
                        <th>Product Price </th>
                        
                        
                        
                       
                    
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                 
                    $c=1;
                     $inv =  $_REQUEST['invo']; 
                      $fetch_product_id = "SELECT * FROM `ordered_product` WHERE invoice_no='$inv'";
                    // $sql="SELECT * FROM `order_list` WHERE `exp_status`='N' ORDER BY order_id DESC";
                    $queary=mysqli_query($conn,$fetch_product_id);
                    while($row=mysqli_fetch_assoc($queary))
                    {
                      
                      
                      // fetch user 
                      $fetch_user_name = "SELECT * FROM `users` WHERE u_id='".$row['user_id']."'";
                      $fetch_user_name_read = mysqli_query($conn,$fetch_user_name);
                      $row_user_name = mysqli_fetch_array($fetch_user_name_read);
                     
                   
                  ?>
                    <tr>
                      <td><?php echo $c;  ?></td>
                      <td><?php 
                      $added_by = $row['add_by']; 
                      if($added_by == 'Admin'){
                      	echo "Admin";
                      }else{
                      	$fetch_user_name = "SELECT * FROM `farmer_vendor` WHERE id='$added_by'";
                      $fetch_user_name_read = mysqli_query($conn,$fetch_user_name);
                      $row_user_name = mysqli_fetch_array($fetch_user_name_read);
                      	echo $row_user_name['name'];
                      }
                      ?></td>
                      <td><?php echo $row['product_name'];  ?></td>
                      <td><?php echo $row['product_quntity'];  ?></td>
                      <td><?php echo $row['product_price'];  ?></td>
                      
                          

                     
                      
                    </tr>
                  <?php
                      $c++;
                    }

                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Sl. Number</th>
                        <th>Added By</th>
                        <th>Product Name</th>
                        <!--<th>User Name</th>-->
                        <!--<th>Product Name</th>-->
                        <th>Quentity</th>
                        <th>Product Price </th>
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

  	/* function change_status(id)
      {
        //   alert(id);
          var stat=document.getElementById('order_type'+id).value;
        //   alert(stat);
        $.ajax({
            type:"post",
            url:"api/user_order_status.php",
            data:{id:id,stat:stat},
            success:function(data)
            { 
                
                var Value=JSON.parse(data);
                if(Value.msg=='Y')
                {
                    swal("Successfully", "Updated Status", "success");
                }
                else
                {
                    swal("Sorry!!", "Something Went Wrong", "error");
                }
          
            }
        })
      }*/
      
      function order_status_cng(id,user_id){
      	 var order_status = $("#order_status"+id).val();
      	 //alert(order_status);
      	 $.ajax({
            type:"post",
            url:"api/user_order_status_cng.php",
            data:{id:id,order_status:order_status,user_id:user_id},
            success:function(data)
            { 
                
                swal("Success!", "Order Status Change Successfully!", "success");
          
            }
        })
      	
      }
      
    function filter(val){
    	$.ajax({
            type:"post",
            url:"api/filter_order.php",
            data:{val:val,order_type:'Normal'},
            success:function(data){
            	$("#default-datatable").html(data);
            }
        })
    }
    
    function change_status_cancel(id,user_id){
      	// alert(id);exit;
  		$.ajax({
  			url: "api/cng_order_cancel_status.php",
  			type: "post",
  			data : { id : id,user_id:user_id },

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

  					 $(".statuspro_"+id).html('CANCELLED');
                    $(".statuspro_"+id).css('background-color','#bd2130');
                    $(".statuspro_"+id).css('border','1px solid #bd2130');

  				}


  			}
  		});

  	}

  </script>
<?php include('footer.php'); ?>