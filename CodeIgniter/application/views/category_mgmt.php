<!DOCTYPE html>
<script>
    function delete_con()
    {
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }
    }
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/pagination.css">
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
                    Category Managment</a>
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
                <a href="<?php echo site_url('admin/dashboard/reply')?>">
                    Complints Book</a>
            </li>

            <li >
                <a href="<?php echo site_url('admin/userlist')?>">
                    User List</a>
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
                    Category Management <small>Category detail</small>
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="<?php echo base_url('admin/dashboard')?>">Home</a>
                        <i class="icon-angle-right"></i>
                    </li>

                    <li><a href="#">Category List</a></li>
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
                        <div class="caption"><i class="icon-edit"></i>Category Managenemt</div>
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
                            <a href="<?php echo base_url('admin/category/add_category');?>" id="sample_editable_1_new" class="btn green">
                                Add New <i class="icon-plus"></i>
                            </a>
                        </div>
                        <div class="btn-group pull-right">
                            <form style="height: 30px; " action="<?php echo site_url('admin/category/search_category')?>" method="post">
                                <input style="width:150px" type="text" class="span6 m-wrap" name="search"/>
                                <input type="submit" class="btn" name="searchs">Search
                                </input>

                            </form>

                        </div>
                        <!--                            </div>-->
                        <center><?php echo "<h3 style='color: green'>".$this->session->flashdata('msg');"<h3>"?></center>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                            <tr>
                                <th>Category Name   <a href='<?php echo site_url('admin/adminuser?sortby=category_name');?>' class='sort_icon'>   <img src="<?php echo base_url('/images/arrows.png')?>"></a> </th>
                                <th>Parent Id> </th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <?php

                            if(empty($category)){
                                echo "No data avalablie";
                            }
                            else{

                                foreach($category as $value)
                                {$value = (array) $value;
                                    ?>
                                    <tr>
                                        <td><?php echo $value['category_name'];?></td>
                                        <td><?php echo $value['parent_id'];?></td>
                                        <td><a  href="<?php echo site_url('admin/category/edit_category/'.$value['category_id']);?>">Edit </a></td>
                                        <td><a onclick="return delete_con()" href="<?php echo site_url('admin/category/delete_category/'.$value['category_id']);?>">Delete</a></td>
                                    </tr>
                                <?php } } ?>
                        </table>

                    </div>
                </div>
                <div class="pagination_listing">
                    <ul class="tsc_pagination tsc_paginationA tsc_paginationA01">
                        <?php
                        foreach($links as $li)
                        {
                            echo "<li style=''>" . $li . "</li>";
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