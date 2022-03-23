<?php 
include('header.php'); 

$user_details=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `users` WHERE `u_id`='$user_id'"));

?>
	<div class="wrapper">
		<!--<div class="gambo-Breadcrumb">-->
		<!--	<div class="container">-->
		<!--		<div class="row">-->
		<!--			<div class="col-md-12">-->
		<!--				<nav aria-label="breadcrumb">-->
		<!--					<ol class="breadcrumb">-->
		<!--						<li class="breadcrumb-item"><a href="index.php">Home</a></li>-->
		<!--						<li class="breadcrumb-item active" aria-current="page">User Dashboard</li>-->
		<!--					</ol>-->
		<!--				</nav>-->
		<!--			</div>-->
		<!--		</div>-->
		<!--	</div>-->
		<!--</div>-->
		<div class="dashboard-group">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="user-dt">
							<div class="user-img">
							    <?php if($user_details['image'] == ''){ ?>       
							    <img src="images/avatar/img-5.jpg" alt="" id="firstImage">
							    <?php } else { ?>
							    <img src="images/user_img/<?=$user_details['image']?>" alt="" id="changedImage">
						        <?php } ?>
								
								<div class="img-add">													
									<input type="file" name="user_img" id="file" onchange="changeImage()">
									<label for="file"><i class="uil uil-camera-plus"></i></label>
								</div>
							</div>
							<h4><?=$user_details ['name']?></h4>
							<p><?=$user_details ['email']?></p>
							<div class="earn-points">
							    <i class="fa fa-phone-square fa-lg" aria-hidden="true" style="transform: rotate(90deg);"></i><?=$user_details ['mobile']?>
							    <span>
						            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#abcModal">
                                      <a href="javascript:void(0);"><i class="uil uil-edit fa-lg"></i></a>
                                    </button>
							    </span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
		<div class="">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-4">
						<div class="left-side-tabs">
							<div class="dashboard-left-links">
								<a href="dashboard_overview.php" class="user-item active"><i class="uil uil-apps"></i>Overview</a>
								<a href="dashboard_my_orders.php" class="user-item"><i class="uil uil-box"></i>My Orders</a>
								<a href="dashboard_my_wishlist.php" class="user-item"><i class="uil uil-heart"></i>My Wishlist</a>
								<a href="dashboard_my_addresses.php" class="user-item"><i class="uil uil-location-point"></i>My Address</a>
								<a href="logout.php" class="user-item"><i class="uil uil-exit"></i>Logout</a>
							</div>
						</div>
					</div>
					<div class="col-lg-9 col-md-8">
						<div class="dashboard-right">
							<div class="row">
								<div class="col-md-12">
									<div class="main-title-tab">
										<h4><i class="uil uil-apps"></i>Overview</h4>
									</div>
									<div class="welcome-text">
										<h2>Hi! <?php 
										            $firstName = explode(" ",$user_details['name']);
										            echo $firstName[0];
										        ?></h2>
									</div>
								</div>
								<div class="col-lg-6 col-md-12">
									<div class="pdpt-bg">
										<div class="pdpt-title">
											<h4>My Address</h4>
										</div>
										<div class="ddsh-body">
											<h2><?=$user_details['address']?></h2>
											<!--<ul>-->
											<!--	<li>-->
											<!--		<a href="#" class="small-reward-dt hover-btn">Won &#8377;2</a>-->
											<!--	</li>-->
											<!--	<li>-->
											<!--		<a href="#" class="small-reward-dt hover-btn">Won 40% Off</a>-->
											<!--	</li>-->
											<!--	<li>-->
											<!--		<a href="#" class="small-reward-dt hover-btn">Caskback &#8377;1</a>-->
											<!--	</li>-->
											<!--	<li>-->
											<!--		<a href="#" class="rewards-link5">+More</a>-->
											<!--	</li>-->
											<!--</ul>-->
										</div>
										<a href="dashboard_my_addresses.php" class="more-link14">Address and Details <i class="uil uil-angle-double-right"></i></a>
									</div>
								</div>
								<div class="col-lg-6 col-md-12">
									<div class="pdpt-bg">
										<div class="pdpt-title">
											<h4>My Orders</h4>
										</div>
										<div class="ddsh-body">
										    <?php
										    $cart=mysqli_query($conn,"SELECT * FROM order_list WHERE user_id='$user_id'");
										    $rows=mysqli_num_rows($cart);
										    ?>
											<h2><?=$rows?> Purchases</h2>
										</div>
										<a href="dashboard_my_orders.php" class="more-link14">All Orders <i class="uil uil-angle-double-right"></i></a>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>	
			</div>	
		</div>	
	</div>
	
	
	
	
	
	
	
	
	
	<!-- Modal -->
<div class="modal fade" id="abcModal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change Your Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!--<form method="POST">-->
      <div class="modal-body">          
        <div class="col-md-12">
            <label>Enter Name</label>
            <input type="text" id="name" class="form-control" placeholder="Name" value="<?=$user_details['name']?>" required oninput="this.value=this.value.replace(/[^A-Za-z ]/g,'');">
        </div>
        <div class="col-md-12">
            <label>Enter Email</label>
            <input type="email" id="email" class="form-control" placeholder="Email" value="<?=$user_details['email']?>" required>
        </div>
        <div class="col-md-12">
            <label>Enter Phone</label>
            <input type="text" id="phone" class="form-control" placeholder="Phone" value="<?=$user_details['mobile']?>" required oninput="this.value=this.value.replace(/[^0-9]/g,'');" maxlength="10">
        </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button"  id="save_changes" class="btn btn-primary" onclick="save_changes()" >Save changes</button>
        <!--<input type="button"  id="save_changes" class="btn btn-primary" onclick="save_changes()" >Save changes</button>-->
      </div>
      <!--</form>-->
    </div>
  </div>
</div>
	

	
	
	
	
	
		<?php include('footer.php'); ?>
<!--image change api		-->
<script>
    function changeImage() {
        var fd = new FormData();
        var files = $('#file')[0].files;
        if(files.length > 0 ){
           fd.append('file',files[0]);
           
           $.ajax({
                url: 'api/upload.php',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response){
                if(response) {
                    var res = "images/user_img/"+response;
                    $('#header_image').attr('src', res);
                    $('#header_image_dll').attr('src', res);
                    $('#changedImage').attr('src', res);
                    $('#firstImage').attr('src', res);
                }
              },
           });
        } else{
           alert("Please select a file.");
        }
        
    }
// modal api
function save_changes(){
    var name  = $('#name').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    
    $.ajax({
        type : "post",
        url  : "api/save_changes.php",
        data : { name : name, email : email, phone : phone },
        success : function (res){
            if(res == 'duplicate_value') {
                swal("Details Exist");
            } else if(res == true) {
                location.reload();
            } else {
                swal("Error");
            }
        }
    });
}
    
    
    
</script>













