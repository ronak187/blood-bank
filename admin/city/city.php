<?php $title = "City";
include "../sidebar.php" ?>
<div class="message"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>City</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">City</li>
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
                            <h3 class="card-title">City List</h3>
                            <a href="add-city.php" class="btn btn-primary btn-sm float-right">Add New</a>
                        </div>
                        <div class="card-body">
                            <?php 
                                $db = new Database();
                                $db->select('city','*',null,null,null,null);
                                $result = $db->getResult();
                            ?>
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S No.</th>
                                        <th>City Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(count($result) > 0){
                                            $i=0;
                                            foreach($result as $row){
                                                $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['city_name']; ?></td>
                                        <td>
                                            <a href="edit-city.php?ctid=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="#" data-ctid=<?php echo $row['id']; ?> class="btn btn-danger btn-sm delete-city">Delete</a>
                                        </td>
                                    </tr>
                                    <?php 
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include "../footer.php" ?>