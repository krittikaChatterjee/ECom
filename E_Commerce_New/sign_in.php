<?php 
session_start();
include('header.php'); 

if(isset($_REQUEST['login'])) {
    $phone    = mysqli_real_escape_string($conn,$_REQUEST['phone']);
    $password = mysqli_real_escape_string($conn,$_REQUEST['password']);
    
    $check_user = mysqli_query($conn, "SELECT * FROM `users` WHERE `mobile`='$phone' AND `password`='$password' AND status='Y'");
    
    $user_count = mysqli_num_rows($check_user);
    if($user_count == 0){
        echo '<script>swal("Sorry", "Invalid Credentials", "warning")</script>';
    }
    else{
        $user_fetch = mysqli_fetch_assoc($check_user);
        $user_id = $user_fetch['u_id'];
        $_SESSION['user'] = $user_id;
        echo '<script>swal("Success", "Login Successfully", "success")</script>';
        echo "<script>setTimeout(function() {window.location='index.php'}, 2000)</script>";
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
								<a href="index-2.html"><img src="images/logo.svg" alt=""></a>
								<a href="index-2.html"><img class="logo-inverse" src="images/dark-logo.svg" alt=""></a>
							</div>
							<div class="form-dt">
								<div class="form-inpts checout-address-step">
									<form method="post">
										<div class="form-title"><h6>Sign In</h6></div>
										<div class="form-group pos_rel">
											<input id="phonenumber" name="phone" type="text" placeholder="Enter Phone Number" class="form-control lgn_input" required="" oninput="this.value=this.value.replace(/[^0-9]/g,'');" maxlength="10">
											<i class="uil uil-mobile-android-alt lgn_icon"></i>
										</div>
										<div class="form-group pos_rel">
											<input id="password1" name="password" type="password" placeholder="Enter Password" class="form-control lgn_input" required="">
											<i class="uil uil-padlock lgn_icon"></i>
										</div>
										<button class="login-btn hover-btn" name="login" type="submit">Sign In Now</button>
									</form>
								</div>
								<!--<div class="password-forgor">-->
								<!--	<a href="forgot_password.html">Forgot Password?</a>-->
								<!--</div>-->
								<div class="signup-link">
									<p>Don't have an account? - <a href="sign_up.php">Sign Up Now</a></p>
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