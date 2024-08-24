<?php $title = "Change Password";
include "header.php" ?>
<div class="message"></div>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <div class="signup-form">
                    <h3 class="title bg-secondary m-0 text-white py-3 text-center" style="font-weight:600;">Change Password</h3>
                    <form class="form-horizontal yourform" id="modify-password" action="">
                        <div class="form-group">
                            <label for="">Old Password</label>
                            <input type="password" class="form-control old_pass" name="old_pass" placeholder="Old Password" required>
                        </div>
                        <div class="form-group">
                            <label for="">New Password</label>
                            <input type="password" class="form-control new_pass" name="new_pass" placeholder="New Password" required>
                        </div>
                        <input type="submit" class="btn1 btn" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>