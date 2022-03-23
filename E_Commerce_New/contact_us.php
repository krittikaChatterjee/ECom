	<?php include('header.php'); 
	if(isset($_REQUEST['submit'])){
	    $name = mysqli_real_escape_string($conn,$_REQUEST['name']);
	    $email = mysqli_real_escape_string($conn,$_REQUEST['email']);
	    $subject = mysqli_real_escape_string($conn,$_REQUEST['subject']);
	    $message = mysqli_real_escape_string($conn,$_REQUEST['message']);
	    $insert = mysqli_query($conn,"INSERT INTO contact_enquiry (`name`,`email`,`subject`,`message`) VALUES ('$name','$email','$subject','$message')");
	    echo '<script>swal("Success", "Thanks for sending us your query. We will get back to you!", "success")</script>';
	    echo "<script>setTimeout(function() {window.location='contact_us.php'}, 3000)</script>";
	}
	
	?>
    <div class="wrapper">
		<!--<div class="gambo-Breadcrumb">-->
		<!--	<div class="container">-->
		<!--		<div class="row">-->
		<!--			<div class="col-md-12">-->
		<!--				<nav aria-label="breadcrumb">-->
		<!--					<ol class="breadcrumb">-->
		<!--						<li class="breadcrumb-item"><a href="index-2.html">Home</a></li>-->
		<!--						<li class="breadcrumb-item active" aria-current="page">Contact Us</li>-->
		<!--					</ol>-->
		<!--				</nav>-->
		<!--			</div>-->
		<!--		</div>-->
		<!--	</div>-->
		<!--</div>-->
		<div class="all-product-grid">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="panel-group accordion" id="accordion0">
							<!--<div class="panel panel-default">-->
							<!--	<div class="panel-heading" id="headingOne">-->
							<!--		<div class="panel-title">-->
							<!--			<a class="collapsed" data-toggle="collapse" data-target="#collapseOne" href="#" aria-expanded="false" aria-controls="collapseOne">-->
							<!--				<i class="uil uil-location-point chck_icon"></i>Ludhiana-->
							<!--			</a>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--	<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion0" style="">-->
							<!--		<div class="panel-body">-->
							<!--			Ludhiana Head Office:<br>-->
							<!--			#0000, St No. 0, Lorem ipsum dolor sit amet, Main road, Ludhiana,  Punjab<br>-->
							<!--			Ludhiana- 141001<br>-->
							<!--			<div class="color-pink">Tel: 0000-000-000</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
							<!--<div class="panel panel-default">-->
							<!--	<div class="panel-heading" id="headingTwo">-->
							<!--		<div class="panel-title">-->
							<!--			<a class="collapsed" data-toggle="collapse" data-target="#collapseTwo" href="#" aria-expanded="false" aria-controls="collapseTwo">-->
							<!--				<i class="uil uil-location-point chck_icon"></i>Gurugram-->
							<!--			</a>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--	<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion0">-->
							<!--		<div class="panel-body">-->
							<!--			Gurugram Branch :<br>-->
							<!--			#0000, St No. 0, Lorem ipsum dolor sit amet, Main road, Gurugram,  Haryana<br>-->
							<!--			Gurugram- 141001<br>-->
							<!--			<div class="color-pink">Tel: 0000-000-000</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
							<!--<div class="panel panel-default">-->
							<!--	<div class="panel-heading" id="headingThree">-->
							<!--		 <div class="panel-title">-->
							<!--			<a class="collapsed" data-toggle="collapse" data-target="#collapseThree" href="#" aria-expanded="false" aria-controls="collapseThree">-->
							<!--				<i class="uil uil-location-point chck_icon"></i>New Delhi-->
							<!--			</a>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--	<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion0">-->
							<!--		<div class="panel-body">-->
							<!--			New Delhi Branch :<br>-->
							<!--			#0000, St No. 0, Lorem ipsum dolor sit amet, Main road, New Delhi<br>-->
							<!--			New Delhi- 141001<br>-->
							<!--			<div class="color-pink">Tel: 0000-000-000</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
							<!--<div class="panel panel-default">-->
							<!--	<div class="panel-heading" id="headingfour">-->
							<!--		<div class="panel-title">-->
							<!--			<a class="collapsed" data-toggle="collapse" data-target="#collapsefour" href="#" aria-expanded="false" aria-controls="collapsefour">-->
							<!--				<i class="uil uil-location-point chck_icon"></i>Bangaluru-->
							<!--			</a>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--	<div id="collapsefour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfour" data-parent="#accordion0">-->
							<!--		<div class="panel-body">-->
							<!--			Bangaluru Branch :<br>-->
							<!--			#0000, St No. 0, Lorem ipsum dolor sit amet, Main road, Bangaluru<br>-->
							<!--			Bangaluru- 141001<br>-->
							<!--			<div class="color-pink">Tel: 0000-000-000</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
							<!--<div class="panel panel-default">-->
							<!--	<div class="panel-heading" id="headingfive">-->
							<!--		<div class="panel-title">-->
							<!--			<a class="collapsed" data-toggle="collapse" data-target="#collapsefive" href="#" aria-expanded="false" aria-controls="collapsefive">-->
							<!--				<i class="uil uil-location-point chck_icon"></i>Mumbai-->
							<!--			</a>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--	<div id="collapsefive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfive" data-parent="#accordion0">-->
							<!--		<div class="panel-body">-->
							<!--			Mumbai Branch :<br>-->
							<!--			#0000, St No. 0, Lorem ipsum dolor sit amet, Main road, Mumbai<br>-->
							<!--			Mumbai- 141001<br>-->
							<!--			<div class="color-pink">Tel: 0000-000-000</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
							<!--<div class="panel panel-default">-->
							<!--	<div class="panel-heading" id="headingsix">-->
							<!--		<div class="panel-title">-->
							<!--			<a class="collapsed" data-toggle="collapse" data-target="#collapsesix" href="#" aria-expanded="false" aria-controls="collapsesix">-->
							<!--				<i class="uil uil-location-point chck_icon"></i>Hyderabad-->
							<!--			</a>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--	<div id="collapsesix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingsix" data-parent="#accordion0">-->
							<!--		<div class="panel-body">-->
							<!--			Hyderabad Branch :<br>-->
							<!--			#0000, St No. 0, Lorem ipsum dolor sit amet, Main road, Hyderabad<br>-->
							<!--			Hyderabad- 141001<br>-->
							<!--			<div class="color-pink">Tel: 0000-000-000</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
							<!--<div class="panel panel-default">-->
							<!--	<div class="panel-heading" id="headingseven">-->
							<!--		<div class="panel-title">-->
							<!--			<a class="collapsed" data-toggle="collapse" data-target="#collapseseven" href="#" aria-expanded="false" aria-controls="collapseseven">-->
							<!--				<i class="uil uil-location-point chck_icon"></i>Kolkata-->
							<!--			</a>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--	<div id="collapseseven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingseven" data-parent="#accordion0">-->
							<!--		<div class="panel-body">-->
							<!--			Kolkata Branch :<br>-->
							<!--			#0000, St No. 0, Lorem ipsum dolor sit amet, Main road, Kolkata<br>-->
							<!--			Kolkata- 141001<br>-->
							<!--			<div class="color-pink">Tel: 0000-000-000</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
							<!--<div class="panel panel-default">-->
							<!--	<div class="panel-heading" id="headingeight">-->
							<!--		<div class="panel-title">-->
							<!--			<a class="collapsed" data-toggle="collapse" data-target="#collapseeight" href="#" aria-expanded="false" aria-controls="collapseeight">-->
							<!--				<i class="uil uil-location-point chck_icon"></i>Chandigrah-->
							<!--			</a>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--	<div id="collapseeight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingeight" data-parent="#accordion0">-->
							<!--		<div class="panel-body">-->
							<!--			Chandigrah Branch :<br>-->
							<!--			#0000, St No. 0, Lorem ipsum dolor sit amet, Main road, Chandigrah<br>-->
							<!--			Chandigrah- 141001<br>-->
							<!--			<div class="color-pink">Tel: 0000-000-000</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>							-->
						</div>
					</div>
					<div class="col-lg-12 col-md-12">
						<div class="contact-title">
						    <?php
						        $fetch_contact_res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `contact_us_manage`"));
						    ?>
						    
							<h2 class="text-center"><?=$fetch_contact_res['heading'];?></h2>
							<p class="text-center"><?=$fetch_contact_res['sub_heading'];?></p>
						</div>
						<div class="contact-form">
							<form method="post">
								<div class="form-group mt-1">
									<label class="control-label">Full Name*</label>
									<div class="ui search focus">
										<div class="ui left icon input swdh11 swdh19">
										    <input class="prompt srch_explore" type="text" name="name" id="sendername" required placeholder="Your Full Name">	
										</div>
									</div>
								</div>
								<div class="form-group mt-1">
									<label class="control-label">Email Address*</label>
									<div class="ui search focus">
										<div class="ui left icon input swdh11 swdh19">
											<input class="prompt srch_explore" type="email" name="email" id="emailaddress" required placeholder="Your Email Address">															
										</div>
									</div>
								</div>
								<div class="form-group mt-1">
									<label class="control-label">Subject*</label>
									<div class="ui search focus">
										<div class="ui left icon input swdh11 swdh19">
											<input class="prompt srch_explore" type="text" name="subject" id="sendersubject" required placeholder="Subject">															
										</div>
									</div>
								</div>
								<div class="form-group mt-1">	
									<div class="field">
										<label class="control-label">Message*</label>
										<textarea rows="2" class="form-control" id="sendermessage" name="message" required placeholder="Write Message"></textarea>
									</div>
								</div>
								<button class="next-btn16 hover-btn mt-3" type="submit" name="submit" data-btntext-sending="Sending...">Submit Request</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<?php include('footer.php'); ?>