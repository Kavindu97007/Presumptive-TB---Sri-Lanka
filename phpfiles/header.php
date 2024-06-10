<?php
session_start();

if (empty($_SESSION['practitionerId']) || empty($_SESSION['practitionerFName']) || empty($_SESSION['organizationId'])) {    
    header("Location: index.php");
    exit(); 
}

?>
