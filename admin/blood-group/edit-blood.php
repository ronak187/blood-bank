<?php $title = "Edit Blood Group";
include "../sidebar.php" ?>
<div class="message"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Blood Group</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Edit Blood Group</li>
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
                            <h3 class="card-title">Edit Blood Group</h3>
                            <a href="blood.php" class="btn btn-success btn-sm float-right">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                                </svg>
                                Blood Group List
                            </a>
                        </div>
                        <div class="card-body">
                            <?php 
                                $blood_id = $_GET['blid'];
                                $db = new Database();
                                $db->select('blood_group','*',null,"id=$blood_id",null,null);
                                $result = $db->getResult();
                                if(count($result) > 0){
                                    foreach($result as $row){
                            ?>
                            <form class="form-horizontal" id="edit-blood" action="" method="post">
                                <div class="form-group">
                                    <label for="">Blood Group Name</label>
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <input type="text" class="form-control blood_group" name="blood_group" placeholder="Blood Group Name" value="<?php echo $row['name']; ?>" required>
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