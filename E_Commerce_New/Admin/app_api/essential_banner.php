<?php
	include('../connection.php');
	
	$data = [];
	$array = array();
	
	$essential_banner_query = mysqli_query($conn,"SELECT * FROM `esecintial_banner`");
	$row = mysqli_num_rows($essential_banner_query);
	
	if($row != 0){
		while($essential_result = mysqli_fetch_assoc($essential_banner_query)){
			array_push($array,$essential_result['image']);
		}
		
		$data['status'] = true;
		$data['data'] = $array;
		$data['base_url'] = 'http://admin.e-bazaar.online/esecintal_banner/';
		$data['error'] = null;
	}else{
		$data['status'] = false;
		$data['data'] = null;
		$data['error'] = 'No Data Found';
	}
	
	echo json_encode($data);
?>