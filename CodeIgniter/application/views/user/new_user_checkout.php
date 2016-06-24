<!DOCTYPE html>

<section id="form"><!--form-->
    <div style="text-align: center" class="col-sm-8 col-sm-offset-1"><label style="text-align: center"><?php if(isset($verify_email)){echo $verify_email;}else{echo "";}?></label></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <center><?php echo "<h3 style='color: green'>".$this->session->flashdata('msg');"<h3>"?></center>
                <div class="login-form"><!--login form-->
                    <h2>Already Register</h2>
                    <form action="<?php echo site_url('checkout/checkout_login')?>" method="post">
                        <input type="text" placeholder="E-mail" name="user_email"/>
                        <div style="display:inline; color: red" >
                            <?php if(isset($email)){echo "Invalid User Email";}else{echo "";} ?>
                        </div>
                        <input type="password" placeholder="Password" name="user_password" />
                        <div style="display:inline; color: red" >
                            <?php if(isset($pass)){echo "Invalid Password";}else{echo "";} ?>
                        </div><div>
                        <span>
                            <a href="<?php echo site_url('Userlogin/forget')?>">
                                Forget password</a>
                        </span></div>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <br>
                <h2 class="or">OR</h2>
            </div>

                <form action="<?php echo base_url('checkout/checkouts')?>" method="post">
                    <!--        <div class="step-one">-->
                    <!--            <h2 class="heading">Step1</h2>-->
                    <!--        </div>-->
                    <div class="checkout-options">
                        <h3>New User</h3>
                        <p>Checkout options</p>
                        <ul >
                            <li>
                                <label style="height: 40px"><h3 style="display:inline">Register Account</h3><input style="width: 4em; height: 1em;" checked type="radio" value="register" name="checkout"> </label>
                            </li>
                            <li>

                                <label style="height: 40px"><h3 style="display:inline">Guest Checkout</h3><input style="width: 5em; height: 1em;" type="radio" value="guest" name="checkout"></label>
                            </li>
                            <li>
                            </li><br><br>
                                 <button style="margin-left: 80px" type="submit" class="btn btn-default">Continue</button>
                        </ul>
                    </div>
                </form>

<!--                <div class="signup-form"><!--sign up form-->
<!--                    <h2>New User Signup!</h2>-->
<!--                    <form name="form" onsubmit="return registration_user()" action="--><?php //echo base_url('Userlogin/registration')?><!--" method="post">-->
<!---->
<!--                        <input type="text" placeholder="Name" name="user_name" value="--><?php //echo set_value('user_name')?><!--"/>-->
<!--                        <div id="first" style="display:inline; color: red" >-->
<!--                            --><?php //echo form_error('user_name'); ?>
<!--                        </div>-->
<!--                        <input type="text" placeholder="Last Name" name="user_lastname"value="--><?php //echo set_value('user_lastname')?><!--"/>-->
<!--                        <div id="last" style="display:inline; color: red" >-->
<!--                            --><?php //echo form_error('user_lastname'); ?>
<!--                        </div>-->
<!--                        <input type="email" placeholder="Email Address" name="user_email"value="--><?php //echo set_value('user_email')?><!--"/>-->
<!--                        <div id="email" style="display:inline; color: red" >-->
<!--                            --><?php //echo form_error('user_email'); ?>
<!--                        </div>-->
<!--                        <input type="password" placeholder="Password" name="user_password"value="--><?php //echo set_value('user_password')?><!--"/>-->
<!--                        <div id="pass" style="display:inline; color: red" >-->
<!--                            --><?php //echo form_error('user_password'); ?>
<!--                        </div><br>-->
<!--                        <label><input type="radio" name="user_status" value="M" style="display: inline;width: 20px">Male</label>-->
<!--                        <label><input type="radio" name="user_status" value="F" style="display: inline;width: 20px">Female</label>-->
<!--                        <br><div id="gender" style="display:inline; color: red"></div>-->
<!--                        <div style="display:inline; color: red" >-->
<!--                            --><?php //echo form_error('user_status'); ?>
<!--                        </div>-->
<!--                        <button type="submit" class="btn btn-default">Signup</button>-->
<!--                    </form>-->
<!--                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
</body>
</html>