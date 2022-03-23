<?php 
include('header.php'); 

$user_details=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `users` WHERE `u_id`='$user_id'"));

if(isset($_REQUEST['submit'])){
    $address = mysqli_real_escape_string($conn,$_REQUEST['address']);
    
    $house_no    = mysqli_real_escape_string($conn,$_REQUEST['house_no']);
    $street_name = mysqli_real_escape_string($conn,$_REQUEST['street_name']);
    $landmark    = mysqli_real_escape_string($conn,$_REQUEST['landmark']);
    $state       = mysqli_real_escape_string($conn,$_REQUEST['state']);
    $city        = mysqli_real_escape_string($conn,$_REQUEST['city']);
    $pincode     = mysqli_real_escape_string($conn,$_REQUEST['pincode']);
    
    $updateQry = mysqli_query($conn,"UPDATE `users` SET `house_no`='$house_no',`street_name`='$street_name',`landmark`='$landmark',`state`='$state',`city`='$city',`pincode`='$pincode' WHERE `u_id`='$user_id'");
    
    if($updateQry){
        echo "<script>swal('Success','You Have Succesfully Changed Yor Address','success')</script>";
        echo "<script>setTimeout(function(){window.location='dashboard_my_addresses.php'}, 3000);</script>";
    }
}


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
	
		<div class="">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-4">
						<div class="left-side-tabs">
							<div class="dashboard-left-links">
        						<a href="dashboard_overview.php" class="user-item "><i class="uil uil-apps"></i>Overview</a>
        						<a href="dashboard_my_orders.php" class="user-item "><i class="uil uil-box"></i>My Orders</a>
        						<a href="dashboard_my_wishlist.php" class="user-item "><i class="uil uil-heart"></i>My Wishlist</a>
        						<a href="dashboard_my_addresses.php" class="user-item active"><i class="uil uil-location-point"></i>My Address</a>
        						<a href="logout.php" class="user-item"><i class="uil uil-exit"></i>Logout</a>
        					</div>
						</div>
					</div>
					<div class="col-lg-9 col-md-8">
						<div class="dashboard-right">
							<div class="row">
								<div class="col-md-12">
									<div class="main-title-tab">
										<h4><i class="uil uil-location-point"></i>My Address</h4>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="pdpt-bg">
										<div class="pdpt-title">
											<h4>Save New Address</h4>
										</div>
										<div class="ddsh-body">
										    	<form method="post">
										    	    <div class="form-group mt-1 row">
										    	        <div class="field col-md-3">
										    	            <label class="control-label">House No</label>
										    	            <input type="text" class="form-control" name="house_no" required placeholder="House No" value="<?=$user_details['house_no'];?>">
										    	        </div>
										    	        <div class="field col-md-6">
										    	            <label class="control-label">Street Name</label>
										    	            <input type="text" class="form-control" name="street_name" required placeholder="Street Name" value="<?=$user_details['street_name'];?>">
										    	        </div>
										    	        <div class="field col-md-3">
										    	            <label class="control-label">Landmark</label>
										    	            <input type="text" class="form-control" name="landmark" required placeholder="Landmark" value="<?=$user_details['landmark'];?>">
										    	        </div>
										    	        
										    	    </div>
										    	    
										    	    <div class="form-group mt-1 row">
										    	        <div class="field col-md-4">
										    	            <label class="control-label">State</label>
										    	            <select class="form-control" name="state" required id="state" onchange="fetch_city()">  
										    	                <option value="">--Choose--</option>
										    	                <?php
										    	                    $stateSql = mysqli_query($conn,"SELECT * FROM `states` WHERE `country_id` = '101'");
										    	                    while($stateRes = mysqli_fetch_assoc($stateSql)) {
										    	                        ?>
										    	                            <option <?= (($stateRes['id'] == $user_details['state']) ? 'selected' : '') ?>  value="<?=$stateRes['id'];?>"><?=$stateRes['name'];?></option>
										    	                        <?php
										    	                    }
										    	                ?>
										    	            </select>
										    	            
										    	            <!--<input type="text" class="form-control" name="state" required placeholder="City" value="<?//=$user_details['state'];?>">-->
										    	        </div>
										    	        <div class="field col-md-4">
										    	            <label class="control-label">City</label>
										    	            <?php
										    	                $userCity = $user_details['city'];
										    	                $cityRessaa = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `cities` WHERE `id` = '$userCity'"));
										    	            ?>
										    	            <select class="form-control" name="city" id="city" required> 
										    	                <option value="<?=$cityRessaa['id']?>"><?=$cityRessaa['name']?></option>
										    	            </select>
										    	        </div>
										    	        <div class="field col-md-4">
										    	            <label class="control-label">Pincode</label>
										    	            <input type="text" class="form-control" name="pincode" required placeholder="Pincode" value="<?=$user_details['pincode'];?>">
										    	        </div>
										    	    </div>
										    	    
                    								<!--<div class="form-group mt-1">	-->
                    								<!--	<div class="field">-->
                    								<!--		<label class="control-label">Address</label>-->
                    								<!--		<textarea rows="2" class="form-control" name="address" required><?//=$user_details['address'];?></textarea>-->
                    								<!--	</div>-->
                    								<!--</div>-->
                    								<button class="next-btn16 hover-btn mt-3" type="submit" name="submit" data-btntext-sending="Sending...">Save</button>
                    							</form>
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>	
			</div>	
		</div>	
	</div>
	
	
	
	
	
	
	
	
	

	
	
	
	
	
		<?php include('footer.php'); ?>
<script>
function fetch_city(){
    var state = $('#state').val();
    $.ajax({
       type: "post",
       url : "api/fetch_city.php",
       data : {state:state},
       success : function(res){
            $('#city').html(res);
       }
   });
    
    
}    
</script>













