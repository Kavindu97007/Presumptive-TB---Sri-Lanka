<?php
$diseased = filter_var($_POST['diseased'], FILTER_VALIDATE_BOOLEAN);
// Create an associative array with the desired structure
$patientData = array(
    "resourceType" => "Patient",
    "id" => $_POST['givenId'],
    "identifier" => array(
        array(
            "system" => "https:www.pretb.com",
            "value" => $_POST['givenId']
        )
    ),
    "name" => array(
        array(
            "text" => $_POST['otherName'] . " " . $_POST['lastName'],
            "given" => array(
                $_POST['otherName']
            ),
            "family" => $_POST['lastName']
        )
    ),
    "telecom" => array(
        array(
            "system" => "phone",
            "value" => $_POST['mobile_1'],
            "use" => "mobile"
        ),
        array(
            "system" => "phone",
            "value" => $_POST['mobile_2'],
            "use" => "home"
        )
    ),
    "gender" => $_POST['sex'],
    "birthDate" => $_POST['birthDate'],
    "deceasedBoolean" => $diseased,
    "address" => array(
        array(
            "text" => $_POST['adrs'],
            "type" => "postal",
            "district" => $_POST['district'],
            "country" => "Sri Lanka"
        )
    ),
    "generalPractitioner" => array(
        array(
            "reference" => $_SESSION['practitionerId']
        )
    ),
    "managingOrganization" => array(
        "reference" => $_SESSION['organizationId']
    )
);

// Convert the array to JSON format
$patientData = json_encode($patientData, JSON_PRETTY_PRINT);

// Output the JSON echo $patientData;

// API endpoint URL
$apiUrl = 'localhost/tb/api/savePatient';

// Initialize cURL session
$ch = curl_init($apiUrl);

// Set cURL options
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $patientData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($patientData))
);

// Execute cURL request
$response = curl_exec($ch);

// Check for errors
if ($response === false) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    // Output the response
    $data = json_decode($response, true);
    $patientId =  $data['patientId'];
    $encounterId =  $data['encounterId'];
}

// Close cURL session
curl_close($ch);

?>