<?php include "header.php" ?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php 
                    $db = new Database();
                    $db->select('admin','*',null,null,null,null);
                    $result = $db->getResult();
                ?>
                <?php 
                    if(!empty($result[0]['site_logo'])){ ?>
                    <div class="site-logo">
                        <img src="./admin/images/site-logo/<?php echo $result[0]['site_logo'] ?>" alt="" >
                    </div>
                <?php }else{ ?>
                    <div class="site-logo">
                        <h2 class="m-0" style="color:#fff;font-weight:700;"><?php echo $result[0]['site_name'] ?></h2>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="blood-form">
                    <form class="form-horizontal"  action="donor.php" method="get">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">City</label>
                                    <select class="form-control city" name="city" id="">
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
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Blood Group</label>
                                    <select class="form-control blood_group" name="blood_group" id="">
                                        <option value="">Select Blood Group</option>
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
                            </div>
                            <div class="col-md-2 d-flex align-items-center">
                                <label for=""></label>
                                <input type="submit" class="btn1 btn btn mt-3" value="Search">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>