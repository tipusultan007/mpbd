  <footer class="footer">
      <div class="container">
   <p class="text-muted">&copy; <?php
echo date("Y");
       ?> MPBD - <span>Developed by <a href="http://tentechsoft.com">Tentechsoft</a> </span></p>
      </div>
  </footer>
</div>

    <!-- Bootstrap --> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
    
    <!--DataTables-->
    <script src="assets/plugins/datatables/datatables.min.js"></script>

  <script>
      $(document).ready(function () {

          $('#datatable').dataTable({
              "responsive": true,
              "language": {
                  "paginate": {
                      "previous": '<i class="fa fa-angle-left"></i>',
                      "next": '<i class="fa fa-angle-right"></i>'
                  }
              }
          });
      });
  </script>

  </body>
</html>