<?php
ob_start();
session_start();
include('connection.php');
require('fpdf/fpdf.php');
 // Deactivate
    // set_magic_quotes_runtime(false);



$invoice=base64_decode($_REQUEST["invo"]);

$sql="SELECT * FROM `order_list` WHERE `invoice_no`='$invoice'";
$queary=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($queary);
$date =	date_create($row['date']);
// $date=date_create("2013-03-15");
 $order_date =  date_format($date,"d/m/Y");

$order_TIME=$row['time'];
$DATE = $order_date.' TIME-'.$order_TIME;
$user_name=$row['name'];
$house_address=$row['house_no'];
$street_address=$row['street_address'];
$landmark = $row['landmark'];
$city=$row['city'];
$phno=$row['phno']; 
$payment = $row['payment'];

if($payment == 'cashondelivery') {
    $payment_type = 'COD';
} else {
    $payment_type = 'Online';
}

//For Now
$order_address  = $row['house_no'];
$street_address = $row['street_name'];
$landmark       = $row['landmark'];
$state_id       = $row['state'];
$city_id        = $row['city'];
$pinCode        = $row['pincode'];
$phno           = $row['phone'];

$stateRes = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `states` WHERE `id` = '$state_id'"));
$state = $stateRes['name'];

$cityRes = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `cities` WHERE `id` = '$city_id'"));
$city = $cityRes['name'];


// 	$gst_sql="SELECT * FROM `order_list` WHERE `invoice_no`='$invoice'";
// 	  	$gst_result = mysqli_query($conn, $gst_sql);
// 	  	if ($gst_result->num_rows > 0) {
// 	  	$gst_res= mysqli_fetch_assoc($gst_result);
	  
//              	$coupon_value = $gst_res['coupon_value'];
			
// 	  	} 
// 	  	else {
          
//          $coupon_value = 0;
        
//         }

// $estimated_delivery_time = $row['estimated_delivery_time'];
// $slot_id = $row['slot_time'];
// $schedule_date = $row['schedule_date'];
$pin = $row['pin'];

$ST = 'ABC Address';

$gstin = 'GSTIN : 123456789';

$ft = 'Kolkata - 700016,';
$a = 'West Bengal';
$ph = '9876543210, 9876543210';
// $ph2 = '';
$subtotal=$row['total'];
$delivery_charges=$row['delivery_charges'];


                  
$pdf = new FPDF();
$pdf->AddPage(); // add fpdf fuction 
$pdf->SetFont('Arial','B',11); // font style
$pdf->SetTitle('Organic Food Store');

$pdf->Cell(80,7,'','TL',0,0);
$pdf->Cell(30,7,'INVOICE','T',0,'C',0);
$pdf->Cell(80,7,'','TR',0,1);
$pdf->Cell(0,7,'',0,1);
$pdf->Cell(190,15,'','T',0,0);
$pdf->Cell(0,0,'',0,1);


$pdf->Cell(100,15,'Organic Food Store   '.$seller_name,'LR',0,1);
$pdf->SetFont('Arial','B',9); // font style
$pdf->Cell(45,8,'INVOICE- '.$invoice,'B',0,'L',0);
$pdf->Cell(45,8,'DATE '.$DATE,'RB',0,'R',0);

$pdf->Cell(0,7,'',0,1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(100,13,$gstin,'LR',0,1);
$pdf->SetFont('Arial','B',9); // font style
$pdf->Cell(90,13,'CUSTOMER NAME - ' . $user_name,'R',0,'L',0);
$pdf->Cell(0,0,'',0,1);


$pdf->Cell(0,7,'',0,1);
$pdf->SetFont('Arial','',9); // font style
$pdf->Cell(100,13,substr($ST,0,54),'LR',0,1);
$pdf->SetFont('Arial','',9); // font style
$pdf->Cell(90,13,'Customer House No - '.$order_address,'R',0,'L',0);
$pdf->Cell(0,0,'',0,1);


$pdf->Cell(0,7,'',0,1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(100,13,$ft,'LR',0,1);
$pdf->SetFont('Arial','',9); // font style
$pdf->Cell(90,13,'Street. -'.substr($street_address,0,50),'R',0,'L',0);
$pdf->Cell(0,0,'',0,1);


$pdf->Cell(0,7,'',0,1);
$pdf->SetFont('Arial','',9); // font style
$pdf->Cell(100,13,substr($a,0,54),'LR',0,1);
$pdf->SetFont('Arial','',9); // font style
$pdf->Cell(90,13,'Landmark - '.$landmark,'R',0,'L',0);
$pdf->Cell(0,0,'',0,1);



$pdf->Cell(0,7,'',0,1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(100,13,'Contact No - '.$ph,'LR',0,1);
$pdf->SetFont('Arial','',9); // font style
$pdf->Cell(90,13,'City. -'.substr($city,0,70) ,'R',0,'L',0);
$pdf->Cell(0,0,'',0,1);






$pdf->Cell(0,7,'',0,1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(100,13,'Contact No - '.$ph,'LR',0,1);
$pdf->SetFont('Arial','',9); // font style
$pdf->Cell(90,13,'State. -'.substr($state,0,70) ,'R',0,'L',0);
$pdf->Cell(0,0,'',0,1);








$pdf->Cell(0,7,'',0,1);
$pdf->SetFont('Arial','',9); // font style
$pdf->Cell(100,13,substr($n,0,54),'LR',0,1);
$pdf->SetFont('Arial','',9); // font style
$pdf->Cell(90,13,'Pincode - '.$pinCode,'R',0,'L',0);
$pdf->Cell(0,0,'',0,1);



// $pdf->Cell(0,7,'',0,1);
// $pdf->SetFont('Arial','',9); // font style
// $pdf->Cell(100,13,substr($n,0,54),'LR',0,1);
// $pdf->SetFont('Arial','',9); // font style
// $pdf->Cell(90,13,'Schedule Date - '.$schedule_date,'R',0,'L',0);
// $pdf->Cell(0,0,'',0,1);




// $pdf->Cell(0,7,'',0,1);
// $pdf->SetFont('Arial','',9);
// $pdf->Cell(100,13,$am,'LR',0,1);
// $pdf->SetFont('Arial','',9); // font style
// $pdf->Cell(90,13,'Time Slot. -'.substr($slot_id,0,70) ,'R',0,'L',0);
// $pdf->Cell(0,0,'',0,1);




$pdf->Cell(0,7,'',0,1);
$pdf->SetFont('Arial','',9); // font style
$pdf->Cell(100,13,substr($t,0,54),'LR',0,1);
$pdf->SetFont('Arial','',9); // font style
$pdf->Cell(90,13,'Customer Mobile - '.$phno,'R',0,'L',0);
$pdf->Cell(0,0,'',0,1);



$pdf->SetFont('Arial','',9);
$pdf->Cell(0,7,'',0,1);

$pdf->Cell(50,13,''.$ab,'L',0,'L',0);
$pdf->Cell(50,13,'',0,'R',0);
//$pdf->Cell(0,13,'abc',R,0,0);


$pdf->SetFont('Arial','',9); // font style
$pdf->Cell(45,13,'Payment Method - '. $payment_type,'L',0,'L',0);
$pdf->Cell(45,13,'','R',0,'L',0);
$pdf->Cell(0,0,'',0,1);
$pdf->Cell(0,13,'','B',1,1);





$pdf->SetFont('Arial','B',6); // font style
//

$pdf->Cell(10,13,'Sl No','LRB',0,'L',0,'',true);
$pdf->SetFillColor(250,250,250);
//$pdf->ln();
//$pdf->Cell(55,13,'ITEM DESCRIPTION',RB,0,C,0);

$pdf->Cell(70,13,'Product Name','RB',0,'C',0);
//$pdf->Cell(15,13,'HNS',RB,0,C,0);




// $pdf->Cell(15,13,'ADULT','RB',0,'C',0);
// $pdf->Cell(35,13,'CHILD','RB',0,'C',0);
$pdf->Cell(15,13,'Original Price.','RB',0,'C',0);
$pdf->Cell(15,13,'Rate.','RB',0,'C',0);
$pdf->Cell(10,13,'Ct.','RB',0,'C',0);
$pdf->Cell(15,13,'Qty.','RB',0,'C',0);
// $pdf->Cell(15,13,'Updated Qty.','RB',0,'C',0);
$pdf->Cell(10,13,'GST.','RB',0,'C',0);
$pdf->Cell(15,13,'CGST.','RB',0,'C',0);
$pdf->Cell(15,13,'SGST.','RB',0,'C',0);

// $pdf->Cell(15,13,'Discount','RB',0,'C',0);
$pdf->Cell(15,13,'AMOUNT','RB',0,'C',0);


 $pdf->Cell(0,13,'',1,1);
// $pdf->Cell(0,13,'',B,0,1);




$sql22 = "SELECT * FROM `ordered_product` WHERE invoice_no='$invoice'";
$result22 = mysqli_query($conn, $sql22);
   $t="";
   $gst4="";
   $i=1;
   $sub_tot='';
   $sub_total2=0;
   $gst_id = '';
   $gst_percentage = 0;
   $total_gst = 0;
   $gst_percentage=0;
          $gst=0;
         
          $total_c_gst=0;
    // output data of each row
    while($row22 = mysqli_fetch_assoc($result22)){
    
    $qty_id = $row22['product_id'];
    $qty_res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `qty_per_unit` WHERE `qty_id` = '$qty_id'"));
    $product_id = $qty_res['product_id'];
    $product_res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `product` WHERE product_id = '$product_id'"));
    $product_name   = $product_res['product_name'];
    $original_price = $qty_res['product_price'];    
    $rate           = $qty_res['discount_price'];
    $count          = $row22['cart_quantity'];
    $product_quntity= $qty_res['qtu_per_unit'].$qty_res['unit'];
    $gst_percentage = $product_res['persentage_of'];
    $total_gst = ((($gst_percentage*$rate)/100)*$count) ;
    $total_c_gst = $total_gst/2;
    $product_price = ($total_gst+($rate*$count));
    
   
   
    $totalprice         =  $row['sub_total'];   
    $delivery_charges   =  $row['delivery_charge'];
    $TOT                =  $row['total'];    
    $coupon_value       =  '0';
    // $product_quntity=$row22['product_quntity'];
    // $product_price=$row22['product_price'];
    // $prd_id = $row22['product_id'];
    // $qty = $row22['qty_id'];
    
    
    // $f_id = $row22['franchise_id'];
    
// $s = "SELECT * FROM `franchise_prduct` WHERE f_id='$f_id' AND qty_id='$qty' AND product_id='$prd_id'";
// $re2200 = mysqli_query($conn, $s);
// $f= mysqli_fetch_assoc($re2200);



// $unit = $f['unit'];
// $shh = "SELECT * FROM `unit_table` WHERE id='$unit'";
// $re2200ff = mysqli_query($conn, $shh);
// $fhh= mysqli_fetch_assoc($re2200ff);
// $uumit = $fhh['unit'];

// $qtu_per_unit= $f['qtu_per_unit'];

// $prd_qt = $qtu_per_unit.''.$uumit;


    
//     $amnt=$row22['tot_amount'];
//     $product_name=$row22['product_name'];
//     $update_product_quntity=$row22['updated_quantity'];
//     $count=$row22['product_count'];
    
//   	$setQuery3="SELECT SUM(product_price) as total2 FROM `ordered_product` WHERE `invoice_no`='$invoice' AND `franchise_id`='$f_id'";
// 	$querySet3=mysqli_query($conn,$setQuery3);
// 	$fetchSet3=mysqli_fetch_assoc($querySet3);
// 	$totalprice = $fetchSet3['total2'];
// 	$coupon = (int)$totalprice - (int)$coupon_value;
		
		
// 		$TOT = (int)$coupon + (int)$delivery_charges;
		




// if($row22['rate'] == '')
// {
// $rate = $f['selling_price'];
// $discounted_price = $f['discounted_price'];;
// $original_price = $f['product_price'];
// $discount = $f['discount'];
// }
// else
// {
//   $rate = $row22['rate'];
//     $original_price = $row22['original_price'];
//     $discount = $row22['discount']; 
// }
		
		
		
// $su = "SELECT * FROM `product` WHERE  id='$prd_id'";
// $re2200jj = mysqli_query($conn, $su);
// $fu= mysqli_fetch_assoc($re2200jj);
//  $total_gst = 0;
// 	$gst_id=$fu['gst_percentage'];
  	
// 	  	$gst_sql="SELECT `value` FROM `gst_add` WHERE `id`='$gst_id'";
// 	  	$gst_result = mysqli_query($conn, $gst_sql);
// 	  	if ($gst_result->num_rows > 0) {
// 	  	$gst_res= mysqli_fetch_assoc($gst_result);
// 	  	$gst_percentage = $gst_res['value'];
	  	
// 	 $gst=round((($rate *$count)/(100+$gst_percentage))*$gst_percentage);
//      $total_gst=round($total_gst+$gst);
//      $total_c_gst=round($total_gst/2);
// 	  	} else {
//           $gst_percentage=0;
//           $gst=0;
//           $total_gst=0;
//           $total_c_gst=0;
//         }
 

    



$pdf->SetFont('Arial','',7); // font style
//$pdf->SetFillColor(173,255,47);
//$pdf->Cell(10,13,$i,LRB,0,L,0,TRUE);



$cellWidth=70;//wrapped cell width
  $cellHeight=5;//normal one-line cell height
  
  //check whether the text is overflowing
  if($pdf->GetStringWidth($product_name) < $cellWidth){
    //if not, then do nothing
    $line=1;
  }else{
 $textLength=strlen($product_name); //total text length
    $errMargin=10;    //cell width error margin, just in case
    $startChar=0;   //character start position for each line
    $maxChar=0;     //maximum character in a line, to be incremented later
    $textArray=array(); //to hold the strings for each line
    $tmpString="";    //to hold the string for a line (temporary)
    
    while($startChar < $textLength){ //loop until end of text
      //loop until maximum character reached
      while( 
      $pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
      ($startChar+$maxChar) < $textLength ) {
        $maxChar++;
        $tmpString=substr($product_name,$startChar,$maxChar);
      }
      //move startChar to next line
      $startChar=$startChar+$maxChar;
      //then add it into the array so we know how many line are needed
      array_push($textArray,$tmpString);
      //reset maxChar and tmpString
      $maxChar=0;
      $tmpString='';
      
    }
    //get number of line
    $line=count($textArray);
  }
  
  //write the cells
  $pdf->Cell(10,($line * $cellHeight),$i,1,0); //adapt height to number of lines
  // $pdf->Cell(60,($line * $cellHeight),$item[1],1,0); //adapt height to number of lines
  
  //use MultiCell instead of Cell
  //but first, because MultiCell is always treated as line ending, we need to 
  //manually set the xy position for the next cell to be next to it.
  //remember the x and y position before writing the multicell
  $xPos=$pdf->GetX();
  $yPos=$pdf->GetY();
  if($size!='')
  {
      $pdf->MultiCell($cellWidth,$cellHeight,$product_name."(".$size.")",1);
  }
  else
  {
      $pdf->MultiCell($cellWidth,$cellHeight,$product_name,1);
  }
  
  
  //return the position for next cell next to the multicell
  //and offset the x with multicell width
  $pdf->SetXY($xPos + $cellWidth , $yPos);
  
   $pdf->Cell(15,($line * $cellHeight),$original_price,1,0); //adapt height to number of lines
  $pdf->Cell(15,($line * $cellHeight),$rate,1,0); //adapt height to number of lines
  
   
 //$pdf->Cell(15,($line * $cellHeight),$adult,1,0);
 //$pdf->Cell(35,($line * $cellHeight),$child,1,0); $pdf->Cell(20,($line * $cellHeight),$update_product_quntity,1,0); //adapt height to number of lines $pdf->Cell(20,($line * $cellHeight),$update_product_quntity,1,0); //adapt height to number of lines
  $pdf->Cell(10,($line * $cellHeight),$count,1,0); //adapt height to number of lines
 $pdf->Cell(15,($line * $cellHeight),$product_quntity,1,0); //adapt height to number of lines
//  $pdf->Cell(15,($line * $cellHeight),$update_product_quntity,1,0); //adapt height to number of lines
 $pdf->Cell(10,($line * $cellHeight),$total_gst,1,0); //adapt height to number of lines
 $pdf->Cell(15,($line * $cellHeight),$total_c_gst,1,0); //adapt height to number of lines
  $pdf->Cell(15,($line * $cellHeight),$total_c_gst,1,0); //adapt height to number of lines

//  $pdf->Cell(15,($line * $cellHeight),$discount,1,0); //adapt height to number of lines
 $pdf->Cell(15,($line * $cellHeight),'Rs '. $product_price,1,1);
 

$i++;
}

// blank cell for table


//$pdf->Cell(5,13,'',0,L,0);
$pdf->Cell(10,13,'','L',0,0);
$pdf->Cell(70,13,'','',0,0);
//$pdf->Cell(15,13,'',R,0,0);
$pdf->Cell(20,13,'','R',0,0);
// $pdf->Cell(15,13,'','R',0,0);
// $pdf->Cell(35,13,'','R',0,0);
$pdf->Cell(90,13,'','',0,0);
 $pdf->Cell(0,13,'',1,1);


$pdf->Cell(10,13,'','L',0,0);
$pdf->Cell(70,13,'','',0,0);
//$pdf->Cell(15,13,'',R,0,0);
$pdf->Cell(20,13,'','R',0,0);
// $pdf->Cell(15,13,'','R',0,0);
// $pdf->Cell(35,13,'','R',0,0);
$pdf->Cell(90,13,'','R',0,0);
 $pdf->Cell(0,13,'',1,1);




$pdf->Cell(10,13,'','LB',0,0);
$pdf->Cell(70,13,'','B',0,0);
//$pdf->Cell(15,13,'',RB,0,0);
$pdf->Cell(20,13,'','RB',0,0);
// $pdf->Cell(15,13,'','RB',0,0);
// $pdf->Cell(35,13,'','RB',0,0);
$pdf->Cell(90,13,'','B',0,0);
 $pdf->Cell(0,13,'',1,1);
 
 
$pdf->Cell(100,5,'','RL',0,0);
$pdf->Cell(35,5,'SUB TOTAL','R',0,0);
$pdf->Cell(55,5,$totalprice,'R',1,0);
//end blank cell for table

//GST Table
$pdf->SetFont('Arial','B',9); // font style
$pdf->Cell(5,7,'','L',0,0);
$pdf->Cell(15,6,'',0,'C',0);
$pdf->Cell(20,6,'',0,'C',0);
$pdf->Cell(20,6,'',0,'C',0);
$pdf->Cell(20,6,'',0,0);

$pdf->Cell(20,7,'','R',0,0);
$pdf->SetFont('Arial','B',8); // font style
$pdf->Cell(35,7,'Coupon/Discount Value',0,'L',0);
$pdf->Cell(0,7,$coupon_value ,'L',0,'R',0);


$pdf->Cell(100,5,'','RL',0,0);
$pdf->Cell(35,5,'','R',0,0);
$pdf->Cell(55,5,$tprice,'R',1,0);

$pdf->SetFont('Arial','B',9); // font style
$pdf->Cell(5,7,'','L',0,0);
$pdf->Cell(15,6,'',0,'C',0);
$pdf->Cell(20,6,'',0,'C',0);
$pdf->Cell(20,6,'',0,'C',0);
$pdf->Cell(20,6,'',0,0);

$pdf->Cell(20,7,'','R',0,0);
$pdf->SetFont('Arial','B',10); // font style
$pdf->Cell(35,7,' Delivery Charges',0,'L',0);
$pdf->Cell(0,7,$delivery_charges,'L',0,'R',0);





 $pdf->Cell(0,6,'',1,1);

$pdf->SetFont('Arial','',8); // font style
$pdf->Cell(5,7,'','L',0,0);
$pdf->Cell(15,6,'',0,0);
$pdf->Cell(20,6,'',0,0);
$pdf->Cell(20,6,'',0,0);
$pdf->Cell(20,6,'',0,0);

//end GST table

$pdf->Cell(20,7,'','R',0,0);
$pdf->SetFont('Arial','B',10); // font style
$pdf->Cell(35,7,'TOTAL',0,'R',0);
$pdf->Cell(0,7,'Rs '.$TOT,'LR',0,'R',0);
$pdf->Cell(0,7,'',1,1);


//$pdf->Cell(115,8,'',R,0,0);
$pdf->SetFont('Arial','B',8);
//$pdf->Cell(35,8,'SHIPPING CHARGE',R,0,0);
//$pdf->SetFont('Arial','B',12); // font style
//$pdf->Cell(40,8,Rs .$row['shipping_price'],R,0,R,0);
$pdf->Cell(0,0,'','R',1,1);
$pdf->Cell(0,7,'',1,1);






$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetFont('Arial','B',8); // font style
$col1="This is a computer-generated receipt. No signature required.\n\n";
$pdf->MultiCell(190, 40, $col1, 0,'C',0);
// 'D','RangeCart.pdf'

$pdf->Output(); // Output
 ob_end_flush(); 
?>
