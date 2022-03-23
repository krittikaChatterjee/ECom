<?php include('header.php'); ?>
<div class="wrapper">
	<div class="main-banner-slider">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="owl-carousel offers-banner owl-theme">
					    <?php
						$banner=mysqli_query($conn,"SELECT * FROM poster");
						while($banner_image=mysqli_fetch_assoc($banner)){
						?>
						<div class="item">
							<div class="offer-item">								
								<div class="offer-item-img">
									<div class="gambo-overlay"></div>
									<img src="Admin/poster_image/<?=$banner_image['name']?>" style="width:360px; height:200px;">
								</div>
								<div class="offer-text-dt">
									<div class="offer-top-text-banner">
										<!--<p>6% Off</p>-->
										<div class="top-text-1"><?=$banner_image['title'];?></div>
										<!--<span>Fresh Vegetables</span>-->
									</div>
									<a href="#" class="Offer-shop-btn hover-btn">Shop Now</a>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Offers End -->
	<!-- Categories Start -->
	<div class="section145">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="main-title-tt">
						<div class="main-title-left">
							<span>Shop By</span>
							<h2>Categories</h2>
						</div>
						<a href="all_categories.php" class="see-more-btn">See All</a>
					</div>
				</div>
				<div class="col-md-12">
					<div class="owl-carousel cate-slider owl-theme">
					    <?php
						$categorySql = mysqli_query($conn,"SELECT * FROM `category`");
						while($categoryRes = mysqli_fetch_assoc($categorySql)){
						?>
	                	<div class="item">
							<a href="cat_product.php?id=<?=base64_encode($categoryRes['cat_id'])?>" class="category-item">
								<div class="cate-img">
									<img src="Admin/category_image/<?=$categoryRes['cat_image']?>" alt="" style="height:50px; width:50px;">
								</div>
								<h4><?=$categoryRes['cat_name']?></h4>
							</a>
						</div>
			            <?php
			            }
			            ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Categories End -->
		<!-- Featured Products Start -->
		<div class="section145">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="main-title-tt">
							<div class="main-title-left">
								<span>For You</span>
								<h2>Top Featured Products</h2>
							</div>
							<a href="featured_product.php" class="see-more-btn">See All</a>
						</div>
					</div>
					<div class="col-md-12">
						<div class="owl-carousel featured-slider owl-theme">
						    <?php
						    $featre_qtyPerUnit_sql = mysqli_query($conn,"SELECT * FROM `qty_per_unit`");
						    while($featre_qtyPerUnit_res = mysqli_fetch_assoc($featre_qtyPerUnit_sql)){
						    $feature_product_id    = $featre_qtyPerUnit_res['product_id'];
						    $feature_product_price = $featre_qtyPerUnit_res['product_price'];
						    $feature_sell_price    = $featre_qtyPerUnit_res['discount_price'];
						    //  $feature_discount = $feature_product_price - $feature_sell_price;
						    //  $feature_discount_perc = ($feature_discount * 100)/$feature_product_price;
						    $quantity_id = $featre_qtyPerUnit_res['qty_id'];
						    $qty_id = $featre_qtyPerUnit_res['qty_id'];
						            
						    $fetured_product_sql = mysqli_query($conn,"SELECT * FROM `product` WHERE `product_id`='$feature_product_id' AND `status`='Y' AND `featured_product`='Y'");
						    while($fetured_product_res = mysqli_fetch_assoc($fetured_product_sql)){
						        $feature_gst_percentage = $fetured_product_res['persentage_of'];
						        $feature_total_price=$feature_sell_price+(($feature_sell_price*$feature_gst_percentage)/100);
						        
						        $feature_discount = $feature_product_price - $feature_total_price;
				                $feature_discount_perc = ($feature_discount * 100)/$feature_product_price;
        			            $feature_discount_perc = round($feature_discount_perc, 2);
						    ?>
						    <div class="item">
            				    <div class="product-item">
            					    <a href="single_product_view.php?id=<?=base64_encode($qty_id)?>" class="product-img">
                						<img src="Admin/product_image/<?=$fetured_product_res['main_image']?>" alt="" style="height:156px;">
                						<div class="product-absolute-options">
                							<span class="offer-badge-1"><?=$feature_discount_perc?>% off</span>
                							<?php
                							if($user_id != ''){
                							?>
                							<span class="like-icon" title="wishlist" onclick="wishlist(<?=$quantity_id?>,<?=$user_id?>)"></span>
                							<?php
                							}
                							?>
                						</div>
            						</a>
            						<div class="product-text-dt">
            						<?php
            						if($featre_qtyPerUnit_res['number_of_product'] == '0'){?> 
            						<p><span>Out Of Stock</span></p> <?php
            						} else { ?> 
            						<p>Available<span>(In Stock)</span></p> <?php
            						}
            						?>
            						    <h4><?=$fetured_product_res['product_name']?></h4>
            							<div class="product-price">&#8377;<?=$feature_total_price?> <span>&#8377;<?=$feature_product_price?></span></div>
        								<div class="qty-cart">
        									<button type="button" class="btn btn-primary" style="background-color:#F55D2C;border:none;" onclick="addcart(<?=$quantity_id?>,<?=$user_id?>)">Add to Cart</button>
        									<span class="text-primary" style="margin-left:60px;"><?=$featre_qtyPerUnit_res['qtu_per_unit'].$featre_qtyPerUnit_res['unit']?></span>
        								</div>
            						</div>
            					</div>
            				</div> 
						    <?php  
						        }
						    }
						    ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="section145">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="main-title-tt">
							<div class="main-title-left">
								<span>For You</span>
								<h2>Best Selling Products</h2>
							</div>
							<a href="best_selling_prods.php" class="see-more-btn">See All</a>
						</div>
					</div>
					<div class="col-md-12">
						<div class="owl-carousel featured-slider owl-theme">
						    <?php
						    $best_sell_qtyPerUnit_sql = mysqli_query($conn,"SELECT * FROM `qty_per_unit`");
						    while($best_sell_qtyPerUnit_res = mysqli_fetch_assoc($best_sell_qtyPerUnit_sql)){
						    $best_sell_product_id    = $best_sell_qtyPerUnit_res['product_id'];
						    $best_sell_product_price = $best_sell_qtyPerUnit_res['product_price'];
						    $best_sell_sell_price    = $best_sell_qtyPerUnit_res['discount_price'];
						    
						    $best_sell_qty_id = $best_sell_qtyPerUnit_res['qty_id'];
						    
						    $best_sell_product_sql = mysqli_query($conn,"SELECT * FROM `product` WHERE `product_id` = '$best_sell_product_id' AND `status` = 'Y' AND `bestseller_product` = 'Y'");
						    while($best_sell_product_res = mysqli_fetch_assoc($best_sell_product_sql)){
						        $gst_percentage = $best_sell_product_res['persentage_of'];
						        $total_price=$best_sell_sell_price+(($best_sell_sell_price*$gst_percentage)/100);
						        
						        $discount = $best_sell_product_price - $total_price;
				                $discount_perc = ($discount * 100)/$best_sell_product_price;
        			            $discount_perc = round($discount_perc, 2);
						    ?>
						    <div class="item">
            				    <div class="product-item">
            						<a href="single_product_view.php?id=<?=base64_encode($best_sell_qty_id)?>" class="product-img">
                						<img src="Admin/product_image/<?=$best_sell_product_res['main_image']?>" style="height:156px;">
                						<div class="product-absolute-options">
                							<span class="offer-badge-1"><?=$discount_perc?>% off</span>
                							<?php
                							if($user_id != ''){
                							?>
                							<span class="like-icon" title="wishlist" onclick="wishlist(<?=$best_sell_qty_id?>,<?=$user_id?>)"></span>
                							<?php
                							}
                							?>
                						</div>
            						</a>
            						    <div class="product-text-dt">
            							<?php
            							if($best_sell_qtyPerUnit_res['number_of_product']=='0'){
            							?> <p><span>Out Of Stock</span></p> <?php
            							}
            							else {
            							?> <p>Available<span>(In Stock)</span></p> <?php
            							}
            							?>
            							<h4><?=$best_sell_product_res['product_name']?></h4>
                							<div class="product-price">&#8377;<?=$total_price?> <span>&#8377;<?=$best_sell_product_price?></span></div>
                							<div class="qty-cart">
                								<button type="button" class="btn btn-primary" style="background-color:#F55D2C;border:none;" onclick="addcart(<?=$best_sell_qty_id?>,<?=$user_id?>)">Add to Cart</button>
                								<span class="text-primary" style="margin-left:60px;"><?=$best_sell_qtyPerUnit_res['qtu_per_unit'].$best_sell_qtyPerUnit_res['unit']?></span>
                							</div>
            						    </div>
            						</div>
            					</div> 
						        <?php  
						            }
						        }
						        ?>
						    
						    
						    
						    
						    
						    
						    
						    
						    
							<!--<div class="item">-->
							<!--	<div class="product-item">-->
							<!--		<a href="single_product_view.html" class="product-img">-->
							<!--			<img src="images/product/img-11.jpg" alt="">-->
							<!--			<div class="product-absolute-options">-->
							<!--				<span class="offer-badge-1">6% off</span>-->
							<!--				<span class="like-icon" title="wishlist"></span>-->
							<!--			</div>-->
							<!--		</a>-->
							<!--		<div class="product-text-dt">-->
							<!--			<p>Available<span>(In Stock)</span></p>-->
							<!--			<h4>Product Title Here</h4>-->
							<!--			<div class="product-price">$12 <span>$15</span></div>-->
							<!--			<div class="qty-cart">-->
							<!--				<div class="quantity buttons_added">-->
							<!--					<input type="button" value="-" class="minus minus-btn">-->
							<!--					<input type="number" step="1" name="quantity" value="1" class="input-text qty text">-->
							<!--					<input type="button" value="+" class="plus plus-btn">-->
							<!--				</div>-->
							<!--				<span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>-->
							<!--			</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
							<!--<div class="item">-->
							<!--	<div class="product-item">-->
							<!--		<a href="single_product_view.html" class="product-img">-->
							<!--			<img src="images/product/img-12.jpg" alt="">-->
							<!--			<div class="product-absolute-options">-->
							<!--				<span class="offer-badge-1">2% off</span>-->
							<!--				<span class="like-icon" title="wishlist"></span>-->
							<!--			</div>-->
							<!--		</a>-->
							<!--		<div class="product-text-dt">-->
							<!--			<p>Available<span>(In Stock)</span></p>-->
							<!--			<h4>Product Title Here</h4>-->
							<!--			<div class="product-price">$10 <span>$13</span></div>-->
							<!--			<div class="qty-cart">-->
							<!--				<div class="quantity buttons_added">-->
							<!--					<input type="button" value="-" class="minus minus-btn">-->
							<!--					<input type="number" step="1" name="quantity" value="1" class="input-text qty text">-->
							<!--					<input type="button" value="+" class="plus plus-btn">-->
							<!--				</div>-->
							<!--				<span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>-->
							<!--			</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
							<!--<div class="item">-->
							<!--	<div class="product-item">-->
							<!--		<a href="single_product_view.html" class="product-img">-->
							<!--			<img src="images/product/img-13.jpg" alt="">-->
							<!--			<div class="product-absolute-options">-->
							<!--				<span class="offer-badge-1">5% off</span>-->
							<!--				<span class="like-icon" title="wishlist"></span>-->
							<!--			</div>-->
							<!--		</a>-->
							<!--		<div class="product-text-dt">-->
							<!--			<p>Available<span>(In Stock)</span></p>-->
							<!--			<h4>Product Title Here</h4>-->
							<!--			<div class="product-price">$5 <span>$8</span></div>-->
							<!--			<div class="qty-cart">-->
							<!--				<div class="quantity buttons_added">-->
							<!--					<input type="button" value="-" class="minus minus-btn">-->
							<!--					<input type="number" step="1" name="quantity" value="1" class="input-text qty text">-->
							<!--					<input type="button" value="+" class="plus plus-btn">-->
							<!--				</div>-->
							<!--				<span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>-->
							<!--			</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
							<!--<div class="item">-->
							<!--	<div class="product-item">-->
							<!--		<a href="single_product_view.html" class="product-img">-->
							<!--			<img src="images/product/img-1.jpg" alt="">-->
							<!--			<div class="product-absolute-options">-->
							<!--				<span class="offer-badge-1">3% off</span>-->
							<!--				<span class="like-icon" title="wishlist"></span>-->
							<!--			</div>-->
							<!--		</a>-->
							<!--		<div class="product-text-dt">-->
							<!--			<p>Available<span>(In Stock)</span></p>-->
							<!--			<h4>Product Title Here</h4>-->
							<!--			<div class="product-price">$15 <span>$20</span></div>-->
							<!--			<div class="qty-cart">-->
							<!--				<div class="quantity buttons_added">-->
							<!--					<input type="button" value="-" class="minus minus-btn">-->
							<!--					<input type="number" step="1" name="quantity" value="1" class="input-text qty text">-->
							<!--					<input type="button" value="+" class="plus plus-btn">-->
							<!--				</div>-->
							<!--				<span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>-->
							<!--			</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
							<!--<div class="item">-->
							<!--	<div class="product-item">-->
							<!--		<a href="single_product_view.html" class="product-img">-->
							<!--			<img src="images/product/img-5.jpg" alt="">-->
							<!--			<div class="product-absolute-options">-->
							<!--				<span class="offer-badge-1">2% off</span>-->
							<!--				<span class="like-icon" title="wishlist"></span>-->
							<!--			</div>-->
							<!--		</a>-->
							<!--		<div class="product-text-dt">-->
							<!--			<p>Available<span>(In Stock)</span></p>-->
							<!--			<h4>Product Title Here</h4>-->
							<!--			<div class="product-price">$9 <span>$10</span></div>-->
							<!--			<div class="qty-cart">-->
							<!--				<div class="quantity buttons_added">-->
							<!--					<input type="button" value="-" class="minus minus-btn">-->
							<!--					<input type="number" step="1" name="quantity" value="1" class="input-text qty text">-->
							<!--					<input type="button" value="+" class="plus plus-btn">-->
							<!--				</div>-->
							<!--				<span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>-->
							<!--			</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
							<!--<div class="item">-->
							<!--	<div class="product-item">-->
							<!--		<a href="single_product_view.html" class="product-img">-->
							<!--			<img src="images/product/img-6.jpg" alt="">-->
							<!--			<div class="product-absolute-options">-->
							<!--				<span class="offer-badge-1">2% off</span>-->
							<!--				<span class="like-icon" title="wishlist"></span>-->
							<!--			</div>-->
							<!--		</a>-->
							<!--		<div class="product-text-dt">-->
							<!--			<p>Available<span>(In Stock)</span></p>-->
							<!--			<h4>Product Title Here</h4>-->
							<!--			<div class="product-price">$7 <span>$8</span></div>-->
							<!--			<div class="qty-cart">-->
							<!--				<div class="quantity buttons_added">-->
							<!--					<input type="button" value="-" class="minus minus-btn">-->
							<!--					<input type="number" step="1" name="quantity" value="1" class="input-text qty text">-->
							<!--					<input type="button" value="+" class="plus plus-btn">-->
							<!--				</div>-->
							<!--				<span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>-->
							<!--			</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
							<!--<div class="item">-->
							<!--	<div class="product-item">-->
							<!--		<a href="single_product_view.html" class="product-img">-->
							<!--			<img src="images/product/img-14.jpg" alt="">-->
							<!--			<div class="product-absolute-options">-->
							<!--				<span class="offer-badge-1">1% off</span>-->
							<!--				<span class="like-icon" title="wishlist"></span>-->
							<!--			</div>-->
							<!--		</a>-->
							<!--		<div class="product-text-dt">-->
							<!--			<p>Available<span>(In Stock)</span></p>-->
							<!--			<h4>Product Title Here</h4>-->
							<!--			<div class="product-price">$6.95 <span>$7</span></div>-->
							<!--			<div class="qty-cart">-->
							<!--				<div class="quantity buttons_added">-->
							<!--					<input type="button" value="-" class="minus minus-btn">-->
							<!--					<input type="number" step="1" name="quantity" value="1" class="input-text qty text">-->
							<!--					<input type="button" value="+" class="plus plus-btn">-->
							<!--				</div>-->
							<!--				<span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>-->
							<!--			</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
							<!--<div class="item">-->
							<!--	<div class="product-item">-->
							<!--		<a href="single_product_view.html" class="product-img">-->
							<!--			<img src="images/product/img-3.jpg" alt="">-->
							<!--			<div class="product-absolute-options">-->
							<!--				<span class="offer-badge-1">3% off</span>-->
							<!--				<span class="like-icon" title="wishlist"></span>-->
							<!--			</div>-->
							<!--		</a>-->
							<!--		<div class="product-text-dt">-->
							<!--			<p>Available<span>(In Stock)</span></p>-->
							<!--			<h4>Product Title Here</h4>-->
							<!--			<div class="product-price">$8 <span>$10</span></div>-->
							<!--			<div class="qty-cart">-->
							<!--				<div class="quantity buttons_added">-->
							<!--					<input type="button" value="-" class="minus minus-btn">-->
							<!--					<input type="number" step="1" name="quantity" value="1" class="input-text qty text">-->
							<!--					<input type="button" value="+" class="plus plus-btn">-->
							<!--				</div>-->
							<!--				<span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>-->
							<!--			</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Vegetables and Fruits Products End -->
		<!-- New Products Start -->
		<!--<div class="section145">-->
		<!--	<div class="container">-->
		<!--		<div class="row">-->
		<!--			<div class="col-md-12">-->
		<!--				<div class="main-title-tt">-->
		<!--					<div class="main-title-left">-->
		<!--						<span>For You</span>-->
		<!--						<h2>Added New Products</h2>-->
		<!--					</div>-->
		<!--					<a href="#" class="see-more-btn">See All</a>-->
		<!--				</div>-->
		<!--			</div>-->
		<!--			<div class="col-md-12">-->
		<!--				<div class="owl-carousel featured-slider owl-theme">-->
		<!--					<div class="item">-->
		<!--						<div class="product-item">-->
		<!--							<a href="single_product_view.html" class="product-img">-->
		<!--								<img src="images/product/img-10.jpg" alt="">-->
		<!--								<div class="product-absolute-options">-->
		<!--									<span class="offer-badge-1">New</span>-->
		<!--									<span class="like-icon" title="wishlist"></span>-->
		<!--								</div>-->
		<!--							</a>-->
		<!--							<div class="product-text-dt">-->
		<!--								<p>Available<span>(In Stock)</span></p>-->
		<!--								<h4>Product Title Here</h4>-->
		<!--								<div class="product-price">$12 <span>$15</span></div>-->
		<!--								<div class="qty-cart">-->
		<!--									<div class="quantity buttons_added">-->
		<!--										<input type="button" value="-" class="minus minus-btn">-->
		<!--										<input type="number" step="1" name="quantity" value="1" class="input-text qty text">-->
		<!--										<input type="button" value="+" class="plus plus-btn">-->
		<!--									</div>-->
		<!--									<span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>-->
		<!--								</div>-->
		<!--							</div>-->
		<!--						</div>-->
		<!--					</div>-->
		<!--					<div class="item">-->
		<!--						<div class="product-item">-->
		<!--							<a href="single_product_view.html" class="product-img">-->
		<!--								<img src="images/product/img-9.jpg" alt="">-->
		<!--								<div class="product-absolute-options">-->
		<!--									<span class="offer-badge-1">New</span>-->
		<!--									<span class="like-icon" title="wishlist"></span>-->
		<!--								</div>-->
		<!--							</a>-->
		<!--							<div class="product-text-dt">-->
		<!--								<p>Available<span>(In Stock)</span></p>-->
		<!--								<h4>Product Title Here</h4>-->
		<!--								<div class="product-price">$10</div>-->
		<!--								<div class="qty-cart">-->
		<!--									<div class="quantity buttons_added">-->
		<!--										<input type="button" value="-" class="minus minus-btn">-->
		<!--										<input type="number" step="1" name="quantity" value="1" class="input-text qty text">-->
		<!--										<input type="button" value="+" class="plus plus-btn">-->
		<!--									</div>-->
		<!--									<span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>-->
		<!--								</div>-->
		<!--							</div>-->
		<!--						</div>-->
		<!--					</div>-->
		<!--					<div class="item">-->
		<!--						<div class="product-item">-->
		<!--							<a href="single_product_view.html" class="product-img">-->
		<!--								<img src="images/product/img-15.jpg" alt="">-->
		<!--								<div class="product-absolute-options">-->
		<!--									<span class="offer-badge-1">5% off</span>-->
		<!--									<span class="like-icon" title="wishlist"></span>-->
		<!--								</div>-->
		<!--							</a>-->
		<!--							<div class="product-text-dt">-->
		<!--								<p>Available<span>(In Stock)</span></p>-->
		<!--								<h4>Product Title Here</h4>-->
		<!--								<div class="product-price">$5</div>-->
		<!--								<div class="qty-cart">-->
		<!--									<div class="quantity buttons_added">-->
		<!--										<input type="button" value="-" class="minus minus-btn">-->
		<!--										<input type="number" step="1" name="quantity" value="1" class="input-text qty text">-->
		<!--										<input type="button" value="+" class="plus plus-btn">-->
		<!--									</div>-->
		<!--									<span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>-->
		<!--								</div>-->
		<!--							</div>-->
		<!--						</div>-->
		<!--					</div>-->
		<!--					<div class="item">-->
		<!--						<div class="product-item">-->
		<!--							<a href="single_product_view.html" class="product-img">-->
		<!--								<img src="images/product/img-11.jpg" alt="">-->
		<!--								<div class="product-absolute-options">-->
		<!--									<span class="offer-badge-1">New</span>-->
		<!--									<span class="like-icon" title="wishlist"></span>-->
		<!--								</div>-->
		<!--							</a>-->
		<!--							<div class="product-text-dt">-->
		<!--								<p>Available<span>(In Stock)</span></p>-->
		<!--								<h4>Product Title Here</h4>-->
		<!--								<div class="product-price">$15 <span>$16</span></div>-->
		<!--								<div class="qty-cart">-->
		<!--									<div class="quantity buttons_added">-->
		<!--										<input type="button" value="-" class="minus minus-btn">-->
		<!--										<input type="number" step="1" name="quantity" value="1" class="input-text qty text">-->
		<!--										<input type="button" value="+" class="plus plus-btn">-->
		<!--									</div>-->
		<!--									<span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>-->
		<!--								</div>-->
		<!--							</div>-->
		<!--						</div>-->
		<!--					</div>-->
		<!--					<div class="item">-->
		<!--						<div class="product-item">-->
		<!--							<a href="single_product_view.html" class="product-img">-->
		<!--								<img src="images/product/img-14.jpg" alt="">-->
		<!--								<div class="product-absolute-options">-->
		<!--									<span class="offer-badge-1">New</span>-->
		<!--									<span class="like-icon" title="wishlist"></span>-->
		<!--								</div>-->
		<!--							</a>-->
		<!--							<div class="product-text-dt">-->
		<!--								<p>Available<span>(In Stock)</span></p>-->
		<!--								<h4>Product Title Here</h4>-->
		<!--								<div class="product-price">$9</div>-->
		<!--								<div class="qty-cart">-->
		<!--									<div class="quantity buttons_added">-->
		<!--										<input type="button" value="-" class="minus minus-btn">-->
		<!--										<input type="number" step="1" name="quantity" value="1" class="input-text qty text">-->
		<!--										<input type="button" value="+" class="plus plus-btn">-->
		<!--									</div>-->
		<!--									<span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>-->
		<!--								</div>-->
		<!--							</div>-->
		<!--						</div>-->
		<!--					</div>-->
		<!--					<div class="item">-->
		<!--						<div class="product-item">-->
		<!--							<a href="single_product_view.html" class="product-img">-->
		<!--								<img src="images/product/img-2.jpg" alt="">-->
		<!--								<div class="product-absolute-options">-->
		<!--									<span class="offer-badge-1">New</span>-->
		<!--									<span class="like-icon" title="wishlist"></span>-->
		<!--								</div>-->
		<!--							</a>-->
		<!--							<div class="product-text-dt">-->
		<!--								<p>Available<span>(In Stock)</span></p>-->
		<!--								<h4>Product Title Here</h4>-->
		<!--								<div class="product-price">$7</div>-->
		<!--								<div class="qty-cart">-->
		<!--									<div class="quantity buttons_added">-->
		<!--										<input type="button" value="-" class="minus minus-btn">-->
		<!--										<input type="number" step="1" name="quantity" value="1" class="input-text qty text">-->
		<!--										<input type="button" value="+" class="plus plus-btn">-->
		<!--									</div>-->
		<!--									<span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>-->
		<!--								</div>-->
		<!--							</div>-->
		<!--						</div>-->
		<!--					</div>-->
		<!--					<div class="item">-->
		<!--						<div class="product-item">-->
		<!--							<a href="single_product_view.html" class="product-img">-->
		<!--								<img src="images/product/img-5.jpg" alt="">-->
		<!--								<div class="product-absolute-options">-->
		<!--									<span class="offer-badge-1">New</span>-->
		<!--									<span class="like-icon" title="wishlist"></span>-->
		<!--								</div>-->
		<!--							</a>-->
		<!--							<div class="product-text-dt">-->
		<!--								<p>Available<span>(In Stock)</span></p>-->
		<!--								<h4>Product Title Here</h4>-->
		<!--								<div class="product-price">$6.95</div>-->
		<!--								<div class="qty-cart">-->
		<!--									<div class="quantity buttons_added">-->
		<!--										<input type="button" value="-" class="minus minus-btn">-->
		<!--										<input type="number" step="1" name="quantity" value="1" class="input-text qty text">-->
		<!--										<input type="button" value="+" class="plus plus-btn">-->
		<!--									</div>-->
		<!--									<span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>-->
		<!--								</div>-->
		<!--							</div>-->
		<!--						</div>-->
		<!--					</div>-->
		<!--					<div class="item">-->
		<!--						<div class="product-item">-->
		<!--							<a href="single_product_view.html" class="product-img">-->
		<!--								<img src="images/product/img-6.jpg" alt="">-->
		<!--								<div class="product-absolute-options">-->
		<!--									<span class="offer-badge-1">New</span>-->
		<!--									<span class="like-icon" title="wishlist"></span>-->
		<!--								</div>-->
		<!--							</a>-->
		<!--							<div class="product-text-dt">-->
		<!--								<p>Available<span>(In Stock)</span></p>-->
		<!--								<h4>Product Title Here</h4>-->
		<!--								<div class="product-price">$8 <span>8.75</span></div>-->
		<!--								<div class="qty-cart">-->
		<!--									<div class="quantity buttons_added">-->
		<!--										<input type="button" value="-" class="minus minus-btn">-->
		<!--										<input type="number" step="1" name="quantity" value="1" class="input-text qty text">-->
		<!--										<input type="button" value="+" class="plus plus-btn">-->
		<!--									</div>-->
		<!--									<span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>-->
		<!--								</div>-->
		<!--							</div>-->
		<!--						</div>-->
		<!--					</div>-->
		<!--				</div>-->
		<!--			</div>-->
		<!--		</div>-->
		<!--	</div>-->
		<!--</div>-->
		<!-- New Products End -->
	</div>
	<!-- Body End -->
	 <?php include('footer.php'); ?>