<?php $title = "Donor";
include "../sidebar.php" ?>
<div class="message"></div>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Donor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Donor</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Donor List</h3>
                            <a href="add-donor.php" class="btn btn-primary btn-sm float-right">Add New</a>
                        </div>
                        <div class="card-body">
                            <?php
                            $db = new Database();
                            $db->select(
                                'donor',
                                "donor.id,donor.donor_img,donor.donor_name,donor.email,donor.phone,donor.blood_group,blood_group.id as blood,blood_group.name",
                                "blood_group ON donor.blood_group = blood_group.id",
                                null,
                                "donor.id DESC",
                                null
                            );
                            $result = $db->getResult();
                            ?>
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S No.</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Blood Group</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($result) > 0) {
                                        $i = 0;
                                        foreach ($result as $row) {
                                            $i++;
                                    ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                    <?php
                                                    if ($row['donor_img'] != '') { ?>
                                                        <img src="../images/donor/<?php echo $row['donor_img']; ?>" width="60px" height="60px" style="object-fit: cover;" alt="">
                                                    <?php } else { ?>
                                                        <img src="../images/donor/user.jpg" width="60px" height="60px" style="object-fit: cover;" alt="">
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['donor_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['email']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['phone']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['name']; ?>
                                                </td>
                                                <td>
                                                    <a href="edit-donor.php?doid=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="#" data-doid=<?php echo $row['id']; ?> class="btn btn-danger btn-sm delete-donor">Delete</a>
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