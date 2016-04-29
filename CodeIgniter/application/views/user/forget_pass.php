<!DOCTYPE html>
<html lang="en">

<body >
<section id="form" style="margin-top: 100px"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="login-form"><!--login form-->
                    <h2>Enter E-mail</h2>
                    <form action="<?php echo site_url('UserControl/forget_user')?>" method="post">
                        <input type="text" placeholder="e-mail" name="user_email"/>
                        <div style="display:inline; color: red" >
                            <?php if(isset($email)){echo "Invalid User Email";}else{echo "";} ?>
                        </div>
                        <button type="submit" class="btn btn-default col-sm-12">Submit</button>
                    </form>
                </div><!--/login form-->
            </div>


        </div>
    </div>
</section><!--/form-->



</body>
</html>