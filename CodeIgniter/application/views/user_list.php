<!DOCTYPE html>
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
                        <a href="index.html">Home</a>
                        <i class="icon-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/dashboard/back_dashbord')?>">Data Tables</a>
                        <i class="icon-angle-right"></i>
                    </li>
                    <li><a href="#">Editable Tables</a></li>
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
                    <div class="portlet-body">
                        <!--                            <div class="clearfix">-->
                        <div class="btn-group">
                            <a href="<?php echo base_url('admin/adminuser/add_admin');?>" id="sample_editable_1_new" class="btn green">
                                Add New <i class="icon-plus"></i>
                            </a>
                        </div>
                        <div class="btn-group pull-right">


                        </div>
                        <!--                            </div>-->
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                            <tr>
                                <th>Username   <a href='<?php echo site_url('admin/userlist/sort?sortby=user_name');?>' class='sort_icon'>   <img src="<?php echo base_url('/images/arrows.png')?>"></a> </th>
                                <th>Last Name  <a href='<?php echo site_url('admin/userlist/sort?sortby=user_lastname');?>' class='sort_icon'> <img src="<?php echo base_url('/images/arrows.png')?>"></a> </th>
                                <th>Email      <a href='<?php echo site_url('admin/userlist/sort?sortby=user_email');?>' class='sort_icon'>  <img src="<?php echo base_url('/images/arrows.png')?>"></a> </th>
                                <th>View</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <?php

                            if(empty($user)){
                                echo "No data avalablie";
                            }
                            else{

                                foreach($user as $value)
                                {$value = (array) $value;
                                    ?>
                                    <tr>
                                        <td><?php echo $value['user_name'];?></td>
                                        <td><?php echo $value['user_lastname'];?></td>
                                        <td><?php echo $value['user_email'];?></td>
                                        <td><a href="<?php echo site_url('admin/userlist/view_user_data/'.$value['user_id']);?>">View </a></td>
                                        <td><a href="<?php echo site_url('admin/userlist/delete_userlist_data/'.$value['user_id']);?>">Delete</a></td>
                                    </tr>
                                <?php } } ?>
                        </table>

                    </div>
                </div>
                <div class="pagination_listing">
                    <?php
                    foreach($links as $li)
                    {
                        echo "<li>" . $li . "</li>";
                    }
                    ?>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
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