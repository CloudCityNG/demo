<html>

<body>


<h1 style="text-align: center">Question Anwser</h1>
<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
    <?php
    if(empty($ans)){
        echo "No data avalablie";
    }
    else{

        foreach($ans as $value)
        {$value = (array) $value;
            ?>

            <tr>
                <td><?php echo " <b>Query<b> "?></td>
                <td><?php echo $value['note_admin'];?></td>
            </tr>
             <tr>
                 <td><?php echo " <b>Answer<b> "?></td>
                 <td><?php echo $value['admin_replay'];?></td>
            </tr>
        <?php } } ?>
</table>

</body>