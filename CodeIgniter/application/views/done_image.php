
<?php foreach($image as $value)
{

    ?>
    <img src="<?php echo base_url().'/images/'.$value['image_name'];?>" style="width: 100px;height: 100px">
<?php }?>


<img src="<?php echo base_url().'/images/'.$value['status']?>">
