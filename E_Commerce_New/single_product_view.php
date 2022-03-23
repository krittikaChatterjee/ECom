<?php
include('header.php'); 
$user_id = $_SESSION['user'];
$qty_id=base64_decode($_REQUEST['id']);
date_default_timezone_set('Asia/Kolkata'); 

$single_product_res=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `qty_per_unit` WHERE `qty_id` = '$qty_id'"));
$product_id=$single_product_res['product_id'];

$product_price=$single_product_res['product_price'];
$sell_price=$single_product_res['discount_price'];

$quantity = $single_product_res['qtu_per_unit'];
$unit=$single_product_res['unit'];
$vendor_id = $single_product_res['vendor_id'];

$product_res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `product` WHERE `product_id` = '$product_id'"));

// $stock_status=$product_res['stock_status'];
$tax=$product_res['persentage_of'];
// $vendor_id = $product_res['vender_or_admin'];

$category_id = $product_res['category_id'];
$sub_category_id = $product_res['sub_cat_id'];


$total_price=($sell_price+(($sell_price*$tax)/100));

if(isset($_REQUEST['review'])){
    $comment=mysqli_real_escape_string($conn,$_REQUEST['comment']);
    $date = date("Y-m-d");
    
    if($user_id == ''){
        echo '<script>swal("Sorry!!", "Please Login First", "warning")</script>';
        echo "<meta http-equiv='refresh' content='2;url=sign_in.php'>";
    } else {
        $check_review_exist = mysqli_query($conn,"SELECT * FROM `review` WHERE `product_id` = '$qty_id' AND `user_id` = '$user_id'");
        if($check_review_exist > 0) {
            $inser_review=mysqli_query($conn,"UPDATE review SET `comment`='$comment',`status`='Y',`date`='$date' WHERE product_id='$qty_id' AND `user_id` = '$user_id'");
        } else {
            $inser_review=mysqli_query($conn,"INSERT INTO `review`(`product_id`, `user_id`, `comment`, `status`, `date`) VALUES ('$qty_id','$user_id','$comment','Y','$date')");
        }
        
        if($inser_review){
            echo '<script>swal("Success", "Review Submitted Successfully", "success")</script>';
            echo "<meta http-equiv='refresh' content='2;url=index.php'>";
        }
    }
    
}
?>

<style>
.wrapper {
padding-top: 128px; 
padding-bottom: 0px;
}
</style>
	<div class="wrapper">
		<!--<div class="gambo-Breadcrumb">-->
		<!--	<div class="container">-->
		<!--		<div class="row">-->
		<!--			<div class="col-md-12">-->
		<!--				<nav aria-label="breadcrumb">-->
		<!--					<ol class="breadcrumb">-->
		<!--						<li class="breadcrumb-item"><a href="index.php">Home</a></li>-->
								<!--<li class="breadcrumb-item"><a href="shop_grid.html">Vegetables & Fruits</a></li>-->
		<!--						<li class="breadcrumb-item active" aria-current="page">Product Details</li>-->
		<!--					</ol>-->
		<!--				</nav>-->
		<!--			</div>-->
		<!--		</div>-->
		<!--	</div>-->
		<!--</div>-->
		<div class="all-product-grid mb-5">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="product-dt-view">
							<div class="row">
								<div class="col-lg-4 col-md-4">
									<div id="sync1" class="owl-carousel owl-theme">
									     <?php if($product_res['main_image'] != '') {  ?>
										<div class="item">
											<img src="Admin/product_image/<?=$product_res['main_image']?>" style="height:466px;">
										</div>
										<?php } ?>
										<?php if($product_res['sub_img1'] != '') {  ?>
										<div class="item">
											<img src="Admin/product_image/<?=$product_res['sub_img1']?>" style="height:466px;">
										</div>
										<?php } ?>
										<?php if($product_res['sub_img2'] != '') {  ?>
										<div class="item">
											<img src="Admin/product_image/<?=$product_res['sub_img2']?>" style="height:466px;">
										</div>
										<?php } ?>
										<?php if($product_res['sub_img3'] != '') {  ?>
										<div class="item">
											<img src="Admin/product_image/<?=$product_res['sub_img3']?>" style="height:466px;">
										</div>
										<?php } ?>
									</div>
								</div>
								<div class="col-lg-8 col-md-8">
									<div class="product-dt-right">
										<h2><?=$product_res['product_name']?></h2>
										<div class="no-stock" id="comingSoon">
											<!--<p class="pd-no">Product No.<span><?//=$product_res['product_id']?></span></p>-->
											<!--<p class="pd-no">Shelf Life<span><?//=$shelf_life?></span></p>-->
											<?php if($single_product_res['number_of_product'] != '0'){ ?>
    										<p class="stock-qty">Available<span>(Instock)</span></p>
    										<?php } else { ?>
    										<p class="stock-qty">Unavailable<span>(Out Of Stock)</span></p>
    										<?php } ?>
										</div>
										<div class="product-radio">
											<ul class="product-now">
											    <?php
											 //   echo "SELECT * FROM `qty_per_unit` WHERE `product_id` = '$product_id'";
											    $unitSwitch_sql = mysqli_query($conn,"SELECT * FROM `qty_per_unit` WHERE `product_id` = '$product_id'");
											    while($unitSwitch_res = mysqli_fetch_assoc($unitSwitch_sql)) {
											    ?>
												<li>
													<label onclick="unitSwitch(<?=$unitSwitch_res['qty_id']?>,<?=$user_id?>)">
													    <?=$unitSwitch_res['qtu_per_unit']?><?=$unitSwitch_res['unit']?>
													</label>
												</li>
												<?php } ?>
											</ul>
										</div>
										<p class="pp-descp"><?=$product_res['product_description']?></p>
										<div class="product-group-dt">
											<ul id='exiis_div'>
												<li><div class="main-price color-discount">Selling Price<span id="itemPrice">&#8377;<?=$total_price?></span></div></li>
												<li><div class="main-price mrp-price">MRP Price<span id="marketPrice">&#8377;<?=$product_price?></span></div></li>
												<li><span class="like-icon save-icon" title="wishlist" onclick="wishlist(<?=$qty_id?>,<?=$user_id?>)"></span></li>
												
												<button type="button" class="btn btn-primary" style="background-color:#F55D2C;border:none;" onclick="addcart(<?=$qty_id?>,<?=$user_id?>)">Add to Cart</button>
											</ul>
											<ul id="new_div"></ul>
											
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-12">
						<div class="pdpt-bg">
							<div class="pdpt-title">
								<h4>More Like This</h4>
							</div>
							<div class="pdpt-body scrollstyle_4">
							    <?php
							    $subcategory=mysqli_query($conn,"SELECT * FROM `product` WHERE `sub_cat_id` = '$sub_category_id' AND `product_id`!= '$product_id' ");
							    while($subcat_fetch=mysqli_fetch_assoc($subcategory)){
							 //   $ID=$subcat_fetch['id'];    
							    $pro_id=$subcat_fetch['product_id'];
							 //   $status=$subcat_fetch['stock_status'];
							    $taxx=$query_fetch['persentage_of'];
							    
							    // taking from qty_per_unit
    						    $similar_qty_per_unit_sql = mysqli_query($conn,"SELECT * FROM `qty_per_unit` WHERE `product_id` = '$pro_id'");
    						    while($similar_qty_per_unit_res = mysqli_fetch_assoc($similar_qty_per_unit_sql)) {
    						        
    						        $similar_qty_id = $similar_qty_per_unit_res['qty_id']; // eta holo ekta product er ekta variant er id

    							    $similar_product_price=$similar_qty_per_unit_res['product_price'];
                                    $similar_sell_price=$similar_qty_per_unit_res['discount_price'];
                                    $simialr_total_price=($similar_sell_price+(($similar_sell_price*$taxx)/100));
                                    $similar_quantity = $similar_qty_per_unit_res['qtu_per_unit'];
                                    $similar_unit=$similar_qty_per_unit_res['unit'];
                                    
                                    
                                    
                                    $discount = $similar_product_price - $simialr_total_price;
    				                $discount_perc = ($discount * 100)/$similar_product_price;
            			            $discount_perc = round($discount_perc, 2);
                                    
                                    
                                    
                                    
                                    
							    ?>
							    
								<div class="cart-item border_radius">
									<a href="single_product.php?id=<?=base64_encode($similar_qty_id)?>" class="cart-product-img">
										<img src="Admin/product_image/<?=$subcat_fetch['main_image']?>" style="height:112px; width:110px;">
										<div class="offer-badge" style="margin-left: -8px;margin-top: -9px;"><?=$discount_perc?>% OFF</div>
									</a>
									<div class="cart-text">
										<h4><?=$subcat_fetch['product_name']?></h4>
										<div class="cart-radio">
											<ul class="kggrm-now">
												<li>
													<input type="radio" id="k2" name="cart1">
													<label for="k2" style="width:50px"><?=$similar_quantity.$similar_unit?></label>
												</li>
											</ul>
										</div>
										<div class="qty-group">
											<div class="quantity buttons_added">
											    <button type="button" class="btn btn-primary" style="background-color:#F55D2C;border:none;" onclick="addcart(<?=$similar_qty_id?>,<?=$user_id?>)">Add to Cart</button>
											</div>
											<div class="cart-item-price">&#8377;<?=$simialr_total_price?><span>&#8377;<?=$similar_product_price?></span></div>
										</div>
									</div>
								</div>
								<?php } }?>
								
								<!--<div class="cart-item border_radius">-->
								<!--	<a href="" class="cart-product-img">-->
								<!--		<img src="images/product/img-2.jpg" alt="">-->
										<!--<div class="offer-badge">6% OFF</div>-->
								<!--	</a>-->
								<!--	<div class="cart-text">-->
								<!--		<h4>Product Title Here</h4>-->
								<!--		<div class="cart-radio">-->
								<!--			<ul class="kggrm-now">-->
												<!--<li>-->
												<!--	<input type="radio" id="k5" name="cart2">-->
												<!--	<label for="k5">0.50</label>-->
												<!--</li>-->
												<!--<li>-->
												<!--	<input type="radio" id="k6" name="cart2">-->
												<!--	<label for="k6">1kg</label>-->
												<!--</li>-->
								<!--				<li>-->
								<!--					<input type="radio" id="k7" name="cart2">-->
								<!--					<label for="k7">2kg</label>-->
								<!--				</li>-->
								<!--			</ul>-->
								<!--		</div>-->
								<!--		<div class="qty-group">-->
								<!--			<div class="quantity buttons_added">-->
								<!--			   <button class="add-cart-btn hover-btn"><i class="uil uil-shopping-cart-alt"></i>Add to Cart</button>-->
												<!--<input type="button" value="-" class="minus minus-btn">-->
												<!--<input type="number" step="1" name="quantity" value="1" class="input-text qty text">-->
												<!--<input type="button" value="+" class="plus plus-btn">-->
								<!--			</div>-->
								<!--			<div class="cart-item-price">&#8377; 24 <span>&#8377; 30</span></div>-->
								<!--		</div>	-->
								<!--	</div>-->
								<!--</div>-->
								<!--<div class="cart-item border_radius">-->
								<!--	<a href="" class="cart-product-img">-->
								<!--		<img src="images/product/img-5.jpg" alt="">-->
								<!--	</a>-->
								<!--	<div class="cart-text">-->
								<!--		<h4>Product Title Here</h4>-->
								<!--		<div class="cart-radio">-->
								<!--			<ul class="kggrm-now">-->
								<!--				<li>-->
								<!--					<input type="radio" id="k8" name="cart3">-->
								<!--					<label for="k8">0.50</label>-->
								<!--				</li>-->
								<!--				<li>-->
								<!--					<input type="radio" id="k9" name="cart3">-->
								<!--					<label for="k9">1kg</label>-->
								<!--				</li>-->
								<!--				<li>-->
								<!--					<input type="radio" id="k10" name="cart3">-->
								<!--					<label for="k10">1.50kg</label>-->
								<!--				</li>-->
								<!--			</ul>-->
								<!--		</div>-->
								<!--		<div class="qty-group">-->
								<!--			<div class="quantity buttons_added">-->
								<!--				<button class="add-cart-btn hover-btn"><i class="uil uil-shopping-cart-alt"></i>Add to Cart</button>-->
								<!--			</div>-->
								<!--			<div class="cart-item-price">&#8377; 15</div>-->
								<!--		</div>	-->
								<!--	</div>-->
								<!--</div>	-->
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-md-12">
						<div class="pdpt-bg">
							<div class="pdpt-title">
								<h4>Product Details</h4>
							</div>
							<div class="pdpt-body scrollstyle_4">
								<div class="pdct-dts-1">
									<div class="pdct-dt-step">
										<h4>Description</h4>
										<p><?=$product_res['product_description'];?></p>
									</div>
								</div>			
							</div>					
						</div>
					</div>
				</div>
					<div class="row">
					    	<div class="col-lg-8 col-md-12">
						<div class="pdpt-bg">
							<div class="pdpt-title">
							    <?php 
							 //   echo "SELECT * FROM review WHERE status='Y' AND product_id='$qty_id'";
								$review=mysqli_query($conn,"SELECT * FROM review WHERE status='Y' AND product_id='$qty_id'");
								$count=mysqli_num_rows($review);
								?>
								<h4><?=$count?> Reviews of this Product</h4>
							</div>
							<?php if($count==0){ ?>
							<div class="pdpt-body scrollstyle_4">
								<div class="pdct-dts-1">
									<div class="pdct-dt-step">
										<h4 class="namewrap text-center">Be The First One To Review This Product<span></span></h4>
									    <svg style="display: none;">
									    <?php
									    for($i=1;$i<=$rating;$i++){
									    ?>
									    <img src="golden_star.png" width="30px">
									    <?php } ?>
										<p class="pt-3"><?=$review_fetch['comment']?></p>
									</div>
									<hr>
								</div>			
							</div>
							<?php } else { ?>
							<div class="pdpt-body scrollstyle_4">
								<div class="pdct-dts-1">
								    <?php 
								    // echo "SELECT * FROM review WHERE status='Y' AND product_id='$qty_id'";
								    $review=mysqli_query($conn,"SELECT * FROM review WHERE status='Y' AND product_id='$qty_id'");
								    $count=mysqli_num_rows($review);
								    while($review_fetch=mysqli_fetch_assoc($review)){ 
								    $user=$review_fetch['user_id'];
								    $rating=$review_fetch['rating'];
								    $user_details=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `users` WHERE `u_id` = '$user'"));
								    ?>
									<div class="pdct-dt-step">
										<h4 class="namewrap"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSla-p7MqWVSLL2rpSQHlxEO6mKceKYPvZjo4oslefoeXE7-oMcRHP5IfT3qgllHC8kKvQ&usqp=CAU" style="height: 45px;border-radius: 50px;margin-right: 20px;border: 1px solid #28a745;"><?=$user_details['fullname']?> <span class="pl-3 pr-3"><?=$review_fetch['date']?></span><span></span></h4>
									    <svg style="display: none;">
									    <?php
									    for($i=1;$i<=$rating;$i++){
									    ?>
									    <img src="golden_star.png" width="30px">
									    <?php } ?>
										<p class="pt-3"><?=$review_fetch['comment']?></p>
									</div>
									<hr>
									<?php } ?>
								</div>			
							</div>
							<?php } ?>
						</div>
					</div>
					<?php
					$review_check=mysqli_query($conn,"SELECT * FROM review WHERE product_id='$qty_id' AND user_id='$user_id'");
                    $review_count=mysqli_num_rows($review_check);
                    if($review_count==0){
					?>
					<div class="col-lg-4 col-md-12">
						<div class="pdpt-bg">
							<div class="pdpt-title">
								<h4>Give your Review</h4>
							</div>
							<div class="pdpt-bodyright scrollstyle_4">
								<div class="border_radius cart-item" style="display: block;">
								    <label>Your Rating<label>
								    <div class="row">  
								        <form method="post">
								        <div class="col-md-12">
                                            <div class="rating mb-3">
                                            	<?php 
                                                for($i=1;$i<=5;$i++){
                                                ?>
                                                <img src="white_star.png" width="30px" id="getImage<?=$i?>" style="margin:10px 5px 5px 0px;" onclick="rating(<?=$i?>,<?=(($user_id == '') ? '0' : $user_id)?>,<?=$qty_id?>)">
                                                <?php } ?>
                                            </div>
								        </div>
    								    <div class="col-md-12">
    								        <label>Your Comment</label>
    								        <textarea placeholder="Enter your Comment" rows="5" style="width: 100%;" name="comment"></textarea>
    								    </div>
    								    <div class="col-md-12 text-center">
    								        <?php //if(isset($user_id)){
    								        ?>
    								        <button type="submit" name="review" class="btn btn-success">Submit Review</button>
    								        <?php //}?>
    								    </div>
    								    </form>
								    </div>
								</div>
							</div>
						</div>
					</div>
					<?php } if($review_count>0){ ?>
					<div class="col-lg-4 col-md-12">
						<div class="pdpt-bg">
							<div class="pdpt-title">
								<h4>Give your Review</h4>
							</div>
							<div class="pdpt-bodyright scrollstyle_4">
								<div class="border_radius cart-item" style="display: block;">
								    <label>Your have already submitted review for this product<label>
								</div>
							</div>
						</div>
					</div>
				    <?php } ?>
				</div>
			</div>
		</div>

<input type="hidden" id="user_idd" value="<?= $user_id; ?>">		
<?php
include('footer.php'); ?>
<script>
	$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    responsive:{
    0:{
        items:1
    },
    600:{
        items:3
    },
    1000:{
        items:1
    }
  }
})
</script>
<script>
function rating(c,id,product){  
    var Image_Id = document.getElementById('getImage'+1);
    if (Image_Id.src.match("golden_star.png")){
        Image_Id.src = "white_star.png";
        }
    var Image_Id = document.getElementById('getImage'+2);
    if (Image_Id.src.match("golden_star.png")){
        Image_Id.src = "white_star.png";
        }
    var Image_Id = document.getElementById('getImage'+3);
    if (Image_Id.src.match("golden_star.png")){
        Image_Id.src = "white_star.png";
        }
    var Image_Id = document.getElementById('getImage'+4);
    if (Image_Id.src.match("golden_star.png")){
        Image_Id.src = "white_star.png";
        }
    var Image_Id = document.getElementById('getImage'+5);
    if (Image_Id.src.match("golden_star.png")){
        Image_Id.src = "white_star.png";
        }

    var x;
    for(x=1; x<=c; x++){
    var Image_Id = document.getElementById('getImage'+x);
    if (Image_Id.src.match("white_star.png")){
        Image_Id.src = "golden_star.png";
        }
    }
    
    // console.log('id>>>>>>>>>>>>',id);
    
    if(id == '0') {
        swal("Sorry!!", "Please Login First", "warning");
        setTimeout(function(){window.location='sign_in.php'}, 3000);
    } else {
        $.ajax({
            url: "api/review_rating.php",
            type: "POST",
            data: {c:c,id:id,product:product},
            success: function (result){
            }
        })
    }
    
    
    
   
}
</script>
<script>
    function unitSwitch(id,user_id){
        $.ajax({
        url: "api/unitSwitch.php",
        type: "POST",
        data: {id:id,user_id:user_id},
        success: function (result){
            $("#exiis_div").hide();
            $("#new_div").html(result);
      }
    })
}
</script>
