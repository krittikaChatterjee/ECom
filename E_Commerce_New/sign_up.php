<?php 
include('header.php'); 
if(isset($_REQUEST['sign_up'])) {
    $fullname     = mysqli_real_escape_string($conn,$_REQUEST['fullname']);
    $emailaddress = mysqli_real_escape_string($conn,$_REQUEST['emailaddress']);
    $phone        = mysqli_real_escape_string($conn,$_REQUEST['phone']);
    $password     = mysqli_real_escape_string($conn,$_REQUEST['password']);
    
    $date = date("d-m-Y");
    $time = date("H:i:s");
    
    $check_query = mysqli_query($conn,"SELECT * FROM `users` WHERE `email` = '$emailaddress' OR `mobile` = '$phone'");
    
    if(mysqli_num_rows($check_query) > 0) {
        echo '<script>swal("Sorry", "This Credentials Already Exists!! Please try New !!", "info")</script>';
    }
    else {
        $inserSql = mysqli_query($conn,"INSERT INTO `users`(`name`, `email`, `password`, `mobile`, `register_date`, `time`, `status`) VALUES ('$fullname','$emailaddress','$password','$phone','$date','$time','Y')");   
    
        if($inserSql){
            echo '<script>swal("Success", "Registered Successfully", "success")</script>';
            echo "<script>setTimeout(function() {window.location='sign_in.php'}, 3000)</script>";
        }
    }
    
    
    
}
?>
<div class="sign-inup">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-5">
					<div class="sign-form">
						<div class="sign-inner">
							<div class="sign-logo" id="logo">
								<!--<a href="index-2.html"><img src="images/logo.svg" alt=""></a>-->
								<!--<a href="index-2.html"><img class="logo-inverse" src="images/dark-logo.svg" alt=""></a>-->
							</div>
							<div class="form-dt">
								<div class="form-inpts checout-address-step">
									<form method="post">
										<div class="form-title"><h6>Sign Up</h6></div>
										<div class="form-group pos_rel">
											<input id="fullname" name="fullname" type="text" placeholder="Full name" class="form-control lgn_input" required="" oninput="this.value=this.value.replace(/[^A-Z a-z]/g,'');">
											<i class="uil uil-user-circle lgn_icon"></i>
										</div>
										<div class="form-group pos_rel">
											<input id="emailaddress" name="emailaddress" type="email" placeholder="Email Address" class="form-control lgn_input" required="">
											<i class="uil uil-envelope lgn_icon"></i>
										</div>
										<div class="form-group pos_rel">
											<input id="phonenumber" name="phone" type="text" placeholder="Phone Number" class="form-control lgn_input" required="" oninput="this.value=this.value.replace(/[^0-9]/g,'');" maxlength="10">
											<i class="uil uil-mobile-android-alt lgn_icon"></i>
										</div>
										<!--<div class="form-group pos_rel">-->
										<!--	<label class="control-label">Enter Code</label>-->
										<!--	<ul class="code-alrt-inputs signup-code-list">-->
										<!--		<li>-->
										<!--			<input id="code[1]" name="number" type="text" placeholder="" class="form-control input-md" required="">-->
										<!--		</li>-->
										<!--		<li>-->
										<!--			<input id="code[2]" name="number" type="text" placeholder="" class="form-control input-md" required="">-->
										<!--		</li>-->
										<!--		<li>-->
										<!--			<input id="code[3]" name="number" type="text" placeholder="" class="form-control input-md" required="">-->
										<!--		</li>-->
										<!--		<li>-->
										<!--			<input id="code[4]" name="number" type="text" placeholder="" class="form-control input-md" required="">-->
										<!--		</li>-->
										<!--		<li>-->
										<!--			<a class="chck-btn hover-btn code-btn145"  href="#">Send</a>-->
										<!--		</li>-->
										<!--	</ul>-->
										<!--	<a href="#" class="resend-link">Resend Code</a>-->
										<!--</div>-->
										<div class="form-group pos_rel">
											<input id="password1" name="password" type="password" placeholder="New Password" class="form-control lgn_input" required="">
											<i class="uil uil-padlock lgn_icon"></i>
										</div>
										<button class="login-btn hover-btn" type="submit" name="sign_up">Sign Up Now</button>
									</form>
								</div>
								<div class="signup-link">
									<p>Do you have an account? - <a href="sign_in.php">Sign In Now</a></p>
								</div>
							</div>
						</div>
					</div>
					<div class="copyright-text text-center mt-3">
						<i class="uil uil-copyright"></i>Copyright 2020 <b>Gambolthemes</b> . All rights reserved
					</div>
				</div>
			</div>
		</div>
	</div>
			 <?php include('footer.php'); ?>