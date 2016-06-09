
<html>
<head>
<body>
<br><br>
<div style="margin-left: 120px">
    <img src="logo.jpg" style="height: 50px;margin-left: 40px">
    <br>



    <br>
    <div style="margin-left: 50px" >Dear Adminstrator :</div><br>
    <div style="margin-left: 50px" >Plsease check Below Details :</div><br>
    <div>
        <table border="1" style="margin-left: 50px;;width:600px;">
            <tr>
                <td style="width: 50%">Name</td>
                <td><?php echo $user ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo $email ?></td>
            </tr>
            <tr>
                <td>Contact No</td>
                <td><?php echo $contact?></td>
            </tr>
            <tr>
                <td>Comment</td>
                <td><?php echo $note_admin?></td>
            </tr>
        </table>
    </div><br>

</div>

</body>
</head>
</html>