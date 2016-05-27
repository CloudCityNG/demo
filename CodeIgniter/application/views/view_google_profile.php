hello
<form action="<?php echo base_url('google/destroy')?>" method="post">
<?php
    echo "<h1>" . $user_name . "</h1>";
    echo "<h1>" . $user_lastname . "</h1>";
    echo "<h1>" . $user_email . "</h1>";
    echo "<h1>" . $google_token. "</h1>";
?>
<input type="submit" name="submit" value="logout">
</form>