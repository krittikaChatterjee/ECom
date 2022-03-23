<?php
include('header.php');
    $search_name = $_REQUEST['search_name'];
?>

<body>
	<div class="wrapper">
		<div class="all-product-grid">
			<div class="container">
			    <div class="row">
    				<div class="col-lg-12">
    					<div class="product-top-dt">
    						<div class="product-left-title">
    							<h2>Search results for <?=$search_name?></h2>
    						</div>
    					</div>
    				</div>
    			</div>
				<div class="product-list-view row">
				    <?php
                    $search_product_sql = mysqli_query($conn,"SELECT * FROM `product` WHERE `product_name` LIKE '%$search_name%' AND `status` = 'Y'");
                    while($search_product_res = mysqli_fetch_assoc($search_product_sql)) {
                        $product_id = $search_product_res['product_id'];
                        $gst_percentage = $search_product_res['persentage_of'];
                        
                        
                        $qty_per_sql = mysqli_query($conn,"SELECT * FROM `qty_per_unit` WHERE `product_id` = '$product_id'");
                        while($qty_per_res = mysqli_fetch_assoc($qty_per_sql)){
                            $id=$qty_per_res['qty_id'];
                            
                            $product_price = $qty_per_res['product_price'];
				            $sell_price    = $qty_per_res['discount_price'];
				           
				            $total_price=$sell_price+(($sell_price*$gst_percentage)/100);
				            
				            $discount = $product_price - $total_price;
			                $discount_perc = ($discount * 100)/$product_price;
    			            $discount_perc = round($discount_perc, 2);
                           
                            
                            ?>
                            
                            
                            
                            
                            	<div class="col-lg-3 col-md-6">
            						<div class="product-item mb-30">
            							<a href="single_product_view.php?id=<?=base64_encode($id)?>" class="product-img">
            								<img src="Admin/product_image/<?=$search_product_res['main_image']?>" height="150" width="200">
            								<div class="product-absolute-options">
            								    <span class="offer-badge-1"><?=$discount_perc?>% off</span>
            								    <?php
            									    if($user_id != '') {
            									        ?>
            									            <span class="like-icon" title="wishlist" onclick="wishlist(<?=$id?>,<?=$user_id?>)"></span>
            									        <?php
            									    }
            									?>
            								</div>
            							</a>
            							<div class="product-text-dt">
            							    <?php
            							        if($qty_per_res['number_of_product'] == '0'){
            							            ?> <p><span>Out Of Stock</span></p> <?php
            							        } else {
            							            ?> <p>Available<span>(In Stock)</span></p> <?php
            							        }
            							    ?>
            								<h4><a href="single_product_view.php?id=<?=base64_encode($id)?>"><?=$search_product_res['product_name']?></a></h4>
            								<div class="product-price">&#8377;<?=$total_price?><span>&#8377;<?=$product_price?></span></div>
            								<div class="qty-cart">
            									<button type="button" class="btn btn-primary" style="background-color:#F55D2C;border:none; margin-left:10px;" onclick="addcart(<?=$id?>,<?=$user_id?>)">Add to Cart</button>
            									<!--<span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>-->
            									<span class="text-primary" style="margin-left:80px;"><?=$qty_per_res['qtu_per_unit'].$qty_per_res['unit']?></span>
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
</body>
<?php include('footer.php'); ?>