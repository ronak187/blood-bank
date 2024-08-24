<?php $title = "Settings"; 
include "../sidebar.php" ?>
<div class="message"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Settings</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Settings</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Settings</h3>
                        </div>
                        <div class="card-body">
                            <?php 
                                $db = new Database();
                                $db->select('admin','*',null,null,null,null);
                                $result = $db->getResult();
                                if(count($result) > 0){
                                    foreach($result as $row){
                            ?>
                            <form class="form-horizontal" id="edit-setting" action="" method="post">
                                <div class="form-group">
                                    <label for="">Site Name</label>
                                    <input type="hidden" name="admin_id" value="<?php echo $row['admin_id']; ?>">
                                    <input type="text" class="form-control site_name" name="site_name" value="<?php echo $row['site_name'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Site Logo</label>
                                    <input type="file" class="form-control new_logo image" name="new_logo" />
                                    <input type="hidden" class="form-control old_logo image" name="old_logo" value="<?php echo $row['site_logo']; ?>">
                                    <img id="image" src="../images/site-logo/<?php echo $row['site_logo']; ?>" alt="" width="100px"/>
                                </div>
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control username" name="username" value="<?php echo $row['username'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Admin Name</label>
                                    <input type="text" class="form-control admin_name" name="admin_name" value="<?php echo $row['admin_fullname'] ?>" required>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Update">
                            </form>
                            <?php 
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include "../footer.php" ?>


