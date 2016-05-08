<!DOCTYPE html>
<?php
if(isset($edit_userdata))
{
    foreach($edit_userdata as $value)
        $value= (array)$value;
}
else
{
    $value="";
}?>
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar nav-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu">
            <li>
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler hidden-phone"></div>
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            </li>
            <li>
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <form class="sidebar-search">
                    <div class="input-box">
                        <a href="<?php echo base_url('javascript:;')?>" class="remove"></a>
                        <input type="text" placeholder="Search..." />
                        <input type="button" class="submit" value=" " />
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="start active ">
                <a href="<?php echo base_url('index.html')?>">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li >
                <a href="<?php echo site_url('admin/adminuser/')?>">
                    Admin Managment</a>
            </li>

            <li >
                <a href="<?php echo site_url('admin/product/')?>">
                    Product Managment</a>
            </li>


            <li >
                <a href="<?php echo site_url('admin/dashboard/banner')?>">
                    Banner Managment</a>
            </li>


            <li >
                <a href="<?php echo site_url('admin/dashboard/reply')?>">
                    Complints Book</a>
            </li>
            <li >
                <a  href="<?php echo site_url('admin/dashboard/news')?>">news</a>
                <a  href="<?php echo site_url('admin/dashboard/done')?>">done</a>

            </li>
            <li >
                <a href="<?php echo site_url('admin/dashboard/setting')?>">
                    Setting</a>
            </li>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<!-- END SIDEBAR -->
<!-- BEGIN PAGE -->
<div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"></button>
            <h3>portlet Settings</h3>
        </div>
        <div class="modal-body">
            <p>Here will be a configuration form</p>
        </div>
    </div>
    <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN STYLE CUSTOMIZER -->
                <div class="color-panel hidden-phone">
                    <div class="color-mode-icons icon-color"></div>
                    <div class="color-mode-icons icon-color-close"></div>
                    <div class="color-mode">
                        <p>THEME COLOR</p>
                        <ul class="inline">
                            <li class="color-black current color-default" data-style="default"></li>
                            <li class="color-blue" data-style="blue"></li>
                            <li class="color-brown" data-style="brown"></li>
                            <li class="color-purple" data-style="purple"></li>
                            <li class="color-grey" data-style="grey"></li>
                            <li class="color-white color-light" data-style="light"></li>
                        </ul>
                        <label>
                            <span>Layout</span>
                            <select class="layout-option m-wrap small">
                                <option value="fluid" selected>Fluid</option>
                                <option value="boxed">Boxed</option>
                            </select>
                        </label>
                        <label>
                            <span>Header</span>
                            <select class="header-option m-wrap small">
                                <option value="fixed" selected>Fixed</option>
                                <option value="default">Default</option>
                            </select>
                        </label>
                        <label>
                            <span>Sidebar</span>
                            <select class="sidebar-option m-wrap small">
                                <option value="fixed">Fixed</option>
                                <option value="default" selected>Default</option>
                            </select>
                        </label>
                        <label>
                            <span>Footer</span>
                            <select class="footer-option m-wrap small">
                                <option value="fixed">Fixed</option>
                                <option value="default" selected>Default</option>
                            </select>
                        </label>
                    </div>
                </div>
                <!-- END BEGIN STYLE CUSTOMIZER -->
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Admin Management <small>Admin detail</small>
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="<?php echo site_url('admin/dashboard')?>">Home</a>
                        <i class="icon-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/adminuser')?>">Admin List</a>
                        <i class="icon-angle-right"></i>
                    </li>
                    <li><a href="#">Update Information</a></li>
                </ul>

                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-edit"></i>Admin Managenemt</div>
                        <!--                            <div class="tools">-->
                        <!--                                <a href="--><?php //echo base_url('#portlet-config')?><!--" class="collapse"></a>-->
                        <!--                                <a href="--><?php //echo base_url('#portlet-config')?><!--" data-toggle="modal" class="config"></a>-->
                        <!--                                <a href="--><?php //echo base_url('javascript:;')?><!--" class="reload"></a>-->
                        <!--                                <a href="--><?php //echo base_url('javascript:;')?><!--" class="remove"></a>-->
                        <!--                            </div>-->
                    </div>

</div>



                <form action="<?php echo site_url('admin/adminuser/update/');?>" method="post">

                        <div class="control-group">
                            <label style="display: inline">Username</label>


                            <input  class="span6 m-wrap" style="display: inline ;width: 250px" type="text" placeholder="Firstname" name="admin_name" value="<?php if(isset($edit_userdata)){echo $value['admin_name'];}else echo set_value('admin_name');?>"/>
                        </div>
                                <div style="display:inline; color: red" >
                                    <?php echo form_error('admin_name'); ?>
                                </div>
                            </div>



                        <div class="control-group">
                            <label style="display: inline">Lastname</label>

                                    <input class="span6 m-wrap" style="display: inline ;width: 250px"type="text" placeholder="Lastname" name="admin_lastname" value="<?php if(isset($edit_userdata)){echo $value['admin_lastname'];}else echo set_value('admin_lastname');?>"/>
                                </div>
                                <div style="display:inline; color: red" >
                                    <?php echo form_error('admin_lastname'); ?>
                                </div>




                        <div class="control-group">
                            <label style="display: inline" >Password</label>
                                 <input class="span6 m-wrap" style="display: inline ;width: 250px" type="password" id="register_password" placeholder="Password" value="<?php if(isset($edit_userdata)){echo $value['admin_password'];}else echo set_value('admin_password');?>" name="admin_password"/>
                                </div>
                                <div style="display:inline;color: red ">
                                    <?php echo form_error('admin_password'); ?>
                                </div>

                        <div class="control-group">
                            <label style="display: inline" >Confirm</label>
                            &nbsp;
                                    <input class="span6 m-wrap" style="display: inline ;width: 250px" type="password" placeholder="Re-type Your Password" name="admin_compass" value="<?php if(isset($edit_userdata)){echo $value['admin_password'];}else echo set_value('admin_password');?> "/>
                                </div>
                                <div style="display:inline;color: red">
                                    <?php echo form_error('admin_compass'); ?>
                                </div>

                        <div class="control-group">
                            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                            <label style="display: inline">Email</label>

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="span6 m-wrap" style="display: inline ;width: 250px" type="text" placeholder="Email" name="admin_email" value="<?php if(isset($edit_userdata)){echo $value['admin_email'];}else echo set_value('admin_email');?>"/>
                                </div>
                                <div style="display:inline;color: red">
                                    <?php echo form_error('admin_email'); ?>
                                </div>



                            <a  href="<?php echo site_url('admin/adminuser')?>" type="button" class="btn">
                                 Back
                            </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="submit" id="register-submit-btn" class="btn green" value="Submit">

                            </input>
                        </div>
                        </form>


</div>
</div>
<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER-->
</div>
<!-- END PAGE -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="footer">
    <div class="footer-inner">
        2013 &copy; Metronic by keenthemes.
    </div>
    <div class="footer-tools">
			<span class="go-top">
			<i class="icon-angle-up"></i>
			</span>
    </div>
</div>

<script>
    jQuery(document).ready(function() {
        App.init();
        TableEditable.init();
    });
</script>
</body>
<!-- END BODY -->
</html>

