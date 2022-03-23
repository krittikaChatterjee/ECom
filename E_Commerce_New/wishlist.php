<?php include('header.php'); ?>
			<div class="wrapper">
		<div class="gambo-Breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">User Dashboard</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="dashboard-group">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="user-dt">
							<div class="user-img">
								<img src="images/avatar/img-5.jpg" alt="">
								<div class="img-add">													
									<input type="file" id="file">
									<label for="file"><i class="uil uil-camera-plus"></i></label>
								</div>
							</div>
							<h4>Johe Doe</h4>
							<p>+91999999999<a href="#"><i class="uil uil-edit"></i></a></p>
							<div class="earn-points"><img src="images/Dollar.svg" alt="">Points : <span>20</span></div>
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
								<a href="dashboard_overview.html" class="user-item"><i class="uil uil-apps"></i>Overview</a>
								<a href="dashboard_my_orders.html" class="user-item"><i class="uil uil-box"></i>My Orders</a>
								<a href="dashboard_my_rewards.html" class="user-item"><i class="uil uil-gift"></i>My Rewards</a>
								<a href="dashboard_my_wallet.html" class="user-item"><i class="uil uil-wallet"></i>My Wallet</a>
								<a href="dashboard_my_wishlist.html" class="user-item active"><i class="uil uil-heart"></i>Shopping Wishlist</a>
								<a href="dashboard_my_addresses.html" class="user-item"><i class="uil uil-location-point"></i>My Address</a>
								<a href="sign_in.html" class="user-item"><i class="uil uil-exit"></i>Logout</a>
							</div>
						</div>
					</div>
					<div class="col-lg-9 col-md-8">
						<div class="dashboard-right">
							<div class="row">
								<div class="col-md-12">
									<div class="main-title-tab">
										<h4><i class="uil uil-heart"></i>Shopping Wishlist</h4>
									</div>
								</div>								
								<div class="col-lg-12 col-md-12">
									<div class="pdpt-bg">
										<div class="wishlist-body-dtt">
											<div class="cart-item">
												<div class="cart-product-img">
													<img src="images/product/img-11.jpg" alt="">
													<div class="offer-badge">4% OFF</div>
												</div>
												<div class="cart-text">
													<h4>Product Title Here</h4>
													<div class="cart-item-price">$15 <span>$18</span></div>
													<button type="button" class="cart-close-btn"><i class="uil uil-trash-alt"></i></button>
												</div>		
											</div>
											<div class="cart-item">
												<div class="cart-product-img">
													<img src="images/product/img-2.jpg" alt="">
													<div class="offer-badge">1% OFF</div>
												</div>
												<div class="cart-text">
													<h4>Product Title Here</h4>
													<div class="cart-item-price">$9.9 <span>$10</span></div>
													<button type="button" class="cart-close-btn"><i class="uil uil-trash-alt"></i></button>
												</div>		
											</div>
											<div class="cart-item">
												<div class="cart-product-img">
													<img src="images/product/img-14.jpg" alt="">
												</div>
												<div class="cart-text">
													<h4>Product Title Here</h4>
													<div class="cart-item-price">$12</div>
													<button type="button" class="cart-close-btn"><i class="uil uil-trash-alt"></i></button>
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
		</div>	
	</div>
		 <?php include('footer.php'); ?>