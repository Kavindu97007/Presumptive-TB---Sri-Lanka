<?php

// Retrieve the JSON data from the POST request
$jsonString = file_get_contents("php://input");

// Decode the JSON string into an associative array
$data = json_decode($jsonString, true);

// Access and store values into separate variables
$resourceType = $data['resourceType'];
if ($resourceType !=="Condition") {
    echo "0";
    exit;
}

$patientId = $data['subject']['reference'];
$codeCode = $data['code']['coding'][0]['code'];
$codeSystem = $data['code']['coding'][0]['system'];
$codeDisplay = $data['code']['coding'][0]['display'];
$encounterId = $data['encounter']['reference'];
$recordedDate = $data['recordedDate'];
$verificationStatus = $data['verificationStatus']['coding'][0]['code'];

include '../phpfiles/db.php';

$sql = "INSERT INTO `condition`(`patientId`, `codeCode`, `codeSystem`, `codeDisplay`, `encounterId`, `recordedDate`, `verificationStatus`) VALUES ($patientId,'codeCode','$codeSystem','$codeDisplay',$encounterId,$recordedDate,'$verificationStatus')";

// Execute the INSERT query
if ($conn->query($sql) === TRUE) {
    // Get the last inserted ID
    $conditionId = $conn->insert_id;
    
    echo $conditionId;

} else {
    echo "0";
}

$conn->close();

?>
