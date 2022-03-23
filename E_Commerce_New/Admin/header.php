<?php
ob_start();
    session_start();
    include('connection.php');
    $admin_id=$_SESSION['admin_id'];

    if($admin_id=='')
    {
        header("Location: index.php");
    }else{
        $a_sql = "SELECT * FROM admin WHERE admin_id='$admin_id'";
        $a_query = mysqli_query($conn,$a_sql);
        $a_result = mysqli_fetch_assoc($a_query);
        $name = $a_result['name'];
        $email = $a_result['email'];
        $phno = $a_result['phno'];
        $pass = $a_result['password'];
        $img_url = "admin_image/admin.jpg";
    }
?>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <title>Organic Food Store</title>
        <!-- favicon -->
        <!--<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">-->
        <link rel="shortcut icon" href="../assets/img/toivoshop2.png" type="image/x-icon"/>
        <!-- simplebar CSS -->
        <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
         <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
        <!-- Data Tables  -->
        <link href="assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
        <link href="assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
         <!-- animate CSS -->
        <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
         <!-- Icons CSS -->
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
         <!-- Sidebar CSS -->
        <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
         <!-- Custom Style -->
        <link href="assets/css/app-style.css" rel="stylesheet"/>
        <script src="assets/js/sweetalert.js"></script>
        <link href="assets/plugins/jquery-multi-select/multi-select.css" rel="stylesheet" type="text/css">
        <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
       
    </head>
    <body>
        
        <div id="wrapper">
            <header class="topbar-nav">
                <nav class="navbar navbar-expand fixed-top gradient-ibiza">
                    <ul class="navbar-nav mr-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link toggle-menu" href="javascript:void();">
                                <i class="icon-menu menu-icon"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </header>