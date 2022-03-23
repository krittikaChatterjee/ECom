<?php
	include('../connection.php');
	
	$data = [];
	
	$chk_query = mysqli_query($conn,"SELECT * FROM `express_delivery`");
	$chk_result = mysqli_fetch_assoc($chk_query);
	
	$data['status'] = true;
	$data['data'] = $chk_result;
	
	echo json_encode($data);

?>