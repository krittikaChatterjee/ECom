<?php
ob_start();
session_start();
include('connection.php');
require('fpdf/fpdf.php');

$invoice=base64_decode($_REQUEST["invo"]);

$sql="SELECT * FROM `order_list` WHERE invoice_no='$invoice'";
$queary=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($queary);
$order_date=$row['date'];
$user_name=$row['name'];
$house_address=$row['house_address'];
$street_address=$row['street_address'];
$city=$row['city'];
$subtotal=$row['total'];
$delivery_charges=$row['delivery_charges'];
$hotel_address = "DURGACHAK , EAST MIDNAPORE , WEST BENGAL";
/*if($sell_by=='Admin')
{
    $p_query=mysqli_query($conn,"SELECT * FROM `admin` WHERE 1");
    $p_result=mysqli_fetch_assoc($p_query);
    $seller_name=$p_result['name'];
}
else
{
    $p_query=mysqli_query($conn,"SELECT * FROM `vendor` WHERE `vendor_id`='$seller_id'");
    $p_result=mysqli_fetch_assoc($p_query);
    $f_name=$p_result['f_name'];
    $l_name=$p_result['l_name'];
    $seller_name=$f_name.' '.$l_name;
}*/


/*$user_query=mysqli_query($conn,"SELECT * FROM `user` WHERE email='$user_email'");
$user_result=mysqli_fetch_assoc($user_query);
$u_phone=$user_result['phone_no'];


$camping_id=$row['camping_id'];
$hotel_query=mysqli_query($conn,"SELECT * FROM `tour` WHERE `tour_id`='$camping_id'");
$hotel_result=mysqli_fetch_assoc($hotel_query);
$hotel_name=$hotel_result['tour_name'];
$hotel_address=$hotel_result['location'];
*/

                  
$pdf = new FPDF();
$pdf->AddPage(); // add fpdf fuction 
$pdf->SetFont('Arial','B',11); // font style
$pdf->SetTitle('E-Commerce Store');

$pdf->Cell(80,7,'','TL',0,0);
$pdf->Cell(30,7,'BOOKING','T',0,'C',0);
$pdf->Cell(80,7,'','TR',0,1);
$pdf->Cell(0,7,'',0,1);
$pdf->Cell(190,15,'','T',0,0);
$pdf->Cell(0,0,'',0,1);


$pdf->Cell(100,15,'E-Commerce Store - '.$seller_name,'LR',0,1);
$pdf->SetFont('Arial','B',9); // font style
$pdf->Cell(45,8,'BOOKING ID- '.$invoice,'B',0,'L',0);
$pdf->Cell(45,8,'DATE- '.$order_date,'RB',0,'R',0);

$pdf->Cell(0,7,'',0,1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(100,13,$hotel_name,'LR',0,1);
$pdf->SetFont('Arial','B',9); // font style
$pdf->Cell(90,13,'CUSTOMER NAME - ' . $user_name,'R',0,'L',0);
$pdf->Cell(0,0,'',0,1);


$pdf->Cell(0,7,'',0,1);
$pdf->SetFont('Arial','',9); // font style
$pdf->Cell(100,13,substr($hotel_address,0,54),'LR',0,1);
$pdf->SetFont('Arial','',7); // font style
$pdf->Cell(90,13,'Customer House No - '.$house_address,'R',0,'L',0);
$pdf->Cell(0,0,'',0,1);

$pdf->SetFont('Arial','',9);
$pdf->Cell(0,7,'',0,1);

$pdf->Cell(50,13,''.$hotel_phone,'L',0,'L',0);
$pdf->Cell(50,13,'',0,'R',0);
//$pdf->Cell(0,13,'',R,0,0);


$pdf->SetFont('Arial','',9); // font style
$pdf->Cell(45,13,'Street. - '. $street_address,'L',0,'L',0);
$pdf->Cell(45,13,'','R',0,'L',0);
$pdf->Cell(0,0,'',0,1);
$pdf->Cell(0,13,'','B',1,1);



$pdf->SetFont('Arial','B',10); // font style
//

$pdf->Cell(10,13,'Sl No','LRB',0,'L',0,'',true);
$pdf->SetFillColor(250,250,250);
//$pdf->ln();
//$pdf->Cell(55,13,'ITEM DESCRIPTION',RB,0,C,0);

$pdf->Cell(70,13,'PRODUCT NAME','RB',0,'C',0);
//$pdf->Cell(15,13,'HNS',RB,0,C,0);
$pdf->Cell(20,13,'QTY.','RB',0,'C',0);
// $pdf->Cell(15,13,'ADULT','RB',0,'C',0);
// $pdf->Cell(35,13,'CHILD','RB',0,'C',0);
$pdf->Cell(90,13,'AMOUNT','RB',0,'C',0);
 $pdf->Cell(0,13,'',1,1);
// $pdf->Cell(0,13,'',B,0,1);




$sql22 = "SELECT * FROM `ordered_product` WHERE invoice_no='$invoice'";
$result22 = mysqli_query($conn, $sql22);
   $t="";
   $gst4="";
   $i=1;
   $sub_tot='';
   $sub_total2=0;
    // output data of each row
    while($row22 = mysqli_fetch_assoc($result22)){
    
    $hotel_id22=$row22['camping_id'];
    $room=$row22['no_of_camp'];
    $product_quntity=$row22['product_quntity'];
    $product_price=$row22['product_price'];
    $amnt=$row22['tot_amount'];
     $product_name=$row22['product_name'];
    
    
 /*   $ht_query=mysqli_query($conn,"SELECT * FROM `tour` WHERE `tour_id`='$hotel_id22'");
    $ht_result=mysqli_fetch_assoc($ht_query);
    
    // $product_name=$ht_result['tour_name'];
    $in_time=$ht_result['checkin'];
    $out_time=$ht_result['checkout'];*/
    



$pdf->SetFont('Arial','',9); // font style
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
  
  $pdf->Cell(20,($line * $cellHeight),$product_quntity,1,0); //adapt height to number of lines
  
 //$pdf->Cell(15,($line * $cellHeight),$adult,1,0);
 //$pdf->Cell(35,($line * $cellHeight),$child,1,0);
 $pdf->Cell(90,($line * $cellHeight),'Rs '. $product_price,1,1);
 

$i++;
}

// blank cell for table


//$pdf->Cell(5,13,'',0,L,0);
$pdf->Cell(10,13,'','L',0,0);
$pdf->Cell(70,13,'','RL',0,0);
//$pdf->Cell(15,13,'',R,0,0);
$pdf->Cell(20,13,'','R',0,0);
// $pdf->Cell(15,13,'','R',0,0);
// $pdf->Cell(35,13,'','R',0,0);
$pdf->Cell(90,13,'','R',0,0);
 $pdf->Cell(0,13,'',1,1);


$pdf->Cell(10,13,'','L',0,0);
$pdf->Cell(70,13,'','RL',0,0);
//$pdf->Cell(15,13,'',R,0,0);
$pdf->Cell(20,13,'','R',0,0);
// $pdf->Cell(15,13,'','R',0,0);
// $pdf->Cell(35,13,'','R',0,0);
$pdf->Cell(90,13,'','R',0,0);
 $pdf->Cell(0,13,'',1,1);




$pdf->Cell(10,13,'','LB',0,0);
$pdf->Cell(70,13,'','RLB',0,0);
//$pdf->Cell(15,13,'',RB,0,0);
$pdf->Cell(20,13,'','RB',0,0);
// $pdf->Cell(15,13,'','RB',0,0);
// $pdf->Cell(35,13,'','RB',0,0);
$pdf->Cell(90,13,'','RB',0,0);
 $pdf->Cell(0,13,'',1,1);
 
 
$pdf->Cell(100,5,'','RL',0,0);
$pdf->Cell(35,5,'Delivery Charge','R',0,0);
$pdf->Cell(55,5,$delivery_charges,'R',1,0);
//end blank cell for table

//GST Table
$pdf->SetFont('Arial','B',9); // font style
$pdf->Cell(5,7,'','L',0,0);
$pdf->Cell(15,6,'',0,'C',0);
$pdf->Cell(20,6,'',0,'C',0);
$pdf->Cell(20,6,'',0,'C',0);
$pdf->Cell(20,6,'',0,0);

$pdf->Cell(20,7,'','R',0,0);
$pdf->SetFont('Arial','B',10); // font style
$pdf->Cell(35,7,'SUB TOTAL',0,'L',0);
$pdf->Cell(0,7,'Rs '.$subtotal,'L',0,'R',0);




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
$pdf->Cell(35,7,'',0,'R',0);
$pdf->Cell(0,7,'','LR',0,'R',0);
$pdf->Cell(0,7,'',1,1);



// $pdf->Cell(115,8,'',R,0,0);
$pdf->SetFont('Arial','B',8);
// $pdf->Cell(35,8,'SHIPPING CHARGE',R,0,0);
// $pdf->SetFont('Arial','B',12); // font style
// $pdf->Cell(40,8,Rs .$row['shipping_price'],R,0,R,0);
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
