<?php 
 include('header.php');
 include('sidebar.php');
 ?>
<?php
    $view_query = mysqli_query($conn,"SELECT * FROM `shopping_bonus` WHERE `s_id`='1'");
    $view_result = mysqli_fetch_assoc($view_query);
?>
  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <h4 class="page-title">Poster</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Poster</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Add Poster</li>
         </ol>
       </div>
     </div><!-- End Breadcrumb-->

     <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <div class="alert alert-success alert-dismissible" role="alert" id="success_box">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon contrast-alert">
                        <i class="icon-info"></i>
                    </div>
                    <div class="alert-message">
                        <span><center><strong> Success !!! Bonus Updated Successfully </strong></center></span>
                    </div>
                </div>
                <div class="alert alert-info alert-dismissible" role="alert" id="deneger_box">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon contrast-alert">
                        <i class="icon-info"></i>
                    </div>
                    <div class="alert-message">
                        <span><center><strong> Sorry !!! Please Try Again </strong></center></span>
                    </div>
                </div>
                
              <form id="personal-info" method="post" enctype="multipart/form-data">
                <h4 class="form-header">
                  <i class="fa fa-file-text-o"></i>
                  Manage Referral Bonus
                </h4>

                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Total Order Amount</label>
                    <div class="col-sm-6">
                        <input type="text" name="join_bonus" id="join_bonus" value="<?=$view_result['order_amount']?>" class="form-control" placeholder="Join Bonus"  required>
                      
                    </div>
                  
                </div>

                <div class="form-group row">
                    <label for="input-5" class="col-sm-2 col-form-label">Bonus</label>
                    <div class="col-sm-6">
                        <input type="text" name="referral_bonus" id="referral_bonus" value="<?=$view_result['bonus']?>" class="form-control" placeholder="Referral Bonus"  required>
                    </div>
                  
                </div>
          
                <div class="form-footer">
                    <button type="button" onclick="location.reload()" class="btn btn-danger"><i class="fa fa-times"></i> CANCEL</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> SAVE</button>
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

<script>
    $(document).ready(function(){
        $("#success_box").css("display","none");
        $("#deneger_box").css("display","none");
    })
    $('#personal-info').on('submit',(function(e){
        // alert('ok');
        e.preventDefault();
        var formData = new FormData($(this).parents('form')[0]);
        var test = new FormData(this);
        
        $.ajax({
            url: "api/manage_shopping_bonus.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function (data) {
                if(data==1){
                    $("#success_box").css("display","block");
                    setTimeout(function(){ 
                      $("#success_box").css("display","none");  
                    }, 3000);
                }
                
            },
            error: function(){}             
        });
    }));
</script>
<script>
    (function($) {
      $.fn.inputFilter = function(inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
          if (inputFilter(this.value)) {
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
          } else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
          }
        });
      };
    }(jQuery));
</script>
<script>
    $(document).ready(function(){
        $("#join_bonus").inputFilter(function(value){
            return /^\d*$/.test(value);
        })
        
        $("#referral_bonus").inputFilter(function(value){
            return /^\d*$/.test(value);
        })
    })
</script>