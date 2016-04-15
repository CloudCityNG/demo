<?php
include('phpvalidation.php');
function selected($blood_group, $choice) {
    if($blood_group==$choice) echo "selected";
}
?>
<html>
<head>
    <title>Validating Form with PHP - by Arpan Das (http://w3epic.net)</title>
    <style>
        body
        {
            font-family: 'trebuchet ms';
            font-size: 1.4em;
            padding: 0 50px; color: #444;
        }
        input, textarea {font-size: 1em;}
        p.error {background: #ffd; color: red;}
        p.error:before {content: "Error: ";}
        p.success {background: #ffd; color: green;}
        p.success:before {content: "Success: ";}
        p.error, p.success {font-weight: bold;}
    </style>
</head>
<body>
<h1>Validating Form with PHP - by Arpan Das (http://w3epic.net)</h1>
<h2>Please fill up the form below and submit.</h2>
<?=$error?>
<form action="htmlform.php" method="post">
    <table>
        <tr>
            <td>Username: </td>
            <td><input type="text" name="username" value="<?=@$username?>"/>
                <?=$err?>(3 to 20 alpha-numeric characters)</td>
        </tr>
        <tr>
            <td>First name: </td>
            <td><input type="text" name="first_name" value="<?=@$first_name?>"/> (3 to 20 alpha characters only)</td>
        </tr>
        <tr>
            <td>Last name: </td>
            <td><input type="text" name="last_name" value="<?=@$last_name?>"/> (3 to 20 alpha characters only)</td>
        </tr>
        <tr>
            <td>Password: </td>
            <td><input type="password" name="password" value="<?=@$password?>"/> (3 to 20 characters only)</td>
        </tr>
        <tr>
            <td>Confirm password: </td>
            <td><input type="password" name="confirm_password" value="<?=@$confirm_password?>"/> (3 to 20 characters only)</td>
        </tr>
        <tr>
            <td>Email: </td>
            <td><input type="text" name="email" value="<?=@$email?>"/> (Valid email like name@domain.com)</td>
        </tr>
        <tr>
            <td>Phone: </td>
            <td><input type="text" name="phone" value="<?=@$phone?>"/> (10 digit mobile number)</td>
        </tr>
        <tr>
            <td>Gender: </td>
            <td><input type="radio" name="gender" value="male" <?php if(@$gender=='male')echo 'checked="true"';?>
                    <?php if(!isset($gender))echo 'checked="true"';?>/> male
                <input type="radio" name="gender" value="female"
                    <?php if(@$gender=='female')echo 'checked="true"';?> /> female</td>
        </tr>
        <tr>
            <td>Blood Group: </td>
            <td>
                <select name='blood_group'>
                    <option value="0" >Select Blood Group</option>
                    <option value="1" <?php selected(@$blood_group, 1) ?>>A Positive</option>
                    <option value="2" <?php selected(@$blood_group, 2) ?>>A Negative</option>
                    <option value="3" <?php selected(@$blood_group, 3) ?>>B Positive</option>
                    <option value="4" <?php selected(@$blood_group, 4) ?>>B Negative</option>
                    <option value="5" <?php selected(@$blood_group, 5) ?>>AB Positive</option>
                    <option value="6" <?php selected(@$blood_group, 6) ?>>AB Negative</option>
                    <option value="7" <?php selected(@$blood_group, 7) ?>>O Positive</option>
                    <option value="8" <?php selected(@$blood_group, 8) ?>>O Negative</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Date of Birth: </td>
            <td><input type="number" name="day" value="<?=@$day?>" size=2/>/
                <input type="number" name="month" value="<?=@$month?>" size=2/>/
                <input type="number" name="year" value="<?=@$year?>" size=4/> (DD/MM/YYYY)</td>
        </tr>
        <tr>
            <td>Bio: </td>
            <td><textarea name="bio"><?=@$bio?></textarea></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="Submit"/> <input type="reset" name="reset" value="Reset"/>
</form>
<?php
if (isset($_POST['submit']) && $error == '') { // if there is no error, then process further
    echo "<p class='success'>Form has been submitted successfully.</p>"; // showing success message
header("Location:main.php");
    // hashing the password and sanitize data
//    $_POST['password'] = md5($_POST['password']);
//    foreach ($_POST as $key => $val) {
//        $_POST[$key] = mysql_real_escape_string($_POST[$key]);
        // Or you can use $mysqli->real_escape_string() as above function is deprecated
        // Or you can use prepared statements to sanitize
        // Use stripslashes to do the opposite
 //   }

    // do stuffs with validated & safe data

    //show the raw data (for practice)
  //  var_dump($_POST);
}
?>
</body>
</html>