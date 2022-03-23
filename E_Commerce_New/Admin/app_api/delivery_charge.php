<?php
	include('../connection.php');
	 $amount= mysqli_real_escape_string($conn,$_REQUEST['amount']);
	 
	 $sql = "SELECT * FROM delivery_charges";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
$row = $result->fetch_assoc();

$a=$row['amount'];

if($amount>$a){
	$arr=array('rec'=>1,'charge'=>0);
}else{
	$arr=array('rec'=>1,'charge'=>$row['delivery_charge']);	
}

} else {
 $arr=array('rec'=>0,'charge'=>0);
}
	echo json_encode($arr); 
	 ?>