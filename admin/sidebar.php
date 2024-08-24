<?php include "header.php" ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <?php 
      $db = new Database();
      $db->select('admin','*',null,null,null,null);
      $result = $db->getResult();
    ?>
    <?php 
      if(!empty($result[0]['site_logo'])){ ?>
        <a href="../dashboard/dashboard.php" class="brand-link">
          <img src="../images/site-logo/<?php echo $result[0]['site_logo'] ?>" alt="" style="width:200px;">
        </a>
    <?php }else{ ?>
        <a href="../dashboard/dashboard.php" class="brand-link">
          <span class="brand-text font-weight-light">Blood Donation</span>
        </a>
    <?php } ?>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <?php 
        $db = new Database();
        $db->select('admin','*',null,null,null,null);
        $result = $db->getResult();
      ?>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"><?php echo $result[0]['admin_fullname'] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="../dashboard/dashboard.php" <?php if(basename($_SERVER['PHP_SELF']) == "dashboard.php") echo 'class="nav-link active"'; ?> class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../donor/donor.php"  <?php if(basename($_SERVER['PHP_SELF']) == "donor.php") echo 'class="nav-link active"'; ?> class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Donors
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../blood-group/blood.php" <?php if(basename($_SERVER['PHP_SELF']) == "blood.php") echo 'class="nav-link active"'; ?> class="nav-link">
              <i class="nav-icon fas fa-clinic-medical"></i>
              <p>
                Blood Group
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../city/city.php" <?php if(basename($_SERVER['PHP_SELF']) == "city.php") echo 'class="nav-link active"'; ?> class="nav-link">
              <i class="nav-icon fas fa-city"></i>
              <p>
                City
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../users/user.php" <?php if(basename($_SERVER['PHP_SELF']) == "user.php") echo 'class="nav-link active"'; ?> class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" <?php if(basename($_SERVER['PHP_SELF']) == "blood-group-report.php") echo 'class="nav-link active"'; ?> class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../reports/blood-group-report.php" <?php if(basename($_SERVER['PHP_SELF']) == "blood-group-report.php") echo 'class="nav-link active"'; ?> class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blood Group</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="../setting/setting.php" <?php if(basename($_SERVER['PHP_SELF']) == "setting.php") echo 'class="nav-link active"'; ?> class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
