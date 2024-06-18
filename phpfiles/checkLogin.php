<?php

ob_start();
session_start();

function sanitizeUsername($input) {
    $input = trim($input);
    // Remove spaces and other unwanted characters
    $input = preg_replace('/\s+/', '', $input); // Remove spaces
    $input = preg_replace('/[^a-zA-Z0-9_]/', '', $input); // Remove non-alphanumeric characters except underscore
    return $input;
}

$uname=$pw='';
$uname = sanitizeUsername($_POST['username']);
$pw = sanitizeUsername($_POST['pw']);

include 'db.php';

$hashedPassword = md5($pw);
$query = "SELECT * FROM practioner WHERE mobileNo = '{$uname}' AND pw = '{$hashedPassword}' AND active =1";

$result = $conn->query($query);

if ($result !== false) { //check and get user information
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        //print_r($user);
        $_SESSION['practitionerId'] = $user['practitionerId'];
        $_SESSION['practitionerFName'] = $user['practitionerFName'];
        //$_SESSION['district'] = $user['district'];
        $_SESSION['userType'] = $user['userType'];

        $query = "SELECT * FROM `organization` WHERE organizationId='{$user['organizationId']}'";
        $result = $conn->query($query);
        if ($result !== false) { // collect user organization information 
            $userOrg = $result->fetch_assoc();
            $_SESSION['userOrg'] =  $userOrg; // adding data into session array'userOrg'
        }
    
    
        $conn->close();
    header("Location: ../home");
        print_r($_SESSION['userOrg']['organizationId']);
}}
else{
    header("Location: ../index.php?err");
}

ob_end_flush();

?>

