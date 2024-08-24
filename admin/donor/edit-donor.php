<?php $title = "Edit Donor";
include "../sidebar.php" ?>
<div class="message"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Donor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Donor</li>
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
                            <h3 class="card-title">Edit Donor</h3>
                            <a href="donor.php" class="btn btn-success btn-sm float-right">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                                </svg>
                                Donor List
                            </a>
                        </div>
                        <div class="card-body">
                            <?php
                            $donor_id = $_GET['doid'];
                            $db = new Database();
                            $db->select('donor', '*', null, "id=$donor_id", null, null);
                            $result = $db->getResult();
                            if (count($result) > 0) {
                                foreach ($result as $row) {
                            ?>
                                    <form class="form-horizontal" id="edit-donor" action="edit-donor.php" method="post">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" class="form-control new_logo image" name="new_logo" />
                                            <input type="hidden" class="old_logo image" name="old_logo" value="<?php echo $row['donor_img']; ?>">
                                            <img id="image" src="../images/donor/<?php echo $row['donor_img']; ?>" width="100px" />
                                        </div>
                                        <div class="form-group">
                                            <label for="">Donor Name</label>
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" required>
                                            <input type="text" class="form-control donor_name" name="donor_name" placeholder="Donor Name" value="<?php echo $row['donor_name']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="mr-2 mb-0">Gender: </label>
                                            <?php
                                            if ($row['gender'] == 'male') { ?>
                                                <label for="" class="mb-0 mr-2">
                                                    <input type="radio" class="mr-1 gender" name="gender" value="male" checked="">
                                                    Male
                                                </label>
                                                <label for="" class="mb-0 mr-2">
                                                    <input type="radio" class="mr-1 gender" name="gender" value="female">
                                                    Female
                                                </label>
                                            <?php } else if ($row['gender'] == 'female') { ?>
                                                <label for="" class="mb-0 mr-2">
                                                    <input type="radio" class="mr-1 gender" name="gender" value="male">
                                                    Male
                                                </label>
                                                <label for="" class="mb-0">
                                                    <input type="radio" class="mr-1 gender" name="gender" value="female" checked="">
                                                    Female
                                                </label>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" class="form-control email" name="email" placeholder="Email" value="<?php echo $row['email']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Phone</label>
                                            <input type="number" class="form-control phone" name="phone" placeholder="Phone" value="<?php echo $row['phone']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <input type="text" class="form-control address" name="address" placeholder="Address" value="<?php echo $row['address']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Pin Code</label>
                                            <input type="number" class="form-control pin_code" name="pin_code" placeholder="Pin Code" value="<?php echo $row['pin_code']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">City</label>
                                            <?php
                                            $db->select('city', '*', null, null, null, null);
                                            $response1 = $db->getResult();
                                            if (count($response1) > 0) {
                                            ?>
                                                <select class="form-control city" name="city" id="">
                                                    <?php foreach ($response1 as $row2) {
                                                        if ($row2['id'] == $row['city']) { ?>
                                                            <option selected value="<?php echo $row2['id']; ?>"><?php echo $row2['city_name']; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $row2['id']; ?>"><?php echo $row2['city_name']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="">State</label>
                                            <input type="text" class="form-control state" name="state" placeholder="State" value="<?php echo $row['state']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Country</label>
                                            <input type="text" class="form-control country" name="country" placeholder="Country" value="<?php echo $row['country']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Blood Group</label>
                                            <?php
                                            $db->select('blood_group', '*', null, null, null, null);
                                            $response = $db->getResult();
                                            if (count($response) > 0) {
                                            ?>
                                                <select class="form-control blood_group" name="blood_group" id="">
                                                    <?php foreach ($response as $row1) {
                                                        if ($row1['id'] == $row['blood_group']) { ?>
                                                            <option selected value="<?php echo $row1['id']; ?>"><?php echo $row1['name']; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $row1['id']; ?>"><?php echo $row1['name']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <input type="submit" id="update-donor-btn" class="btn btn-primary" value="Update">
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