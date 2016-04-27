<html>
<head>
    <title>Upload Form</title>
</head>
<body>

<?php echo $error;?>



<?php $sort='sort.png';?>
<img src="<?php echo $_SERVER['DOCUMENT_ROOT'].'/images/'.$sort;?>" style="width: 100px;height: 100px;">


<form action="<?php echo site_url('welcome/img')?>" enctype="multipart/form-data" method="post">

<input type="file" name="image_name" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>
</body>
</html>