<?php
session_start();
//print_r($_POST);
if (isset($_SESSION['postData'])){unset($_SESSION['postData']);
}
if (isset($_SESSION['savedData'])){unset($_SESSION['savedData']);
}
 
// Assuming the form data is received via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate SLMCID
    if (!isset($_POST['slmcId']) || empty($_POST['slmcId']) || !ctype_digit($_POST['slmcId']) || strlen($_POST['slmcId']) > 6) {
        $_SESSION['postData'] = $_POST; // Store the POST data
        header("Location: ../reguser.php");
        exit;
    }
    
    // Validate practitionerFirstName and practitionerLastName
    if (empty($_POST['practitionerFirstName']) || empty($_POST['practitionerLastName'])) {
        $_SESSION['postData'] = $_POST; // Store the POST data
        header("Location: ../reguser.php");
        exit;
    }
    
    // Validate MobileNo
    if (!isset($_POST['MobileNo']) || !ctype_digit($_POST['MobileNo']) || strlen($_POST['MobileNo']) != 10) {
        $_SESSION['postData'] = $_POST; // Store the POST data
        header("Location: ../reguser.php");
        exit;
    }
    
    // If all validations pass, you can proceed with your logic here
    // For example, you can access the validated data as follows:
    $slmcId = $_POST['slmcId'];
    $practitionerFirstName = $_POST['practitionerFirstName'];
    $practitionerLastName = $_POST['practitionerLastName'];
    $mobileNo = $_POST['MobileNo'];

include 'db.php';

    $username = $_POST['MobileNo'];
    $name = $_POST['practitionerFirstName'] . ' ' . $_POST['practitionerLastName'];
    $mobile = $_POST['MobileNo'];
    $instituition = $_POST['organization'];
    $isActive = $_POST['Active'];
    $userType = 1;
    $specialty = $_POST['speciality'];
    $slmc = $_POST['slmcId'];
    $lan = $_POST['communication'];
    $pw = $_POST['pw'];
    $hashedPw =md5($pw);
    $sql = "INSERT INTO user (username, name, mobile, instituition, isActive, userType, specialty, slmc, lan,pw) 
        VALUES ('$username', '$name', '$mobile', '$instituition', '$isActive', '$userType', '$specialty', '$slmc', '$lan', '$hashedPw')";

if ($conn->query($sql) === TRUE) {
    $inserted_id = $conn->insert_id;
    $sql_select = "SELECT * FROM user WHERE userId = $inserted_id";
    $result = $conn->query($sql_select);
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $_SESSION['savedData'] = $row;
            $_SESSION['savedData']['pw'] = $pw;
        }
        print_r($_SESSION['savedData']);
    } else {
        echo "0 results";
    }


    header("Location: ../userRegSuccess.php");
    $conn->close();
    exit;
} else {
    $_SESSION['postData'] = $_POST;
    header("Location: ../newuser.php");
    echo "Error: " . $sql . "<br>" . $conn->error;
    $conn->close();
}

} else {
    // If the request method is not POST, redirect to the registration page
    header("Location: reguser.php");
    exit;
}
?>