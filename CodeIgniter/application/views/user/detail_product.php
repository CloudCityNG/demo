
<!---->
<!--<table>-->
<!--    <tr style="column-span: 5">-->
<!--        <td>-->
<!--            <img src="--><?php //echo base_url('./images/'.$value['image_name'])?><!--">-->
<!--        </td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td></td>-->
<!--        <td></td>-->
<!--        <td></td>-->
<!--        <td></td>-->
<!--        <td></td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>-->
<!--            <tr></tr>-->
<!--            <tr></tr>-->
<!--        </td>-->
<!--        <td>-->
<!--            <tr></tr>-->
<!--            <tr></tr>-->
<!--        </td>-->
<!--    </tr>-->
<!--</table>-->



<html>
<head>
    <title>Simple HTML Photo Gallery with JavaScript</title>

    <style type="text/css">

        a {
            color: #FFF;
        }
        a:hover {
            color: yellow;
            text-decoration: underline;
        }
        .thumbnails img {
            height: 80px;
            border: 4px solid #555;
            padding: 1px;
            margin: 0 10px 10px 0;
        }

        .thumbnails img:hover {
            border: 4px solid #00ccff;
            cursor:pointer;
        }

        .preview img {
            border: 4px solid #444;
            padding: 1px;
            width: 800px;
            height: 400px;
        }
    </style>

</head>
<body style="bgcolor:red">

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
        <img src="<?php echo base_url('./images/'.$value['image_name'])?>" onmouseover="preview.src=<?php echo "image_name".$value['img_id'];?>.src" name="<?php echo "image_name".$value['img_id'];?>">
           <?php $img=$value['image_name'];?>
        <?php }?>

    </div>

    <br/>

</div>



<table style="font-size: 200%;width: 800px;margin-left: 220px" class="table table-striped table-hover table-bordered" id="sample_editable_1">
    <tr>
        <th>Titles</th>
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
        </div>
    </div>
</body>

</html>





