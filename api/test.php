<?php
/*
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    echo 'This is a GET request.';

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    echo 'This is a POST request.';

} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    
    echo 'This is a PUT request.';

} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    echo 'This is a Delete request.';

} else {

    echo 'Unsupported request method.';
}
*/


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Redirect to a different page for GET requests
    header('Location: Patient.php');
    exit(); // Ensure that no further code is executed after the redirect
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Redirect to a different page for POST requests
    header('Location: /post-page.php');
    exit();
} else {
    // Handle other request methods or redirect to a default page
    header('Location: /default-page.php');
    exit();
}



?>