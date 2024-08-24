<?php $title = "Update Profile";
include "header.php" ?>
<div class="message"></div>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <div class="signup-form">
                    <h3 class="title bg-secondary m-0 text-white py-3 text-center" style="font-weight:600;">Update Profile</h3>
                    <?php 
                        if($_SESSION['user_type'] == 'user'){ ?>
                            <?php
                                $user_id = $_SESSION['id']; 
                                $db = new Database();
                                $db->select('user','*',null,"id=$user_id",null,null);
                                $result = $db->getResult();
                                if(count($result) > 0){
                                    foreach($result as $row){
                            ?>
                            <form class="form-horizontal yourform" id="update-profile"  action="" method="POST">
                                <div class="form-group">
                                    <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>"> 
                                    <label for="">Image</label>
                                    <input type="file" class="form-control new_logo image" name="new_logo" />
                                    <input type="hidden" class="form-cintrol old_logo image" name="old_logo" value="<?php echo $row['user_img']; ?>">
                                    <img id="image" src="images/<?php echo $row['user_img'] ?>" alt="" width="100px" />
                                </div>
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control name" name="name" placeholder="Name" value="<?php echo $row['name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label class="mr-2 mb-0">Gender: </label>
                                    <?php
                                        if($row['gender'] == 'male'){ ?>
                                        <label for="" class="mb-0 mr-2">
                                            <input type="radio" class="mr-1 gender" name="gender" value="male" checked="">
                                            Male
                                        </label>
                                        <label for="" class="mb-0 mr-2">
                                            <input type="radio" class="mr-1 gender" name="gender" value="female">
                                            Female
                                        </label>
                                    <?php }else if($row['gender'] == 'female'){ ?>
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
                                    <label for="">Phone Number</label>
                                    <input type="number" class="form-control phone" name="phone" placeholder="Phone Number" value="<?php echo $row['phone']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">City</label>
                                    <?php 
                                        $db->select('city','*',null,null,null,null);
                                        $response1 = $db->getResult();
                                        if(count($response1) > 0){
                                    ?>
                                    <select class="form-control city" name="city" id="">
                                        <?php foreach($response1 as $row2){
                                            if($row2['id'] == $row['city']) { ?>
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
                                <input type="submit" class="btn1 btn" value="Update">
                            </form>
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
                            <form class="form-horizontal yourform" id="update-profile"  action="" method="POST">
                                <div class="form-group">
                                    <input type="hidden" name="donor_id" value="<?php echo $row['id']; ?>"> 
                                    <label for="">Image</label>
                                    <input type="file" class="form-control new_logo image" name="new_logo" />
                                    <input type="hidden" class="form-cintrol old_logo image" name="old_logo" value="<?php echo $row['donor_img']; ?>">
                                    <img id="image" src="admin/images/donor/<?php echo $row['donor_img'] ?>" alt="" width="100px" />
                                </div>
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control name" name="name" placeholder="Name" value="<?php echo $row['donor_name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label class="mr-2 mb-0">Gender: </label>
                                    <?php
                                        if($row['gender'] == 'male'){ ?>
                                        <label for="" class="mb-0 mr-2">
                                            <input type="radio" class="mr-1 gender" name="gender" value="male" checked="">
                                            Male
                                        </label>
                                        <label for="" class="mb-0 mr-2">
                                            <input type="radio" class="mr-1 gender" name="gender" value="female">
                                            Female
                                        </label>
                                    <?php }else if($row['gender'] == 'female'){ ?>
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
                                    <label for="">Phone Number</label>
                                    <input type="number" class="form-control phone" name="phone" placeholder="Phone Number" value="<?php echo $row['phone']; ?>" required>
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
                                        $db->select('city','*',null,null,null,null);
                                        $response1 = $db->getResult();
                                        if(count($response1) > 0){
                                    ?>
                                    <select class="form-control city" name="city" id="">
                                        <?php foreach($response1 as $row2){
                                            if($row2['id'] == $row['city']) { ?>
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
                                        $db->select('blood_group','*',null,null,null,null);
                                        $response = $db->getResult();
                                        if(count($response) > 0){
                                    ?>
                                    <select class="form-control blood_group" name="blood_group" id="">
                                        <?php foreach($response as $row1){
                                            if($row1['id'] == $row['blood_group']) { ?>
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
                                <div class="form-group">
                                    <label for="">Last Donate</label>
                                    <input type="date" class="form-control last_donate" name="last_donate" value="<?php echo $row['last_donate']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Next Donate</label>
                                    <input type="date" class="form-control next_donate" name="next_donate" value="<?php echo $row['next_donate']; ?>">
                                </div>
                                <input type="submit" class="btn1 btn" value="Update">
                            </form>
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

<?php include "footer.php" ?>