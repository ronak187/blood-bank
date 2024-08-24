<?php $title = "Dashboard";
include "../sidebar.php" ?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Dashboard</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item active">Dashboard</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<?php
					$db = new Database();
					$db->sql("SELECT COUNT(*) AS total_donor FROM donor");
					$result = $db->getResult();
					if (!empty($result)) {
						foreach ($result as $row) {
					?>
							<div class="small-box bg-info">
								<div class="inner">
									<h3><?php echo $row['total_donor'] ?></h3>
									<p>Total Donors</p>
								</div>
								<div class="icon">
									<i class="fas fa-users"></i>
								</div>
								<a href="../donor/donor.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
					<?php
						}
					}
					?>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<?php
					$db = new Database();
					$db->sql("SELECT COUNT(*) AS total_blood_group FROM blood_group");
					$result = $db->getResult();
					if (!empty($result)) {
						foreach ($result as $row) {
					?>
							<div class="small-box bg-success">
								<div class="inner">
									<h3><?php echo $row['total_blood_group'] ?></h3>
									<p>Total Blood Group</p>
								</div>
								<div class="icon">
									<i class="fas fa-clinic-medical"></i>
								</div>
								<a href="../blood-group/blood.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
					<?php
						}
					}
					?>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<?php
					$db = new Database();
					$db->sql("SELECT COUNT(*) AS total_city FROM city");
					$result = $db->getResult();
					if (!empty($result)) {
						foreach ($result as $row) {
					?>
							<div class="small-box bg-warning">
								<div class="inner">
									<h3><?php echo $row['total_city'] ?></h3>
									<p>Total City</p>
								</div>
								<div class="icon">
									<i class="nav-icon fas fa-city"></i>
								</div>
								<a href="../city/city.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
					<?php
						}
					}
					?>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<?php
					$db = new Database();
					$db->sql("SELECT COUNT(*) AS total_user FROM user");
					$result = $db->getResult();
					if (!empty($result)) {
						foreach ($result as $row) {
					?>
							<div class="small-box bg-danger">
								<div class="inner">
									<h3><?php echo $row['total_user'] ?></h3>
									<p>Total Users</p>
								</div>
								<div class="icon">
									<i class="nav-icon fas fa-user"></i>
								</div>
								<a href="../users/user.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
					<?php
						}
					}
					?>
				</div>
				<!-- ./col -->
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<?php include "../footer.php" ?>