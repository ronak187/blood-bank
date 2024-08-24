<?php 
$title = "My Profile";  
include "header.php"
?>
<div class="content">
    <div class="container-xl container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="my-profile">
                
                    <div class="card">
                        <?php if($_SESSION['user_type'] == 'user'){ ?>
                            <div class="card-header">
                                <h3 class="card-title d-inline-block mb-0">User Profile</h3>
                                <a href="update-profile.php" class="btn btn1 btn-sm float-right">Update Profile</a>
                            </div>
                        <?php }else if($_SESSION['user_type'] == 'donor'){ ?>
                            <div class="card-header">
                                <h3 class="card-title d-inline-block mb-0">Donor Profile</h3>
                                <a href="update-profile.php" class="btn btn1 btn-sm float-right">Update Profile</a>
                            </div>
                        <?php } ?>
                        <?php 
                            if($_SESSION['user_type'] == 'user'){ ?>
                            <?php 
                                $user_id = $_SESSION['id']; 
                                $db = new Database();
                                $db->select('user','user.id,user.user_img,user.username,user.name,user.phone,user.gender,
                                            user.user_city,city.city_name',"city ON user.user_city = city.id","user.id=$user_id",null,null);
                                $result = $db->getResult();
                                if(count($result) > 0){
                                    foreach($result as $row){
                            ?>
                            
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 col-sm-5">
                                        <div class="user-img">
                                            <?php 
                                                if(!empty($row['user_img'])){ ?>
                                                    <img src="images/<?php echo $row['user_img']; ?>" alt="">
                                            <?php }else{ ?>
                                                    <img src="images/user.jpg" alt="">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-7">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><b>Username / Email:</b></td>
                                                    <td><?php echo $row['username']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Full Name:</b></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Gender:</b></td>
                                                    <td><?php echo $row['gender']; ?></td>
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
                        <?php }else if($_SESSION['user_type'] == 'donor'){ ?>
                            <?php 
                                $donor_id = $_SESSION['id']; 
                                $db = new Database();
                                $db->select('donor','donor.id,donor.donor_img,donor.donor_name,donor.gender,donor.email,donor.phone,
                                donor.address,donor.pin_code,donor.city,donor.state,donor.country,donor.blood_group,donor.last_donate,donor.next_donate,blood_group.name,city.city_name',
                                "blood_group ON donor.blood_group = blood_group.id LEFT JOIN city ON donor.city = city.id",
                                "donor.id='$donor_id'",null,null);
                                $result = $db->getResult();
                                if(count($result) > 0){
                                    foreach($result as $row){
                            ?>
                            
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="user-img">
                                            <?php 
                                                if(!empty($row['donor_img'])){ ?>
                                                    <img src="./admin/images/donor/<?php echo $row['donor_img']; ?>" alt="">
                                            <?php }else{ ?>
                                                    <img src="./admin/images/donor/user.jpg" alt="">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><b>Username / Email:</b></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Full Name:</b></td>
                                                    <td><?php echo $row['donor_name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Gender:</b></td>
                                                    <td><?php echo $row['gender']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Phone Number:</b></td>
                                                    <td><?php echo $row['phone']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Address:</b></td>
                                                    <td><?php echo $row['address']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Pin Code:</b></td>
                                                    <td><?php echo $row['pin_code']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>City:</b></td>
                                                    <td><?php echo $row['city_name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>State:</b></td>
                                                    <td><?php echo $row['state']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Country:</b></td>
                                                    <td><?php echo $row['country']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Blood Group:</b></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                </tr>
                                                <?php 
                                                    if(!empty($row['last_donate'])){ ?>
                                                        <tr>
                                                            <td><b>Last Donate:</b></td>
                                                            <td><?php echo date('d F,Y',strtotime($row['last_donate'])); ?></td>
                                                        </tr>
                                                <?php } else { ?>
                                                        <tr>
                                                            <td><b>Last Donate:</b></td>
                                                            <td></td>
                                                        </tr>
                                                <?php } ?>
                                                <?php 
                                                    if(!empty($row['next_donate'])){ ?>
                                                        <tr>
                                                            <td><b>Next Donate:</b></td>
                                                            <td><?php echo date('d F,Y',strtotime($row['next_donate'])); ?></td>
                                                        </tr>
                                                <?php } else { ?>
                                                        <tr>
                                                            <td><b>Next Donate:</b></td>
                                                            <td></td>
                                                        </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                    }
                                }
                            ?>
                        <?php }else{ ?>
                            
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>