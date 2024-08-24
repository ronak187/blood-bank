<footer class="footer">
  <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="https://www.yahoobaba.net/">YahooBaba</a></strong>
</footer>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/actions.js"></script>
<script>
    $(document).ready(function(){
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

    //Display Select Box when Checkbox is Checked
    function myFunction() {
            var checkBox = document.getElementById("myCheckbox");
            var blood_group = document.getElementById("blood_group");
            if (checkBox.checked == true){
                blood_group.style.display = "block";
            } else {
                blood_group.style.display = "none";
            }
    }
</script>

</body>
</html>