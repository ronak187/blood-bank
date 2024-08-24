<?php
if (!file_exists('php_files/database.php')) {
	header('location: ../install');
	die();
}

// $password = md5("choot");
// echo $password;

include "./php_files/config.php";
$dbs = new Database();
$dbs->select('admin', 'site_name,site_logo', null, null, null, null);
$settings = $dbs->getResult();

if (!session_id()) {
	session_start();
}
if (isset($_SESSION['admin_id'])) {
	header("Location: dashboard/dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $settings[0]['site_name']; ?> | Log in</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="./assets/css/fontawesome-free/css/all.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="./assets/css/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="./assets/css/adminlte.min.css">
</head>
<div class="message"></div>

<body class="hold-transition login-page">

	<div class="login-box">
		<div class="login-logo">
			<a href="#"><?php echo $settings[0]['site_name']; ?></a>
		</div>
		<!-- /.login-logo -->
		<div class="card">
			<div class="card-body login-card-body">
				<form id="login" action="" method="POST" autocomplete="off">
					<div class="input-group mb-3">
						<input type="text" class="form-control username" name="username" placeholder="Username" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control password" name="password" placeholder="Password" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="offset-md-8 col-4">
							<input type="submit" class="btn btn-primary float-right" name="login" value="Login">
						</div>
					</div>
				</form>

			</div>
			<!-- /.login-card-body -->
		</div>
	</div>
	<!-- /.login-box -->

	<!-- jQuery -->
	<script src="./assets/js/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="./assets/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="./assets/js/adminlte.min.js"></script>
	<script src="./assets/js/admin.js"></script>
</body>

</html>