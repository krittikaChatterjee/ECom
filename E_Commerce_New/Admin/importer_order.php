<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Importer Order</h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item">Order</li>
              <li class="breadcrumb-item active" aria-current="page">Importer Order</li>
           </ol>
       </div>
      </div><!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Importer Order</div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                    <tr>
                        <th>Sl. Number</th>
                        <th>Product Name</th>
                        <th>Total Amount</th>
                        <th>Importer Email</th>
                        <th>Importer State</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Pickup Location</th>
                        <th>Status</th>
                        <th>View</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                 
                    $c=1;
                    $sql="SELECT * FROM order_list WHERE user_type='Importer' ORDER BY order_id DESC";
                    $queary=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($queary))
                    {
                        $delivery_type_id=$row['delivery_type_id'];
                        $loc_query=mysqli_query($conn,"SELECT * FROM nearest_point WHERE id='$delivery_type_id'");
                        $loc_fetch=mysqli_fetch_assoc($loc_query);
                        
                        $loc_name=$loc_fetch['name'];
                        $locc=$loc_fetch['location'];
                        $location=$loc_name.",".$locc;
                   
                    $idd=$row['order_id'];
                      $invoice_no=$row['invoice_no'];
                      
                      $product_name = $row['product_name'];
                      $product_price = $row['total_amount'];
                      $email = $row['email'];
                      $state = $row['state'];
                      $date=$row['date'];
                      $status=$row['status'];
                      $type=$row['delivery_type'];
                     
                   
                  ?>
                    <tr>
                      <td><?php echo $c;  ?></td>
                      <td><?php echo $product_name;  ?></td>
                      <td><?php echo $product_price;  ?></td>
                      <td><?php echo $email;  ?></td>
                      <td><?php echo $state;  ?></td>
                      <td><?php echo $date;  ?></td>
                      <td><?php echo $type; ?></td>
                      
                          <?php
                          if($loc_name!='')
                          {
                              ?>
                              <td><?php echo $location; ?></td>
                              <?php
                          }
                          else
                          {
                              ?>
                              <td>NULL</td>
                              <?php
                          }
                          ?>
                      
                      <td>
                          <select id="order_type<?php echo $idd; ?>" onchange=change_status(<?php echo $idd; ?>)>
                              <?php
                              if($status=='PENDING')
                              {
                                  ?>
                                   <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                   <option value="APPROVED">APPROVED</option>
                                   <option value="CANCELED">CANCELED</option>
                                    <option value="DISPATCHED">DISPATCHED</option>
                                   <option value="DELIVERED">DELIVERED</option>
                                  <?php
                              }
                                else if($status=='APPROVED')
                              {
                                 ?>
                                  <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                  <option value="PENDING">PENDING</option>
                                  <option value="CANCELED">CANCELED</option>
                                   <option value="DISPATCHED">DISPATCHED</option>
                                  <option value="DELIVERED">DELIVERED</option>
                                 <?php
                             }
                             else if($status=='CANCELED')
                             {
                                  ?>
                                  <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                  <option value="PENDING">PENDING</option>
                                  <option value="APPROVED">APPROVED</option>
                                   <option value="DISPATCHED">DISPATCHED</option>
                                  <option value="DELIVERED">DELIVERED</option>
                                  <?php
                             }
                             else if($status=='DISPATCHED')
                             {
                                 ?>
                                  <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                  <option value="PENDING">PENDING</option>
                                  <option value="APPROVED">APPROVED</option>
                                  <option value="CANCELED">CANCELED</option>
                                  <option value="DELIVERED">DELIVERED</option>
                                  <?php
                             }
                             else
                             {
                                   ?>
                                  <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                  <option value="PENDING">PENDING</option>
                                  <option value="APPROVED">APPROVED</option>
                                  <option value="CANCELED">CANCELED</option>
                                  <option value="DISPATCHED">DISPATCHED</option>
                                  
                                  <?php
                              }
                              ?>
                              
                          </select>
                      </td>

                      <td><a href="../invoice.php?id=<?php echo base64_encode($invoice_no); ?>" target="_blank"><i aria-hidden="true" class="fa fa-eye"></i></td>
                      
                    </tr>
                  <?php
                      $c++;
                    }

                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Sl. Number</th>
                        <th>Product Name</th>
                        <th>Total Amount</th>
                        <th>Importer Email</th>
                        <th>Importer State</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Pickup Location</th>
                         <th>Status</th>
                        <th>View</th>
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
      }

  </script>
<?php include('footer.php'); ?>