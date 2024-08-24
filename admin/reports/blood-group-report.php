<?php $title = "Blood Group Report";
include "../sidebar.php" ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blood Group Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Blood Group Report</li>
            </ol>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Blood Group Report</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form class="form-horizontal" id="blood-group-report" action="" method="post">
                                <div class="form-group">
                                    <label for="">Blood Group</label>
                                    <select class="form-control blood_group" name="blood_group" id="" >
                                        <option value="all" selected>All Blood Group</option>
                                        <?php   
                                            $db = new Database();
                                            $db->select('blood_group','*',null,null,null,null);
                                            $result = $db->getResult();
                                            if(count($result) > 0){
                                                foreach($result as $row){
                                        ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                        <?php 
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-primary btn-sm" value="Search">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    <section class="content blood-report">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="card-title">Blood Group Report List</h4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php 
                                $db = new Database();
                                

                                $db->select('donor','donor.id as donor_id,donor.donor_img,donor.donor_name,donor.gender,donor.email,donor.phone,
                                            donor.city,donor.blood_group,blood_group.name,city.city_name',"blood_group ON donor.blood_group = blood_group.id LEFT JOIN city ON donor.city = city.id",
                                            null,null,null);
                                $result = $db->getResult();
                            ?>
                            <table id="group-report" class="blood-table table table-bordered table-hover" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>S No.</th>
                                        <th>Photo</th>
                                        <th>Donor Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>Blood Group</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>
<?php include "../footer.php" ?>
