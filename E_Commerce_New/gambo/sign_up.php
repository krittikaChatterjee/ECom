	<?php include('header.php'); ?>
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
									<form>
										<div class="form-title"><h6>Sign Up</h6></div>
										<div class="form-group pos_rel">
											<input id="full[name]" name="fullname" type="text" placeholder="Full name" class="form-control lgn_input" required="">
											<i class="uil uil-user-circle lgn_icon"></i>
										</div>
										<div class="form-group pos_rel">
											<input id="email[address]" name="emailaddress" type="email" placeholder="Email Address" class="form-control lgn_input" required="">
											<i class="uil uil-envelope lgn_icon"></i>
										</div>
										<div class="form-group pos_rel">
											<input id="phone[number]" name="phone" type="text" placeholder="Phone Number" class="form-control lgn_input" required="">
											<i class="uil uil-mobile-android-alt lgn_icon"></i>
										</div>
										<div class="form-group pos_rel">
											<label class="control-label">Enter Code</label>
											<ul class="code-alrt-inputs signup-code-list">
												<li>
													<input id="code[1]" name="number" type="text" placeholder="" class="form-control input-md" required="">
												</li>
												<li>
													<input id="code[2]" name="number" type="text" placeholder="" class="form-control input-md" required="">
												</li>
												<li>
													<input id="code[3]" name="number" type="text" placeholder="" class="form-control input-md" required="">
												</li>
												<li>
													<input id="code[4]" name="number" type="text" placeholder="" class="form-control input-md" required="">
												</li>
												<li>
													<a class="chck-btn hover-btn code-btn145"  href="#">Send</a>
												</li>
											</ul>
											<a href="#" class="resend-link">Resend Code</a>
										</div>
										<div class="form-group pos_rel">
											<input id="password1" name="password1" type="password" placeholder="New Password" class="form-control lgn_input" required="">
											<i class="uil uil-padlock lgn_icon"></i>
										</div>
										<button class="login-btn hover-btn" type="submit">Sign Up Now</button>
									</form>
								</div>
								<div class="signup-link">
									<p>I have an account? - <a href="sign_in.html">Sign In Now</a></p>
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