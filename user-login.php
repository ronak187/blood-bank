<?php $title = "Login";
include "header.php" ?>
<div class="message"></div>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <div class="signup-form">
                    <h3 class="title bg-secondary m-0 text-white py-3 text-center" style="font-weight:600;">Login</h3>
                    <form class="form-horizontal yourform" id="user-login" action="">
                        <div class="form-group">
                            <input  type="radio" id="user_type" name="radio_btn" value="User" checked>
                            <label for="" class="mr-2">User</label>
                            <input type="radio" id="user_type" name="radio_btn" value="Donor">
                            <label for="">Donor</label>
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="email" class="form-control username" name="username" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control password" name="password" placeholder="Password" required>
                        </div>
                        <input type="submit" class="btn1 btn" value="Login">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>