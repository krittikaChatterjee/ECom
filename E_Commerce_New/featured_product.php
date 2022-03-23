<?php
include('header.php');
?>

<div class="wrapper">
	<div class="all-product-grid">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="product-top-dt">
						<div class="product-left-title">
							<h2>Top Featured Products</h2>
						</div>
					</div>
				</div>
			</div>
			<div class="product-list-view">
				<div class="row">
				    <?php
				    
				    $limit = 2;
				    
				    
				// echo    $pagination_qry = "SELECT COUNT(qty_per_unit.product_id) AS total_product_id FROM `qty_per_unit` LEFT JOIN `product` ON qty_per_unit.product_id = product.product_id WHERE product.status = 'Y' AND product.featured_product = 'Y'";
				    
				    
				    
				    
				    
				    
				    
				    
                    $product_pagination = mysqli_query($conn,"SELECT COUNT(qty_per_unit.product_id) AS total_product_id FROM `qty_per_unit` LEFT JOIN `product` ON qty_per_unit.product_id = product.product_id WHERE product.status = 'Y' AND product.featured_product = 'Y'");
                    $row_pagination = mysqli_fetch_assoc($product_pagination);
                    $number_of_products = $row_pagination['total_product_id'];
                    $pages = ceil($number_of_products / $limit);
                    $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
                    $start = ($page - 1) * $limit;
                    $previous = $page - 1;
                    $next = $page + 1;
				    
				    
				    
				    
				    
                    
                    
                    
                        $featre_qtyPerUnit_sql = mysqli_query($conn,"SELECT * FROM `qty_per_unit` LEFT JOIN `product` ON qty_per_unit.product_id = product.product_id WHERE product.status = 'Y' AND product.featured_product = 'Y' LIMIT $start,$limit");
				        while($featre_qtyPerUnit_res = mysqli_fetch_assoc($featre_qtyPerUnit_sql)) {
				            
				            $id = $featre_qtyPerUnit_res['qty_id'];
				            
				            $feature_product_id    = $featre_qtyPerUnit_res['product_id'];
				            $feature_product_price = $featre_qtyPerUnit_res['product_price'];
				            $feature_sell_price    = $featre_qtyPerUnit_res['discount_price'];
				           
				            
				            
				            
				            // $fetured_product_sql = mysqli_query($conn,"SELECT * FROM `product` WHERE `product_id` = '$feature_product_id' AND `status` = 'Y' AND `featured_product` = 'Y' LIMIT $start,$limit");
				            // while($fetured_product_res = mysqli_fetch_assoc($fetured_product_sql)) {
                                $gst_percentage = $featre_qtyPerUnit_res['persentage_of'];
                                $total_price=$feature_sell_price+(($feature_sell_price*$gst_percentage)/100);
                                
                                $feature_discount = $feature_product_price - $total_price;
				                $feature_discount_perc = ($feature_discount * 100)/$feature_product_price;
        			            $feature_discount_perc = round($feature_discount_perc, 2);
        			            
        			            $feature_unit = $featre_qtyPerUnit_res['unit'];
                                
				    ?>
					<div class="col-lg-3 col-md-6">
						<div class="product-item mb-30">
							<a href="single_product_view.php?id=<?=base64_encode($id)?>" class="product-img">
								<img src="Admin/product_image/<?=$featre_qtyPerUnit_res['main_image']?>" height="150" width="200">
								<div class="product-absolute-options">
								    <span class="offer-badge-1"><?=$feature_discount_perc?>% off</span>
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
							        if($featre_qtyPerUnit_res['number_of_product'] == '0'){
							            ?> <p><span>Out Of Stock</span></p> <?php
							        } else {
							            ?> <p>Available<span>(In Stock)</span></p> <?php
							        }
							    ?>
								<h4><a href="single_product_view.php?id=<?=base64_encode($id)?>"><?=$featre_qtyPerUnit_res['product_name']?></a></h4>
								<div class="product-price">&#8377;<?=$total_price?><span>&#8377;<?=$feature_product_price?></span></div>
								<div class="qty-cart">
									<button type="button" class="btn btn-primary" style="background-color:#F55D2C;border:none; margin-left:10px;" onclick="addcart(<?=$id?>,<?=$user_id?>)">Add to Cart</button>
									<!--<span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>-->
									<span class="text-primary" style="margin-left:80px;"><?=$featre_qtyPerUnit_res['qtu_per_unit'].$feature_unit?></span>
								</div>
							</div>
						</div>
					</div>
					<?php }  ?>
					
				</div>
				 <nav aria-label="Page navigation example">
                    <ul class="pagination">
                    <?php if($page<=1){ ?>
                    <li class="disabled page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                    <?php } else { ?>
                    <li class="page-item"><a class="page-link" href="featured_product.php?page=<?=$previous?>"><i class="fa fa-angle-left"></i></a></li>
                    <?php }
                    for($i=1;$i<=$pages;$i++){
                    ?>
                    <li class="current page-item"><a class="page-link" href="featured_product.php?page=<?=$i?>"><?=$i?></a></li>
                    <?php } 
                    if($page==$pages){
                    ?>
                    <li class="disabled page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                    <?php } else { ?>
                    <li class="page-item"><a class="page-link" href="featured_product.php?page=<?=$next?>"><i class="fa fa-angle-right"></i></a></li>
                    <?php } ?>
                    </ul>
                </nav>
			</div>
		</div>
	</div>
</div>
<?php include('footer.php'); ?>