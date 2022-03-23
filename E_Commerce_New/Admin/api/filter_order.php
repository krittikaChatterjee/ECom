<?php
	include('../connection.php');
	
	$val = mysqli_real_escape_string($conn,$_POST['val']);
	$order_type = mysqli_real_escape_string($conn,$_POST['order_type']);
	
	echo "<thead>
                    <tr>
                        <th>Sl. Number</th>
                        <th>User Name</th>
                        <th>Invoice</th>
                        <!--<th>User Name</th>-->
                        <th>Product Name</th>
                        <th>Quentity</th>
                        <th>Product Price </th>
                        <th>Total Amount</th>
                        <th>Delivery Charges</th>
                        <th>Status</th>
                        <th>User Received</th>
                        <th>House Address</th>
                        <th>Street Address</th>
                        <th>User State</th>
                        <th>User City</th>
                        <th>User Pin</th>
                        <th>Landmark</th>
                        <th>Phone Number</th>
                        <th>Order Date</th>
                        <th>Order Time</th>
                        <th>Payment Type</th>
                        <th>Payment Status</th>
                        <th>Delivery Date</th>
                        <th>Cancel Order</th>
                        
                       
                    
                    </tr>
                  </thead>
                  <tbody>";
                  
                    $c=1;
                    if($val == 'All'){
                    	if($order_type == 'All'){
                    		$sql="SELECT * FROM `order_list` ORDER BY order_id DESC";
                    	}else if($order_type == 'Normal'){
                    		$sql="SELECT * FROM `order_list` WHERE `exp_status`='N' ORDER BY order_id DESC";
                    	}else{
                    		$sql="SELECT * FROM `order_list` WHERE `exp_status`='Y' ORDER BY order_id DESC";
                    	}
                    	
                    }else{
                    	if($order_type == 'All'){
                    		$sql="SELECT * FROM `order_list` WHERE `status`='$val' ORDER BY order_id DESC";
                    	}else if($order_type == 'Normal'){
                    		$sql="SELECT * FROM `order_list` WHERE `status`='$val' AND `exp_status`='N' ORDER BY order_id DESC";
                    	}else{
                    		$sql="SELECT * FROM `order_list` WHERE `status`='$val' AND `exp_status`='Y' ORDER BY order_id DESC";
                    	}
                    	
                    }
                    
                    $queary=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($queary))
                    {
                        $delivery_type_id=$row['delivery_type_id'];
                        $loc_query=mysqli_query($conn,"SELECT * FROM nearest_point WHERE id='$delivery_type_id'");
                        $loc_fetch=mysqli_fetch_assoc($loc_query);
                        
                        $loc_name=$loc_fetch['name'];
                        $locc=$loc_fetch['location'];
                        $location=$loc_name.",".$locc;
                   
                    $idd=$row['order_id'];
                      $invoice_no=$row['invoice_no'];
                      
                      // fetch user 
                      $fetch_user_name = "SELECT * FROM `users` WHERE u_id='".$row['user_id']."'";
                      $fetch_user_name_read = mysqli_query($conn,$fetch_user_name);
                      $row_user_name = mysqli_fetch_array($fetch_user_name_read);

                    echo "<tr>
                      <td>".$c."</td>
                      <td>".$row_user_name['name']."</td>
                      <td>".$row['invoice_no']."</td>
                      <td>";
                      $inv =  $row['invoice_no']; 
                      $fetch_product_id = "SELECT * FROM `ordered_product` WHERE invoice_no='$inv'";
                      $fetch_product_id_read = mysqli_query($conn,$fetch_product_id);
                      while($row_product = mysqli_fetch_array($fetch_product_id_read)){
                      	$product_id = $row_product['product_id'];
                      	// fetch product name 
                      	$fetch_product_name = "SELECT * FROM `product` WHERE product_id='$product_id'";
                      	$fetch_product_name_read = mysqli_query($conn,$fetch_product_name);
                      	$row_product_name = mysqli_fetch_array($fetch_product_name_read);
                      	echo $row_product_name['product_name']." ".$row_product['product_quntity']."<br>";
                      	
                      }
                      
                      echo "</td>
                      <td>";
                      
                  		$qtu_query = mysqli_query($conn,"SELECT * FROM `ordered_product` WHERE invoice_no='".$row['invoice_no']."'");
                  		while($qtu_result = mysqli_fetch_assoc($qtu_query)){
                  			echo $qtu_result['product_count']."<br>";
                  		}
                  		
                      echo "</td>
                      <td>";
                       $inv =  $row['invoice_no']; 
                      $fetch_product_id = "SELECT * FROM `ordered_product` WHERE invoice_no='$inv'";
                      $fetch_product_id_read = mysqli_query($conn,$fetch_product_id);
                      while($row_product = mysqli_fetch_array($fetch_product_id_read)){
                      	$product_count = $row_product['product_count'];
                      	$product_price = $row_product['product_price'];
                      	// fetch product name 
                    	$tot_prc = $product_count*$product_price;
                    		echo $tot_prc."<br>";
                    	
                      }
                      
                      
                      echo "</td>
                      <td>".$row['total']."</td>
                      <td>".$row['delivery_charges']."</td>";
                      
                      if($row['status'] != 'CANCELLED'){
                    		
                      echo "<td>
	                      <select class='form-control' name='order_status' id='order_status".$row['invoice_no']."' onchange='order_status_cng(\"".$row['invoice_no']."\",\"".$row['user_id']."\")'>
	                      		<option value='PLACED' ";
	                      		if($row['status'] == 'PLACED'){
	                      			echo 'selected';
	                      		} 
	                      		echo ">PLACED</option>
	                      		<option value='PACKED' ";
	                      		if($row['status'] == 'PACKED'){
	                      			echo 'selected';
	                      		}
	                      		echo ">PACKED</option>
	                      		<option value='DISPATCHED' ";
	                      		if($row['status'] == 'DISPATCHED'){
	                      			echo 'selected';
	                      		} 
	                      		echo ">DISPATCHED</option>
	                      		<option value='DELIVERED' ";
	                      		if($row['status'] == 'DELIVERED'){
	                      			echo 'selected';
	                      		} 
	                      		echo ">DELIVERED</option>
	                      		
	                      </select>
	                   </td>";
                    	}else{
                    		echo "<td style='color:red'>".$row['status']."</td>";
                    	}
                      
                      echo "<td style='color:";
                    	if($row['received_status'] == 'N'){
                    		echo 'red';
                    	}else{
                    		echo 'green';
                    	}
                      echo "'>";
                    	if($row['received_status'] == 'N'){
                    		echo 'No';
                    	}else{
                    		echo 'Yes';
                    	}
                      echo "</td>
                      
                      <td>".$row['house_address']."</td>
                      <td>".$row['street_address']."</td>
                      <td>".$row['state']."</td>
                      <td>".$row['city']."</td>
                      <td>".$row['pin']."</td>
                      <td>".$row['landmark']."</td>
                      <td>".$row['phno']."</td>
                      <td>".$row['date']."</td>
                      <td>".$row['order_time']."</td>
                      <td>".$row['payment_type']."</td>
                      <td>".$row['payment_status']."</td>
                      <td>".$row['delivery_time']."</td>";
                      
                      if($row['status'] == 'CANCELLED'){
                		  echo "<td><button type='button' class='btn btn-danger statuspro_".$row['order_id']."'>CANCELLED</button></td>";
                      } else if($row['status'] == 'DELIVERED'){
                      	echo "<td></td>";
                      } else {
                      echo 	"<td><button type='button' class='btn btn-info statuspro_".$row['order_id']."' onclick='change_status_cancel(\"".$row['order_id']."\",\"".$row['user_id']."\")'>CANCEL</button></td>";
                      }
                      
                    echo "</tr>";
                      $c++;
                    }
                    
                  echo "</tbody>
                  <tfoot>
                    <tr>
                     <th>Sl. Number</th>
                        <th>User Name</th>
                        <th>Invoice</th>
                        <!--<th>User Name</th>-->
                        <th>Product Name</th>
                        <th>Quentity</th>
                        <th>Product Price </th>
                        <th>Total Amount</th>
                        <th>Delivery Charges</th>
                        <th>Status</th>
                        <th>User Received</th>
                        <th>House Address</th>
                        <th>Street Address</th>
                        <th>User State</th>
                        <th>User City</th>
                        <th>User Pin</th>
                        <th>Landmark</th>
                        <th>Phone Number</th>
                        <th>Order Date</th>
                        <th>Order Time</th>
                        <th>Payment Type</th>
                        <th>Payment Status</th>
                        <th>Delivery Date</th>
                        <th>Cancel Order</th>
                    </tr>
                  </tfoot>";
?>