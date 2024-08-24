<?php $title = "Sign Up";
include "header.php" ?>
<div class="message"></div>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <div class="signup-form">
                    <h3 class="title bg-secondary m-0 text-white py-3 text-center" style="font-weight:600;">Sign Up</h3>
                    <form class="form-horizontal yourform" id="signup-form"  action="" method="post">
                        <div class="form-group">
                            <img src="" alt="">
                        </div>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control name" name="name" placeholder="Name" required>
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
                            <label for="">Phone</label>
                            <input type="text" class="form-control phone" name="phone" placeholder="Phone" required>
                        </div>
                        <div class="form-group">
                            <label for="">City</label>
                            <select class="form-control city" name="city" id="" required>
                                <option value="" selected>Select City</option>
                                <?php
                                    $db = new Database();
                                    $db->select('city','*',null,null,null,null);
                                    $result = $db->getResult();
                                    if(count($result) > 0){
                                        foreach($result as $row){ 
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['city_name']; ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="myCheckbox" id="myCheckbox" onClick="myFunction()">
                            <label for="" class="mr-2">Do you want to donate blood ?</label>
                            <select class="form-control blood_group" id="blood_group" name="blood_group" style="display:none;">
                                <option value="" selected>Select Blood Group</option>
                                <?php
                                    $db = new Database();
                                    $db->select('blood_group','*',null,null,null,null);
                                    $result = $db->getResult();
                                    if(count($result) > 0){
                                        foreach($result as $row){ 
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Username / Email</label>
                            <input type="email" class="form-control email" name="email" placeholder="Email Address" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control password" name="password" placeholder="Password" required>
                        </div>
                        <input type="submit" class="btn1 btn" value="Save">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>