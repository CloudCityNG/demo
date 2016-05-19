<!DOCTYPE html>
<script src="<?php echo base_url('js/up_product_validation.js');?>"></script>
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
                    <h3 class="page-title">
                       Edit Product

                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="<?php echo base_url('admin/dashboard')?>">Home</a>
                            <span class="icon-angle-right"></span>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admin/product')?>">Product List</a>
                            <span class="icon-angle-right"></span>
                        </li>
                        <li><a href="#">Edit Product</a></li>
                    </ul>
                </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <?php
            if(isset($edit_productdata))
            {
                foreach($edit_productdata as $value)
                    $value= (array)$value;
            }
            else
            {
                $value="";
            }?>
            <div class="row-fluid">
                <form  name="form" onsubmit="return product_valid()"   action="<?php echo site_url('admin/product/product_update');?>" method="post" enctype="multipart/form-data">
                    <div class="span12">

                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet box blue"></div>

                        <input type="hidden" name="prod_id" value="<?php if(isset($edit_productdata)){echo $value['product_id'];}else echo set_value('prod_id');?>"/>

                        <div class="control-group">
                            <label class="control-label">Product Name</label>
                            <div class="controls">
                                <input type="text" class="span6 m-wrap" style="width:905px" name="name" value="<?php if(isset($edit_productdata)){echo $value['name'];}else echo set_value('name');?>"/>
                                <span class="help-inline"></span>
                                <div id="name" style="display:inline; color: red">
                                    <?php echo form_error('name'); ?>
                                </div>
                            </div>

                        </div>

                        <div class="control-group">
                            <label class="control-label">SKU</label>
                            <div class="controls">
                                <input type="text" class="span6 m-wrap" style="width:905px" name="sku" value="<?php if(isset($edit_productdata)){echo $value['sku'];}else echo set_value('sku');?>"/>
                                <span class="help-inline"></span>
                            </div>
                            <div id="sku" style="display:inline; color: red" >
                              <?php echo form_error('sku'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" >Description</label>
                            <div class="controls">
                                <textarea class="span6 m-wrap" style="width:905px"rows="3" name="short_description" ><?php if(isset($edit_productdata)){echo $value['short_description'];}else echo set_value('short_description');?></textarea>
                            </div>
                            <div id="short" style="display:inline; color: red" >
                                <?php echo form_error('short_description'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">CKEditor</label>
                            <div class="controls">
                                <textarea class="span6 m-wrap" style="width:905px"rows="3" name="long_description"><?php if(isset($edit_productdata)){echo $value['long_description'];}else echo set_value('long_description');;?></textarea>
                            </div>
                            <div id="long" style="display:inline; color: red" >
                                <?php echo form_error('long_description'); ?>
                            </div>
                        </div>

                        <div class="control-group" style="display:inline;">
                            <label class="control-label">Price</label>
                            <div class="controls"style="display:inline;">
                                <div class="input-prepend input-append"style="display:inline;">
                                    <span class="add-on">$</span><input  class="m-wrap " type="text" name="price"value="<?php if(isset($edit_productdata)){echo $value['price'];}else echo set_value('price');?>"/><span class="add-on">.00</span>
                                </div>
                            </div>
                            <div id="price" style="display:inline; color: red" >
                                <?php echo form_error('price'); ?>
                            </div>
                        </div>
                        <div class="control-group" style="display:inline;">
                            <label class="control-label">Special Price</label>
                            <div class="controls">
                                <div class="input-prepend input-append">
                                    <span class="add-on">$</span><input  class="m-wrap " type="text" name="special_price"value="<?php if(isset($edit_productdata)){echo $value['special_price'];}else echo set_value('special_price');?>"/><span class="add-on">.00</span>
                                </div>
                            </div>

                            <div id="special" style="display:inline; color: red" >
                                <?php echo form_error('special_price'); ?>
                            </div>
                        </div>
                        <div></div>
                        <div class="control-group" ">
                            <label class="control-label"style="display:inline">Starts with years view</label>
                            <div class="controls">
                                <div class="input-append date date-picker"style="display:inline" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                    <input class="example1" style="display:inline"; name="special_price_form" class="m-wrap m-ctrl-medium date-picker" readonly size="16" type="text" value="<?php if(isset($edit_productdata)){echo $value['special_price_form'];}else echo set_value('special_price_form');?>" /><span class="add-on"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                            <div id="date_from" style="display:inline; color: red" >
                                <?php echo form_error('special_price_from'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label style="display:inline" class="control-label">Limit the view mode to months</label>
                            <div class="controls" >
                                <div style="display:inline" class="input-append date date-picker"  data-date="102/2012" data-date-format="mm/yyyy" data-date-viewmode="years" data-date-minviewmode="months">
                                    <input class="example1" style="display:inline"; name="special_price_to"class="m-wrap m-ctrl-medium date-picker" readonly size="16" type="text" value="<?php if(isset($edit_productdata)){echo $value['special_price_to'];}else echo set_value('special_price_to');?>" /><span class="add-on"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                            <div id="date_to" style="display:inline; color: red" >
                                <?php echo form_error('special_price_to'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Status</label>
                            <div class="controls">
                                <label class="radio">
                                    <input type="radio" name="status" value="1" />
                                    Avalible
                                </label>
                                <label class="radio">
                                    <input type="radio" name="status" value="0" checked />
                                    Unavalible
                                </label>
                            </div>
                            <div style="display:inline; color: red" >
                                <?php echo form_error('status'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Quntity</label>
                            <div class="controls">
                                <input type="text" style="width:905px"class="span6 m-wrap" name="quntity"value="<?php if(isset($edit_productdata)){echo $value['quntity'];}else echo set_value('quntity');?>"/>
                                <span class="help-inline"></span>
                            </div>
                            <div id="qun" style="display:inline; color: red" >
                                <?php echo form_error('quntity'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Meta Title</label>
                            <div class="controls">
                                <input type="text" style="width:905px"class="span6 m-wrap" name="meta_title"value="<?php if(isset($edit_productdata)){echo $value['meta_title'];}else echo set_value('meta_title');?>"/>
                                <span class="help-inline"></span>
                            </div>
                            <div id="title" style="display:inline; color: red" >
                                <?php echo form_error('meta_title'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Meta-Description</label>
                            <div class="controls">
                                <textarea class="span6 m-wrap" rows="3"style="width:905px"name="meta_description"><?php if(isset($edit_productdata)){echo $value['meta_description'];}else echo set_value('meta_description');?></textarea>
                            </div>
                            <div id="meta_desc" style="display:inline; color: red" >
                                <?php echo form_error('meta_description'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Meta-Keywords</label>
                            <div class="controls">
                                <textarea class="span6 m-wrap" rows="3"style="width:905px"name="meta_keywords"><?php if(isset($edit_productdata)){echo $value['meta_keywords'];}else echo set_value('meta_keywords');?></textarea>
                            </div>
                            <div id="meta_key"style="display:inline; color: red" >
                                <?php echo form_error('meta_keywords'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Status</label>
                            <div class="controls">
                                <label class="radio">
                                    <input type="radio" name="product_status" value="1" />
                                    Option 1
                                </label>
                                <label class="radio">
                                    <input type="radio" name="product_status" value="0" checked />
                                    Option 2
                                </label>
                            </div>
                            <div style="display:inline; color: red" >
                                <?php echo form_error('product_status'); ?>
                            </div>
                        </div>
                    <div class="control-group">
                        <label class="control-label">Image Upload</label>
                        <div class="controls">
                            <div >

                                <div>
													<span class="btn btn-file"><span class="fileupload-new"></span>
                                                        <!--													<span class="fileupload-exists">Change</span>-->
													<img src="<?php echo base_url().'/images/'.$value['image_name'];?>"style="width: 100px;height: 100px" >
                                                        <br><input type="file" class="default" name="image_name" size="20" >
<!--                                                                   value="--><?php //if(isset($edit_productdata)){echo $value['image_name'];}else echo "";?><!--"/>-->
                                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>


                        <div class="form-actions">
                            <button type="submit" class="btn blue">Product Add In Store</button>
                            <a href="<?php echo base_url('admin/product');?>" type="button" class="btn">Cancel</a>
                        </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>

        <!-- END EXTRAS PORTLET-->
    </div>
</div>
<!-- END PAGE CONTENT-->
<!-- END PAGE CONTAINER-->

<!-- END PAGE -->

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
<!-- END FOOTER -->




<script type="text/javascript">
    // When the document is ready
    $(document).ready(function () {

        $('.example1').datepicker({
            dateFormat: "yy-mm-dd",
        });

    });
</script>

<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        App.init();
        FormComponents.init();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>