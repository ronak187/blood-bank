<?php 
  include "php_files/config.php";

  if(!file_exists('../php_files/database.php')){
    header('location:'.$base_url.'install');
    die();
  }
  
  if(!session_id()){ session_start();}

  if(!isset($_SESSION['admin_id'])){
    header("location:{$base_url}admin");
  }

  $db = new Database();
  $db->select('admin','*',null,null,null,null);
  $result = $db->getResult();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php if(isset($title) && $title != ''){ ?>
    <title><?php echo $title.' > '.$result[0]['site_name'] ?></title>
  <?php }else{ ?>
    <title><?php echo $result[0]['site_name'] ?></title>
  <?php } ?>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/css/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/css/responsive.bootstrap4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../assets/css/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/css/adminlte.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
      </li>
    </ul>
    <ul class="navbar-nav">
      <div class="dropdown">
        
          <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php
              if(!session_id()){
                  session_start();
              }
            echo 'Hello '.$_SESSION['admin_fullname']; ?>
          
          </button>
          
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="../change-password/changepassword.php">Change Password</a>
              <a class="dropdown-item logout" href="#">Log Out</a>
          </div>
      </div>
    </ul>
  </nav>
  <!-- /.navbar -->
