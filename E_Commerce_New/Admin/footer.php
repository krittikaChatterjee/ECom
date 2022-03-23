</div><!--  Wrapper End -->
        <!--<footer class="footer">-->
        <!--    <div class="container">-->
        <!--        <div class="text-center">-->
        <!--            Copyright © 2019 Sundar Dibya-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</footer>-->
            
        <!-- Bootstrap core JavaScript-->
          <script src="assets/js/jquery.min.js"></script>
          <script src="assets/js/popper.min.js"></script>
          <script src="assets/js/bootstrap.min.js"></script>
          
          <!-- simplebar js -->
          <script src="assets/plugins/simplebar/js/simplebar.js"></script>
          <!-- waves effect js -->
          <script src="assets/js/waves.js"></script>
          <!-- sidebar-menu js -->
          <script src="assets/js/sidebar-menu.js"></script>
          <!-- Custom scripts -->
          <script src="assets/js/app-script.js"></script>
         <!--Data Tables js-->
          <script src="assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/jszip.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/pdfmake.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/vfs_fonts.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/buttons.html5.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/buttons.print.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js"></script>
          
          <!--<script src="https://www.gstatic.com/firebasejs/7.14.5/firebase-app.js"></script>-->
          <!--<script src="https://www.gstatic.com/firebasejs/7.14.5/firebase-messaging.js"></script>-->

        <script>
         $(document).ready(function() {
          //Default data table
           $('#default-datatable').DataTable();


           var table = $('#example').DataTable( {
            lengthChange: true,
            buttons: [ 'excel' ]
          } );
     
         table.buttons().container()
            .appendTo( '#example_wrapper .col-md-6:eq(0)' );
          
          } );
        </script>

        <!-- MultiSelect DropDown-->
        <script src="assets/plugins/select2/js/select2.min.js"></script>
        <script src="assets/plugins/jquery-multi-select/jquery.multi-select.js"></script>
        <script src="assets/plugins/jquery-multi-select/jquery.quicksearch.js"></script>
    
        <script>
          $(document).ready(function() {
            $('.single-select').select2();
      
            $('.multiple-select').select2();

        //multiselect start

            $('#selectQQ').multiSelect();
          });
        </script>
        
        <!-- The core Firebase JS SDK is always required and must be listed first -->
		
    </body>
</html>