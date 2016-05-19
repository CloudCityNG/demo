<!DOCTYPE html>

<?php
if(isset($cms)){foreach($cms as $value)
$value=(array)$value;}
else{
    echo "";
}

?>
<script src="<?php echo base_url('js/update_cms_validation.js');?>" ></script>
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
                <a href="<?php echo site_url('admin/banner')?>">
                    Banner Managment</a>
            </li>

            <li >
                <a href="<?php echo site_url('admin/category')?>">
                    Category Management</a>
            </li>
            <li >
                <a href="<?php echo site_url('admin/userlist')?>">
                    User List</a>
            </li>
            <li >
                <a href="<?php echo site_url('admin/dashboard/reply')?>">
                    Complints Book</a>
            </li>
            <li >
                <a href="<?php echo site_url('admin/cms')?>">
                    CMS</a>
            </li>
            <li >
                <a href="<?php echo site_url('admin/dashboard/setting')?>">
                    Setting</a>
            </li>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
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
                        <a href="<?php echo site_url('admin/dashboard/back_dashbord')?>">Home</a>
                        <i class="icon-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/adminuser/')?>">Admin List</a>
                        <i class="icon-angle-right"></i>
                    </li>
                    <li><a href="#">New Admin</a></li>
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



                <center>  <form name="form" onsubmit="return cms_valid()"  action="<?php echo site_url('admin/cms/update/')?>" method="post" enctype="multipart/form-data">

<!--                    <input type="hidden" value="--><?php //if(isset($cms)){echo $value['cms_id'];}else{echo $c_id;}?><!--" name="id">-->


                    <div class="control-group ">

                        &nbsp;
                           <img src="<?php if(isset($cms)) {echo base_url().'/images/'.$value['banner_name'];}else{echo "";}?>"style="width: 200px;height: 200px" >
                        <br>
                        <input type="file" class="default" name="banner_name" size="20"  />
                    </div>
                    <div class="control-group">
                        <label style="display: inline;width: 200px">Title</label>
                        <input class="span6 m-wrap"  style="margin-left: 120px ;display: inline;width:250px;"type="text" placeholder="Title" name="title" value="<?php if(isset($cms)){echo $value['title'];}else{echo set_value('title');}?>"/>
                    </div>
                    <div id="title" style="display:inline; color: red" >
                        <?php echo form_error('title'); ?>
                    </div>
                    <div class="control-group">
                        <label style="display: inline">Content</label>
                        <input class="span6 m-wrap" style="margin-left: 105px ;display: inline;width:250px;" type="text" placeholder="Content" name="content" value="<?php if(isset($cms)){echo $value['content'];}else {echo set_value('content');}?>"/>
                    </div>
                    <div id="content" style="display:inline; color: red" >
                        <?php echo form_error('content'); ?>
                    </div>
                    <div  class="control-group">
                        <label style="display: inline" >Meta-Description</label>
                        <textarea class="span6 m-wrap" style="margin-left: 50px ;display: inline;width:250px;" type="password" id="register_password" placeholder="Meta-description"  name="meta_description"><?php if(isset($cms)){echo $value['meta_description'];}else echo set_value('meta_description')?></textarea>
                    </div>
                    <div id="meta_desc" style="display:inline;color: red ">
                        <?php echo form_error('meta_desc'); ?>
                    </div>

                    <div class="control-group">
                        <label style="display: inline" >Meta-Keyword</label>
                        &nbsp;
                        <textarea  class="span6 m-wrap" style="margin-left: 60px ;display: inline;width:250px;" type="password" placeholder="Meta_Keyword" name="meta_keyword"><?php if(isset($cms)){echo $value['meta_keywords'];}{ echo set_value('meta_keyword');}?></textarea>
                    </div>
                    <div id="meta_key" style="display:inline;color: red">
                        <?php echo form_error('meta_key'); ?>
                    </div>


            </div>

          <center>  <a  style="margin-left: 50px" href="<?php echo site_url('admin/cms')?>" type="button" class="btn">
                Back
            </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input style="margin-left: 50px" type="submit" id="register-submit-btn" class="btn green" value="Submit">

            </input>
</center>

        </div>

        </form></center>


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
