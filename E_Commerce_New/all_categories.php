<?php
include('header.php');
?>
<body>
	<div class="wrapper">
		<div class="all-product-grid">
			<div class="container">
			    <div class="row">
    				<div class="col-lg-12">
    					<div class="product-top-dt">
    						<div class="product-left-title">
    							<h2><?=$subcategory_details['sub_category_name']?></h2>
    						</div>
    					</div>
    				</div>
    			</div>
				<div class="product-list-view row">
				    <?php
				    $limit = 12;
                    $product_pagination = mysqli_query($conn,"SELECT COUNT(`cat_id`) AS `cat_id` FROM `category` WHERE status='Y'");
                    $row_pagination = mysqli_fetch_assoc($product_pagination);
                    $number_of_products = $row_pagination['cat_id'];
                    $pages = ceil($number_of_products / $limit);
                    $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
                    $start = ($page - 1) * $limit;
                    $previous = $page - 1;
                    $next = $page + 1;
				    
				    $product=mysqli_query($conn,"SELECT * FROM `category` WHERE status='Y' LIMIT $start,$limit");
				    while($fetch_product=mysqli_fetch_assoc($product)){
            	    $id=$fetch_product['cat_id'];
				    ?>
				    <div class="col-lg-3 col-md-6">
            			<div class="product-item mb-30">
            				<a href="cat_product.php?id=<?=base64_encode($fetch_product['cat_id'])?>" class="product-img">
            					<img src="Admin/category_image/<?=$fetch_product['cat_image']?>" height="150" width="200">
            					<div class="product-absolute-options">
            					</div>
            				</a>
            				<div class="product-text-dt">
                                <p>&nbsp;</p>
            					<h4><a href="cat_product.php?id=<?=base64_encode($fetch_product['cat_id'])?>"><?=$fetch_product['cat_name']?></a></h4>
            				</div>
            			</div>
		            </div>
		            <?php } ?>
		        </div>      
	            <nav aria-label="Page navigation example">
                    <ul class="pagination">
                    <?php if($page<=1){ ?>
                    <li class="disabled page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                    <?php } else { ?>
                    <li class="page-item"><a class="page-link" href="all_categories.php?page=<?=$previous?>"><i class="fa fa-angle-left"></i></a></li>
                    <?php }
                    for($i=1;$i<=$pages;$i++){
                    ?>
                    <li class="current page-item"><a class="page-link" href="all_categories.php?page=<?=$i?>"><?=$i?></a></li>
                    <?php } 
                    if($page==$pages){
                    ?>
                    <li class="disabled page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                    <?php } else { ?>
                    <li class="page-item"><a class="page-link" href="all_categories.php?page=<?=$next?>"><i class="fa fa-angle-right"></i></a></li>
                    <?php } ?>
                    </ul>
                </nav>
			</div>
		</div>
	</div>
</body>
<?php include('footer.php'); ?>