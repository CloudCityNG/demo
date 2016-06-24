<!DOCTYPE html>

<script>
    function email()
    {

        var code=document.getElementById('mail').value;
        $.ajax({ url: '<?php echo site_url('userlogin/check_email/');?>',
            data: {code: code},
            type: 'post',
            success: function(output) {
               // document.getElementById('email').innerHTML=output;
                //document.getElementById('mail').innerHTML="";
                if(output > 0 ) {
                    document.getElementById('mail').value="";
                    document.getElementById('email').innerHTML="E-mail Already Exists";

                    return false;
                }
                else {
                    document.getElementById('email').innerHTML="";
                    return true;
                }
            }
        });
    }
</script>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="<?php echo base_url('css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('css/font-awesome.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('css/prettyPhoto.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('css/price-range.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('css/animate.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('css/main.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('css/responsive.css')?>" rel="stylesheet">
    <!--[if lt IE 9]-->
    <script src="<?php echo base_url('js/html5shiv.js')?>"></script>
    <script src="<?php echo base_url('js/respond.min.js')?>"></script>
    <!--[endif]-->
    <link rel="shortcut icon" href="<?php echo base_url('images/ico/favicon.ico')?>">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('images/ico/apple-touch-icon-144-precomposed.png')?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('images/ico/apple-touch-icon-114-precomposed.png')?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('images/ico/apple-touch-icon-72-precomposed.png')?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('images/ico/apple-touch-icon-57-precomposed.png')?>">
    <script src="<?php echo base_url('js/user_registration.js')?>"></script>
</head><!--/head-->
<body >
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo base_url('welcome/login')?>"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?php echo base_url('google_app')?>"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="<?php echo base_url('home/newsletter')?>"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="<?php echo base_url('google/google_login')?>"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->
    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="<?php echo base_url()?>"><img src="<?php echo base_url('images/home/logo.png')?>" alt="" /></a>
                    </div>
                    <div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canada</a></li>
                                <li><a href="#">UK</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canadian Dollar</a></li>
                                <li><a href="#">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

<section id="form"><!--form-->
    <div style="text-align: center" class="col-sm-8 col-sm-offset-1"><label style="text-align: center"><?php if(isset($verify_email)){echo $verify_email;}else{echo "";}?></label></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <center><?php echo "<h3 style='color: green'>".$this->session->flashdata('msg');"<h3>"?></center>
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    <form action="<?php echo site_url('Userlogin/login_user')?>" method="post">
                        <input type="text" placeholder="e-mail" name="login_email" value="<?php echo set_value('login_email')?>" />
                        <div style="display:inline; color: red" >
                            <?php echo form_error('login_email'); ?>
                            <?php if(isset($email)){echo "Invalid User Email";}else{echo "";} ?>
                        </div>
                        <input type="password" placeholder="Password" name="login_password" value="<?php echo set_value('login_password')?>" />
                        <div style="display:inline; color: red" >
                            <?php echo form_error('login_password'); ?>
                            <?php if(isset($pass)){echo "Invalid Password";}else{echo "";} ?>
                        </div>
                        <div>
                        <span>
                            <a href="<?php echo site_url('Userlogin/forget')?>">
                                Forget password
                            </a>
                        </span>
                        </div>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <br>
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form name="form" onclick="return email()" onsubmit="return registration_user()" action="<?php echo base_url('Userlogin/registration')?>" method="post">

                        <input type="text" placeholder="Name" name="user_name" value="<?php echo set_value('user_name')?>"/>
                        <div id="first" style="display:inline; color: red" >
                            <?php echo form_error('user_name'); ?>
                        </div>
                        <input type="text" placeholder="Last Name" name="user_lastname"value="<?php echo set_value('user_lastname')?>"/>
                        <div id="last" style="display:inline; color: red" >
                            <?php echo form_error('user_lastname'); ?>
                        </div>
                        <input id="mail" type="email" placeholder="Email Address" name="user_email"value="<?php echo set_value('user_email')?>"/>
                        <div id="email" style="display:inline; color: red" >
                            <?php echo form_error('user_email'); ?>
                        </div>
                        <input type="password" placeholder="Password" name="user_password"value="<?php echo set_value('user_password')?>"/>
                        <div id="pass" style="display:inline; color: red" >
                            <?php echo form_error('user_password'); ?>
                        </div><br>
                        <label>Male<input type="radio" name="user_status" value="M" style="display: inline;width: 5em; height: 1em;"></label>
                        <label>Female<input type="radio" name="user_status" value="F" style="display: inline;width: 5em; height: 1em;"></label>
                        <br><div id="gender" style="display:inline; color: red"></div>
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