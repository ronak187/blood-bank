<?php 
require "vendor/autoload.php";
require "config-cloud.php";
	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$imgdb = $_POST['imgdb'];
		//$gamber = $_FILES['file']['name'];
		$file_tmp=$_FILES['file']['tmp_name'];
	\Cloudinary\Uploader::upload($file_tmp,array("public_id"=> $imgdb ));
	
  }

 $con = mysqli_connect('localhost','root','mysql');
  if(!$con)
  {
    echo 'Not connected to server';
  }
  if(!mysqli_select_db($con,'Ideal'))
  {
    echo 'Database not selected';
  }
  $name = $_POST['name'];
  $imgdb = $_POST['imgdb'];

  $sql = "INSERT INTO image(rname,dbname) VALUES ('$name','$imgdb)";

  if(!mysqli_query($con,$sql))
  {
    echo 'Not inserted';
  }
  else
  {
    echo 'inserted';
  }
  header("url=index.php");

 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ideal Village</title>
  <style type="text/css">
    img{width: 200px; margin-right: 10px;}

  </style>
</head>
<body>
	
<form method="post" enctype="multipart/form-data">
	<input type="text" name="name" required="" placeholder="name ">
	<input type="text" name="imgdb" required="" placeholder="Image name in DB">
	<!-- <input type="file" name="file"> -->
  <?php echo cl_image_upload_tag('image_id'); ?> 
	<input type="submit" name="submit" value="Submit">
</form>
<br>
<hr>
<?php echo cl_image_tag('avc'); ?>
</body>
</html>