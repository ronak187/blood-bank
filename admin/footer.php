<!-- /.content-wrapper -->
<footer class="main-footer">
  <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="https://www.yahoobaba.net/">yahoobaba.net</a>.</strong>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../assets/js/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="../assets/js/bootstrap.bundle.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/js/dataTables.responsive.min.js"></script>
<script src="../assets/js/responsive.bootstrap4.min.js"></script>
<script src="../assets/js/dataTables.buttons.min.js"></script>
<script src="../assets/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/js/pdfmake.min.js"></script>
<script src="../assets/js/vfs_fonts.js"></script>
<script src="../assets/js/buttons.html5.min.js"></script>
<script src="../assets/js/buttons.print.min.js"></script>

<!-- AdminLTE App -->
<script src="../assets/js/adminlte.min.js"></script>
<script src="../assets/js/admin.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('.col-md-6:eq(0)');
    
    var report = $('#group-report').DataTable({
        ajax:{
          'processing': true,
          'serverSide': true,
          'serverMethod': 'POST',
          'url':'../php_files/reports.php',
          'data': function(data){
              var val = $('.blood_group option:selected').val();
              data.blood_group = val;
          },
          'columns': [
            { data: 's_no' },
            { data: 'donor_img' },
            { data: 'donor_name' },
            { data: 'email' },
            { data: 'phone' },
            { data: 'city_name' },
            { data: 'name' },
          ],
        },
        dom: 'Bfrtip',
        buttons: ['pdf', 'print']
    });
    // reload report table
    $('#blood-group-report').submit(function(e){
        e.preventDefault();
        report.ajax.reload();
    });

    // load image with jquery
    $('.image').change(function(){
        readURL(this);
    });

    // preview image before upload
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#image').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }
  });
</script>

</body>
</html>
