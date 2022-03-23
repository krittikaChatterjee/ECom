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
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                    <tr>
                        <th>Sl. Number</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Withdrawal Amount</th>
                        <th>Account Holder Name</th>
                        <th>Account Number</th>
                        <th>IFSC Code</th>
                        <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $c=1;
                        $query = mysqli_query($conn,"SELECT * FROM `withdraw_amount` ORDER BY `w_id` DESC");
                        while($result = mysqli_fetch_assoc($query)){
                            $user_query = mysqli_query($conn,"SELECT * FROM `users` WHERE `u_id`='".$result['user_id']."'");
                            $user_result  = mysqli_fetch_assoc($user_query);
                            
                            $bank_query = mysqli_query($conn,"SELECT * FROM `bank_details` WHERE `user_id`='".$result['user_id']."'");
                            $bank_result = mysqli_fetch_assoc($bank_query);
                    ?>
                    <tr>
                      <td><?=$c?></td>
                      <td><?=$user_result['name']?></td>
                      <td><?=$user_result['email']?></td>
                      <td><?=$result['amount']?></td>
                      <td><?=$bank_result['account_holder_name']?></td>
                      <td><?=$bank_result['account_no']?></td>
                      <td><?=$bank_result['ifsc_code']?></td>
                      <td id="stat_btn">
                      <?php
                            if($result['status']=='Y'){
                      ?>
                      <button class="btn btn-success">Success</button>
                      <?php
                            }else{
                      ?>
                      <button class="btn btn-danger" onclick="change_stat('<?=$result['w_id']?>','<?=$result['user_id']?>','<?=$result['withdraw_id']?>')">Pending...</button>
                      <?php
                            }
                      ?>
                      </td>
                      
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
                        <th>User Email</th>
                        <th>Withdrawal Amount</th>
                        <th>Account Holder Name</th>
                        <th>Account Number</th>
                        <th>IFSC Code</th>
                        <th>Status</th>
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
      
    function change_stat(id,u_id,wallet_id){
        // alert(id);
        $.ajax({
            url:"api/stat_withdraw_stat.php",
            type:"POST",
            data:{id:id,u_id:u_id,wallet_id:wallet_id},
            success:function(data){
                if(data==1){
                    $("#stat_btn").html('<button class="btn btn-success">Success</button>');
                }
            }
        })
    }

  </script>
<?php include('footer.php'); ?>