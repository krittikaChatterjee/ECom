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
          <h4 class="page-title">View Statement Vendor</h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item">Farmer & Vendor</li>
              <li class="breadcrumb-item active" aria-current="page">View Statement Vendor</li>
           </ol>
       </div>
      </div><!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> View Statement Vendor</div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                    <tr>
                        <th>Sl.Number</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                         <!--<th>Total Balance</th>-->
                        <!--<th>Credit Balance</th>-->
                        <th>Register Date</th>
                         <th>Edit Details</th>
                        <th>Status</th>
                        <th>View Product</th>
                        <!--<th>Payment</th>-->
                        <th>Delete</th>
                        
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                      $c=1;
                      $total_price="";
                      $amount="";
                    $sql="SELECT * FROM farmer_vendor WHERE type_of_user='VENDOR'  ORDER BY id DESC";
                    $queary=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($queary))
                    {
                        
                            /*$chk_amountsql=mysqli_query($conn,"SELECT * FROM farmer_vendor_product WHERE farmerORvendor_id='".$row['id']."' AND price_request='ACCEPT'");
                            while($xhkuser_amount=mysqli_fetch_assoc($chk_amountsql)){
                                $total_price +=$xhkuser_amount['total_price'];
                                
                            }
                            if($total_price==''){
                                $total_price='00.00';
                            }
                    */
                    
                             
                            /*$chk_amountsql1=mysqli_query($conn,"SELECT * FROM paid_balance WHERE farmerORvendor_id='".$row['id']."'");
                            while($xhkuser_amount1=mysqli_fetch_assoc($chk_amountsql1)){
                                $amount +=$xhkuser_amount1['amount'];
                                
                            }
                             if($amount ==''){
                                 $amount='00.00';
                             }*/
                  ?>
                    <tr id="rmv<?=$row['id']?>">
                      <td><?php echo $c;  ?></td>
                      <td><?php echo $row['name'];  ?></td>
                      <td><?= $row['email']; ?></td>
                      <td><?= $row['mobile']; ?></td>
                      <!--<td><?= $total_price; ?></td>-->
                      <!--<td><?= $amount; ?></td>-->
                      <td><?= $row['date'];; ?></td>
                      <td><a href="edit_vendor.php?id=<?=base64_encode($row['id'])?>"  data-whatever="@mdo" data-original-title="Edit"><i aria-hidden="true" class="fa fa-edit"></i></a>
                      <td> <?php if($row['status'] == 'Y'){ ?>
                         <div class="onoffswitch">
                                <input type="checkbox" onchange="active_inactive_product(<?php echo $row['id']; ?>)" id="myonoffswitch<?php echo $row['id']; ?>" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
                                <label class="onoffswitch-label" for="myonoffswitch<?php echo $row['id']; ?>">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>

                      <?php   } 
                         else
                         { ?>
                         <div class="onoffswitch">
                                <input type="checkbox" onchange="active_inactive_product(<?php echo $row['id']; ?>)" id="myonoffswitch<?php echo $row['id']; ?>" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" >
                                <label class="onoffswitch-label" for="myonoffswitch<?php echo $row['id']; ?>">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                         <?php } ?>
                       </td>
                      <td><a href="view-product_vendor.php?id=<?=$row['id']?>" class="btn btn-outline-info btn-sm">View</a></td>
                      <!--<td><a href="payment.php?id=<?=base64_encode($row['id'])?>"><i class="fa fa-inr" aria-hidden="true"></i>Pay</a></td>-->
                     
                      <td class="dltbtn" data-id="<?php echo $row['id'];  ?>"><a href="javascript:void(0)"><i aria-hidden="true" class="fa fa-trash"></i></a></td>



                   
                      
                    </tr>
                  <?php
                      $c++;
                    }
                    
                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                       <th>Sl.Number</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                         <!--<th>Total Balance</th>-->
                        <!--<th>Credit Balance</th>-->
                        <th>Register Date</th>
                         <th>Edit Details</th>
                        <th>Status</th>
                        <th>View Product</th>
                        <!--<th>Payment</th>-->
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
  
<?php include('footer.php'); ?>

<script>
     	 $(document).ready(function(){
            $(".dltbtn").click(function(){
                var id=$(this).attr('data-id');
                // alert(id);
                swal({
                      title: "Are you sure?",
                      text: "Once deleted, you will not be able to recover this imaginary file!",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                    })
                    .then((willDelete) => {
                      if (willDelete) {
                         $.ajax({
                                url:'api/delete-farmerORvendor-city.php',
                                type:'post',
                                data:{id:id},
                                success:function(data)
                                {
                                      swal("Success", "Successfully Deleted", "success");
                                      $("#rmv"+id).remove();
                                }
                            })
                      }
                      else
                      {
                        swal("Your file is safe!");
                      }
                    })
               
            })
        
        })
        
        function active_inactive_product(id){
   
             if(this.checked == true){
             var checkboxValue = $('#switch'+id).prop('checked');
             }
             else{
             var checkboxValue = $('#switch'+id).prop('checked');
             }
           $.ajax({
            type:"post",
            url:"api/farmarORvendor-status.php",
            data:{id:id},
            success:function(data)
            {
                
            }
        })
               

            }
</script>