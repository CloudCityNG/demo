<html>
<head>
    <title>Upload Form</title>
</head>
<body>

<?php echo $error;?>



<?php foreach($img as $value)
{

?>
<img src="<?php echo base_url().'/images/'.$value['image_name'];?>" style="width: 100px;height: 100px">
<?php }?>

<form action="<?php echo site_url('welcome/img')?>" enctype="multipart/form-data" method="post">

<input type="file" name="image_name" size="5" />

<br /><br />

<input type="submit" value="upload" />

</form>
</body>
</html>