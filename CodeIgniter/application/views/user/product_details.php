
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
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">

                            <div class="gallery" align="center">
                                <br/>
                                <div class="thumbnails">


                                    <?php $img='';?>



                                    <div class="preview" align="center">
                                        <img name="preview" src="<?php echo base_url('./images/'.$img)?>" alt=""/>
                                    </div>

                                    <?php foreach($product as $value)
                                    {$value=(array)$value;
                                        ?>
                                        <img src="<?php echo base_url('./images/'.$value['image_name'])?>" onmouseover="preview.src=<?php echo "image_name".$value['img_id'];?>.src" name="<?php echo "image_name".$value['img_id'];?>" style="width: 100px;height: 100px">
                                        <?php $img=$value['image_name'];?>
                                    <?php }?>

                                </div>

                                <br/>

                            </div>


                            <h3>ZOOM</h3>
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">

                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>

                        <?php foreach($product as $item)
                            $item=(array)$item;
                        ?>
                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <img src="<?php echo base_url('images/product-details/new.jpg')?>" class="newarrival" alt="" />
                            <h2><?php echo $value['name']?></h2>
                            <p>Web ID: <?php echo $value['product_id']?></p>
                            <img src="<?php echo base_url('./images/product-details/rating.png')?>" alt="" />
								<span>
									<span>Price<?php echo $value['price']?></span>
									<label>Quantity:</label>
									<input readonly type="text" value="<?php echo $value['quntity']?>" />
                                    <br><a href="<?php echo site_url('home/add_to_cart/'.$value['product_id']);?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

								</span>
                            <p><b>Availability:</b> In Stock</p>
                            <p><b>Condition:</b> New</p>
                            <p><b>Brand:</b> E-SHOPPER</p>
                            <a href=""><img src="<?php echo base_url('images/product-details/share.png')?>" class="share img-responsive"  alt="" /></a>
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active" ><a  href="#details" data-toggle="tab">Details</a></li>

                        </ul>
                    </div>
                    <table  class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <tr>
                            <th style="width: 40%">Titles</th>
                            <th>Description</th>
                        </tr>
                        <?php foreach($product as $item)
                            $item=(array)$item;
                        ?>
                        <tr>
                            <td>Name</td>
                            <td><?php echo $value['name']?></td>
                        </tr>
                        <tr>
                            <td>SKU</td>
                            <td><?php echo $value['sku']?></td>
                        </tr>
                        <tr>
                            <td>Short-Desacription</td>
                            <td><?php echo $value['short_description']?></td>
                        </tr>
                        <tr>
                            <td>Biref-Desacription</td>
                            <td><?php echo $value['long_description']?></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td><?php echo $value['price']?></td>
                        </tr>
                        <tr>
                            <td>Special Price</td>
                            <td><?php echo $value['special_price']?></td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td><?php echo $value['quntity']?></td>
                        </tr>
                        <tr>
                            <td>Meta-Title</td>
                            <td><?php echo $value['meta_title']?></td>
                        </tr>
                        <tr>
                            <td>Meta-Desacription</td>
                            <td><?php echo $value['meta_description']?></td>
                        </tr>
                        <tr>
                            <td>Meta-Keywords</td>
                            <td><?php echo $value['meta_keywords']?></td>
                        </tr>
                      </table>




                <div class="recommended_items"><!-- recommended_items-->
                    <h2 class="title text-center">recommended items</h2>

                    <div class="recommended_items" id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <center> <div class="carousel-inner">
                           <?php
                            $i = 1;
                            foreach ($recommend as $rec):
                                $rec=(array)$rec;
                                $item_class = ($i == 1) ? 'item active' : 'item';
                                ?>
                                <div style="margin-left: 270px" class="<?php echo $item_class ?>">
                                    <div class="col-sm-6">
                                        <a href="<?php echo site_url('home/product_view/'.$rec['product_id'])?>">  <img src="<?php echo base_url().'/images/'.$rec['image_name'];?>" class="img-responsive" style="width: 200px;height: 200px"></a>
                                        <?php echo $rec['name']?><br>
                                        <?php echo $rec['price']?><br>
                                        <a href="<?php echo site_url('home/add_to_cart/'.$rec['product_id']);?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

                                    </div>
                                </div>
                                <?php
                                $i++;
                            endforeach;
                            ?>
                        </div>

                        </div></center>

                        <a style="margin-top: 650px" class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a style="margin-top: 650px" class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div><!--/recommended_items-->

            </div>
        </div>
    </div>
</section>


<script src="js/jquery.js"></script>
<script src="js/price-range.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/main.js"></script>
</body>
</html>
