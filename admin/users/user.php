<?php $title = "Users"; 
include "../sidebar.php" ?>
<div class="message"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Users</li>
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
                            <h3 class="card-title">User List</h3>
                        </div>
                        <div class="card-body">
                            <?php 
                                $db = new Database();
                                $db->select('user','user.id,user.name,user.phone,user.username,user.user_img,user.user_city,user.status,city.city_name',
                                            "city ON user.user_city = city.id",null,null,null);
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
                                        <th>City</th>
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
                                        <td>
                                            <?php
                                            if($row['user_img'] != ''){ ?>
                                                <img src="../../images/<?php echo $row['user_img']; ?>" width="60px" height="60px" style="object-fit: cover;" alt="">
                                            <?php }else{ ?>
                                                <img src="../../images/user.jpg" width="60px" height="60px" style="object-fit: cover;" alt="">
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><?php echo $row['city_name']; ?></td>
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