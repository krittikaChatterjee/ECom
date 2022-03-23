<?php
	include('../connection.php');
	
	$data = [];
	$array = array();
	
	$cat_query = mysqli_query($conn,"SELECT * FROM `category` WHERE `status`='Y'");
	$cat_row = mysqli_num_rows($cat_query);
	
	if($cat_row != 0){
		while($cat_result = mysqli_fetch_assoc($cat_query)){
			$sub_image = array($cat_result['sub_img1'],$cat_result['sub_img2'],$cat_result['sub_img3']);
			array_push($array,array('cat_id'=>$cat_result['cat_id'],'cat_name'=>$cat_result['cat_name'],'cat_image'=>$cat_result['cat_image'],'sub_image'=>$sub_image));
		}
		$data['status'] = true;
		$data['data'] = $array;
		$data['base_url'] = 'http://admin.e-bazaar.online/category_image/';
		
		$data['error'] = null;
	}else{
		$data['status'] = false;
		$data['data'] = null;
		$data['error'] = "No Data Found !!";
	}
	
	echo json_encode($data);
?>