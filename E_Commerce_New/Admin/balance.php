<?php 
 include('header.php');
 include('sidebar.php');
 ?>
 <style type="text/css">
 	.wallet_img{
 		margin: 0 auto;
 		display: table;
 		   
 		
 	}
 </style>
  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Wallet </h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Wallet</a></li>
            <li class="breadcrumb-item active" aria-current="page">  Wallet</li>
         </ol>
       </div>
     </div><!-- End Breadcrumb-->

     <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">


            	
                 
                   
                  
              <form id="personal-info" method="post" enctype="multipart/form-data">
                <h4 class="form-header">
                  <i class="fa fa-file-text-o"></i>
                   Wallet
                </h4>
                <div class="form-group" >
                	 <div class="col-sm-6 wallet_img">
                	<img src="assets/images/business-and-finance.png" class="mx-auto d-block" style=" max-width: 100%; max-height: 200px;"> 
                    </div>
                </div>

                  
                <div class="form-group wallet_img">
                     
                     <!--<div class="col-sm-2 col-form-label ">-->
                      <label for="exampleInputEmail1">Add Amount</label>
                    <!--</div>-->
                
                     <div class="col-sm-12">
                    <input type="number" name="stock_number" id="stock_number" class="form-control" placeholder="Amount" required>
                   </div>
                </div>

            
                <!--<div class="form-group wallet_img">-->
                     
                       
                <!--  <label for="input-5" class="col-sm-1 col-form-label">Wallet</label>-->
                <!--  <div class="col-sm-5 ">-->
                <!--    <input type="number" name="stock_number" id="stock_number" class="form-control" placeholder="Amount" required>-->
                <!--  </div style="float: right;">-->
                <!--</div>-->
                
                
          
                <div class="form-footer " align="center">
                    <button type="button" onclick="location.reload()" class="btn btn-danger"><i class="fa fa-times"></i> CANCEL</button>
                    <button type="submit" name="submitbtn" class="btn btn-success"><i class="fa fa-check-square-o"></i> SAVE</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!--End Row-->
    </div><!-- End container-fluid -->
  </div><!-- End content-wrapper-->
  
<?php 
include('footer.php');
?>