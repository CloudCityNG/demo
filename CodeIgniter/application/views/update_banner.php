
<?php

foreach($img as $item)
{
    $item=(array)$item;

?>

    <form action="<?php echo site_url('admin/dashboard/updateed_image?img_id='.$item['img_id'])?>" enctype="multipart/form-data" method="post">
<img src="<?php echo base_url().'/images/'.$item['image_name']?>"style="width: 200px;height: 200px;">
        <input type="file" class="default" name="image_name" size="20"/>
        <input type="submit" name="Apply" value="upload">
</form>
<?php }?>