
<?php foreach($image as $value)
{
    $value =(array)$value;

    ?>
    <img src="<?php echo base_url().'/images/'.$value['image_name'];?>" style="width: 100px;height: 100px">
<?php }?>