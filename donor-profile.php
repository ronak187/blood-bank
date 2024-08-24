<?php $title = "Donor Profile"; 
include "header.php" ?>
<div class="content">
    <div class="container-xl container-fluid-md">
        <div class="row">
            <div class="col-md-12">
                <div class="my-profile">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title d-inline-block mb-0">Donor Profile</h3>
                            <!-- <a href="update-profile.php" class="btn btn1 btn-sm float-right">Update Profile</a> -->
                        </div>
                        <?php 
                            $donor_id = $_GET['doid']; 
                            $db = new Database();
                            $db->select('donor','donor.id,donor.donor_img,donor.donor_name,donor.gender,donor.email,donor.phone,
                                        donor.address,donor.pin_code,donor.city,donor.state,donor.country,donor.blood_group,blood_group.name,city.city_name',
                                        "blood_group ON donor.blood_group = blood_group.id LEFT JOIN city ON donor.city = city.id",
                                        "donor.id='$donor_id'",null,null);
                            $result = $db->getResult();
                            if(count($result) > 0){
                                foreach($result as $row){
                        ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-5">
                                    <div class="user-img">
                                        <?php 
                                            if(!empty($row['donor_img'])){ ?>
                                                <img src="./admin/images/donor/<?php echo $row['donor_img']; ?>" alt="">
                                        <?php }else{ ?>
                                                <img src="./admin/images/donor/user.jpg" alt="">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-7">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><b>Full Name:</b></td>
                                                <td><?php echo $row['donor_name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Blood Group:</b></td>
                                                <td><?php echo $row['name'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Phone Number:</b></td>
                                                <td><?php echo $row['phone']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>City:</b></td>
                                                <td><?php echo $row['city_name']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php 
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>