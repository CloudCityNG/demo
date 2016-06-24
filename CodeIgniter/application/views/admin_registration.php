<!DOCTYPE html>
<script>
    function email()
    {
        var code=document.getElementById('mail').value;
        $.ajax({ url: '<?php echo site_url('admin/adminuser/check_email/');?>',
            data: {code: code},
            type: 'post',
            success: function(output) {
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
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Metronic | Login Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap-responsive.min.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/css/style-metro.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/css/style-responsive.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/css/themes/default.css"')?> rel="stylesheet" type="text/css" id="style_color"/>
    <link href="<?php echo base_url('assets/plugins/uniform/css/uniform.default.css')?>" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?php echo base_url('assets/css/pages/login.css"')?> rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL STYLES -->
    <link rel="shortcut icon" href="<?php echo base_url('favicon.ico')?>" />
    <script src="<?php echo base_url('js/registration_valid.js')?>"></script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
    <img src="<?php echo base_url('assets/img/logo-big.png')?>" alt="" />
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">

    <?php
    if(isset($edit_userdata))
    {
        foreach($edit_userdata as $value)
            $value= (array)$value;
    }
    else
    {
        $value="";
    }

    ?>
<!--<script src="--><?php //echo base_url('js/valid.js')?><!--"></script>-->
    <!-- BEGIN REGISTRATION FORM -->
    <form name="form" onsubmit="return registration()" action="<?php if(isset($add)){echo site_url('admin/login/add');}else{echo site_url('admin/login/insert');}?>" method="post">
        <h3 class="">Sign Up</h3>
        <p>Enter your account details below:</p>

        <div class="control-group">
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <div class="controls">
                <div class="input-icon left">
                    <i class="icon-user"></i>
                    <div id="admin_name"></div>
                    <input class="m-wrap placeholder-no-fix" type="text" placeholder="Firstname" name="admin_name"  id="admin_name" value="<?php echo set_value('admin_name')?>"/>
                </div>

                <div id="first" style="display:inline; color: red" >
                    <?php echo form_error('admin_name'); ?>
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label visible-ie8 visible-ie9">Lastname</label>
            <div class="controls">
                <div class="input-icon left">
                    <i class="icon-user"></i>
                    <input class="m-wrap placeholder-no-fix" type="text" placeholder="Lastname" name="admin_lastname" value="<?php echo set_value('admin_lastname')?>">
                </div>
                <div id="last" style="display:inline; color: red" >
                    <?php echo form_error('admin_lastname'); ?>
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="controls">
                <div class="input-icon left">
                    <i class="icon-lock"></i>
                    <input class="m-wrap placeholder-no-fix" type="password" id="register_password" placeholder="Password" name=admin_password value="<?php echo set_value('admin_password')?>"/>
                </div>
                <div id="pass" style="display:inline;color: red ">
                    <?php echo form_error('admin_password'); ?>
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
            <div class="controls">
                <div class="input-icon left">
                    <i class="icon-ok"></i>
                    <input class="m-wrap placeholder-no-fix" type="password" placeholder="Re-type Your Password" name="admin_compass" vvalue="<?php echo set_value('admin_compass')?>"/>
                </div>
                <di id="com" style="display:inline;color: red">
                    <?php echo form_error('admin_compass'); ?>
                </div>
            </div>

        <div class="control-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <div class="controls">
                <div class="input-icon left">
                    <i class="icon-envelope"></i>
                    <input id="mail" onchange="return email()" class="m-wrap placeholder-no-fix" type="text" placeholder="Email" name="admin_email" value="<?php echo set_value('admin_email')?>"/>
                </div>
                <div id="email" style="display:inline;color: red"><div id="remail">
                    <?php echo form_error('admin_email'); ?>
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                    <lable>Active<input type="radio"  name="status" value="M"/></lable>
                    <lable>Inctive<input type="radio"  name="status" value="F"/></lable>
                <br><div id="gender" style="display:inline;color: red">
                    <?php echo form_error('status'); ?>
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <label class="checkbox">
                    <input type="checkbox" name="tnc" id="cnt"/> I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                </label>
                <div id="tnc" style="display:inline;color: red">
                    <?php echo form_error('tnc'); ?>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <a  href="<?php echo site_url('admin/login/index')?>" type="button" class="btn">
                <i class="m-icon-swapleft"></i>  Back
            </a>
            <input type="submit" id="register-submit-btn" class="btn green pull-right">
                Sign Up <i class="m-icon-swapright m-icon-white"></i>
            </input>
        </div>
    </form>
    <!-- END REGISTRATION FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
    2013 &copy; Metronic. Admin Dashboard Template.
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo base_url('assets/plugins/jquery-1.10.1.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery-migrate-1.2.1.min.js')?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>

<script src="<?php echo base_url('assets/plugins/excanvas.min.js')?>" ></script>
<script src="<?php echo base_url('assets/plugins/respond.min.js')?>"></script>

<script src="<?php echo base_url('assets/plugins/jquery.blockui.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery.cookie.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/uniform/jquery.uniform.min.js')?>" type="text/javascript" ></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url('assets/plugins/jquery-validation/dist/jquery.validate.min.js')?>" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url('assets/scripts/app.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/scripts/login.js')?>" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        App.init();
        Login.init();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>