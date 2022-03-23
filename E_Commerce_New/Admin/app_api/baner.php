<?php
	include('../connection.php');
	
	$data = [];
	$banner_array = array();
	$slider_array = array();
	
	$query = mysqli_query($conn,"SELECT * FROM `poster`");
	$row = mysqli_num_rows($query);
	if($row != 0){
		while($result = mysqli_fetch_assoc($query)){
			if($result['use_for'] == 'BANNER'){
				$arr[]=$result;
			//	array_push($banner_array,$result['name']);
			}
		}
		
	}else{
      $arr=[];
	}
	
	$query2 = mysqli_query($conn,"SELECT * FROM `esecintial_banner` LIMIT 6");
	$row2 = mysqli_num_rows($query2);
	if($row2 != 0){
		while($result2 = mysqli_fetch_assoc($query2)){
			
				$arr2[]=$result2;
		
		}
		
	}else{
      $arr2=[];
	}
	$query3 = mysqli_query($conn,"SELECT * FROM `static_banar`");
	$row3 = mysqli_num_rows($query3);
	if($row3 != 0){
		while($result3 = mysqli_fetch_assoc($query3)){
			
				$arr3[]=$result3;
		
		}
		
	}else{
      $arr3=[];
	}
	$query4 = mysqli_query($conn,"SELECT * FROM `sliding_banner`");
	$row4 = mysqli_num_rows($query4);
	if($row4 != 0){
		while($result4 = mysqli_fetch_assoc($query4)){
			
				$arr4[]=$result4;
		
		}
		
	}else{
      $arr4=[];
	}
	
		$query5 = mysqli_query($conn,"SELECT * FROM `video_banner`");
	$row5 = mysqli_num_rows($query5);
	if($row5 != 0){
		while($result5 = mysqli_fetch_assoc($query5)){
			
				$arr5[]=$result5;
		
		}
		
	}else{
      $arr5=[];
	}
	echo json_encode(array('banner'=>$arr,'slider'=>$arr2,'static_banner'=>$arr3,'sliding_banner'=>$arr4,'video_banner'=>$arr5));
?>