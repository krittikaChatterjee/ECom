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
          <h4 class="page-title">Static Banner </h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <!--<li class="breadcrumb-item">Poster</li>-->
              <li class="breadcrumb-item active" aria-current="page">Static Banner </li>
           </ol>
       </div>
      </div><!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Static Banner</div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="default-datatable" class="table table-bordered">
                  <thead>
                    <tr>
                        <th>Sl. Number</th>
                        <th>Banarr</th>   
                        <!--<th>Use For</th>   -->
                        <th>Edit</th>
                        <!--<th>Delete</th>-->
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    // if(isset($_REQUEST['del_id']))
                    // {
                    //   $del_id=base64_decode($_REQUEST['del_id']);
                    //   $d_query = mysqli_query($conn,"SELECT * FROM `poster` WHERE `poster_id`='$del_id'");  
                    //   $d_result = mysqli_fetch_assoc($d_query);
                    //   $_SESSION['del_img'] = "poster_image/".$d_result['name'];
                    //   $delete_query=mysqli_query($conn,"DELETE FROM `poster` WHERE `poster_id`='$del_id'");
                    //   if($delete_query)
                    //   {
                    //     unlink($_SESSION['del_img']);
                    //     echo '<script>swal("Successful", "You have successfully deleted", "success")</script>';
                    //     echo "<script>
                    //             setTimeout(function() {
                    //                 window.location='manage_poster.php'
                    //             }, 3000);
                    //         </script>";
                    //   }
                    // }
                    $c=1;
                    $sql="SELECT * FROM static_banar ORDER BY date DESC";
                    $queary=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($queary))
                    {
                      $id=$row['id'];
                      $poster=$row['image'];
                   
                  ?>
                    <tr>
                      <td><?php echo $c;  ?></td>
                      
                      <td><img src="static_banner/<?php echo $poster;  ?>" alt="" class="img_posert">  </td>

                     <!--<td><?php echo $row['use_for'];  ?></td>-->
                   
                      <td><a href="edit_static_banar2.php?i=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-edit"></i></td>
                      <!--<td><a href="manage_poster.php?del_id=<?php echo base64_encode($id); ?>"><i aria-hidden="true" class="fa fa-trash"></i></td>-->
                    </tr>
                  <?php
                      $c++;
                    }

                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Sl. Number</th>
                      <th>Banar</th>
                        <!--<th>Use For</th> -->
                        <th>Edit</th>
                    
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
          //alert(id);
        $.ajax({
            type:"post",
            url:"api/accept_posterStatus.php",
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