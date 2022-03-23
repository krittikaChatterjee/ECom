<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="dashboard.php">
            <!--<img src="#" class="logo-icon" alt="logo icon" style=" width: 40px;height: 40px;margin-left: 0;">-->
            <!--&nbsp;&nbsp;&nbsp;&nbsp;-->
            <center><h4 style="color:white">Organic Food Store</h4></center>
        </a>
    </div>
    <div class="user-details">
        <div class="media align-items-center user-pointer collapsed" data-toggle="collapse" data-target="#user-dropdown">
            <div class="avatar"><img class="mr-3 side-user-img" src="admin_image/admin.png" alt="Admin avatar"></div>
            <div class="media-body">
                <?php
                $a_query=mysqli_query($conn,"SELECT * FROM admin WHERE admin_id='$admin_id'");
                $a_result=mysqli_fetch_assoc($a_query);
                ?>
                <h5 class="side-user-name">Organic Food Store</h5>
            </div>
        </div>
        <div id="user-dropdown" class="collapse">
            <ul class="user-setting-menu">
                <li><a href="my_profile.php"><i class="icon-user"></i> My Profile</a></li>
                <li><a href="logout.php"><i class="icon-power"></i> Logout</a></li>
            </ul>
        </div>
    </div> 
    <ul class="sidebar-menu do-nicescrol">
        <li class="sidebar-header">MAIN NAVIGATION</li>
        <li>
            <a href="dashboard.php" class="waves-effect"><i class="icon-home"></i><span>Dashboard</span></a>
        </li>
        <!--<li>-->
        <!--    <ul class="sidebar-submenu">-->
        <!--        <li><a href="user_order.php"><i class="fa fa-long-arrow-right"></i>View Order</a></li>-->
        <!--        <li><a href="user_express_order.php"><i class="fa fa-long-arrow-right"></i>View Express Order</a></li>-->
        <!--    </ul>-->
        <!--</li>-->
        <!--<li>-->
        <!--    <a href="javaScript:void();" class="waves-effect">-->
        <!--        <i class="icon-diamond"></i><span>Coupon</span>-->
        <!--        <i class="fa fa-angle-left pull-right"></i>-->
        <!--    </a>-->
        <!--    <ul class="sidebar-submenu">-->
        <!--        <li><a href="add_coupon.php"><i class="fa fa-long-arrow-right"></i>Add Coupon</a></li>-->
        <!--        <li><a href="manage_coupon.php"><i class="fa fa-long-arrow-right"></i>Manage Coupon</a></li>-->
        <!--    </ul>-->
        <!--</li>-->
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-diamond"></i><span> Banner</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="add_poster.php"><i class="fa fa-long-arrow-right"></i>Add Banner</a></li>
                 <!--<li><a href="manage_escenial_slider.php"><i class="fa fa-long-arrow-right"></i>Manage Main Banner</a></li>-->
                <li><a href="manage_poster.php"><i class="fa fa-long-arrow-right"></i>Manage Banner</a></li>
                <!--<li><a href="manage_static_banar.php"><i class="fa fa-long-arrow-right"></i>Manage Static Banar</a></li>-->
                <!--<li><a href="manage_sliding_banner.php"><i class="fa fa-long-arrow-right"></i>Manage Sliding Banner</a></li>-->
                <!--<li><a href="manage_video_banner.php"><i class="fa fa-long-arrow-right"></i>Manage Video Banner</a></li>-->
            </ul>
        </li>
        <li>
        	<a href="manage_view_user.php"><i class="icon-diamond"></i>View User</a>
        </li>
        
        <li>
        	<a href="user_order.php"><i class="icon-diamond"></i> User Order</a>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-diamond"></i><span>Category</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="add_category.php"><i class="fa fa-long-arrow-right"></i>Add Category</a></li>
                <li><a href="manage_category.php"><i class="fa fa-long-arrow-right"></i>Manage Category</a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-diamond"></i><span>Sub Category</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="add_sub-category.php"><i class="fa fa-long-arrow-right"></i>Add Sub-Category</a></li>
                <li><a href="manage_sub-category.php"><i class="fa fa-long-arrow-right"></i>Manage Sub-Category</a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-diamond"></i><span>Product</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="add_product.php"><i class="fa fa-long-arrow-right"></i>Add Product</a></li>
                <li><a href="manage_product.php"><i class="fa fa-long-arrow-right"></i>Manage Product</a></li>
                <li><a href="esencial_product_stock.php"><i class="fa fa-long-arrow-right"></i>Product Stock</a></li>
                <li><a href="view_product_stock.php"><i class="fa fa-long-arrow-right"></i>View Product Stock</a></li>
                <li><a href="view_rating_product.php"><i class="fa fa-long-arrow-right"></i>View Product Rating</a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-diamond"></i><span>Delivery Location</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="add_location.php"><i class="fa fa-long-arrow-right"></i>Add Delivery Location</a></li>
                <li><a href="manage_location.php"><i class="fa fa-long-arrow-right"></i>Manage Delivery Location</a></li>
            </ul>
        </li>
        <li>
          	 <a href="edit_delivery_charge.php"><i class="icon-diamond"></i>Delivery Charge</a>
        </li>
        <li>
          	 <a href="product_review.php"><i class="icon-diamond"></i>Product Review</a>
        </li>
        <li>
          	 <a href="about_us.php"><i class="icon-diamond"></i>About Us</a>
        </li>
        <li>
          	 <a href="privacy.php"><i class="icon-diamond"></i>Privacy Policy</a>
        </li>
        <li>
          	 <a href="termsNconditions.php"><i class="icon-diamond"></i>Terms & Conditions</a>
        </li>
        <li>
          	 <a href="refund_policy.php"><i class="icon-diamond"></i>Refund & Return &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Policy</a>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-diamond"></i><span>Contact Us</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="contact_us.php"><i class="fa fa-long-arrow-right"></i>Customer Contacts</a></li>
                <li><a href="manage_contact.php"><i class="fa fa-long-arrow-right"></i>Manage Contact Us</a></li>
            </ul>
        </li>
        
        
        
        
        
        
        
        <!--<li>-->
        <!--  	 <a href="contact_us.php"><i class="icon-diamond"></i>Contact Us</a>-->
        <!--</li>-->
    </ul>
</div>