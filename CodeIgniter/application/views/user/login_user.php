<!DOCTYPE html>
<html lang="en">

<body >
<section id="form"><!--form-->
    <div style="text-align: center" class="col-sm-8 col-sm-offset-1"><label style="text-align: center"><?php echo $verify_email?></label></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    <form action="<?php echo site_url('UserControl/login_user')?>" method="post">
                        <input type="text" placeholder="e-mail" name="user_email"/>
                        <div style="display:inline; color: red" >
                            <?php if(isset($email)){echo "Invalid User Email";}else{echo "";} ?>
                        </div>
                        <input type="password" placeholder="Password" name="user_password" />
                        <div style="display:inline; color: red" >
                            <?php if(isset($pass)){echo "Invalid Password";}else{echo "";} ?>
                        </div><div>
                        <span>
                            <a href="<?php echo site_url('UserControl/forget')?>">
                           Forget password</a>
                        </span></div>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form action="<?php echo base_url('UserControl/registration')?>" method="post">

                        <input type="text" placeholder="Name" name="user_name"/>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('user_name'); ?>
                        </div>
                        <input type="text" placeholder="Name" name="user_lastname"/>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('user_lastname'); ?>
                        </div>
                        <input type="email" placeholder="Email Address" name="user_email"/>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('user_email'); ?>
                        </div>
                        <input type="password" placeholder="Password" name="user_password"/>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('user_password'); ?>
                        </div>
                        <label><input type="radio" name="user_status" value="1" style="display: inline;width: 20px">Male</label>
                        <label><input type="radio" name="user_status" value="1" style="display: inline;width: 20px">Female</label>
                        <div></div>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('user_status'); ?>
                        </div>
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->



</body>
</html>