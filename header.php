<?php 
    include 'admin/php_files/config.php';
    if(!session_id()){ session_start();}

    // if(!isset($_SESSION['id'])){
    //     header("location:{$base_url}");
    // }

    if(!file_exists('admin/php_files/database.php')){
        header('location:'.$base_url.'install');
        die();
    }

    $db = new Database();
    $db->select('admin','admin_fullname,site_name,site_logo',null,null,null,null);
    $result = $db->getResult();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if(isset($title) && $title != ''){ ?>
        <title><?php echo $title.' > '.$result[0]['site_name'] ?></title>
    <?php }else{ ?>
        <title><?php echo $result[0]['site_name'] ?></title>
    <?php } ?>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="row">
                <?php 
                    $db = new Database();
                    $db->select('admin','*',null,null,null,null);
                    $result = $db->getResult();
                ?>
                <div class="col-lg-4 col-sm-6">
                    <h2 class="m-0"><a href="index.php" class="site-title"><?php echo $result[0]['site_name'] ?></a></h2>
                </div>
                
                <div class="col-lg-8 col-sm-6 d-flex justify-content-end login-btn">
                    <?php 
                        if(isset($_SESSION['id'])){ ?>
                            <div class="dropdown">
                                <button class="btn btn1 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Hello, <?php echo $_SESSION['name']; ?>  
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="profile.php">My Profile</a>
                                    <a class="dropdown-item" href="change-password.php">Change Password</a>
                                    <a class="dropdown-item logout" href="#">Logout</a>
                                </div>
                            </div>
                    <?php }else{ ?>
                            <a href="user-login.php" class="btn1 btn">Login</a>
                            <a href="signup.php" class="btn1 btn">Sign Up</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
