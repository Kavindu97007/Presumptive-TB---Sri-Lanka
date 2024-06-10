<?php



if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Redirects to getPatientInfo page to retrive data
    header('Location: getPtInfor.php');
    exit(); // Ensure that no further code is executed after the redirect
    
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Redirect to a different page for POST requests
    header('Location: savePatient.php');
    exit();

} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Redirect to a different page for POST requests
    header('Location: test3.php');
    exit();

} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Redirect to a different page for POST requests
    header('Location: test3.php');
    exit();

} else {
    // Handle other request methods or redirect to a default page
    header('Location: test4.php');
    exit();
}



?>