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

//echo $query.'<br>';
$result = $conn->query($query);

if ($result !== false) {
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        print_r($user);
        $_SESSION['practitionerId'] = $user['practitionerId'];

        $_SESSION['practitionerFName'] = $user['practitionerFName'];

        //$_SESSION['district'] = $user['district'];
        $_SESSION['userType'] = $user['userType'];

        $_SESSION['organizationId'] = $user['organizationId'];

    $conn->close();
    header("Location: ../home");

}}
else{
    header("Location: ../index.php?err");
}

ob_end_flush();

?>

