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
                     
                   
                  ?>
                    <tr>
                      <td><?php echo $c;  ?></td>
                      <td><?php echo $row_user_name['name'];  ?></td>
                      <td><?php echo $row['invoice_no'];  ?></td>
                      <td><?php 
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
                      
                      ?></td>
                      <td>
                      	<?php
                      		$qtu_query = mysqli_query($conn,"SELECT * FROM `ordered_product` WHERE invoice_no='".$row['invoice_no']."'");
                      		while($qtu_result = mysqli_fetch_assoc($qtu_query)){
                      			echo $qtu_result['product_count']."<br>";
                      		}
                      	?>
                      </td>
                      <td><?php 
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
                      
                      
                      ?></td>
                      <td><?php echo $row['total'];  ?></td>
                      <td>	<a href="view_product_details.php?invo=<?=$row['invoice_no']?>" class="bill-btn5 hover-btn">View</a></td>
                      
                      <td><?php echo $row['delivery_charges'];  ?></td>
                      
                      <?php
                    	if($row['status'] != 'CANCELLED'){
                      ?>
                      <td>
	                      <select class="form-control" name="order_status" id="order_status<?=$row['invoice_no']?>" onchange="order_status_cng('<?=$row['invoice_no']?>','<?=$row['user_id']?>')">
	                      		<option value="PLACED" <?php echo ($row['status'] == 'PLACED') ? 'selected' : ''; ?>>PLACED</option>
	                      		<option value="PACKED" <?php echo ($row['status'] == 'PACKED') ? 'selected' : ''; ?>>PACKED</option>
	                      		<option value="DISPATCHED" <?php echo ($row['status'] == 'DISPATCHED') ? 'selected' : ''; ?>>DISPATCHED</option>
	                      		<option value="DELIVERED" <?php echo ($row['status'] == 'DELIVERED') ? 'selected' : ''; ?>>DELIVERED</option>
	                      		
	                      </select>
	                   </td>
                      <?php
                    	}else{
                    		echo "<td style='color:red'>".$row['status']."</td>";
                    	}
                      ?>
                      
                      <!--<td style="color:<?=$row['received_status'] == 'N' ? 'red' : 'green'?>">
                      	<?=$row['received_status'] == 'N' ? 'No' : 'Yes'?>
                      </td>-->
                      
                      <td><?php echo $row['house_address'];  ?></td>
                      <td><?php echo $row['street_address'];  ?></td>
                      <td><?php echo $row['state'];  ?></td>
                      <td><?php echo $row['city'];  ?></td>
                      <td><?php echo $row['pin'];  ?></td>
                      <td><?php echo $row['landmark'];  ?></td>
                      <td><?php echo $row['phno'];  ?></td>
                      <td><?php echo $row['date'];  ?></td>
                      <td><?php echo $row['order_time'];  ?></td>
                      <td><?php echo $row['payment_type'];  ?></td>
                      <td><?php echo $row['payment_status'];  ?></td>
                      <!--<td><?php echo $row['delivery_time'];  ?></td>-->
                      <?php
                      if($row['status'] == 'CANCELLED'){
                      ?>
                      <td><button type="button" class="btn btn-danger statuspro_<?=$row['order_id']?>">CANCELLED</button></td>

                      <?php } else if($row['status'] == 'DELIVERED'){ ?>

                      	<td></td>

                      <?php } else{?>
                    	<td><button type="button" class="btn btn-info statuspro_<?=$row['order_id']?>" onclick="change_status_cancel('<?=$row['order_id']?>','<?=$row['user_id']?>')">CANCEL</button></td>
                      <?php } ?>
                      <td>
                      	<a href="booking_invoice_pdf.php?invo=<?=base64_encode($row['invoice_no'])?>&user=<?=base64_encode($row['user_id'])?>" target="_blank" class="bill-btn5 hover-btn">View Bill</a>
                      </td>
                      
                          

                     
                      
                    </tr>
                  <?php
                      $c++;