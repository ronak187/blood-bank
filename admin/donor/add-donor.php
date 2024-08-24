<?php $title = "Add Donor";
include "../sidebar.php" ?>
<div class="message"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Donor</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Donor</li>
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
                            <h3 class="card-title">Add Donor</h3>
                            <a href="donor.php" class="btn btn-success btn-sm float-right">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                                </svg>
                                Donor List
                            </a>
                        </div>
                        <div class="card-body">
                            <?php
                            $db = new Database();
                            $db->select('city','*',null,null,null,null);
                            $cities = $db->getResult();
                            $db->select('blood_group','*',null,null,null,null);
                            $groups = $db->getResult();
                            if(empty($cities) && empty($groups)){ ?>
                                <div class="alert alert-danger">Add First Cities and Blood Groups</div>
                            <?php }elseif(empty($cities)){ ?>
                                <div class="alert alert-danger">Add First Cities</div>
                            <?php }elseif(empty($groups)){ ?>
                                <div class="alert alert-danger">Add First Blood Groups</div>
                            <?php } ?>
                            
                            <form class="form-horizontal" id="add-donor" action="" method="post">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control image" name="donor_image" value="">
                                    <img id="image" src="" width="100px" />
                                </div>
                                <div class="form-group">
                                    <label for="">Donor Name</label>
                                    <input type="text" class="form-control donor_name" name="donor_name" placeholder="Donor Name" required>
                                </div>
                                <div class="form-group">
                                    <label class="mr-2 mb-0">Gender: </label>
                                    <label for="" class="mb-0 mr-2">
                                        <input type="radio" class="mr-1 gender" name="gender" value="male" checked="">
                                        Male
                                    </label>
                                    <label for="" class="mb-0">
                                        <input type="radio" class="mr-1 gender" name="gender" value="female">
                                        Female
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control email" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="number" class="form-control phone" name="phone" placeholder="Phone" pattern="([0-9]{10})" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control address" name="address" placeholder="Address" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Pin Code</label>
                                    <input type="number" class="form-control pin_code" name="pin_code" placeholder="Pin Code" required>
                                </div>
                                <div class="form-group">
                                    <label for="">City</label>
                                    <select class="form-control city" name="city" id="">
                                        <option value="" selected>Select City</option>
                                        <?php 
                                            // $db = new Database();
                                            // $db->select('city','*',null,null,null,null);
                                            // $result = $db->getResult();
                                            if(count($cities) > 0){
                                                foreach($cities as $row){
                                        ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['city_name']; ?></option>
                                        <?php 
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">State</label>
                                    <input type="text" class="form-control state" name="state" placeholder="State" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Country</label>
                                    <input type="text" class="form-control country" name="country" placeholder="Country" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Blood Group</label>
                                    <select class="form-control blood_group" name="blood_group" id="">
                                    <option value="" selected>Select Blood Group</option>
                                        <?php 
                                            // $db = new Database();
                                            // $db->select('blood_group','*',null,null,null,null);
                                            // $result = $db->getResult();
                                            if(count($groups) > 0){
                                                foreach($groups as $row){
                                        ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                        <?php 
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Save">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include "../footer.php" ?>