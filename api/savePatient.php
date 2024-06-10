<?php

// Retrieve the JSON data from the POST request
$jsonString = file_get_contents("php://input");

// Decode the JSON string into an associative array
$data = json_decode($jsonString, true);

// Access and store values into separate variables
$resourceType = $data['resourceType'];
if ($resourceType !=="Patient") {
    echo "0";
    exit;
}

$givenId = $data['identifier'][0]['value'];
$nameText = $data['name'][0]['text'];
$otherName = $data['name'][0]['given'][0];
$lastName = $data['name'][0]['family'];
$mobile_1 = $data['telecom'][0]['value'];
$mobile_2 = $data['telecom'][1]['value'];
$gender = $data['gender'];
$dob = $data['birthDate'];
$diseased = $data['deceasedBoolean'];
$adrs = $data['address'][0]['text'];
$district = $data['address'][0]['district'];
$country = $data['address'][0]['country'];
$generalPractitionerReference = $data['generalPractitioner'][0]['reference'];
$managingOrganizationReference = $data['managingOrganization']['reference'];



include '../phpfiles/db.php';

$sql = "INSERT INTO `patient`(`givenId`, `active`, `diseased`, `fName`, `lName`, `dob`, `gender`, `adrs`, `mobileNumber`, `homeNumber`, `distric`, `country`) VALUES ('$givenId',1,'$diseased','$otherName','$lastName','$dob','$gender','$adrs','$mobile_1','$mobile_2','$district', '$country')";

// Execute the INSERT query
if ($conn->query($sql) === TRUE) {
    // Get the last inserted ID
    $patientId = $conn->insert_id;

    $sqlEncounter = "INSERT INTO `encounter`(`status`, `type`, `patientId`, `practionerId`,`organizationId`) VALUES ('completed','out patient',$patientId,$generalPractitionerReference, $managingOrganizationReference )";
    //print_r($sqlEncounter);
    if ($conn->query($sqlEncounter) === TRUE) {
    // Get the last inserted ID
    $encounterId = $conn->insert_id;
    //echo "patientId=".$patientId."&encounterId=".$encounterId;

    $data = array(
    'patientId' => $patientId,
    'encounterId' => $encounterId
);

    // Returning the success 
    $jsonData = json_encode($data);
    header('Content-Type: application/json');
    header('Content-Length: ' . strlen($jsonData));
    echo $jsonData;

    }


} else {
    echo "0";
}

$conn->close();

?>
