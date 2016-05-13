<?php
/*=============================================================*/
#### How to Validate Form with PHP - Server Side Validation ####
#### Author	: 	Arpan Das						####
#### site	: 	http://w3epic.com/							####
#### email	:	admin@w3epic.com					####
/*=============================================================*/

$error = ""; // Initialize error as blank
$err="";
if (isset($_POST['submit'])) { // check if the form is submitted
    #### removing extra white spaces & escaping harmful characters ####
    $username 			= trim($_POST['username']);
    $first_name 		= trim($_POST['first_name']);
    $last_name 			= trim($_POST['last_name']);
    $password 			= $_POST['password'];
    $confirm_password 	= $_POST['confirm_password'];
    $email 				= $_POST['email'];
    $phone				= $_POST['phone'];
    $gender				= $_POST['gender'];
    $blood_group		= $_POST['blood_group'];
    // dob
    $day 			= $_POST['day'];
    $month 			= $_POST['month'];
    $year 			= $_POST['year'];
    $dob			= $day.$month.$year;
    $age 			= date("Y")-$year;
    $bio				= $_POST['bio'];

    #### start validating input data ####
    #####################################

    # Validate Username #
    // if its not alpha numeric, throw error
    if (!ctype_alnum($username)) {
        $error .= '<p class="error">Username should be alpha numeric characters only.</p>';
    }
    // if username is not 3-20 characters long, throw error
    if (strlen($username) < 3 OR strlen($username) > 20) {
        $err .= '<p class="error">Username should be within 3-20 characters long.</p>';
    }

    # Validate First Name #
    // if its not alpha numeric, throw error
    if (!ctype_alpha(str_replace(array("'", "-"), "",$first_name))) {
        $error .= '<p class="error">First name should be alpha characters only.</p>';
    }
    // if first_name is not 3-20 characters long, throw error
    if (strlen($first_name) < 3 OR strlen($first_name) > 20) {
        $error .= '<p class="error">First name should be within 3-20 characters long.</p>';
    }

    # Validate Last Name #
    // if its not alpha numeric, throw error
    if (!ctype_alpha(str_replace(array("'", "-"), "", $last_name))) {
        $error .= '<p class="error">Last name should be alpha characters only.</p>';
    }
    // if first_name is not 3-20 characters long, throw error
    if (strlen($last_name) < 3 OR strlen($last_name) > 20) {
        $error .= '<p class="error">Last name should be within 3-20 characters long.</p>';
    }

    # Validate Password #
    // if first_name is not 3-20 characters long, throw error
    if (strlen($password) < 3 OR strlen($password) > 20) {
        $error .= '<p class="error">Password should be within 3-20 characters long.</p>';
    }

    # Validate Confirm Password #
    // if first_name is not 3-20 characters long, throw error
    if ($confirm_password != $password) {
        $error .= '<p class="error">Confirm password mismatch.</p>';
    }

    # Validate Email #
    // if email is invalid, throw error
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // you can also use regex to do same
        $error .= '<p class="error">Enter a valid email address.</p>';
    }

    # Validate Phone #
    // if phone is invalid, throw error
    if (!ctype_digit($phone) OR strlen($phone) != 10) {
        $error .= '<p class="error">Enter a valid phone number.</p>';
    }

    # Validate Gender #
    // if gender is not selected or invalid, throw error
    if ($gender != 'male' && $gender != 'female') {
        $error .= '<p class="error">Please select your gender.</p>';
    }

    # Validate Blood Group #
    // if blood group is not selected, throw error
    if ($blood_group == 0) {
        $error .= '<p class="error">Please select your blood group.</p>';
    }

    # Validate Date of Birth (DOB) #
    // if day is not 1-31, throw error
    if (intval($day)<1 OR intval($day)>31) {
        $error .= '<p class="error">Enter a valid day between 1-31.</p>';
    }
    // if month is not 1-12, throw error
    if (intval($month)<1 OR intval($month)>12) {
        $error .= '<p class="error">Enter a valid month between 1-12.</p>';
    }
    // if age is below 18 , throw error
    if ($age < 18) {
        $error .= '<p class="error">You should be at least 18 years old.</p>';
    }

    # Validate Bio #
    if (strlen($bio)==0 OR strlen($bio)>240) {
        $error .= '<p class="error">Please write something about you withing 240 characters.</p>';
    }

    #### end validating input data ####
    #####################################
}