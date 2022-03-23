<?php
	include('../connection.php');
/*	$json = file_get_contents('php://input');
    $obj = json_decode($json,true);*/
    
	$data = [];
	$array = array();
	$array2 = array();
	
	$cat_id = mysqli_real_escape_string($conn,$_REQUEST['cat_id']);
	$select_cat = mysqli_query($conn,"select * from category where cat_id='$cat_id'");
	$fetch_cat = mysqli_fetch_assoc($select_cat);
	$sub_cat_query = mysqli_query($conn,"SELECT * FROM `sub_category` WHERE `catagory_id`='$cat_id' AND `status`='Y'");
	$sub_cat_row = mysqli_num_rows($sub_cat_query);
	
	if($sub_cat_row != 0){
		while($sub_cat_result = mysqli_fetch_assoc($sub_cat_query)){
			$array[]=$sub_cat_result;
		
		}
		
	}else{
		$array=[];
	}
	$banner=[];
	array_push($banner,array('image'=>$fetch_cat['sub_img1']));
	array_push($banner,array('image'=>$fetch_cat['sub_img2']));
	array_push($banner,array('image'=>$fetch_cat['sub_img3']));
	/*echo "<pre>";
	print_r($banner);*/
	echo json_encode($array);
?>