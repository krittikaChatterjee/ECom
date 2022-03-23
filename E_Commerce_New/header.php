<?php
session_start();
$user_id = $_SESSION['user'];
include('connection.php');
date_default_timezone_set("Asia/Kolkata");
?>

<!DOCTYPE html>
<html lang="en">

	

<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">		
		<title>Organic Food Store</title>
		
		<!-- Favicon Icon -->
		<!--<link rel="icon" type="image/png" href="images/fav.png">-->
		
		<!-- Stylesheets -->
		<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
		<link href='vendor/unicons-2.0.1/css/unicons.css' rel='stylesheet'>
		<link href="css/style.css" rel="stylesheet">
		<link href="css/responsive.css" rel="stylesheet">
		<link href="css/night-mode.css" rel="stylesheet">
		
		<!-- Vendor Stylesheets -->
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
		<link href="vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="vendor/semantic/semantic.min.css">	
		
		<!--Sweet Alert-->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		
		
		
	</head>

<body>
	<!-- Share Icons Start-->
	<!--<div class="icon-bar">-->
	<!--  <a href="#" class="facebook" title="Share"><i class="fab fa-facebook-f"></i></a> -->
	<!--  <a href="#" class="twitter" title="Share"><i class="fab fa-twitter"></i></a> -->
	<!--  <a href="#" class="google" title="Share"><i class="fab fa-google"></i></a> -->
	<!--  <a href="#" class="linkedin" title="Share"><i class="fab fa-linkedin-in"></i></a>-->
	<!--  <a href="#" class="whatsapp" title="Share"><i class="fab fa-whatsapp"></i></a> -->
	<!--</div>-->
	<!-- Share Icons End-->
	<!-- Category Model Start-->
	<div id="category_model" class="header-cate-model main-gambo-model modal fade" tabindex="-1" role="dialog" aria-modal="false">
        <div class="modal-dialog category-area" role="document">
            <div class="category-area-inner">
                <div class="modal-header">
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
						<i class="uil uil-multiply"></i>
                    </button>
                </div>
                <div class="category-model-content modal-content"> 
					<div class="cate-header">
						<h4>Select Category</h4>
					</div>
                    <ul class="category-by-cat">
                        <?php
                        $categorySql = mysqli_query($conn,"SELECT * FROM `category`");
                        while($categoryRes = mysqli_fetch_assoc($categorySql)){
                        ?>
                            <li>
        						<a href="cat_product.php?id=<?=base64_encode($categoryRes['cat_id'])?>" class="single-cat-item">
            						<div class="icon">
            							<img src="Admin/category_image/<?=$categoryRes['cat_image']?>" alt="" style="height : 50px; width : 50px;"> 
            						</div>
            						<div class="text"> <?=$categoryRes['cat_name']?></div>
        						</a>
        					</li>
                        <?php
                        }
                        ?>
						
						<!--<li>-->
						<!--	<a href="#" class="single-cat-item">-->
						<!--		<div class="icon">-->
						<!--			<img src="images/category/icon-2.svg" alt="">-->
						<!--		</div>-->
						<!--		<div class="text"> Grocery & Staples </div>-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="single-cat-item">-->
						<!--		<div class="icon">-->
						<!--			<img src="images/category/icon-3.svg" alt="">-->
						<!--		</div>-->
						<!--		<div class="text"> Dairy & Eggs </div>-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="single-cat-item">-->
						<!--		<div class="icon">-->
						<!--			<img src="images/category/icon-4.svg" alt="">-->
						<!--		</div>-->
						<!--		<div class="text"> Beverages </div>-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="single-cat-item">-->
						<!--		<div class="icon">-->
						<!--			<img src="images/category/icon-5.svg" alt="">-->
						<!--		</div>-->
						<!--		<div class="text"> Snacks </div>-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="single-cat-item">-->
						<!--		<div class="icon">-->
						<!--			<img src="images/category/icon-6.svg" alt="">-->
						<!--		</div>-->
						<!--		<div class="text"> Home Care </div>-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="single-cat-item">-->
						<!--		<div class="icon">-->
						<!--			<img src="images/category/icon-7.svg" alt="">-->
						<!--		</div>-->
						<!--		<div class="text"> Noodles & Sauces </div>-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="single-cat-item">-->
						<!--		<div class="icon">-->
						<!--			<img src="images/category/icon-8.svg" alt="">-->
						<!--		</div>-->
						<!--		<div class="text"> Personal Care </div>-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="single-cat-item">-->
						<!--		<div class="icon">-->
						<!--			<img src="images/category/icon-9.svg" alt="">-->
						<!--		</div>-->
						<!--		<div class="text"> Pet Care </div>-->
						<!--	</a>-->
						<!--</li>-->
                    </ul>
					<a href="all_categories.php" class="morecate-btn"><i class="uil uil-apps"></i>More Categories</a>
                </div>
            </div>
        </div>
    </div>
	<!-- Category Model End-->
	<!-- Search Model Start-->
	<div id="search_model" class="header-cate-model main-gambo-model modal fade" tabindex="-1" role="dialog" aria-modal="false">
        <div class="modal-dialog search-ground-area" role="document">
            <div class="category-area-inner">
                <div class="modal-header">
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
						<i class="uil uil-multiply"></i>
                    </button>
                </div>
                <div class="category-model-content modal-content"> 
					<div class="search-header">
						<form action="#">
							<input type="search" placeholder="Search for products...">
							<button type="submit"><i class="uil uil-search"></i></button>
						</form>
					</div>
					<div class="search-by-cat">
                        <a href="#" class="single-cat">
                            <div class="icon">
								<img src="images/category/icon-1.svg" alt="">
                            </div>
                            <div class="text">
                                Fruits and Vegetables
                            </div>
                        </a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="images/category/icon-2.svg" alt="">
							</div>
							<div class="text"> Grocery & Staples </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="images/category/icon-3.svg" alt="">
							</div>
							<div class="text"> Dairy & Eggs </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="images/category/icon-4.svg" alt="">
							</div>
							<div class="text"> Beverages </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="images/category/icon-5.svg" alt="">
							</div>
							<div class="text"> Snacks </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="images/category/icon-6.svg" alt="">
							</div>
							<div class="text"> Home Care </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="images/category/icon-7.svg" alt="">
							</div>
							<div class="text"> Noodles & Sauces </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="images/category/icon-8.svg" alt="">
							</div>
							<div class="text"> Personal Care </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="images/category/icon-9.svg" alt="">
							</div>
							<div class="text"> Pet Care </div>
						</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- Search Model End-->
	<!-- Cart Sidebar Offset Start-->
	<?php 
	$cart_count=mysqli_query($conn,"SELECT * FROM add_cart WHERE user_id='$user_id'");
	$cart_rows=mysqli_num_rows($cart_count);
	?>
	<div class="bs-canvas bs-canvas-left position-fixed bg-cart h-100" id="modalcart">
		<div class="bs-canvas-header side-cart-header p-3 ">
			<div class="d-inline-block  main-cart-title">My Cart <span>(<?=$cart_rows?> Items)</span></div>
			<button type="button" class="bs-canvas-close close" aria-label="Close"><i class="uil uil-multiply"></i></button>
		</div> 
		<div class="bs-canvas-body">
			<!--<div class="cart-top-total">-->
				<!--<div class="cart-total-dil">-->
					<!--<h4>Gambo Super Market</h4>-->
					<!--<span>$34</span>-->
				<!--</div>-->
				<!--<div class="cart-total-dil pt-2">-->
					<!--<h4>Delivery Charges</h4>-->
					<!--<span>$1</span>-->
				<!--</div>-->
			<!--</div>-->
			<div class="side-cart-items">
			    <?php
			    $cart=mysqli_query($conn,"SELECT * FROM add_cart WHERE user_id='$user_id'");
			    while($cart_fetch=mysqli_fetch_assoc($cart)){
			    $qty_id=$cart_fetch['qty_id'];
			    $product_count=$cart_fetch['count'];
			    $cart_id=$cart_fetch['cart_id'];
			    
			    $quantity_per_unit=mysqli_query($conn,"SELECT * FROM qty_per_unit WHERE qty_id='$qty_id'");
			    $quantity_per_unit_fetch=mysqli_fetch_assoc($quantity_per_unit);
			    $product_id=$quantity_per_unit_fetch['product_id'];
			    $product_price=$quantity_per_unit_fetch['product_price'];
			    $discount_price=$quantity_per_unit_fetch['discount_price'];
			    $discount=$product_price-$discount_price;
			    $discount_percentage=(($discount*100)/$product_price);
			    
			    $product=mysqli_query($conn,"SELECT * FROM product WHERE product_id='$product_id'");
			    $product_fetch=mysqli_fetch_assoc($product);
			    $gst_percentage=$product_fetch['persentage_of'];
			    $selling_price=$discount_price+(($discount_price*$gst_percentage)/100);
			    ?>
				<div class="cart-item">
					<div class="cart-product-img">
						<img src="Admin/product_image/<?=$product_fetch['main_image']?>" height="90" width="90">
						<div class="offer-badge"><?=$discount_percentage?>% OFF</div>
					</div>
					<div class="cart-text">
						<h4><?=$product_fetch['product_name']?></h4>
						<div class="cart-radio">
							<ul class="kggrm-now">
								<li>
									<input type="radio" id="a1" name="cart1">
									<label for="a1"><?=$quantity_per_unit_fetch['qtu_per_unit']?> <?=$quantity_per_unit_fetch['unit']?></label>
								</li>
							</ul>
						</div>
						<div class="qty-group">
							<div class="quantity buttons_added">
								<input type="button" value="-" class="minus minus-btn" onclick="reduceQuantity(<?=$qty_id?>,<?=$user_id?>)">
								<input type="number" step="1" name="quantity" value="<?=$product_count?>" min="1" class="input-text qty text">
								<input type="button" value="+" class="plus plus-btn" onclick="addQuantity(<?=$qty_id?>,<?=$user_id?>)">
							</div>
							<div class="cart-item-price">$<?=$selling_price?> <span>$<?=$product_price?></span></div>
						</div>
						<button type="button" class="cart-close-btn"><i class="uil uil-multiply" onclick="cart_remove(<?=$cart_id?>,<?=$user_id?>)"></i></button>
					</div>
				</div>
				<?php } ?>
				<!--<div class="cart-item">-->
				<!--	<div class="cart-product-img">-->
				<!--		<img src="images/product/img-2.jpg" alt="">-->
				<!--		<div class="offer-badge">6% OFF</div>-->
				<!--	</div>-->
				<!--	<div class="cart-text">-->
				<!--		<h4>Product Title Here</h4>-->
				<!--		<div class="cart-radio">-->
				<!--			<ul class="kggrm-now">-->
				<!--				<li>-->
				<!--					<input type="radio" id="a5" name="cart2">-->
				<!--					<label for="a5">0.50</label>-->
				<!--				</li>-->
				<!--				<li>-->
				<!--					<input type="radio" id="a6" name="cart2">-->
				<!--					<label for="a6">1kg</label>-->
				<!--				</li>-->
				<!--				<li>-->
				<!--					<input type="radio" id="a7" name="cart2">-->
				<!--					<label for="a7">2kg</label>-->
				<!--				</li>-->
				<!--			</ul>-->
				<!--		</div>-->
				<!--		<div class="qty-group">-->
				<!--			<div class="quantity buttons_added">-->
				<!--				<input type="button" value="-" class="minus minus-btn">-->
				<!--				<input type="number" step="1" name="quantity" value="1" class="input-text qty text">-->
				<!--				<input type="button" value="+" class="plus plus-btn">-->
				<!--			</div>-->
				<!--			<div class="cart-item-price">$24 <span>$30</span></div>-->
				<!--		</div>	-->
				<!--		<button type="button" class="cart-close-btn"><i class="uil uil-multiply"></i></button>-->
				<!--	</div>-->
				<!--</div>-->
			</div>
		</div>
		<div class="bs-canvas-footer">
			<!--<div class="cart-total-dil saving-total ">-->
				<!--<h4>Total Saving</h4>-->
				<!--<span>$11</span>-->
			<!--</div>-->
			<!--<div class="main-total-cart">-->
				<!--<h2>Total</h2>-->
				<!--<span>$35</span>-->
			<!--</div>-->
			<div class="checkout-cart">
				<!--<a href="#" class="promo-code">Have a promocode?</a>-->
				<a href="cart.php" class="cart-checkout-btn hover-btn">Proceed to Cart</a>
				<a href="checkout.php" class="cart-checkout-btn hover-btn">Proceed to Checkout</a>
			</div>
		</div>
	</div>
	<!-- Cart Sidebar Offsetl End-->
	<!-- Header Start -->
	<header class="header clearfix">
		<div class="top-header-group">
			<div class="top-header">
				<div class="res_main_logo">
					<a href="index.php"><img src="images/570_organic-food-store-logo-1 - REVISED.png" alt=""></a>
				</div>
				<div class="main_logo" id="logo">
					<a href="index.php"><img src="images/570_organic-food-store-logo-1 - REVISED.png" alt=""></a>
					<a href="index.php"><img class="logo-inverse" src="images/570_organic-food-store-logo-1 - REVISED.png" alt=""></a>
				</div>
				<!--<div class="select_location">-->
				<!--	<div class="ui inline dropdown loc-title">-->
				<!--		<div class="text">-->
				<!--		  <i class="uil uil-location-point"></i>-->
				<!--		  Gurugram-->
				<!--		</div>-->
				<!--		<i class="uil uil-angle-down icon__14"></i>-->
				<!--		<div class="menu dropdown_loc">-->
				<!--			<div class="item channel_item">-->
				<!--				<i class="uil uil-location-point"></i>-->
				<!--				Gurugram-->
				<!--			</div>-->
				<!--			<div class="item channel_item">-->
				<!--				<i class="uil uil-location-point"></i>-->
				<!--				New Delhi-->
				<!--			</div>-->
				<!--			<div class="item channel_item">-->
				<!--				<i class="uil uil-location-point"></i>-->
				<!--				Bangaluru-->
				<!--			</div>-->
				<!--			<div class="item channel_item">-->
				<!--				<i class="uil uil-location-point"></i>-->
				<!--				Mumbai-->
				<!--			</div>-->
				<!--			<div class="item channel_item">-->
				<!--				<i class="uil uil-location-point"></i>-->
				<!--				Hyderabad-->
				<!--			</div>-->
				<!--			<div class="item channel_item">-->
				<!--				<i class="uil uil-location-point"></i>-->
				<!--				Kolkata-->
				<!--			</div>-->
				<!--			<div class="item channel_item">-->
				<!--				<i class="uil uil-location-point"></i>-->
				<!--				Ludhiana-->
				<!--			</div>-->
				<!--			<div class="item channel_item">-->
				<!--				<i class="uil uil-location-point"></i>-->
				<!--				Chandigrah-->
				<!--			</div>-->
				<!--		</div>-->
				<!--	</div>-->
				<!--</div>-->
				<div class="search120">
					<div class="ui search">
					  <div class="ui left icon input swdh10">
					      <form class="d-flex" method="post" action="search_page.php">
					          <input class="prompt srch10" name="search_name" type="text" placeholder="Search for products..">
    						  <button type="submit" name="srach" style="border: 1px solid #00000014;">
    						       <i class='uil uil-search-alt icon icon1'></i>
    						  </button>
					      </form>
    						
					  </div>
					</div>
				</div>
				<div class="header_right">
					<ul>
						<li>
							<a href="#" class="offer-link"><i class="uil uil-phone-alt"></i>1800-000-000</a>
						</li>
						<?php
						    if($user_id == ''){
						        ?>
						            <a href="sign_in.php" class="btn btn-primary" style="background-color : #F55D2C; border:none">Sign In</a>
						        <?php
						    } else {
						        ?>
						      
						<?php
                            $user_details_res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `users` WHERE `u_id` = '$user_id'"));
						?>     
						      
						        
						<li class="ui dropdown">
							<a href="#" class="opts_account">
							<?php if($user_details_res['image'] == ''){ ?>   
								<img src="images/avatar/img-5.jpg" alt="" id="header_image">
							 <?php } else { ?>
						        <img src="images/user_img/<?=$user_details_res['image']?>" alt="" id="header_image_dll">
					        <?php } ?>	
								
								
								
								<span class="user__name"><?=$user_details_res['name']?></span>
								<i class="uil uil-angle-down"></i>
							</a>
							<div class="menu dropdown_account">
								<div class="night_mode_switch__btn">
									<a href="#" id="night-mode" class="btn-night-mode">
										<i class="uil uil-moon"></i> Night mode
										<span class="btn-night-mode-switch">
											<span class="uk-switch-button"></span>
										</span>
									</a>
								</div>	
								<a href="dashboard_overview.php" class="item channel_item"><i class="uil uil-apps icon__1"></i>Dashbaord</a>								
								<a href="dashboard_my_orders.php" class="item channel_item"><i class="uil uil-box icon__1"></i>My Orders</a>
								<a href="dashboard_my_wishlist.php" class="item channel_item"><i class="uil uil-heart icon__1"></i>My Wishlist</a>
								<!--<a href="dashboard_my_wallet.html" class="item channel_item"><i class="uil uil-usd-circle icon__1"></i>My Wallet</a>-->
								<a href="dashboard_my_addresses.php" class="item channel_item"><i class="uil uil-location-point icon__1"></i>My Address</a>
								<!--<a href="offers.html" class="item channel_item"><i class="uil uil-gift icon__1"></i>Offers</a>-->
								<!--<a href="faq.html" class="item channel_item"><i class="uil uil-info-circle icon__1"></i>Faq</a>-->
								<a href="logout.php" class="item channel_item"><i class="uil uil-lock-alt icon__1"></i>Logout</a>
							</div>
						</li>          
                                						        
						        
						        
						        
						        
						        
						        <?php
						    }
						?>
						
					
					</ul>
				</div>
			</div>
		</div>
		<div class="sub-header-group">
			<div class="sub-header">
				<div class="ui dropdown">
					<a href="#" class="category_drop hover-btn" data-toggle="modal" data-target="#category_model" title="Categories"><i class="uil uil-apps"></i><span class="cate__icon">Select Category</span></a>
				</div>
				<nav class="navbar navbar-expand-lg navbar-light py-3">
					<div class="container-fluid">
						<button class="navbar-toggler menu_toggle_btn" type="button" data-target="#navbarSupportedContent"><i class="uil uil-bars"></i></button>
						<div class="collapse navbar-collapse d-flex flex-column flex-lg-row flex-xl-row justify-content-lg-end bg-dark1 p-3 p-lg-0 mt1-5 mt-lg-0 mobileMenu" id="navbarSupportedContent">
							<ul class="navbar-nav main_nav align-self-stretch">
								<li class="nav-item"><a href="index.php" class="nav-link" title="Home">Home</a></li>
								<li class="nav-item"><a href="about.php" class="nav-link" title="Contact">About Us</a></li>
								<li class="nav-item"><a href="privacy.php" class="nav-link" title="Contact">Privacy Policy</a></li>
								<li class="nav-item"><a href="termsCondition.php" class="nav-link" title="Contact">Terms & Conditions</a></li>
								<li class="nav-item"><a href="refndReturn.php" class="nav-link" title="Contact">Refund & Return Policy</a></li>
								<li class="nav-item"><a href="contact_us.php" class="nav-link" title="Contact">Contact Us</a></li>
							</ul>
						</div>
					</div>
				</nav>
				<div class="catey__icon">
					<a href="#" class="cate__btn" data-toggle="modal" data-target="#category_model" title="Categories"><i class="uil uil-apps"></i></a>
				</div>
				<?php
				if($user_id != ""){
				?>
				<div class="header_cart order-1" id="headercartcount">
					<a href="#" class="cart__btn hover-btn pull-bs-canvas-left" title="Cart"><i class="uil uil-shopping-cart-alt"></i><span>Cart</span><ins><?=$cart_rows?></ins><i class="uil uil-angle-down"></i></a>
				</div>
				<?php 
				}
				?>
				<div class="search__icon order-1">
					<a href="#" class="search__btn hover-btn" data-toggle="modal" data-target="#search_model" title="Search"><i class="uil uil-search"></i></a>
				</div>
			</div>
		</div>
	</header>
	<!-- Header End -->
<input type="hidden" class="user_idd" value="<?= $user_id; ?>">	
	<script>
	function addcart(qty_id,user_id){
	   // console.log('qty_id',qty_id);
	   // console.log('user_id',user_id);
	    var user_id= $('.user_idd').val();
	    if(user_id == ""){
	         swal("Sorry!!", "Please Login First", "warning");
            setTimeout(function(){window.location='sign_in.php'}, 3000);
            exit();
	    }
	    
	    $.ajax({
            type:"post",
            url:"api/addtocart.php",
            data:{qty_id:qty_id,user_id:user_id},
            success:function(data){
                swal("Success", "Item Successfully Added Into Cart", "success");
                $.ajax({
                    type:"post",
                    url:"api/headercartcount.php",
                    data:{user_id:user_id},
                    success:function(data){
                        $('#headercartcount').html(data);
                    }
                })
                $.ajax({
                    type:"post",
                    url:"api/modalcart.php",
                    data:{user_id:user_id},
                    success:function(data){
                        $('#modalcart').html(data);
                    }
                })
            }
        })
	}
	function addQuantity(qty_id,user_id){
	    $.ajax({
            type:"post",
            url:"api/addmore.php",
            data:{qty_id:qty_id,user_id:user_id},
            success:function(data){
                $.ajax({
                    type:"post",
                    url:"api/cart.php",
                    data:{user_id:user_id},
                    success:function(data){
                        $('#cart').html(data);
                    }
                })
            }
        })
	}
	function reduceQuantity(qty_id,user_id){
	    $.ajax({
            type:"post",
            url:"api/reducequantity.php",
            data:{qty_id:qty_id,user_id:user_id},
            success:function(data){
                $.ajax({
                    type:"post",
                    url:"api/cart.php",
                    data:{user_id:user_id},
                    success:function(data){
                        $('#cart').html(data);
                    }
                })
            }
        })
	}
	function cart_remove(cart_id,user_id){
	    $.ajax({
            type:"post",
            url:"api/removefromcart.php",
            data:{cart_id:cart_id},
            success:function(data){
                $.ajax({
                    type:"post",
                    url:"api/cart.php",
                    data:{user_id:user_id},
                    success:function(data){
                        $('#cart').html(data);
                    }
                })
                $.ajax({
                    type:"post",
                    url:"api/headercartcount.php",
                    data:{user_id:user_id},
                    success:function(data){
                        $('#headercartcount').html(data);
                    }
                })
                $.ajax({
                    type:"post",
                    url:"api/modalcart.php",
                    data:{user_id:user_id},
                    success:function(data){
                        $('#modalcart').html(data);
                    }
                })
            }
        })
	}
	function wishlist(qty_id,user_id){
	    var user_id= $('.user_idd').val();
	    if(user_id == ""){
	         swal("Sorry!!", "Please Login First", "warning");
            setTimeout(function(){window.location='sign_in.php'}, 3000);
            exit();
	    }
	    $.ajax({
            url: "api/wishlist.php",
            type: "POST",
            data: {qty_id:qty_id,user_id:user_id},
            dataType: "html",
            success: function(result){
                if(result==1){
                    swal("","Item Added Into Your Wishlist","success");
                }
                else if(result==2){
                    swal("","This Item Is Already In Your Wishlist","error");
                }
            }
        })
	}
	</script>