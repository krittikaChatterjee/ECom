<?php
	include('../connection.php');
	
	$data = [];
	$array = array();
	
	$pin_query = mysqli_query($conn,"SELECT * FROM `nearest_point` WHERE `status`='Y'");
	
	$pin_row = mysqli_num_rows($pin_query);
	
	if($pin_row !=0){
		while($pin_row = mysqli_fetch_assoc($pin_query)){
			array_push($array,array('pin'=>$pin_row['name'],'cash_status'=>$pin_row['cash_status'],'exp_status'=>$pin_row['exp_status']));
		}
		
		$data['status'] = true;
		$data['data'] = $array;
		$data['error'] = null;
	}else{
		$data['status'] = false;
		$data['data'] = null;
		$data['error'] = null;
	}
	
	echo json_encode($data);
?>