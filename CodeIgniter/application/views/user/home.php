<html lang="en">

<body>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/pagination.css">
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <!--          Banner              -->
                    <div class="carousel-inner">
                        <?php
                            $i = 1;
                            foreach ($cms as $img):
                                 $img=(array)$img;
                                 $item_class = ($i == 1) ? 'item active' : 'item';
                                ?>
                                <div class="<?php echo $item_class ?>">
                                 <div class="col-sm-6">
                                     <h1><span><?php echo $img['title']?></span></h1>
                                     <h2><?php echo $img['content'] ?></h2>
                                     <p><?php echo $img['meta_description']?> </p>
                                     <button type="button" class="btn btn-default get">Get it now</button>
                                 </div>
                                    <div class="col-sm-6">
                                        <img src="<?php echo base_url().'/images/'.$img['banner_name'];?>" class="img-responsive" style="width: 481px;height: 441px">
                                    </div>
                                </div>
                                <?php
                                $i++;
                            endforeach;
                        ?>
                    </div>

<!--                    //Banner  -->

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section><!--/slider-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>

                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <?php
                                        foreach ($category as $item)
                                        {
                                            $item=(array)$item;
                                    ?>
                                    <a  href="<?php echo site_url('home/category/'.$item['category_id'])?>">
                                    <b><?php
                                         echo $item['category_name']."<br>"."<br>";
                                        }
                                    ?>
                                    </a>
                                </h4>
                            </div>
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <?php if(!empty($categorys)){
                                    foreach ($categorys as $item)
                                    {
                                    $item=(array)$item;
                                    ?>
                                    <a  href="<?php echo site_url('home/category/'.$item['category_id'])?>">
                                        <?php
                                        echo $item['category_name']."<br>"."<br>";
                                         }
                                        }
                                        else{
                                           echo "";
                                        }
                                        ?>
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </div><!--/category-products-->
                    <div class="shipping text-center"><!--shipping-->
                        <?php
                        foreach($banner as $value) {
                            $value = (array)$value;
                        }?>
                        <img src="<?php echo base_url().'/images/'.$value['banner'];?>" >
                    </div><!--/shipping-->

                </div>
            </div>
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Features Items</h2>
                    <?php
                    if(empty($product))
                    {
                        echo "NO data avalabile";
                    }
                    else{
                    foreach($product as $value)
                    {
                        $value=(array)$value;
                        ?>
                        <?php  $ses=$this->session->userdata('user_session')?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="<?php echo site_url('home/product_view/'.$value['product_id'])?>"> <img src="<?php echo base_url().'/images/'.$value['image_name'];?>" style="width: 100px;height: 100px"></a>
                                        <h2><?php echo $value['price']?></h2>
                                        <p><?php echo $value['name']?></p>
                                        <a href="<?php echo site_url('home/add_to_cart/'.$value['product_id']);?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    <div>
                                    </div>
                                </div><?php $data=$this->session->userdata('user_session');?>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="<?php if(!empty($data)){echo site_url('Userwishlist/add_to_wishlist/'.$value['product_id']);}else{echo site_url('Userlogin/login');}?>"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php }} ?>
                </div>
                <div style="margin-left: 350px">

                    <ul class="tsc_pagination tsc_paginationA tsc_paginationA01">
                        <?php
                        foreach($links as $li)
                        {
                            echo " <li>". $li . "</li>";
                        }
                        ?>
                    </ul>
                </div><br><br>



            <div class="recommended_items"><!--recommended_items-->
                <h2 class="title text-center">recently added items</h2>

                <?php
                if(empty($recommend))
                {
                    echo "NO data avalabile";
                }
                else{
                    foreach($recommend as $value)
                    {
                        $value=(array)$value;
                        ?>
                        <?php  $ses=$this->session->userdata('user_session')?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="<?php echo site_url('home/product_view/'.$value['product_id'])?>"> <img src="<?php echo base_url().'/images/'.$value['image_name'];?>" style="width: 100px;height: 100px"></a>
                                        <h2><?php echo $value['price']?></h2>
                                        <p><?php echo $value['name']?></p>
                                        <a href="<?php echo site_url('home/add_to_cart/'.$value['product_id']);?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    <div>
                                    </div>
                                </div><?php $data=$this->session->userdata('user_session');?>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="<?php if(!empty($data)){echo site_url('Userwishlist/add_to_wishlist/'.$value['product_id']);}else{echo site_url('Userlogin/login');}?>"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php }} ?>
            </div><!--/recommended_items-->
            </div>
</section>
</body>
</html>